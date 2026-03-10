<?php 
include '../baglan.php'; 

if(!isset($_SESSION['admin_login'])) { 
    header("Location: login.php"); 
    exit; 
}

$id = $_GET['id'] ?? null;
$p = $id ? $db->query("SELECT * FROM projeler WHERE id=$id")->fetch(PDO::FETCH_ASSOC) : null;

if($_POST){
    function yukle($file, $eski){
        if($file['size'] > 0){
            $ad = time().'_'.str_replace(' ', '_', $file['name']);
            move_uploaded_file($file['tmp_name'], "../resimler/".$ad); 
            return "resimler/".$ad;
        } return $eski;
    }
    
    $r1=yukle($_FILES['r1'],$p['resim'] ?? ''); 
    $r2=yukle($_FILES['r2'],$p['resim2'] ?? ''); 
    $r3=yukle($_FILES['r3'],$p['resim3'] ?? '');
    
    $b=$_POST['b']; 
    $k=$_POST['k']; 
    $a=$_POST['a'];

    if($id){
        $sorgu = $db->prepare("UPDATE projeler SET baslik=?, kategori=?, aciklama=?, resim=?, resim2=?, resim3=? WHERE id=?");
        $sorgu->execute([$b,$k,$a,$r1,$r2,$r3,$id]);
    } else {
        $sorgu = $db->prepare("INSERT INTO projeler SET baslik=?, kategori=?, aciklama=?, resim=?, resim2=?, resim3=?");
        $sorgu->execute([$b,$k,$a,$r1,$r2,$r3]);
    }
    header("Location: admin-projeler.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Proje Yönetimi | Tepe İnşaat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #000; color: #fff; }
        .form-container { background: #1a1a1a; border-radius: 15px; padding: 40px; border: 2px solid #d4af37; margin-top: 50px; }
        
        /* Başlıklar ve Etiketler */
        .form-label { color: #d4af37; font-weight: 700; margin-top: 15px; font-size: 1.1rem; }
        .text-instructions { color: #ffffff !important; opacity: 0.8; font-size: 0.85rem; margin-bottom: 5px; display: block; }
        
        /* İnput Kutuları */
        .form-control { 
            background: #2b2b2b !important; 
            border: 1px solid #444 !important; 
            color: #ffffff !important; 
            padding: 12px;
        }
        .form-control:focus { 
            background: #333 !important; 
            border-color: #d4af37 !important; 
            box-shadow: 0 0 10px rgba(212, 175, 55, 0.3); 
        }
        
        /* Placeholder (Kutu içindeki silik yazı) rengi */
        .form-control::placeholder { color: #aaaaaa !important; }
        
        .btn-save { background: #d4af37; color: #000; font-weight: 800; margin-top: 30px; border: none; }
        .btn-save:hover { background: #f1c40f; }
        .btn-cancel { background: #444; color: white; margin-top: 30px; border: none; }
    </style>
</head>
<body>

<div class="container mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="form-container shadow-lg">
                <h2 class="text-center mb-4" style="color: #d4af37; letter-spacing: 2px;">
                    <?php echo $id ? 'PROJEYİ DÜZENLE' : 'YENİ PROJE EKLE'; ?>
                </h2>
                <hr border="1" color="#d4af37">
                
                <form method="POST" enctype="multipart/form-data">
                    
                    <label class="form-label">PROJE BAŞLIĞI</label>
                    <span class="text-instructions">Sitenin ana sayfasında görünecek olan isimdir.</span>
                    <input type="text" name="b" class="form-control" placeholder="Örn: Modern Villa Mermer Kaplama" value="<?php echo $p['baslik']??''; ?>" required>

                    <label class="form-label">KATEGORİ</label>
                    <span class="text-instructions">Projenin türünü belirtir (Örn: Lüks Konut).</span>
                    <input type="text" name="k" class="form-control" placeholder="Örn: Villa / Mutfak" value="<?php echo $p['kategori']??''; ?>" required>

                    <label class="form-label">PROJE DETAYLI AÇIKLAMASI</label>
                    <span class="text-instructions">Müşterinin detay sayfasında okuyacağı tanıtım yazısıdır.</span>
                    <textarea name="a" class="form-control" rows="6" placeholder="Buraya projede yapılan işleri detaylıca yazın..."><?php echo $p['aciklama']??''; ?></textarea>

                    <hr class="my-4" style="background-color: #d4af37; height: 2px; opacity: 1;">

                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label" style="font-size: 0.9rem;">KAPAK RESMİ</label>
                            <input type="file" name="r1" class="form-control">
                            <?php if(!empty($p['resim'])): ?>
                                <img src="../<?php echo $p['resim']; ?>" class="mt-2 rounded border border-warning" style="width:100%; height:80px; object-fit:cover;">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" style="font-size: 0.9rem;">EK RESİM 2</label>
                            <input type="file" name="r2" class="form-control">
                            <?php if(!empty($p['resim2'])): ?>
                                <img src="../<?php echo $p['resim2']; ?>" class="mt-2 rounded border border-secondary" style="width:100%; height:80px; object-fit:cover;">
                            <?php endif; ?>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label" style="font-size: 0.9rem;">EK RESİM 3</label>
                            <input type="file" name="r3" class="form-control">
                            <?php if(!empty($p['resim3'])): ?>
                                <img src="../<?php echo $p['resim3']; ?>" class="mt-2 rounded border border-secondary" style="width:100%; height:80px; object-fit:cover;">
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <button type="submit" class="btn btn-save w-100 py-3">KAYDET VE YAYINLA</button>
                        <a href="admin-projeler.php" class="btn btn-cancel w-50 py-3 text-decoration-none text-center">İPTAL</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

</body>
</html>
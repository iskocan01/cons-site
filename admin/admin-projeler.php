<?php 
include '../baglan.php'; 
if(!isset($_SESSION['admin_login'])) { header("Location: login.php"); exit; }

if(isset($_GET['sil'])){ 
    $db->prepare("DELETE FROM projeler WHERE id=?")->execute([$_GET['sil']]); 
    header("Location: admin-projeler.php"); 
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Projeler | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
<div class="d-flex">
    <div class="p-4 border-end border-secondary" style="width:250px; min-height:100vh">
        <h5 class="text-warning mb-4">TEPE ADMİN</h5>
        <a href="admin.php" class="d-block text-white mb-3 text-decoration-none">Gelen Mesajlar</a>
        <a href="admin-projeler.php" class="d-block text-warning mb-3 text-decoration-none fw-bold">Projeleri Yönet</a>
        <hr>
        <a href="cikis.php" class="text-danger text-decoration-none">Güvenli Çıkış</a>
    </div>
    <div class="p-5 w-100">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Projeler</h3>
            <a href="proje-islem.php" class="btn btn-warning fw-bold">+ Yeni Proje Ekle</a>
        </div>
        <div class="row">
            <?php 
            $projeler = $db->query("SELECT * FROM projeler ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
            foreach($projeler as $p): ?>
            <div class="col-md-3 mb-4">
                <div class="card bg-black border-secondary h-100">
                    <img src="../<?php echo $p['resim']; ?>" class="card-img-top" style="height:150px; object-fit:cover;">
                    <div class="card-body p-2">
                        <h6 class="card-title"><?php echo $p['baslik']; ?></h6>
                        <div class="d-flex gap-2">
                            <a href="proje-islem.php?id=<?php echo $p['id']; ?>" class="btn btn-info btn-sm w-100">Düzenle</a>
                            <a href="?sil=<?php echo $p['id']; ?>" class="btn btn-danger btn-sm w-100" onclick="return confirm('Emin misiniz?')">Sil</a>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
</body>
</html>
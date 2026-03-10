<?php 
include '../baglan.php'; // Ana dizindeki baglan.php'yi çeker

if(isset($_SESSION['admin_login'])) { 
    header("Location: admin.php"); 
    exit; 
}

if($_POST){
    $kullanici = $_POST['k']; // Formdaki name="k"
    $sifre = $_POST['s'];     // Formdaki name="s"

    // VERİTABANI KONTROLÜ
    $sorgu = $db->prepare("SELECT * FROM adminler WHERE kullanici = ? AND sifre = ?");
    $sorgu->execute([$kullanici, $sifre]);
    $admin_var_mi = $sorgu->fetch(PDO::FETCH_ASSOC);

    if($admin_var_mi){ 
        $_SESSION['admin_login'] = true; 
        header("Location: admin.php"); 
        exit;
    } else { 
        $hata = "Kullanıcı adı veya şifre hatalı!"; 
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Giriş | Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-black text-white d-flex align-items-center justify-content-center" style="height:100vh">
    <form method="POST" action="login.php" class="p-4 border border-warning rounded" style="width:350px;">
        <h4 class="text-warning mb-3">Yönetim Paneli</h4>
        
        <?php if(isset($hata)): ?>
            <div class="alert alert-danger py-2" style="font-size:14px;"><?php echo $hata; ?></div>
        <?php endif; ?>

        <input type="text" name="k" class="form-control mb-2 bg-dark text-white border-secondary" placeholder="Kullanıcı Adı" required>
        <input type="password" name="s" class="form-control mb-3 bg-dark text-white border-secondary" placeholder="Şifre" required>
        <button type="submit" class="btn btn-warning w-100 fw-bold">Giriş Yap</button>
    </form>
</body>
</html>
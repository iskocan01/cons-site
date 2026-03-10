<?php 
include '../baglan.php'; 

// Oturum kontrolü
if(!isset($_SESSION['admin_login'])) { 
    header("Location: login.php"); 
    exit; 
}

// Mesaj Silme İşlemi
if(isset($_GET['sil'])){ 
    $db->prepare("DELETE FROM mesajlar WHERE id=?")->execute([$_GET['sil']]); 
    header("Location: admin.php"); 
    exit;
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Mesajlar | Tepe İnşaat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-dark text-white">
<div class="d-flex">
    <div class="p-4 border-end border-secondary" style="width:250px; min-height:100vh">
        <h5 class="text-warning mb-4">TEPE ADMİN</h5>
        <a href="admin.php" class="d-block text-warning mb-3 text-decoration-none fw-bold">
            <i class="bi bi-envelope-fill me-2"></i>Gelen Mesajlar
        </a>
        <a href="admin-projeler.php" class="d-block text-white mb-3 text-decoration-none">
            <i class="bi bi-houses me-2"></i>Projeleri Yönet
        </a>
        <hr class="border-secondary">
        <a href="../index.php" target="_blank" class="d-block text-info mb-3 text-decoration-none small italic">
            <i class="bi bi-eye me-2"></i>Siteyi Görüntüle
        </a>
        <a href="cikis.php" class="text-danger text-decoration-none fw-bold">
            <i class="bi bi-box-arrow-right me-2"></i>Güvenli Çıkış
        </a>
    </div>

    <div class="p-5 w-100">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3>Gelen Mesajlar</h3>
            <span class="badge bg-warning text-dark px-3 py-2">Toplam: 
                <?php echo $db->query("SELECT count(id) FROM mesajlar")->fetchColumn(); ?>
            </span>
        </div>

        <table class="table table-dark table-striped table-hover mt-4 align-middle">
            <thead class="table-warning text-dark">
                <tr>
                    <th style="width: 150px;">Tarih</th>
                    <th>Ad Soyad</th>
                    <th>E-posta</th>
                    <th>Mesaj</th>
                    <th style="width: 80px;">İşlem</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $mesajlar = $db->query("SELECT * FROM mesajlar ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
                
                if(count($mesajlar) > 0):
                    foreach($mesajlar as $m): ?>
                    <tr>
                        <td class="small text-secondary"><?php echo $m['tarih']; ?></td>
                        <td class="fw-bold"><?php echo htmlspecialchars($m['ad_soyad']); ?></td>
                        <td><a href="mailto:<?php echo $m['email']; ?>" class="text-info text-decoration-none"><?php echo htmlspecialchars($m['email']); ?></a></td>
                        <td class="small"><?php echo nl2br(htmlspecialchars($m['mesaj'])); ?></td>
                        <td>
                            <a href="?sil=<?php echo $m['id']; ?>" 
                               class="btn btn-outline-danger btn-sm" 
                               onclick="return confirm('Bu mesajı silmek istediğinizden emin misiniz?')">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; 
                else: ?>
                    <tr>
                        <td colspan="5" class="text-center py-5 text-secondary italic">Henüz bir mesaj gelmedi.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
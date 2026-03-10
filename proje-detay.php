<?php include 'baglan.php'; 
$id = isset($_GET['id']) ? $_GET['id'] : 0;
$sorgu = $db->prepare("SELECT * FROM projeler WHERE id = ?");
$sorgu->execute([$id]);
$proje = $sorgu->fetch(PDO::FETCH_ASSOC);

if(!$proje) { header("Location: index.php"); exit; }

// --- DEĞİŞEN TEK YER BURASI ---
// Veritabanındaki 3 resim alanını alıyoruz ve boş olanları eliyoruz
$resimListesi = array_filter([
    $proje['resim'], 
    $proje['resim2'], 
    $proje['resim3']
]);
// Anahtarları (0,1,2 diye) sıfırlıyoruz ki slider ilk resmi "active" yakalayabilsin
$resimListesi = array_values($resimListesi);
// ------------------------------
$resimListesi[] = "logo2.png";
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $proje['baslik']; ?> | Tepe İnşaat</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Syncopate:wght@400;700&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root { 
            --accent: #d4af37; 
            --dark: #0f0f0f; 
            --darker: #050505; 
            --glass: rgba(255, 255, 255, 0.05); 
        }

        body { font-family: 'Poppins', sans-serif; background-color: var(--dark); color: #fff; overflow-x: hidden; }
        h1, h2, h3 { font-family: 'Syncopate', sans-serif; text-transform: uppercase; }

        /* --- Slider Sabitleyici (Eski Yapıya Uygun) --- */
        .carousel-inner {
            border-radius: 15px;
            border: 1px solid var(--glass);
            height: 500px;
            background: #000;
        }
        .carousel-item img {
            width: 100%;
            height: 500px;
            object-fit: contain; /* Resimlerin bozulmasını engeller */
        }

        /* --- Bilgi Kutusu --- */
        .info-box { 
            background: var(--glass); 
            padding: 40px; 
            border: 1px solid rgba(255,255,255,0.1); 
            border-radius: 15px; 
        }
        
        .btn-accent { 
            background: var(--accent); 
            color: var(--darker); 
            font-weight: 700; 
            padding: 12px 25px; 
            border-radius: 10px; 
            text-decoration: none; 
            display: inline-block;
            transition: 0.3s;
        }
        .btn-accent:hover { transform: translateY(-3px); opacity: 0.9; color: #000; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="mb-4">
        <a href="index.php" class="text-decoration-none" style="color: var(--accent);">
            <i class="bi bi-arrow-left"></i> PROJELERE DÖN
        </a>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div id="projeSlider" class="carousel slide shadow-lg" data-bs-ride="carousel">
                <div class="carousel-inner">
                    <?php 
                    $i = 0;
                    foreach($resimListesi as $resimPath): 
                        if(empty($resimPath)) continue; 
                        $activeClass = ($i == 0) ? "active" : "";
                    ?>
                    <div class="carousel-item <?php echo $activeClass; ?>">
                        <img src="<?php echo $resimPath; ?>" alt="Proje">
                    </div>
                    <?php $i++; endforeach; ?>
                </div>
                
                <button class="carousel-control-prev" type="button" data-bs-target="#projeSlider" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon"></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#projeSlider" data-bs-slide="next">
                    <span class="carousel-control-next-icon"></span>
                </button>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="info-box">
                <h6 class="text-uppercase mb-3" style="color:var(--accent); letter-spacing: 3px;"><?php echo $proje['kategori']; ?></h6>
                <h2 class="fw-bold mb-4"><?php echo $proje['baslik']; ?></h2>
                <p class="opacity-75 mb-5"><?php echo $proje['aciklama']; ?></p>
                
                <a href="https://wa.me/905551234567" class="btn-accent w-100 text-center">TEKLİF AL / WHATSAPP</a>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
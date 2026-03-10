<?php 
include 'baglan.php'; 

// --- MESAJ GÖNDERME SİSTEMİ ---
$mesaj_onay = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['mesaj_gonder'])) {
    $ad = $_POST['ad_soyad'];
    $email = $_POST['email']; 
    $mesaj = $_POST['mesaj'];

    if(!empty($ad) && !empty($email) && !empty($mesaj)) {
        $sorgu = $db->prepare("INSERT INTO mesajlar SET ad_soyad = ?, email = ?, mesaj = ?");
        $islem = $sorgu->execute([$ad, $email, $mesaj]);

        if ($islem) {
            $mesaj_onay = "success";
        } else {
            $mesaj_onay = "error";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tepe İnşaat | Mermer & İç Mimari</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Syncopate:wght@400;700&family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    <style>
        :root { 
            --accent: #d4af37; 
            --dark: #0f0f0f; 
            --darker: #050505; 
            --glass: rgba(255, 255, 255, 0.05); 
        }

        body { font-family: 'Poppins', sans-serif; background-color: var(--dark); color: #fff; overflow-x: hidden; }
        h1, h2, h3, .navbar-brand { font-family: 'Syncopate', sans-serif; text-transform: uppercase; }

        .navbar { padding: 25px 0; transition: 0.4s; background: transparent; z-index: 1050; }
        .navbar.scrolled { background: rgba(0,0,0,0.95); padding: 15px 0; border-bottom: 1px solid var(--accent); }
        
        .navbar-brand img { 
            height: 100px; 
            width: auto;   
            margin-right: 12px; 
        }

        .hero { 
            height: 100vh; display: flex; align-items: center; position: relative;
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.7)), url('https://images.unsplash.com/photo-1600607687920-4e2a09cf159d?q=80&w=2000') no-repeat center center/cover;
            background-attachment: fixed;
        }

        .service-box { background: var(--glass); padding: 40px; border: 1px solid rgba(255,255,255,0.1); transition: 0.4s; height: 100%; border-radius: 15px; }
        .service-box:hover { background: var(--accent); color: var(--darker); transform: translateY(-10px); }
        .service-box i { font-size: 3rem; color: var(--accent); transition: 0.4s; }
        .service-box:hover i { color: var(--darker); }

        .project-card { position: relative; overflow: hidden; border-radius: 15px; height: 400px; border: 1px solid var(--glass); }
        .project-card img { width: 100%; height: 100%; object-fit: cover; transition: 0.8s; }
        .project-card:hover img { transform: scale(1.1); filter: brightness(30%); }
        .project-overlay { position: absolute; inset: 0; display: flex; flex-direction: column; justify-content: flex-end; padding: 30px; background: linear-gradient(transparent, rgba(0,0,0,0.9)); opacity: 0; transition: 0.4s; transform: translateY(20px); }
        .project-card:hover .project-overlay { opacity: 1; transform: translateY(0); }

        #iletisim { background-color: var(--darker); padding: 100px 0; }
        .contact-box { background: rgba(255, 255, 255, 0.03); padding: 40px; border-radius: 20px; border: 1px solid rgba(212, 175, 55, 0.2); }
        
        .form-label { color: var(--accent) !important; font-weight: 600; font-size: 0.9rem; margin-bottom: 8px; display: block; }
        
        .form-control { 
            background: rgba(255,255,255,0.08) !important; 
            border: 1px solid rgba(255,255,255,0.2) !important; 
            color: #ffffff !important; 
            padding: 15px; 
            border-radius: 10px; 
        }
        .form-control:focus { background: rgba(255,255,255,0.12) !important; border-color: var(--accent) !important; box-shadow: none !important; color: white !important; }
        
        .contact-info-title { color: var(--accent) !important; font-weight: 700; text-transform: uppercase; margin-bottom: 5px; display: block; font-size: 0.9rem; }
        .contact-info-text { color: #ffffff !important; font-size: 1.1rem; margin-bottom: 25px; display: block; opacity: 0.9; }
        
        .social-circle { width: 45px; height: 45px; display: inline-flex; align-items: center; justify-content: center; border-radius: 50%; background: var(--glass); color: var(--accent); font-size: 1.2rem; transition: 0.3s; margin-right: 10px; text-decoration: none; border: 1px solid rgba(212, 175, 55, 0.3); }
        .social-circle:hover { background: var(--accent); color: var(--darker); transform: translateY(-5px); }
        
        .btn-accent { background: var(--accent); color: var(--darker); font-weight: 700; padding: 15px 30px; border: none; transition: 0.3s; text-decoration: none; display: inline-block; border-radius: 10px; }
        
        .wa-float { position: fixed; bottom: 30px; right: 30px; background: #25d366; color: white; width: 60px; height: 60px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 30px; z-index: 1000; box-shadow: 0 10px 25px rgba(0,0,0,0.3); transition: 0.3s; }
    </style>
</head>
<body>

<a href="https://wa.me/905551234567" class="wa-float" target="_blank"><i class="bi bi-whatsapp"></i></a>

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="logo2.png" alt="Tepe İnşaat" onerror="this.style.display='none'"> 
            <span style="color:var(--accent)">TEPE</span> İNŞAAT
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="nav">
            <ul class="navbar-nav ms-auto fw-bold small">
                <li class="nav-item"><a class="nav-link px-3" href="#home">Anasayfa</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="#hizmetler">Hizmetler</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="#projeler">Projeler</a></li>
                <li class="nav-item"><a class="nav-link px-3" href="#iletisim">İletişim</a></li>
            </ul>
        </div>
    </div>
</nav>

<section id="home" class="hero">
    <div class="container" data-aos="fade-up">
        <h6 class="text-uppercase mb-3" style="color:var(--accent); letter-spacing: 5px;">Mermer & Estetik</h6>
        <h1 class="display-2 fw-bold mb-4">Mekana <br><span style="color:var(--accent)">Değer Katıyoruz</span></h1>
        <p class="lead mb-5 opacity-75" style="max-width: 600px;">Tepe İnşaat ile mermerin asaletini ve seramiğin estetiğini yaşam alanlarınıza taşıyoruz.</p>
        <a href="#projeler" class="btn btn-accent">PROJELERİ İNCELE</a>
    </div>
</section>

<section id="hizmetler" class="py-5">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold">Neler <span style="color:var(--accent)">Yapıyoruz?</span></h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4" data-aos="fade-up">
                <div class="service-box text-center">
                    <i class="bi bi-grid-3x3 mb-4"></i>
                    <h4>Mermer & Seramik</h4>
                    <p class="opacity-75">Kusursuz işçilikle en kaliteli mermer ve seramik uygulamaları yapıyoruz.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="service-box text-center">
                    <i class="bi bi-palette mb-4"></i>
                    <h4>İç Tasarım</h4>
                    <p class="opacity-75">Mekanlarınızın ruhuna uygun modern mimari çözümler üretiyoruz.</p>
                </div>
            </div>
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="service-box text-center">
                    <i class="bi bi-gem mb-4"></i>
                    <h4>Özel Uygulamalar</h4>
                    <p class="opacity-75">Lüks dekorasyon ve butik tasarım projeleriyle fark yaratıyoruz.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="projeler" class="py-5 bg-darker">
    <div class="container py-5">
        <div class="text-center mb-5" data-aos="fade-up">
            <h2 class="display-5 fw-bold">Referans <span style="color:var(--accent)">Projelerimiz</span></h2>
        </div>
        <div class="row g-4">
            <?php
            $sorgu = $db->query("SELECT * FROM projeler ORDER BY id DESC LIMIT 6");
            while($proje = $sorgu->fetch(PDO::FETCH_ASSOC)) {
            ?>
            <div class="col-md-4" data-aos="zoom-in">
                <div class="project-card shadow-lg">
                    <img src="<?php echo $proje['resim']; ?>" alt="<?php echo $proje['baslik']; ?>">
                    <div class="project-overlay">
                        <span class="badge bg-warning text-dark mb-2"><?php echo $proje['kategori']; ?></span>
                        <h4 class="fw-bold"><?php echo $proje['baslik']; ?></h4>
                        <hr class="border-accent">
                        <a href="proje-detay.php?id=<?php echo $proje['id']; ?>" class="btn btn-sm btn-outline-light">DETAYLARI GÖR</a>
                    </div>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
</section>

<section id="iletisim">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-7" data-aos="fade-right">
                <div class="contact-box shadow-lg">
                    <h3 class="fw-bold mb-4">Bize <span style="color:var(--accent)">Yazın</span></h3>
                    
                    <?php if($mesaj_onay == "success"): ?>
                        <div class="alert alert-success">Mesajınız başarıyla gönderildi! Teşekkür ederiz.</div>
                    <?php elseif($mesaj_onay == "error"): ?>
                        <div class="alert alert-danger">Mesaj gönderilirken bir hata oluştu.</div>
                    <?php endif; ?>

                    <form method="POST" action="index.php#iletisim">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Adınız Soyadınız</label>
                                <input type="text" name="ad_soyad" class="form-control" placeholder="Örn: Ahmet Yılmaz" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">E-Posta Adresiniz</label>
                                <input type="email" name="email" class="form-control" placeholder="Örn: info@mail.com" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Mesajınız</label>
                                <textarea name="mesaj" class="form-control" rows="5" placeholder="Size nasıl yardımcı olabiliriz?" required></textarea>
                            </div>
                            <div class="col-12">
                                <button type="submit" name="mesaj_gonder" class="btn btn-accent w-100 py-3 mt-2">MESAJI GÖNDER</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-5 ps-lg-5" data-aos="fade-left">
                <h3 class="fw-bold mb-4">İletişim <span style="color:var(--accent)">Bilgileri</span></h3>
                <div class="mb-2">
                    <span class="contact-info-title"><i class="bi bi-geo-alt me-2"></i>Ofis Adresimiz</span>
                    <span class="contact-info-text">Merkez Mah. Tepe Sok. No:1 İstanbul</span>
                    
                    <span class="contact-info-title"><i class="bi bi-telephone me-2"></i>Bize Ulaşın</span>
                    <span class="contact-info-text">+90 212 123 45 67</span>
                    
                    <span class="contact-info-title"><i class="bi bi-envelope me-2"></i>E-Mail</span>
                    <span class="contact-info-text">info@tepeinsaat.com</span>
                </div>
                <h5 class="fw-bold mb-3 mt-4">BİZİ TAKİP EDİN</h5>
                <div class="d-flex">
                    <a href="#" class="social-circle"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-circle"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-circle"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="text-center py-4 border-top border-secondary bg-black">
    <p class="text-secondary small mb-0">&copy; 2026 Tepe İnşaat. Tüm Hakları Saklıdır.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({ duration: 1000, once: true });
    window.onscroll = function() {
        if (window.scrollY > 100) { document.querySelector('.navbar').classList.add('scrolled'); }
        else { document.querySelector('.navbar').classList.remove('scrolled'); }
    };
</script>
</body>
</html>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
 
  <title>ACCUEIL</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/vs-shoping2.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
  
  <!-- =======================================================
  * Template Name: Bethany - v4.7.0
  * Template URL: https://bootstrapmade.com/bethany-free-onepage-bootstrap-theme/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
    *{
        box-sizing: border-box;
        margin: 0;
        padding: 0;
      }

      .slider{
        overflow: hidden;
        width: 100%;
        height: 100vh;
        position: relative;
    
      }
      
      
      .slide{
        height: 100vh;
        display: none;
        position: relative;
        transition: all 0.5s linear;
      }
      .slide img{
        width: 100%;
        height: 100%;
        object-fit: cover;
      }
      
      @keyframes animate{
        0%{
          transform:translateY(-20px)
        }
        50%{
          transform:translateY(0)
        }
        100%{
              transform:translateY(-20px)
        }
      }
      .slide-content{
        height: 80px;
        color: #FFF;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: sans-serif;
        text-align: center;
        text-transform: uppercase;
        font-size: 3rem;
        font-weight: bold;
        text-shadow: 0 0 10px #000;
        position: absolute;
        top:50%;
        left: 0;
        right: 0;
        transform: translateY(-50%);
        animation: animate 2s cubic-bezier(.17,.67,.17,.67) 0.5s 1 alternate;
      }
      
      .slide::before{
        content:'';
        position: absolute;
        width: 100%;
        height: 100%;
        background: linear-gradient(rgba(0 0 0 / .3), rgba( 0 0 0 / .7));
      }
      
      .slide.active{
        display: block;
      }
      
      .slider-control{
        position: absolute;
        bottom: 0;
        right: 0;
        width: 60px;
        height: 60px;
        display: flex;
        flex-flow: column nowrap;
        justify-content: center;
        align-items: center;
      }
      
      .btn{
        line-height: 30px;
        height: 30px;
        width: 30px;
        width: 100%;
        text-align: center;
        font-family: sans-serif;
        cursor: pointer;
        background-color: rgba(255,255,255,1);
        transition: all 0.3s linear;
      }
      
      .btn:hover{
        background-color: rgba(0,0,0,1);
        color: #FFF;
        transform: translateX(5px);
      }

      .rounded-circle > img {
    width: 90%;
}
.col-md-6, .col {
    text-align:center
}
      
</style>
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center">
    <div class="container">
      <div class="header-container d-flex align-items-center justify-content-between">
        <div class="logo">
          <h1 class="text-light"><a href="index.php"><span><img src="assets/img/vs-shoping2.png" alt="Logo" 
            style="width:100px; float:left;margin-top:-10px;"></span></a></h1>
          <!-- Uncomment below if you prefer to use an image logo -->
          <!-- <a href="index.php"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
        </div>

        <nav id="navbar" class="navbar">
          
        <ul>
            <li><a class="nav-link scrollto" href="index.php">Accueil</a></li>
            <li><a class="nav-link scrollto" href="apropos.php">A propos</a></li>
            <li><a class="nav-link scrollto" href="services.php">Nos Services</a></li>
            <li><a class="nav-link scrollto" href="#temoignages">Témoignages</a></li>
            <li><a class="nav-link scrollto" href="contact.php">Contactez-nous</a></li>
            <li><a class="getstarted scrollto active" href="admin/index.php">Connexion</a></li>
          
          </ul>
          <i class="bi bi-list mobile-nav-toggle"></i>
        </nav><!-- .navbar -->

      </div><!-- End Header Container -->
    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="d-flex align-items-center">
     <!-- DEBUT SLIDE -->
<div class="slider">
  <div class="slides">
    <div class="slide">
      <img src="assets/img/v10.jpg">
      <div class="slide-content">BUGATTI CENTODIECI</div>
    </div>
    <div class="slide">
      <img src="assets/img/v13.jpg">
      <div class="slide-content">LAMBORGUHINI</div>
    </div>
    <div class="slide">
      <img src="assets/img/v14.jpg">
      <div class="slide-content">ROLS-ROYCE BOAT TAIL</div>
    </div>
    <div class="slide ">
      <img src="assets/img/v12.jpg">
      <div class="slide-content">MERCEDES-MAYBACH EXELERO</div>
    </div>
    <div class="slide">
      <img src="assets/img/v15.jpg">
      <div class="slide-content">ROLS-ROYCE SWEPTAIL</div>
    </div>
    <div class="slide">
      <img src="assets/img/v9.jpg">
      <div class="slide-content">MAYBACH EXELERO</div>
    </div>
    <div class="slide">
        <img src="assets/img/v6.jpg">
         <div class="slide-content">LAMBORGUHINI </div>
       </div>
       <div class="slide">
         <img src="assets/img/v7.jpg">
         <div class="slide-content"> CENTODIECI</div>
       </div>
  </div>
  <div class="slider-control">
    <div class="btn next"><i class="fa-solid fa-arrow-right"></i></div>
    <div class="btn prev"><i class="fa-solid fa-arrow-left"></i> </div>
  </div>
</div>

    <!-- FIN SLIDE -->
  </section><!-- End Hero -->

  <main id="main">
<section>
  <div class="Container">
    <div class="row align-items-start">
        <div class="col-md-6" style="border-width: 2px;border-style: solid;height: 400px;"><img class="rounded-circle" src="assets/img/vs-shoping.png" height="396px"></div>
        <div class="col" style="height: 400px;border-width: 2px;border-style: solid;">
            <h1 style="margin-top: 15%;padding-bottom: 0px;">VS-SHOPING</h1>
            <p class="text-center" style="font-family: 'Aguafina Script', cursive;height: 100px;margin-top: 10px;">Est l'un des meilleurs sites de vente en ligne, à cause de ses merveilleuses prestations. Ayant à sa tête Mr AITCHEDJI Samuel le PDG accompagné de ses collaborateurs.</p>
        </div>
    </div>
</div>
</section>
    <!-- ======= Testimonials Section ======= -->
    <section id="testimonials" class="testimonials section-bg">
      <div class="container">

        <div class="row" id="temoignages">
          <div class="col-lg-4">
            <div class="section-title" data-aos="fade-right">
              <h2>Témoignages</h2>
              <p></p>
            </div>
          </div>
          <div class="col-lg-8" data-aos="fade-up" data-aos-delay="100">

            <div class="testimonials-slider swiper" data-aos="fade-up" data-aos-delay="100">
              <div class="swiper-wrapper">

                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <p>
                      <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                     
                      <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                    </p>
                    <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt="">
                    <h3>Saul Goodman</h3>
                    <h4>Ceo &amp; Founder</h4>
                  </div>
                </div><!-- End testimonial item -->

                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <p>
                      <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                      
                      <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                    </p>
                    <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt="">
                    <h3>Sara Wilsson</h3>
                    <h4>Designer</h4>
                  </div>
                </div><!-- End testimonial item -->

                <div class="swiper-slide">
                  <div class="testimonial-item">
                    <p>
                      <i class="bx bxs-quote-alt-left quote-icon-left"></i>
                     
                      <i class="bx bxs-quote-alt-right quote-icon-right"></i>
                    </p>
                    <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt="">
                    <h3>Jena Karlis</h3>
                    <h4>Store Owner</h4>
                  </div>
                </div><!-- End testimonial item -->


              </div>
              <div class="swiper-pagination"></div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End Testimonials Section -->

   
  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

    <div class="footer-top">
      <div class="container">
        <div class="row">

          <div class="col-lg-3 col-md-6 footer-contact">
            <h3>VS-SHOPPING</h3>
            <p>
              Agla Hlazounto <br>
              Abomey Calavi, Rue 007PB <br>
              Bénin <br><br>
              <strong>Phone:</strong> +229 96 97 28 86<br>
              <strong>Email:</strong> aildevert19@gmail.com<br>
            </p>
          </div>

          <div class="col-lg-2 col-md-6 footer-links">
            <h4>Nos liens</h4>
            <ul>
              <li><i class="bx bx-chevron-right"></i> <a href="index.php">Accueil</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="apropos.php">A propos</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="services.php">Nos Services</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="contact.php">Contactez-nous</a></li>
              <li><i class="bx bx-chevron-right"></i> <a href="#">Politique de confidentialité</a></li>
            </ul>
          </div>

         

          <div class="col-lg-4 col-md-6 footer-newsletter">
            <h4>Inscrivez-vous A notre Newsletter</h4>
            <p>Pour ne pas rater nos nouvelles publications</p>
            <form action="" method="post">
              <input type="email" name="email"><input type="submit" value="Souscrire">
            </form>
          </div>

        </div>
      </div>
    </div>

    <div class="container d-md-flex py-4">

      <div class="me-md-auto text-center text-md-start">
        <div class="copyright">
          &copy; Copyright <strong><span>VS-SHOPPING</span></strong>. Tous les droits sont réservés
        </div>
       
      </div>
      <div class="social-links text-center text-md-right pt-3 pt-md-0">
        <a href="#" target="_blank"><img src="assets/img/facebook.png" class="icon-reseau" alt=""></a>
        <a href="https://wa.me/qr/7MEFLWMQEV6OG1" target="_blank"><img src="assets/img/whatsapp.png" class="icon-reseau" alt=""></a>
        <a href="#" target="_blank"><img src="assets/img/instagram.png" class="icon-reseau" alt=""></a>
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/purecounter/purecounter.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script type="text/javascript">
    const slides = document.querySelectorAll('.slide')
    const next = document.querySelector('.next')
    const prev = document.querySelector('.prev')
    let active = 0
    slides[active].classList.add('active')
    
    // next slide function
    const nextSlide = () =>{
      active++
      slides.forEach(slide => {
        slide.classList.remove('active')
      })
      if(active === slides.length){
        active = 0
      }
      
      slides[active].classList.add('active')
      
    }
    
    // previous slide function
    const prevSlide = () =>{
      active--
      slides.forEach(slide => {
        slide.classList.remove('active')
      })
      if(active === 0){
        active = slides.length - 1
      }
      
      slides[active].classList.add('active')
      
    }
    
    next.addEventListener('click', nextSlide)
    prev.addEventListener('click', prevSlide)
    
    // auto play
     setInterval(() =>{
       nextSlide()
     }, 5000)
</script> 
</body>

</html>
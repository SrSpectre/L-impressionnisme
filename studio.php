<?php 
  session_start();
  $cart = [];
  $_SESSION["cart"] = $cart;
?>
<!DOCTYPE html>
<html id="root" lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="static/ico/icon.svg" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="style/studio.css">
    <link rel="stylesheet" href="style/login.css">
    <title>L'impressionnisme</title>
  </head>
  <body>
    <div id="app">
      <div class="studio">
        <section class="intro-studio">
          <div class="about-us">
            <div class="bienvenue-text">L’impressionnisme es un estudio enfocado en el arte del estilo Impresionismo creado por Yesua Santillan.</div>
            <div class="our-details">
              Nuestro trabajo va desde la busqueda de la historia que representa la pintura, detalles, pintado, así cómo la creatividad de crear algunas pinturas nosotros.
              Puede solicitar alguna pintura a través de:
            </div>
            <div class="contact-us">
              <div class="ways">
                <span class="way" >Email</span>
                <span class="way" >Instagram</span>
                <span class="way" >Facebook</span>
              </div>
              <div class="contacts">
                <span class="social" >contact@limpressionisme.art</span>
                <span class="social" >@limpressionismeinc</span>
                <span class="social" >limpressionismeinc</span>
              </div>
            </div>
          </div>
          <div class="studio-img"></div>
          <div class="end-hero">
            <div class="hero-title-container">
              <div class="hero-title">L’impressionnisme</div>
            </div>
            <div class="hero-title-container">
              <div class="hero-title-rev">L’impressionnisme</div>
            </div>
          </div>
        </section>
        <section class="footer">
          <div class="footer-container">
            <div class="next-section flex">
              <a href="/">
                <img src="./static/ico/next.svg" alt="Next section icon">
                Home
              </a>
            </div>
            <div class="footer-details flex">
              Designed and developed with love by Yesua Santillan.<br>
              Impressionnisme<br>
              @2021 All rights reserved<br>
            </div>
          </div>
        </section>
      </div>
    </div>

    <div class="logo"></div>

    <button class="hamburger-button" type="button">
      <span class="hamburger-line"></span>
      <span class="hamburger-line"></span>
    </button>

    <?php
      if(isset($_SESSION["name"])) {
        echo '
        <div class="floating-right">
          <div panel-link="account">Salut '.$_SESSION["name"].'!</div>
          <a href="src/php/logout.php">Salir</a>
        </div> 
        ';
      }
      else {
        echo '
          <div class="floating-right">
          <div id="login" panel-link="login">Ingresar</div>
          <div id="signup" panel-link="register">Registrarse</div>
          </div>  
        ';
      }
    ?>

    <div class="menu">
      <div class="box-container">
        <div class="margin-container">
          <div class="margin-title">L’impressionnisme</div>
        </div>
        <div class="margin-content">
          <div class="menu-opt">
            <a href="/" class="opt">Inicio</a>
            <a href="/studio" class="opt">Estudio</a>
            <?php
              if(isset($_SESSION["name"]))
                echo '<a href="src/php/logout.php" class="opt">Salir</a>';
              else
                echo '<a id="menuLogin" href="#" class="opt">Ingresar</a> ';
            ?>            
          </div>
        </div>
        <div class="margin-container">
          <div class="margin-title-rev">L’impressionnisme</div>
        </div>
      </div>
      <img class="close-menu close-ico" src="./static/ico/cross-light.svg" alt="close icon">
    </div>

    <div class="cursor"></div>
    <div class="mini-cursor"></div>
    <div class="mini-cursor"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/gsap.min.js" integrity="sha512-eP6ippJojIKXKO8EPLtsUMS+/sAGHGo1UN/38swqZa1ypfcD4I0V/ac5G3VzaHfDaklFmQLEs51lhkkVaqg60Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/ScrollTrigger.min.js" integrity="sha512-CPA5LMoJI/a5HkSIAKcBtFXe4gqGjPUL2ExF/3PmhrrHI17wod9xOqqF+0WZQRKIIq0KwF8oG5BaiWobtrke3A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="module" src="src/js/studio.js"></script>
    <script type="module" src="src/js/main.js"></script>
    <script type="module" src="src/js/router.js"></script>
  </body>
</html>

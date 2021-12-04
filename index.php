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
    <link rel="stylesheet" href="style/cart.css">
    <link rel="stylesheet" href="style/login.css">
    <title>L'impressionnisme</title>
  </head>
  <body>
    <div id="app">
      <div class="home">
        <section class="in-hero box-container">
          <div class="margin-content">
            <div class="hero-title-container">
              <div class="hero-title">L’impressionnisme</div>
            </div>
            <div class="hero-title-container">
              <div class="hero-title-rev">L’impressionnisme</div>
            </div>
          </div>
          <div class="margin-container">
            <div class="scroll-ic-container">
              <div class="scroll-ic">
                <div class="scroll-ball"></div>
              </div>
            </div>
          </div>          
        </section>
        <section class="paintings top-space">
          <div class="paintures-title">Peintures</div>
          <div class="showcase">
            <?php
              $conn = include './src/php/db_conn.php';
              if($conn) {
                $sql = "SELECT * FROM peintures WHERE stock=true ORDER BY rand()";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $image = "background-image: url('./static/".$row["img_name"]."');";
                    $price = number_format($row["price"]);

                    echo '
                      <div class="paint-card" data-name="'.$row["name"].'">
                        <div class="paint-title">'.$row["name"].'</div>
                        <div class="card-img" style="'.$image.'" data-img="'.$row["img_name"].'">
                          <div class="img-slider"></div>
                        </div>
                        <div class="paint-details">'.$row["year"].'<br>'.$row["painter"].'</div>
                        <div class="paint-price">$'.$price.'<span>.00</span></div>
                        <img class="cart-ico" src="./static/ico/cart.svg" alt="Add icon">
                      </div>
                    ';
                  }
                }

                $conn->close();
              }
            ?>
          </div>
        </section>
        <section class="info top-space">
          <div class="info-container">
            <span class="divider"></span>
            <div class="details">
              Fue un movimiento estético, que tuvo sus inicios y desarrollo en Francia a finales del siglo XIX. De temáticas cotidianas, las obras se realizaban in situ, y a menudo en una sola sesión.
            </div>
            <div class="details">
              Con breves pinceladas, se representaba cómo actuaba la luz sobre ellos, para que fuera el ojo humano el que mezclara los colores, obteniendo una apariencia más viva de la realidad.
            </div>
            <div class="divider-text">
              L’impressionnisme - Claude Monet - Pierre-Auguste Renoir - Henri Martin - Joaquín Sorolla - Guy Rose - Painture
            </div>
            <span class="divider"></span>
          </div>
        </section>
        <section class="footer">
          <div class="footer-container">
            <div class="footer-details flex">
              Designed and developed with love by Yesua Santillan.<br>
              Impressionnisme<br>
              @2021 All rights reserved<br>
            </div>
            <div class="next-section flex">
              <a href="/studio">
                Estudio
                <img src="./static/ico/next.svg" alt="Next section icon">
              </a>
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

    <div class="cart box-container">
      <div class="margin-container">
        <div class="margin-title">L’impressionnisme</div>
      </div>
      <div class="margin-content">
        <div class="cart-content">
          <div class="mini-showcase"></div>
          <div class="to-container">
            <img id="to-pay" class="to-button" src="./static/ico/next-black.svg" alt="transaction icon">
          </div>
        </div>
        <div class="cart-content">
          <div class="card-view"></div>
        </div>     
      </div>
      <div class="margin-container">
        <div class="margin-title-rev">L’impressionnisme</div>
      </div>
      <img class="open-cart" src="./static/ico/cart.svg" alt="cart icon">
      <div class="mini-pic"></div>
      <img class="close-cart close-ico" src="./static/ico/cross.svg" alt="close icon">
    </div>

    <div class="cursor"></div>
    <div class="mini-cursor"></div>
    <div class="mini-cursor"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/gsap.min.js" integrity="sha512-eP6ippJojIKXKO8EPLtsUMS+/sAGHGo1UN/38swqZa1ypfcD4I0V/ac5G3VzaHfDaklFmQLEs51lhkkVaqg60Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/ScrollTrigger.min.js" integrity="sha512-CPA5LMoJI/a5HkSIAKcBtFXe4gqGjPUL2ExF/3PmhrrHI17wod9xOqqF+0WZQRKIIq0KwF8oG5BaiWobtrke3A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="module" src="src/js/home.js"></script>
    <script type="module" src="src/js/main.js"></script>
    <script type="module" src="src/js/router.js"></script>

    <script>
      function isEmpty(str) {
        let trimed = str.trim();
        return (!trimed || trimed.length === 0 );
      }

      function alertDialog(message) {
        if (!isEmpty(message)) {
          const container = document.createElement('div');
          container.classList.add('message-box');
          container.innerHTML = message;
          document.body.appendChild(container);

          gsap.to(container, { translateY: '-100%', duration: 0.5 });
          gsap.to(container, { 
            translateY: '100%', 
            duration: 0.5, 
            delay: 2, 
            onComplete: function() {
              container.remove();
            } 
          });
        }
      }

      let inUser = false;
      function verifyLogin() {
        return inUser;
      }

      let regUser = false;
      let regEmail = false;
      function verifyRegister() {
        return regUser && regEmail && checkPswd();
      }

      function loginUser() {
        let user = document.forms["loginForm"]["user"].value;
        if (!isEmpty(user)) {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              if(this.responseText == 0) {
                alertDialog("Ese usuario no existe");
                inUser = false;
              } else inUser = true;
            }
          };
          xmlhttp.open("GET", "src/php/check_account.php?user=" + user, true);
          xmlhttp.send();
        }
      }

      function registerUser() {
        let user = document.forms["registerForm"]["user"].value;
        if (!isEmpty(user)) {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              if(this.responseText == 1) {
                alertDialog("Ese usuario ya existe");
                regUser = false;
              } else regUser = true;
            }
          };
          xmlhttp.open("GET", "src/php/check_account.php?user=" + user, true);
          xmlhttp.send();
        }
      }

      function registerEmail() {
        let email = document.forms["registerForm"]["email"].value;
        if (!isEmpty(email)) {
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
              if(this.responseText == 1) {
                alertDialog("Ese usuario ya existe");
                regEmail = false;
              } else regEmail = true;
            }
          };
          xmlhttp.open("GET", "src/php/check_account.php?email=" + email, true);
          xmlhttp.send();
        }
      }

      function checkPswd() {
        let pswd1 = document.forms["registerForm"]["pswd"].value;
        let pswd2 = document.forms["registerForm"]["rpswd"].value;
        if (!isEmpty(pswd1) && !isEmpty(pswd2)) {
          if(pswd1 !== pswd2) {
            alertDialog("Las contraseñas son diferentes");
            return false;
          } else return true;
        }
        return false;
      }
    </script>
  </body>
</html>

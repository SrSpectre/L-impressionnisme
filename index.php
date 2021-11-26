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
              setlocale(LC_MONETARY, 'en_US');
              $servername = 'localhost';
              $username = 'root';
              $password = 'My_Data_Bases1';
              $dbname = 'limpressionnisme';

              // Create connection
              $conn = new mysqli($servername, $username, $password, $dbname);

              // Check connection
              if ($conn->connect_error) {
                die('Connection failed: ' . $conn->connect_error);
              }
              else {
                $sql = 'SELECT * FROM peintures WHERE stock=true ORDER BY rand()';
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                    $image = "background-image: url('./static/".$row["img_name"]."');";
                    $price = number_format($row["price"]);

                    echo '
                      <div class="paint-card" data-name="'.$row["name"].'">
                        <div class="paint-title">'.$row["name"].'</div>
                        <div class="card-img" style="'.$image.'" data-img="'.$row["img_name"].'">
                          <div class="click-ic">
                            <div class="click-btn"></div>
                          </div>
                          <div class="img-slider"></div>
                        </div>
                        <div class="paint-details">'.$row["year"].'<br>'.$row["painter"].'</div>
                        <div class="paint-price">$'.$price.'<span>.00</span></div>
                        <img class="cart-ico" src="./static/ico/cart.svg" alt="Add icon">
                      </div>
                    ';
                  }
                }
              }

              $conn->close();
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
              Estudio
              <img src="./static/ico/next.svg" alt="Next section icon">
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
          <div>Salut '.$_SESSION["name"].'!</div>
          <a href="src/php/logout.php">Salir</a>
        </div> 
        ';
      }
      else {
        echo '
          <div class="floating-right">
            <div id="login">Ingresar</div>
            <div id="signup">Registrarse</div>
          </div>  
        ';
      }
    ?>

    <div class="slider" style="background-color: #DBCFBD;">
      <div class="big-title" style="color: #515151;">L’impressionnisme</div>
      <div class="big-title-rev" style="color: #F3ECDC;">L’impressionnisme</div>
    </div>
    <div class="slider" style="background-color: #F9E6D6;">
      <div class="big-title" style="color: #DBCFBD;">L’impressionnisme</div>
      <div class="big-title-rev" style="color: #515151;">L’impressionnisme</div>
    </div>

    <div class="menu">
      <div class="box-container">
        <div class="margin-container">
          <div class="margin-title">L’impressionnisme</div>
        </div>
        <div class="margin-content">
          <div class="menu-opt">
            <a href="#" class="opt">Inicio</a>
            <a href="#" class="opt">Estudio</a>
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

    <div class="big-img"></div>
    <div class="painture-details">
      <div class="content"></div>
      <img class="close-details close-ico" src="./static/ico/cross-light.svg" alt="close icon">   
    </div>    

    <div class="cart box-container">
      <div class="margin-container">
        <div class="margin-title">L’impressionnisme</div>
      </div>
      <div class="margin-content">
        <div class="mini-showcase"></div>
      </div>
      <div class="margin-container">
        <div class="margin-title-rev">L’impressionnisme</div>
      </div>
      <img class="open-cart" src="./static/ico/cart.svg" alt="cart icon">
      <div class="mini-pic"></div>
      <img class="close-cart close-ico" src="./static/ico/cross.svg" alt="close icon">
    </div>

    <div class="login">
      <div class="login-container">
        <div class="login-showcase login-flex"></div>
        <div class="login-data login-flex">
          <div class="box-container">
            <div class="margin-container">
              <div class="margin-title">L’impressionnisme</div>
            </div>
            <div class="margin-content">
              <form id="loginForm" name="loginForm" action="src/php/login.php" onsubmit="return verifyLogin()" method="post">
                <div class="data-container">
                  <div class="input-container">
                    <div class="label">Usuario</div>
                    <input type="text" name="user" onfocusout="loginUser()" required>
                  </div>
                  <div class="input-container">
                    <div class="label">Contraseña</div>
                    <input type="password" name="pswd" required>
                  </div>
                </div>
                <div class="button-container">
                  <input type="submit" value="" class="button">
                </div>
                <div class="register-link">Aún no eres miembro? Unete</div>
              </form>
            </div>
            <div class="margin-container">
              <div class="margin-title-rev">L’impressionnisme</div>
            </div>
          </div>
          <img class="close-login close-ico" src="./static/ico/cross.svg" alt="close icon">
        </div>
      </div>
    </div>

    <div class="register-data">
      <form id="registerForm" name="registerForm" action="src/php/register.php" onsubmit="return verifyRegister()" method="post">
        <div class="left-panel flex-panel">
          <div class="box-container">
            <div class="margin-container">
              <div class="margin-title">L’impressionnisme</div>
            </div>
            <div class="margin-content">
              <div class="data-container">
                <div class="input-container">
                  <div class="label">Usuario</div>
                  <input type="text" name="user" onfocusout="registerUser()" required>
                </div>
                <div class="input-container">
                  <div class="label">Nombre(s)</div>
                  <input type="text" name="name" required>
                </div>
                <div class="input-container">
                  <div class="label">Apellidos</div>
                  <input type="text" name="lname" required>
                </div>
                <div class="input-container">
                  <div class="label">Correo</div>
                  <input type="email" name="email" onfocusout="registerEmail()" required>
                </div>
                <div class="input-container">
                  <div class="label">Contraseña</div>
                  <input type="password" name="pswd" onfocusout="checkPswd()" required>
                </div>
                <div class="input-container">
                  <div class="label">Repite contraseña</div>
                  <input type="password" name="rpswd" onfocusout="checkPswd()" required>
                </div>
                <div class="arrow-container">
                  <img class="next-address" src="./static/ico/next-black.svg" alt="next icon">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="right-panel flex-panel">
          <div class="box-container">
            <div class="margin-content">
              <div class="data-container">
                <div class="arrow-container">
                  <img class="back-address" src="./static/ico/next-black.svg" alt="next icon">
                </div>
                <div class="input-container">
                  <div class="label">Estado</div>
                  <input type="text" name="state" required>
                </div>
                <div class="input-container">
                  <div class="label">Ciudad</div>
                  <input type="text" name="town" required>
                </div>
                <div class="input-container">
                  <div class="label">Colonia</div>
                  <input type="text" name="colony" required>
                </div>
                <div class="input-container">
                  <div class="label">Dirección</div>
                  <input type="text" name="address" required>
                </div>
                <div class="input-container">
                  <div class="label">Código postal</div>
                  <input type="text" name="zip" minlength="5" maxlength="5" required>
                </div>
                <div class="button-container">
                  <input type="submit" value="" class="button">
                </div>
              </div>
            </div>
            <div class="margin-container">
              <div class="margin-title-rev">L’impressionnisme</div>
            </div>
          </div>
        </div>      
      </form>
      <img class="close-reg close-ico" src="./static/ico/cross.svg" alt="close icon">
    </div>

    <div class="message-box"></div>

    <div class="cursor"></div>
    <div class="mini-cursor"></div>
    <div class="mini-cursor"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/gsap.min.js" integrity="sha512-eP6ippJojIKXKO8EPLtsUMS+/sAGHGo1UN/38swqZa1ypfcD4I0V/ac5G3VzaHfDaklFmQLEs51lhkkVaqg60Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/ScrollTrigger.min.js" integrity="sha512-CPA5LMoJI/a5HkSIAKcBtFXe4gqGjPUL2ExF/3PmhrrHI17wod9xOqqF+0WZQRKIIq0KwF8oG5BaiWobtrke3A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="module" src="src/js/main.js"></script>
    <script>
      function isEmpty(str) {
        let trimed = str.trim();
        return (!trimed || trimed.length === 0 );
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
                document.querySelector('.message-box').innerHTML = "Ese usuario no existe";
                gsap.to('.message-box', { translateY: '-100%', duration: 0.5 });
                gsap.to('.message-box', { translateY: '100%', duration: 0.5, delay: 2 });
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
                document.querySelector('.message-box').innerHTML = "Ese usuario ya existe";
                gsap.to('.message-box', { translateY: '-100%', duration: 0.5 });
                gsap.to('.message-box', { translateY: '100%', duration: 0.5, delay: 2 });
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
                document.querySelector('.message-box').innerHTML = "Ese usuario ya existe";
                gsap.to('.message-box', { translateY: '-100%', duration: 0.5 });
                gsap.to('.message-box', { translateY: '100%', duration: 0.5, delay: 2 });
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
            document.querySelector('.message-box').innerHTML = "Las contraseñas son diferentes";
            gsap.to('.message-box', { translateY: '-100%', duration: 0.5 });
            gsap.to('.message-box', { translateY: '100%', duration: 0.5, delay: 2 });
            return false;
          } else return true;
        }
        return false;
      }
    </script>
  </body>
</html>

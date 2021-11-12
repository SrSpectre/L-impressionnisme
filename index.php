<!DOCTYPE html>
<html id="root" lang="en">
  <head>
    <meta charset="UTF-8" />
    <link rel="icon" type="image/svg+xml" href="static/ico/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style/style.css">
    <title>L'impressionnisme</title>
  </head>
  <body>
    <div id="app">
      <div class="home">
        <section class="in-hero">
          <div class="hero-title">L’impressionnisme</div>
          <div class="hero-title-rev">L’impressionnisme</div>
          <div class="scroll-ic">
            <div class="scroll-ball"></div>
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
                $sql = 'SELECT * FROM peintures ORDER BY rand()';
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                  while($row = $result->fetch_assoc()) {
                    $image = "background-image: url('./static/".$row["img_name"]."');";
                    $price = number_format($row["price"]);
                    echo '
                      <div class="paint-card">
                        <div class="paint-title">'.$row["name"].'</div>
                        <div class="card-img" style="'.$image.'">
                          <div class="click-ic">
                            <div class="click-btn"></div>
                          </div>
                          <div class="img-slider"></div>
                        </div>
                        <div class="paint-details">'.$row["year"].'<br>'.$row["painter"].'</div>
                        <div class="paint-price">$'.$price.'<span>.00</span></div>
                        <img class="cart-ico" src="./static/ico/cart.svg" alt="Add icon" data-img="'.$row["img_name"].'">
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

    <button class="hamburger-button" type="button">
      <span class="hamburger-line"></span>
      <span class="hamburger-line"></span>
    </button>

    <div class="sigup">
      <a href="#">Ingresar</a>
      <a href="#">Registrarse</a>
    </div>

    <div class="load-slider">
      <div class="load-title">L’impressionnisme</div>
      <div class="load-title-inv">L’impressionnisme</div>
      <div class="load-title-mini">L’impressionnisme</div>
      <div class="load-title-mini-inv">L’impressionnisme</div>
      <div class="load-title-rev">L’impressionnisme</div>
      <div class="load-title-rev-inv">L’impressionnisme</div>
      <div class="load-title-mini-rev">L’impressionnisme</div>
      <div class="load-title-mini-rev-inv">L’impressionnisme</div>
    </div>

    <div class="cart">
      <img class="open-cart" src="./static/ico/cart.svg" alt="cart icon">
      <div class="mini-pic"></div>
      <img class="close-ico" src="./static/ico/cross.svg" alt="close icon">
    </div>

    <div class="slider" style="background-color: #DBCFBD;">
      <div class="big-title" style="color: #515151;">L’impressionnisme</div>
      <div class="big-title-rev" style="color: #F3ECDC;">L’impressionnisme</div>
    </div>
    <div class="slider" style="background-color: #F9E6D6;">
      <div class="big-title" style="color: #DBCFBD;">L’impressionnisme</div>
      <div class="big-title-rev" style="color: #515151;">L’impressionnisme</div>
    </div>

    <div class="menu">
      <div class="margin-title">L’impressionnisme</div>
      <div class="margin-title-rev">L’impressionnisme</div>
      <div class="menu-opt">
        <a href="#" class="opt">Inicio</a>
        <a href="#" class="opt">Estudio</a>
        <a href="#" class="opt">Ingresar</a>
      </div>
    </div>

    <div class="cursor"></div>
    <div class="mini-cursor"></div>
    <div class="mini-cursor"></div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/gsap.min.js" integrity="sha512-eP6ippJojIKXKO8EPLtsUMS+/sAGHGo1UN/38swqZa1ypfcD4I0V/ac5G3VzaHfDaklFmQLEs51lhkkVaqg60Q==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.8.0/ScrollTrigger.min.js" integrity="sha512-CPA5LMoJI/a5HkSIAKcBtFXe4gqGjPUL2ExF/3PmhrrHI17wod9xOqqF+0WZQRKIIq0KwF8oG5BaiWobtrke3A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script type="module" src="src/main.js"></script>
  </body>
</html>

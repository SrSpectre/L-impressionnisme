<?php
    session_start();
    if(isset($_SESSION["cart"])) {
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
            $cart = $_SESSION["cart"]; // painture name

            foreach ($cart as &$painture) {
                $sql = 'SELECT * FROM peintures WHERE name="'.$painture.'" LIMIT 1';
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    if($row = $result->fetch_assoc()) {
                        $image = "background-image: url('./static/".$row["img_name"]."');";
                        $price = number_format($row["price"]);

                        echo '
                            <div class="mini-card">
                                <div class="card-price">$'.$price.'<span>.00</span></div>
                                <div class="card-img" style="'.$image.'"></div>
                                <div class="card-details">'.$row["painter"].'<br>'.$row["name"].'</div>
                                <img class="delete" src="./static/ico/delete.svg" alt="delete icon" data-name="'.$row["name"].'">
                            </div>
                        ';
                    }
                }
            }
        }

        $conn->close();
    }
?>
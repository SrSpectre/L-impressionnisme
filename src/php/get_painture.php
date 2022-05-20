<?php
$name = $_GET['name'];

if ($name !== "") {
    $conn = include './db_conn.php';
    if($conn) {
        $sql = "SELECT * FROM peintures WHERE name='$name' LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()) {
                $image = "background-image: url('./static/".$row["img_name"]."');";
                $price = number_format($row["price"]);

                echo '
                    <div class="info">
                        <div class="painture-title">'.$row["name"].'</div>
                        <div class="painture-text">'.$row["painter"].'<br>'.$row["dimens"].'<br>'.$row["technique"].'<br>'.$row["year"].'</div>
                        <div class="price-container">
                            <a href="../static/'.$row["img_name"].'" download="'.$row["name"].'">
                                <img class="add-ico" src="./static/ico/add.svg" alt="add icon" data-name="'.$row["name"].'">
                            </a>
                            <div class="painture-price">$'.$price.'<span>.00</span></div>
                        </div>
                    </div>
                    <div class="painture-img" style="'.$image.'"></div>
                ';
            }
        }

        $conn->close();
    }
}
?>
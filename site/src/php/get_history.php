<?php
session_start();

if(isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
    $conn = include './db_conn.php';
    if($conn) {
        $sql = "SELECT id FROM users WHERE uname='$user' LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()) {
                $id = $row["id"];
                $sql = "SELECT * FROM histories WHERE id_user='$id'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $historyId = $row["id"];
                        $sql2 = "SELECT * FROM history_items WHERE id_history='$historyId'";
                        $result2 = $conn->query($sql2);

                        echo '
                            <div class="history-date">'.$row["timestamp"].'</div>
                            <div class="history-items">
                        ';

                        if ($result2->num_rows > 0) {
                            while ($row2 = $result2->fetch_assoc()) {
                                $peintureId = $row2['id_peinture'];
                                $sql3 = "SELECT * FROM peintures WHERE id='$peintureId' LIMIT 1";
                                $result3 = $conn->query($sql3);

                                if ($result3->num_rows > 0) {
                                    if ($row3 = $result3->fetch_assoc()) {
                                        echo '
                                            <div class="history-item">
                                                <img src="../../static/'.$row3["img_name"].'">
                                                <div class="item-details-container">
                                                    <div class="item-details">
                                                        <div class="item-title">'.$row3["name"].'</div>
                                                        <div class="item-price">$'.$row3["price"].'<span>.00</span></div>
                                                    </div>
                                                </div>  
                                            </div>
                                        ';
                                    }
                                }
                            }
                        }

                        echo '</div>';
                    }
                }
            }                        
        }

        $conn->close();
    }
}
?>
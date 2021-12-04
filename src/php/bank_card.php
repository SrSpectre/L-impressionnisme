<?php
session_start();

if(isset($_SESSION["user"])) {
    $conn = include './db_conn.php';
    $user = $_SESSION["user"];
    if($conn) {
        $sql = "SELECT * FROM users WHERE uname='$user' LIMIT 1";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()) {
                $sql = "SELECT * FROM bank_cards WHERE id_user='".$row['id']."' LIMIT 1";
                $result = $conn->query($sql);

                $cardNum = '';
                $cardDate = '';
                $cardName = '';
                $cardCVV = '';
                if ($result->num_rows > 0) {
                    if($row = $result->fetch_assoc()) {
                        $cardNum = $row['number'];
                        $cardDate = $row['exp_date'];
                        $cardName = $row['name'];
                        $cardCVV = $row['cvv'];
                    }
                }

                echo '
                <form name="bankCardForm" action="src/php/transaction.php" method="post">
                    <div class="card-container">
                        <div class="card-flex">
                            <div class="card-shape">
                            <div class="card-info">
                                <input type="text" name="number" class="card-number large-field" placeholder="XXXX XXXX XXXX XXXX" minlength="19" maxlength="19" value="'.$cardNum.'" required>
                                <input type="text" name="date" class="card-date" placeholder="MM/YY" value="'.$cardDate.'" minlength="5" maxlength="5" required>
                                <input type="text" name="name" class="card-number large-field" placeholder="Nombre del propietario" value="'.$cardName.'" required>
                            </div>
                            </div>
                        </div>
                        <div class="card-flex">
                            <div class="card-shape">
                            <div class="card-line"></div>
                            <div class="card-cvv">
                                <input type="text" name="cvv" placeholder="XXX" minlength="3" maxlength="3" value="'.$cardCVV.'" required>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="button-container">
                        <input type="submit" value="" class="button">
                    </div>
                </form>
                ';
            }
        }
        else echo FALSE;

        $conn->close();
    }
}
else echo FALSE;
?>
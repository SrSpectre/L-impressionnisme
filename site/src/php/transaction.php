<?php
$number = trim($_POST['number']);
$date = trim($_POST['date']);
$name = trim($_POST['name']);
$cvv = trim($_POST['cvv']);

session_start();
$cart = $_SESSION["cart"];

if(isset($_SESSION["user"]) && count($cart) > 0) {
    $user = $_SESSION["user"];
    if (!empty($number) && !empty($date) && !empty($name) && !empty($cvv)) {
        $conn = include './db_conn.php';
        if($conn) {
            $sql = "SELECT id FROM users WHERE uname='$user' LIMIT 1";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                if($row = $result->fetch_assoc()) {
                    $id = $row["id"];
                    $sql = "SELECT * FROM bank_cards WHERE id_user='$id' LIMIT 1";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0)
                        $sql = "UPDATE bank_cards SET number='$number', exp_date='$date', name='$name', cvv='$cvv' WHERE id_user=$id";
                    else
                        $sql = "INSERT INTO bank_cards (id_user, number, exp_date, name, cvv) VALUES ('$id', '$number', '$date', '$name', '$cvv')";

                    $result = $conn->query($sql);

                    $sql = "SELECT id FROM bank_cards WHERE id_user='$id' LIMIT 1";
                    $result = $conn->query($sql);
                    $sql2 = "SELECT id FROM addresses WHERE id_user='$id' LIMIT 1";
                    $result2 = $conn->query($sql2);

                    if ($result->num_rows > 0 && $result2->num_rows > 0) {
                        if($row = $result->fetch_assoc() && $row2 = $result2->fetch_assoc()) {
                            $bankId = $row['id'];
                            $addressId = $row2['id'];
                            $total = 100;
                            $timestamp = date("Y-m-d H:i:s");
                            $sql = "INSERT INTO histories (id_user, id_bank_card, id_address, total, timestamp) VALUES ('$id', '$bankId', '$addressId', '$total', '$timestamp')";
                            $result = $conn->query($sql);

                            if($result) {
                                $sql = "SELECT id FROM histories WHERE id_user='$id' AND timestamp='$timestamp' LIMIT 1";
                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    if($row = $result->fetch_assoc()) {
                                        $historyId = $row['id'];
                                        foreach ($cart as &$painture) {
                                            $sql = "SELECT id FROM peintures WHERE name='$painture' LIMIT 1";
                                            $result = $conn->query($sql);

                                            if ($result->num_rows > 0) {
                                                if($row = $result->fetch_assoc()) {
                                                    $peintureId = $row['id'];
                                                    $sql = "INSERT INTO history_items (id_history, id_peinture) VALUES ('$historyId', '$peintureId')";
                                                    $result = $conn->query($sql);
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }                        
            }

            $conn->close();
        }
        header('Location: ../../index.php');
    }
}
?>
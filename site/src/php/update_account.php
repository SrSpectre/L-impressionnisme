<?php
$name = trim($_POST['name']);
$lname = trim($_POST['lname']);
$email = trim($_POST['email']);
$pswd = trim($_POST['pswd']);
$rpswd = trim($_POST['rpswd']);
$state = trim($_POST['state']);
$town = trim($_POST['town']);
$colony = trim($_POST['colony']);
$address = trim($_POST['address']);
$zip = trim($_POST['zip']);

session_start();

if(isset($_SESSION["user"])) {
    $user = $_SESSION["user"];
    if (!empty($name) && !empty($lname) && !empty($email) && !empty($state) && !empty($town) && !empty($colony) && !empty($address) && !empty($zip)) {
        $conn = include './db_conn.php';
        if($conn) {
            $sql = "UPDATE users SET name='$name', lname='$lname', email='$email' ";

            if(!empty($pswd) && !empty($pswd)) {
                $pswd = md5($pswd);
                $rpswd = md5($rpswd);
                if($pswd == $rpswd)
                    $sql = $sql."pswd='$pswd' ";
            }

            $sql = $sql."WHERE uname='$user'";
            $result = $conn->query($sql);

            $sql = "SELECT id FROM users WHERE uname='$user' OR email='$email' LIMIT 1";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                if($row = $result->fetch_assoc()) {
                    $id = $row["id"];
                    $sql = "UPDATE addresses SET state='$state', town='$town', colony='$colony', address='$address', zip_code=$zip WHERE id_user=$id";
                    $result = $conn->query($sql);
                }                        
            }

            $conn->close();
        }
        header('Location: ../../index.php');
    }
}
?>
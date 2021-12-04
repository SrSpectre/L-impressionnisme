<?php
$user = trim($_POST['user']);
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

if (!empty($user) && !empty($name) && !empty($lname) && !empty($email) && !empty($pswd) && !empty($rpswd) && !empty($state) && !empty($town) && !empty($colony) && !empty($address) && !empty($zip)) {
    $pswd = md5($pswd);
    $rpswd = md5($rpswd);
    if($pswd == $rpswd) {
        $conn = include './db_conn.php';
        if($conn) {
            $sql = "SELECT * FROM users WHERE uname='$user' OR email='$email'";
            $result = $conn->query($sql);

            if ($result->num_rows <= 0) {
                $sql = "INSERT INTO users (uname, name, lname, email, pswd) VALUES ('$user', '$name', '$lname', '$email', '$pswd')";
                $result = $conn->query($sql);

                if($result) {
                    $sql = "SELECT id FROM users WHERE uname='$user' OR email='$email' LIMIT 1";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        if($row = $result->fetch_assoc()) {
                            $id = $row["id"];
                            $sql = "INSERT INTO addresses (id_user, state, town, colony, address, zip_code) VALUES ('$id', '$state', '$town', '$colony', '$address', '$zip')";
                            $result = $conn->query($sql);
                            echo $result;
                        }                        
                    }
                    else echo FALSE;
                }
                else echo FALSE;
            }
            else echo FALSE;

            $conn->close();
        }
        header('Location: ../../index.php');
    }    
}
?>
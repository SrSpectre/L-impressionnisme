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
    if($pswd == $rpswd) {
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
            $sql = 'SELECT * FROM users WHERE uname="'.$user.'" OR email="'.$email.'"';
            $result = $conn->query($sql);

            if ($result->num_rows <= 0) {
                $sql = 'INSERT INTO users (uname, name, lname, email, pswd) VALUES ("'.$user.'", "'.$name.'", "'.$lname.'", "'.$email.'", "'.$pswd.'")';
                $result = $conn->query($sql);

                if($result = TRUE) {
                    $sql = 'SELECT id FROM users WHERE uname="'.$user.'" OR email="'.$email.'" LIMIT 1';
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        if($row = $result->fetch_assoc()) {
                            $sql = 'INSERT INTO address (id_user, state, town, colony, address, zip_code) VALUES ("'.$row["id"].'", "'.$state.'", "'.$town.'", "'.$colony.'", "'.$address.'", "'.$zip.'")';
                            $result = $conn->query($sql);
                            echo $result;
                        }                        
                    }
                    else echo FALSE;
                }
                else echo FALSE;
            }
            else echo FALSE;
        }
        header('Location: ../../index.php');

        $conn->close();
    }    
}
?>
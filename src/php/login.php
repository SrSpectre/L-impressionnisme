<?php
$user = $_POST['user'];
$pswd = $_POST['pswd'];

if (!empty($user) && !empty($pswd)) {
    setlocale(LC_MONETARY, 'en_US');
    $servername = 'localhost';
    $username = 'root';
    $password = 'My_Data_Bases1';
    $dbname = 'limpressionnisme';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error)
        die('Connection failed: ' . $conn->connect_error);
    else {
        $sql = 'SELECT * FROM users WHERE uname="'.$user.'" AND pswd="'.$pswd.'"';
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc())
                session_start();
                $_SESSION["user"] = $row["user"];
                $_SESSION["name"] = $row["name"];
                header('Location: ../../index.php');
        }
    }

    $conn->close();
}
?>
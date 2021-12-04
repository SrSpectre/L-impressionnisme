<?php
$user = $_POST['user'];
$pswd = $_POST['pswd'];

if (!empty($user) && !empty($pswd)) {
    $pswd = md5($pswd);
    $conn = include './db_conn.php';
    if($conn) {
        $sql = "SELECT * FROM users WHERE uname='$user' AND pswd='$pswd'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            if($row = $result->fetch_assoc()) {
                session_start();
                $_SESSION["user"] = $row["uname"];
                $_SESSION["name"] = $row["name"];
            }
            header('Location: ../../index.php');
        }
        $conn->close();
    }
}
?>
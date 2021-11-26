<?php
if (!empty($_GET['user']) || !empty($_GET['email'])) {
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
        $field = (!empty($_GET['user'])) ? 'uname="'.$_GET['user'].'"' : 'email="'.$_GET['email'].'"';
        $sql = 'SELECT * FROM users WHERE'.' '.$field;
        $result = $conn->query($sql);

        if ($result->num_rows > 0)
            echo TRUE;
        else echo FALSE;
    }

    $conn->close();
}
?>
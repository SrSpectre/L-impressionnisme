<?php
    setlocale(LC_MONETARY, 'en_US');
    $servername = 'projectdb';
    $port = 3306;
    $username = 'root';
    $password = 'root1234';
    $dbname = 'limpressionnisme';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname, $port);

    // Check connection
    if ($conn->connect_error) die('Connection failed: ' . $conn->connect_error);
    else return $conn;
    return null;
?>
<?php
    setlocale(LC_MONETARY, 'en_US');
    $servername = 'localhost';
    $username = 'root';
    $password = 'My_Data_Bases1';
    $dbname = 'limpressionnisme';

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) die('Connection failed: ' . $conn->connect_error);
    else return $conn;
    return null;
?>
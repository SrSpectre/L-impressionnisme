<?php
    $painture = $_GET['painture'];
    if(!empty($painture)) {
        session_start();
        if(isset($_SESSION["cart"])) {
            $cart = $_SESSION["cart"];
            $cart[] = $painture;
            $_SESSION["cart"] = $cart;
        }
    }
?>
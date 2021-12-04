<?php
if (!empty($_GET['user']) || !empty($_GET['email'])) {
    $conn = include './db_conn.php';
    if($conn) {
        $field = (!empty($_GET['user'])) ? 'uname="'.$_GET['user'].'"' : 'email="'.$_GET['email'].'"';
        $sql = 'SELECT * FROM users WHERE'.' '.$field;
        $result = $conn->query($sql);

        if ($result->num_rows > 0)
            echo TRUE;
        else echo FALSE;

        $conn->close();
    }
}
?>
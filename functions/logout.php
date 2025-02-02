<?php
    session_start();
    include_once 'config.php';
    $unique_id = $_SESSION['unique_id'];

    if(isset($unique_id)){
        $status = 'offline';
        $sql = "UPDATE users SET status = '$status' WHERE unique_id = '$unique_id'";
        $query = mysqli_query($conn, $sql);
        if($query){
            session_unset();
            session_destroy();
            header('Location: ../login.php');
        }
    }
?>
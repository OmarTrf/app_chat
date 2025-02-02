<?php include_once 'functions/config.php' ?>
<?php
// Select User By Unique Id
function getUserByUniqueId($unique_id){
    global $conn; // Access global connection variable
    $sql = "SELECT * FROM users WHERE unique_id = '$unique_id' LIMIT 1";
    $query = mysqli_query($conn,$sql);
    if(mysqli_num_rows($query) > 0){
        $row = mysqli_fetch_assoc($query);
        return $row;
    }else{
        return null;
    }
}

?>
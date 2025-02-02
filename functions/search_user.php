<?php
session_start();
include_once 'config.php';

$my_id = $_SESSION['unique_id'];
$search_term = mysqli_escape_string($conn, $_POST['search_value']);
$output = "";
$you = "";
$sql = "SELECT * FROM users WHERE (fname LIKE '%$search_term%' OR lname LIKE '%$search_term%' OR email LIKE '%$search_term%') AND unique_id != '$my_id'";
$query = mysqli_query($conn, $sql);

if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        // Get The Latest Message By User ID AND My ID 
        $sql2 = "SELECT * FROM messages 
                WHERE (incoming_msg_id = {$row['unique_id']}
                OR outgoing_msg_id = {$row['unique_id']}) 
                AND (outgoing_msg_id = {$my_id} 
                OR incoming_msg_id = {$my_id}) 
                ORDER BY msg_id DESC LIMIT 1";
        $query2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($query2);
        // Get Message
        $result = (mysqli_num_rows($query2)) ? $row2['msg'] : "No message available";
        $msg = (strlen($result) > 28) ? substr($result, 0, 28) . '...' : $result;
        // Check if the current user sent the message
        if (isset($row2['outgoing_msg_id'])) {
            $you = ($my_id == $row2['outgoing_msg_id']) ? "You: " : "";
        }
        // Check user status (online/offline)
        $user_status = ($row['status'] == 'online') ? "online" : "";
        // Display user details, latest message & his Status 
        $output .= "<a href='user_chat.php?user_id=" . $row['unique_id'] . "' class='user_result'>
                        <div class='user_details'>
                            <img src='./images/{$row['img']}' alt='User Image'>
                            <div>
                                <span class='user_name'>{$row['fname']} {$row['lname']}</span>
                                <p class='text_msg'>" . $you . " " . $msg . "</p>
                            </div>
                        </div>
                        <span class='user_status $user_status'><i class='fas fa-circle'></i></span>
                    </a>";
    }
} else {
    $output .= "No user found related to your search term";
}
echo $output;

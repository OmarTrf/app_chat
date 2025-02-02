<?php
session_start();
include_once 'config.php';

if (!isset($_SESSION['unique_id'])) {
    header('Location: ../login.php');
}

$unique_id = $_SESSION['unique_id'];
$incoming_id = mysqli_real_escape_string($conn, $_POST['incoming_id']);
$output = "";

$sql = "SELECT * FROM messages LEFT JOIN users 
          ON users.unique_id = messages.outgoing_msg_id 
          WHERE outgoing_msg_id = $unique_id AND incoming_msg_id = $incoming_id
          OR outgoing_msg_id = $incoming_id AND incoming_msg_id = $unique_id
          ORDER BY msg_id";
$query = mysqli_query($conn, $sql);
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_assoc($query)) {
        if ($row['incoming_msg_id'] === $unique_id) {
            $output .= '<div class="chat outgoing">
                            <img src="images/' . $row['img'] . '" alt="user_img">
                            <div class="details">
                                <p>' . $row['msg'] . '</p>
                            </div>
                        </div>
                        <div class="clear"></div>';
        } else {
            $output .= '<div class="chat incoming">
                            <div class="details">
                                <p>' . $row['msg'] . '</p>
                            </div>
                        </div>
                        <div class="clear"></div>';
        }
    }
} else {
    $output = '<p class="empty-message">No messages yet.</p>';
}

echo $output;

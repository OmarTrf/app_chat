<?php

while ($row = mysqli_fetch_assoc($query)) {
    $sql2 = "SELECT * FROM messages 
            WHERE (incoming_msg_id = {$row['unique_id']} 
            OR outgoing_msg_id = {$row['unique_id']}) 
            AND (outgoing_msg_id = {$my_id} 
            OR incoming_msg_id = {$my_id}) 
            ORDER BY msg_id DESC LIMIT 1";
    $query2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($query2);
    if ($row2) {
        $result = (mysqli_num_rows($query2) > 0) ? $row2['msg'] : "No message available";
        $msg = (strlen($result) > 28) ? substr($result, 0, 28) . '...' : $result;

        // If messages exist, show the last message
        $last_msg = "";
        $you = "";
        // Check if the current user sent the message
        if (isset($row2['outgoing_msg_id'])) {
            $you = ($my_id == $row2['outgoing_msg_id']) ? "You: " :  "";
        }
        // Check user status (online/offline)
        $offline = ($row['status'] == "offline") ? "offline" : "";
        // Append user to the results list
        $hid_me = ($my_id == $row2['outgoing_msg_id']) ? "hide" : "";
        $output .= '<a href="chat.php?user_id=' . $row2['unique_id'] . '">
                        <div class="content">
                            <img src="../images/' . $row['img'] . '" alt="">
                            <div class="details">
                                <span>' . $row['fname'] . " " . $row['lname'] . '</span>
                                <p>' . $you . $row2['msg'] . '</p>
                            </div>
                            <div class="status_dot ' . $offline . '"><i class="fas fa-circle"></i></div>
                        </div>
                    </a>';
    }
}

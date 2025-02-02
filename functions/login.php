<?php
    session_start();
    include_once 'config.php';


    $email = mysqli_escape_string($conn,$_POST['email']);
    $password = mysqli_escape_string($conn,$_POST['password']);
    $response = [
        "success" => false,
        "message" => ""
    ];

    if(empty($email) || empty($password)){
        $response = [
            "success" => false,
            "message" => "Please fill all fields"
        ];
    }else{
        $sql = "SELECT * FROM users WHERE email='$email' LIMIT 1";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0){
            $row = mysqli_fetch_assoc($query);
            $user_pass = $row['password'];
            $hashed_entred_pass = md5($password);
            if($user_pass == $hashed_entred_pass){
                // Set The Status Of The User
                $status = 'online';
                $user_id = $row['unique_id'];
                $sql_update = "UPDATE users SET status ='$status' WHERE unique_id = '$user_id'";
                $query_update = mysqli_query($conn, $sql_update);
                if($query_update){
                    $_SESSION['unique_id'] = $user_id;
                    $response = [
                        "success" => true,
                        "message" => "Login Successful"
                    ];
                }else{
                    $response = [
                        "success" => false,
                        "message" => "Failed to update user status"
                    ];
                }
            }else{
                $response = [
                    "success" => false,
                    "message" => "Incorrect Email Or password"
                ];
            }
        }else{
            $response = [
                "success" => false,
                "message" => "$email : This email does not exist"
            ];
        }
    }
    echo json_encode($response);
?>
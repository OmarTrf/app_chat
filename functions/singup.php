<?php
    session_start();
    include_once "config.php";

    $fname = mysqli_escape_string($conn,$_POST['first_name']);
    $lname = mysqli_escape_string($conn,$_POST['last_name']);
    $email = mysqli_escape_string($conn,$_POST['email']);
    $password = mysqli_escape_string($conn,$_POST['password']);
    $response = [
        "success" => false,
        "message" => ""
    ];
    if(empty($fname) || empty($lname) || empty($email) || empty($password)){
        $response = [
            "success" => false,
            "message" => "Please Fill All Fields"
        ];
    }else{
        // Check If Email Is Valid Format
        if(filter_var($email, FILTER_VALIDATE_EMAIL)){
            // Check If Email is Exists
            $sql_check_user = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'");
            if(mysqli_num_rows($sql_check_user) > 0){
                $response = [
                    "success" => false,
                    "message" => "This Email Is Already Exists"
                ];
            }else{
                // Check If Image File Is Valid
                if(isset($_FILES['image'])){
                    $img_name = $_FILES['image']['name'];
                    $img_tmp_name = $_FILES['image']['tmp_name'];
                    $img_type = $_FILES['image']['type']; 

                    $img_explode = explode('.', $img_name);
                    $img_ext = end($img_explode);
                    $extensions = ['jpg', 'jpeg', 'png'];

                    if(in_array($img_ext, $extensions)){
                        $new_image_name = time().'.'.$img_ext;
                        if(move_uploaded_file($img_tmp_name,"../images/".$new_image_name)){
                            $rand_id = rand(time(), 100000000);
                            $status = 'online';
                            $encrypt_password = md5($password);
                            // QUERY
                            $sql_insert_user = "INSERT INTO users (unique_id,fname,lname,email,password,img,status) VALUES ('$rand_id','$fname','$lname','$email','$encrypt_password','$new_image_name','$status')";
                            $query_insert_user = mysqli_query($conn, $sql_insert_user);
                            if($query_insert_user){
                                // Query Select User When Insert User
                                $sql_select_user = "SELECT * FROM users WHERE email = '$email'";
                                $query_select_user = mysqli_query($conn, $sql_select_user);
                                $result = mysqli_fetch_assoc($query_select_user);
                                $_SESSION['unique_id'] = $result['unique_id'];
                                $response = [
                                    "success" => true,
                                    "message" => "Registration Successful. You Can Login Now!"
                                ];
                            }else{
                                $response = [
                                     "success" => false,
                                     "message" => "Registration Failed. Please Try Again!"
                                ];
                            }
                            
                        }else{
                            $response = [
                                "success" => false,
                                "message" => "Failed To Upload Image. Please Try Again!"
                            ];
                        }
                    }else{
                        $response = [
                            "success" => false,
                            "message" => "Please Upload An Image File [jpg/jpeg/png]"
                        ];
                    }

                }else{
                    $response = [
                        "success" => false,
                        "message" => "Please Select An Image File"
                    ];
                }
            }
        }else{
            $response = [
                "success" => false,
                "message" => "Please Enter a Valid Email Address"
            ];
        }
    }
    echo json_encode($response);
?>
<?php include_once "header.php" ?>
<body>
    <div class="content">
        <setion class="form singup">
            <h2>Sign Up</h2>
            <form action="" method="post" enctype="multipart/form-data">
                <div class="error_text"></div>
                <div class="name_details">
                    <div class="field_input">
                        <label for="first_name">first name</label>
                        <input type="text" id="first_name" name="first_name" placeholder="First Name" required>
                    </div>
                    <div class="field_input">
                        <label for="last_name">last name</label>
                        <input type="text" id="last_name" name="last_name" placeholder="Last Name" required>
                    </div>
                </div>
                <div class="field_input">
                    <label for="email">email</label>
                    <input type="email" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="field_input">
                    <label for="password">password</label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <i class="fas fa-eye eye_password"></i>
                </div>
                <div class="field_input field_image">
                    <label for="profile_image">Profile Image</label>
                    <input type="file" name="image" id="profile_image" accept="image/x-png,image/gif,image/jpeg,image/jpg" required>
                </div>
                <div class="field_input">
                    <button type="submit" name="submit" class="btn">Sing Up</button>
                </div>
                <p class="link">Already have an account? <a href="login.php" class="link">Login Now</a></p>
            </form>
        </setion>
    </div>
    <!-- Script -->
    <script src="./js/script.js"></script>
</body>
</html>
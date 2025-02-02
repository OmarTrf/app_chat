<?php include_once "header.php" ?>
<?php if(isset($_SESSION['unique_id'])){ header('Location:user.php'); } ?>
<body>
    <div class="content">
        <setion class="form login">
            <h2>Login</h2>
            <form action="" method="post" autocomplete="off">
                <div class="error_text"></div>
                <div class="field_input">
                    <label for="email">email</label>
                    <input type="email" id="email" name="email"  placeholder="Email" required>
                </div>
                <div class="field_input">
                    <label for="password">password</label>
                    <input type="password" id="password" name="password" placeholder="Password" required>
                    <i class="fas fa-eye eye_password"></i>
                </div>
                <div class="field_input">
                    <button type="submit" name="submit" class="btn">Login</button>
                </div>
                <p class="link">Not yet signed up ? <a href="index.php" class="link">Signup Now</a></p>
            </form>
        </setion>
    </div>
    <!-- Script -->
    <script src="./js/script.js"></script>
</body>
</html>
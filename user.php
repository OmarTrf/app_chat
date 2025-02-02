<?php include_once 'functions/function.php' ?>
<?php include_once 'header.php' ?>

<?php
    if(!isset($_SESSION['unique_id'])){ header('Location:login.php'); }
    // Select User By unique_id session
    $user = [];
    $unique_id = $_SESSION['unique_id'];
    
    $user = getUserByUniqueId($unique_id);
?>

<body>
    <div class="content">
        <section class="users">
            <header>
                <div class="container">
                    <img src="images/<?= $user['img'] ?>" alt="">
                    <div class="details">
                        <h4><?= $user['fname'].' '.$user['lname'] ?></h4>
                        <p><?= $user['status'] ?></p>
                    </div>
                </div>
                <a href="functions/logout.php" class="logout">log out</a>
            </header>
            <div class="search">
                <span class="text">Select An User To Start Chat</span>
                <input type="text" name="" placeholder="Enter Name To Search...">
                <button><i class="fas fa-search"></i></button>
            </div>
            <div class="users_list">

            </div>
        </section>
    </div>
    <script src="js/script.js"></script>
</body>
</html>

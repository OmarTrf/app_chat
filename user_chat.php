<?php include_once 'header.php' ?>
<?php include_once 'functions/function.php' ?>

<?php
if (!isset($_SESSION['unique_id'])) {
    header('Location: login.php');
    exit;
}
if (isset($_GET['user_id']) && $_GET['user_id'] != '') {
    $incoming_id = mysqli_real_escape_string($conn, $_GET['user_id']);
    $user = getUserByUniqueId($incoming_id);
    if (!$user) {
        header('Location: user.php');
        exit;
    }
    if ($incoming_id == $_SESSION['unique_id']) {
        header('Location: user.php');
        exit;
    }
} else {
    header('Location: user.php');
    exit;
}
?>

<body>
    <div class="content user_chat">
        <header>
            <a href="user.php" class="back_icon"><i class="fas fa-arrow-left"></i></a>
            <img src="images/<?= $user['img'] ?>" alt="user_img">
            <div class="details">
                <span><?= $user['fname'] . ' ' . $user['lname'] ?></span>
                <p><i class="fas fa-circle <?= $user['status'] ?>"></i><?= $user['status'] ?></p>
            </div>
        </header>
        <div class="chat_box">

        </div>
        <form action="" class="typing_area">
            <input type="text" name="incoming_id" class="incoming_id" value="<?= $user['unique_id'] ?>" hidden>
            <input type="text" name="message" class="input_field" placeholder="Type a message..." autocomplete="off">
            <button class="send" disabled><i class="fab fa-telegram-plane"></i></button>
        </form>
    </div>
    <script src="./js/script.js"></script>
</body>
<?php
if (!empty($_POST['username']) &&
    !empty($_POST['password'])) {

    include './config/config.php';
    include './lib/database.php';

    $db = new DB();

    $username = htmlspecialchars($_POST['username']);
    $password = htmlspecialchars($_POST['password']);

    $sql = "SELECT * FROM users WHERE user_name='" . $db->escape($username) . "' AND password='" . md5($password) . "'";
    $result = $db->get_results($sql);

    if (count($result) == 0) {
        header('location:loginPage.php?error=Wrong+username+or+password');
    } else {
        session_start();

        $_SESSION['loggedIn'] = true;
        $_SESSION['username'] = $result[0]->user_name;
        header('location:index.php');
    }

} else {
    header('location:index.php');
}
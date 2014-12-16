<?php

session_start();

$_SESSION['loggedIn'] = false;
$_SESSION['username'] = null;
header('location:index.php');
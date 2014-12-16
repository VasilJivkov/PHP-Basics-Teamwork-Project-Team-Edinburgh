<?php

session_start();
//session_destroy() ---> Killing the session.Add by Nikola, enable if you want.
$_SESSION['loggedIn'] = false;
$_SESSION['username'] = null;
header('location:index.php');
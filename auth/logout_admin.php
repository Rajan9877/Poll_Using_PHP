<?php

session_start();
unset($_SESSION['adminpollid']);
unset($_SESSION['user_id']);
header('Location: http://localhost/poll/auth/login.php');

?>
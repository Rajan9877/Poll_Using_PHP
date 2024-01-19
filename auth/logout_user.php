<?php

session_start();
unset($_SESSION['pollid']);
unset($_SESSION['userid']);
header('Location: http://localhost/poll/auth/login.php');

?>
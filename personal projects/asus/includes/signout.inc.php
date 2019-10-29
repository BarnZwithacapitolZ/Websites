<?php


session_start();
session_unset(); // unset all the session variables inside the browser
session_destroy(); // Kill any sessions running in browser
header("Location: ../index.php");
exit();

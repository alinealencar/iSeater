<?php
session_start();
$_SESSION['logout'] = "You have successfully signed out.";
header("Location: index.php");


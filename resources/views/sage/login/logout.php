<?php
session_start();
unset($_SESSION['login_err']);
header('location:login.php');
$_SESSION['logout']='';
?>
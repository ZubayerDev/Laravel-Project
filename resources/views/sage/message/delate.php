<?php 
session_start();
require '../database/db_connect.php';
$id = $_GET['id'];


$delate = "DELETE FROM messages WHERE id='$id'";
$message_res = mysqli_query($db_connect,$delate);

header('location:message.php');
$_SESSION['delate']='message delate';

?>
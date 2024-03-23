<?php 
session_start();
require '../database/db_connect.php';
?>



<?php 

$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$insert = "INSERT INTO messages (name, email, subject, message) VALUES ('$name','$email','$subject','$message')";
mysqli_query($db_connect,$insert);

$_SESSION['done']='message send successfully';
header('location:../index.php#contact');












?>
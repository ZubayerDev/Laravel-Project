<?php 
session_start();
$loged_id = $_SESSION["loged_id"];
require '../database/db_connect.php';

$name =$_POST['name'];
$gender =$_POST['gender'];
$address =$_POST['address'];
$country =$_POST['country'];
$hobbie =$_POST['hobbie'];

$update = "UPDATE users SET name='$name',gender='$gender',address='$address',country='$country',hobbie='$hobbie' WHERE id=$loged_id";
mysqli_query($db_connect,$update);


$_SESSION['update_sucsess']='Update_Sucsess Yes';
header('location:profile_edit.php');





?>
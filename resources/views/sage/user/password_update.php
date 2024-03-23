<?php 
session_start();
require '../database/db_connect.php';
$loged_id = $_SESSION["loged_id"];

$current_pass =$_POST['current_password'];
$new_password =$_POST['new_password'];
$confirm_password =$_POST['confirm_password'];

$after_hash = password_hash($new_password,PASSWORD_DEFAULT);

$select = "SELECT * FROM users WHERE id='$loged_id'";
$select_res = mysqli_query($db_connect,$select);
$after_assoc = mysqli_fetch_assoc($select_res);


if(password_verify($current_pass,$after_assoc['password'])){
    if($new_password == $confirm_password){
        $update = "UPDATE users SET password='$after_hash' WHERE id='$loged_id'";
        mysqli_query($db_connect,$update);
        $_SESSION['new']='new password update success';
        header('location:profile_edit.php');
    }
    else {
        $_SESSION['match']='new password and confirm password dose not match';
        header('location:profile_edit.php');
    }
}
else {
    $_SESSION['pass_err']='wrong current password';
    header('location:profile_edit.php');
}
?>
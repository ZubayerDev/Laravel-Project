<?php 
session_start();
require '../database/db_connect.php';

// value from register
$flag = false;
$email = $_POST['email'];
$password = $_POST['password'];


// for email
if(empty($email)){
    $_SESSION['email_err']='plz enter your email';
    $flag = true;
}
else {
    $select1 = "SELECT COUNT(*) AS total FROM `users` WHERE email = '$email'";
       $select1_result = mysqli_query($db_connect,$select1);
       $after_assoc1 = mysqli_fetch_assoc($select1_result);

       if($after_assoc1['total'] == 1){
        $select2 = "SELECT * FROM `users` WHERE email = '$email'";
        $select2_result =  mysqli_query($db_connect,$select2);
        $after_assoc2 = mysqli_fetch_assoc($select2_result);
        
            if(password_verify($password, $after_assoc2["password"])){
                $_SESSION["login_err"] = "done u ";
                $_SESSION["login_sucsess"] = "done u ";
                $_SESSION["loged_id"] = $after_assoc2["id"];
                header("location:../admin_page/admin.php");
            }
            else {
                $_SESSION['pass_err']='plz enter valid password';
                $flag = true;
            }
        }
        else {
            $_SESSION['email_err']='plz enter valid email';
            $flag = true;
        }
    }

//for password
if(empty($password)){
    $_SESSION['pass_err']='plz enter your password';
    $flag = true;
}
else {
    $_SESSION['pass_value']=$password;
}
if($flag){
    header('location:login.php');
}
?>
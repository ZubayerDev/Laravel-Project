<?php 
session_start();
require "../database/db_connect.php";

$btn = $_POST['btn'];
if($btn == 1){
    $header = $_FILES['header_logo'];
    $select = "SELECT * FROM logos WHERE id='1'";
    $select_res = mysqli_query($db_connect,$select);
    $after_assoc = mysqli_fetch_assoc($select_res);
    
    $after_explode = explode('.',$header['name']);
    $extention = end($after_explode);
    $allowed_extantion = ['jpg','png','gif','jpeg'];
    
    if(in_array($extention,$allowed_extantion)){
        if($header['size'] <= 100000){
            $file_name = 'header_logo'.'.'.$extention;
            if($after_assoc['header'] != null){
                $delate_form = '../logo/logos/'.$after_assoc['header'];
                unlink($delate_form);
            }
    
            $new_location = '../logo/logos/'.$file_name;
            move_uploaded_file($header['tmp_name'],$new_location);
            $update = "UPDATE logos SET header='$file_name' WHERE  id='1'";
            mysqli_query($db_connect,$update);

            $_SESSION['done']='header updated';
            header('location:logo.php');
    
        }
        else{
            $_SESSION['err']='only 1mb allowed';
            header('location:logo.php');
        }
    }
    else {
        $_SESSION['err']='only jpg,png,jpeg allowed';
        header('location:logo.php');
    }
}

else {
    $footer = $_FILES['footer_logo'];
    $select = "SELECT * FROM logos WHERE id='1'";
    $select_res = mysqli_query($db_connect,$select);
    $after_assoc = mysqli_fetch_assoc($select_res);

    $after_explode = explode('.',$footer['name']);
    $extention = end($after_explode);
    $allowed_extantion = ['jpg','png','gif','jpeg'];

    if(in_array($extention,$allowed_extantion)){
        if($footer['size'] <= 100000){
            $file_name = 'footer_logo'.'.'.$extention;
            if($after_assoc['footer'] != null){
                $delate_form = '../logo/logos/'.$after_assoc['footer'];
                unlink($delate_form);
            }

            $new_location = '../logo/logos/'.$file_name;
            move_uploaded_file($footer['tmp_name'],$new_location);
            $update = "UPDATE logos SET footer='$file_name' WHERE  id='1'";
            mysqli_query($db_connect,$update);

            $_SESSION['done1']='footer updated';
            header('location:logo.php');

        }
        else{
            $_SESSION['err1']='only 1mb allowed';
            header('location:logo.php');
        }
    }
    else {
        $_SESSION['err1']='only jpg,png,jpeg allowed';
        header('location:logo.php');
    }
}


?>
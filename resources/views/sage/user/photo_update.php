<?php 
session_start();
require "../database/db_connect.php";
$loged_id = $_SESSION["loged_id"];
$select = "SELECT * FROM users WHERE id='$loged_id'";
$select_res = mysqli_query($db_connect,$select);
$after_assoc = mysqli_fetch_assoc($select_res);


$photo = $_FILES['photo'];

$after_explode = explode('.',$photo['name']);
$extention = end($after_explode);
$allowed_extantion = ['jpg','png','gif'];

if(in_array($extention,$allowed_extantion)){
    if($photo['size'] <= 100000){
        $file_name = uniqid().'.'.$extention;
        if($after_assoc['user_photo'] != null){
            $delate_form = '../upload/user_image/'.$after_assoc['user_photo'];
            unlink($delate_form);
        }

        // $file_name = $loged_id.'.'.$extention; // file name id hobe
        // $file_name = random_int(1000,9999).'.'.$extention;
        // $file_name = $loged_id.uniqid().random_int(1000,9999).'.'.$extention;

        $new_location = '../upload/user_image/'.$file_name;
        move_uploaded_file($photo['tmp_name'],$new_location);
        $update = "UPDATE users SET user_photo='$file_name' WHERE  id='$loged_id'";
        mysqli_query($db_connect,$update);

        $_SESSION['done']='update done';
        header("location:profile_edit.php");
    }
    else{
        $_SESSION['extentaion_err']='only picture size 1 mb allowed ';
        header("location:profile_edit.php");
    }
}
else {
    $_SESSION['extentaion_err']='extentaion_err';
    header("location:profile_edit.php");
}
?>
<?php 
session_start();
 require '../database/db_connect.php'
 ?>
<?php

$id = $_POST['id'];
$select = "SELECT * FROM teams WHERE id='$id'";
$select_res = mysqli_query($db_connect,$select);
$select_after_assoc = mysqli_fetch_assoc($select_res);



$about = $_POST['about'];
$name = $_POST['name'];
$title = $_POST['title'];
$photo = $_FILES['photo'];


if($photo['name']== ''){
    $update = "UPDATE teams SET about='$about', name='$name', title='$title' WHERE id='$id'";
    mysqli_query($db_connect,$update);
    header('location:edit_team.php?id='.$id);
}
else{

    $after_explode = explode('.',$photo['name']);
    $extention = end ($after_explode);
    $allowed_extantion = array ('jpg','png','jpeg');

    if(in_array($extention,$allowed_extantion)){
        if($photo['size'] <= 1000000){

            $delate_from = '../team/image/'.$select_after_assoc['photo'];
            unlink($delate_from);

            $file_name = uniqid().'.'.$extention;
            $file_location = '../team/image/'.$file_name;
            move_uploaded_file($photo['tmp_name'],$file_location);

            $update = "UPDATE teams SET about='$about', name='$name', title='$title', photo='$file_name' WHERE id='$id'";
            mysqli_query($db_connect,$update);

            $_SESSION['done']='team aupdated done';
            header('location:edit_team.php?id='.$id); 
        }
        else{
            $_SESSION['err']='only allow 1mb';
            header('location:edit_team.php?id='.$id); 
        }
    }
    else{
        $_SESSION['err']='only allow jpg, pngj, peg';
        header('location:edit_team.php?id='.$id); 
    }
}


?>
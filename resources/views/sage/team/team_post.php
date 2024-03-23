<?php 
session_start();
 require '../database/db_connect.php'
 ?>


<?php  
$about = $_POST['about'];
$name = $_POST['name'];
$title = $_POST['title'];
$photo = $_FILES['photo'];


if($about !='' && $name !='' && $title !='' && $photo['name'] !=''){

    $after_explode = explode('.',$photo['name']);
    $extention = end ($after_explode);
    $allowed_extantion = array ('jpg','png','jpeg');

    if(in_array($extention,$allowed_extantion)){
        if($photo['size'] <= 1000000){

            $file_name = uniqid().'.'.$extention;
            $file_location = '../team/image/'.$file_name;
            move_uploaded_file($photo['tmp_name'],$file_location);

            $insert = "INSERT INTO teams (about, name, title, photo) VALUES ('$about','$name','$title','$file_name')";
            mysqli_query($db_connect,$insert);

            $_SESSION['done']='team aupdated done';
            header('location:add_team.php'); 
        }
        else{
            $_SESSION['err']='only allow 1mb';
            header('location:add_team.php'); 
        }
    }
    else{
        $_SESSION['err']='only allow jpg, pngj, peg';
        header('location:add_team.php'); 
    }
}
else{
    $_SESSION['err']='inter about, name, title , photo';
    header('location:add_team.php'); 
}




?>
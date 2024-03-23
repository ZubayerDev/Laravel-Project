<?php
session_start();
 require "../database/db_connect.php"
?>
<?php 

    $id =$_POST['id'];

    $protfolio_query = "SELECT * FROM protfolios WHERE id='$id'";
    $protfolios = mysqli_query($db_connect,$protfolio_query);
    $protfolio_assoc = mysqli_fetch_assoc($protfolios);

    $catagory = $_POST['catagory'];
    $title = $_POST['title'];
    $photo = $_FILES['photo'];

if($photo['name']==''){
    $update = "UPDATE protfolios SET catagory='$catagory',title='$title' WHERE id='$id'";
    mysqli_query($db_connect,$update);

    $_SESSION['insert']='protfolio update done';
    header('location:edit_protfolio.php?id='.$id);
}
else {
    $after_explode = explode('.',$photo['name']);
    $extention = end($after_explode);
    $allowed_extantion = array ('jpg','png','jpeg');

    if(in_array($extention,$allowed_extantion)){
        if($photo['size']<=1000000){

            $delate_from = '../protfolio/image/'.$protfolio_assoc['photo'];
            unlink($delate_from);

            $file_name = uniqid().'.'.$extention;
            $new_location ='../protfolio/image/'.$file_name;
            move_uploaded_file($photo['tmp_name'],$new_location);

            $update = "UPDATE`protfolios SET catagory='$catagory',title='$title',photo='$file_name' WHERE id='$id'";
            mysqli_query($db_connect,$update);

            $_SESSION['insert']='protfolio update done';
            header('location:edit_protfolio.php?id='.$id);

        }
        else {
            $_SESSION['err']='only 1mb photo allowed)';
            header("location:edit_protfolio.php?id=".$id);
        }
    }
    else {
        $_SESSION['err']='only allowed jpg, png, jpeg)';
        header("location:edit_protfolio.php?id=".$id);
    }
}


<?php
session_start();
 require "../database/db_connect.php"
?>
<?php 

if(isset($_POST['btn-1'])){

    $catagory = $_POST['catagory'];
    $title = $_POST['title'];
    $photo = $_FILES['photo'];

    $after_explode = explode('.',$photo['name']);
    $extention = end($after_explode);
    $allowed_extantion = array ('jpg','png','jpeg');

    if(in_array($extention,$allowed_extantion)){
        if($photo['size']<=1000000){

            $file_name = uniqid().'.'.$extention;
            $new_location ='../protfolio/image/'.$file_name;
            move_uploaded_file($photo['tmp_name'],$new_location);

            $insert = "INSERT INTO protfolios (catagory,title,photo) VALUES ('$catagory','$title','$file_name')";
            mysqli_query($db_connect,$insert);

            $_SESSION['insert']='protfolio intertion done';
            header('location:protfolio.php');

        }
        else {
            $_SESSION['err']='only 1mb photo allowed)';
            header("location:protfolio.php");
        }
    }
    else {
        $_SESSION['err']='only allowed jpg, png, jpeg)';
        header("location:protfolio.php");
    }

}


if(isset($_GET['id'])){
    $id = $_GET['id'];

    $protfolio_query = "SELECT * FROM protfolios WHERE id='$id'";
    $protfolios = mysqli_query($db_connect,$protfolio_query);
    $protfolio_assoc = mysqli_fetch_assoc($protfolios);

    if($protfolio_assoc['status']=='deactive'){

        $update = "UPDATE protfolios SET status='active' WHERE id='$id'";
        mysqli_query($db_connect,$update);
        header("location:protfolio.php");
    }
    else {
        $update = "UPDATE protfolios SET status='deactive' WHERE id='$id'";
        mysqli_query($db_connect,$update);
        header("location:protfolio.php");
    }
}

if(isset($_GET['id-1'])){
    $id = $_GET['id-1'];

    $select = "SELECT * FROM protfolios WHERE id='$id'";
    $select_res = mysqli_query($db_connect,$select);
    $after_assoc = mysqli_fetch_assoc($select_res);

    $delate = "DELETE FROM protfolios WHERE id='$id'";
    mysqli_query($db_connect,$delate);

    $delate_from = "../protfolio/image/".$after_assoc['photo'];
    unlink($delate_from);
    
    header("location:protfolio.php");
}








?>
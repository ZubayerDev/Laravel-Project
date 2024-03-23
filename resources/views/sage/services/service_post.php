<?php 
session_start();
require '../database/db_connect.php';

if(isset($_GET['id'])){
    $id = $_GET['id'];

    $select = "SELECT * FROM services WHERE id='$id' ";
    $select_res = mysqli_query($db_connect,$select);
    $after_about_assoc = mysqli_fetch_assoc($select_res);

    if($after_about_assoc['status']=='deactive'){
        $update = "UPDATE services SET status='active' WHERE id='$id'";
        mysqli_query($db_connect,$update);

        $_SESSION['update']='status active now';
        header('location:service.php');
    }
    else {
        $update = "UPDATE services SET status='deactive' WHERE id='$id'";
        mysqli_query($db_connect,$update);

        $_SESSION['update']='status deactive now';
        header('location:service.php');
    }
}
if(isset($_POST['btn-1'])){

    $title = $_POST['title'];
    $short_desp = $_POST['short_desp'];

    $insert = "INSERT INTO services (title, short_desp) VALUES ('$title','$short_desp')";
    mysqli_query($db_connect,$insert);
    $_SESSION['done']='title and short_desp insert sucsessfully';
    header('location:service.php');
}
if(isset($_GET['id-1'])){
    $id = $_GET['id-1'];
    $delate = "DELETE FROM services WHERE id='$id'";
    mysqli_query($db_connect,$delate);

    $_SESSION['update']='service delate sucsess fully';
    header('location:service.php');
}


if(isset($_POST['btn-2'])){
    $id = $_GET['edit'];
    echo $id;

    $title = $_POST['title'];
    $short_desp = $_POST['short_desp'];

    $update = "UPDATE services SET title='$title',short_desp='$short_desp' WHERE id='$id'";
    mysqli_query($db_connect,$update);
    header('location:service.php');

}
?>
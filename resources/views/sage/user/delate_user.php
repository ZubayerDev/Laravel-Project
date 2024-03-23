<?php   require '../database/db_connect.php' ?>
<?php 
session_start();
$id = $_GET['id'];
$select = "SELECT * FROM users WHERE id='$id'";
$select_res = mysqli_query($db_connect,$select);
$after_assoc = mysqli_fetch_assoc($select_res);

$delet = "DELETE FROM users WHERE id='$id'";
mysqli_query($db_connect,$delet);
if($after_assoc['user_photo'] != NULL){
    $delate_form = '../upload/user_image/'.$after_assoc['user_photo'];
    unlink($delate_form);
}

header('location:/sage/user/user_list.php');
$_SESSION['user_delate']='user_delate done';







?>
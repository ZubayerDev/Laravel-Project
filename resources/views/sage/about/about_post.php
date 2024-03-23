<?php 
    session_start();
    require '../database/db_connect.php';
?>
<?php 

$select = "SELECT * FROM abouts ";
$select_res = mysqli_query($db_connect,$select);
$after_assoc = mysqli_fetch_assoc($select_res);


$designation = $_POST['designation'];
$name = $_POST['name'];
$watertext = $_POST['watertext'];
$about = $_POST['about'];
$image = $_FILES['image'];


if($image['name'] == ''){
    $update = "UPDATE abouts SET designation='$designation',name='$name',watertext='$watertext',about='$about'";
    mysqli_query($db_connect,$update);
    header('location:about.php');
    $_SESSION['update']='designation, name, watertext, about update done';
}
else {
        $expolde = explode('.',$image['name']);
        $extention = end($expolde);
        $allowed_extantion = array ('jpg','gif','png');

        if(in_array($extention,$allowed_extantion)){
            if($image['size']<=1000000){
                $delate_from = '../about/image/'.$after_assoc['image'];
                unlink($delate_from);

                $file_name = 'about'.'.'.'jpg';
                $new_location = '../about/image/'.$file_name;
                move_uploaded_file($image['tmp_name'],$new_location);

                $update = "UPDATE abouts SET designation='$designation',name='$name',watertext='$watertext',about='$about', image='$file_name'";
                mysqli_query($db_connect,$update);
                header('location:about.php');
                $_SESSION['update']='designation, name, watertext, about image update done';                
            }
            else {
                $_SESSION['err']='only 1 mb allowed';
                header('location:about.php');
            }
        }
        else {
            $_SESSION['err']='only jpg, gif, png extention allowed';
            header('location:about.php');
        }
}










?>
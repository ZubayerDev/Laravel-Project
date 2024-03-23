<?php
session_start(); 
require "../database/db_connect.php" 
?>

<?php 

if(isset($_GET['id'])){
    $id = $_GET['id'];
    $select = "SELECT * FROM expertises WHERE id='$id'";
    $select_res = mysqli_query($db_connect,$select);
    $after_assoc = mysqli_fetch_assoc($select_res);
    
    if($after_assoc['status']=='deactive'){
        $update = "UPDATE expertises SET status='active' WHERE id='$id'";
        mysqli_query($db_connect,$update);

        $_SESSION['done1']='active status done';
        header('location:skills_add.php');
    }
    else {
        $update = "UPDATE expertises SET status='deactive' WHERE id='$id'";
        mysqli_query($db_connect,$update);

        $_SESSION['done1']='deactive status done';
        header('location:skills_add.php');
    }
}





if(isset($_POST['insert_btn'])){

    $title =strtoupper($_POST['skill_title']);
    $rate = $_POST['skill_rate'];
    
    if($title && $rate != NULL){
        $insert = "INSERT INTO expertises (title,rate) VALUES ('$title','$rate')";
        mysqli_query($db_connect,$insert);
        $_SESSION['done']='Skill_title && Skill_rate added sucsess fully';
        header('location:skills_add.php');
    }
    else {
        $_SESSION['err']='inter value Skill_title && Skill_rate';
        header('location:skills_add.php');
    }

}


if(isset($_GET['edit_id'])){
    $skill_id = $_GET['edit_id'];
    $title =strtoupper($_POST['skill_title']);
    $rate = $_POST['skill_rate'];
    if($title && $rate != NULL){
        $update_skill = " UPDATE expertises SET title='$title', rate='$rate' WHERE id='$skill_id'";      
        mysqli_query($db_connect,$update_skill);
        $_SESSION['done']='Skill_title && Skill_rate added sucsess fully';
        header('location:skills_add.php');
    }
}

?>
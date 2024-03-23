<?php 
session_start();
 require '../database/db_connect.php'
 ?>
<?php
    $id = $_GET['id'];

    $select = "SELECT * FROM teams WHERE id='$id'";
    $select_res = mysqli_query($db_connect,$select);
    $after_team_assoc = mysqli_fetch_assoc($select_res);

    if($after_team_assoc['status'] =='deactive'){

        $update = "UPDATE teams SET status='active' WHERE id='$id'";
        mysqli_query($db_connect,$update);

        header('location:add_team.php'); 
    }
    else {
        $update = "UPDATE teams SET status='deactive' WHERE id='$id'";
        mysqli_query($db_connect,$update);

        header('location:add_team.php'); 
    }
?>



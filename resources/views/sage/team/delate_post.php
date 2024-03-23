<?php 
session_start();
 require '../database/db_connect.php'
 ?>
<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];

    $select = "SELECT * FROM teams";
    $select_res = mysqli_query($db_connect,$select);
    $after_team_assoc = mysqli_fetch_assoc($select_res);

    $delate_from = '../team/image/'.$after_team_assoc['photo'];
    unlink($delate_from);

    $delate = "DELETE FROM teams WHERE id='$id'";
    mysqli_query($db_connect,$delate);

    header('location:add_team.php');
    
}





















//     if($after_team_assoc['status']=='deactive'){
//         $update = "UPDATE team SET status='active' WHERE id='$id'";
//         mysqli_query($db_connect,$update);
//         header('location:add_team.php'); 
//     }
//     else {
//         $update = "UPDATE team SET status='deactive' WHERE id='$id'";
//         mysqli_query($db_connect,$update);
//         header('location:add_team.php'); 
//     }
    
// }
?>
<?php 
require '../database/db_connect.php';

$id = $_GET['id'];
$message_query = "SELECT * FROM messages WHERE id='$id'";
$message_res = mysqli_query($db_connect,$message_query);
$message_after_assoc = mysqli_fetch_assoc($message_res);

$update = "UPDATE messages SET status='active' WHERE id='$id'";
mysqli_query($db_connect,$update);

require '../admin_page/header.php';
?>


<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h3>messages View</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <tbody>
                    <tr>
                        <td>NAME:</td>
                        <td><?=$message_after_assoc['name']?></td>
                    </tr>
                    <tr>
                        <td>EMAIL:</td>
                        <td><?=$message_after_assoc['email']?></td>
                    </tr>
                    <tr>
                        <td>SUBJECT:</td>
                        <td><?=$message_after_assoc['subject']?></td>
                    </tr>
                    <tr>
                    <td>MESSAGE:</td>
                    <td><?=$message_after_assoc['message']?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php require '../admin_page/footer.php'?>


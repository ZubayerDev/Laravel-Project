<?php 
require '../database/db_connect.php';
require '../admin_page/header.php';

$message_query = "SELECT * FROM messages ORDER BY id DESC";
$message_res = mysqli_query($db_connect,$message_query);
?>
<div class="col-lg-12">
    <div class="card">
        <?php if(isset($_SESSION['delate'])){ ?>
            <strong class="alert alert-success"><?=$_SESSION['delate']?></strong>
        <?php } unset($_SESSION['delate'])?>
        <div class="card-header">
            <h3>messages list</h3>
        </div>
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">name</th>
                        <th scope="col">email</th>
                        <th scope="col">Subject</th>
                        <th scope="col">message</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($message_res as $i=>  $message){ ?>
                        <tr class="<?=($message['status']=='deactive')?'table-primary':''?>" >
                            <td><?=$i++?></td>
                            <td><?=$message['name']?></td>
                            <td><?=$message['email']?></td>
                            <td><?=$message['subject']?></td>
                            <td><?=substr($message['message'],0,40).'....read more'?></td>
                            <td>
                                <a href="view.php?id=<?=$message['id']?>" class="btn btn-primary" >View</a>
                                <a href="delate.php?id=<?=$message['id']?>" class="btn btn-danger" >Delate</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>



<?php 
require '../admin_page/footer.php';
?>
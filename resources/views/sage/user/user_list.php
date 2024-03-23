<?php   require "../admin_page/header.php" ?>
<?php   require '../database/db_connect.php' ?>

<?php 
$users = "SELECT * FROM users";
$users_list = mysqli_query($db_connect,$users);
$loged_id = $_SESSION["loged_id"];
?>

<div class="col-lg-12">
    <div class="card">
    <?php if(isset($_SESSION['user_delate'])){?>
          <strong class="alert alert-success" ><?=$_SESSION['user_delate']?></strong>
        <?php } unset($_SESSION['user_delate']) ?>
        <div class="card-header"><h3>user list</h3></div>
        <div class="card-body">
            <!-- On tables -->
            <table class="table">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">name</th>
                    <th scope="col">email</th>
                    <th scope="col">number</th>
                    <th scope="col">gender</th>
                    <th scope="col">address</th>
                    <th scope="col">country</th>
                    <th scope="col">hobbies</th>
                    <th scope="col">password</th>
                    <th scope="col">picture</th>
                    <th scope="col">Action</th>
                </tr>
                    <?php foreach($users_list as $user){?>
                        <tr>
                            <td><?=$user['id']?></td>
                            <td><?=$user['name']?></td>
                            <td><?=$user['email']?></td>
                            <td><?=$user['number']?></td>
                            <td><?=$user['gender']?></td>
                            <td><?=$user['address']?></td>
                            <td><?=$user['country']?></td>
                            <td><?=$user['hobbie']?></td>
                            <td><?=$user['password']?></td>
                            <td>
                                <?php if($user['user_photo'] != null){ ?>
                                <img width="100px" src="/SAGE/upload/user_image/<?=$user['user_photo']?>">
                                <?php }
                                 else {?>
                                        <img width="100px" src="/SAGE/admin_page/images/profile/17.jpg" width="20" alt="">
                                <?php }?>
                            </td>
                            <?php if($select_id_assoc['role'] ==1 || $select_id_assoc['role'] ==2){ ?>
                                <td>
                                <a href="/sage/user/delate_user.php?id=<?=$user['id']?>" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-trash"></i></a>
                                </td>
                            <?php }?>
                        </tr>
                    <?php }?>
            </table>
        </div>
    </div>
</div>
<?php   require "../admin_page/footer.php"; ?>
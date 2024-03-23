<?php require '../database/db_connect.php'?>
<?php require '../admin_page/header.php'?>
<?php 
$id = $_GET['id'];
$select = "SELECT * FROM teams WHERE id='$id'";
$select_res = mysqli_query($db_connect,$select);
$select_after_assoc = mysqli_fetch_assoc($select_res);
?>
<div class="col-lg-6">
            <div class="card">                        
                <div class="card-header">
                    <h3>about team</h3>
                </div>
                <div class="card-body">
                    <div class="mb-5">
                        <?php if(isset($_SESSION['done'])){ ?>
                            <strong class="alert alert-success"><?=$_SESSION['done']?></strong>
                        <?php } unset($_SESSION['done'])?>
                    </div>
                    <form action="edit_team_post.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">

                            <input type="hidden" name="id" value="<?=$select_after_assoc['id']?>"/>

                            <label for="about" class="label-conreol">about</label>
                            <input type="text" name="about" class="form-control" value="<?=$select_after_assoc['about']?>"/>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="label-conreol">name</label>
                            <input type="text" name="name" class="form-control" value="<?=$select_after_assoc['name']?>"/>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="label-conreol">title</label>
                            <input type="text" name="title" class="form-control" value="<?=$select_after_assoc['title']?>"/>
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="label-conreol">photo</label>
                            <input type="file" name="photo" class="form-control"/>
                            <img width="150px" style="padding-top:30px" src="../team/image/<?=$select_after_assoc['photo']?>"/>
                        </div>
                        <div class="mb-5 mt-5">
                        <?php if(isset($_SESSION['err'])){ ?>
                                <strong class="alert alert-danger"><?=$_SESSION['err']?></strong>
                            <?php } unset($_SESSION['err'])?>
                        </div>
                        <div class="mb-3">
                            <button type="submit" class="btn btn-primary">submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <?php require '../admin_page/footer.php'?>
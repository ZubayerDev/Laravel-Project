<?php 
    require '../admin_page/header.php';
    require '../database/db_connect.php';

    $select = "SELECT * FROM abouts ";
    $select_res = mysqli_query($db_connect,$select);
    $after_assoc = mysqli_fetch_assoc($select_res);
?>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>About update</h3>
            </div>
            <?php if(isset($_SESSION['update'])){?>
                    <strong class="alert alert-success"><?=$_SESSION['update']?></strong>
            <?php } unset($_SESSION['update'])?>
            <div class="card-body">
                <form action="about_post.php" method="POST" enctype="multipart/form-data">
                    <!--from Designation-->
                    <div class="mt-2">
                        <label for="designation" class="form-label">Designation</label>
                        <input type="text" class="form-control" name="designation" placeholder="Enter designation" value="<?=$after_assoc['designation']?>"/> 
                    </div>
                    <!--from Designation-->
                    <div class="mt-2">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter name" value="<?=$after_assoc['name']?>"/> 
                    </div>
                    <!--from Designation-->
                    <div class="mt-2">
                        <label for="watertext" class="form-label">Water text</label>
                        <input type="text" class="form-control" name="watertext" placeholder="Enter watertext" value="<?=$after_assoc['watertext']?>"/> 
                    </div>
                    <!--from Designation-->
                    <div class="mt-2">
                        <label for="about" class="form-label">About</label>
                        <textarea type="text" class="form-control" name="about" cols="20" rows="3" placeholder="Enter about you"><?=$after_assoc['about']?></textarea> 
                    </div>
                    <!--from Designation-->
                    <div class="mt-2">
                        <label for="image" class="form-label">About image</label>
                        <input type="file" class="form-control" name="image" placeholder="Enter image"/> 
                        <?php if(isset($_SESSION['err'])){?>
                            <strong class="alert alert-danger"><?=$_SESSION['err']?></strong>
                        <?php } unset($_SESSION['err'])?>
                    </div>
                    <div class="mt-3"><img width="80" height="80" src="/sage/about/image/<?=$after_assoc['image']?>"></div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary" name="btn-1">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>











<?php require '../admin_page/footer.php'?>
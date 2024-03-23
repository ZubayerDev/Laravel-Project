<?php require "../database/db_connect.php" ?>
<?php require "../admin_page/header.php" ?>
<?php 
    $id = $_GET['id'];
    $select = "SELECT * FROM protfolios WHERE id='$id'";
    $select_res = mysqli_query($db_connect,$select);
    $after_assoc = mysqli_fetch_assoc($select_res);
?>

<div class="row">
<div class="col-lg-8">
        <div class="card">
            <?php if(isset($_SESSION['insert'])): ?>
                <strong class="alert alert-success"><?=$_SESSION['insert']?></strong>
            <?php endif; unset($_SESSION['insert']) ?>
            <div class="card-header">
                <h3>Edit protfolio</h3>
            </div>
            <div class="card-body">
                <form action="edit_protfolio_post.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <!-- for id pathanor jonno  -->
                        <input type="hidden" name="id" value="<?=$after_assoc['id']?>"/>

                        <label class="form-label" for="catagory" ><h3>catagory</h3></label>
                        <input type="text" class="form-control" name="catagory" value="<?=$after_assoc['catagory']?>"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="title" ><h3>title</h3></label>
                        <input type="text" class="form-control" name="title" value="<?=$after_assoc['title']?>" />
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="photo" ><h3>photo</h3></label>
                        <input type="file" class="form-control" name="photo"/>
                        <?php if(isset($_SESSION['err'])): ?>
                            <strong class="alert alert-danger"><?=$_SESSION['err']?></strong>
                        <?php endif; unset($_SESSION['err']) ?>
                        <div class="mt-3">
                            <img width="100px" src="../protfolio/image/<?=$after_assoc['photo']?>"/>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" name="btn-1">update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>






<?php require "../admin_page/footer.php" ?>
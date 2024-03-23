<?php require "../database/db_connect.php" ?>
<?php require "../admin_page/header.php" ?>

<?php 

$protfolio_query = "SELECT * FROM protfolios";
$protfolios = mysqli_query($db_connect,$protfolio_query);

?>

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>protfolio list</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">catagory</th>
                            <th scope="col">title</th>
                            <th scope="col">photo</th>
                            <th scope="col">status</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($protfolios as $i => $protfolio) { ?>
                        <tr>
                            <td><?=$i+1?></td>
                            <td><?=$protfolio['catagory']?></td>
                            <td><?=$protfolio['title']?></td>
                            <td><img width="100px" src="../protfolio/image/<?=$protfolio['photo']?>"/></td>
                            <td class="alert">
                                <?php if($protfolio['status']=='active'){ ?>
                                    <a href="protfolio_post.php?id=<?=$protfolio['id']?>"  class="btn btn-success"><?=$protfolio['status']?></a>
                                <?php } else{?>
                                <?php ?>
                                    <a href="protfolio_post.php?id=<?=$protfolio['id']?>" class="btn btn-primary"><?=$protfolio['status']?></a>
                                <?php }?>
                            </td>
                            <td>
                                <a href="protfolio_post.php?id-1=<?=$protfolio['id']?>" class="btn btn-danger shadow btn-xs sharp mr-1"><i class="fa fa-trash"></i></a>
                                <a href="edit_protfolio.php?id=<?=$protfolio['id']?>" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <?php if(isset($_SESSION['insert'])): ?>
                <strong class="alert alert-success"><?=$_SESSION['insert']?></strong>
            <?php endif; unset($_SESSION['insert']) ?>
            <div class="card-header">
                <h3>Add protfolio</h3>
            </div>
            <div class="card-body">
                <form action="protfolio_post.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label class="form-label" for="catagory" ><h3>catagory</h3></label>
                        <input type="text" class="form-control" name="catagory"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="title" ><h3>title</h3></label>
                        <input type="text" class="form-control" name="title"/>
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="photo" ><h3>photo</h3></label>
                        <input type="file" class="form-control" name="photo"/>
                        <?php if(isset($_SESSION['err'])): ?>
                            <strong class="alert alert-danger"><?=$_SESSION['err']?></strong>
                        <?php endif; unset($_SESSION['err']) ?>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary" name="btn-1">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
















<?php require "../admin_page/footer.php" ?>
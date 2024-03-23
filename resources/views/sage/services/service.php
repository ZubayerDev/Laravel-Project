<?php 
require '../admin_page/header.php';
require '../database/db_connect.php';

$select = "SELECT * FROM services ";
$select_res = mysqli_query($db_connect,$select);


?>
<div class="row">
    <div class="col-lg-8">
        <div class="card">
        <?php if(isset($_SESSION['update'])){?>
            <strong class="alert alert-success"><?=$_SESSION['update']?></strong>
        <?php } unset($_SESSION['update'])?>
            <div class="card-header">
                <h3>Service List</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">title</th>
                        <th scope="col">short_desp</th>
                        <th scope="col">status</th>
                        <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($select_res as $i=> $service) : ?>
                        <tr>
                            <td><?=$i+1?></td>
                            <td><?=$service['title']?></td>
                            <td><?=$service['short_desp']?></td>
                            <td class="alert">
                                <?php if($service['status']=='active'){ ?>
                                    <a href="service_post.php?id=<?=$service['id']?>"  class="btn btn-success"><?=$service['status']?></a>
                                <?php } else{?>
                                <?php ?>
                                    <a href="service_post.php?id=<?=$service['id']?>" class="btn btn-primary"><?=$service['status']?></a>
                                <?php }?>
                            </td>
                            <td>
                                <a href="service_post.php?id-1=<?=$service['id']?>" class="btn btn-danger shadow btn-xs sharp mr-1"><i class="fa fa-trash"></i></a>
                                <button type="submit" class="btn btn-primary shadow btn-xs sharp mr-1" data-bs-toggle="modal" data-bs-target="#exampleModal<?=$service['id']?>"><i class="fa fa-pencil"></i></button>
                                <!-- for edit services -->
                                <!-- Button trigger modal -->

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal<?=$service['id']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit service</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <form action="service_post.php?edit=<?=$service['id']?>" method="POST">
                                                            <div class="mt-3">
                                                                <label for="title" class="label-control">Title</label>
                                                                <input type="text" placeholder="Enter title" name="title" class="form-control" value="<?=$service['title']?>"/>
                                                            </div>
                                                            <div class="mt-3">
                                                                <label for="short_desp" class="label-control">Short_desp</label>
                                                                <input type="text" placeholder="Enter short_desp" name="short_desp" class="form-control" value="<?=$service['short_desp']?>"/>
                                                            </div>
                                                            <div class="mt-3">
                                                                <button type="submit" class="btn btn-primary" name="btn-2">Submit</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
        <?php if(isset($_SESSION['done'])){?>
            <strong class="alert alert-success"><?=$_SESSION['done']?></strong>
        <?php } unset($_SESSION['done'])?>
            <div class="card-header"><h3>sevice adder section</h3></div>
            <div class="card-body">
                <form action="service_post.php" method="POST">
                    <div class="mt-3">
                        <label for="title" class="label-control">Title</label>
                        <input type="text" placeholder="Enter title" name="title" class="form-control"/>
                    </div>
                    <div class="mt-3">
                        <label for="short_desp" class="label-control">Short_desp</label>
                        <input type="text" placeholder="Enter short_desp" name="short_desp" class="form-control"/>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary" name="btn-1">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php 
require '../admin_page/footer.php';
?>
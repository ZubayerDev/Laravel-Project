<?php require '../database/db_connect.php'?>
<?php require '../admin_page/header.php'?>
<?php 
$select = "SELECT * FROM teams";
$select_res = mysqli_query($db_connect,$select);
$select_after_assoc = mysqli_fetch_assoc($select_res);
?>

<div class="row">
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
                    <form action="team_post.php" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="about" class="label-conreol">about</label>
                            <input type="text" name="about" class="form-control"/>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="label-conreol">name</label>
                            <input type="text" name="name" class="form-control"/>
                        </div>
                        <div class="mb-3">
                            <label for="title" class="label-conreol">title</label>
                            <input type="text" name="title" class="form-control"/>
                        </div>
                        <div class="mb-3">
                            <label for="photo" class="label-conreol">photo</label>
                            <input type="file" name="photo" class="form-control" onchange="document.getElementById('emon1').src = window.URL.createObjectURL(this.files[0])" class="form-control"/>
                        </div>
                        <div class="mb-5 mt-5">
                        <?php if(isset($_SESSION['err'])){ ?>
                                <strong class="alert alert-danger"><?=$_SESSION['err']?></strong>
                            <?php } unset($_SESSION['err'])?>
                        </div>
                        <div class="md-4">
                            <img width="70px" id="emon1"/>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary">submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>team about</h3>
            </div>
            <div class="card-body">
            <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">about</th>
                            <th scope="col">name</th>
                            <th scope="col">title</th>
                            <th scope="col">photo</th>
                            <th scope="col">status</th>
                            <th scope="col">action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($select_res as $i => $team) { ?>
                        <tr>
                            <td><?=$i+1?></td>
                            <td><?=$team['about']?></td>
                            <td><?=$team['name']?></td>
                            <td><?=$team['title']?></td>
                            <td><img width="100px" src="../team/image/<?=$team['photo']?>"/></td>
                            <td class="alert">
                                <?php if($team['status']=='active'){ ?>
                                    <a href="status_post.php?id=<?=$team['id']?>"  class="btn btn-success"><?=$team['status']?></a>
                                <?php } else{?>
                                <?php ?>
                                    <a href="status_post.php?id=<?=$team['id']?>" class="btn btn-primary"><?=$team['status']?></a>
                                <?php }?>
                            </td>
                            <td>
                                <a href="delate_post.php?id=<?=$team['id']?>" class="btn btn-danger shadow btn-xs sharp mr-1"><i class="fa fa-trash"></i></a>
                                <a href="edit_team.php?id=<?=$team['id']?>" class="btn btn-primary shadow btn-xs sharp mr-1"><i class="fa fa-pencil"></i></a>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


























<?php require '../admin_page/footer.php'?>
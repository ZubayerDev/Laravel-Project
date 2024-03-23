<?php require "../database/db_connect.php" ?>
<?php 
$skills_query = "SELECT * FROM expertises";
$skills = mysqli_query($db_connect,$skills_query);

?>

<?php require "../admin_page/header.php" ?>

<div class="row">
    <div class="col-lg-4">
        <div class="card">
            <?php if(isset($_SESSION['done'])){?>
                <strong class="alert alert-success"><?=$_SESSION['done']?></strong>
            <?php } unset($_SESSION['done']) ?>
            <div class="card-header">
                <h3>Skills adder section</h3>
            </div>
            <div class="card-body">
                <form action="skill_post.php" method="POST" enctype="multipart/form-data">
                <div class="mt-3 mb-3">
                    <label for="skill_title">Skill_title</label>
                    <input type="text" name="skill_title"class="form-control"/>
                        <?php if(isset($_SESSION['err'])){?>
                            <strong class="text-danger"><?=$_SESSION['err']?></strong>
                        <?php } unset($_SESSION['err']) ?>
                </div>
                <div class="mt-3 mb-3">
                    <label for="skill_rate">Skill_rate</label></br>
                    <select aria-label="Default select example" name="skill_rate">
                        <?php 
                        $x = 0;
                        for($x=0;$x<100+1;$x+=5):
                        ?>
                        <option value="<?=$x?>"><?=$x?>"%</option>
                        <?php 
                        endfor;
                        ?>
                    </select>
                </div>
                <div class="mt-3">
                    <button type="submit" class="btn btn-primary" name="insert_btn">submit</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card">
        <?php if(isset($_SESSION['done1'])){?>
                <strong class="alert alert-success"><?=$_SESSION['done1']?></strong>
            <?php } unset($_SESSION['done1']) ?>
            <div class="card-header"><h3>Skill list</h3></div>
            <div class="card-header">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">title</th>
                            <th scope="col">rate</th>
                            <th scope="col">status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $x=0 ?>
                        <?php foreach ($skills as $skill): ?>
                            <tr>
                                <td><?=$x+=1?></td>
                                <td><?=$skill['title']?></td>
                                <td><?=$skill['rate']?></td>

                                <!-- ststus start -->
                                <td>
                                  <?php if($skill['status']=='deactive'){ ?>    
                                    <a href="skill_post.php?id=<?=$skill['id']?>">
                                        <i class="fa fa-power-off alert alert-danger" aria-hidden="true"><?=$skill['status']?></i>
                                    </a>
                                    <?php } else {?>
                                        <a href="skill_post.php?id=<?=$skill['id']?>">
                                            <i class="fa fa-power-off alert alert-success" aria-hidden="true"><?=$skill['status']?></i>
                                        </a>
                                    <?php } ?>

                                    <!-- Button trigger modal -->
                                    <button type="button" style="border:none; margin-left:50px; background: transparent; " data-bs-toggle="modal" data-bs-target="#exampleModal<?=$skill['title']?>">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="exampleModal<?=$skill['title']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="exampleModalLabel">skill_edit</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="col">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3>Skills edit section</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <form action="skill_post.php?edit_id=<?=$skill['id']?>" method="POST" enctype="multipart/form-data">
                                                            <div class="mt-3 mb-3">
                                                                <label for="skill_title">Skill_title</label>
                                                                <input type="text" name="skill_title"class="form-control" value="<?=$skill['title']?>"/>
                                                            </div>
                                                            <div class="mt-3 mb-3">
                                                                <label for="skill_rate">Skill_rate</label></br> 
                                                                <select aria-label="Default select example" name="skill_rate" value="">
                                                                        <?php 
                                                                        for($i=0;$i<100+1;$i+=5):
                                                                        ?>
                                                                        <option <?=($skill['rate']==$i)?'selected':''?> value="<?=$i?>"> <?=$i?>% </option>
                                                                        <?php 
                                                                        endfor;
                                                                        ?> 
                                                                </select>                                                            
                                                            </div>
                                                            <div class="mt-3">
                                                                <button type="submit" class="btn btn-primary" name="update_btn">submit</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Modal -->

                                </td>
                                <!-- ststus end -->

                            </tr>
                            
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
    















<?php require "../admin_page/footer.php" ?>
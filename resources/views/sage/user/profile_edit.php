<?php   require "../admin_page/header.php" ?>
<?php   require '../database/db_connect.php' ?>
<section class=" row">
  <div class="col-lg-4">
    <div class="card">
      <div class="card-header">
        <h3>Edit user information</h3>
      </div>
      <div class="card-body">
        <?php if(isset($_SESSION['update_sucsess'])){?>
          <strong class="alert alert-success" ><?=$_SESSION['update_sucsess']?></strong>
        <?php } unset($_SESSION['update_sucsess']) ?>
        <!--from start-->
        <form action="profile_update.php" class="form" method="post">
          <div class="mt-2">
          <!--from name-->
            <label for="name">Name</label><br>
            <input type="text" placeholder="Enter full name" class="form-control" name="name" value="<?=$select_id_assoc['name']?>"/>
          </div>
        <!--from gender-->
        <div class="gender-box mt-2">
          <label>Gender</label>
            <div class="gender-option">
              <div class="gender">
                <input type="radio" id="gender1" name="gender" value="male" <?=$select_id_assoc['gender']=='male'?'checked':''?>/>
                <label for="gender">male</label>
              </div>
              <div class="gender">
                <input type="radio" id="gender2" name="gender" value="female" <?=$select_id_assoc['gender']=='female'?'checked':''?>/>
                <label for="gender">Female</label> 
              </div>
          </div>
        </div>
        <!--from address-->
        <div class="mt-2">
          <label for="address">Address</label>
          <input type="text" name="address" placeholder="Enter street address" class="form-control" value="<?=isset($select_id_assoc['address'])?$select_id_assoc['address']:''?>"/>
        </div>
        <!--from country-->
          <div class="mt-2">
            <label>Country</label>
            <select name="country">
              <option hidden value="false">Country</option>
              <option value="America" <?=$select_id_assoc['country']=='America'?'selected':''?>>America</option>
              <option value="Japan" <?=$select_id_assoc['country']=='Japan'?'selected':''?>>Japan</option>
              <option value="Japan" <?=$select_id_assoc['country']=='Japan'?'selected':''?>>Japan</option>
              <option value="Nepal" <?=$select_id_assoc['country']=='Nepal'?'selected':''?>>Nepal</option>
            </select>
          </div>

          <!--from hobbies-->
            <div class="mt-2">
              <label>Country</label>
              <div class="hobbie">
                <input type="checkbox" id="Song" name="hobbie" value="Song" <?=$select_id_assoc['hobbie']=='song'?'checked':''?>/>
                <label for="Song">Song</label>
              </div>
              <div class="hobbie">
                <input type="checkbox" id="Ride" name="hobbie" value="Ride" <?=$select_id_assoc['hobbie']=='Ride'?'checked':''?>/>
                <label for="Ride">Ride</label> 
              </div>
              <div class="hobbie">
                <input type="checkbox" id="Jumping" name="hobbie" value="Jumping" <?=$select_id_assoc['hobbie']=='Jumping'?'checked':''?>/>
                <label for="Jumping">Jumping</label> 
              </div>
              <div class="hobbie">
                <input type="checkbox" id="Movie" name="hobbie" value="Movie" <?=$select_id_assoc['hobbie']=='Movie'?'checked':''?>/>
                <label for="Movie">Movie</label> 
              </div>
              <div class="hobbie">
                <input type="checkbox" id="Football" name="hobbie" value="Football" <?=$select_id_assoc['hobbie']=='Football'?'checked':''?>/>
                <label for="Football">Football</label> 
              </div>
            </div>
            <button class="btn btn-primary mt-4">Update</button>
        </form>
      </div>
    </div>
  </div>
<!--password edit-->
      <div class="col-lg-4">
        <div class="card">
          <div class="card-header">
            <h3>Change password</h3>
          </div>
          <div class="card-body">
            <?php if(isset($_SESSION['new'])){?>
              <div class="alert alert-success" ><?=$_SESSION['new']?></div>
            <?php } unset($_SESSION['new'])?>
            <form action="password_update.php"method="post">
              <div class="md-3">
                <label for="current_password" >Current Password</label>
                <input type="password" name="current_password" class="form-control"/>
                <?php if(isset($_SESSION['pass_err'])){?>
                  <div class="text-danger" ><?=$_SESSION['pass_err']?></div>
                <?php } unset($_SESSION['pass_err'])?>
              </div>
              <div class="md-3">
                <label for="new_password" >New Password</label>
                <input type="password" name="new_password" class="form-control"/>
              </div>
              <div class="md-3">
                <label for="confirm_password" >Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control"/>
                <?php if(isset($_SESSION['match'])){?>
                  <div class="text-danger" ><?=$_SESSION['match']?></div>
                <?php } unset($_SESSION['match'])?>
              </div>
              <button class="btn btn-primary mt-4">Update</button>
            </div>
            </form>
          </div>
        </div>
      <!--photo edit-->
      <div class="col-lg-4">
        <div class="card">
          <div class="card-header">
            <h3>Profile_Photo_Update</h3>
          </div>
          <div class="card-body">
            <?php if(isset($_SESSION['done'])){?>
              <div class="text-success" ><?=$_SESSION['done']?></div>
            <?php } unset($_SESSION['done'])?>
            <form action="photo_update.php"method="post" enctype="multipart/form-data">
              <div class="md-5">
                <label for="photo" class="form-label">Inter your photo</label>
                <input type="file" name="photo" class="form-control" />
                <?php if(isset($_SESSION['extentaion_err'])){?>
                  <div class="text-danger" ><?=$_SESSION['extentaion_err']?></div>
                <?php } unset($_SESSION['extentaion_err'])?>
              </div>
              <div class="mt-3">
                <button class="btn btn-primary">Upload</button>
              </div>
            </form>
          </div>
        </div>
      </div>
</section>

<?php   require "../admin_page/footer.php"; ?>

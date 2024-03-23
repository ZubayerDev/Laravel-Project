<?php 
require '../database/db_connect.php';
?>
<?php require '../admin_page/header.php'?>

<form action="logo_update.php" method="POST" enctype="multipart/form-data">
  <?php if(isset($_SESSION['done'])){?>
    <div class="alert alert-success" ><?=$_SESSION['done']?></div>
  <?php } unset($_SESSION['done'])?>
  <div class="row">
    <div class="col-lg-6">
      <div class="card">
        <div class="card-header">
          <h3>Header logo</h3>
        </div>
        <div class="card-body">     
          <div class="md-3">
            <label for="header_logo" class="label-control">header logo</label>
            <input type="file" name="header_logo" onchange="document.getElementById('emon').src = window.URL.createObjectURL(this.files[0])" class="form-control"/>
              <?php if(isset($_SESSION['err'])){?>
                <div class="alert alert-success" ><?=$_SESSION['err']?></div>
              <?php } unset($_SESSION['err'])?>
          </div>
          <div class="mt-2">
            <img width="70px" src="/sage/logo/logos/header_logo.png" id="emon"/>
          </div>
          <button class="btn btn-primary mt-4" name="btn" value="1">Update</button>
        </div>
      </div>
    </div>

    <div class="col-lg-6">
    <?php if(isset($_SESSION['done1'])){?>
    <div class="alert alert-success" ><?=$_SESSION['done1']?></div>
  <?php } unset($_SESSION['done1'])?>
      <div class="card">
        <div class="card-header">
          <h3>footer logo</h3>
        </div>
        <div class="card-body">     
          <div class="md-3">
            <label for="header_logo" class="label-control">footer logo</label>
            <input type="file" name="footer_logo" onchange="document.getElementById('emon1').src = window.URL.createObjectURL(this.files[0])" class="form-control"/>
              <?php if(isset($_SESSION['err1'])){?>
                <div class="alert alert-success" ><?=$_SESSION['err1']?></div>
              <?php } unset($_SESSION['err1'])?>
          </div>
          <div class="mt-2">
            <img width="70px" src="/sage/logo/logos/footer_logo.png" id="emon1"/>
          </div>
          <button class="btn btn-primary mt-4" name="btn" value="2">Update</button>
        </div>
      </div>
    </div>
  </div>
</form>





<?php require '../admin_page/footer.php'?>

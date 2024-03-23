<?php session_start();?>
<!DOCTYPE html>
<!---Coding By CodingLab | www.codinglabweb.com--->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Registration Form in HTML CSS</title>
    <!---Custom CSS File--->
    <link rel="stylesheet" href="style1.css"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
    <section class="container">
      <header>Registration Form</header>
      <div class="card-body">
        <?php if(isset($_SESSION['sucsess'])){?>
            <div class="alert alert-success"><?=$_SESSION['sucsess']?></div>
        <?php } unset($_SESSION['sucsess'])?>
      </div>
<!--from start-->
      <form action="register_post.php" class="form" method="post">
        <div class="input-box">
          <!--from name-->
          <label for="name">Full Name</label>
          <input type="text" placeholder="Enter full name" name="name" value="<?=isset($_SESSION['name_value'])?$_SESSION['name_value']:''?>"/>
          <?php if(isset($_SESSION['name_err'])){?>
            <?=$_SESSION['name_err']?>
           <?php } unset($_SESSION['name_err'])?> 
        </div>
          <!--from email-->
        <div class="input-box">
          <label for="email">Email Address</label>
          <input type="email" name="email" placeholder="Enter email address" value="<?=isset($_SESSION['email_value'])?$_SESSION['email_value']:''?>" required/>
          <?php if(isset($_SESSION['email_err'])){?>
            <?=$_SESSION['email_err']?>
           <?php } unset($_SESSION['email_err'])?> 
        </div>
          <!--from number-->
        <div class="column">
          <div class="input-box">
            <label for="number">Phone Number</label>
            <input type="cell" name="number" placeholder="Enter phone number" value="<?=isset($_SESSION['nam_value'])?$_SESSION['nam_value']:''?>"/>
              <?php if(isset($_SESSION['nam_err'])){?>
                <?=$_SESSION['nam_err']?>
              <?php } unset($_SESSION['nam_err'])?> 
          </div>
        </div>
      <!--from gender-->
      <?php 
      $gen = '';
      if(isset($_SESSION['gender_value'])){
        $gen = $_SESSION['gender_value'];
      }
      ?>
        <div class="gender-box">
          <h3>Gender</h3>
          <div class="gender-option">
            <div class="gender">
              <input type="radio" id="gender1" name="gender" value="male"<?=$gen=='male'?'checked':''?>/>
              <label for="gender">male</label>
            </div>
            <div class="gender">
              <input type="radio" id="gender2" name="gender" value="female"<?=$gen=='female'?'checked':''?>/>
              <label for="gender">Female</label> 
            </div>
          </div>
          <?php if(isset($_SESSION['gender_err'])){?>
                <?=$_SESSION['gender_err']?>
              <?php } unset($_SESSION['gender_err'])?>
        </div>
        <!--from address-->
        <div class="input-box address">
          <label for="address">Address</label>
          <input type="text" name="address" placeholder="Enter street address" value="<?=isset($_SESSION['address_value'])?$_SESSION['address_value']:''?>" required/>
          <?php if(isset($_SESSION['address_err'])){?>
                <?=$_SESSION['address_err']?>
              <?php } unset($_SESSION['address_err'])?>
        <!--from country-->
        <?php
        $con = '';
        if(isset($_SESSION['country_value'])){
          $con = $_SESSION['country_value'];
        }
        ?>
          <div class="column">
            <div class="select-box">
              <select name="country">
                <option hidden value="false">Country</option>
                <option value="America" <?=$con=='America'?'selected':''?>>America</option>
                <option value="Japan"  <?=$con=='Japan'?'selected':''?>>Japan</option>
                <option value="Japan"  <?=$con=='Japan'?'selected':''?>>Japan</option>
                <option value="Nepal"  <?=$con=='Nepal'?'selected':''?>>Nepal</option>
              </select>
            </div>
          </div>
          <?php if(isset($_SESSION['country_err'])){?>
                <?=$_SESSION['country_err']?>
              <?php } unset($_SESSION['country_err'])?>
        </div>
        <!--from hobbies-->
        <?php 
        $hob = '';
        if(isset($_SESSION['hobbie_value'])){
          $hob = $_SESSION['hobbie_value'];
        }
        ?>
        <div class="hobbie-box">
          <h3>Hobbies</h3>
          <div class="hobbie-option">
            <div class="hobbie">
              <input type="checkbox" id="Song" name="hobbie" value="Song" <?=$hob=='song'?'checked':''?>/>
              <label for="Song">Song</label>
            </div>
            <div class="hobbie">
              <input type="checkbox" id="Ride" name="hobbie" value="Ride" <?=$hob=='Ride'?'checked':''?>/>
              <label for="Ride">Ride</label> 
            </div>
            <div class="hobbie">
              <input type="checkbox" id="Jumping" name="hobbie" value="Jumping" <?=$hob=='Jumping'?'checked':''?>/>
              <label for="Jumping">Jumping</label> 
            </div>
            <div class="hobbie">
              <input type="checkbox" id="Movie" name="hobbie" value="Movie" <?=$hob=='Movie'?'checked':''?>/>
              <label for="Movie">Movie</label> 
            </div>
            <div class="hobbie">
              <input type="checkbox" id="Football" name="hobbie" value="Football" <?=$hob=='Football'?'checked':''?>/>
              <label for="Football">Football</label> 
            </div>
          </div>
          <?php if(isset($_SESSION['hobbie_err'])){?>
                <?=$_SESSION['hobbie_err']?>
            <?php } unset($_SESSION['hobbie_err'])?>
        </div>
          <!--from password-->
          <div class="input-box">
          <label for="password">password</label>
          <input type="password" placeholder="Enter Password" name="password" value="<?=isset($_SESSION['pass_value'])?$_SESSION['pass_value']:''?>"/>
          <?php if(isset($_SESSION['pass_err'])){?>
            <?=$_SESSION['pass_err']?>
           <?php } unset($_SESSION['pass_err'])?> 
        </div>
        <button>Submit</button>
      </form>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
<?php 
unset($_SESSION['name_value']);
unset($_SESSION['email_value']);
unset($_SESSION['nam_value']);
unset($_SESSION['gender_value']);
unset($_SESSION['address_value']);
unset($_SESSION['country_value']);
unset($_SESSION['hobbie_value']);
unset($_SESSION['pass_value']);
?>
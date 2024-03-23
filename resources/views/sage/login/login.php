<?php session_start();?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Registration Form in HTML CSS</title>
    <!---Custom CSS File--->
    <link rel="stylesheet" href="style.css"/>
    <!---Custom Bosttrap File--->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <!---Custom Font awosome File--->
    <link rel="stylesheet" href="font-awesome-4.7.0/css/font-awesome.min.css">
    <!---Custom jquery File--->
    <script src="https://code.jquery.com/jquery-3.7.1.slim.min.js"></script>
  </head>
  <body>
  <style>
        .eye_button {
            position: relative;
        }
        i {
            position: absolute;
            padding-top: 10px;
            top: 55%;
            right: 0px;
            font-size: 40px;
            text-align: center;
            width: 40px;
            height: 38px;
            line-height: 40px;
            transform: translate(-50%, 50%);
            background-color: chocolate;
            border-radius: 10px 0px 10px 0px;
        }
    </style>
    <section class="container">
      <header>Login page</header>
<!--from start-->
      <form action="login_post.php" class="form" method="post">
          <!--from email-->
        <div class="input-box">
          <label for="email">Email Address</label>
          <input type="email" name="email" placeholder="Enter email address" value="<?=isset($_SESSION['email_value'])?$_SESSION['email_value']:''?>"/>
          <?php if(isset($_SESSION['email_err'])){?>
                <?=$_SESSION['email_err']?>
            <?php } unset($_SESSION['email_err'])?>
        </div>
          <!--from password-->
          <div class="input-box">
          <label for="password">password</label>
          <input type="password" placeholder="Enter Password" name="password" id="pass" class="eye_button" value="<?=isset($_SESSION['pass_value'])?$_SESSION['pass_value']:''?>"/>
          <?php if(isset($_SESSION['pass_err'])){?>
                <?=$_SESSION['pass_err']?>
            <?php } unset($_SESSION['pass_err'])?>
        </div>
        <i class="fa fa-eye" aria-hidden="true"></i>
        <button>Submit</button>
      </form>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $('i').click(function(){
            let show_password =document.getElementById('pass');
            if(show_password.type == 'password'){
                show_password.type = "text";
            }
            else {
                show_password.type = "password";
            }
        })
    </script>
 <?php  if(isset($_SESSION["logout"])){ ?>
        <script>
            const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
            });
            Toast.fire({
            icon: "success",
            title: "Signed out successfully"
            });
        </script>
<?php } unset($_SESSION["logout"]) ?>
</body>
</html>

<?php
unset($_SESSION['email_value']);
unset($_SESSION['pass_value']);
?>


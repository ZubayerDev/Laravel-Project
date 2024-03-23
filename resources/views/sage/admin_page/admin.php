<?php 
    require 'header.php';

    require "../login/login_cheack.php"; 
?>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h2>Welcome to our admin page</h2>
        </div>
    </div>
</div>





 <?php  if(isset($_SESSION["login_sucsess"])){ ?>
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
            title: "Signed in successfully"
            });
        </script>
<?php }
unset($_SESSION["login_sucsess"]);
require 'footer.php';
?>




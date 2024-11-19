<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
ob_start();
if(!isset($_SESSION['system'])){
    $system = $conn->query("SELECT * FROM system_settings limit 1")->fetch_array();
    foreach($system as $k => $v){
        $_SESSION['system'][$k] = $v;
    }
}
ob_end_flush();
?>
<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title><?php echo $_SESSION['system']['name'] ?></title>

<?php include('./header.php'); ?>
<?php 
if(isset($_SESSION['login_id']))
header("location:index.php?page=home");
?>

</head>
<style>
    body {
        width: 100%;
        height: calc(100%);
    }
    main#main {
        width: 100%;
        height: calc(100%);
        background: white;
    }
    #login-right {
        position: absolute;
        right: 0;
        width: 40%;
        height: calc(100%);
        background: white;
        display: flex;
        align-items: center;
    }
    #login-left {
        position: absolute;
        left: 0;
        width: 60%;
        height: 100%;
        background: #59b6ec61;
        display: flex;
        align-items: center;
        background: url(assets/uploads/<?php echo $_SESSION['system']['cover_img'] ?>);
        background-repeat: no-repeat;
        background-size: cover; /* Ensures the image covers the entire area */
        background-position: center; /* Centers the image */
    }
    #login-right .card {
        margin: auto;
        z-index: 1;
    }
    .logo {
        margin: auto;
        font-size: 8rem;
        background: white;
        padding: 0.5em 0.7em;
        border-radius: 50% 50%;
        color: #000000b3;
        z-index: 10;
    }
</style>

<body>
  <main id="main" class="bg-dark">
        <div id="login-left">
        </div>
        <div id="login-right">
            <div class="card col-md-8">
                <div class="card-body">
                    <form id="login-form">
                        <div class="form-group">
                            <label for="username" class="control-label">Username</label>
                            <input type="text" id="username" name="username" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="password" class="control-label">Password</label>
                            <div class="input-group">
                                <input type="password" id="password" name="password" class="form-control">
                                <div class="input-group-append">
                                    <span class="input-group-text" onclick="togglePasswordVisibility()">
                                        <i class="fa fa-eye" id="toggleEye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <center><button class="btn-sm btn-block btn-wave col-md-4 btn-primary">Login</button></center>
                        </div>
                        <div class="form-group">
                            <center>
                                <button type="button" class="btn btn-danger btn-block">
                                    <i class="fa fa-google"></i> Sign in with Google
                                </button>
                            </center>
                        </div>
                        <div class="form-group">
                            <center>
                                <a href="forgot_password.php" class="btn btn-link">Forgot Password?</a>
                            </center>
                        </div>
                        <div class="form-group">
                            <center>
                                <a href="create_account.php" class="btn btn-success btn-block">Create Account</a>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
  </main>
  <a href="#" class="back-to-top"><i class="icofont-simple-up"></i></a>

  <script>
    function togglePasswordVisibility() {
        var passwordInput = document.getElementById("password");
        var toggleEye = document.getElementById("toggleEye");
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            toggleEye.classList.remove("fa-eye");
            toggleEye.classList.add("fa-eye-slash");
        } else {
            passwordInput.type = "password";
            toggleEye.classList.remove("fa-eye-slash");
            toggleEye.classList.add("fa-eye");
        }
    }

    $('#login-form').submit(function(e){
        e.preventDefault();
        $('#login-form button[type="button"]').attr('disabled', true).html('Logging in...');
        if($(this).find('.alert-danger').length > 0 )
            $(this).find('.alert-danger').remove();
        $.ajax({
            url: 'ajax.php?action=login',
            method: 'POST',
            data: $(this).serialize(),
            error: err => {
                console.log(err);
                $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
            },
            success: function(resp) {
                if (resp == 1) {
                    location.href = 'index.php?page=home';
                } else if (resp == 2) {
                    location.href = 'voting.php';
                } else {
                    $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>');
                    $('#login-form button[type="button"]').removeAttr('disabled').html('Login');
                }
            }
        })
    })
  </script> 
</body>
</html>

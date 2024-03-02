<?php
include("app/Controllers/Controller.php");
include("app/Controllers/AdminController.php");
$adminCtrl = new AdminController;
if(isset($_POST['try_login']))
{
	$username = $_POST['username'];
	$password = sha1($_POST['password']);
	$adminData = $adminCtrl->tryLogin( $username, $password );
	
	if(!empty($adminData))
	{
	
		$_SESSION['SMC_login_time'] = date("Y-m-d H:i:s");
		$_SESSION['SMC_login_id'] = $adminData[0]['id'];
		$_SESSION['SMC_login_admin_name'] = $adminData[0]['admin_name'];
		$_SESSION['SMC_login_admin_email'] = $adminData[0]['admin_email'];
		$_SESSION['SMC_login_admin_image'] = $adminData[0]['admin_image'];
		$_SESSION['SMC_login_admin_status'] = $adminData[0]['admin_status'];
		$_SESSION['SMC_login_admin_type'] = $adminData[0]['admin_type'];
		
	
		header("Location: dashboard");
	}
}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Admin Login</title>
		<link href="../public/assets/css/client/index.css" rel="stylesheet">
	</head>
	<body>
	<main class="main" style="height: 100vh;">
	<div class="container-center">
    <div class="container-login">



        <div class="forms">
            <div class="form-log login">
                <span class="title">Login</span>
                <form action="" method="post">
                    <div class="input-field">
                        <input name="username" type="email"  placeholder="Enter your email" required>


                    </div>
                    <div class="input-field">
                        <input name="password" type="password" class="password" placeholder="Enter your password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>
              
                    <div class="input-field button">
                        <input type="submit" name="try_login"  value="Login">
                    </div>
                </form>
     
            </div>
       
        </div>
    </div>
	</div>
	</main>
	</body>
</html>		
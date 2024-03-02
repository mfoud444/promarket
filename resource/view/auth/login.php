<?php
include_once('resource/view/include/index.php');

if( isset($_POST['user_login']) )
{
	$columnName = "*";
	$tableName = "customers";
	$whereValue["customer_email"] = $_POST['user_email'];
	$whereValue["customer_password"] = sha1($_POST['user_pass']);
	$userLogin = $eloquent->selectData($columnName, $tableName, @$whereValue);

	if(!empty($userLogin))
	{
		$_SESSION['SSCF_login_time'] = date("Y-m-d H:i:s");
		$_SESSION['SSCF_login_id'] = $userLogin[0]['id'];
		$_SESSION['SSCF_login_user_name'] = $userLogin[0]['customer_name'];
		$_SESSION['SSCF_login_user_email'] = $userLogin[0]['customer_email'];
		$_SESSION['SSCF_login_user_mobile'] = $userLogin[0]['customer_mobile'];
		$_SESSION['SSCF_login_user_address'] = $userLogin[0]['customer_address'];
		
		echo '<meta http-equiv="Refresh" content="0; url=index" />';
	}
}

?>
<main class="main">

    <?php
		$links = [
			['url' => 'index', 'label' => $t('home', 1)],
	
			['url' => '', 'label' => $t('login', 1)],
		];
		echo BreadcrumbGenerator::generateBreadcrumb($links);
		?>


	<div class="container-center" style="justify-content:space-evenly; flex-wrap:wrap">
	<img src="public/assets/images/logo.jpeg" width="800px" height="500px"/>
    <div class="container-login">

	<?php
			if(isset($_POST['user_login']))
			{
			
				if(empty($userLogin))
				{
					showToast($t('customer-dosenot-exist', 1));
					
				}
			}
		?>

        <div class="forms">
            <div class="form-log login">
                <span class="title"><?php $t('login')?></span>
			
                <form action="" id="frmSignIn" method="post">
                    <div class="input-field">
                        <input type="email" name="user_email" placeholder="Enter your email" required>


                    </div>
                    <div class="input-field">
                        <input type="password" name="user_pass" class="password" placeholder="Enter your password" required>
                        <i class="uil uil-lock icon"></i>
                        <i class="uil uil-eye-slash showHidePw"></i>
                    </div>
                    <div class="checkbox-text">
                     
                        
                        <a href="user-password" class="text"><?php $t('Forgot password?')?></a>
                    </div>
                    <div class="input-field button">
                        <input type="submit" name="user_login" value="Login">
                    </div>
                </form>
                <div class="login-signup">
                    <span class="text"><?php $t('Not a member?')?>
                        <a href="register-account" class="text signup-link"><?php $t('Signup Now')?></a>
                    </span>
                </div>
            </div>
       
        </div>
    </div>
	</div>

</main>	

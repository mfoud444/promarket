<?php
include_once('resource/view/include/index.php');
include('resource/view/include/index.php');
if (isset($_POST['userRegistration'])) {
	if (
		!empty($_POST['acc_fname'])  && !empty($_POST['acc_email']) && !empty($_POST['acc_password']) && !empty($_POST['acc_mobile']) &&
		!empty($_POST['acc_address'])
	) {
		
		$tableName = "customers";
		$columnValue["customer_name"] = $_POST['acc_fname'];
		$columnValue["customer_email"] = $_POST['acc_email'];
		$columnValue["customer_password"] = sha1($_POST['acc_password']);
		$columnValue["customer_mobile"] = $_POST['acc_mobile'];
		$columnValue["customer_address"] = $_POST['acc_address'];
		$columnValue["created_at"] = date("Y-m-d H:i:s");

		$registerUser = $eloquent->insertData($tableName, $columnValue);
	}
}

?>

<main class="main">


	<?php
		$links = [
			['url' => 'index', 'label' => $t('home', 1)],
			['url' => 'login', 'label' => $t('Register-Account', 1)],
		
		];
		echo BreadcrumbGenerator::generateBreadcrumb($links);
		?>
	<div class="container-center" style="justify-content:space-evenly; flex-wrap:wrap">>
	<img src="public/assets/images/logo.jpeg" width="800px" height="500px"/>
	<div class="container-login">


		<?php
	
		if (isset($_POST['userRegistration'])) {
			if (@$registerUser > 0) {
				showToast($t('Thank you for registering', 1));
		
			}
		}
		?>



		<div class="forms">


			<div class="form-log">
				
				<span class="title"><?php $t('Registration')?></span>
			
				<form action="" method="post">
					<div class="input-field">
						<input type="text" name="acc_fname" placeholder="Enter your name" required>
						<i class="uil uil-user"></i>
					</div>
					<div class="input-field">
						<input type="email" name="acc_email" placeholder="Enter your email" required>
						<i class="uil uil-envelope icon"></i>
					</div>
					<div class="input-field">
						<input type="password" name="acc_password" class="password" placeholder="Create a password" required>
						<i class="bx bx-hide showHidePw"></i>
					</div>


					<div class="input-field">
						<input type="text" class="form-control" name="acc_mobile" placeholder="+966 *********" required>


					</div>
					<div class="input-field">
					<input type="text" class="form-control" name="acc_address" placeholder="type your address please..." required>
					</div>
			
					<div class="input-field button">
						<input type="submit" name="userRegistration" value="Signup">
					</div>
				</form>
				<div class="login-signup">
					<span class="text"><?php $t('Already a member?')?>
						<a href="login" class="text"><?php $t('Login Now')?></a>
					</span>
				</div>
			</div>
		</div>
	</div>

	</div>


</main>


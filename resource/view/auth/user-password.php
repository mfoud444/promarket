<?php
include_once('resource/view/include/index.php');
?>
<main class="main">
    <?php
		$links = [
			['url' => 'index', 'label' => $t('home', 1)],
			['url' => 'login', 'label' => $t('Forgot-Password', 1)],
		
		];
		echo BreadcrumbGenerator::generateBreadcrumb($links);
		?>

    <div class="container">
        <div class="row">
            <div class="order-lg-last dashboard-content">

                <?php
				if (@$_SESSION['SSCF_login_id'] > 0) {
				?>
                <div class="col-md-12">
                    <form class="form-horizontal" action="" method="">
                        <div >
                            <h2>CHANGE PASSWORD</h2>
                            <div class="form-group required-field">
                                <label for="acc-pass2">Current Password</label>
                                <input type="password" class="form-control" id="acc-pass2" name="acc-pass2">
                            </div>
                            <div class="form-group required-field">
                                <label for="acc-pass2">New Password</label>
                                <input type="password" class="form-control" id="acc-pass2" name="acc-pass2">
                            </div>
                            <div class="form-group required-field">
                                <label for="acc-pass3">Confirm Password</label>
                                <input type="password" class="form-control" id="acc-pass3" name="acc-pass3">
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </div>
                        </div>
                    </form>
                </div>

                <?php
				} else {
				?>
<?php
if (isset($_POST['reset-email'])) {
    $email = $_POST['reset-email'];
    $emailSentSuccessfully = true;
    if ($emailSentSuccessfully) {
        $showSuccessMessage = true;
    }
}
?>

<div class="container-login">
    <div class="forms">
        <div class="form-log">
            <span class="title">Reset Password</span>
            <p style="padding-top: 20px; padding-bottom: 20px;">Please enter your email address below to receive a
                password reset link.</p>

            <!-- Check if the success message should be displayed -->
            <?php if (isset($showSuccessMessage) && $showSuccessMessage) { ?>
                <div class="alert-success show">The link to change the password has been sent to your email.</div>
            <?php } ?>

            <form action="" method="post">
                <div class="input-field">
                    <input type="email" id="reset-email" name="reset-email" placeholder="Enter your email" required>
                </div>
                <div class="input-field button">
                    <input type="submit" value="Reset My Password">
                </div>
            </form>
        </div>
    </div>
</div>






                <?php
				}
				?>

            </div>

</main>
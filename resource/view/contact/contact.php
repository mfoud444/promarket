<?php

include_once('resource/view/include/index.php');



if(isset($_POST['user_contact']))
{
	
	
	$tableName = "contacts";
	$columnValue["contacts_name"] = $_POST['contact_name'];
	$columnValue["contacts_email"] = $_POST['contact_email'];
	$columnValue["contacts_phone"] = $_POST['contact_phone'];
	$columnValue["contacts_overview"] = $_POST['contact_message'];
	$columnValue["created_at"] = date("Y-m-d H:i:s");
	$contactsData = $eloquent->insertData($tableName, $columnValue);
}

?>

<main class="main">
    <?php
		$links = [
			['url' => 'index', 'label' => $t('home', 1)],
			['url' => '#', 'label' => $t('Contact-Us', 1)],
		
		];
		echo BreadcrumbGenerator::generateBreadcrumb($links);
		?>
	<div class="page-header">
		<div class="container">
			
			<?php 
			
				if(isset($_POST['user_contact']))
				{
					if($contactsData > 0)
					showToast($t('contact-soon', 1));
					
				}
			?>
			   <header class="panel-heading">
			 <?= $t('Contact-Us')?>
            </header>
			
		</div>
	</div>
		<div class="flex flex-1">
			<div class="form-horizontal" style="width: 400px">
				<h2 class="light-title">  <?= $t('Write <strong>Us</strong>')?> </h2>
				<form  action="" method="post">
					<div class="form-group required-field">
						<label for="contact-name">  <?= $t('Name')?> </label>
						<input type="text" class="form-control" name="contact_name" required>
					</div>
					<div class="form-group required-field">
						<label for="contact-email">  <?= $t('Email')?> </label>
						<input type="email" class="form-control" name="contact_email" required>
					</div>
					<div class="form-group">
						<label for="contact-phone">  <?= $t('Phone Number')?> </label>
						<input type="tel" class="form-control" name="contact_phone">
					</div>
					<div class="form-group required-field">
						<label for="contact-message">  <?= $t('What’s on your mind?')?> </label>
						<textarea cols="30" rows="1" class="form-control" name="contact_message" required></textarea>
					</div>
				
						<button type="submit" name="user_contact" class="btn btn-primary" style="width: 100%; margin-top:10px;"> <?= $t('Submit')?> </button>
				
				</form>
			</div>
			<div class="form-horizontal">
				<h2 class="light-title"><?= $t('Contact <strong>Details</strong>')?> </h2>
				<ul>
					<li class="flex-info1">
						<i class='bx bxs-phone box-icon'></i>
						<div><?php echo $GLOBALS['phone-store'] ?></div>
					
					</li>
					<li class="flex-info1"><i class='bx bxs-location-plus  box-icon' ></i>
					
					<div><?php echo $GLOBALS['address-store'] ?></div>
				
				</li>
					<li class="flex-info1">
					<i class='bx bxs-envelope  box-icon'></i>
					<div><?php echo $GLOBALS['email-store'] ?></div>
					</li>
				</ul>
			</div>
		</div>
	</div>

</main>

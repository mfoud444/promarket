<?php
include("resource/view/include/index.php");
if( isset($_POST['try_delete']) )
{
	$rowDeleted = $adminCtrl->deleteAdminData($_POST['id']);
}
if( isset($_POST['try_status_change']) )
{
	$statusChange = $adminCtrl->changeAdminStatus($_POST['id'], $_POST['current_status']);
}
$adminList = $adminCtrl->listAdminData();
?>

<div class="wrapper">
	<div class="row">
	
	<?php
		$links = [
			['url' => 'dashboard', 'label' => $t('home', 1)],
			['url' => 'dashboard', 'label' => $t('dashboard', 1)],
			['url' => '', 'label' => $t('List-of-Admin', 1)],
		];
		echo BreadcrumbGenerator::generateBreadcrumb($links);
		

		?>
	
			<section class="panel">
				<header class="panel-heading">
					<?php $t('List-of-Admin')?>
				</header>
				<div class="panel-body">
					
					<?php
					
						if( isset($_POST['try_delete']) )
						{
							if($rowDeleted > 0)
							{
								showToast($t('ADMIN-DELETED-SUCCESSFULLY', 1));
								
						
							}
						}
						
					
						if( isset($_POST['try_status_change']) )
						{
							if($statusChange > 0)
							{
								showToast($t('ADMIN-STATUS-CHANGED', 1));
						
							
						
							}
						}
					?>
					
					<div class="div-table">
					<table class="styled-table" id="dynamic-table">
							<thead>
								<tr>
									<th style="width: 5%"><?php $t('ID') ?> </th>
									<th style="width: 22%"><?php $t('Admin-Name') ?></th>
									<th style="width: 20%"><?php $t('Admin-Email') ?></th>
									<th style="width: 10%"><?php $t('Admin-Image') ?></th>
									<th style="width: 18%"><?php $t('Admin-Type') ?></th>
									<th style="width: 10%"><?php $t('Admin-Status') ?></th>
									<th style="width: 15%" class="hidden-phone"><?php $t('Action') ?></th>
								</tr>
							</thead>
							<tbody>
								
								<?php 
							
									$n = 1;
									foreach($adminList AS $eachRow)
									{
									
										if(empty($eachRow['admin_image']))
										{
											$adminImage = $GLOBALS['ADMINS_DIRECTORY']."rootadmin.png";
										}
										else
										{
											$adminImage = $GLOBALS['ADMINS_DIRECTORY'].$eachRow['admin_image'];
										}
										
										echo '
										<tr class="gradeA">
											<td>'. $n .'</td>
											<td>'. $eachRow['admin_name'] .'</td>
											<td>'. $eachRow['admin_email'] .'</td>
											<td class="center">
												<a target="_blank" href="'. $adminImage .'">
													<img src="'. $adminImage .'" class="img-circle" height="48px" width="45px">
												</a>
											</td>
											<td>'.$eachRow['admin_type'].'</td>
											<td class="center">
												<div>
													<form action="" method="post">
														<input type="hidden" name="id" value="'. $eachRow['id'] .'" />
														<input type="hidden" name="current_status" value="'. $eachRow['admin_status'] .'" />
														<button name="try_status_change" class="btn-switch"  type="submit">
														<div class="switch">
														<input  type="checkbox"  id="switch" ' . ($eachRow["admin_status"] == "Active" ? 'checked' : '') . '/>
														<label for="switch"></label>
														 </div>
														
														
														</button>
													</form>
												</div>
											</td>
											<td>
												<div class="flex-button">
													<form action="" method="post" >
														<input type="hidden" name="id" value="'. $eachRow['id'] .'" />
														<button name="try_delete" class="btn-switch" type="submit" >
														<img src="../public/assets/images/delete.svg" class="hero-icon delete" alt="Delete">
														</button>
													</form>
													<form action="edit-admin" method="post" >
														<input type="hidden" name="id" value="'. $eachRow['id'] .'" />
														<button name="try_edit" class="btn-switch" type="submit">
														<img src="../public/assets/images/edit.svg" class="hero-icon" alt="Edit">
														</button>
													</form>
												</div>
											</td>
										</tr>
										';
										$n++;
									}
								?>
								
							</tbody>
						
						</table>
					</div>
				</div>
			</section>
		</div>

</div>

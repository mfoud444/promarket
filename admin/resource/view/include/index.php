<?php
include("app/Controllers/Controller.php");
include("app/Controllers/DashboardController.php");
include("app/Controllers/AdminController.php");
include_once("../common/Helper.php");
include("../common/breadcrumb.php");
include("../app/Controllers/Lang.php");
include("../common/showToast.php");
$control = new Controller;
$adminCtrl = new AdminController;
$eloquent = new Helper;
$dashboard = new DashboardController;

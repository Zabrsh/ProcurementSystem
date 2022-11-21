<?php
	
require_once "controllers/template.controller.php";
require_once "controllers/employees.controller.php";
require_once "controllers/purchase.request.controller.php";

require_once "models/employees.model.php";
require_once "models/purchase.request.model.php";

$template = new ControllerTemplate();
$template -> ctrTemplate();

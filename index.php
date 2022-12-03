<?php
namespace App;

require 'vendor/autoload.php';

session_start();

function getAction() {
	if (!isset($_REQUEST['action'])) $action = 'Default';
	else $action = $_REQUEST['action'];

	$actions = array('Default',
			'SignUpForm',
			'SignUp',
			'Logout',
			'Login',
			/*'UpdateUserForm',
			'UpdateUser',*/
			'AddSurveyForm',
			'AddSurvey',
			/*'GetMySurveys',
			'Search',
			'Vote'*/);

	if (!in_array($action, $actions)) {
		$action = "App\\Actions\\DefaultAction";
	} else {
		$action = "App\\Actions\\{$action}Action";
	}
	
	return new $action();
}

$action = getAction();
$action->run();
$view = $action->getView();
$model = $action->getModel();
$view->run($model);
?>
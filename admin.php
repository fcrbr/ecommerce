<?php 

use \Hcode\PageAdmin;
use \Hcode\Model\User;

$app->get('/soquemadm', function() {
    
	User::verifyLogin();

	$page = new PageAdmin();

	$page->setTpl("index");

});

$app->get('/soquemadm/login', function() {

	 $page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("login"); 



	});




$app->post('/soquemadm/login', function() {

	User::login($_POST["login"], $_POST["password"]);

	header("Location: /soquemadm");
	exit;

});

$app->get('/soquemadm/logout', function() {

	User::logout();

	header("Location: /soquemadm/login");
	exit;

});

$app->get("/soquemadm/forgot", function() {

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot");	

});

$app->post("/soquemadm/forgot", function(){

	$user = User::getForgot($_POST["email"]);

	header("Location: /soquemadm/forgot/sent");
	exit;

});

$app->get("/soquemadm/forgot/sent", function(){

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot-sent");	

});


$app->get("/soquemadm/forgot/reset", function(){

	$user = User::validForgotDecrypt($_GET["code"]);

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot-reset", array(
		"name"=>$user["desperson"],
		"code"=>$_GET["code"]
	));

});

$app->post("/soquemadm/forgot/reset", function(){

	$forgot = User::validForgotDecrypt($_POST["code"]);	

	User::setFogotUsed($forgot["idrecovery"]);

	$user = new User();

	$user->get((int)$forgot["iduser"]);

	$password = User::getPasswordHash($_POST["password"]);

	$user->setPassword($password);

	$page = new PageAdmin([
		"header"=>false,
		"footer"=>false
	]);

	$page->setTpl("forgot-reset-success");

});

 ?>
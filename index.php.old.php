<?php 
session_start();

require_once("vendor/autoload.php");

use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;
use \Hcode\Model\User;

$app = new Slim();

$app->config('debug', true);

$app->get('/', function() {

	$page = new Page();

	$page->setTpl("index");
  
});


$app->get('/soquemadm/', function() { 
    User::verifyLogin();
    $page = new PageAdmin();
 
    $page->setTpl("index"); 
 
});

$app->get('/soquemadm/login/', function() { 
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

$app->get('/soquemadm/users', function() {

       User::verifyLogin();

       $page = new PageAdmin();
       
       $page->setTpl("users"); 
});

$app->get('/soquemadm/create', function() {

    User::verifyLogin();

    $page = new PageAdmin();
    
    $page->setTpl("users-create"); 
});

$app->get('/soquemadm/users/:iduser', function($iduser) {

    User::verifyLogin();

    $page = new PageAdmin();
    
    $page->setTpl("users-update"); 
});

$app->post('/admin/users/create', function() {

    User::verifyLogin();

});

$app->post('/soquemadm/users/:iduser', function($iduser) {

    User::verifyLogin();

});

$app->delete('/soquemadm/users/:iduser', function($iduser) {

    User::verifyLogin();

});





$app->run();

 ?>
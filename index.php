<?php

require_once("vendor/autoload.php");

// Configurações de exibição de erros
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

use \Slim\Slim;
use \Hcode\Page;
use \Hcode\PageAdmin;


$app = new Slim();


use Hcode\DB\Sql;

$app->config('debug', true);

$app->get('/', function() {
$page = new Page();
$page->setTpl("index");

});



$app->get('/admin', function() {
    

	$page = new PageAdmin();

	$page->setTpl("index");

});

$app->get('/test', function() use ($app) {
   // $app->log->debug("Test route accessed");
    echo "Test route";
});


$app->run();
?>

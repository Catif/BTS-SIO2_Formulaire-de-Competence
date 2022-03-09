<?php

// autoload
require './vendor/autoload.php';

// Initialisation de la base de donnée
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


// Chargement de la session
if( session_status() == PHP_SESSION_NONE ){
    session_start();
    if(!isset($_SESSION['role'])){
        $_SESSION['role'] = 'visitor';
    }
}


define("HTML_ROOT", $_ENV['html_root']);
define("PHP_ROOT", __DIR__);


// Start AltoRouter
$router = new AltoRouter();
$router->setBasePath($_ENV['router_basePath']);


require PHP_ROOT . "/assets/class/database.php";

$db_host = $_ENV['db_host'];
$db_name = $_ENV['db_name'];
$db_user = $_ENV['db_user'];
$db_pswd = $_ENV['db_pswd'];

$db_parameter = [
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8",
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC
];

$db = new Database($db_host, $db_name, $db_user, $db_pswd, $db_parameter);


// Chargement des fichiers de l'application
require PHP_ROOT . "/assets/function.php";
require PHP_ROOT . "/routes/route.php";
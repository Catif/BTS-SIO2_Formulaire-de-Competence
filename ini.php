<?php
// Chargement de la session
if( session_status() == PHP_SESSION_NONE ){
    session_start();
    if(!isset($_SESSION['role'])){
        $_SESSION['role'] = 'visitor';
    }
}


// Définir le chemin de l'application
// exemple : http://localhost:8000
// Important : Ne pas finir le lien par un '/'
define("HTML_ROOT", "http://localhost:8000");
define("PHP_ROOT", __DIR__);


// autoload
require PHP_ROOT . '/vendor/autoload.php';


require_once PHP_ROOT . "/assets/class/database.php";

// Initialisation de la base de donnée
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
// $db_host = $_ENV['db_host'];
// $db_name = $_ENV['db_name'];
// $db_user = $_ENV['db_user'];
// $db_pswd = $_ENV['db_pswd'];

// $db_parameter = [
//     PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8",
//     PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
//     PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC
// ];

// $db = new Database($db_host, $db_name, $db_user, $db_pswd, $db_parameter);



// Chargement des fichiers de l'application
require_once  PHP_ROOT . "/assets/function.php";
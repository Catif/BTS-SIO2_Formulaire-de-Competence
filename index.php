<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Lancement de l'autoload
require './vendor/autoload.php';

// Récupération de la configuration local (Dotenv)
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();


// Chargement de la session
if( session_status() == PHP_SESSION_NONE ){
    session_start();
    if(!isset($_SESSION['role'])){
        $_SESSION['role'] = 'visitor';
    }
}

// Création des constantes
define("HTML_ROOT", $_ENV['html_root']);
define("PHP_ROOT", __DIR__);


// Configuration du router (AltoRouter)
$router = new AltoRouter();
$router->setBasePath($_ENV['router_basePath']);


// Configuration de la base de donnée 
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


// Configuration de l'envoi de mail (PHPMailer)
$mail = new PHPMailer(true);
// $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Information de Debug

// On configure le SMTP
$mail->isSMTP();
$mail->Host = $_ENV['mail_host'];
$mail->Port = $_ENV['mail_port'];

$mail->SMTPAuth = true;
// Compte mail pour l'envoi de code pour le mot de passe oublié
$mail->Username = $_ENV['mail_forget_user'];
$mail->Password = $_ENV['mail_forget_password'];

$mail->CharSet = 'utf-8';


// Chargement des fichiers de l'application
require PHP_ROOT . "/assets/function.php";
require PHP_ROOT . "/routes/route.php";
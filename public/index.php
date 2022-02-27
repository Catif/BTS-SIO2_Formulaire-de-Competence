<?php
require '../ini.php';





// Start AltoRouter
$router = new AltoRouter();



// Map routes
$router->map('GET', '/', 'index', 'HomePage');
$router->map('GET|POST', '/login', 'login', 'Login');
$router->map('GET', '/logout', 'logout', 'Disconnect');
$router->map('GET', '/panel/first', 'panel/first', 'First Login');
$router->map('GET', '/panel/setting', 'panel/setting', 'Setting Profile');
$router->map('GET', '/panel/skills/[a:filterSkill]', 'panel/skills', 'Skills');

$routerName = [ 
    ['id' => 'index',                  'title' => 'Accueil',                    'divId' => 'Home',               'connected' => false],
    ['id' => 'login',                  'title' => 'Page de connexion',          'divId' => 'Login',              'connected' => false],
    ['id' => 'panel/first',            'title' => 'Première connexion',         'divId' => 'First',              'connected' => true,            'first' => true],
    ['id' => 'panel/setting',          'title' => 'Paramètre',                  'divId' => 'Settings',           'connected' => true,            'first' => false],
    ['id' => 'panel/skills',           'title' => 'Compétence',                 'divId' => 'Skills',             'connected' => true,            'first' => false]
];


// Match routes
$match = $router->match();

if (is_array($match)) {
    $params = $match['target'];
    createHeader($routerName, $match['target']);
    require PHP_ROOT . "/views/{$params}.php";
} else {
    require PHP_ROOT . "/views/404.php";
}




require PHP_ROOT . '/assets/components/footer.php';
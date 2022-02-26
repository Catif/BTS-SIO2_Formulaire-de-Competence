<?php
require '../ini.php';





// Start AltoRouter
$router = new AltoRouter();



// Map routes
$router->map('GET', '/', 'index', 'HomePage');
$router->map('GET|POST', '/login', 'login', 'Login');
$router->map('GET', '/panel/profile', 'panel/profile/index', 'Profile user');
$router->map('GET', '/panel/profile/setting', 'panel/profile/setting', 'Setting Profile');
$router->map('GET', '/panel/skills/[a:filterSkill]', 'panel/skills', 'Skills');

$routerName = [ 
    ['id' => 'index',               'title' => 'Accueil',                    'divId' => 'Home'],
    ['id' => 'login',               'title' => 'Page de connexion',          'divId' => 'Login'],
    ['id' => 'panel/profile',       'title' => 'Profil',                     'divId' => 'Forget-Password'],
    ['id' => 'panel/skills',        'title' => 'Compétence',                 'divId' => 'Skills']
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
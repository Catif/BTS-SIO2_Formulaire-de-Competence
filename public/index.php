<?php
require '../ini.php';



// Start AltoRouter
$router = new AltoRouter();



// Map routes
    // Routes visitor
        $router->map('GET', '/', 'index', 'HomePage');
        $router->map('GET|POST', '/login', 'login', 'Login');

    // Routes user connected
        // Routes classique
            $router->map('GET', '/logout', 'logout', 'Disconnect');
            $router->map('GET|POST', '/panel/first', 'panel/first', 'First Login');
            $router->map('GET|POST', '/panel/setting', 'panel/setting', 'Setting Profile');

        // Routes Skills
            $router->map('GET|POST', '/panel/skills/block', 'panel/skills', 'Skills Block');
            $router->map('GET|POST', '/panel/skills/block/[i:id]', 'panel/skills', 'Skills Block with ID');

            $router->map('GET|POST', '/panel/skills/knowledge', 'panel/skills', 'Skills Knowledge');
            $router->map('GET|POST', '/panel/skills/knowledge/[i:id]', 'panel/skills', 'Skills Knowledge with ID');

            $router->map('GET|POST', '/panel/skills/indicator', 'panel/skills', 'Skills Indicator');
            $router->map('GET|POST', '/panel/skills/indicator/[i:id]', 'panel/skills', 'Skills Indicator with ID');


// Array to create variable for each routes : $match['target'] = $routerName['id']
$routerName = [
    // Routes visitor 
        ['id' => 'index',                  'title' => 'Accueil',                    'divId' => 'Home',               'connected' => false],
        ['id' => 'login',                  'title' => 'Page de connexion',          'divId' => 'Login',              'connected' => false],
    
    // Routes user connected
        // Routes classique
            ['id' => 'panel/first',            'title' => 'Première connexion',         'divId' => 'First',              'connected' => true,            'first' => true],
            ['id' => 'panel/setting',          'title' => 'Paramètre',                  'divId' => 'Settings',           'connected' => true,            'first' => false],
        
            // Routes Skills
            ['id' => 'panel/skills',           'title' => 'Compétence',                 'divId' => 'Skills',             'connected' => true,            'first' => false]
];


// Match routes
$match = $router->match();

if (is_array($match)) {
    if (isset($_POST)){
        // Requet POST in Login page
        if ($match['target'] === 'login'){
            if(isset($_POST['email'], $_POST['password'])){
                if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                    
                } else {
                    $message = 'Votre email à un format invalide.';
                }
            }
        }









    }


    createHeader($routerName, $match['target']);
    require PHP_ROOT . "/views/{$match['target']}.php";
} else {
    require PHP_ROOT . "/views/404.php";
}




require PHP_ROOT . '/assets/components/footer.php';
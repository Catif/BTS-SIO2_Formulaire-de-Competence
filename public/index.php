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
            $router->map('GET|POST', '/panel/skills/[a:category]', 'panel/skills', 'Skills Category');
            
            $router->map('GET|POST', '/panel/skills/[a:category]/[i:id]', 'panel/skills', 'Skills Category with ID');


// Array to create variable for each routes : $match['target'] = $routerName['id']
$routerName = [
    // Routes visitor 
        ['id' => 'index',                  'title' => 'Accueil',                    'divId' => 'Home',               'connected' => false],
        ['id' => 'login',                  'title' => 'Page de connexion',          'divId' => 'Login',              'connected' => false],
    
    // Routes user connected
        // Routes classique
            ['id' => 'logout',                 'title' => 'Déconnexion',                'divId' => 'Logout',              'connected' => false],
            ['id' => 'panel/first',            'title' => 'Première connexion',         'divId' => 'First',              'connected' => true,            'first' => true],
            ['id' => 'panel/setting',          'title' => 'Paramètre',                  'divId' => 'Settings',           'connected' => true,            'first' => false],
        
            // Routes Skills
            ['id' => 'panel/skills',           'title' => 'Compétence',                 'divId' => 'Skills',             'connected' => true,            'first' => false]
];


// Match routes
$match = $router->match();

if (is_array($match)) {
    if($_SESSION['role'] === 'visitor'){
        if($match['target'] !== 'index' && $match['target'] !== 'login'){
            Header('Location: ' . HTML_ROOT . '/');
        }



        if (isset($_POST)){
            // Requet POST in Login page
            if ($match['target'] === 'login'){
                if(isset($_POST['email'], $_POST['password'])){
                    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                        $_SESSION['role'] = 'admin';
                        $_SESSION['user-name'] = 'Bradley BARBIER';
                        $_SESSION['user-mail'] = 'bradley.barbier@outlook.fr';
                        $_SESSION['user-classe'] = 'BTS SIO2';
                        $_SESSION['user-specialite'] = 'SLAM';

                        Header('Location: ' . HTML_ROOT . '/panel/setting');
                    } else {
                        $message = 'Votre email à un format invalide.';
                    }
                }
            }
        }





    } else{
        if($match['target'] === 'index' || $match['target'] === 'login'){
            Header('Location: ' . HTML_ROOT . '/panel/setting');
        }

        if( isset($_POST)){
            if($match['target'] === 'panel/skills'){
                
            }
        }
    }



    if($match['target'] === 'logout' && $_SESSION['role'] != 'visitor'){
        $_SESSION['role'] = 'visitor';
        Header('Location: '. HTML_ROOT . '/');
    }
    




    createHeader($routerName, $match['target']);
    require PHP_ROOT . "/views/{$match['target']}.php";
} else {
    require PHP_ROOT . "/views/404.php";
}




require PHP_ROOT . '/assets/components/footer.php';
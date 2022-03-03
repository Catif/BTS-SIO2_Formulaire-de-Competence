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
        ['id' => 'index',                  'title' => 'Accueil',                    'divId' => 'Home'],
        ['id' => 'login',                  'title' => 'Page de connexion',          'divId' => 'Login'],
    
    // Routes user connected
        // Routes classique
            ['id' => 'logout',                 'title' => 'Déconnexion',                'divId' => 'Logout'],
            ['id' => 'panel/first',            'title' => 'Première connexion',         'divId' => 'First'],
            ['id' => 'panel/setting',          'title' => 'Paramètre',                  'divId' => 'Settings'],
        
            // Routes Skills
            ['id' => 'panel/skills',           'title' => 'Compétence',                 'divId' => 'Skills']
];


// Match routes
$match = $router->match();

if (is_array($match)) {
    if($_SESSION['role'] === 'visitor'){
        if($match['target'] !== 'index' && $match['target'] !== 'login'){
            Header('Location: ' . HTML_ROOT . '/');
            die();
        }



        if (!empty($_POST)){
            // Requet POST in Login page
            if ($match['target'] === 'login'){
                if(isset($_POST['email'], $_POST['password'])){
                    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                        $req = $db->query("SELECT * FROM etudiant WHERE `Mail-Pro_Etud` = :email", [':email' => $_POST['email']]);

                        $result = $req->fetch();
                        
                        if(is_array($result) && password_verify($_POST['password'],$result['Mot-de-Passe_Etud'])){
                            $_SESSION['role'] = 'student';
                            $_SESSION['user-name'] = ucfirst(strtolower($result['Prenom_Etud'])) . ' ' . strtoupper($result['Nom_Etud']);
                            $_SESSION['user-id'] = $result['Identifiant_Etud'];

                            Header('Location: ' . HTML_ROOT . '/panel/setting');
                            die();
                        } else{
                            $message = 'Email ou mot de passe invalide.';
                        }
                    } else {
                        $message = 'Votre email à un format invalide.';
                    }
                }
            }
        }





    } else{
        if($match['target'] === 'index' || $match['target'] === 'login'){
            Header('Location: ' . HTML_ROOT . '/panel/setting');
            die();
        } elseif ($match['target'] === 'logout'){
            session_destroy();
            Header('Location: '. HTML_ROOT . '/');
            die();
        }

        if(!empty($_POST)){

        }
    }

    




    createHeader($routerName, $match['target']);
    require PHP_ROOT . "/views/{$match['target']}.php";
} else {
    require PHP_ROOT . "/views/404.php";
}




require PHP_ROOT . '/assets/components/footer.php';
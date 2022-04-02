<?php

// Map routes
    // Routes visitor
        $router->map('GET', '/', 'index', 'HomePage');
        $router->map('GET|POST', '/login', 'login', 'Login');
        $router->map('GET|POST', '/forget-password', 'forget-password', 'Forget Password');

    // Routes user connected
        // Routes classique
            $router->map('GET', '/logout', 'logout', 'Disconnect');
            $router->map('GET|POST', '/panel/first', 'panel/first', 'First Login');
            $router->map('GET|POST', '/panel/setting', 'panel/setting', 'Setting Profile');

        // Routes Skills
            $router->map('GET|POST', '/panel/skills/[a:category]', 'panel/skills', 'Skills Category');
            $router->map('GET|POST', '/panel/skills/[a:category]/[i:id]', 'panel/skills', 'Skills Category with ID');

        // Routes Projects
            $router->map('GET|POST', '/panel/project/create', 'panel/project/create', 'Add Project');

            $router->map('GET|POST', '/panel/project/list', 'panel/project/view', 'View list of Projects');
            $router->map('GET|POST', '/panel/project/view/[i:id]', 'panel/project/view', 'View a specific Project');


// Array to create variable for each routes : $match['target'] = $routerName['id']
$routerName = [
    // Routes visitor 
        ['id' => 'index',                  'title' => 'Accueil',                    'divId' => 'Home'],
        ['id' => 'login',                  'title' => 'Page de connexion',          'divId' => 'Login'],
        ['id' => 'forget-password',        'title' => 'Mot de passe oublié',        'divId' => 'Forget'],
    
    // Routes user connected
        // Routes classique
            ['id' => 'logout',                 'title' => 'Déconnexion',                'divId' => 'Logout'],
            ['id' => 'panel/first',            'title' => 'Première connexion',         'divId' => 'First'],
            ['id' => 'panel/setting',          'title' => 'Paramètre',                  'divId' => 'Settings'],
        
            // Routes Skills
            ['id' => 'panel/skills',           'title' => 'Compétence',                 'divId' => 'Skills'],

            // Routes Project
            ['id' => 'panel/project/create',   'title' => 'Ajout d\'un projet',         'divId' => 'Projet-add'],

            ['id' => 'panel/project/list',     'title' => 'Liste des projets',          'divId' => 'Projet-list'],
            ['id' => 'panel/project/view',     'title' => 'Propriété du projet',        'divId' => 'Projet-view']
];

require PHP_ROOT . '/routes/route_action.php';
<?php

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
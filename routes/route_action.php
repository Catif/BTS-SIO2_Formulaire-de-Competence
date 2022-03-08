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
                            if($result['Premiere-Connexion_Etud'] === '1'){
                                $_SESSION['first'] = true;
                            }

                            Header('Location: ' . HTML_ROOT . '/panel/setting');
                            die();
                        } else{
                            $alert = ['error', 'Email ou mot de passe invalide.'];
                        }
                    } else {
                        $alert = ['error', 'Votre email à un format invalide.'];
                    }
                }
            }
        }









    } else{
        if (isset($_SESSION['first']) && $match['target'] != 'panel/first'){
            Header('Location: '. HTML_ROOT . '/panel/first');
            die();
        } elseif($match['target'] === 'index' || $match['target'] === 'login' || (!isset($_SESSION['first']) && $match['target'] === 'panel/first')){
            Header('Location: ' . HTML_ROOT . '/panel/setting');
            die();
        } elseif ($match['target'] === 'logout'){
            session_destroy();
            Header('Location: '. HTML_ROOT . '/');
            die();
        } 



        if(!empty($_GET)){
            // Requet GET in Setting page
            if ($match['target'] === 'panel/setting'){
                if(isset($_GET['first']) && $_GET['first'] === 'success'){
                    $alert = ['success', 'Votre mot de passe à bien été mis à jour.'];
                }
            }
        }


        if(!empty($_POST)){
            // Requet POST in First Connection page
            if ($match['target'] === 'panel/first'){
                if(isset($_POST['new_password'], $_POST['new-verif_password'])){
                    $idUser = $_SESSION['user-id'];
                    if($_POST['new_password'] === $_POST['new-verif_password']){
                        if(strlen($_POST['new_password']) < 6){
                            $alert = ['error', 'Le nouveau mot de passe est trop petit. (Inférieur à 6 caractères)'];
                        } else{
                            $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT, ['cost' => 12]);
                            $db->query("UPDATE etudiant SET `Mot-de-Passe_Etud` = '{$newPassword}', `Premiere-Connexion_Etud` = 0 WHERE Identifiant_Etud = $idUser");
                            unset($_SESSION['first']);
                            Header('Location: ' . HTML_ROOT . '/panel/setting?first=success');
                            die();
                        }
                    } else{
                        $alert = ['error', 'La vérification du nouveau mot de passe a échoué.'];
                    }
                }
            }


            // Requet POST in Setting page
            if ($match['target'] === 'panel/setting'){
                if(isset($_POST['old_password'], $_POST['new_password'], $_POST['new-verif_password'])){
                    $idUser = $_SESSION['user-id'];
                    $req = $db->query("SELECT `Mot-de-Passe_Etud` FROM etudiant WHERE `Identifiant_Etud` = $idUser");
                    $result = $req->fetch();
                    
                    if(is_array($result) && password_verify($_POST['old_password'],$result['Mot-de-Passe_Etud'])){
                        if($_POST['new_password'] === $_POST['new-verif_password']){
                            if(strlen($_POST['new_password']) < 6){
                                $alert = ['error', 'Le nouveau mot de passe est trop petit. (Inférieur à 6 caractères)'];
                            } else{
                                if($_POST['old_password'] === $_POST['new_password']){
                                    $alert = ['error', 'Le nouveau mot de passe doit être différent de l\'ancien mot de passe.'];
                                } else{
                                    $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT, ['cost' => 12]);
                                    $db->query("UPDATE etudiant SET `Mot-de-Passe_Etud` = '{$newPassword}' WHERE Identifiant_Etud = $idUser");
                                    $alert = ['success', 'Le mot de passe à bien été modifié'];
                                }
                            }
                        } else{
                            $alert = ['error', 'La vérification du nouveau mot de passe a échoué.'];
                        }
                    } else{
                        $alert = ['error', 'Votre ancien mot de passe ne correspond pas.'];
                    }
                }
            }
        }
    }

    











    createHeader($routerName, $match['target']);

    $alert = isset($alert) ? $alert : null;

    require PHP_ROOT . "/views/{$match['target']}.php";
} else {
    require PHP_ROOT . "/views/404.php";
}

require PHP_ROOT . '/assets/components/footer.php';
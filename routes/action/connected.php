<?php
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
                    $db->query("UPDATE etudiant SET `MOT_DE_PASSE_ETUD` = '{$newPassword}', `Premiere-Connexion_Etud` = 0 WHERE IDENTIFIANT_ETUD = $idUser");
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
            $req = $db->query("SELECT `MOT_DE_PASSE_ETUD` FROM etudiant WHERE `IDENTIFIANT_ETUD` = $idUser");
            $result = $req->fetch();
            
            if(is_array($result) && password_verify($_POST['old_password'],$result['MOT_DE_PASSE_ETUD'])){
                if($_POST['new_password'] === $_POST['new-verif_password']){
                    if(strlen($_POST['new_password']) < 6){
                        $alert = ['error', 'Le nouveau mot de passe est trop petit. (Inférieur à 6 caractères)'];
                    } else{
                        if($_POST['old_password'] === $_POST['new_password']){
                            $alert = ['error', 'Le nouveau mot de passe doit être différent de l\'ancien mot de passe.'];
                        } else{
                            $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT, ['cost' => 12]);
                            $db->query("UPDATE etudiant SET `MOT_DE_PASSE_ETUD` = '{$newPassword}' WHERE IDENTIFIANT_ETUD = $idUser");
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




    // Requet POST in Create Project page
    if ($match['target'] === 'panel/project/create'){
        if(isset($_POST['name-Project'])){
            $savoirs = [];
            $indicateurs = [];
            foreach($_POST as $k => $element){
                $k = explode("/", $k);
                if($k[0] === 'Savoir'){
                    array_push($savoirs, $k[1]);
                } elseif($k[0] === 'Indicateur'){
                    array_push($indicateurs, $k[1]);
                }
            }
            if(count($savoirs) > 0 && count($indicateurs) > 0){
                // echo('savoir : ');
                // var_dump($savoirs);
                // echo('<br>Indicateur : ');
                // var_dump($indicateurs);


                $db->query('INSERT INTO projet (LIBEL_PROJET) VALUES (:name)', [
                    ':name' => $_POST['name-Project']
                ]);
                $id_Project = $db->returnLastInsertId();
                $db->query('INSERT INTO realiser VALUES (:idProjet, :idEtud)', [
                    ':idProjet' => $id_Project,
                    ':idEtud' => $_SESSION['user-id']
                ]);

                foreach($savoirs as $savoir){
                    $savoir = str_replace('_', '.', $savoir);

                    // Ajout des savoirs dans le tableau MAITRISER
                    $db->query('
                        INSERT INTO maitriser VALUES (:item, :idEtud, 1) 
                        ON DUPLICATE KEY
                        UPDATE MAITRISE = 1
                    ', [
                        ':item' => $savoir,
                        ':idEtud' => $_SESSION['user-id']
                    ]);

                    // Ajout des savoirs dans le tableau MOBILISER
                    $db->query('
                        INSERT INTO mobiliser VALUES (:item, :idProject)
                    ', [
                        ':item' => $savoir,
                        ':idProject' => $id_Project
                    ]);
                    echo('test2');
                }

                foreach($indicateurs as $indicateur){
                    $indicateur = str_replace('_', '.', $indicateur);
                    echo($indicateur);

                    // Ajout des savoirs dans le tableau INDICATEUR
                    $db->query('
                        INSERT INTO indicateur VALUES (:item, :idProject)
                    ', [
                        ':item' => $indicateur,
                        ':idProject' => $id_Project
                    ]);
                }
            } else {
                $alert = ['error', 'Vous devez sélectionner au moins un élément dans chaque domaine (Savoir ET Indicateur).'];
            }
        }
    }
}
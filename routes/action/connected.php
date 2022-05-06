<?php
if(!empty($_GET)){
    // Request GET in Setting page
    if ($match['target'] === 'panel/setting'){
        if(isset($_GET['first']) && $_GET['first'] === 'success'){
            $alert = ['success', 'Votre mot de passe à bien été mis à jour.'];
        }
    }
    
    // Request GET in View Project page
    if ($match['target'] === 'panel/project/list'){
        if(isset($_GET['alerte'])){
            switch($_GET['alerte']){
                case 'new':
                    $alert = ['success', 'Votre projet a bien été ajouté.'];
                    break;
                case 'notFound':
                    $alert = ['error', 'Le projet que vous avez essayé de modifier n\'existe pas.'];
                    break;


                case 'editSuccess':
                    $alert = ['success', 'Votre projet a bien été modifié.'];
                    break;
                case 'editNotFound':
                    $alert = ['error', 'Le projet que vous avez essayé de modifier n\'existe pas.'];
                    break;


                case 'deleteSuccess':
                    $alert = ['success', 'Votre projet a bien été supprimé.'];
                    break;
                case 'deleteNotFound':
                    $alert = ['error', 'Le projet que vous avez essayé de supprimer n\'existe pas.'];
                    break;



                default:
                    $alert = ['error', 'Une erreur est survenue.'];
                    break;
            }
        } 
    }
}


if(!empty($_POST)){
    // Request POST in First Connection page
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





    // Request POST in Setting page
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




    // Request POST in Create Project page
    if ($match['target'] === 'panel/project/create'){
        if(isset($_POST['name-Project'])){
            if(3 <= strlen($_POST['name-Project']) && strlen($_POST['name-Project']) <= 40){

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
                        // $db->query('
                        //     INSERT INTO maitriser VALUES (:item, :idEtud, 1) 
                        //     ON DUPLICATE KEY
                        //     UPDATE MAITRISE = 1
                        // ', [
                        //     ':item' => $savoir,
                        //     ':idEtud' => $_SESSION['user-id']
                        // ]);
    
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
    
                    header('Location:' . HTML_ROOT . '/panel/project/list?alerte=new');
                    die();
                } else {
                    $alert = ['error', 'Vous devez sélectionner au moins un élément dans chaque domaine (Savoir ET Indicateur).'];
                }
            } else{   
                $alert = ['error', 'Le nom d\'un projet doit être compris entre 3 et 40 caractères.'];
            }
        } else {
            $alert = ['error', 'Vous devez écrire le nom du projet.'];
        }
    }




    // Request POST in Edit Project page
    if ($match['target'] === 'panel/project/edit'){
        if(isset($_POST['action'])){
            if($_POST['action'] === 'delete'){
                if(isset($_POST['project'])){
                    try{
                        $db->query(
                            'DELETE projet FROM projet 
                            INNER JOIN realiser ON realiser.ID_PROJET = projet.ID_PROJET 
                            WHERE realiser.IDENTIFIANT_ETUD = :idEtud AND realiser.ID_PROJET = :idProjet
                            ', [
                                ':idProjet' => $match['params']['id'],
                                ':idEtud' => $_SESSION['user-id']
                            ]);
                    } catch(Exception $e){
                        header('Location:' . HTML_ROOT . '/panel/project/list?alerte=deleteNotFound');
                        die();
                    }
                    header('Location:' . HTML_ROOT . '/panel/project/list?alerte=deleteSuccess');
                    die();
                }
            } else if($_POST['action'] === 'edit'){
                if(isset($_POST['project'])){
                    try{

                    } catch(Exception $e){
                        header('Location:' . HTML_ROOT . '/panel/project/list?alerte=editNotFound');
                        die();
                    }
                    header('Location:' . HTML_ROOT . '/panel/project/list?alerte=editSuccess');
                    die();
                }
            }
        }
    }
}
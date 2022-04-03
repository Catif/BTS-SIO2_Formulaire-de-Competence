<?php
if (!empty($_POST)){
    // Requet POST in Login page
    if ($match['target'] === 'login'){
        if(isset($_POST['email'], $_POST['password'])){
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $req = $db->query("SELECT * FROM etudiant WHERE `MAIL_ETUD` = :email", [':email' => $_POST['email']]);

                $result = $req->fetch();
                
                if(is_array($result) && password_verify($_POST['password'],$result['MOT_DE_PASSE_ETUD'])){
                    $_SESSION['role'] = 'student';
                    $_SESSION['user-name'] = ucfirst(strtolower($result['PRENOM_ETUD'])) . ' ' . strtoupper($result['NOM_ETUD']);
                    $_SESSION['user-id'] = $result['IDENTIFIANT_ETUD'];
                    if($result['PREMIERE-CONNEXION_ETUD'] === '1'){
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

    if ($match['target'] === 'forget-password'){
        if(isset($_POST['email'], $_POST['forget_password_step']) && $_POST['forget_password_step'] === 'send_mail'){
            if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
                $req = $db->query("SELECT IDENTIFIANT_ETUD FROM etudiant WHERE `MAIL_ETUD` = :email", [':email' => $_POST['email']]);

                $result = $req->fetch();

                

                $forget_password_step = 'code_mail';

                $alert = ['success', 'Si votre email fait partie de notre base de donnée, vous recevrez un mail d\'ici quelque seconde.'];
                if(isset($result['IDENTIFIANT_ETUD'])){
                    $_SESSION['forget-password_ID-user'] = $result['IDENTIFIANT_ETUD'];

                    $comb = "ACDEFGHJKMNPQRTUVWXYZ123456789";
                    $codeGenere = str_shuffle($comb);
                    $_SESSION['codeMail'] = substr($codeGenere, 0, 6);

                    // Destinataire
                    $mail->addAddress($_POST['email']);

                    // Expéditeur
                    $mail->setFrom($_ENV['mail_forget_user'], 'Ne pas répondre - Asci6');

                    // Contenu
                    $mail->Subject = 'Code de vérification - Asci6';
                    $mail->Body = "Bonjour,

Voici le code pour la vérification du changement de mot de passe : {$_SESSION['codeMail']}";

                    // On envoie
                    if(!($mail->send())){
                        $alert = ['error', 'Le service d\'envoi d\'email semble avoir un problème. Retentez plus tard.'];
                    }
                }
            } else {
                $alert = ['error', 'Votre email à un format invalide.'];
            }
        } elseif (isset($_POST['forget_password_step']) && $_POST['forget_password_step'] === 'code_mail'){
            $forget_password_step = 'code_mail';
            if (isset($_POST['code'], $_SESSION['codeMail'])){
                if ($_POST['code'] === $_SESSION['codeMail']){
                    $forget_password_step = 'code_accept';
                    $alert = ['success', 'La vérification est un succée, veuillez choisir un nouveau mot de passe !'];
                } else{
                    $alert = ['error', 'Code incorrect.'];
                }
            }
        } elseif (isset($_POST['forget_password_step']) && $_POST['forget_password_step'] === 'code_accept'){
            $forget_password_step = 'code_accept';
            if (isset($_POST['new_password'], $_POST['new-verif_password'])){
                $idUser = $_SESSION['forget-password_ID-user'];
                if($_POST['new_password'] === $_POST['new-verif_password']){
                    if(strlen($_POST['new_password']) < 6){
                        $alert = ['error', 'Le nouveau mot de passe est trop petit. (Inférieur à 6 caractères)'];
                    } else{
                        $newPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT, ['cost' => 12]);
                        $db->query("UPDATE etudiant SET `MOT_DE_PASSE_ETUD` = '{$newPassword}', `PREMIERE_CONNEXION_ETUD` = 0 WHERE IDENTIFIANT_ETUD = $idUser");
                        unset($_SESSION['codeMail'], $_SESSION['forget-password_ID-user']);
                        Header('Location: ' . HTML_ROOT . '/login?forget=true');
                        die();
                    }
                } else{
                    $alert = ['error', 'Les deux mots de passe ne correspondent pas.'];
                }
            }
        }
    }
}










if (!empty($_GET)){
    if ($match['target'] === 'login'){
        if(isset($_GET['forget']) && $_GET['forget'] === 'true'){
            $alert = ['success', 'Votre mot de passe à bien été changé !'];
        }
    }





}
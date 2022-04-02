<?php

$req = $db->query('SELECT * FROM etudiant WHERE `IDENTIFIANT_ETUD` = :id', [':id' => $_SESSION['user-id']]);
$result = $req->fetch();

?>

<?php createAlert($alert) ?>

<h1 class="title">Paramètre du compte</h1>

<form action="<?= HTML_ROOT ?>/panel/setting" method="POST">
    <div class="card">
        <div class="column">
            <p><u>Information</u></p>
            <input type="text" value="<?= ucfirst(strtolower($result['PRENOM_ETUD'])) . ' ' . strtoupper($result['PRENOM_ETUD']) ?>" disabled>
            <input type="mail" value="<?= $result['MAIL_ETUD'] ?>" disabled>
            <input type="text" value="BTS SIO" disabled>
            <input type="text" value="<?= $result['OPTION_BTS_ETUD'] ?>" disabled>
        </div>
        
        <div class="column">
            <p><u>Changer son mot de passe</u></p>
            <input type="password" name="old_password" placeholder="Ancien mot de passe" required>
            <input type="password" name="new_password" placeholder="Nouveau mot de passe" required>
            <input type="password" name="new-verif_password" placeholder="Vérification nouveau mot de passe" required>
            <input type="submit" class="btn btn-primary" value="Modifier">
        </div>
    </div>
</form>
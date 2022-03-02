<?php

?>

<h1 class="title">Paramètre du compte</h1>

<form action="<?= HTML_ROOT ?>/panel/setting" method="POST">
    <div class="card">
        <div class="column">
            <p><u>Information</u></p>
            <input type="text" value="<?= $_SESSION['user-name'] ?>" disabled>
            <input type="mail" value="<?= $_SESSION['user-mail'] ?>" disabled>
            <input type="text" value="<?= $_SESSION['user-classe'] ?>" disabled>
            <input type="text" value="<?= $_SESSION['user-specialite'] ?>" disabled>
        </div>
        
        <div class="column">
            <p><u>Changer son mot de passe</u></p>
            <input type="password" name="old_password" placeholder="Ancien mot de passe" required>
            <input type="password" name="new_password" placeholder="Nouveau mot de passe" required>
            <input type="password" name="new-verif_password" placeholder="Vérification nouveau mot de passe" required>
            <input type="submit" class="btn-white" value="Modifier">
        </div>
    </div>
</form>
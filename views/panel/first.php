<?php createAlert($alert) ?>

<h1 class="title">Première connexion</h1>

<form action="<?= HTML_ROOT ?>/panel/first" method="POST">    
    <div class="card unique">
        <div class="column">
            <p><u>Changer votre mot de passe</u></p>
            <input type="password" name="new_password" placeholder="Nouveau mot de passe" required>
            <input type="password" name="new-verif_password" placeholder="Vérification nouveau mot de passe" required>
            <input type="submit" class="btn-white" value="Modifier">
        </div>
    </div>
</form>
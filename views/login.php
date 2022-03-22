<?php createAlert($alert) ?>

<h1 class="title">Page de connexion</h1>

<p class="text-center">
    Pour vous connecter, rien de plus simple !<br>
    Utilisez votre <u>email professionel</u> et si c'est votre première connexion, utilisez comme mot de passe <u>sio</u>.
</p>

<form id="Connexion" action="" method="POST">
    <input name="email" type="email" placeholder="Email professionnel" <?= isset($_POST['email']) ? 'value="' . $_POST['email'] . '"' : '' ?> required>
    <input type="password" name="password" placeholder="Mot de passe" required>

    <button type="submit" class="btn btn-primary">Se connecter</button>
</form>

<a href="<?= HTML_ROOT ?>/forget-password" class="btn btn-secondary">Mot de passe oublié</a>
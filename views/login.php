<?php
$message = '';

if(isset($_POST['email'], $_POST['password'])){
    $message = $_POST;
}
?>

<?php if($message != null): ?>
    <div class="alerte">
        <?php var_dump($message) ?>
    </div>
<?php endif; ?>



<h1 class="title">Page de connexion</h1>

<p class="text-center">
    Pour vous connecter, rien de plus simple !<br>
    Utilisé votre <u>email professionel</u> et si c'est votre première connexion, utilisé comme mot de passe <u>sio</u>.
</p>

<form id="Connexion" action="" method="POST">
    <input name="email" placeholder="Email professionnel" required>
    <input type="password" name="password" placeholder="Mot de passe" required>

    <button type="submit" class="btn-login">Se connecter</button>
</form>

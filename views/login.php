<?php
$message = '';

if(isset($_POST['email'], $_POST['password'])){
    if(filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)){
        
    } else {
        $message = 'Votre email à un format invalide.';
    }
}
?>

<?php if($message != null): ?>
    <div class="alerte">
        <?= $message ?>
    </div>
<?php endif; ?>



<h1 class="title">Page de connexion</h1>

<p class="text-center">
    Pour vous connecter, rien de plus simple !<br>
    Utilisé votre <u>email professionel</u> et si c'est votre première connexion, utilisé comme mot de passe <u>sio</u>.
</p>

<form id="Connexion" action="" method="POST">
    <input name="email" type="email" placeholder="Email professionnel" required>
    <input type="password" name="password" placeholder="Mot de passe" required>

    <button type="submit" class="btn-white">Se connecter</button>
</form>

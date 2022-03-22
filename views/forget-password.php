<?php 
createAlert($alert);
?>

<h1 class="title">Mot de passe oublié</h1>

<?php if(!isset($forget_password_step)): ?>
    <p class="text-center">
        Vous avez perdu votre mot de passe ? Pas de soucis !<br>
        Inscrivez votre email ci-dessous, un email avec un code de vérification vous sera alors envoyé.
    </p>

    <form id="Forget-Password" action="" method="POST">
        <input name="email" type="email" placeholder="Email professionnel" <?= isset($_POST['email']) ? 'value="' . $_POST['email'] . '"' : '' ?> required>

        <button type="submit" class="btn btn-primary">Envoyer le code</button>
        <input type="hidden" name="forget_password_step" value="send_mail">
    </form> 






<?php elseif($forget_password_step === 'code_mail'): ?>
    <p class="text-center">
        Un code vous a été envoyé par mail.<br>
        Inscrivez le code ci-dessous, vous serez redirigé vers une page pour modifier votre mot de passe.
    </p>

    <form id="Forget-Password" action="" method="POST">
        <input name="code" type="text" placeholder="Code reçu par mail" required>

        <button type="submit" class="btn btn-primary">Vérifier le code</button>
        <input type="hidden" name="forget_password_step" value="code_mail">
    </form> 






<?php elseif($forget_password_step === 'code_accept'): ?>
    <p class="text-center">
        La vérification est un succée, veullez choisir un nouveau mot de passe !
    </p>

    <form id="Forget-Password" action="" method="POST">    
        <input type="password" name="new_password" placeholder="Nouveau mot de passe" required>
        <input type="password" name="new-verif_password" placeholder="Vérification nouveau mot de passe" required>
        
        <button type="submit" class="btn btn-primary">Modifier</button>
        <input type="hidden" name="forget_password_step" value="code_accept">
    </form>









<?php endif; ?>

<a href="<?= HTML_ROOT ?>/login" class="btn btn-secondary">Page de connexion</a>
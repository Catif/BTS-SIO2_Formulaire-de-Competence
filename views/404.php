<?php
$titre = 'Error 404 - Bradley BARBIER';
$divId = 'Error';
require PHP_ROOT . '/assets/components/header.php';
?>







<h1>La page que vous recherchez n'existe pas ou plus.</h1>
<?php if($_SESSION['role'] === 'visitor'): ?>
    <a class="btn btn-primary" href="<?php HTML_ROOT ?>/">Revenir à l'accueil</a>
<?php endif; ?>
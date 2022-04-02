<?php

// Match routes
$match = $router->match();

if (is_array($match)) {
    if($_SESSION['role'] === 'visitor'){
        if($match['target'] !== 'index' && $match['target'] !== 'login' && $match['target'] !== 'forget-password'){
            Header('Location: ' . HTML_ROOT . '/');
            die();
        } else {
            require PHP_ROOT . '/routes/action/visitor.php';
        }



    } else{
        if ($match['target'] === 'logout'){
            session_destroy();
            Header('Location: '. HTML_ROOT . '/');
            die();
        }elseif (isset($_SESSION['first']) && $match['target'] != 'panel/first'){
            Header('Location: '. HTML_ROOT . '/panel/first');
            die();
        } elseif($match['target'] === 'index' || $match['target'] === 'login' || (!isset($_SESSION['first']) && $match['target'] === 'panel/first')){
            Header('Location: ' . HTML_ROOT . '/panel/setting');
            die();
        } else{
            require PHP_ROOT . '/routes/action/connected.php';
        }
    }



    createHeader($routerName, $match['target'], $db);

    $alert = isset($alert) ? $alert : null;

    require PHP_ROOT . "/views/{$match['target']}.php";
} else {
    require PHP_ROOT . "/views/404.php";
}

require PHP_ROOT . '/assets/components/footer.php';
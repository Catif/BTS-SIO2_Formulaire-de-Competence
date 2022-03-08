<?php

function createHeader(array $maps, string $target) {
    foreach($maps as $map){
        if($map['id'] === $target){
            $titre = $map['title'] . ' - Bradley BARBIER';
            $location = $map['divId'];
            require PHP_ROOT . '/assets/components/header.php';
            break;
        }
    }
}

function createAlert($alert){
    if($alert != null && is_array($alert)){
        echo('<div class="alerte ' . $alert[0] . '">' . $alert[1] . '</div>');
    }
}






// DEBUG FUNCTION
function debug($value){
    echo('<pre>');
    var_dump($value);
    echo('</pre>');
}
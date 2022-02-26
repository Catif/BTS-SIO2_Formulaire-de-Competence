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
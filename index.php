<?php

    require_once 'vendor/autoload.php';
    use MyApp\Mankind;

    $mankind = Mankind::getInstance();
    $mankind->loadFromFile("people.csv");

    dump($mankind->getAll());
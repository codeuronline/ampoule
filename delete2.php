<?php
session_start();
    require_once 'models/ampoule.php';
    $newAmpoule = new Ampoule;
    $newAmpoule->del(@$_SESSION['id']);
    $_SESSION['toast'] = true;
    //$_SESSION['ask'] = true;
    header('Location: index.php');
    ?>
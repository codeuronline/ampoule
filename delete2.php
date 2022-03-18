<?php
session_start();
    require_once 'models/ampoule.php';
    $newAmpoule = new Ampoule;
    $newAmpoule->del(@$_SESSION['id']);
    $_SESSION['toast'] = "";
    $_SESSION['ask'] = "";
    header('Location: index.php');
    ?>
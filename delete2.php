<?php
    session_start();
    require_once 'models/ampoule.php';
    $newAmpoule = new Ampoule;
    $newAmpoule->del(@$_GET['id']);
    //$_SESSION['toast'] = "";
    unset($_SESSION['ask']);
    header('Location: index.php');
    ?>
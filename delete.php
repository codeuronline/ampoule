<?php
    session_start();
    if ($_POST) {
        require_once 'models/ampoule.php';
        $newAmpoule = new Ampoule;
        $newAmpoule->del(@$_POST['id']);
    }
    
    //$_SESSION['toast'] = "";
    header('Location: index.php');
    ?>
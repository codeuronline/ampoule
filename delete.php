<?php
session_start();



if($_SESSION['ask']){
    $_SESSION['id'] = @$_GET['id'];
    require_once 'models/ampoule.php';
    if (@$_GET['confirm']==true) {
        $newAmpoule = new Ampoule;
        $newAmpoule->del(@$_SESSION['id']);
        $_SESSION['confirm']= true;    
 
    }
    
} else{
    $_SESSION['ask']=true;
 
}
header('Location: index.php');


?>
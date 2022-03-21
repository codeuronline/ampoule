<?php
session_start();
if(@$_GET['id']){
   $_SESSION['toast'] =true;
   $_SESSION['id'] = @$_GET['id'];
}
if($_GET['toast']){
    $_SESSION['id'] = @$_GET['id'];
    require_once 'models/ampoule.php';
    $newAmpoule = new Ampoule;
    $newAmpoule->del(@$_SESSION['id']);
    $_SESSION['toast']= true;    
    header('Location: index.php');
} else{
    $_SESSION['ask']=true;
    header('Location: index.php');
}
?>
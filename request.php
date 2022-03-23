<?php 
require_once('models/users.php');

error_log("POST :".print_r($_REQUEST, 1));



extract(@$_REQUEST);
$user= new User;
if (isset($email)){
   $answerPHP=$user->isIn($email);
}

if ($answerPHP !== TRUE) {
    $answerPHP = "0";
}

error_log('A envoyer = '. $answerPHP);
echo json_encode($answerPHP);
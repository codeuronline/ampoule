<?php

require 'connexion.php';

if(@$_POST){
    extract(@$_POST);
}else{
    $id = @$_GET['id'];
}

$sql1 = $pdo->prepare("SELECT * FROM users WHERE id = $id");
$sql1->execute();
$result = $sql1->fetchAll(PDO::FETCH_ASSOC);
//print_r($result);
//print_r($id);

$pass = @$_GET ['password'];
$passeword = password_hash($pass, PASSWORD_DEFAULT);
if(password_verify($pass, @$password)){
    //echo 'valide';
}else{
    echo 'invalide';
}
$sql2 = $pdo->prepare("UPDATE users SET username=:username, password=:password, email=:email, phone=:phone WHERE id=$id");
$sql2->bindParam(':username', $username, PDO::PARAM_STR);
$sql2->bindParam(':password', $password, PDO::PARAM_STR);
$sql2->bindParam(':email', $email, PDO::PARAM_STR);
$sql2->bindParam(':phone', $phone, PDO::PARAM_STR);
$sql2->execute();
//$result1 = $sql2->fetchAll();
//print_r($result1);

if (@$_POST) {
    header('location: utilisateur.php');
}

?>
<?php

require 'connexion.php';
/*$pass = $_POST ['password'];
$passeword = password_hash($pass, PASSWORD_DEFAULT);
if(password_verify($pass, $password)){
    echo 'valide';
}else{
    echo 'invalide';
}*/
$sql = $pdo->prepare("INSERT INTO users (
    username, password, email, phone)
    VALUES (:username, :password, :email, :phone)");
$sql->bindParam (':username',$_POST ['username']);
$sql->bindParam (':password', $passeword);
$sql->bindParam (':email', $_POST ['email']);
$sql->bindParam (':phone', $_POST ['phone']);
$sql->execute();
echo 'Entrée ajoutée dans la table';
header('location: utilisateur.php');


?>
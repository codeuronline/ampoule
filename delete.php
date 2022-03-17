<?php

require 'connexion.php';

$id = $_GET['id'];
$sql3 = $pdo->prepare("DELETE  FROM users WHERE id = $id");
$sql3->execute();
$delete = $sql3->fetchAll();

header('Location: utilisateur.php');
?>
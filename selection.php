<?php

require 'connexion.php';

$sql1 = $pdo->prepare("SELECT * FROM users");
$sql1->execute();
$result = $sql1->fetchAll(PDO::FETCH_ASSOC);
//print_r($result);


?>
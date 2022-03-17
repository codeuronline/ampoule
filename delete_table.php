<?php

require 'connexion.php';

$pdo->exec("DROP TABLE users");
echo ' La table est détruite';

?>
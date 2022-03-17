<?php

require 'connexion.php';

$pdo->exec("CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
    date TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP
    etage VARCHAR(5) NOT NULL,
    position VARCHAR(10) NOT NULL,
    prix FLOAT(10),
) ENGINE=innoDB DEFAULT CHARSET=utf8mb4");

echo 'Tables : USERS created';

?>
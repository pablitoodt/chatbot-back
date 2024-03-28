<?php

$system_info = php_uname();

if (strpos($system_info, 'Windows') !== false) {
    $dsn = 'mysql:host=localhost;dbname=chatbot.io;charset=utf8';
    $username = 'root';
    $password = '';
} else {
    $dsn = 'mysql:unix_socket=/Applications/MAMP/tmp/mysql/mysql.sock;port=8889;dbname=chatbotio;charset=utf8';;
    $username = 'root';
    $password = 'root';
}

try {

    $bdd = new PDO($dsn, $username, $password);

    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

    echo "Erreur de connexion : " . $e->getMessage();

    exit();
}

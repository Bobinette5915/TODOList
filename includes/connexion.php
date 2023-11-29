<?php
#bloc universel pour se connecter a la base de donnée
$dbname = "To-do-list";#nom de la base de donnee (attention pas de la table mais bien de la base de donnée generale)
$dbhost = "localhost";#où aller chercher la base de donnée (ici local)
$dbpass = "Greta1234!";#mot de passe pour se connecter a phpmyadmin
$dbuser = "greta";#id de connection à phpmyadmin




try {
    $dsn = "mysql:dbname=".$dbname.";host=".$dbhost;
    $db = new PDO($dsn, $dbuser, $dbpass);
    $db->exec("SET NAMES utf8");
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    // echo 'yes'; #afficher "yes" si la connexion est reussi sur la BDD, cest un controle facile.
}catch(PDOException $e) {
    die($e->getMessage());
}
?>
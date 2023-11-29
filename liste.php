<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
include("includes/connexion.php");



session_start();
// echo($_SESSION["ID-Utilisateur"]."<br>");


if (!empty($_POST["ajoutListe"])) {
    // echo("vide ou plein? <br>");
    $SQL="INSERT INTO `liste`(`a-faire`, `id-user`,`etat`) VALUES (:listeafaire, :IDuser, :etat)";
    $query = $db->prepare($SQL);
    $query->bindvalue(":listeafaire", $_POST["ajoutListe"],PDO::PARAM_STR);
    $query->bindvalue(":IDuser", $_SESSION["ID-Utilisateur"],PDO::PARAM_STR);
    $query->bindvalue(":etat", "0",PDO::PARAM_STR);
    $query->execute();
    // var_dump($SQL);
}
else {
    // echo("rien à ajouter <br>");
}


$sql= "SELECT `a-faire` ,`id` FROM `liste` WHERE `id-user`= :IDuser";
$query=$db->prepare($sql);
$query->bindvalue(":IDuser", $_SESSION["ID-Utilisateur"], PDO::PARAM_STR);
$query->execute();
$affichelist = $query->fetchAll();

$sql3 = "SELECT `prenom` FROM `acces` WHERE `email`= :nomuser";
$query3=$db->prepare($sql3);
$query3->bindvalue(":nomuser", $_SESSION["ID-Utilisateur"], PDO::PARAM_STR);
$query3->execute();
$affichenom = $query3->fetchAll();


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
    <script type="text/javascript" src="todo.js" defer></script>
    <link rel="stylesheet" href="todo.css">
    <title>To-Do-Liste</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center text-dark mt-5"> Bonjour <?php foreach ($affichenom as $nom) {echo("<strong>".$nom["prenom"]."</strong>");};?> ,<br> Voici ta liste de trucs à faire !</h2>
                <div class="card my-5">

                    <form class="card-body cardbody-color p-lg-5" method="POST">

                        <div class="text-center">
                            <img src="goat.jpg"
                                class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px"
                                alt="profile">
                        </div>
                        <!-- <div class="mb-3 d-flex justify-content-between align-content-center"> 
                            <p>Liste de choses à faire : </p>
                            
                        </div> -->
                        <div class="p-3">
                            <input type="text" name ="ajoutListe" placeholder="ajouter une tâches">
                            <button type="submit" class="btn btn-color">Ajouter</button>
                        </div>
                        <form method="post">
                            <div class="p-3" id="listing">

    <?php
    foreach ($affichelist as $ligne) { 
            echo('<input id="btnclick" type="checkbox" name="checkbox" value= " . $ligne["a-faire"] . "><span id="texteabarrer"></span>'. " ". $ligne["a-faire"] ."<br><br>");
        }
?>

                                
                            </div>
                            <button type="submit" id="valider" class="btn btn-color">supprimer</button>
                        </form>
                        <form action="deconnexion.php" method="post">
                            <div id="return" class="form-text text-center mb-5 text-dark p-3">Envie de changer d'utilisateur ?  <a href="index.php" class="text-dark fw-bold"><button type="submit" class="btn">Déconnexion !</button></a>
                            
                            </div>
                        </form>

                    </form>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
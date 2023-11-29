<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include("includes/connexion.php");

// echo "etape1";


if (!empty($_POST["adressMail"]) && !empty($_POST["MotdePasse"])) {
    


    // echo("testvideouplein");
    #il faut penser a dehacher le mot de passe poyur le verifier...
    $sql = "SELECT * FROM `acces` WHERE `email` = :adresseMail";
    $query = $db->prepare($sql);
    $query->bindValue(":adresseMail", $_POST["adressMail"], PDO::PARAM_STR);
    $query->execute();
    $controleID = $query->fetch();
    // echo($controleID);
    $hash = $_POST["MotdePasse"];


    $controleMdp = password_verify($hash,$controleID["mdp"]);
    // echo($controleMdp);


    if ($controleID !== false && $controleMdp !== false) {
        // echo("le mail existe <br>");
        // echo($controleID["mdp"]);
        echo("Le mail et le mot de passe correspondent, bienvenu");
        header("location:liste.php");
        session_start();
        $_SESSION['ID-Utilisateur'] = $_POST["adressMail"];
    }


}

?>


<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>
    <!-- <script type="text/javascript" src="style.js" defer></script> -->
    <link rel="stylesheet" href="todo.css">
    <script type="text/javascript" src="todo.js" defer></script>
    <title>To-Do-List</title>

</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center text-dark mt-5">Connecte toi à la<br>To Do List !!</h2>
                <div class="card my-5">

                    <form class="card-body cardbody-color p-lg-5" method="POST">
                    
                        <div class="text-center">
                            <img src="goat.jpg"
                                class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px"
                                alt="profile">
                        </div>

                        <?php
                            if ($controleID !== false) {

                                if ($controleMdp !== false) {
                                
                                }
                                else {
                                    echo ('<div class="alert alert-danger" role="alert">
                                    Mot de passe incorrect!</div>');
                                }
                                                                // echo("le mail existe <br>");
                                // echo($controleID["mdp"]);
                        
                        
                            }
                            else {
                                // echo("Attention, votre adresse mail ne correspond à aucun compte connu. Veuillez verifier ou creer un nouveau compte");
                                echo '<div class="alert alert-danger" role="alert">
                                Attention, votre adresse mail ne correspond à aucun compte connu. Veuillez verifier ou creer un nouveau compte</div>';
                            }
                        ?>

                        
                        <div class="mb-3">
                            <input type="text" class="form-control" id="Username" aria-describedby="emailHelp"
                                placeholder="Adresse email" name="adressMail">
                        </div>
                        <div class="mb-3" id="test">
                            <input type="password" class="form-control" id="password" placeholder="Mot de Passe" name="MotdePasse">                            
                                <div class="password-icon">
                                    <i data-feather="eye"></i>
                                    <i data-feather="eye-off"></i>
                                </div>
                                <script src="https://unpkg.com/feather-icons"></script>
                                <script>feather.replace();</script>
                        </div>
                        <div class="text-center"><button type="submit"
                                class="btn btn-color px-5 mb-5 w-100">connexion</button></div>
                        <div id="emailHelp" class="form-text text-center mb-5 text-dark">Pas encore de compte ? <a href="inscription.php" class="text-dark fw-bold"> Créer un compte !</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
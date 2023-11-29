<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);
include("includes/connexion.php");

class User{
    public $name;
    public $surname;
    public $email;
    public $password;
    }


if (!empty($_POST["inscriptionNom"]) && !empty($_POST["inscriptionPrenom"]) && !empty($_POST["inscriptionEmail"]) && !empty($_POST["inscriptionMdp"]) && !empty($_POST["inscriptionConfirmMdp"])) {

// echo("controle");
$sql ="SELECT * FROM `acces` WHERE `email`= :inscriptionEmail";
$query = $db->prepare($sql);
$query->bindvalue(":inscriptionEmail",$_POST["inscriptionEmail"],PDO::PARAM_STR);
$query->execute();
$verifEmail= $query->fetch();

    if ($verifEmail === false){
        $InNom = $_POST["inscriptionNom"];
        $InPrenom = $_POST["inscriptionPrenom"];
        $InEmail = $_POST["inscriptionEmail"];
        $InMdp = password_hash ($_POST["inscriptionMdp"],PASSWORD_DEFAULT);
        $InConfirmMdp = $_POST["inscriptionConfirmMdp"];
        
    // var_dump('$InPrenom','$InNom','$InMdp','$InEmail','$InConfirmMdp');
        if (($_POST['inscriptionMdp']) !== ($_POST['inscriptionConfirmMdp'])) {
            
        }
        else {
            $SQL= "INSERT INTO `acces`(`nom`, `prenom`, `email`, `mdp`) VALUES (:inscriptionNom,:inscriptionPrenom,:inscriptionEmail,:inscriptionMdp)";
            $query = $db->prepare($SQL);
            $query->bindvalue(":inscriptionNom",$InNom,PDO::PARAM_STR);
            $query->bindvalue(":inscriptionPrenom",$InPrenom,PDO::PARAM_STR);
            $query->bindvalue(":inscriptionEmail",$InEmail,PDO::PARAM_STR);
            $query->bindvalue(":inscriptionMdp",$InMdp,PDO::PARAM_STR);
            $query->execute();
        }}

} 

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
    <title>Inscription</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <h2 class="text-center text-dark mt-5">Go créer ton compte</h2>
                <div class="card my-5">

                    <form class="card-body cardbody-color p-lg-5" method="POST">

                        <div class="text-center">
                            <img src="goat.jpg"
                                class="img-fluid profile-image-pic img-thumbnail rounded-circle my-3" width="200px"
                                alt="profile">
                        </div>

                        <?php
                        if ((($_POST['inscriptionMdp']) !== ($_POST['inscriptionConfirmMdp'])) ){
                            echo ('<div class="alert alert-danger" role="alert">
                            les mots de passe ne sont pas identiques.</div>');
                        }

                            if ($verifEmail !== false && (!empty($_POST["inscriptionEmail"]))){
                                echo ('<div class="alert alert-danger" role="alert">
                                bordel change de mail, il est déja pris !!</div>');
                            }
                        
                        ?>

                        <div class="mb-3">
                            <input type="text" class="form-control" id="nom" 
                                placeholder="Nom" name="inscriptionNom">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="prenom" 
                                placeholder="Prenom" name="inscriptionPrenom">
                        </div>
                        <div class="mb-3">
                            <input type="text" class="form-control" id="email" 
                                placeholder="Adresse email" name="inscriptionEmail">
                        </div>
                        <div class="mb-3" id="test">
                            <input type="password" id="password" class="form-control" placeholder="Mot de Passe" name="inscriptionMdp">
                            <div >
                                <i class="password-icon" data-feather="eye"></i>
                                <i class="password-icon" data-feather="eye-off"></i>
                            </div>
                            <script src="https://unpkg.com/feather-icons"></script>
                            <script>
                            feather.replace();
                            </script>
                        </div>
                        <div class="mb-3" id ="test">
                            <input type="password" class="form-control" id="password2" placeholder="Confirmation de Mot de Passe" name="inscriptionConfirmMdp">
                            <div >
                                <i class="password-icon" data-feather="eye" id ="oeil2"></i>
                                <i class="password-icon" data-feather="eye-off" id="pasoeil2"></i>
                            </div>
                            <script src="https://unpkg.com/feather-icons"></script>
                            <script>
                            feather.replace();
                            </script>
                        </div>
                        <div class="text-center">
                            <button type="submit"class="btn btn-color px-5 mb-5 w-100">Inscription</button>
                        </div>
                        <div id="emailHelp" class="form-text text-center mb-5 text-dark">Tu as deja compte ? <a href="index.php" class="text-dark fw-bold">Me Connecter</a>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</body>
</html>
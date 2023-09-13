<?php
    require 'entreprise.php';
    require 'employe.php';
    require 'Client.php';
    require 'Database.php';

    ini_set('display_errors', 1);
    error_reporting(E_ALL);
    
    session_start();
    if(!isset($_SESSION['user'])) {
      header("Location: connexion.php");
      exit();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADD CLIENT</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--script src="script.js"></script-->
</head>
<body>
    <!-- Barre de navigation -->
    <div class="navbar">
        <div id="nomEntreprise">
        <?php
           $DB = new Database();
           $idEntreprise = $_SESSION['user']->getIdEnt();
           $entreprise = $DB->getEntreprisebyId($idEntreprise);
           $nomEntreprise = $entreprise->getNomEnt();
           echo "<h1>" . $nomEntreprise . "</h1>";
        ?>
        </div>
        <div id="maintitle">
        <h1>WORKING TIME COUNT</h1>
    </div>
        <div class="mainButtons">
        <a href="listClient.php">Retour</a>
        <a href="deconnexion.php">Déconnexion</a>
        </div>
    </div>


    <!-- Formulaire d'inscripion d'un client -->

    <div id="container_register">
        <h1>Inscription</h1>

        <form id="form_client" method="POST">
            <label><b>Nom</b></label>
            <input id="form_nomClient" type="text" placeholder="Entrer le nom" name="form_nomClient" require>

            <label><b>Adresse</b></label>
            <input id="form_adresseClient" type="text" placeholder="Entrer l'adresse" name="form_adresseClient" require>

            <label><b>Ville</b></label>
            <input id="form_villeClient" type="text" placeholder="Entrer la ville" name="form_villeClient" require>

            <label><b>Actif</b></label>
            <input id="form_isActif" type="checkbox" name="form_isActif">

            <button id="button_registerClient" type='submit'>Enregistrer</button>
        </form>

        <?php
            if(isset($_POST['form_nomClient'])){
                $nom = $_POST['form_nomClient'];
                if(isset($_POST['form_adresseClient'])){
                    $adresse = $_POST['form_adresseClient'];
                    if(isset($_POST['form_villeClient'])){
                        $ville = $_POST['form_villeClient'];
                        
                        $actif = isset($_POST['form_isActif']) ? 1 : 0;

                        $client = new Client();
                            $client->setNomClient($nom);
                            $client->setAdresseClient($adresse);
                            $client->setVilleClient($ville);
                            $client->setIsActif($actif);
                            
                            $DB->addClient($client);

                            header("Location: listClient.php");
                            exit();
                        
                    }
                }                
            }
        ?>
    </div>
</body>
</html>
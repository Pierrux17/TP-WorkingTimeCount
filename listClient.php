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
    <title>Liste des Clients</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="script.js"></script> -->
    <script>
        function confirmDelete(id) {
            if (confirm("Voulez-vous vraiment supprimer ce client ?")) {
                window.location.href = "deleteClient.php?id=" + id;
            }
        }
    </script>
</head>
<body>
    <!-- Barre de navigation -->
    <div class="navbar">
        <div id="nomEntreprise">
        <?php
           $db = new Database();
           $idEntreprise = $_SESSION['user']->getIdEnt();
           $entreprise = $db->getEntreprisebyId($idEntreprise);
           $nomEntreprise = $entreprise->getNomEnt();
           echo "<h1>" . $nomEntreprise . "</h1>";
        ?>
        </div>
        <div id="maintitle">
        <h1>WORKING TIME COUNT</h1>
    </div>
        <div class="mainButtons">
        <a href="index.php">Retour</a>
        <a href="deconnexion.php">Déconnexion</a>
        </div>
    </div>

    <h1>Liste des Clients</h1>

    <table id="tableListeClient">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Adresse</th>
        <th>Ville</th>
        <th>Actif</th>
        <th>Modifier</th>
        <th>Supprimer</th>
      </tr>
    </thead>
    <tbody>
        <?php
                $DB = new Database();
                $listClient = $DB->getAllClient();
                
                foreach($listClient as $client){
                echo '<tr>';
                echo '<td>' . $client->getIdClient() . '</td>';
                echo '<td>' . $client->getNomClient() . '</td>';
                echo '<td>' . $client->getAdresseClient() . '</td>';
                echo '<td>' . $client->getVilleClient() . '</td>';

                $actif;
                if($client->getIsActif() == true){
                    $actif = 'Oui';
                }
                else{
                    $actif = 'Non';
                }
                echo '<td>' . $actif . '</td>';
                echo '<td>' . '<a href ="updateClient.php?id=' . $client->getIdClient() . '">' . 'Modifier' . '</a>' . '</td>';
                echo '<td>' . '<a href="#" onclick="confirmDelete(' . $client->getIdClient() . ')">' . 'Supprimer' . '</a>' . '</td>';

                echo '</tr>';
                }
            ?>
        </tbody>
    </table>
    <button id='add_clientBtn' onclick="window.location.href='addClient.php'">Ajouter un Client</button>
</body>
</html>
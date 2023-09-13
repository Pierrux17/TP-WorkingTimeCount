<?php
    require 'entreprise.php';
    require 'employe.php';
    require 'Client.php';
    require 'Database.php';
    require 'Compteur.php';
    require 'fonction.php';
    require 'prestation.php';

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
                window.location.href = "deleteEmploye.php?id=" + id;
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

    <h1>Liste des Employés</h1>

    <table id="tableListeClient">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Age</th>
        <th>Adresse</th>
        <th>Ville</th>
        <th>Mail</th>
        <th>Trajet</th>
        <th>Login</th>
        <th>Mot de passe</th>
        <th>Fonction</th>
        <th>Modifier</th>
        <th>Supprimer</th>
      </tr>
    </thead>
    <tbody>
        <?php
                $DB = new Database();
                $listEmp = $DB->getAllEmployeByIdEnt($idEntreprise);
                
                foreach($listEmp as $emp){
                echo '<tr>';
                echo '<td>' . $emp->getIdEmp() . '</td>';
                echo '<td>' . $emp->getNomEmp() . '</td>';
                echo '<td>' . $emp->getPrenomEmp() . '</td>';
                echo '<td>' . $emp->getAgeEmp() . '</td>';
                echo '<td>' . $emp->getAdresseEmp() . '</td>';
                echo '<td>' . $emp->getVilleEmp() . '</td>';
                echo '<td>' . $emp->getMailEmp() . '</td>';
                echo '<td>' . $emp->getTrajetEmp() . ' km' . '</td>';
                echo '<td>' . $emp->getLoginEmp() . '</td>';
                $password = $emp->getPasswordEmp();
                $masked_password = str_repeat('*', strlen($password));
                echo '<td>' . $masked_password . '</td>';

                $fonction = $DB->getFonctionById($emp->getIdFonction());
                echo '<td>' . $fonction->getNomFonction() . '</td>';
                echo '<td>' . '<a href ="updateEmploye.php?id=' . $emp->getIdEmp() . '">' . 'Modifier' . '</a>' . '</td>';
                echo '<td>' . '<a href="#" onclick="confirmDelete(' . $emp->getIdEmp() . ')">' . 'Supprimer' . '</a>' . '</td>';
                echo '</tr>';
                }
            ?>
        </tbody>
    </table>

    <button id='add_employeBtn' onclick="window.location.href='addEmploye.php'">Ajouter un Employé</button>
</body>
</html>
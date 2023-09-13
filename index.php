<?php
    require 'entreprise.php';
    require 'employe.php';
    require 'Client.php';
    require 'Database.php';
    require 'Compteur.php';
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
    <title>Working Time Count</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- <script src="script.js"></script> -->
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
      <h1>WORKING TIME COUNT : Admin</h1>
  </div>
    <div class="mainButtons">
      <a class="infos" href="infoEmploye.php">Mes infos</a>
      <a class="deconnexion" href="deconnexion.php">Déconnexion</a>
    </div>
  </div>

    <!-- Liste d'Employés -->
    
    <div class="content">
      <div id="nom">
        <h1><?php echo $_SESSION['user']->getNomEmp() . ' ' .$_SESSION['user']->getPrenomEmp();  ?></h1>
      </div>
      <div id="listeDeroul">
        <form method="post">
          <select name="ListeDEmploye" id="ListeEmp">
            <option value="">-- Sélectionnez un employé --</option>
            
            <?php
              $DB = new Database();

              $id_ent = $_SESSION['user']->getIdEnt();
              $listEmp = $DB->getAllEmployeByIdEnt($id_ent);

              foreach($listEmp as $emp){
                echo '<option value="' .$emp->getIdEmp() . '">' .$emp->getNomEmp() . ' ' .$emp->getPrenomEmp() . '</option>';
              }
            ?>
          </select>
          <button id="selectedEmpButton" type="submit" name="selectedEmpButton">Afficher les prestation</button>
        </form>

        <?php
          if(isset($_POST['selectedEmpButton'])){
            $idEmp = $_POST['ListeDEmploye'];
            header('Location: details.php?idEmp=' .urlencode($idEmp). '');
          }
        ?>
      </div>
    </div>

    <div class='content_gestion'>
      <button id='gestion_employeBtn' onclick="window.location.href='listEmploye.php'">Gestion des Employés</button>
      <button id='gestion_clientBtn' onclick="window.location.href='listClient.php'">Gestion des Clients</button>
    </div>

    <!-- Footer -->
    <footer>
      <div class="f_colonnes">
          <div class="f_colonne">
              <?php echo '<p>' . $entreprise->getNomEnt(); '</p>'?>
              <?php echo '<p>' . $entreprise->getAdresseEnt() . ' ' . $entreprise->getVilleEnt(); '</p>'?>
              <?php echo '<p>' . ' Session : ' . $_SESSION['user']->getNomEmp() . ' ' . $_SESSION['user']->getPrenomEmp(); '</p>'?>
          </div>
        </div>
      </div>
    </footer>
</body>

</html>
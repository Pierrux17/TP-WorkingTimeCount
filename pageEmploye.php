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
    <title>Working Time Count : Employé</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script.js"></script>
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
      <?php 
          $idEmp = $_SESSION['user']->getIdEmp();
          $nomEmp = $_SESSION['user']->getNomEmp();
          $prenomEmp = $_SESSION['user']->getPrenomEmp();
      ?>
      <a class="infosClient" href="infoEmploye.php">Mes infos</a>
      <a href="details.php?idEmp=<?php echo urlencode($idEmp); ?>">Mes Prestations</a>
      <a href="deconnexion.php">Déconnexion</a>
    </div>
  </div>

    <!-- Liste de clients -->

    <div class="content">
      <div id="nom">
        <h1><?php echo $nomEmp . ' ' . $prenomEmp;  ?></h1>
      </div>
      <div id="listeDeroul">
        <select name="ListeDeClient" id="ListeClient">
          <option value="">-- Sélectionnez un client --</option>
          
          <?php
            $listClient = $DB->getAllActifClient();

            foreach($listClient as $client){
              echo '<option value="' .$client->getIdClient() . '">' .$client->getNomClient() . '</option>';
            }
          ?>
        </select>
        <button id="chooseButton">Choisir</button>
        <div id="nomClient"></div>
      </div>

      <!-- Chrono -->
    <div class="timer">
        <div id="time">00:00:00</div>
      <div class="button-container">
        <div class="timerButton">
          <button id="start-button">Démarrer</button>
          <button id="stop-button" disabled>Arrêter</button>
          <button id="restart-button" disabled>Reprendre</button-->
        </div>
      </div>
    </div>

    <div id="titre_description">
      <h1>Description</h1>
    </div>

    <div class="container_description">
      <div class="description">
        <textarea type="text" id="txt-description" name="txt-description" maxlength="50"></textarea>
      </div>

      <form id="form_presentation" method="POST">
        <div class="prestation">
          <label><input type="radio" name="id_prestation" id="p_standard" value="1" checked> Prestation standard</label>
          <label><input type="radio" name="id_prestation" id="p_nuit" value="2"> Prestation de nuit</label>
          <label><input type="radio" name="id_prestation" id="p_ferie" value="3"> Jour férié</label>
          <label><input type="radio" name="id_prestation" id="p_teletravail" value="4"> Télétravail</label>
        </div>
      </form>
    </div>

      <?php
        //AJOUTE UN COMPTEUR

        $newCpt = new Compteur();
        if(isset($_POST['time'])) {
          $time = $_POST['time'];
          if(isset($_POST['description'])) {
            $description = $_POST['description'];
          }
          if (isset($_POST['idClient'])) {
            $idClient = $_POST['idClient'];
          }
          if (isset($_POST['idPrestation'])) {
            $idPrestation = $_POST['idPrestation'];
          } 
          $date = date("Y-m-d");

          $newCpt->setDateCpt($date);
          $newCpt->setTempsCpt($time);
          $newCpt->setDescriptionCpt($description);
          $newCpt->setIdEmp($idEmp);
          $newCpt->setIdPrestation($idPrestation);
          $newCpt->setIdClient($idClient);

          $DB->AddTempsByIdClient($newCpt);
        }
        
      ?>
    </div>

    <div class="validButton">
      <button id="validate-button" disabled>Valider</button>
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
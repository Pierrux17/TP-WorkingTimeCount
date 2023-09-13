<?php
    require 'entreprise.php';
    require 'employe.php';
    require 'Client.php';
    require 'Database.php';
    require 'Compteur.php';
    require 'fonction.php';
    require 'prestation.php';

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
    <title>Détails</title>
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
        <h1>WORKING TIME COUNT</h1>
    </div>
        <div class="mainButtons">
        <?php if($_SESSION['user']->getIsAdmin() == 0): ?>
          <a href="pageEmploye.php">Retour</a>
        <?php endif ?>
        <?php if($_SESSION['user']->getIsAdmin() == 1): ?>
          <a href="index.php">Retour</a>
        <?php endif ?>
        <a href="deconnexion.php">Déconnexion</a>
        </div>
    </div>

    <h1>Détails</h1>

    <?php
      $DB = new Database();

      $idEmp = $_GET['idEmp'];
      $idEnt = $_SESSION['user']->getIdEnt();

      $employe = $DB->getEmpByIdEmpIdEnt($idEmp, $idEnt);
      $fonction = $DB->getFonctionById($employe->getIdFonction());

      $fraisDep = $employe->getTrajetEmp() / 2;

    ?>

    <table id="tableClient">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Age</th>
        <th>Mail</th>
        <th>Fonction</th>
        <th>Tarif horaire</th>
        <th>Frais de déplacement</th>
      </tr>
    </thead>
    <tbody>
        <tr>
            <td><?php echo $employe->getIdEmp() ?></td>
            <td><?php echo $employe->getNomEmp() ?></td>
            <td><?php echo $employe->getPrenomEmp() ?></td>
            <td><?php echo $employe->getAgeEmp() ?></td>
            <td><?php echo $employe->getMailEmp() ?></td>
            <td><?php echo $fonction->getNomFonction() ?></td>
            <td><?php echo $fonction->getTarifFonction() . ' €/h' ?></td>
            <td><?php echo $fraisDep . ' €' ?></td>
        </tr>
      </tbody>
    </table>

    <div class ="content_date">
      <form id="form_date" method="post">
        <label for="date">Choisir une date : </label>
        <input type="date" id="date" name="date">
        <button id="choose_date">Valider</button>
      </form>

      <form id="form_dates" method="post">
        <label for="date1">Choisir une première date : </label>
        <input type="date" id="date1" name="date1">
        <br>
        <label for="date2">Choisir une deuxième date : </label>
        <input type="date" id="date2" name="date2">
        <br>
        <button id="choose_dates">Valider</button>
      </form>
    </div>

    <table id="tableDetail">
        <thead>
          <tr>
            <th>Date</th>
            <th>Client</th>
            <th>Durée</th>
            <th>Description</th>
            <th>Type de prestation</th>
            <th>Montant</th>
            <th>Frais de déplacement</th>
            <th>Montant Final</th>
          </tr>
        </thead>
        <tbody>
          <?php
            //AFFICHE LES Durée PAR ID DU CLIENT

            // Vérifier si une date est sélectionnée
            if (isset($_POST['date'])) {
              //Si oui, on affiche le compteur à la date sélectionnée
              $dateCpt = $_POST['date'];
              $listCpt = $DB->getCompteurByIdEmpByDate($idEmp, $dateCpt);
              $selectedDate = $dateCpt;
            }
            else if (isset($_POST['date1']) && isset($_POST['date2'])) {
              $date1 = $_POST['date1'];
              $date2 = $_POST['date2'];
              $listCpt = $DB->getCompteurBetween2Dates($idEmp, $date1, $date2);
              $selectedDate1 = $date1;
              $selectedDate2 = $date2;
            }
            else {
              //Sinon, on affiche tous les compteurs du client
              $listCpt = $DB->getCompteurByIdEmp($idEmp);
            }
            
            foreach($listCpt as $compteur){
              echo '<tr>';
              echo '<td>' . $compteur->getDateCpt() . '</td>';

              $client = $DB->getClientById($compteur->getIdClient());
              echo '<td>' . $client->getNomClient( ). '</td>';
              echo '<td>' . $compteur->getTempsCpt() . '</td>';
              echo '<td>' . $compteur->getDescriptionCpt() . '</td>';
              $prestation = $DB->getPrestationById($compteur->getIdPrestation());
              echo '<td>' . $prestation->getNomPrestation() . ' (x' . $prestation->getMultiplicateur() . ')' . '</td>';

              $temps = $compteur->getTempsCpt();
              $tarifHoraire = $fonction->getTarifFonction();

              $secondes = strtotime($temps) - strtotime('00:00:00');
              $heures = $secondes / 3600;
              $coutTotal = $heures * $tarifHoraire * $prestation->getMultiplicateur();
              $coutTotalArrondi = number_format($coutTotal, 1, '.', ' ');

              echo '<td>' . $coutTotalArrondi . ' €</td>';
              
              $fraisDep = $employe->getTrajetEmp() / 2;
              if($prestation->getNomPrestation() == 'Télétravail'){
                $fraisDep = 0;
              }
              echo '<td>' . $fraisDep . ' €</td>';
              $montantFinal = $coutTotalArrondi + $fraisDep;
              echo '<td>' . $montantFinal . ' €</td>';
              echo '</tr>';
            }
          ?>
        </tbody>
    </table>

    <!-- Le bouton "Générer un PDF" pour l'admin -->
    <?php if($_SESSION['user']->getIsAdmin() == 1): ?>
    <form id="form_pdf" method="post">
        <input type="hidden" name="selectedDate" value="<?php echo $selectedDate; ?>">
        <input type="hidden" name="selectedDate1" value="<?php echo $selectedDate1; ?>">
        <input type="hidden" name="selectedDate2" value="<?php echo $selectedDate2; ?>">
        <button id="generate_pdf" type="submit" name="generate_pdf">Générer un PDF</button>
    </form>
    <?php endif; ?>


    <!-- PDF" -->
    <?php
      require_once('fpdf/fpdf.php');
    
      if(isset($_POST['generate_pdf'])) {
        if(isset($_POST['selectedDate'])){
          $selectedDate = $_POST['selectedDate'];
        }
        if(isset($_POST['selectedDate1'])){
          $selectedDate1 = $_POST['selectedDate1'];
        }
        if(isset($_POST['selectedDate2'])){
          $selectedDate2 = $_POST['selectedDate2'];
        }
        $pdf = new FPDF();
        ob_clean();
        $pdf->AddPage();

        //Compteur
        $i = 0;
        //Nombre de ligne max sur 1 page
        $max = 12;

        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(35, 10,'', 0, 1, 'R');
        $pdf->Cell(60, 5,'', 0, 0, 'L');
        $pdf->Cell(50, 10, 'Fiche de prestation', 0, 1, 'L');
        $pdf->Ln();

        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(15, 5,'', 0, 0, 'L');
        $pdf->Cell(120, 5, utf8_decode($nomEntreprise), 0, 0, 'L');
        $pdf->Cell(60, 5, utf8_decode($employe->getNomEmp() . ' ' . $employe->getPrenomEmp()), 0, 1, 'L');

        $pdf->SetFont('Arial','',9);
        $pdf->Cell(15, 5,'', 0, 0, 'L');
        $pdf->Cell(120, 5, utf8_decode($entreprise->getAdresseEnt()), 0, 0, 'L');
        $pdf->Cell(60, 5, utf8_decode($employe->getAdresseEmp()), 0, 1, 'L');

        $pdf->Cell(15, 5,'', 0, 0, 'L');
        $pdf->Cell(120, 5, utf8_decode($entreprise->getVilleEnt()), 0, 0, 'L');
        $pdf->Cell(60, 5, utf8_decode($employe->getVilleEmp()), 0, 1, 'L');
        $pdf->Ln();
        $pdf->Ln();

        $pdf->SetFont('Arial','B', 8);
        $pdf->Cell(15, 5,'', 0, 0, 'L');
        $pdf->Cell(120, 5, utf8_decode('Numéro du travailleur : ' . $employe->getIdEmp()), 0, 0, 'L');
        $pdf->Cell(60, 5, 'Date : ' . date('Y-m-d'), 0, 1, 'L');

        if($selectedDate1 != null && $selectedDate2 != null){
          $pdf->Cell(15, 5,'', 0, 0, 'L');
          $pdf->Cell(120, 5, utf8_decode('Période du ' .$selectedDate1 . ' au ' . $selectedDate2), 0, 0, 'L');
        }
        if($selectedDate != null){
          $pdf->Cell(15, 5,'', 0, 0, 'L');
          $pdf->Cell(120, 5, utf8_decode('Période du ' .$selectedDate), 0, 0, 'L');
        }

        $pdf->Ln();
        $pdf->Ln();

        $pdf->SetFont('Arial', 'B', 9);
        $pdf->Cell(25, 10, utf8_decode('Date'), 1);
        $pdf->Cell(25, 10, utf8_decode('Durée'), 1);
        $pdf->Cell(80, 10, utf8_decode('Description'), 1);
        $pdf->Cell(35, 10, utf8_decode('Prestation'), 1);
        $pdf->Cell(25, 10, utf8_decode('Montant'), 1);

        $pdf->Ln();

        if($selectedDate != null){        
          $listCpt = $DB->getCompteurByIdEmpByDate($idEmp, $selectedDate);
        } 
        else if($selectedDate1 != null && $selectedDate2 != null){
          $listCpt = $DB->getCompteurBetween2Dates($idEmp, $selectedDate1, $selectedDate2);
        }
        else{
          $listCpt = $DB->getCompteurByIdEmp($idEmp);
        }

        foreach ($listCpt as $compteur) {
          //Si le pdf = 12 lignes, génération d'une nouvelle page
          if($i == $max){
            $pdf->AddPage();
            $i = 0;
          }
          $pdf->SetFont('Arial', '', 8);
          $pdf->Cell(25, 10, $compteur->getDateCpt(), 1);
          $pdf->Cell(25, 10, $compteur->getTempsCpt(), 1);
          $pdf->Cell(80, 10, utf8_decode($compteur->getDescriptionCpt()), 1);
          
          $prestation = $DB->getPrestationById($compteur->getIdPrestation());
          $pdf->Cell(35, 10, utf8_decode($prestation->getNomPrestation()), 1);

          $temps = $compteur->getTempsCpt();
          $tarifHoraire = $fonction->getTarifFonction();

          $secondes = strtotime($temps) - strtotime('00:00:00');
          $heures = $secondes / 3600;
          $coutTotal = $heures * $tarifHoraire * $prestation->getMultiplicateur();
          $coutTotalArrondi = number_format($coutTotal, 1, '.', ' ');

          $fraisDep = $employe->getTrajetEmp() / 2;
              
          if($prestation->getNomPrestation() == 'Télétravail'){
            $fraisDep = 0;
          }
          $montantFinal = $coutTotalArrondi + $fraisDep;

          $prixTotal += $montantFinal;

          $pdf->SetFont('Arial', 'B', 8);
          $pdf->Cell(25, 10, $montantFinal . ' ' . utf8_decode(utf8_encode(chr(128))), 1);

          $pdf->Ln();
          $i++;
        }

        $pdf->Ln();
        $pdf->SetFont('Arial', 'B', 11);
        $pdf->Cell(125, 10,'', 0, 0, 'R');
        $pdf->Cell(25, 10, utf8_decode('Montant Total : '), 0, 0, 'L');
        $pdf->Cell(10, 10,'', 0, 0, 'L');
        $pdf->Cell(25, 10, number_format($prixTotal, 1, '.', ' ') . ' ' . utf8_decode(utf8_encode(chr(128))), 0, 0, 'L');
        
        $pdf->Output('D','Facture ' . date('Y-m-d'). '.pdf');
      }
    ?>
</body>
</html>
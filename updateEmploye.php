<?php
    require 'entreprise.php';
    require 'employe.php';
    require 'Client.php';
    require 'Database.php';
    require 'fonction.php';

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
    <title>UPDATE CLIENT N° : <?php $idEmp = $_GET['id']; echo $idEmp; ?></title>
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
        <a href="listEmploye.php">Retour</a>
        <a href="deconnexion.php">Déconnexion</a>
        </div>
    </div>


    <!-- Formulaire d'inscripion d'un client -->

    <div id="container_register">
        <h1>Modification</h1>

        <?php
            $emp=$DB->getEmployeById($idEmp);

            $nom = $emp->getNomEmp();
            $prenom = $emp->getPrenomEmp();
            $age = $emp->getAgeEmp();
            $adresse = $emp->getAdresseEmp();
            $ville = $emp->getVilleEmp();
            $mail = $emp->getMailEmp();
            $trajet = $emp->getTrajetEmp();
            $login = $emp->getLoginEmp();
            $password = $emp->getPasswordEmp();
            $idFonction = $emp->getIdFonction();

        ?>

        <form id="form_client" method="POST">
            <label><b>Nom</b></label>
            <input id="form_nomClient" type="text" value= '<?php echo $nom; ?>' name="form_nomClient" required>

            <label><b>Prénom</b></label>
            <input id="form_prenomClient" type="text" value= '<?php echo $prenom; ?>' name="form_prenomClient" required>

            <label><b>Age</b></label>
            <input id="form_ageClient" type="number" value= <?php echo $age; ?> name="form_ageClient" required>

            <label><b>Adresse</b></label>
            <input id="form_adresseClient" type="text" value= '<?php echo $adresse; ?>' name="form_adresseClient" required>

            <label><b>Ville</b></label>
            <input id="form_villeClient" type="text" value= '<?php echo $ville; ?>' name="form_villeClient" required>

            <label><b>Mail</b></label>
            <input id="form_mailClient" type="text" value= '<?php echo $mail; ?>' name="form_mailClient" required>

            <label><b>Distance de trajet en km</b></label>
            <input id="form_trajetClient" type="number" value= <?php echo $trajet; ?> name="form_trajetClient" required>

            <label><b>Login</b></label>
            <input id="form_loginClient" type="text" value= '<?php echo $login; ?>' name="form_loginClient" required>

            <label><b>Mot de passe</b></label>
            <input id="form_passwordClient" type="password" value= '<?php echo $password; ?>' name="form_passwordClient" required>

            <label><b>Fonction</b></label>
            <select id="form_fonctionClient" name="form_fonctionClient" required>
                <option value="">-- Sélectionnez une fonction --</option>

                <?php
                    $listFonction = $DB->getAllFonction();

                    foreach ($listFonction as $fonction) {
                        $selected = "";
                        if ($fonction->getIdFonction() == $emp->getIdFonction()) {
                            $selected = "selected";
                        }
                        echo '<option value="' . $fonction->getIdFonction() . '" ' . $selected . '>' . $fonction->getNomFonction() . '</option>';
                    }
                ?>
            </select>

            <button id="button_registerClient" type='submit'>Enregistrer</button>
        </form>

        <?php
            if(isset($_POST['form_nomClient'])){
                $nom = $_POST['form_nomClient'];
                if(isset($_POST['form_prenomClient'])){
                    $prenom = $_POST['form_prenomClient'];
                    if(isset($_POST['form_ageClient'])){
                        $age = $_POST['form_ageClient'];
                        if(isset($_POST['form_adresseClient'])){
                            $adresse = $_POST['form_adresseClient'];
                            if(isset($_POST['form_villeClient'])){
                                $ville = $_POST['form_villeClient'];
                                if(isset($_POST['form_mailClient'])){
                                    $mail = $_POST['form_mailClient'];
                                    if(isset($_POST['form_trajetClient'])){
                                        $trajet = $_POST['form_trajetClient'];
                                        if(isset($_POST['form_loginClient'])){
                                            $login = $_POST['form_loginClient'];
                                            if(isset($_POST['form_passwordClient'])){
                                                $password = $_POST['form_passwordClient'];
                                                        if (isset($_POST['form_fonctionClient'])) {
                                                            $idFonction = $_POST['form_fonctionClient'];

                                                            if($idFonction == 1){ //SI LA FONCTION EST ADMIN
                                                                $isAdmin = 1;
                                                            } else {
                                                                $isAdmin = 0;
                                                            }
                                                                   
                                                            $emp->setNomEmp($nom);
                                                            $emp->setPrenomEmp($prenom);
                                                            $emp->setAgeEmp($age);
                                                            $emp->setAdresseEmp($adresse);
                                                            $emp->setVilleEmp($ville);
                                                            $emp->setMailEmp($mail);
                                                            $emp->setTrajetEmp($trajet);
                                                            $emp->setLoginEmp($login);
                                                            $emp->setPasswordEmp($password);
                                                            $emp->setIsAdmin($isAdmin);
                                                            $emp->setIdEnt($idEntreprise);
                                                            $emp->setIdFonction($idFonction);

                                                            $DB->updateEmploye($emp);

                                                            header("Location: listEmploye.php");
                                                            exit();
                                                        }
                                                    }
                                                }
                                            
                                    }
                                }
                            }
                        }
                    }
                }                
            }
        ?>
    </div>
</body>
</html>
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
    <title>ADD EMPLOYE</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!--script src="script.js"></script-->
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
        <a href="listEmploye.php">Retour</a>
        <a href="deconnexion.php">Déconnexion</a>
        </div>
    </div>


    <!-- Formulaire d'inscripion d'un client -->

    <div id="container_register">

        <h1>Inscription</h1>

        <form id="form_client" method="POST">
            <label><b>Nom</b></label>
            <input id="form_nomClient" type="text" placeholder="Entrer le nom" name="form_nomClient" required>

            <label><b>Prénom</b></label>
            <input id="form_prenomClient" type="text" placeholder="Entrer le prénom" name="form_prenomClient" required>

            <label><b>Age</b></label>
            <input id="form_ageClient" type="number" placeholder="Entrer l'age" name="form_ageClient" required>

            <label><b>Adresse</b></label>
            <input id="form_adresseClient" type="text" placeholder="Entrer l'adresse" name="form_adresseClient" required>

            <label><b>Ville</b></label>
            <input id="form_villeClient" type="text" placeholder="Entrer la ville" name="form_villeClient" required>

            <label><b>Mail</b></label>
            <input id="form_mailClient" type="text" placeholder="Entrer le mail" name="form_mailClient" required>

            <label><b>Distance de trajet en km</b></label>
            <input id="form_trajetClient" type="number" name="form_trajetClient" required>

            <label><b>Login</b></label>
            <input id="form_loginClient" type="text" placeholder="Entrer le login" name="form_loginClient" required>

            <label><b>Mot de passe</b></label>
            <input id="form_passwordClient" type="password" placeholder="Entrer le mot de passe" name="form_passwordClient" required>

            <label><b>Fonction</b></label>
            <select id="form_fonctionClient" name="form_fonctionClient" required>
                <option value="">-- Sélectionnez une fonction --</option>

                <?php
                    $DB = new Database();
                    $listFonction = $DB->getAllFonction();

                    foreach($listFonction as $fonction){
                        echo '<option value="' .$fonction->getIdFonction() . '">' .$fonction->getNomFonction() .'</option>';
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
                                                            
                                                            $emp = new Employe();
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

                                                            $DB->addEmploye($emp);

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
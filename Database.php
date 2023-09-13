<?php
    class Database{

        //-------------- FONCTION --------------

        //SELECT LA LISTE DES FONCTIONS A PARTIR DE LA BASE DE DONNEE
        public function getAllFonction(){
            $listFonctions = array();
            try{
                $db = new PDO('sqlite:WorkingTimeCountDB.db');
                $stmt = $db->prepare('SELECT * FROM Fonction');
                $stmt->execute();
                
                foreach ($stmt->fetchAll() as $result) {
                    $fonction = new Fonction();
                    $fonction->setIdFonction($result['id_fonction']);
                    $fonction->setNomFonction($result['name_fonction']);
                    $fonction->setTarifFonction($result['tarif_fonction']);
                    $listFonctions[] = $fonction;
                }
                
            } catch (PDOException $e) {
                echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
                exit();
            }
            return $listFonctions;
        }


        //SELECT LA FONCTION BY ID A PARTIR DE LA BASE DE DONNEE
        public function getFonctionById($id){
            try {
                $db = new PDO('sqlite:WorkingTimeCountDB.db');
                $stmt = $db->prepare('SELECT * FROM Fonction WHERE id_fonction = :myId');
                $stmt->bindValue(':myId', $id);
                $stmt->execute();

                $result = $stmt->fetch();
                if ($result) {
                    $fonction = new Fonction();
                    $fonction->setIdFonction($result['id_fonction']);
                    $fonction->setNomFonction($result['name_fonction']);
                    $fonction->setTarifFonction($result['tarif_fonction']);
                } else {
                    echo "Aucun client trouvé avec l'identifiant $id.";
                }
            } catch (PDOException $e) {
                echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
            }
            return $fonction;
        }

        // -------------- EMPLOYE --------------

        public function getAllEmploye(){
            $listEmp = array();
            try{
                $db = new PDO('sqlite:WorkingTimeCountDB.db');
                $stmt = $db->prepare('SELECT * FROM Employe');
                $stmt->execute();
                
                foreach ($stmt->fetchAll() as $result) {
                    $emp = new Employe();
                    $emp->setIdEmp($result['id_emp']);
                    $emp->setNomEmp($result['nom_emp']);
                    $emp->setPrenomEmp($result['prenom_emp']);
                    $emp->setAgeEmp($result['age_emp']);
                    $emp->setAdresseEmp($result['adresse_emp']);
                    $emp->setVilleEmp($result['ville_emp']);
                    $emp->setMailEmp($result['mail_emp']);
                    $emp->setTrajetEmp($result['trajet_emp']);
                    $emp->setLoginEmp($result['login_emp']);
                    $emp->setPasswordEmp($result['password_emp']);
                    $emp->setIsAdmin($result['isAdmin']);
                    $emp->setIdEnt($result['id_ent']);
                    $emp->setIdFonction($result['id_fonction']);
                    $listEmp[] = $emp;
                }
                
            } catch (PDOException $e) {
                echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
                exit();
            }
            return $listEmp;
        }


        //SELECT LE EMPLOYE BY ID
        public function getEmployeById($id){
            try {
                $db = new PDO('sqlite:WorkingTimeCountDB.db');
                $stmt = $db->prepare('SELECT * FROM Employe WHERE id_emp = :myId');
                $stmt->bindValue(':myId', $id);
                $stmt->execute();

                $result = $stmt->fetch();
                if ($result) {
                    $emp = new Employe();
                    $emp->setIdEmp($id);
                    $emp->setNomEmp($result['nom_emp']);
                    $emp->setPrenomEmp($result['prenom_emp']);
                    $emp->setAgeEmp($result['age_emp']);
                    $emp->setAdresseEmp($result['adresse_emp']);
                    $emp->setVilleEmp($result['ville_emp']);
                    $emp->setMailEmp($result['mail_emp']);
                    $emp->setTrajetEmp($result['trajet_emp']);
                    $emp->setLoginEmp($result['login_emp']);
                    $emp->setPasswordEmp($result['password_emp']);
                    $emp->setIsAdmin($result['isAdmin']);
                    $emp->setIdEnt($result['id_ent']);
                    $emp->setIdFonction($result['id_fonction']);
                } else {
                    echo "Pas d'employés sélectionnés $id.";
                }
            } catch (PDOException $e) {
                echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
            }
            return $emp;
        }

        //SELECT L'EMPLOYE BY ID EMP ET ID ENT
        public function getEmpByIdEmpIdEnt($id_emp, $id_ent){
            try {
                $db = new PDO('sqlite:WorkingTimeCountDB.db');
                $stmt = $db->prepare('SELECT * FROM Employe WHERE id_emp = :myIdEmp AND id_ent = :myIdEnt');
                $stmt->bindValue(':myIdEmp', $id_emp);
                $stmt->bindValue(':myIdEnt', $id_ent);
                $stmt->execute();

                $result = $stmt->fetch();
                if ($result) {
                    $emp = new Employe();
                    $emp->setIdEmp($result['id_emp']);
                    $emp->setNomEmp($result['nom_emp']);
                    $emp->setPrenomEmp($result['prenom_emp']);
                    $emp->setAgeEmp($result['age_emp']);
                    $emp->setAdresseEmp($result['adresse_emp']);
                    $emp->setVilleEmp($result['ville_emp']);
                    $emp->setMailEmp($result['mail_emp']);
                    $emp->setTrajetEmp($result['trajet_emp']);
                    $emp->setLoginEmp($result['login_emp']);
                    $emp->setPasswordEmp($result['password_emp']);
                    $emp->setIsAdmin($result['isAdmin']);
                    $emp->setIdEnt($result['id_ent']);
                    $emp->setIdFonction($result['id_fonction']);
                } else {
                    echo "Aucun employé trouvé avec l'identifiant $id.";
                }
            } catch (PDOException $e) {
                echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
            }
            return $emp;
        }


        //ADD EMPLOYE
        public function addEmploye($emp){
            try {
                $db = new PDO('sqlite:WorkingTimeCountDB.db');
                $stmt = $db->prepare('INSERT INTO Employe(nom_emp, prenom_emp, age_emp, adresse_emp, ville_emp, mail_emp, trajet_emp, login_emp, password_emp, isAdmin, id_ent, id_fonction) VALUES(:myNom, :myPrenom, :myAge, :myAdresse, :myVille, :myMail, :myTrajet, :myLogin, :myPassword, :myIsAdmin, :myIdEnt, :myIdFonction)');
                $stmt->bindValue(':myNom', $emp->getNomEmp());
                $stmt->bindValue(':myPrenom', $emp->getPrenomEmp());
                $stmt->bindValue(':myAge', $emp->getAgeEmp());
                $stmt->bindValue(':myAdresse', $emp->getAdresseEmp());
                $stmt->bindValue(':myVille', $emp->getVilleEmp());
                $stmt->bindValue(':myMail', $emp->getMailEmp());
                $stmt->bindValue(':myTrajet', $emp->getTrajetEmp());
                $stmt->bindValue(':myLogin', $emp->getLoginEmp());
                $stmt->bindValue(':myPassword', $emp->getPasswordEmp());
                $stmt->bindValue(':myIsAdmin', $emp->getIsAdmin());
                $stmt->bindValue(':myIdEnt', $emp->getIdEnt());
                $stmt->bindValue(':myIdFonction', $emp->getIdFonction());
                $stmt->execute();

            } catch (PDOException $e) {
                echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
                exit();
            }
            return $emp;
        }


        //AFFICHER TOUS LES EMPLOYES PAR ENTREPRISE
        public function getAllEmployeByIdEnt($id_ent){
            $listEmp = array();
            try{
                $db = new PDO('sqlite:WorkingTimeCountDB.db');
                $stmt = $db->prepare('SELECT * FROM Employe WHERE id_ent = :myIdEnt');
                $stmt->bindValue(':myIdEnt', $id_ent);
                $stmt->execute();
                
                foreach ($stmt->fetchAll() as $result) {
                    $emp = new Employe();
                    $emp->setIdEmp($result['id_emp']);
                    $emp->setNomEmp($result['nom_emp']);
                    $emp->setPrenomEmp($result['prenom_emp']);
                    $emp->setAgeEmp($result['age_emp']);
                    $emp->setAdresseEmp($result['adresse_emp']);
                    $emp->setVilleEmp($result['ville_emp']);
                    $emp->setMailEmp($result['mail_emp']);
                    $emp->setTrajetEmp($result['trajet_emp']);
                    $emp->setLoginEmp($result['login_emp']);
                    $emp->setPasswordEmp($result['password_emp']);
                    $emp->setIsAdmin($result['isAdmin']);
                    $emp->setIdEnt($result['id_ent']);
                    $emp->setIdFonction($result['id_fonction']);
                    $listEmp[] = $emp;
                }
                
            } catch (PDOException $e) {
                echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
                exit();
            }
            return $listEmp;
        }

        
        //UPDATE EMPLOYE
        public function updateEmploye($emp){
            try {
                $db = new PDO('sqlite:WorkingTimeCountDB.db');
                $stmt = $db->prepare('UPDATE Employe SET nom_emp = :myNom, prenom_emp = :myPrenom, age_emp = :myAge, adresse_emp = :myAdresse, ville_emp = :myVille, mail_emp = :myMail, trajet_emp = :myTrajet, login_emp = :myLogin, password_emp = :myPassword, isAdmin = :myIsAdmin, id_ent = :myIdEnt, id_fonction = :myIdFonction WHERE id_emp = :myId');
                $stmt->bindValue(':myId', $emp->getIdEmp());
                $stmt->bindValue(':myNom', $emp->getNomEmp());
                $stmt->bindValue(':myPrenom', $emp->getPrenomEmp());
                $stmt->bindValue(':myAge', $emp->getAgeEmp());
                $stmt->bindValue(':myAdresse', $emp->getAdresseEmp());
                $stmt->bindValue(':myVille', $emp->getVilleEmp());
                $stmt->bindValue(':myMail', $emp->getMailEmp());
                $stmt->bindValue(':myTrajet', $emp->getTrajetEmp());
                $stmt->bindValue(':myLogin', $emp->getLoginEmp());
                $stmt->bindValue(':myPassword', $emp->getPasswordEmp());
                $stmt->bindValue(':myIsAdmin', $emp->getIsAdmin());
                $stmt->bindValue(':myIdEnt', $emp->getIdEnt());
                $stmt->bindValue(':myIdFonction', $emp->getIdFonction());
                $stmt->execute();

            } catch (PDOException $e) {
                echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
                exit();
            }
            return $emp;
        }

        //DELETE EMPLOYE
        public function deleteEmploye($id){
            try{
                $db = new PDO('sqlite:WorkingTimeCountDB.db');
                $stmt = $db->prepare('DELETE FROM Employe WHERE id_emp = :myId');
                $stmt->bindValue(':myId', $id);
                $stmt->execute();
                
            } catch (PDOException $e) {
                echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
                exit();
            }
        }


        // -------------- CLIENT --------------

         //SELECT LA LISTE DE CLIENT A PARTIR DE LA BASE DE DONNEE
         public function getAllClient(){
            $listClients = array();
            try{
                $db = new PDO('sqlite:WorkingTimeCountDB.db');
                $stmt = $db->prepare('SELECT * FROM Client');
                $stmt->execute();
                
                foreach ($stmt->fetchAll() as $result) {
                    $client = new Client();
                    $client->setIdClient($result['id_client']);
                    $client->setNomClient($result['nom_client']);
                    $client->setAdresseClient($result['adresse_client']);
                    $client->setVilleClient($result['ville_client']);
                    $client->setIsActif($result['isActif']);
                    $listClients[] = $client;
                }
                
            } catch (PDOException $e) {
                echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
                exit();
            }
            return $listClients;
        }

        // AFFICHE TOUS LES CLIENTS ACTIFS
        public function getAllActifClient(){
            $listClients = array();
            try{
                $db = new PDO('sqlite:WorkingTimeCountDB.db');
                $stmt = $db->prepare('SELECT * FROM Client WHERE isActif = 1');
                $stmt->execute();
                
                foreach ($stmt->fetchAll() as $result) {
                    $client = new Client();
                    $client->setIdClient($result['id_client']);
                    $client->setNomClient($result['nom_client']);
                    $client->setAdresseClient($result['adresse_client']);
                    $client->setVilleClient($result['ville_client']);
                    $client->setIsActif($result['isActif']);
                    $listClients[] = $client;
                }
                
            } catch (PDOException $e) {
                echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
                exit();
            }
            return $listClients;
        }


        //SELECT LE CLIENT BY ID
        public function getClientById($id){
            try {
                $db = new PDO('sqlite:WorkingTimeCountDB.db');
                $stmt = $db->prepare('SELECT * FROM Client WHERE id_client = :myId');
                $stmt->bindValue(':myId', $id);
                $stmt->execute();

                $result = $stmt->fetch();
                if ($result) {
                    $client = new Client();
                    $client->setIdClient($id);
                    $client->setNomClient($result['nom_client']);
                    $client->setAdresseClient($result['adresse_client']);
                    $client->setVilleClient($result['ville_client']);
                    $client->setIsActif($result['isActif']);
                } else {
                    echo "Aucun client trouvé avec l'identifiant $id.";
                }
            } catch (PDOException $e) {
                echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
            }
            return $client;
        }

        //ADD CLIENT
        public function addClient($client){
            try {
                $db = new PDO('sqlite:WorkingTimeCountDB.db');
                $stmt = $db->prepare('INSERT INTO Client(nom_client, adresse_client, ville_client, isActif) VALUES(:myNom, :myAdresse, :myVille, :myIsActif)');
                $stmt->bindValue(':myNom', $client->getNomClient());
                $stmt->bindValue(':myAdresse', $client->getAdresseClient());
                $stmt->bindValue(':myVille', $client->getVilleClient());
                $stmt->bindValue(':myIsActif', $client->getIsActif());
                $stmt->execute();

            } catch (PDOException $e) {
                echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
                exit();
            }
            return $client;
        }
        
        public function updateClient($client){
            try {
                $db = new PDO('sqlite:WorkingTimeCountDB.db');
                $stmt = $db->prepare('UPDATE Client SET nom_client = :myNom, adresse_client = :myAdresse, ville_client = :myVille, isActif = :myIsActif WHERE id_client = :myId');
                $stmt->bindValue(':myId', $client->getIdClient());
                $stmt->bindValue(':myNom', $client->getNomClient());
                $stmt->bindValue(':myAdresse', $client->getAdresseClient());
                $stmt->bindValue(':myVille', $client->getVilleClient());
                $stmt->bindValue(':myIsActif', $client->getIsActif());
                $stmt->execute();

            } catch (PDOException $e) {
                echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
                exit();
            }
            return $client;
        }

        //DELETE CLIENT
        public function deleteClient($id){
            try{
                $db = new PDO('sqlite:WorkingTimeCountDB.db');
                $stmt = $db->prepare('DELETE FROM Client WHERE id_client = :myId');
                $stmt->bindValue(':myId', $id);
                $stmt->execute();
                
            } catch (PDOException $e) {
                echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
                exit();
            }
        }


        // -------------- PRESTATION --------------

        public function getAllPrestation(){
            $listPrestation = array();
            try{
                $db = new PDO('sqlite:WorkingTimeCountDB.db');
                $stmt = $db->prepare('SELECT * FROM Prestation');
                $stmt->execute();
                
                foreach ($stmt->fetchAll() as $result) {
                    $prestation = new Prestation();
                    $prestation->setIdPrestation($result['id_prestation']);
                    $prestation->setNomPrestation($result['nom_prestation']);
                    $prestation->setMultiplicateur($result['multiplicateur_prix']);
                    $listPrestation[] = $prestation;
                }
                
            } catch (PDOException $e) {
                echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
                exit();
            }
            return $listPrestation;
        }

        public function getPrestationById($id){
            try {
                $db = new PDO('sqlite:WorkingTimeCountDB.db');
                $stmt = $db->prepare('SELECT * FROM Prestation WHERE id_prestation = :myId');
                $stmt->bindValue(':myId', $id);
                $stmt->execute();

                $result = $stmt->fetch();
                if ($result) {
                    $prestation = new Prestation();
                    $prestation->setIdPrestation($result['id_prestation']);
                    $prestation->setNomPrestation($result['nom_prestation']);
                    $prestation->setMultiplicateur($result['multiplicateur_prix']);
                } else {
                    echo "Aucune prestation trouvé avec l'identifiant $id.";
                }
            } catch (PDOException $e) {
                echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
            }
            return $prestation;
        }


        // -------------- COMPTEUR --------------

         // AFFICHE LES TEMPS DE CHAQUE EMPLOYE
         public function getCompteurByIdEmp($id_emp){
            $listCpt = array();
            try{
                $db = new PDO('sqlite:WorkingTimeCountDB.db');
                $stmt = $db->prepare('SELECT * FROM Compteur WHERE id_emp = :myId ORDER BY date_cpt');
                $stmt->bindValue(':myId', $id_emp);
                $stmt->execute();
                
                foreach ($stmt->fetchAll() as $result) {
                    $cpt = new Compteur();
                    $cpt->setIdCpt($result['id_cpt']);
                    $cpt->setDateCpt($result['date_cpt']);
                    $cpt->setTempsCpt($result['temps_cpt']);
                    $cpt->setDescriptionCpt($result['description_cpt']);
                    $cpt->setIdEmp($result['id_emp']);
                    $cpt->setIdPrestation($result['id_prestation']);
                    $cpt->setIdClient($result['id_client']);
                    $listCpt[] = $cpt;
                }
            } catch (PDOException $e) {
                echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
                exit();
            }
            return $listCpt;
        }


        //AFFICHE LES COMPTEURS PAR IDEMP PAR DATE
        public function getCompteurByIdEmpByDate($id_emp, $date){
            $listCpt = array();
            try{
                $db = new PDO('sqlite:WorkingTimeCountDB.db');
                $stmt = $db->prepare('SELECT * FROM Compteur WHERE id_emp = :myId AND date_cpt = :mydate ORDER BY date_cpt');
                $stmt->bindValue(':myId', $id_emp);
                $stmt->bindValue(':mydate', $date);
                $stmt->execute();
                
                foreach ($stmt->fetchAll() as $result) {
                    $cpt = new Compteur();
                    $cpt->setIdCpt($result['id_cpt']);
                    $cpt->setDateCpt($date);
                    $cpt->setTempsCpt($result['temps_cpt']);
                    $cpt->setDescriptionCpt($result['description_cpt']);
                    $cpt->setIdEmp($result['id_emp']);
                    $cpt->setIdPrestation($result['id_prestation']);
                    $cpt->setIdClient($result['id_client']);
                    $listCpt[] = $cpt;
                }
            } catch (PDOException $e) {
                echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
                exit();
            }
            return $listCpt;
        }

        public function getCompteurBetween2Dates($id_emp, $date1, $date2){
            $listCpt = array();
            try{
                $db = new PDO('sqlite:WorkingTimeCountDB.db');
                $stmt = $db->prepare('SELECT * FROM Compteur WHERE id_emp = :myId AND date_cpt BETWEEN :mydate1 AND :mydate2 ORDER BY date_cpt');
                $stmt->bindValue(':myId', $id_emp);
                $stmt->bindValue(':mydate1', $date1);
                $stmt->bindValue(':mydate2', $date2);
                $stmt->execute();
                
                foreach ($stmt->fetchAll() as $result) {
                    $cpt = new Compteur();
                    $cpt->setIdCpt($result['id_cpt']);
                    $cpt->setDateCpt($result['date_cpt']);
                    $cpt->setTempsCpt($result['temps_cpt']);
                    $cpt->setDescriptionCpt($result['description_cpt']);
                    $cpt->setIdEmp($result['id_emp']);
                    $cpt->setIdPrestation($result['id_prestation']);
                    $cpt->setIdClient($result['id_client']);
                    $listCpt[] = $cpt;
                }
            } catch (PDOException $e) {
                echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
                exit();
            }
            return $listCpt;
        }

        // Ajouter un Compteur avec l'id du client
        public function AddTempsByIdClient($cpt){
            try{
                $db = new PDO('sqlite:WorkingTimeCountDB.db');
                $stmt = $db->prepare('INSERT INTO Compteur(date_cpt, temps_cpt, description_cpt, id_emp, id_prestation, id_client) VALUES(:mydate, :mytime , :mydescription, :myidemp, :myidprestation, :myidclient);');
                $stmt->bindValue(':mydate', $cpt->getDateCpt());
                $stmt->bindValue(':mytime', $cpt->getTempsCpt());
                $stmt->bindValue(':mydescription', $cpt->getDescriptionCpt());
                $stmt->bindValue(':myidemp', $cpt->getIdEmp());
                $stmt->bindValue(':myidprestation', $cpt->getIdPrestation());
                $stmt->bindValue(':myidclient', $cpt->getIdClient());
                $stmt->execute();
                
        
            } catch (PDOException $e) {
                echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
                exit();
            }
            return $cpt;
        }

        // -------------- ENTREPRISE --------------

        public function addEntreprise($entreprise){
            try {
                $db = new PDO('sqlite:WorkingTimeCountDB.db');
                $stmt = $db->prepare('INSERT INTO entreprise (nom_ent, adresse_ent, ville_ent) VALUES(:myNomEnt, :myAdresseEnt, :myVilleEnt)');
                $stmt->bindValue(':myNomEnt', $entreprise->getNomEnt());
                $stmt->bindValue(':myAdresseEnt', $entreprise->getAdresseEnt());
                $stmt->bindValue(':myVilleEnt', $entreprise->getVilleEnt());
                $stmt->execute();

            } catch (PDOException $e) {
                echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
                exit();
            }
            return $entreprise;

        }

        public function getEntreprisebyId($id){
            try {
                $db = new PDO('sqlite:WorkingTimeCountDB.db');
                $stmt = $db->prepare('SELECT * FROM Entreprise WHERE id_ent = :myId');
                $stmt->bindValue(':myId', $id);
                $stmt->execute();

                $result = $stmt->fetch();
                if ($result) {
                    $ent = new Entreprise();
                    $ent->setIdEnt($id);
                    $ent->setNomEnt($result['nom_ent']);
                    $ent->setAdresseEnt($result['adresse_ent']);
                    $ent->setVilleEnt($result['ville_ent']);
                } else {
                    echo "Aucun client trouvé avec l'identifiant $id.";
                }
            } catch (PDOException $e) {
                echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
            }
            return $ent;
        }


        // -------------- CONNEXION --------------

        public function verifLoginPassword($login, $password){
            $emp = null;
            try {
                $db = new PDO('sqlite:WorkingTimeCountDB.db');
                $stmt = $db->prepare('SELECT * FROM Employe WHERE login_emp = :myLogin AND password_emp = :myPassword');
                $stmt->bindValue(':myLogin', $login);
                $stmt->bindValue(':myPassword', $password);
                $stmt->execute();

                $result = $stmt->fetch();
                if ($result) {
                    $emp = new Employe();
                    $emp->setIdEmp($result['id_emp']);
                    $emp->setNomEmp($result['nom_emp']);
                    $emp->setPrenomEmp($result['prenom_emp']);
                    $emp->setAgeEmp($result['age_emp']);
                    $emp->setAdresseEmp($result['adresse_emp']);
                    $emp->setVilleEmp($result['ville_emp']);
                    $emp->setMailEmp($result['mail_emp']);
                    $emp->setTrajetEmp($result['trajet_emp']);
                    $emp->setLoginEmp($result['login_emp']);
                    $emp->setPasswordEmp($result['password_emp']);
                    $emp->setIsAdmin($result['isAdmin']);
                    $emp->setIdEnt($result['id_ent']);
                    $emp->setIdFonction($result['id_fonction']);
                } else {
                    echo "Aucun Employe trouvé.";
                }
            } catch (PDOException $e) {
                echo "Erreur lors de la connexion à la base de données : " . $e->getMessage();
            }
            return $emp;
        }

    }
?>
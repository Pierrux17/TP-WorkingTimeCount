<?php
    class Employe {
        private $id_emp;
        private $nom_emp;
        private $prenom_emp;
        private $age_emp;
        private $adresse_emp;
        private $ville_emp;
        private $mail_emp;
        private $trajet_emp;
        private $login_emp;
        private $password_emp;
        private $isAdmin;
        private $id_ent;
        private $id_fonction;

        public function __construct($nom_emp = null, $prenom_emp = null, $age_emp = null, $adresse_emp = null, $ville_emp = null, $mail_emp = null,
        $trajet_emp = null, $login_emp = null, $password_emp = null, $isAdmin = null , $id_ent = null, $id_fonction = null) {
            $this->nom_emp = $nom_emp;
            $this->prenom_emp = $prenom_emp;
            $this->age_emp = $age_emp;
            $this->adresse_emp = $adresse_emp;
            $this->ville_emp = $ville_emp;
            $this->mail_emp = $mail_emp;
            $this->trajet_emp = $trajet_emp;
            $this->login_emp = $login_emp;
            $this->password_emp = $password_emp;
            $this->isAdmin = $isAdmin;
            $this->id_ent = $id_ent;
            $this->id_fonction = $id_fonction;
        }
      
        public function getIdEmp() {
            return $this->id_emp;
        }
      
        public function setIdEmp($id_emp) {
            $this->id_emp = $id_emp;
        }
      
        public function getNomEmp() {
            return $this->nom_emp;
        }
      
        public function setNomEmp($nom_emp) {
            $this->nom_emp = $nom_emp;
        }
      
        public function getPrenomEmp() {
            return $this->prenom_emp;
        }
      
        public function setPrenomEmp($prenom_emp) {
            $this->prenom_emp = $prenom_emp;
        }
      
        public function getAgeEmp() {
            return $this->age_emp;
        }
      
        public function setAgeEmp($age_emp) {
            $this->age_emp = $age_emp;
        }

        public function getAdresseEmp(){
            return $this->adresse_emp;
        }

        public function setAdresseEmp($adresse_emp){
            $this->adresse_emp = $adresse_emp;
        }

        public function getVilleEmp(){
            return $this->ville_emp;
        }

        public function setVilleEmp($ville_emp){
            $this->ville_emp = $ville_emp;
        }

        public function getMailEmp(){
            return $this->mail_emp;
        }

        public function setMailEmp($mail_emp){
            $this->mail_emp = $mail_emp;
        }

        public function getTrajetEmp(){
            return $this->trajet_emp;
        }

        public function setTrajetEmp($trajet_emp){
            $this->trajet_emp = $trajet_emp;
        }

        public function getLoginEmp(){
            return $this->login_emp;
        }
    
        public function setLoginEmp($login_emp){
            $this->login_emp = $login_emp;
        }
    
        public function getPasswordEmp(){
           return $this->password_emp;
        }
    
        public function setPasswordEmp($password_emp){
            $this->password_emp = $password_emp;
        }

        public function getIsAdmin(){
            return $this->isAdmin;
        }

        public function setIsAdmin($isAdmin){
            $this->isAdmin = $isAdmin;
        }

        public function getIdEnt(){
            return $this->id_ent;
        }

        public function setIdEnt($id_ent){
            $this->id_ent = $id_ent;
        }

        public function getIdFonction(){
            return $this->id_fonction;
        }

        public function setIdFonction($id_fonction){
            $this->id_fonction = $id_fonction;
        }
   }

?>
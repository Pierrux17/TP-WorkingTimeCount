<?php
    class Client {
        private $id_client;
        private $nom_client;
        private $adresse_client;
        private $ville_client;
        private $isActif;

        public function __construct($nom_client = null, $adresse_client = null, $ville_client = null, $isActif = null) {
            $this->nom_client = $nom_client;
            $this->adresse_client = $adresse_client;
            $this->ville_client = $ville_client;
            $this->isActif = $isActif;
        }
      
        public function getIdClient() {
            return $this->id_client;
        }
      
        public function setIdClient($id_client) {
            $this->id_client = $id_client;
        }
      
        public function getNomClient() {
            return $this->nom_client;
        }
      
        public function setNomClient($nom_client) {
            $this->nom_client = $nom_client;
        }

        public function getAdresseClient() {
            return $this->adresse_client;
        }
      
        public function setAdresseClient($adresse_client) {
            $this->adresse_client = $adresse_client;
        }

        public function getVilleClient() {
            return $this->ville_client;
        }
      
        public function setVilleClient($ville_client) {
            $this->ville_client = $ville_client;
        }

        public function getIsActif() {
            return $this->isActif;
        }
      
        public function setIsActif($isActif) {
            $this->isActif = $isActif;
        }
   }

?>
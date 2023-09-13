<?php
    class Entreprise {
        private $id_ent;
        private $nom_ent;
        private $adresse_ent;
        private $ville_ent;

        public function __construct($nom_ent = null, $adresse_ent = null, $ville_ent = null) {
            $this->nom_ent = $nom_ent;
            $this->adresse_ent = $adresse_ent;
            $this->ville_ent = $ville_ent;
        }

        public function getIdEnt() {
            return $this->id_ent;
        }
      
        public function setIdEnt($id_ent) {
            $this->id_ent = $id_ent;
        }

        public function getNomEnt(){
            return $this->nom_ent;
        }

        public function setNomEnt($nom_ent){
            $this->nom_ent = $nom_ent;
        }

        public function getAdresseEnt(){
            return $this->adresse_ent;
        }

        public function setAdresseEnt($adresse_ent){
            $this->adresse_ent = $adresse_ent;
        }

        public function getVilleEnt(){
            return $this->ville_ent;
        }

        public function setVilleEnt($ville_ent){
            $this->ville_ent = $ville_ent;
        }
    }
?>
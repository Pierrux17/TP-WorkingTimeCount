<?php
    class Prestation {
        private $id_prestation;
        private $nom_prestation;
        private $multiplicateur_prix;

        public function __construct($nom_prestation = null, $multiplicateur_prix = null){
            $this->nom_prestation = $nom_prestation;
            $this->multiplicateur_prix = $multiplicateur_prix;
        }

        public function getIdPrestation() {
            return $this->id_client;
        }
      
        public function setIdPrestation($id_prestation) {
            $this->id_prestation = $id_prestation;
        }
      
        public function getNomPrestation() {
            return $this->nom_prestation;
        }
      
        public function setNomPrestation($nom_prestation) {
            $this->nom_prestation = $nom_prestation;
        }

        public function getMultiplicateur(){
            return $this->multiplicateur_prix;
        }

        public function setMultiplicateur($multiplicateur_prix){
            $this->multiplicateur_prix = $multiplicateur_prix;
        }
    }
?>
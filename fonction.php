<?php
    class Fonction{
        private $id_fonction;
        private $name_fonction;
        private $tarif_fonction;

        public function __construct($id_fonction = null, $name_fonction = null, $tarif_fonction = null) {
            $this->name_fonction = $name_fonction;
            $this->tarif_fonction = $tarif_fonction;
        }

        public function getIdFonction() {
            return $this->id_fonction;
        }
      
        public function setIdFonction($id_fonction) {
            $this->id_fonction = $id_fonction;
        }
      
        public function getNomFonction() {
            return $this->name_fonction;
        }
      
        public function setNomFonction($name_fonction) {
            $this->name_fonction = $name_fonction;
        }
      
        public function getTarifFonction() {
            return $this->tarif_fonction;
        }
      
        public function setTarifFonction($tarif_fonction) {
            $this->tarif_fonction = $tarif_fonction;
        }
    }
?>
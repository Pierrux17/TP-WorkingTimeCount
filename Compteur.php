<?php
    class Compteur {
        private $id_cpt;
        private $date_cpt;
        private $temps_cpt;
        private $description_cpt;
        private $id_emp;
        private $id_prestation;
        private $id_client;

        public function __construct($date_cpt = null, $temps_cpt = null, $description_cpt = null, $id_emp = null, $id_prestation = null, $id_client = null){
            $this->date_cpt = $date_cpt;
            $this->temps_cpt = $temps_cpt;
            $this->description_cpt = $description_cpt;
            $this->id_emp = $id_emp;
            $this->id_prestation = $id_prestation;
            $this->id_client = $id_client;
        }

        public function getIdCpt(){
            return $this->id_cpt;
        }

        public function setIdCpt($id_cpt){
            $this->id_cpt = $id_cpt;
        }

        public function getDateCpt(){
            return $this->date_cpt;
        }

        public function setDateCpt($date_cpt){
            $this->date_cpt = $date_cpt;
        }

        public function getTempsCpt(){
            return $this->temps_cpt;
        }

        public function setTempsCpt($temps_cpt){
            $this->temps_cpt = $temps_cpt;
        }

        public function getDescriptionCpt(){
            return $this->description_cpt;
        }

        public function setDescriptionCpt($description_cpt){
            $this->description_cpt = $description_cpt;
        }

        public function getIdEmp(){
            return $this->id_emp;
        }

        public function setIdEmp($id_emp){
            $this->id_emp = $id_emp;
        }

        public function getIdPrestation(){
            return $this->id_prestation;
        }

        public function setIdPrestation($id_prestation){
            $this->id_prestation = $id_prestation;
        }

        public function getIdClient(){
            return $this->id_client;
        }

        public function setIdClient($id_client){
            $this->id_client = $id_client;
        }
    }
?>
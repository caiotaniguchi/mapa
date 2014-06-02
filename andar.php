<?php
    class Andar {
        private $id;
        private $numAndar;
        private $planta;
        private $listaAmbientes;
        private $idEdificio;
        
        public function setId($id) {
            $this->id = $id;
        }
        
        public function getId() {
            return $this->id;
        }
        
        public function setNumAndar($numAndar) {
            $this->numAndar = $numAndar;
        }
        
        public function getNumAndar() {
            return $this->numAndar;
        }
        
        public function setPlanta($planta) {
            $this->planta = $planta;
        }
        
        public function getPlanta() {
            return $this->planta;
        }
        
        public function setlistaAmbientes($listaAmbientes) {
            $this->listaAmbientes = $listaAmbientes;
        }
        
        public function getListaAmbientes() {
            return $this->listaAmbientes;
        }
        
        public function setIdEdificio($idEdificio) {
            $this->idEdificio = $idEdificio;
        }
        
        public function getIdEdificio() {
            return $this->idEdificio;
        }
    }
?>

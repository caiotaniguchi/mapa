<?php
    class Modulo {
		private $id;
		private $estado;
        private $idAmbiente;
                
        public function setId($id) {
            $this->id = $id;
        }
        
        public function getId() {
            return $this->id;
        }
        
        public function setEstado($estado) {
            $this->estado = $estado;
        }
        
        public function getEstado() {
            return $this->estado;
        }
        
        public function setIdAmbiente($idAmbiente) {
            $this->idAmbiente = $idAmbiente;
        }
        
        public function getIdAmbiente() {
            return $this->idAmbiente;
        }
    }
?>

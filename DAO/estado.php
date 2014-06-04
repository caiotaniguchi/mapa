<?php
    class EstadoModulo {
private $id;
        private $idModulo;
        private $estado;
        private $dataEntrada;
        
        public function setId($id) {
            $this->id = $id;
        }
        
        public function getId() {
            return $this->id;
        }
        
        public function setIdModulo($idModulo) {
            $this->idModulo = $idModulo;
        }
        
        public function getIdModulo() {
            return $this->idModulo;
        }
        
        public function setEstado($estado) {
            $this->estado = $estado;
        }
        
        public function getEstado() {
            return $this->estado;
        }
        
        public function setDataEntrada($dataEntrada) {
            $this->dataEntrada = $dataEntrada;
        }
        
        public function getDataEntrada() {
            return $this->dataEntrada;
        }
    }
?>

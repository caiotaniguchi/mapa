<?php
    class CondicaoRange {
        private $id;
        private $interesse;
        private $min;
        private $max;
        private $idAmbiente;
        
        public function setId($id) {
            $this->id = $id;
        }
        
        public function getId() {
            return $this->id;
        }
        
        public function setInteresse($interesse) {
            $this->interesse = $interesse;
        }
        
        public function getInteresse() {
            return $this->interesse;
        }
                
        public function setMin($min) {
            $this->min = $min;
        }
        
        public function getMin() {
            return $this->min;
        }
        
        public function setMax($max) {
            $this->max = $max;
        }
        
        public function getMax() {
            return $this->max;
        }
        
        public function setIdAmbiente($idAmbiente) {
			$this->idAmbiente = $idAmbiente;
        }
        
        public function getIdAmbiente() {
            return $this->idAmbiente;
        }

        
}
?>

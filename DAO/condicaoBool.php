<?php
    class CondicaoBool {
        private $id;
        private $interesse;
        private $valorCritico;
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
                
        public function setValorCritico($valorCritico) {
            $this->valorCritico = $valorCritico;
        }
        
        public function getValorCritico() {
            return $this->valorCritico;
        }
        
        public function setIdAmbiente($idAmbiente) {
			$this->idAmbiente = $idAmbiente;
        }
        
        public function getIdAmbiente() {
            return $this->idAmbiente;
        }

        
}
?>

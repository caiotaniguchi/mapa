<?php
    class Modulo {
private $id;
private $estado;
        private $idAmbiente;
        private $posicao;
                
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
        
        public function setPosicao($posicao) {
            $this->posicao = $posicao;
        }
        
        public function getPosicao() {
            return $this->Posicao;
        }
    }
?>

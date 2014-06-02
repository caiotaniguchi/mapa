<?php
    class Ambiente {
        private $id;
        private $nome;
        private $posicaoX;
        private $posicaoY;
        private $listaModulos;
        private $idAndar;
        
        public function setId($id) {
            $this->id = $id;
        }
        
        public function getId() {
            return $this->id;
        }
        
        public function setNome($nome) {
            $this->nome = $nome;
        }
        
        public function getNome() {
            return $this->nome;
        }
        
        public function setPosicaoX($posicaoX) {
            $this->posicaoX = $posicaoX;
        }
        
        public function getPosicaoX() {
            return $this->posicaoX;
        }
        
        public function setPosicaoY($posicaoY) {
            $this->posicaoY = $posicaoY;
        }
        
        public function getPosicaoY() {
            return $this->posicaoY;
        }
        
        public function setListaModulos($listaModulos) {
            $this->listaModulos = $listaModulos;
        }
        
        public function getListaModulos() {
            return $this->listaModulos;
		}
            
        public function setIdAndar($idAndar) {
            $this->idAndar = $idAndar;
        }
        
        public function getIdAndar() {
            return $this->idAndar;    
        }
    }
?>

<?php
    class Ambiente {
        private $id;
        private $nome;
        private $posicao;
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
        
        public function setPosicao($posicao) {
            $this->posicao = $posicao;
        }
        
        public function getPosicao() {
            return $this->posicao;
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

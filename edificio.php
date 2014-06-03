<?php
    class Edificio {
        private $id;
        private $nome;
        private $andarInicial;
        private $andarFinal;
        private $listaAndares;
        
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
                
        public function setAndarInicial($andarInicial) {
            $this->andarInicial = $andarInicial;
        }
        
        public function getAndarInicial() {
            return $this->andarInicial;
        }
        
        
        public function setAndarFinal($andarFinal) {
            $this->andarFinal = $andarFinal;
        }
        
        public function getAndarFinal() {
            return $this->AndarFinal;
        }
        
	}
?>

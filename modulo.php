<?php
    class Modulo {
		// conferir estado no banco de dados
        private $id;
        private $nome;
        private $estado;
        private $idAmbiente;
        
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

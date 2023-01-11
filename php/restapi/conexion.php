<?php

class Conexion extends PDO
	{
		private $hostBd = 'localhost';
		private $nombreBd = 'tienda';
		private $usuarioBd = 'root';
		private $passwordBd = '';
		private $conecta;
		
		public function __construct(){
            $cadenac="mysql:host=".$this->hostBd.";dbname=".$this->nombreBd.";charset=utf8";
            try{
                $this->conecta=new PDO($cadenac,$this->usuarioBd,$this->passwordBd);
                $this->conecta->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }
            catch(Exception $e){
                $this->conecta="Error de conexion...";
                echo "Error: ".$e->getMessage();
        }
        }

        public function AbrirConexion(){
            return $this->conecta;
        }
    }

?>

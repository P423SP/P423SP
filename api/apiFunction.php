<?php
    class apiFunction {
        private $funcion;
        private $parametrosAPI;
    
        function __construct($params) {
            $this->funcion=$_POST['funcion'] ?? "";
            $this->parametrosAPI=array();

            foreach($params as $param=>$valor){
                if($param!='funcion') $this->parametrosAPI[$param]=$valor;
            }
        }

        function checkArgs($funcion, ...$args){
            if ($this->funcion!=$funcion) return false;

            $argsNames=array();
            foreach($args as $key=>$valor) {
                $argsNames[$valor]='';
                if (!array_key_exists($valor,$this->parametrosAPI)) return false;
            }       
            foreach($this->parametrosAPI as $key=>$valor) {
                if (!array_key_exists($key,$argsNames)) return false;
            }
            return true;
        }

        function getParametrosAPI(){
            $p=array();
            foreach($this->parametrosAPI as $valor) {
                $p[]=$valor;
            }
            return $p;
        }
  
        function getFunction(){
            return $this->funcion;
        }

    }
?>
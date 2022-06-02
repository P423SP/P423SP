<?php
    function toLoginIfInvalidParameters($args,...$argsPagina){
        if (!checkArgs($args,$argsPagina)) toLogin();
    }

    function checkArgs($args1, $args2){
        $argsNames=array();
        foreach($args2 as $valor) {
            $s=explode(":",$valor);
            $argsNames[$s[0]]='';
            if (!array_key_exists($s[0],$args1)) return false;
            if (sizeof($s)>1) {
                if($args1[$s[0]]!=$s[1]) return false;
            }
        }       
        foreach($args1 as $key=>$valor) {
            if (!array_key_exists($key,$argsNames)) return false;
        }
        return true;
    }

    function toLoginIfNotConnected() {
        if (!isset($_GET["name"])) toLogin();
    }
    
    function toLogout() {
        header("Location: ../paginas/logout.php");
        exit;
    }  

    function toLogin($expired=false) {
        
        header("Location: ../paginas/Index.php");
        exit;
    }
?>
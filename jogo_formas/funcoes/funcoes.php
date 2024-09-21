<?php
    function TipoTriangulo($ladoA, $ladoB, $ladoC){
        if($ladoA == $ladoB && $ladoB == $ladoC){
            $triangulo = 1;
        } elseif($ladoA != $ladoB && $ladoB != $ladoC){
            $triangulo = 2;
        } elseif($ladoA == $ladoB && $ladoB != $ladoC){
            $triangulo = 3;
        } elseif($ladoB == $ladoC && $ladoC != $ladoA){
            $triangulo = 3;
        } elseif($ladoA == $ladoC && $ladoC != $ladoB){
            $triangulo = 3;
        }
        return $triangulo;
    }
?>
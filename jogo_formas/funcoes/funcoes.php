<?php
    function TipoTriangulo($ladoA, $ladoB, $ladoC){
        if($ladoA == $ladoB && $ladoB == $ladoC){
            $triangulo = "Equilátero";
        } elseif($ladoA != $ladoB && $ladoB != $ladoC){
            $triangulo = "Escaleno";
        } elseif($ladoA == $ladoB && $ladoB != $ladoC){
            $triangulo = "Isosceles";
        } elseif($ladoB == $ladoC && $ladoC != $ladoA){
            $triangulo = "Isosceles";
        } elseif($ladoA == $ladoC && $ladoC != $ladoB){
            $triangulo = "Isosceles";
        }
        return $triangulo;
    }
?>
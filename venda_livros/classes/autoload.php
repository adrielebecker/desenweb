<?php
    spl_autoload_register(callback: function ($class){
        include '../classes/'.$class.'.class.php';
    });
?>

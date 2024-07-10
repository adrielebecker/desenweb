<?php
    require_once('../classes/Login.class.php');
    require_once('../classes/Livro.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : "";
        $senha = isset($_POST['senha']) ? $_POST['senha'] : "";
        var_dump($usuario);
        var_dump($senha);

        try{
            $livro = Login::efetuarLogin($usuario, $senha);
            var_dump($livro); 
            if($livro){
                session_start();
                $_SESSION['idusuario'] = $livro->getId();
                $_SESSION['autor'] = $livro->getAutor();
                header('Location: ../livro/index.php');
            } else{
                echo "Erro ao efetuar login";
            }
        } catch(Exception $e){ 
            header('Location: index.php?MSG=Erro: '.$e->getMessage());
        }
    }
?>
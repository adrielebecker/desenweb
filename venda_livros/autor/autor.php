<?php
    require_once("../classes/autoload.php");

    echo "<pre>";
        var_dump($_POST);
    echo "</pre>";

    $id_autor = isset($_GET['id_autor']) ? $_GET['id_autor'] : 0;
    if($id_autor > 0){
        $autor = Autor::listar(1, $id_autor)[0];
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id_autor = isset($_POST['id_autor']) ? $_POST['id_autor'] : 0;
        $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
        $sobrenome = isset($_POST['sobrenome']) ? $_POST['sobrenome'] : "";
        $acao = isset($_POST['acao']) ? $_POST['acao'] : "";

        try {
            $autor = new Autor($id_autor, $nome, $sobrenome);
            $resultado = "";

            if($acao == "salvar"){
                if($id_autor > 0){
                    $resultado = $autor->alterar();
                } else{
                    $resultado = $autor->inserir();
                }
            } elseif($acao == "excluir"){
                $resultado = $autor->excluir();
            }

            header('Location: index.php');
        } catch (PDOException $e) {
            header('Location: index.php?MSG=Erro: '.$e->getMessage());
        }
    } elseif($_SERVER['REQUEST_METHOD'] == 'GET'){
        $tipo_autor = isset($_GET['tipo_autor']) ? $_GET['tipo_autor'] : 0;
        $busca_autor = isset($_GET['busca_autor']) ? $_GET['busca_autor'] : "";
        $lista_autor = autor::listar($tipo_autor, $busca_autor);
    }

?>
<?php
    require_once("../classes/autoload.php");

    $id_unidadeMedida = isset($_GET['id_unidadeMedida']) ? $_GET['id_unidadeMedida'] : 0;
    if($id_unidadeMedida > 0){
        $unidade = UnidadeMedida::listar(1, $id_unidadeMedida)[0];
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id_unidadeMedida = isset($_POST['id_unidadeMedida']) ? $_POST['id_unidadeMedida'] : 0;
        $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : "";
        $acao = isset($_POST['acao']) ? $_POST['acao'] : "";

        try {
            $unidadeMedida = new UnidadeMedida($id_unidadeMedida, $descricao);
            $resultado = "";

            if($acao == "salvar"){
                if($id_unidadeMedida > 0){
                    $resultado = $unidadeMedida->alterar();
                } else{
                    $resultado = $unidadeMedida->inserir();
                }
            } elseif($acao == "excluir"){
                $resultado = $unidadeMedida->excluir();
            }

            header('Location: index.php');
        } catch (PDOException $e) {
            header('Location: index.php?MSG=Erro: '.$e->getMessage());
        }
    } elseif($_SERVER['REQUEST_METHOD'] == 'GET'){
        $tipo_unidade = isset($_GET['tipo_unidade']) ? $_GET['tipo_unidade'] : 0;
        $busca_unidade = isset($_GET['busca_unidade']) ? $_GET['busca_unidade'] : "";
        $lista_unidade = UnidadeMedida::listar($tipo_unidade, $busca_unidade);
    }
?>
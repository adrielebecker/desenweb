<?php
    require_once("../classes/Unidade.class.php");

    $id_unidadeMedida = isset($_GET['id_unidadeMedida']) ? $_GET['id_unidadeMedida'] : 0; 
    $msg = isset($_GET['MSG']) ? $_GET['MSG'] : "";
    if ($id_unidadeMedida > 0){
        $unidade = Unidade::listar(1, $id_unidadeMedida)[0]; 
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id_unidadeMedida = isset($_POST['id_unidadeMedida']) ? $_POST['id_unidadeMedida'] : 0;
        $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : "";
        $acao = isset($_POST['acao']) ? $_POST['acao'] : "";

        try {
            $unidade = new Unidade($id_unidadeMedida, $descricao);

            $resultado = "";

            if($acao == "salvar"){
                if($id > 0){
                    $resultado = $unidade->alterar();
                    echo "ainda nao fiz";
                } else{
                    $resultado = $unidade->inserir();
                    echo "inserido com sucesso";
                }
            } elseif($acao == 'excluir'){
                $resultado = $unidade->excluir();
            }
            
            header('Location: index.php');

        } catch (PDOException $e) {
            header('Location: index.php?MSG=Erro: '.$e->getMessage());
        }
    } elseif($_SERVER['REQUEST_METHOD'] == 'GET'){ 
        $busca = isset($_GET['busca']) ? $_GET['busca'] : ""; 
        $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 0; 
        $lista_unidade = Unidade::listar($tipo, $busca); 
    }
?>

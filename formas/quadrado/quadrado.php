<?php
    require_once("../classes/Quadrado.class.php");

    $id = isset($_GET['id']) ? $_GET['id'] : 0; 
    $msg = isset($_GET['MSG']) ? $_GET['MSG'] : "";
    if ($id > 0){
        $quadrado = Quadrado::listar(1, $id)[0]; 
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = isset($_POST['id']) ? $_POST['id'] : 0;
        $unidadeMedida = isset($_POST['unidadeMedida']) ? $_POST['unidadeMedida'] : "";
        $lado = isset($_POST['lado']) ? $_POST['lado'] : 0;
        $cor = isset($_POST['cor']) ? $_POST['cor'] : "";
        $acao = isset($_POST['acao']) ? $_POST['acao'] : "";

        try {
            $quadrado = new Quadrado($id, $unidadeMedida, $lado, $cor);

            $resultado = "";

            if($acao == "salvar"){
                if($id > 0){
                    $resultado = $quadrado->alterar();
                    echo "ainda nao fiz";
                } else{
                    $resultado = $quadrado->inserir();
                    echo "inserido com sucesso";
                }
            } elseif($acao == 'excluir'){
                $resultado = $quadrado->excluir();
            }
            
            header('Location: index.php');

        } catch (PDOException $e) {
            header('Location: index.php?MSG=Erro: '.$e->getMessage());
        }
    } elseif($_SERVER['REQUEST_METHOD'] == 'GET'){ 
        $busca = isset($_GET['busca']) ? $_GET['busca'] : 0; 
        $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 0; 
        $lista = Quadrado::listar($tipo, $busca); 
    }
?>

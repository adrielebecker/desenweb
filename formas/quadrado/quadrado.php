<?php
    require_once("../classes/Quadrado.class.php");
    require_once("../classes/Unidade.class.php");

    // var_dump($_POST);
    $id_quadrado = isset($_GET['id_quadrado']) ? $_GET['id_quadrado'] : 0; 
    $msg = isset($_GET['MSG']) ? $_GET['MSG'] : "";
    if ($id_quadrado > 0){
        $quadrado = Quadrado::listar(1, $id_quadrado)[0]; 
    }
    
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id_quadrado = isset($_POST['id_quadrado']) ? $_POST['id_quadrado'] : 0;
        $unidadeMedida = isset($_POST['unidadeMedida']) ? $_POST['unidadeMedida'] : "";
        $lado = isset($_POST['lado']) ? $_POST['lado'] : 0;
        $cor = isset($_POST['cor']) ? $_POST['cor'] : "";
        $acao = isset($_POST['acao']) ? $_POST['acao'] : "";

        try {
            $unidade = Unidade::listar(1, $unidadeMedida)[0]; 
            $quadrado = new Quadrado($id_quadrado, $lado, $cor, $unidade);

            $resultado = "";

            if($acao == "salvar"){
                if($id_quadrado > 0){
                    $resultado = $quadrado->alterar();
                    echo "alterado com sucesso";
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
        $lista_quadrado = Quadrado::listar($tipo, $busca); 
    }
?>

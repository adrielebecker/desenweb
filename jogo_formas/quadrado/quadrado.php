<?php
    require_once("../classes/Quadrado.class.php");
    require_once("../classes/UnidadeMedida.class.php");

    $id_quadrado = isset($_GET['id_quadrado']) ? $_GET['id_quadrado'] : 0;
    if($id_quadrado > 0){
        $quadrado = Quadrado::listar(1, $id_quadrado)[0];
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id_quadrado = isset($_POST['id_quadrado']) ? $_POST['id_quadrado'] : 0;
        $lado = isset($_POST['lado']) ? $_POST['lado'] : 0;
        $cor = isset($_POST['cor']) ? $_POST['cor'] : "";
        $unidade_medida = isset($_POST['unidade_medida']) ? $_POST['unidade_medida'] : "";
        $arquivo = isset($_FILES['fundo']) ? $_FILES['fundo'] : "";
        $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
        $destino = "../".IMG."/".$arquivo['name'];

        try {
            $unidade = UnidadeMedida::listar(1, $unidade_medida)[0];
            $quadrado = new Quadrado($id_quadrado, $lado, $cor, $unidade, $destino);
            $resultado = "";

            if($acao == "salvar"){
                if($id_quadrado > 0){
                    $resultado = $quadrado->alterar();
                } else{
                    $resultado = $quadrado->inserir();
                }
            } elseif($acao == "excluir"){
                $resultado = $quadrado->excluir();
            }

            move_uploaded_file($arquivo['tmp_name'], $destino);
            header('Location: index.php');
        } catch (PDOException $e) {
            header('Location: index.php?MSG=Erro: '.$e->getMessage());
        }
    } elseif($_SERVER['REQUEST_METHOD'] == 'GET'){
        $tipo_quadrado = isset($_GET['tipo_quadrado']) ? $_GET['tipo_quadrado'] : 0;
        $busca_quadrado = isset($_GET['busca_quadrado']) ? $_GET['busca_quadrado'] : "";
        $lista_quadrado = Quadrado::listar($tipo_quadrado, $busca_quadrado);
    }

?>
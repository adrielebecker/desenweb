<?php
    require_once("../classes/autoload.php");

    $id_circulo = isset($_GET['id_circulo']) ? $_GET['id_circulo'] : 0;
    if($id_circulo > 0){
        $circulo = Circulo::listar(1, $id_circulo)[0];
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id_circulo = isset($_POST['id_circulo']) ? $_POST['id_circulo'] : 0;
        $raio = isset($_POST['raio']) ? $_POST['raio'] : 0;
        $cor = isset($_POST['cor']) ? $_POST['cor'] : "";
        $unidade_medida = isset($_POST['unidade_medida']) ? $_POST['unidade_medida'] : "";
        $arquivo = isset($_FILES['fundo']) ? $_FILES['fundo'] : "";
        $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
        $destino = "../".IMG."/".$arquivo['name'];

        try {
            $unidade = UnidadeMedida::listar(1, $unidade_medida)[0];
            $circulo = new Circulo($id_circulo, $raio, $cor, $unidade, $destino);
            $resultado = "";

            if($acao == "salvar"){
                if($id_circulo > 0){
                    $resultado = $circulo->alterar();
                } else{
                    $resultado = $circulo->inserir();
                }
            } elseif($acao == "excluir"){
                $resultado = $circulo->excluir();
            }

            move_uploaded_file($arquivo['tmp_name'], $destino);
            header('Location: index.php');
        } catch (PDOException $e) {
            header('Location: index.php?MSG=Erro: '.$e->getMessage());
        }
    } elseif($_SERVER['REQUEST_METHOD'] == 'GET'){
        $tipo_circulo = isset($_GET['tipo_circulo']) ? $_GET['tipo_circulo'] : 0;
        $busca_circulo = isset($_GET['busca_circulo']) ? $_GET['busca_circulo'] : "";
        $lista_circulo = Circulo::listar($tipo_circulo, $busca_circulo);
    }

?>
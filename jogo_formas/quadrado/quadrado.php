<?php
    require_once("../classes/Quadrado.class.php");

    $id_quadrado = isset($_GET['id_quadrado']) ? $_GET['id_quadrado'] : 0;
    if($id_quadrado > 0){
        $quadrado = Quadrado::listar(1, $id_quadrado)[0];
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id_quadrado = isset($_POST['id_quadrado']) ? $_POST['id_quadrado'] : 0;
        $lado = isset($_POST['lado']) ? $_POST['lado'] : 0;
        $cor = isset($_POST['cor']) ? $_POST['cor'] : "";
        $unidade_medida = isset($_POST['unidade_medida']) ? $_POST['unidade_medida'] : "";
        $acao = isset($_POST['acao']) ? $_POST['acao'] : "";

        try {
            $quadrado = new Quadrado($id_quadrado, $lado, $cor, $unidade_medida);
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

            header('Location: index.php');
        } catch (PDOException $e) {
            header('Location: index.php?MSG=Erro: '.$e->getMessage());
        }
    } elseif($_SERVER['REQUEST_METHOD'] == 'GET'){
        $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 0;
        $busca = isset($_GET['busca']) ? $_GET['busca'] : "";
        $lista_quadrado = Quadrado::listar($tipo, $busca);
    }

    // echo "<pre>";
    // var_dump($lista_quadrado);

?>
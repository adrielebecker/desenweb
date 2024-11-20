<?php
    require_once("../classes/autoload.php");

    echo "<pre>";
        var_dump($_POST);
    echo "</pre>";

    $id_categoria = isset($_GET['id_categoria']) ? $_GET['id_categoria'] : 0;
    if($id_categoria > 0){
        $categoria = Categoria::listar(1, $id_categoria)[0];
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id_categoria = isset($_POST['id_categoria']) ? $_POST['id_categoria'] : 0;
        $descricao = isset($_POST['descricao']) ? $_POST['descricao'] : "";
        $acao = isset($_POST['acao']) ? $_POST['acao'] : "";

        try {
            $categoria = new Categoria($id_categoria, $descricao);
            $resultado = "";

            if($acao == "salvar"){
                if($id_categoria > 0){
                    $resultado = $categoria->alterar();
                } else{
                    $resultado = $categoria->inserir();
                }
            } elseif($acao == "excluir"){
                $resultado = $categoria->excluir();
            }

            header('Location: index.php');
        } catch (PDOException $e) {
            header('Location: index.php?MSG=Erro: '.$e->getMessage());
        }
    } elseif($_SERVER['REQUEST_METHOD'] == 'GET'){
        $tipo_categoria = isset($_GET['tipo_categoria']) ? $_GET['tipo_categoria'] : 0;
        $busca_categoria = isset($_GET['busca_categoria']) ? $_GET['busca_categoria'] : "";
        $lista_categoria = Categoria::listar($tipo_categoria, $busca_categoria);
    }

?>
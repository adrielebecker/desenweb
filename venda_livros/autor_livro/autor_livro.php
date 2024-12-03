<?php
    require_once("../classes/autoload.php");
    include '../config/config.inc.php';

    echo "<pre>";
        var_dump($_POST);
    echo "</pre>";

    $id_livro = isset($_GET['id_livro']) ? $_GET['id_livro'] : 0;
    if($id_livro > 0){
        $livro = Livro::listar(1, $id_livro)[0];
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id_livro = isset($_POST['id_livro']) ? $_POST['id_livro'] : 0;
        $titulo = isset($_POST['titulo']) ? $_POST['titulo'] : "";
        $ano_publicacao = isset($_POST['ano_publicacao']) ? $_POST['ano_publicacao'] : "";
        $arquivo = isset($_FILES['foto_capa']) ? $_FILES['foto_capa'] : "";
        $categoria = isset($_POST['categoria']) ? $_POST['categoria'] : 0;
        $preco = isset($_POST['preco']) ? $_POST['preco'] : "";
        $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
        $destino = "../".IMG."/".$arquivo['name'];

        try {
            $categoria = Categoria::listar(1, $categoria)[0];
            $livro = new Livro($id_livro, $titulo, $ano_publicacao, $destino, $categoria, $preco);
            $resultado = "";

            if($acao == "salvar"){
                if($id_livro > 0){
                    $resultado = $livro->alterar();
                } else{
                    $resultado = $livro->inserir();
                }
            } elseif($acao == "excluir"){
                $resultado = $livro->excluir();
            }

            move_uploaded_file($arquivo['tmp_name'], $destino);
            header('Location: index.php');
        } catch (PDOException $e) {
            header('Location: index.php?MSG=Erro: '.$e->getMessage());
        }
    } elseif($_SERVER['REQUEST_METHOD'] == 'GET'){
        $tipo_livro = isset($_GET['tipo_livro']) ? $_GET['tipo_livro'] : 0;
        $busca_livro = isset($_GET['busca_livro']) ? $_GET['busca_livro'] : "";
        $lista_livro = Livro::listar($tipo_livro, $busca_livro);
    }

?>
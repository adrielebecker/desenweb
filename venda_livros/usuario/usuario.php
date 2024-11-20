<?php
    require_once("../classes/autoload.php");

    echo "<pre>";
        var_dump($_POST);
    echo "</pre>";

    $id_usuario = isset($_GET['id_usuario']) ? $_GET['id_usuario'] : 0;
    if($id_usuario > 0){
        $usuario = Usuario::listar(1, $id_usuario)[0];
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id_usuario = isset($_POST['id_usuario']) ? $_POST['id_usuario'] : 0;
        $nome = isset($_POST['nome']) ? $_POST['nome'] : "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $senha = isset($_POST['senha']) ? $_POST['senha'] : "";
        $cpf = isset($_POST['cpf']) ? $_POST['cpf'] : "";
        $nivel_permissao = isset($_POST['nivel_permissao']) ? $_POST['nivel_permissao'] : 0;
        $acao = isset($_POST['acao']) ? $_POST['acao'] : "";

        try {
            $usuario = new Usuario($id_usuario, $nome, $email, $senha, $cpf, $nivel_permissao);
            $resultado = "";

            if($acao == "salvar"){
                if($id_usuario > 0){
                    $resultado = $usuario->alterar();
                } else{
                    $resultado = $usuario->inserir();
                }
            } elseif($acao == "excluir"){
                $resultado = $usuario->excluir();
            }

        } catch (PDOException $e) {
            header('Location: index.php?MSG=Erro: '.$e->getMessage());
        }
    } elseif($_SERVER['REQUEST_METHOD'] == 'GET'){
        $tipo_usuario = isset($_GET['tipo_usuario']) ? $_GET['tipo_usuario'] : 0;
        $busca_usuario = isset($_GET['busca_usuario']) ? $_GET['busca_usuario'] : "";
        $lista_usuario = Usuario::listar($tipo_usuario, $busca_usuario);
    }

?>
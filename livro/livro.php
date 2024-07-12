<?php
    require_once("../classes/Livro.class.php");
    require_once("../classes/Endereco.class.php");

    $id = isset($_GET['id']) ? $_GET['id'] : 0; 
    $msg = isset($_GET['MSG']) ? $_GET['MSG'] : "";
    if ($id > 0){
        $biblioteca = Livro::listar(1, $id)[0]; 
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id = isset($_POST['id']) ? $_POST['id'] : 0; 
        $autor = isset($_POST['autor']) ? $_POST['autor'] : ""; 
        $genero = isset($_POST['genero']) ? $_POST['genero'] : ""; 
        
        $usuario = isset($_POST['usuario']) ? $_POST['usuario'] : ""; 
        $senha = isset($_POST['senha']) ? $_POST['senha'] : ""; 

        $idendereco = isset($_POST['idendereco']) ? $_POST['idendereco'] : ""; 
        $cep = isset($_POST['cep']) ? $_POST['cep'] : ""; 
        $pais = isset($_POST['pais']) ? $_POST['pais'] : ""; 
        $estado = isset($_POST['estado']) ? $_POST['estado'] : ""; 
        $cidade = isset($_POST['cidade']) ? $_POST['cidade'] : ""; 
        $bairro = isset($_POST['bairro']) ? $_POST['bairro'] : ""; 
        $rua = isset($_POST['rua']) ? $_POST['rua'] : ""; 
        $numero = isset($_POST['numero']) ? $_POST['numero'] : 0; 
        $complemento = isset($_POST['complemento']) ? $_POST['complemento'] : ""; 
        $idlivro = isset($_POST['idlivro']) ? $_POST['idlivro'] : ""; 
        $acao = isset($_POST['acao']) ? $_POST['acao'] : ""; 

        try{
            $endereco = new Endereco($idendereco, $pais, $estado, $cidade, $bairro, $rua, $numero, $complemento, $idlivro);
            $login = new Login($id, $usuario, $senha);
            $livro = new Livro($id, $autor, $genero, $login, $endereco);

            $resultado = "";
        
            if($acao == 'salvar'){
                if($id > 0)
                    $resultado = $livro->alterar();
                else 
                    $resultado = $livro->incluir();
            } elseif($acao == 'excluir'){
                $resultado = $livro->excluir();
            }
        
            if ($resultado)
                header('location: index.php?MSG=Dados inseridos/Alterados com sucesso!');
            else
                header('location: index.php?MSG=Erro ao inserir/alterar registro');
        } catch(Exception $e){ 
            header('Location: index.php?MSG=Erro: '.$e->getMessage());
        }
    } elseif($_SERVER['REQUEST_METHOD'] == 'GET'){ 
        $busca = isset($_GET['busca']) ? $_GET['busca'] : 0; 
        $tipo = isset($_GET['tipo']) ? $_GET['tipo'] : 0; 
        $lista = Livro::listar($tipo, $busca); 
    }
?>
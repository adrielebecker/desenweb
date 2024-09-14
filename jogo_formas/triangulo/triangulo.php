<?php
    require_once('../classes/Triangulo.class.php');
    require_once('../classes/UnidadeMedida.class.php');
    
    $id_triangulo = isset($_GET['id_triangulo']) ? $_GET['id_triangulo'] : 0;
    if($id_triangulo > 0){
        $triangulo = Triangulo::listar(1, $id_triangulo)[0];
    }

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $id_triangulo = isset($_POST['id_triangulo']) ? $_POST['id_triangulo'] : 0;
        $ladoA = isset($_POST['ladoA']) ? $_POST['ladoA'] : 0;
        $ladoB = isset($_POST['ladoB']) ? $_POST['ladoB'] : 0;
        $ladoC = isset($_POST['ladoC']) ? $_POST['ladoC'] : 0;
        $arquivo = isset($_FILES['fundo']) ? $_FILES['fundo'] : "";
        $unidade_medida = isset($_POST['unidade_medida']) ? $_POST['unidade_medida'] : "";
        $cor = isset($_POST['cor']) ? $_POST['cor'] : "";
        $acao = isset($_POST['acao']) ? $_POST['acao'] : "";
        $destino = "../".IMG."/".$arquivo['name'];
        try {
            $unidade = UnidadeMedida::listar(1, $unidade_medida)[0];
            var_dump($unidade);
            echo "<br>";
            $triangulo = new Triangulo($id_triangulo, $ladoA, $ladoB, $ladoC, $cor, $unidade, $destino);
            if($acao == "salvar"){
                if($id_triangulo > 0){
                    $resultado = $triangulo->alterar();
                } else{
                    $resultado = $triangulo->inserir();
                }
            } elseif($acao == "excluir"){
                $resultado = $triangulo->excluir();
            }
            move_uploaded_file($arquivo['tmp_name'], $destino);
            header('Location: index.php');
        } catch (PDOException $e) {
            header('Location: index.php?MSG=Erro: '.$e->getMessage());
        }
    } elseif($_SERVER['REQUEST_METHOD'] == 'GET'){
        $tipo_triangulo = isset($_GET['tipo_triangulo']) ? $_GET['tipo_triangulo'] : 0;
        $busca_triangulo = isset($_GET['busca_triangulo']) ? $_GET['busca_triangulo'] : "";
        $lista_triangulo = Triangulo::listar($tipo_triangulo, $busca_triangulo);
    }
?>
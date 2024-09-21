<?php
    require_once('../classes/Triangulo.class.php');
    require_once('../classes/TrianguloEquilatero.class.php');
    require_once('../classes/TrianguloEscaleno.class.php');
    require_once('../classes/TrianguloIsosceles.class.php');
    require_once('../classes/UnidadeMedida.class.php');
    
    $id_triangulo = isset($_GET['id_triangulo']) ? $_GET['id_triangulo'] : 0;
    $nome = isset($_GET['nome']) ? $_GET['nome'] : "";
    if($id_triangulo > 0){
        if($nome == "Equilátero"){
            $triangulo = Equilatero::listar(1, $id_triangulo)[0];
        } elseif($nome == "Escaleno"){
            $triangulo = Escaleno::listar(1, $id_triangulo)[0];
        } elseif($nome == "Isósceles"){
            $triangulo = Isosceles::listar(1, $id_triangulo)[0];
        }
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
            if($ladoA == $ladoB && $ladoB == $ladoC){
                $triangulo = new Equilatero($id_triangulo, $ladoA, $ladoB, $ladoC, $cor, $unidade, $destino);
            } elseif(($ladoA == $ladoB && $ladoB != $ladoC) || ($ladoB == $ladoC && $ladoC != $ladoA) || ($ladoA == $ladoC && $ladoC != $ladoB)){
                $triangulo = new Isosceles($id_triangulo, $ladoA, $ladoB, $ladoC, $cor, $unidade, $destino);
            } elseif($ladoA != $ladoB && $ladoA != $ladoC && $ladoB != $ladoC){
                $triangulo = new Escaleno($id_triangulo, $ladoA, $ladoB, $ladoC, $cor, $unidade, $destino);
            } 

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
        $nome_triangulo = isset($_GET['triangulo']) ? $_GET['triangulo'] : 0;
        
        if($nome_triangulo == 1){
            $lista_triangulo = Equilatero::listar($tipo_triangulo, $busca_triangulo);
        } elseif($nome_triangulo == 2){
            $lista_triangulo = Escaleno::listar($tipo_triangulo, $busca_triangulo);
        } elseif($nome_triangulo == 3){
            $lista_triangulo = Isosceles::listar($tipo_triangulo, $busca_triangulo);
        } else{
            $lista_triangulo = Triangulo::listar($tipo_triangulo, $busca_triangulo);
        }
    }
?>
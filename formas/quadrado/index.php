<!DOCTYPE html>
<?php
    include("quadrado.php");
    include("../unidade/unidade.php");
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desenhe o seu quadrado</title>
</head>
<body>
    <?php //include "cadastro.php";?>
    <fieldset>
        <legend>Informações sobre o quadrado</legend>
        <form action="quadrado.php" method="post">
            <label for="id_quadrado">Id:</label>
            <input type="text" name="id_quadrado" id="id_quadrado" 
                    value="<?=isset($quadrado) ? $quadrado->getIdQuadrado(): 0 ?>" readonly><br>

            <label for="unidadeMedida">Unidade de Medida:</label>
            <select name="unidadeMedida" id="unidadeMedida">
                <option value="0">Selecione uma opção</option>
                <?php  
                    // echo "<option value='0'>Selecione uma opção</option>";
                    foreach($lista_unidade as $unidade){
                        $str = "<option value='{$unidade->getIdUnidadeMedida()}";
                        if(isset($lista_quadrado)){
                            foreach($lista_quadrado as $quadrado){
                                if($quadrado->getUnidadeMedida()->getIdUnidadeMedida() == $unidade->getIdUnidadeMedida()){
                                    $str .= "selected";
                                }
                            }
                            // echo "<pre>";
                            // var_dump($lista_quadrado);
                            // echo "<br>";
                            // echo "<pre>";
                            // var_dump($unidade);
                            // echo "<br>";
                        }
                        $str .= "'>{$unidade->getDescricao()}</option>";
                        echo $str;
                    }      
                    // var_dump($lista_quadrado);
                ?>
            </select>

            <label for="lado">Lado:</label>
            <input type="text" name="lado" id="lado" value="<?php if(isset($quadrado)) echo $quadrado->getLado()?>">

            <label for="cor">Cor:</label>
            <input type="color" name="cor" id="cor" value="<?php if(isset($quadrado)) echo $quadrado->getCor()?>">

            <button type="submit" name="acao" id="acao" value="salvar">Salvar</button>
            <button type="submit" name="acao" id="acao" value="excluir">Excluir</button>
        </form>
    </fieldset>
    <hr>
    <form action="" method="get">
        <fieldset>
            <legend>Pesquisa</legend>
            <label for="busca">Busca:</label>
            <input type="text" name="busca" id="busca" value="">
            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo">
                <option value="0">Escolha</option>
                <option value="1">Id</option>
                <option value="2">Cor</option>
                <option value="3">Lado</option>
                <option value="4">Unidade de Medida</option>
            </select>
        <button type='submit'>Buscar</button>

        </fieldset>
    </form>
    <hr>
    <h1>Lista meus quadrados</h1>
    <table border=1>
        <tr>
            <th>Id</th>
            <th>Lado</th>
            <th>Cor</th>
            <th>Unidade de Medida</th>
            <th>Quadrado</th>
        </tr>
        <?php  
            foreach($lista_quadrado as $quadrado){
                // echo "<pre>";
                // var_dump($quadrado);
                echo "<tr>
                    <td><a href='index.php?id=".$quadrado->getIdQuadrado()."'>".$quadrado->getIdQuadrado()."</a></td>
                    <td>".$quadrado->getLado()."</td>
                    <td>".$quadrado->getCor()."</td>
                    <td>".$quadrado->getUnidadeMedida()->getIdUnidadeMedida()."</td>
                    <td>".$quadrado->desenharQuadrado()."</td>
                </tr>";
            }     
        ?>
    </table>
</body>
</html>
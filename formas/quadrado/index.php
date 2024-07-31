<!DOCTYPE html>
<?php
    include("quadrado.php");
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Desenhe seu quadrado</title>
</head>
<body>
    <h3><?=$msg?></h3>
    <fieldset>
        <legend>Informações sobre o quadrado</legend>
        <form action="quadrado.php" method="post">
            <label for="id">Id:</label>
            <input type="text" name="id" id="id" value="<?=isset($quadrado) ? $quadrado->getId(): 0 ?>" readonly>

            <label for="unidadeMedida">Unidade de Medida:</label>
            <input type="text" name="unidadeMedida" id="unidadeMedida" placeholder="porcentagem, cm e px" value="<?php if(isset($quadrado)) echo $quadrado->getUnidadeMedida()?>">

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
                <option value="3">Unidade de Medida</option>
            </select>
        <button type='submit'>Buscar</button>

        </fieldset>
    </form>
    <hr>
    <h1>Lista meus quadrados</h1>
    <table border=1>
        <tr>
            <th>Id</th>
            <th>Cor</th>
            <th>Lado</th>
            <th>Unidade de Medida</th>
        </tr>
        <?php  
            foreach($lista as $quadrado){
                echo "<tr><td><a href='index.php?id=".$quadrado->getId()."'>".$quadrado->getId()."</a></td><td>".$quadrado->getCor()."</td><td>".$quadrado->getUnidadeMedida()."</td><td>".$quadrado->getLado()."</td></tr>";
            }     
        ?>
    </table>
</body>
</html>
<!DOCTYPE html>
<?php
    include("unidade.php");
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escolha a unidade de medida</title>
</head>
<body>
    <h3><?=$msg?></h3>
    <fieldset>
        <legend>Informações sobre a unidade de medida</legend>
        <form action="unidade.php" method="post">
            <label for="id_unidadeMedida">Id:</label>
            <input type="text" name="id_unidadeMedida" id="id_unidadeMedida" value="<?=isset($unidade) ? $unidade->getIdUnidadeMedida(): 0 ?>" readonly>

            <label for="descricao">Descrição:</label>
            <input type="text" name="descricao" id="descricao" placeholder="porcentagem, cm e px" value="<?php if(isset($unidade)) echo $unidade->getDescricao()?>">

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
                <option value="2">Descrição</option>
            </select>
        <button type='submit'>Buscar</button>

        </fieldset>
    </form>
    <hr>
    <h1>Lista as unidades</h1>
    <table border=1>
        <tr>
            <th>Id</th>
            <th>Descrição</th>
        </tr>
        <?php  
            foreach($lista_unidade as $unidade){
                echo "<tr><td><a href='index.php?id=".$unidade->getIdUnidadeMedida()."'>".$unidade->getIdUnidadeMedida()."</a></td><td>".$unidade->getDescricao()."</td>";
            }     
        ?>
    </table>
</body>
</html>
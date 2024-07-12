<?php 
    require_once('../login/validalogin.php');
    include_once('livro.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de livros</title>
</head>
<body>
    <h1>CRUD de Livros</h1>
    <h3><?=$msg?></h3>

    <fieldset>
        <legend>CRUD livros</legend>
        <form action="livro.php" method="post">
            <fieldset>
                <legend>Cadastro de Livros</legend>        
                    <label for="id">Id:</label>
                    <input type="text" name="id" id="id" value="<?=isset($biblioteca) ? $biblioteca->getId(): 0 ?>" readonly>
                    
                    <label for="autor">Autor:</label>
                    <input type="text" name="autor" id="autor" value="<?php if(isset($biblioteca)) echo $biblioteca->getAutor()?>">
                    
                    <label for="genero">Gênero:</label>
                    <input type="text" name="genero" id="genero" value="<?php if(isset($biblioteca)) echo $biblioteca->getGenero()?>">
                    
                    <label for="usuario">Usuário:</label>
                    <input type="email" placeholder="Informe um email" name="usuario" id="usuario" value="<?php if(isset($biblioteca)) echo $biblioteca->getLogin()->getUsuario()?>">
                    
                    <label for="senha">Senha:</label>
                    <input type="password" name="senha" id="senha" value="<?php if(isset($biblioteca)) echo $biblioteca->getLogin()->getSenha()?>">
            </fieldset>
    
            <fieldset>
                <legend>Cadastro de endereço</legend>
    
                <label for="id">Id Endereço:</label>
                <input type="text" name="idendereco" id="idendereco" value="<?= isset($biblioteca) ? $biblioteca->getEndereco()->getIdEndereco() : 0?>" readonly >
    
                <label for="cep">CEP:</label>
                <input type="text" name="cep" id="cep" value="<?php if(isset($biblioteca)) echo $biblioteca->getEndereco()->getCep()?>">
                
                <label for="pais">País:</label>
                <input type="text" name="pais" id="pais" value="<?php if(isset($biblioteca)) echo $biblioteca->getEndereco()->getPais()?>">
                
                <label for="estado">Estado:</label>
                <input type="text" name="estado" id="estado" value="<?php if(isset($biblioteca)) echo $biblioteca->getEndereco()->getEstado()?>">
                
                <label for="cidade">Cidade:</label>
                <input type="text" name="cidade" id="cidade" value="<?php if(isset($biblioteca)) echo $biblioteca->getEndereco()->getCidade()?>"> <br><br>
    
                <label for="bairro">Bairro:</label>
                <input type="text" name="bairro" id="bairro" value="<?php if(isset($biblioteca)) echo $biblioteca->getEndereco()->getBairro()?>">
    
                <label for="rua">Rua:</label>
                <input type="text" name="rua" id="rua" value="<?php if(isset($biblioteca)) echo $biblioteca->getEndereco()->getRua()?>">
    
                <label for="numero">Número:</label>
                <input type="text" name="numero" id="numero" value="<?php if(isset($biblioteca)) echo $biblioteca->getEndereco()->getNumero()?>">
    
                <label for="complemento">Complemento:</label>
                <input type="text" name="complemento" id="complemento" value="<?php if(isset($biblioteca)) echo $biblioteca->getEndereco()->getComplemento()?>">
                
                <button type="submit" name="acao" id="acao" value="salvar">Salvar</button>
                <button type="submit" name="acao" id="acao" value="excluir">Excluir</button>
                <button type="reset" value="cancelar">Cancelar</button>
            </fieldset>
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
                <option value="2">Autor</option>
                <option value="3">Gênero</option>
            </select>
        <button type='submit'>Buscar</button>

        </fieldset>
    </form>
    <hr>
    <h1>Lista meus livros</h1>
    <table border=1>
        <tr>
            <th>Id</th>
            <th>Autor</th>
            <th>Gênero</th>
            <th>Usuário</th>
            <th>País</th>
            <th>Estado</th>
            <th>Cidade</th>
            <th>Rua</th>
            <th>Complemento</th>
            <th>Número</th>
            <th>CEP</th>
        </tr>
        <?php  
            foreach($lista as $livro){
                var_dump($livro->getLogin()->getUsuario());
                echo "<tr><td><a href='index.php?id=".$livro->getId()."'>".$livro->getId()."</a></td><td>".$livro->getAutor()."</td><td>".$livro->getGenero()."</td><td>".$livro->getLogin()->getUsuario()."</td><td>".$livro->getEndereco()->getPais()."</td><td>".$livro->getEndereco()->getEstado()."</td><td>".$livro->getEndereco()->getCidade()."</td><td>".$livro->getEndereco()->getRua()."</td><td>".$livro->getEndereco()->getComplemento()."</td><td>".$livro->getEndereco()->getNumero()."</td><td>".$livro->getEndereco()->getCep()."</td></tr>";
            }     
        ?>
    </table>
</body>
</html>
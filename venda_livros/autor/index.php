<!DOCTYPE html>
<?php
    include 'autor.php';
    require_once("../classes/autoload.php");
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Cadastro de Autores</title>
</head>
<body>
    <div class="container-sm mt-5">
        <h4 class="text-center">Cadastro de Autores</h4>
        <form action="autor.php" method="post">
            <input type="hidden" name="id_autor" id="id_autor" value="<?=isset($autor) ? $autor->getIdAutor() : 0?>">
            <div class="row">
                <div class="col-4">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="<?=isset($autor) ? $autor->getNome() : ""?>">
                </div>
                <div class="col-4">
                    <label for="sobrenome" class="form-label">Sobrenome:</label>
                    <input type="text" name="sobrenome" id="sobrenome" class="form-control" value="<?=isset($autor) ? $autor->getSobrenome() : ""?>">
                </div>
                <div class="col-1 mt-4">
                    <button type="submit" class="btn btn-success mt-2" name="acao" id="acao" value="salvar">Salvar</button>
                </div>
                <div class="col-1 mt-4">
                    <button class="btn btn-danger mt-2" name="acao" id="acao" value="excluir">Excluir</button>
                </div>
            </div>
        </form>
    </div>

    <fieldset class="container mt-5 text-center border rounded pt-2 pb-3">
        <legend>Buscar:</legend>
        <form action="" method="get">
            <div class="row">
                <div class="col-3"></div>
                <div class="col-3">
                    <label for="tipo_autor" class="form-label">Tipo:</label>
                    <select name="tipo_autor" id="tipo_autor" class="form-select">
                        <option value="0">Selecione</option>
                        <option value="1">Id Autor</option>
                        <option value="2">Nome</option>
                        <option value="3">Sobrenome</option>
                    </select>
                </div>
                <div class="col-3">
                    <label for="busca_autor" class="form-label">Busca autor:</label>
                    <input type="text" name="busca_autor" id="busca_autor" class="form-control">
                </div>
                <div class="col-1 mt-4">
                    <button type="submit" class="btn btn-outline-success mt-2">Buscar</button>
                </div>
            </div>
        </form>
    </fieldset>

    <div class="container mt-5 text-center">
        <table class="table table-hover border align-middle table-bordered">
            <tr class="table-dark">
                <th>Id</th>
                <th>Nome</th>
                <th>Sobrenome</th>
                <th>Alterar</th>
            </tr>    
    
            <?php
                foreach($lista_autor as $autor){
                    echo "<tr>
                        <td>{$autor->getIdAutor()}</td>
                        <td>{$autor->getNome()}</td>
                        <td>{$autor->getSobrenome()}</td>
                        <td><a href='index.php?id_autor={$autor->getIdAutor()}'>Alterar</a></td>
                    </tr>";
                }
            ?>
        </table>
    </div>
</body>
</html>
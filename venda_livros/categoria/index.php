<!DOCTYPE html>
<?php
    include 'categoria.php';
    require_once("../classes/autoload.php");
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Cadastro de Categorias</title>
</head>
<body>
    <div class="container-sm mt-5">
        <h4 class="text-center">Cadastro de Categorias</h4>
        <form action="categoria.php" method="post">
            <input type="hidden" name="id_categoria" id="id_categoria" value="<?=isset($categoria) ? $categoria->getIdCategoria() : 0?>">
            <div class="row">
                <div class="col-4">
                    <label for="descricao" class="form-label">Descrição:</label>
                    <input type="text" name="descricao" id="descricao" class="form-control" value="<?=isset($categoria) ? $categoria->getDescricao() : ""?>">
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
                    <label for="tipo_categoria" class="form-label">Tipo:</label>
                    <select name="tipo_categoria" id="tipo_categoria" class="form-select">
                        <option value="0">Selecione</option>
                        <option value="1">Id</option>
                        <option value="2">Descrição</option>
                    </select>
                </div>
                <div class="col-3">
                    <label for="busca_categoria" class="form-label">Busca categoria:</label>
                    <input type="text" name="busca_categoria" id="busca_categoria" class="form-control">
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
                <th>Descrição</th>
                <th>Alterar</th>
            </tr>    
    
            <?php
                foreach($lista_categoria as $categoria){
                    echo "<tr>
                        <td>{$categoria->getIdCategoria()}</td>
                        <td>{$categoria->getDescricao()}</td>
                        <td><a href='index.php?id_categoria={$categoria->getIdCategoria()}'>Alterar</a></td>
                    </tr>";
                }
            ?>
        </table>
    </div>
</body>
</html>

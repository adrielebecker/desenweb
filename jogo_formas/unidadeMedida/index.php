<!DOCTYPE html>
<?php
    include "unidadeMedida.php";
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Cadastro de Unidades</title>
</head>
<body>
    <fieldset class="container border rounded mt-3 pt-2 pb-3 text-center">
        <legend>Cadastro de Unidades de Medida</legend>
        <form action="unidadeMedida.php" method="post">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-3">
                    <label for="id_unidadeMedida" class="form-label">Id Unidade de Medida:</label>
                    <input type="text" name="id_unidadeMedida" id="id_unidadeMedida" value="<?=isset($unidade) ? $unidade->getIdUnidadeMedida() : 0 ?>" class="form-control" readonly>
                </div>
                <div class="col-3">
                    <label for="descricao" class="form-label">Descrição:</label>
                    <input type="text" name="descricao" id="descricao" class="form-control" value="<?=isset($unidade) ? $unidade->getDescricao() : "" ?>">
                </div>
                <div class="col-1 mt-4">
                    <button name="acao" id="acao" value="salvar" class="btn btn-success mt-2">Salvar</button>
                </div>
                <div class="col-1 mt-4">
                    <button name="acao" id="acao" value="excluir" class="btn btn-danger mt-2">Excluir</button>
                </div>
            </div>
        </form>
    </fieldset>

    <fieldset class="container mt-5 text-center border rounded pt-2 pb-3">
        <legend>Buscar por:</legend>
        <form action="" method="get">
            <div class="row">
                <div class="col-2"></div>
                <div class="col-3">
                    <label for="tipo_unidade" class="form-label">Tipo:</label>
                    <select name="tipo_unidade" id="tipo_unidade" class="form-select">
                        <option value="0">Selecione uma opção</option>
                        <option value="1">Id Unidade de Medida</option>
                        <option value="2">Descrição</option>
                    </select>
                </div>
                <div class="col-3">
                    <label for="busca_unidade" class="form-label">Buscar unidade de medida:</label>
                    <input type="text" name="busca_unidade" id="busca_unidade" class="form-control">
                </div>
                <div class="col-1 mt-4">
                    <button type="submit" class="btn btn-outline-success mt-2">Buscar</button>
                </div>
            </div>
        </form>
    </fieldset>

    <div class="container mt-5 text-center">
        <table class="table table-striped border rounded table-bordered table-hover">
            <tr class="table-dark">
                <th>Id Unidade de Medida</th>
                <th>Descrição</th>
            </tr>
            <?php
                foreach($lista_unidade as $unidade){
                    echo "<tr>
                        <td><a href='index.php?id_unidadeMedida={$unidade->getIdUnidadeMedida()}'>{$unidade->getIdUnidadeMedida()}</a></td>
                        <td>{$unidade->getDescricao()}</td>
                    </tr>";
                }
            ?>
        </table>
    </div>
</body>
</html>
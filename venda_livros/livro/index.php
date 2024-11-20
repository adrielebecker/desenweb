<!DOCTYPE html>
<?php
    include 'livro.php';
    require_once("../classes/autoload.php");
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Cadastro de Livros</title>
</head>
<body>
    <div class="container-sm mt-5">
        <h4 class="text-center">Cadastro de Livros</h4>
        <form action="livro.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="id_livro" id="id_livro" value="<?=isset($livro) ? $livro->getIdLivro() : 0?>">
            <div class="row">
                <div class="col-4">
                    <label for="titulo" class="form-label">Titulo:</label>
                    <input type="text" name="titulo" id="titulo" class="form-control" value="<?=isset($livro) ? $livro->getTitulo() : ""?>">
                </div>
                <div class="col-2">
                    <label for="ano_publicacao" class="form-label">Ano de Publicação:</label>
                    <input type="date" name="ano_publicacao" id="ano_publicacao" class="form-control" 
                        value="<?=isset($livro) ? date('Y-m-d', strtotime($livro->getAnoPublicacao())) : ""?>">
                </div>
                <div class="col-5">
                    <label for="foto_capa" class="form-label">Foto da Capa:</label>
                    <input type="file" name="foto_capa" id="foto_capa" class="form-control" value="<?=isset($livro) ? $livro->getFotoCapa() : ""?>">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-3">
                    <label for="categoria" class="form-label">Categoria:</label>
                    <select name="categoria" id="categoria" class="form-select">
                        <option value="0">Selecione uma opção</option>
                    <?php
                       $categorias = Categoria::listar();
                       foreach($categorias as $categoria){ 
                           $str = "<option value='{$categoria->getIdCategoria()}' ";
                           if(isset($livro)) 
                               if ($livro->getCategoria()->getIdCategoria() == $categoria->getIdCategoria()) 
                                   $str .= " selected ";
                           $str .= ">{$categoria->getDescricao()}</option>";
                           echo $str;
                       } 
                    ?>                
                    </select> 
                </div>

                <div class="col-3">
                    <label for="preco" class="form-label">Preço:</label>
                    <input type="text" name="preco" id="preco" class="form-control" value="<?=isset($livro) ? $livro->getPreco() : ""?>">
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
                    <label for="tipo_livro" class="form-label">Tipo:</label>
                    <select name="tipo_livro" id="tipo_livro" class="form-select">
                        <option value="0">Selecione</option>
                        <option value="1">Id </option>
                        <option value="2">Titulo</option>
                        <option value="3">Categoria</option>
                        <option value="4">Preço</option>
                    </select>
                </div>
                <div class="col-3">
                    <label for="busca_livro" class="form-label">Busca Livro:</label>
                    <input type="text" name="busca_livro" id="busca_livro" class="form-control">
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
                <th>Titulo</th>
                <th>Categoria</th>
                <th>Preço</th>
                <th>Imagem da Capa</th>
                <th>Alterar</th>
            </tr>    
            <?php
                foreach($lista_livro as $livro){
                    echo "<tr>
                        <td>{$livro->getIdLivro()}</td>
                        <td>{$livro->getTitulo()}</td>
                        <td>".($livro->getCategoria() ? $livro->getCategoria()->getDescricao() : 'Sem Categoria')."</td>
                        <td>{$livro->getPreco()}</td>
                        <td><img src='{$livro->getFotoCapa()}' width='125'></td>
                        <td><a href='index.php?id_livro={$livro->getIdLivro()}'>Alterar</a></td>
                    </tr>";
                }
            ?>
        </table>
    </div>
</body>
</html>
<!DOCTYPE html>
<?php
    include "triangulo.php";  
    include "../unidadeMedida/unidadeMedida.php";
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Cadastro de triângulos</title>
</head>
<body>
    <fieldset class="container border rounded mt-5 pt-2 pb-3 text-center">
        <legend>Cadastro de triângulo</legend>
        <form action="triangulo.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-2">
                    <label for="id_triangulo" class="form-label">Id Triângulo:</label>                        
                    <input type="text" name="id_triangulo" id="id_triangulo" value="<?=isset($triangulo) ? $triangulo->getId() : 0?>" class="form-control">
                </div>
                
                <div class="col-2">
                    <label for="ladoA" class="form-label">Lado A:</label>                        
                    <input type="text" name="ladoA" id="ladoA" value="<?php if(isset($triangulo)) echo $triangulo->getLadoA()?>" class="form-control">
                </div>

                <div class="col-2">
                    <label for="ladoB" class="form-label">Lado B:</label>                        
                    <input type="text" name="ladoB" id="ladoB" value="<?php if(isset($triangulo)) echo $triangulo->getLadoB()?>" class="form-control">
                </div>
                
                <div class="col-2">
                    <label for="ladoC" class="form-label">Lado C:</label>                        
                    <input type="text" name="ladoC" id="ladoC" value="<?php if(isset($triangulo)) echo $triangulo->getLadoC()?>" class="form-control">
                </div>

                <div class="col-4">
                    <label for="fundo" class="form-label">Imagem de Fundo</label>
                    <input type="file" name="fundo" id="fundo" value="<?php if(isset($triangulo)) echo $triangulo->getFundo()?>" class="form-control">
                </div>
            </div>

            <div class="row mt-4tt">
                <div class="col-1">
                    <label for="cor" class="form-label">Cor:</label>
                    <input type="color" name="cor" id="cor" class="form-control-color" value="<?php if(isset($triangulo)) echo $triangulo->getCor()?>">
                </div>

                <div class="col-3">
                    <label for="unidade_medida" class="form-label">Unidade de Medida:</label>   
                    <select name="unidade_medida" id="unidade_medida" class="form-select">
                        <option value="0">Selecione uma opção</option>
                        <?php
                            foreach($lista_unidade as $unidade){
                                $str = "<option value='{$unidade->getIdUnidadeMedida()}'";
                                if(isset($triangulo)){
                                    if($triangulo->getUnidadeMedida()->getIdUnidadeMedida() == $unidade->getIdUnidadeMedida()){
                                        $str .= " selected";
                                    }
                                }
                                $str .= ">{$unidade->getDescricao()}</option>";
                                echo $str;
                            }        
                        ?>                
                    </select>
                </div>
                <div class="col-1 mt-2">
                    <button type="submit" name="acao" id="acao" value="salvar" class="btn btn-success mt-4">Salvar</button>
                </div>
                <div class="col-1 mt-2">
                    <button type="submit" name="acao" id="acao" value="excluir" class="btn btn-danger mt-4">Excluir</button>
                </div>
            </div>
        </form>
    </fieldset>

    <fieldset class="container mt-5 text-center border rounded pt-2 pb-3">
        <legend>Buscar:</legend>
        <form action="" method="get">
            <div class="row">
                <div class="col-1"></div>
                <div class="col-3">
                    <label for="triangulo" class="form-label">Tipo do Triângulo</label>
                    <select name="triangulo" id="triangulo" class="form-select">
                        <option value="0">Selecione</option>
                        <option value="1">Equilátero</option>
                        <option value="2">Escaleno</option>
                        <option value="3">Isósceles</option>
                    </select>
                </div>
                <div class="col-3">
                    <label for="tipo_triangulo" class="form-label">Burcar por:</label>
                    <select name="tipo_triangulo" id="tipo_triangulo" class="form-select">
                        <option value="0">Selecione</option>
                        <option value="1">Id Quadrado</option>
                        <option value="2">LadoA</option>
                        <option value="3">LadoB</option>
                        <option value="4">LadoC</option>
                    </select>
                </div>
                <div class="col-3">
                    <label for="busca_triangulo" class="form-label">Busca quadrado:</label>
                    <input type="text" name="busca_triangulo" id="busca_triangulo" class="form-control">
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
                <th>Cor</th>
                <th>Unidade de Medida</th>
                <th>Lado A</th>
                <th>Lado B</th>
                <th>Lado C</th>
                <th>Tipo de Triângulo</th>
                <th>Alterar</th>
                <th>Detalhes</th>
            </tr>    
    
            <?php
                foreach($lista_triangulo as $triangulo){
                    echo "<tr>
                        <td>{$triangulo->getId()}</td>
                        <td>{$triangulo->getCor()}</td>
                        <td>{$triangulo->getUnidadeMedida()->getDescricao()}</td>
                        <td>{$triangulo->getLadoA()}</td>
                        <td>{$triangulo->getLadoB()}</td>
                        <td>{$triangulo->getLadoC()}</td>
                        <td>{$triangulo->nome()}</td>
                        <td><a href='index.php?id_triangulo={$triangulo->getId()}&triangulo={$triangulo->nome()}'>Alterar</a></td>
                        <td><a href='detalhes.php?id_triangulo={$triangulo->getId()}&triangulo={$triangulo->nome()}'>Detalhes</a></td>
                    </tr>";
                }
            ?>
        </table>
    </div>
</body>
</html>
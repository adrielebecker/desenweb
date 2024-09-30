<!DOCTYPE html>
<?php
    include "circulo.php";
    include "../unidadeMedida/unidadeMedida.php";
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Cadastro de círculos</title>
</head>
<body>
    <fieldset class="container border rounded mt-5 pt-2 pb-3 text-center">
        <legend>Cadastro de círculos</legend>
        <form action="circulo.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-1">
                    <label for="id_circulo" class="form-label">Id Círculo:</label>                        
                    <input type="text" name="id_circulo" id="id_circulo" value="<?=isset($circulo) ? $circulo->getId() : 0?>" class="form-control">
                </div>
                
                <div class="col-1">
                    <label for="cor" class="form-label">Cor:</label>                        
                    <input type="color" name="cor" id="cor" value="<?php if(isset($circulo)) echo $circulo->getCor()?>" class="form-control-color ms-2">
                </div>

                <div class="col-1">
                    <label for="raio" class="form-label">Raio:</label>                        
                    <input type="text" name="raio" id="raio" value="<?php if(isset($circulo)) echo $circulo->getRaio()?>" class="form-control">
                </div>
                
                <div class="col-3">
                    <label for="unidade_medida" class="form-label">Unidade de Medida:</label>   
                    <select name="unidade_medida" id="unidade_medida" class="form-select">
                        <option value="0">Selecione uma opção</option>
                    <?php
                        foreach($lista_unidade as $unidade){
                            $str = "<option value='{$unidade->getIdUnidadeMedida()}'";
                            if(isset($circulo)){
                                if($circulo->getUnidadeMedida()->getIdUnidadeMedida() == $unidade->getIdUnidadeMedida()){
                                    $str .= " selected";
                                }
                            }
                            $str .= ">{$unidade->getDescricao()}</option>";
                            echo $str;
                        }      
                    ?>                
                    </select>  
                </div>
                <div class="col-4">
                    <label for="fundo" class="form-label">Imagem de Fundo</label>
                    <input type="file" name="fundo" id="fundo" value="<?php if(isset($circulo)) echo $circulo->getFundo()?>" class="form-control">
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
                <div class="col-3"></div>
                <div class="col-3">
                    <label for="tipo_circulo" class="form-label">Tipo:</label>
                    <select name="tipo_circulo" id="tipo_circulo" class="form-select">
                        <option value="0">Selecione</option>
                        <option value="1">Id</option>
                        <option value="2">Raio</option>
                        <option value="3">Cor</option>
                    </select>
                </div>
                <div class="col-3">
                    <label for="busca_circulo" class="form-label">Busca círculo:</label>
                    <input type="text" name="busca_circulo" id="busca_circulo" class="form-control">
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
                <th>Raio</th>
                <th>Unidade </th>
                <th>Cor</th>
                <th>Área</th>
                <th>Perímetro</th>
                <th>Desenho do círculo</th>
                <th>Alterar</th>
            </tr>    
    
            <?php
                foreach($lista_circulo as $circulo){
                    echo "<tr>
                        <td>{$circulo->getId()}</td>
                        <td>{$circulo->getRaio()}</td>
                        <td>{$circulo->getUnidadeMedida()->getDescricao()}</td>
                        <td>{$circulo->getCor()}</td>
                        <td>{$circulo->calcularArea()}</td>
                        <td>{$circulo->calcularPerimetro()}</td>
                        <td>{$circulo->desenhar()}</td>
                        <td><a href='index.php?id_circulo={$circulo->getId()}'>Alterar</a></td>
                    </tr>";
                }
            ?>
        </table>
    </div>
</body>
</html>
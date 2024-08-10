<!DOCTYPE html>
<?php
    include "quadrado.php";
    include "../unidadeMedida/unidadeMedida.php";
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Cadastro de quadrados</title>
</head>
<body>
    <fieldset class="container border rounded mt-5 pt-2 pb-3 text-center">
        <legend>Cadastro de quadrado</legend>
        <form action="quadrado.php" method="post">
            <div class="row">
                <div class="col-3">
                    <label for="id_quadrado" class="form-label">Id quadrado:</label>                        
                    <input type="text" name="id_quadrado" id="id_quadrado" value="<?=isset($quadrado) ? $quadrado->getIdQuadrado() : 0?>" class="form-control">
                </div>
                
                <div class="col-1">
                    <label for="cor" class="form-label">Cor:</label>                        
                    <input type="color" name="cor" id="cor" value="<?php if(isset($quadrado)) echo $quadrado->getCor()?>" class="form-control form-control-color ms-2">
                </div>

                <div class="col-3">
                    <label for="lado" class="form-label">Lado:</label>                        
                    <input type="text" name="lado" id="lado" value="<?php if(isset($quadrado)) echo $quadrado->getLado()?>" class="form-control">
                </div>
                
                <div class="col-3">
                    <label for="unidade_medida" class="form-label">Unidade de Medida:</label>   
                    <select name="unidade_medida" id="unidade_medida" class="form-select">
                        <option value="0">Selecione uma opção</option>
                    <?php
                        foreach($lista_unidade as $unidade){
                            $str = "<option value='{$unidade->getIdUnidadeMedida()}'";
                            if(isset($quadrado)){
                                if($quadrado->getUnidadeMedida()->getIdUnidadeMedida() == $unidade->getIdUnidadeMedida()){
                                    $str .= "selected";
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
                <div class="col-3"></div>
                <div class="col-3">
                    <label for="tipo_quadrado" class="form-label">Tipo:</label>
                    <select name="tipo_quadrado" id="tipo_quadrado" class="form-select">
                        <option value="0">Selecione</option>
                        <option value="1">Id Quadrado</option>
                        <option value="2">Lado</option>
                        <option value="3">Cor</option>
                    </select>
                </div>
                <div class="col-3">
                    <label for="busca_quadrado" class="form-label">Busca quadrado:</label>
                    <input type="text" name="busca_quadrado" id="busca_quadrado" class="form-control">
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
                <th>Id Quadrado</th>
                <th>Lado</th>
                <th>Cor</th>
                <th>Unidade de Medida</th>
                <th>Desenho do quadrado</th>
                <th>Alterar</th>
            </tr>    
    
            <?php
                foreach($lista_quadrado as $quadrado){
                    echo "<tr>
                        <td>{$quadrado->getIdQuadrado()}</td>
                        <td>{$quadrado->getLado()}</td>
                        <td>{$quadrado->getCor()}</td>
                        <td>{$quadrado->getUnidadeMedida()->getDescricao()}</td>
                        <td class=''>{$quadrado->DesenharQuadrado()}</td>
                        <td><a href='index.php?id_quadrado={$quadrado->getIdQuadrado()}'>Alterar</a></td>
                    </tr>";
                }
            ?>
        </table>
    </div>
</body>
</html>
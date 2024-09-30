<!DOCTYPE html>
<?php
    include_once("triangulo.php");
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Detalhes</title>
</head>
<body>
    <div class="container mt-5 text-center">
        <table class="table table-hover border align-middle table-bordered">
            <tr class="table-dark">
                <th>Id</th>
                <th>Área</th>
                <th>Perímetro</th>
                <th>Desenho</th>
            </tr>    
            
            <?php
                foreach($lista_triangulo as $triangulo){
                    if($triangulo->getId() == $id_triangulo){
                        echo "<tr>
                            <td>{$triangulo->getId()}</td>
                            <td>{$triangulo->calcularArea()}</td>
                            <td>{$triangulo->calcularPerimetro()}</td>
                            <td>{$triangulo->desenhar()}</td>
                        </tr>";
                    }
                }
            ?>
        </table>
    </div>
</body>
</html>
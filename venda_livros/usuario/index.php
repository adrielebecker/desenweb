<!DOCTYPE html>
<?php
    include 'usuario.php';
    require_once("../classes/autoload.php");
?>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <title>Cadastro de Usuários</title>
</head>
<body>
    <div class="container-sm mt-5">
        <h4 class="text-center">Cadastro de Usuários</h4>
        <form action="usuario.php" method="post">
            <input type="hidden" name="id_usuario" id="id_usuario" value="<?=isset($usuario) ? $usuario->getIdUsuario() : 0?>">
            <div class="row">
                <div class="col-4">
                    <label for="nome" class="form-label">Nome:</label>
                    <input type="text" name="nome" id="nome" class="form-control" value="<?=isset($usuario) ? $usuario->getNome() : ""?>">
                </div>
                <div class="col-4">
                    <label for="email" class="form-label">E-mail:</label>
                    <input type="text" name="email" id="email" class="form-control" value="<?=isset($usuario) ? $usuario->getEmail() : ""?>">
                </div>
                <div class="col-4">
                    <label for="cpf" class="form-label">CPF:</label>
                    <input type="text" name="cpf" id="cpf" class="form-control" value="<?=isset($usuario) ? $usuario->getCpf() : ""?>">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-4">
                    <label for="senha" class="form-label">Senha:</label>
                    <input type="text" name="senha" id="senha" class="form-control" value="<?=isset($usuario) ? $usuario->getSenha() : ""?>">
                </div>
                <div class="col-4">
                    <label for="nivel_permissao" class="form-label">Nível de Permissão:</label>
                    <select name="nivel_permissao" id="nivel_permissao" class="form-select text-center">
                        <option value="0"<?php if(isset($usuario)){if($usuario->getNivelPermissao() == 0) echo "selected"; else echo "";}?>>Selecione uma opção</option>
                        <option value="1"<?php if(isset($usuario)){if($usuario->getNivelPermissao() == 1) echo "selected"; else echo "";}?>>Cliente</option>
                        <option value="2"<?php if(isset($usuario)){if($usuario->getNivelPermissao() == 2) echo "selected"; else echo "";}?>>Administrador</option>
                    </select>
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
                    <label for="tipo_usuario" class="form-label">Tipo:</label>
                    <select name="tipo_usuario" id="tipo_usuario" class="form-select">
                        <option value="0">Selecione</option>
                        <option value="1">Id Usuário</option>
                        <option value="2">Nível de Permissão</option>
                        <option value="3">Nome</option>
                    </select>
                </div>
                <div class="col-3">
                    <label for="busca_usuario" class="form-label">Busca usuário:</label>
                    <input type="text" name="busca_usuario" id="busca_usuario" class="form-control">
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
                <th>E-mail</th>
                <th>CPF</th>
                <th>Nível de Permissão</th>
                <th>Alterar</th>
            </tr>    
    
            <?php
                foreach($lista_usuario as $usuario){
                    echo "<tr>
                        <td>{$usuario->getIdUsuario()}</td>
                        <td>{$usuario->getNome()}</td>
                        <td>{$usuario->getEmail()}</td>
                        <td>{$usuario->getCpf()}</td>
                        <td>{$usuario->getNivelPermissao()}</td>
                        <td><a href='index.php?id_usuario={$usuario->getIdUsuario()}'>Alterar</a></td>
                    </tr>";
                }
            ?>
        </table>
    </div>
</body>
</html>
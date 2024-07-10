<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Login</title>
</head>
<body>
    <form action="login.php" method="POST">
        <fieldset>
            <label for="usuario">Usuário:</label> <br>
            <input type="text" name="usuario" id="usuario"> <br>
            
            <label for="senha">Senha</label> <br>
            <input type="password" name="senha" id="senha"><br>
            <button type="submit">Enviar</button>
        </fieldset>
    </form>
</body>
</html>
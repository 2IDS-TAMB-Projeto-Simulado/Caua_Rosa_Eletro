<?php
session_start();

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">       
        <title>Cadastro de Eletronicos</title>
    </head>
    <body>
        <h1>Cadastro de Eletronicos</h1>
        <form action="./../controller/controller_eletronicos.php" method="POST">

            <label>Nome:</label>
            <br>
            <input type="text" id="nome" name="nome" placeholder="nome..." required>

            <br>
            <br>

            <label>Marca:</label>
            <br>
            <input type="text" id="marca" name="marca" placeholder="Marca..." required>

            <br>
            <br>

            <label>Categoria:</label>
            <br>
            <input type="text" id="categoria" name="categoria" placeholder="Categoria..." required>

            <br>
            <br>

            <label>Fornecedor:</label>
            <br>
            <input type="text" id="fornecedor" name="fornecedor" placeholder="Fornecedor..." required>

            <br>
            <br>

            <label>Potencia:</label>
            <br>
            <input type="text" id="potencia" name="potencia" placeholder="Potencia..." required>

            <br>
            <br>

            <label>Consumo:</label>
            <br>
            <input type="text" id="consumo" name="consumo" placeholder="Consumo..." required>

            <br>
            <br>

            <label>Garantia:</label>
            <br>
            <input type="date" id="garantia" name="garantia" placeholder="Garantia..." required>

            <br>
            <br>

            <label>Prioridade:</label>
            <br>
            <input type="text" id="prioridade" name="prioridade" placeholder="Prioridade..." required>

            <br>
            <br>

            <input type="submit" id="cadastrar_eletronico" name="cadastrar_eletronico" value="Cadastrar">
        </form>
        <br>
        <a href="inicial.php"><button>Voltar</button></a>
    </body>
</html>
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
        <title>Cadastro de Doces</title>
    </head>
    <body>
        <h1>Cadastro de Doces</h1>
        <form action="./../controller/controller_doces.php" method="POST">
            <label>Marca:</label>
            <br>
            <input type="text" id="marca" name="marca" placeholder="Marca..." required>

            <br>
            <br>

            <label>Tipo:</label>
            <br>
            <input type="text" id="tipo" name="tipo" placeholder="Tipo..." required>

            <br>
            <br>

            <label>Data de Validade:</label>
            <br>
            <input type="date" id="data_validade" name="data_validade" placeholder="Data Validade..." required>

            <br>
            <br>

            <label>Formato:</label>
            <br>
            <input type="text" id="formato" name="formato" placeholder="Formato..." required>

            <br>
            <br>

            <label>Tamanho:</label>
            <br>
            <input type="text" id="tamanho" name="tamanho" placeholder="Tamanho..." required>

            <br>
            <br>

            <input type="submit" id="cadastrar_doce" name="cadastrar_doce" value="Cadastrar">
        </form>
        <br>
        <a href="inicial.php"><button>Voltar</button></a>
    </body>
</html>
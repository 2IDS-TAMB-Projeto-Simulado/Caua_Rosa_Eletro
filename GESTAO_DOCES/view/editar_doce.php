<?php
require_once "./../controller/controller_doces.php";

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">       
        <title>Editar Doces</title>
    </head>
    <body>
        <h1>Editar Doces</h1>
        <form action="" method="POST">
            <label>Marca:</label>
            <br>
            <input type="text" id="marca" name="marca" value="<?php echo $doce_editar["DOCE_MARCA"]; ?>" required>

            <br>
            <br>

            <label>Tipo:</label>
            <br>
            <input type="text" id="tipo" name="tipo" value="<?php echo $doce_editar["DOCE_TIPO"]; ?>" required>

            <br>
            <br>

            <label>Data de Validade:</label>
            <br>
            <input type="date" id="data_validade" name="data_validade" value="<?php echo $doce_editar["DOCE_DATA_VALIDADE"]; ?>" required>

            <br>
            <br>

            <label>Formato:</label>
            <br>
            <input type="text" id="formato" name="formato" value="<?php echo $doce_editar["DOCE_FORMATO"]; ?>" required>

            <br>
            <br>

            <label>Tamanho</label>
            <br>
            <input type="text" id="tamanho" name="tamanho" value="<?php echo $doce_editar["DOCE_TAMANHO"]; ?>" required>

            <input type="hidden" name="id" value="<?= $doce_editar['DOCE_ID'] ?>">


            <br>
            <br>

            <input type="submit" id="editar_doce" name="editar_doces" value="Salvar Alterações">
        </form>
        <br>
        <a href="inicial.php"><button>Voltar</button></a>
    </body>
</html>
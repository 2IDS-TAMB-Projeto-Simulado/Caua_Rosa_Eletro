<?php
require_once "./../controller/controller_eletronicos.php";

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Eletrônicos</title>
</head>
<body>
    <h1>Editar Eletrônicos</h1>

    <form action="" method="POST">

        <label>Nome:</label><br>
        <input type="text" id="nome" name="nome" value="<?php echo $eletronico_editar['NOME']; ?>" required>
        <br><br>

        <label>Marca:</label><br>
        <input type="text" id="marca" name="marca" value="<?php echo $eletronico_editar['MARCA']; ?>" required>
        <br><br>

        <label>Categoria:</label><br>
        <input type="text" id="categoria" name="categoria" value="<?php echo $eletronico_editar['CATEGORIA']; ?>" required>
        <br><br>

        <label>Fornecedor:</label><br>
        <input type="text" id="fornecedor" name="fornecedor" value="<?php echo $eletronico_editar['FORNECEDOR']; ?>" required>
        <br><br>

        <label>Potência:</label><br>
        <input type="text" id="potencia" name="potencia" value="<?php echo $eletronico_editar['POTENCIA']; ?>" required>
        <br><br>

        <label>Consumo:</label><br>
        <input type="text" id="consumo" name="consumo" value="<?php echo $eletronico_editar['CONSUMO']; ?>" required>
        <br><br>

        <label>Garantia:</label><br>
        <input type="date" id="garantia" name="garantia" value="<?php echo $eletronico_editar['GARANTIA']; ?>" required>
        <br><br>

        <label>Prioridade:</label><br>
        <input type="text" id="prioridade" name="prioridade" value="<?php echo $eletronico_editar['PRIORIDADE']; ?>" required>

        <!-- campo oculto com o ID do eletrônico -->
        <input type="hidden" name="id" value="<?php echo $eletronico_editar['ELETRONICO_ID']; ?>">

        <br><br>
        <input type="submit" id="editar_eletronico" name="editar_eletronicos" value="Salvar Alterações">
    </form>

    <br>
    <a href="inicial.php"><button>Voltar</button></a>
</body>
</html>

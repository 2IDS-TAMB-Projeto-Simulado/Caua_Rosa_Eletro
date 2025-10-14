<?php
require_once "./../controller/controller_doces.php";

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit();
}

$doce = new Doce();
if (isset($_POST['botao_pesquisar'])) {
    $resultados = $doce->filtrar_doce($_POST['pesquisar']);
} 
else {
    $resultados = $doce->listar_doces();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">       
        <title>Lista de Doces</title>
        <style>
            table{
                border-collapse:collapse;
            }
            tr, td, th{
                padding: 12px;
            }
        </style>
    </head>
    <body>
        <h1>Lista de Doces</h1>
        <form method="POST">
            <input type="search" id="pesquisar" name="pesquisar" placeholder="Pesquisar...">
            <input type="submit" id="botao_pesquisar" name="botao_pesquisar" value="Filtrar">
        </form>
        
        <br>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Marca</th>
                <th>Tipo</th>
                <th>Data de Validade</th>
                <th>Formato</th>
                <th>Tamanho</th>
                <th>Editar</th>
                <th>Excluir</th>
            </tr>
            <?php
                if(count($resultados) > 0){
                    foreach($resultados as $r){
                        echo "<tr>";  
                        echo "<td>".$r["DOCE_ID"]."</td>";
                        echo "<td>".$r["DOCE_MARCA"]."</td>";
                        echo "<td>".$r["DOCE_TIPO"]."</td>";
                        echo "<td>".$r["DOCE_DATA_VALIDADE"]."</td>";
                        echo "<td>".$r["DOCE_FORMATO"]."</td>";
                        echo "<td>".$r["DOCE_TAMANHO"]."</td>";
                        echo "<td><a href='editar_doce.php?acao=editar_doce&id=".$r["DOCE_ID"]."'>Editar</a></td>";
                        echo "<td><a href='./../controller/controller_doces.php?acao=excluir_doce&id=".$r["DOCE_ID"]."'>Excluir</a></td>";
                        echo "</tr>";                            
                    }
                }
                else{
                    echo "<tr>";  
                    echo "<th colspan='6'>Nenhum doce cadastrado!</th>";
                    echo "</tr>";       
                }
            ?>
        </table>
        <br>
        <a href="cadastro_doce.php"><button>Cadastrar Doces</button></a>
        <br>
        <br>
        <a href="inicial.php"><button>Voltar</button></a>
    </body>
</html>
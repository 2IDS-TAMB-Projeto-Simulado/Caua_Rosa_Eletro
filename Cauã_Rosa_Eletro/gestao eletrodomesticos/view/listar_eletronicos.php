<?php
require_once "./../controller/controller_eletronicos.php";

if(!isset($_SESSION['usuario'])){
    header("Location: login.php");
    exit();
}

$eletronico = new Eletronico();
if (isset($_POST['botao_pesquisar'])) {
    $resultados = $eletronico->filtrar_eletronico($_POST['pesquisar']);
} 
else {
    $resultados = $eletronico->listar_eletronicos();
}
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">       
        <title>Lista de Eletronicos</title>
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
        <h1>Lista de Eletronicos</h1>
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
                        echo "<td>".$r["ELETRONICO_ID"]."</td>";
                        echo "<td>".$r["NOME"]."</td>";
                        echo "<td>".$r["MARCA"]."</td>";
                        echo "<td>".$r["CATEGORIA"]."</td>";
                        echo "<td>".$r["FORNECEDOR"]."</td>";
                        echo "<td>".$r["POTENCIA"]."</td>";
                        echo "<td>".$r["CONSUMO"]."</td>";
                        echo "<td>".$r["GARANTIA"]."</td>";
                        echo "<td>".$r["PRIORIDADE"]."</td>";
                        echo "<td><a href='editar_eletronico.php?acao=editar_eletronico&id=".$r["ELETRONICO_ID"]."'>Editar</a></td>";
                        echo "<td><a href='./../controller/controller_eletronicos.php?acao=excluir_eletronico&id=".$r["ELETRONICO_ID"]."'>Excluir</a></td>";
                        echo "</tr>";                            
                    }
                }
                else{
                    echo "<tr>";  
                    echo "<th colspan='6'>Nenhum eletronico cadastrado!</th>";
                    echo "</tr>";       
                }
            ?>
        </table>
        <br>
        <a href="cadastro_eletronico.php"><button>Cadastrar Eletronicos</button></a>
        <br>
        <br>
        <a href="inicial.php"><button>Voltar</button></a>
    </body>
</html>
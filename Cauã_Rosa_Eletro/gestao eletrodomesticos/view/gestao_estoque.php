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
        <title>Gestão de Estoque</title>
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
        <h1>Gestão de Estoque</h1>
        <form method="POST">
            <input type="search" id="pesquisar" name="pesquisar" placeholder="Pesquisar...">
            <input type="submit" id="botao_pesquisar" name="botao_pesquisar" value="Filtrar">
        </form>
        
        <br>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Marca</th>
                <th>Categoria</th>
                <th>Fornecedor</th>
                <th>Potencia</th>
                <th>Consumo</th>
                <th>Garantia</th>
                <th>Prioridade</th>
                <th>Quantidade no Estoque</th>
                <th>Ação</th>
                <th>Quantidade</th>
                <th>Atualizar Estoque</th>
            </tr>
            <?php
                if(count($resultados) > 0){
                    foreach($resultados as $r){
                        echo "<form method='POST' action='./../controller/controller_estoque.php'>";
                        echo "<tr>";  
                        echo "<td><input type='number' name='eletronico_id' id='eletronico_id' value='".$r["ELETRONICO_ID"]."' readonly></td>";
                        echo "<td>".$r["NOME"]."</td>";
                        echo "<td>".$r["MARCA"]."</td>";
                        echo "<td>".$r["CATEGORIA"]."</td>";
                        echo "<td>".$r["FORNECEDOR"]."</td>";
                        echo "<td>".$r["POTENCIA"]."</td>";
                        echo "<td>".$r["CONSUMO"]."</td>";
                        echo "<td>".$r["GARANTIA"]."</td>";
                        echo "<td>".$r["PRIORIDADE"]."</td>";
                        echo "<td><input type='number' name='estoque_qtd' id='estoque_qtd' value='".$r["QUANTIDADE"]."' readonly></td>";
                        echo "<td>
                                    <select id='acao_estoque' name='acao_estoque'>
                                        <option value=''>Selecione...</option>
                                        <option value='entrada'>Entrada no Estoque</option>
                                        <option value='saida'>Saída do Estoque</option>
                                    </select>
                                </td>";
                        echo " <td>
                                    <input type='number' id='qtd_aumentar_diminuir' name='qtd_aumentar_diminuir' min='0'>
                                </td>";
                        echo "<td><input type='submit' id='botao_atualizar' name='botao_atualizar' value='Atualizar Estoque'></td>";
                        echo "</tr>";    
                        echo "</form>";                        
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
        <br>
        <a href="inicial.php"><button>Voltar</button></a>
    </body>
</html>
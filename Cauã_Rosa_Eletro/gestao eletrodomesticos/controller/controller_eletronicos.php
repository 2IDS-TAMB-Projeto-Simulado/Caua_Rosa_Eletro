<?php
    require_once "../model/model_eletronicos.php";
    session_start();

    //CADASTRAR ELETRONICO
    if(isset($_POST["cadastrar_eletronico"])){
        $eletronico = new Eletronico();
        $resultado = $eletronico->cadastrar_eletronico($_POST["nome"], $_POST["marca"], $_POST["categoria"],$_POST["fornecedor"], $_POST["potencia"], $_POST["consumo"], $_POST["garantia"], $_POST["prioridade"], $_SESSION['usuario']["USU_ID"], );
        if($resultado){
            echo "<script>
                    alert('Eletronico cadastrado com sucesso!');
                    window.location.href='../view/listar_eletronicos.php';
                </script>";
        } 
        else {
            echo "<script>
                    alert('Erro ao cadastrar eletronico!');
                    window.location.href='../view/listar_eletronicos.php';
                </script>";
        }
        exit();
    }

    //BUSCAR DADOS PARA EDITAR ELETRONICO
    else if(isset($_GET["acao"]) && $_GET["acao"] == "editar_eletronico"){



        $eletronico = new Eletronico();
        $resultados = $eletronico->buscar_eletronico_pelo_id($_GET["id"]);

        if(!empty($resultados)) {
            $eletronico_editar = $resultados[0];
        } else {
            echo "<script>
                    alert('Eletronico não encontrado!');
                    window.location.href='listar_eletronicos.php';
                </script>";
            exit();
        }
    }


    //EDITAR ELETRONICO
    if(isset($_POST["editar_eletronicos"])){

    $eletronico = new Eletronico();
    $resultado = $eletronico->editar_eletronico(
        $_POST["nome"],
        $_POST["marca"],
        $_POST["categoria"],
        $_POST["fornecedor"],
        $_POST["potencia"],
        $_POST["consumo"],
        $_POST["garantia"],
        $_POST["prioridade"],
        $_POST["id"],
        $_SESSION['usuario']["USU_ID"]
    );
    if($resultado){
        echo "<script>
                alert('Eletronico atualizado com sucesso!');
                window.location.href='../view/listar_eletronicos.php';
            </script>";
    } else {
        echo "<script>
                alert('Erro ao atualizar eletronico!');
                window.location.href='../view/listar_eletronicos.php';
            </script>";
    }
    exit();
}


    //EXCLUIR ELETRONICO
    else if(isset($_GET["acao"]) && $_GET["acao"] == "excluir_eletronico"){
        $eletronico = new Eletronico();
        $resultado = $eletronico->excluir_eletronico($_GET["id"], $_SESSION['usuario']['USU_ID']);
        if($resultado){
            echo "<script>
                    alert('Eletronico excluído com sucesso!');
                    window.location.href='../view/listar_eletronicos.php';
                </script>";
        } 
        else {
            echo "<script>
                    alert('Erro ao excluir eletronico!');
                    window.location.href='../view/listar_livros.php';
                </script>";
        }
        exit();
    }
?>
<?php
require_once "../config/db.php";
require_once "model_estoque.php";
require_once "model_logs.php";

class Eletronico {

    public function cadastrar_eletronico($nome, $marca, $categoria, $fornecedor, $potencia, $consumo, $garantia, $prioridade, $fk_usu_id) {
        $conn = Database::getConnection();

        $insert = $conn->prepare("
            INSERT INTO ELETRONICOS 
            (NOME, MARCA, CATEGORIA, FORNECEDOR, POTENCIA, CONSUMO, GARANTIA, PRIORIDADE, FK_USUARIO_ID)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        $insert->bind_param("ssssssssi", $nome, $marca, $categoria, $fornecedor, $potencia, $consumo, $garantia, $prioridade, $fk_usu_id);
        $success = $insert->execute();

        if ($success) {
            $eletronico_id = $conn->insert_id;

            $estoque = new Estoque();
            $estoque->adicionar_estoque(0, $eletronico_id);

            $logs = new Logs();
            $logs->cadastrar_logs(
                "ELETRONICOS <br> ID: " . $eletronico_id .
                " <br> MARCA: " . $marca .
                " <br> AÇÃO: Cadastrado! <br> ID USUÁRIO: " . $fk_usu_id
            );
        }

        $insert->close();
        return $success;
    }

    public function listar_eletronicos() {
        $conn = Database::getConnection();

        $sql = "
            SELECT 
                L.ELETRONICO_ID, L.NOME, L.MARCA, L.CATEGORIA, 
                L.FORNECEDOR, L.POTENCIA, L.CONSUMO, 
                L.GARANTIA, L.PRIORIDADE, 
                E.QUANTIDADE, U.USU_NOME, U.USU_EMAIL 
            FROM ELETRONICOS L
            JOIN USUARIO U ON L.FK_USUARIO_ID = U.USU_ID
            JOIN ESTOQUE E ON L.ELETRONICO_ID = E.FK_ELETRO_ID
            ORDER BY L.MARCA
        ";

        $result = $conn->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function excluir_eletronico($eletronico_id, $fk_usu_id) {
        $conn = Database::getConnection();

        $deleteEstoque = $conn->prepare("DELETE FROM ESTOQUE WHERE FK_ELETRO_ID = ?");
        $deleteEstoque->bind_param("i", $eletronico_id);
        $deleteEstoque->execute();
        $deleteEstoque->close();

        $delete = $conn->prepare("DELETE FROM ELETRONICOS WHERE ELETRONICO_ID = ?");
        $delete->bind_param("i", $eletronico_id);

        $logs = new Logs();
        $logs->cadastrar_logs(
            "ELETRONICO <br> ID: " . $eletronico_id .
            " <br> AÇÃO: Excluído! <br> ID USUÁRIO: " . $fk_usu_id
        );

        $success = $delete->execute();
        $delete->close();

        return $success;
    }

    public function buscar_eletronico_pelo_id($id) {
        $conn = Database::getConnection();

        $select = $conn->prepare("
            SELECT 
                L.ELETRONICO_ID, L.NOME, L.MARCA, L.CATEGORIA, 
                L.FORNECEDOR, L.POTENCIA, L.CONSUMO, 
                L.GARANTIA, L.PRIORIDADE, 
                E.QUANTIDADE, U.USU_NOME, U.USU_EMAIL
            FROM ELETRONICOS L
            JOIN USUARIO U ON L.FK_USUARIO_ID = U.USU_ID
            JOIN ESTOQUE E ON L.ELETRONICO_ID = E.FK_ELETRO_ID
            WHERE L.ELETRONICO_ID = ?
            ORDER BY L.MARCA
        ");
        $select->bind_param("i", $id);
        $select->execute();

        $result = $select->get_result();
        $eletronico = $result->fetch_all(MYSQLI_ASSOC);

        $select->close();
        return $eletronico;
    }

    public function editar_eletronico($nome, $marca, $categoria, $fornecedor, $potencia, $consumo, $garantia, $prioridade, $eletronico_id, $fk_usu_id) {
        $conn = Database::getConnection();

        $update = $conn->prepare("
            UPDATE ELETRONICOS 
            SET NOME = ?, MARCA = ?, CATEGORIA = ?, 
                FORNECEDOR = ?, POTENCIA = ?, CONSUMO = ?, 
                GARANTIA = ?, PRIORIDADE = ?
            WHERE ELETRONICO_ID = ?
        ");
        $update->bind_param("ssssssssi", $nome, $marca, $categoria, $fornecedor, $potencia, $consumo, $garantia, $prioridade, $eletronico_id);
        $success = $update->execute();

        if ($success) {
            $logs = new Logs();
            $logs->cadastrar_logs(
                "ELETRONICOS <br> ID: " . $eletronico_id .
                " <br> NOME: " . $nome .
                " <br> AÇÃO: Editado! <br> ID USUÁRIO: " . $fk_usu_id
            );
        }

        $update->close();
        return $success;
    }

    public function filtrar_eletronico($campo) {
        $conn = Database::getConnection();

        $select = $conn->prepare("
            SELECT 
                L.ELETRONICO_ID, L.NOME, L.MARCA, L.CATEGORIA, 
                L.FORNECEDOR, L.POTENCIA, L.CONSUMO, 
                L.GARANTIA, L.PRIORIDADE, 
                E.QUANTIDADE, U.USU_NOME, U.USU_EMAIL
            FROM ELETRONICOS L
            JOIN USUARIO U ON L.FK_USUARIO_ID = U.USU_ID
            JOIN ESTOQUE E ON L.ELETRONICO_ID = E.FK_ELETRO_ID
            WHERE L.NOME LIKE ?
            ORDER BY L.NOME
        ");

        $termo = "%" . $campo . "%";
        $select->bind_param("s", $termo);
        $select->execute();

        $result = $select->get_result();
        $eletronicos = $result->fetch_all(MYSQLI_ASSOC);

        $select->close();
        return $eletronicos;
    }
}
?>

<?php
    require_once "../config/db.php";
    require_once "model_estoque.php";
    require_once "model_logs.php";

    class Doce{
        public function cadastrar_doce($marca, $tipo, $datavalidade, $formato, $tamanho, $fk_usu_id) {
            $conn = Database::getConnection();
            $insert = $conn->prepare("INSERT INTO DOCES (DOCE_MARCA, DOCE_TIPO, DOCE_DATA_VALIDADE, DOCE_FORMATO, DOCE_TAMANHO, FK_USU_ID) VALUES (?, ?, ?, ?, ?, ?)");
            $insert->bind_param("sssssi", $marca, $tipo, $datavalidade, $formato, $tamanho, $fk_usu_id);
            $success = $insert->execute();

            if($success){
                $doce_id = $conn->insert_id;

                $estoque = new Estoque();
                $estoque->adicionar_estoque(0,$fk_usu_id,$doce_id);

                $logs = new Logs();
                $logs->cadastrar_logs("DOCES <br> ID: ".$doce_id." <br> MARCA: ".$marca." <br> AÇÃO: Cadastrado! <br> ID USUÁRIO: ".$fk_usu_id);
            }

            $insert->close();
            return $success;
        }

        public function listar_doces() {
            $conn = Database::getConnection();
            $sql = "SELECT      D.DOCE_ID,
                                D.DOCE_MARCA,
                                D.DOCE_TIPO,
                                D.DOCE_DATA_VALIDADE,
                                D.DOCE_FORMATO,
                                D.DOCE_TAMANHO,
                                E.ESTOQUE_QUANTIDADE,
                                U.USU_NOME,
                                U.USU_EMAIL
                    FROM        DOCES D
                    JOIN        USUARIO U ON D.FK_USU_ID = U.USU_ID
                    JOIN        ESTOQUE E ON D.DOCE_ID = E.FK_DOCE_ID
                    ORDER BY    D.DOCE_MARCA";
            $result = $conn->query($sql);
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function excluir_doce($doce_id, $fk_usu_id) {
        $conn = Database::getConnection();

        $deleteEstoque = $conn->prepare("DELETE FROM ESTOQUE WHERE FK_DOCE_ID = ?");
        $deleteEstoque->bind_param("i", $doce_id);
        $deleteEstoque->execute();
        $deleteEstoque->close();

        $delete = $conn->prepare("DELETE FROM DOCES WHERE DOCE_ID = ?");
        $delete->bind_param("i", $doce_id);

        $logs = new Logs();
        $logs->cadastrar_logs("DOCE <br> ID: ".$doce_id." <br> AÇÃO: Excluído! <br> ID USUÁRIO: ".$fk_usu_id);

        $success = $delete->execute();
        $delete->close();

        return $success;
}

        public function buscar_doce_pelo_id($id) {
            $conn = Database::getConnection();
            $select = $conn->prepare("SELECT        D.DOCE_ID,
                                                    D.DOCE_MARCA,
                                                    D.DOCE_TIPO,
                                                    D.DOCE_DATA_VALIDADE,
                                                    D.DOCE_FORMATO,
                                                    D.DOCE_TAMANHO,
                                                    E.ESTOQUE_QUANTIDADE,
                                                    U.USU_NOME,
                                                    U.USU_EMAIL
                                        FROM        DOCES D
                                        JOIN        USUARIO U ON D.FK_USU_ID = U.USU_ID
                                        JOIN        ESTOQUE E ON D.DOCE_ID = E.FK_DOCE_ID
                                        WHERE       D.DOCE_ID = ?
                                        ORDER BY    D.DOCE_MARCA");
            $select->bind_param("i", $id);
            $select->execute();
            $result = $select->get_result();
            $doce = $result->fetch_all(MYSQLI_ASSOC);
            $select->close();
            return $doce;

        }

        public function editar_doce($marca, $tipo, $datavalidade, $formato, $tamanho, $doce_id, $fk_usu_id) {
            $conn = Database::getConnection();
            $insert = $conn->prepare("UPDATE DOCES SET DOCE_MARCA = ?, DOCE_TIPO = ?, DOCE_DATA_VALIDADE = ?, DOCE_TAMANHO = ?, DOCE_FORMATO = ? WHERE DOCE_ID = ?");
            $insert->bind_param("sssssi", $marca, $tipo, $datavalidade, $formato, $tamanho, $doce_id);
            $success = $insert->execute();

            if($success){
                $logs = new Logs();
                $logs->cadastrar_logs("DOCES <br> ID: ".$doce_id." <br> TITULO: ".$titulo." <br> AÇÃO: Editado! <br> ID USUÁRIO: ".$fk_usu_id);
            }

            $insert->close();
            return $success;
        }

        public function filtrar_doce($campo) {
            $conn = Database::getConnection();
            $select = $conn->prepare("SELECT        D.DOCE_ID,
                                                    D.DOCE_MARCA,
                                                    D.DOCE_TIPO,
                                                    D.DOCE_DATA_VALIDADE,
                                                    D.DOCE_FORMATO,
                                                    D.DOCE_TAMANHO,
                                                    E.ESTOQUE_QUANTIDADE,
                                                    U.USU_NOME,
                                                    U.USU_EMAIL
                                        FROM        DOCES D
                                        JOIN        USUARIO U ON D.FK_USU_ID = U.USU_ID
                                        JOIN        ESTOQUE E ON D.DOCE_ID = E.FK_DOCE_ID
                                        WHERE       D.DOCE_MARCA LIKE ?
                                        ORDER BY    D.DOCE_MARCA");
            $termo = "%" . $campo . "%";
            $select->bind_param("s", $termo);
            $select->execute();
            $result = $select->get_result();
            $doces = $result->fetch_all(MYSQLI_ASSOC);
            $select->close();
            return $doces;
        }
    }
?>
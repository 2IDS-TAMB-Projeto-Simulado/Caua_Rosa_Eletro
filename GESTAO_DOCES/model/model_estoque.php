<?php
    require_once "../config/db.php";
    require_once "model_logs.php";

    class Estoque{
        public function adicionar_estoque($quantidade, $fk_usu_id, $fk_doce_id) {
            $conn = Database::getConnection();
            $insert = $conn->prepare("INSERT INTO ESTOQUE (ESTOQUE_QUANTIDADE, FK_DOCE_ID) VALUES (?, ?)");
            $insert->bind_param("ii", $quantidade, $fk_doce_id);
            $success = $insert->execute(); 
            $insert->close();
            return $success;
        }
        public function atualizar_estoque($quantidade, $fk_doce_id, $fk_usu_id) {
            $conn = Database::getConnection();
            $update = $conn->prepare("UPDATE ESTOQUE SET ESTOQUE_QUANTIDADE = ? WHERE FK_DOCE_ID = ?");
            $update->bind_param("ii", $quantidade, $fk_doce_id);
            $success = $update->execute();

            if($success){
                $logs = new Logs();
                $logs->cadastrar_logs("Doce <br> ID: ".$fk_doce_id." <br> AÇÃO: Estoque editado <br> NOVA QTD: ".$quantidade."<br> ID USUÁRIO: ".$fk_usu_id);
            }
            $update->close();
            return $success;
        }
    }
?>
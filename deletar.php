<?php
    include 'config.php';

    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        $query = "DELETE FROM manutencoes WHERE manutencao_id = $id";
        if($conn->query($query)){
            header('Location: index.php');
            exit();
        }else{
            echo "Erro ao excluir item: " . $conn->error;
        }
    } else{
        echo "ID Inválido.";
    }
?>
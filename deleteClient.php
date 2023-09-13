<?php
    require 'Database.php';

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $db = new Database();
        $db->deleteClient($id);
        header("Location: listClient.php");
        exit();
    } else {
        echo "Erreur : l'identifiant de l'id n'a pas été spécifié.";
        exit();
    }    
?>
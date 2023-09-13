<?php
    require 'Database.php';

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $db = new Database();
        $db->deleteEmploye($id);
        header("Location: listEmploye.php");
        exit();
    } else {
        echo "Erreur : l'identifiant de l'employé n'a pas été spécifié.";
        exit();
    }    
?>
<?php
    $id = $_POST['id'];
    if(!isset($id)){
        header('location: Acceuil.php');
    }
    require_once('db.php');
    $sqlst = $pdo-> prepare('DELETE FROM PRODUIT WHERE ID = ?');
    $res = $sqlst->execute([$id]);
    if($res == true){
        header('location: Acceuil.php');    
    }

?>
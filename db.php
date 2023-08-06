<?php 
    try{
        $pdo = new PDO('mysql:host:=localhost;dbname=stock', 'root', 'hihihaha');
    }catch(\PDOException $exp){
        echo $exp->getMessage();
        die();
    }
?>
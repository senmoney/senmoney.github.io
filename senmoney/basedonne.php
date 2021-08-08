<?php
   
   try{
    $pdo = new PDO("mysql:host=localhost;dbname=sarr", "sarr", "passer123/");
    $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
   }catch(PDOException $e){
        echo "ERREUR: ".$e->getMessage();
    }


   
   ?>

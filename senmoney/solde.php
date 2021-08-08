<?php
if(isset($_REQUEST['q'])){

    $var = $_REQUEST['q'];

    try{
        $pdo = new PDO("mysql:host=localhost;dbname=sarr", "sarr", "passer123/");
        $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

        $re = $pdo->prepare("SELECT solde FROM comptes WHERE id =  '".$var."' ");
        $re->execute();
        $ta = $re->fetchAll();
        foreach($ta as $elem){
            echo $elem['solde'];
        }
    }catch(PDOException $e){
        echo "ERREUR: ".$e->getMessage();
    }
     
}
  
    
?>
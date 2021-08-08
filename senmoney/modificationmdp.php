<?php
    if(isset($_REQUEST['q']) && isset($_REQUEST['new']) && isset($_REQUEST['old'])){

        $ancienCode = $_REQUEST['old'];
        $idCode = $_REQUEST['q'];
        $nouveauCode = $_REQUEST['new'];

        if($idCode != "" && $nouveauCode != "" && $ancienCode != ""){
            try{
                    $pdo = new PDO("mysql:host=localhost;dbname=senmoneydb", "root", "passer123/");
                    $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

                    $req = $pdo->prepare("SELECT code FROM comptes WHERE id =  '".$idCode."' ");
                    $req->execute();
                    $ta = $req->fetchAll();
                    foreach($ta as $elemt){
                        $codeCourant = $elemt['code'];
                    }
                    if($ancienCode != $codeCourant){
                        echo "Erreur!! Votre ancien code secret est incorrect";

                    }else {
                        $requetepassword ="UPDATE comptes SET code = ?  WHERE id = ?";
                        $params=array($nouveauCode,$idCode);
                        $resultatPass= $pdo->prepare($requetepassword);
                        $resultatPass->execute($params);

                        echo "Excellent!! \nVotre nouveau code secret est ".$nouveauCode."";
                    }
                    
            }catch(PDOException $e){
                echo "ERREUR: ".$e->getMessage();       
            }
    }else {
            echo "Veuillez à bien remplir les Champs slvp!!!";
        }
    }
?>
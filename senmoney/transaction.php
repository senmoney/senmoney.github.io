<?php
     if(isset($_REQUEST['q'])){

        $position = $_REQUEST['q'];
        //$size = 5;

        try{
            $pdo = new PDO("mysql:host=localhost;dbname=sarr", "sarr", "passer123/");
            $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

            //Numero  pour la transaction
            $recupNum = $pdo->prepare("SELECT numero FROM comptes WHERE id = '".$position."'");
            //execution des requetes
            $recupNum->execute();
            //Nous recuperons le resultat sous format tableau associatif
            $requeteNum = $recupNum->fetchAll();

            foreach ($requeteNum as $num) {
                $numero = $num['numero'];
            }
            $requeteTrans ="SELECT * FROM transactions WHERE envoyeur= ? ORDER BY id  DESC LIMIT 5";
            $params=array($numero);
            $resultatTrans= $pdo->prepare($requeteTrans);
            $resultatTrans->execute($params);

            if($resultatTrans){
                foreach ($resultatTrans as $valeur) {
                    echo "Envoyeur: " .$valeur['envoyeur']." //Le Montant est de : ".$valeur['solde']." à ".$valeur['receveur']."\n";
                }
            }else{
                echo "Vous avez effectuer aucune transaction pour le moment!!!!";
            }
        }catch(PDOException $e){
            echo "ERREUR: ".$e->getMessage();
        }
    
     }
?>
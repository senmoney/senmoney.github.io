<?php
    if(isset($_REQUEST['envoyeur']) && isset($_REQUEST['receveur']) && isset($_REQUEST['montant']) && isset($_REQUEST['code'])){

        $envoyeur = $_REQUEST['envoyeur'];
        $receveur = $_REQUEST['receveur'];
        $montant = $_REQUEST['montant'];
        $code = $_REQUEST['code'];

        if($envoyeur != "" && $receveur != "" && $montant !=0 && $code != 0) {

            try{
                $pdo = new PDO("mysql:host=localhost;dbname=senmoneydb", "root", "passer123/");
                $pdo->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);

                //Numero envoyeur pour la transaction
                $recupNum = $pdo->prepare("SELECT numero FROM comptes WHERE id= '".$envoyeur."'");
                //le compte de l'utilisateur qui envoi
                $requete_soldeur = $pdo->prepare("SELECT solde FROM comptes WHERE id = '".$envoyeur."' ");
                $requete_code = $pdo->prepare("SELECT code FROM comptes WHERE id = '".$envoyeur."' ");


                //le compte de l'utilisateur qui reçoit
                $requete_receveur = $pdo->prepare("SELECT solde FROM comptes WHERE numero = '".$receveur."' ");

                //execution des requetes
                $recupNum->execute();
                $requete_soldeur->execute();
                $requete_code->execute();
                $requete_receveur->execute();

                //Nous recuperons le resultat sous format tableau associatif
                $requeteNum = $recupNum->fetchAll();
                $requeteSolde = $requete_soldeur->fetchAll();
                $requeteCode = $requete_code->fetchAll();
                $requeteReceveur = $requete_receveur->fetchAll();

                foreach ($requeteNum as $num) {
                    $numero = $num['numero'];
                }
                
                foreach ($requeteSolde as $elem1) {
                    $solde_courant_envoyeur = (int)($elem1['solde']);
                }
                foreach ($requeteCode as $elem3) {
                    $codeVerifier = $elem3['code'];
                }
                foreach ($requeteReceveur as $elem2) {
                    $solde_courant_receveur = (int)($elem2['solde']);
                }

                if($solde_courant_envoyeur < $montant) {
                    echo "Solde insuffisant";
                }elseif ($codeVerifier != $code) {
                    echo "Erreur! de code secret";
                }else {
                    //On débite du Compte envoyeur
                    $soldeUpdateEn = $solde_courant_envoyeur - $montant;
                    $requeteUpdateEn = $pdo->prepare("UPDATE comptes SET solde = '".$soldeUpdateEn."' WHERE id = '".$envoyeur."'");
                    $requeteUpdateEn->execute();

                    //on crédite du compte receveur
                    $soldeUpdateRe = $solde_courant_receveur + $montant;
                    $requeteUpdateRe = $pdo->prepare("UPDATE comptes SET solde = '".$soldeUpdateRe."' WHERE numero = '".$receveur."'");
                    $requeteUpdateRe->execute();

                    //Requete pour la transaction
                    $requete_transaction ="INSERT INTO transactions(envoyeur, receveur, solde) VALUES(?, ?, ?)";
                    //transaction
                    $params=array($numero,$receveur,$montant);
                    $resultaTransaction= $pdo->prepare($requete_transaction);
                    $resultaTransaction->execute($params);

                    echo "Transfert réussie Avec Succès!!\nVotre nouveau solde est de : ". $soldeUpdateEn ." FCFA\n";

                }

            }catch(PDOException $e) {
                echo "ERREUR: ".$e->getMessage();
            }
            
            
        }else {
            echo "Veuillez Remplir les champs!!\n Mercii Pour cette Comprehension";
        }

    }
?>
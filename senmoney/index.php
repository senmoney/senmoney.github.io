<?php
    require_once("basedonne.php");
    $rep = $pdo->prepare("SELECT id, numero FROM comptes");
    $rep->execute();


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>SendMoney</title>
    <script src="script.js"></script>
    <script src="requete.js"></script>
</head>
<body>
    
    <div class="content">
        
        <h2>Sen Money</h2>
            <form method="POST">
                <select name="numero" id="numero" onchange="this.form.selectedIndex">
                <?php 
                    $tab = $rep->fetchAll();
                    foreach ($tab as $element) {
                ?> 
                
                <option value="<?php echo $element['id'];?>" ><?php echo $element['numero'];?></option>
                <?php
                    }
                ?> 
                </select>
            </form>  
            <p><button onclick="menu()">#221#</button></p>
      
    </div>
</body>
</html>
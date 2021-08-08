var numero = null;
var reponseValeur = null;

        function retourMenu(msg) {
            var req = window.confirm(msg+" \n Voulez-vous retourner au menu ?");
                    if (req == true) {
                        menu();
                    }
        }

        function menu() {
            var choix;
            var select = document.getElementById("numero");
            numero = select.options[select.selectedIndex].text;
            
            choix = window.prompt("_____Menu Sen Money_____\n" +
                "____" + numero + "____\n" +
                "____Faites Votre Choix____\n" +
                "1: Solde de mon Compte\n" +
                "2: Transfert d'argent\n" +
                "3: Paiement de facture\n" +
                "4: Options");
            switch (choix) {
                case "1":
                    afficheSolde();
                    break;
                case "2":
                    transfertArgent();
                    break;
                case "3":
                    paiementFacture();
                    break;
                case "4":
                    options();
                    break;    
                default:
                    retourMenu("");

            }
        }

       
        function afficheSolde() {

            var select2 = document.getElementById("numero");
            reponseValeur = select2.options[select2.selectedIndex].value
            var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var rep = window.confirm("Le solde de votre compte est de : " + this.responseText + "\nVoulez-vous retournez au menu ?");
                            if(rep == true){
                                menu();
                            }
                        }
                    };
                    xhttp.open("GET", "solde.php?q=" + reponseValeur, true);
                    xhttp.send();
        
        }


        function transfertArgent() {
            var select2 = document.getElementById("numero");
            reponseValeur2 = select2.options[select2.selectedIndex].value
            var numero_Destinataire = window.prompt("saisi le numéro du Destinataire");
            var montant_saisi = parseInt(window.prompt("saisi le montant"));
            var CodeEnvoy = window.prompt("votre code secret");

            var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var rep = window.confirm(this.responseText + "Voulez-vous retournez au menu ?");
                            if(rep == true){
                                menu();
                            }
                        }
                    };
                    xhttp.open("GET", "transfert.php?envoyeur=" + reponseValeur2 + "&receveur=" + numero_Destinataire + "&montant=" + montant_saisi + "&code=" + CodeEnvoy, true);
                    xhttp.send();


        }


        function paiementFacture() {
            var choixDuNumero = null;
            var select3 = document.getElementById("numero");
            numero3 = select3.options[select3.selectedIndex].text;
            reponseValeur3 = select3.options[select3.selectedIndex].value;

            choixDuNumero = window.prompt("---Menu Paiement Factures---\n" +
                "---" + numero3 + "---\n" +
                "---Faites Votre Choix ---\n" +
                "1: Sonatel\n" +
                "2: SENELEC et WOYOFAL\n" +
                "3: SEN' EAU\n" +
                "4: CANAL +\n" +
                "5: TRANSPORT - RAPIDO\n" +
                "6: Paiement internet\n" +
                "7: Assurances\n" +
                "0: Retour au Menu Principale");
            switch (choixDuNumero) {
                case "1":
                    sonatel();
                    break;
                case "2":
                    senelec();
                    break;
                case "3":
                    senO();
                    break;
                case "4":
                    canal();
                    break;
                case "5":
                    transport();
                    break;    
                case "6":
                    paiement();
                    break;
                case "7":
                    assurance();
                    break;  
                case "0":
                    menu();
                    break;      
                default:
                    retourMenu("");

            }

        }

        function options() {
            var choixDuNumero4 = null;
            var select4 = document.getElementById("numero");
            numero4 = select4.options[select4.selectedIndex].text;

            choixDuNumero4 = window.prompt("---Menu Options---\n" +
                "---" + numero4 + "---\n" +
                "---Faites Votre Choix ---\n" +
                "1: Cinq dernières transaction\n" +
                "2: Modification de mon code secret\n");
            switch (choixDuNumero4) {
                case "1":
                    transaction();
                    break;
                case "2":
                    modifCodeSecret();
                    break;   
                default:
                    retourMenu("");

            }

        }

        function transaction(){
            var select4_1 = document.getElementById("numero");
            reponseValeur4_1 = select4_1.options[select4_1.selectedIndex].value;

            var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            var rep = window.confirm(this.responseText + "Voulez-vous retournez au menu ?");
                            if(rep == true){
                                menu();
                            }
                        }
                    };
                    xhttp.open("GET", "transaction.php?q=" + reponseValeur4_1, true);
                    xhttp.send();

        }


        function  modifCodeSecret() {
            var select4_2 = document.getElementById("numero");
            reponseValeur4_2 = select4_2.options[select4_2.selectedIndex].value;
            var ancienCode = window.prompt("Saisissez votre ancien code secret:");
            var nouveauCode = window.prompt("Votre nouveau Code Secret:");

            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var rep = window.confirm(this.responseText + "\nVoulez-vous retournez au menu ?");
                        if(rep == true){
                            menu();
                        }
                }
            };
            xhttp.open("GET", "modificationmdp.php?q=" + reponseValeur4_2  + "&new=" + nouveauCode + "&old=" + ancienCode, true);
            xhttp.send();

        }

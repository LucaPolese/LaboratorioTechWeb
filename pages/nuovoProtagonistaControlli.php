<?php
    require_once "db.php";
    use DB\DBAccess;

    $paginaHTML = file_get_contents("nuovoProtagonistaForm.html");

    $messaggi= "";
    $nome ="";
    $colore="";
    $peso="";
    $potenza="";
    $descrizione="";
    $edizioni = array();

    if(isset($_POST['submit'])){
        //l'utente ha premuto almeno una volta il pulsante submit
        $nome = $_POST['nome'];
        if(!strlen($nome)){
            $messaggi .= "<p>Il nome non può essere vuoto</p>";
        }elseif(preg_match('/\d/', $nome)){
            $messaggi .= "<p>Il nome non può contenere numeri</p>";
        }   

        $colore = $_POST['colore'];
        if(!strlen($colore)){
            $messaggi .= "<p>Il colore non può essere vuoto</p>";
        }elseif(preg_match('/\d/', $nome)){
            $messaggi .= "<p>Il colore non può contenere numeri</p>";
        }  

        $peso = $_POST['peso'];
        if(!strlen($peso)){
            $messaggi .= "<p>Il peso non può essere vuoto</p>";
        }else if(!ctype_digit($peso)){
            $messaggi .= "<p>Il peso deve essere un numero</p>";
        }

        $potenza = $_POST['potenza'];
        if(!strlen($potenza)){
            $messaggi .= "<p>Il potenza non può essere vuoto</p>";
        }

        $descrizione = $_POST['descrizione'];
        $edizioni = $_POST['edizioni'];

    }
    //prima lettura dei dati, oppure ho già premuto il pulsante submit, ma mantengo i dati nella form con messaggio di avvenuto successo
    $paginaHTML = str_replace("<messaggioForm/>", $messaggi, $paginaHTML);
    $paginaHTML = str_replace("<valoreNome/>", $nome, $paginaHTML);
    $paginaHTML = str_replace("<valoreColore/>", $colore, $paginaHTML);
    $paginaHTML = str_replace("<valorePeso/>", $peso, $paginaHTML);
    $paginaHTML = str_replace("<vaoreDescrizione/>", $descrizione, $paginaHTML);
    $paginaHTML = str_replace("<valorePotenza/>", $potenza, $paginaHTML);


    /* RICONTROLLARE */

    $connessione = new DBAccess();
    $connessioneOK = $connessione->openDBConnection();

    if($connessioneOK){
        $risultatoQuery = $connessione->insertNewCharacter($nome, $colore, $peso, $potenza, $descrizione, $ab, $abr, $absw, $abs);
        if($risultatoQuery){
            $messaggi .= "<p> Il personaggio è stato inserito correttamente </p>";
        }else{
            $messaggi .= "<p> Errore nell\' inserimento</p>";
        }
    }
?>
<?php
    require_once "db.php";
    use DB\DBAccess;

    $paginaHTML = file_get_contents("protagonisti_php.html");

    $connessione = new DBAccess();
    $connessioneOK = $connessione->openDBConnection();

    $personaggi = ""; /*dati grezzi dal DB*/
    $listaPersonaggi = ""; /* codice HTML da dare in output */

    if($connessioneOK){
        $personaggi = $connessione->getCharacterList();
        $connessione->closeDBConnection();
        //Devo ancora controllare se $personaggi è nullo
        if($personaggi != null){
            $listaProtagonisti = '<dl id="charactersStory">';
            foreach($personaggi as $personaggio){
                $listaPersonaggi .= '<dt xml:lang="en">'.$personaggio['nome'].'</dt>';
                $listaPersonaggi .= '<dd>''</dd>';
                $listaPersonaggi .= '<dd><img src="../images/'.$personaggio['immagine'].'"/><p>'.$personaggio['descrizione'].'</p></dd>';
            }
            $listaPersonaggi .= "</dl>";
        }else{
            $listaPersonaggi = "<p> Non ci sono informazioni relative ai personaggi </p>";
        }
    }else{
        $listaPersonaggi = "<p> I sistemi sono al momento non disponibili, riprova più tardi </p>";
    }
    echo str_replace("<listaProtagonisti/>", $listaProtagonisti, $paginaHTML);
?>
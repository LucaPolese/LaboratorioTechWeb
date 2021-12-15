<?php
    require_once "db.php";
    use DB\DBAccess;

    $paginaHTML = file_get_contents("protagonisti_php.html");

    $connessione = new DBAccess();
    $connessioneOK = $connessione->openDBConnection();

    $personaggi = "";

    $listaProtagonisti = getCharacterList();
    echo str_replace("<listaProtagonisti/>", $listaProtagonisti, $paginaHTML);
?>
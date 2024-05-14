<?php

require_once 'connDb.php';

function getAutoreQry($codice, $nome, $cognome, $nazione, $dataNascita, $dataMorte, $tipo, $numeroOpere): string {
    global $conn;

    $qry = "SELECT
                AUTORE.codice,
                AUTORE.nome,
                AUTORE.cognome,
                AUTORE.nazione,
                AUTORE.dataNascita,
                AUTORE.dataMorte,
                AUTORE.tipo,
                AUTORE.numeroOpere
            FROM
                AUTORE
            WHERE
                1=1";

    if ($codice != "")
        $qry .= " AND AUTORE.codice =  $codice" ; // Aggiungi apici singoli intorno al valore

    if ($nome != "")
        $qry .= " AND AUTORE.nome  LIKE '%" . $nome . "%'" ;

    if ($cognome != "")
        $qry .= " AND AUTORE.cognome  LIKE '%" . $cognome . "%'";
        
    if ($nazione != "")
        $qry .= " AND AUTORE.nazione  LIKE '%" . $nazione . "%'";
    if ($dataNascita != "")
        $qry .= " AND AUTORE.dataNascita LIKE '%" . $dataNascita . "%'";

    if ($dataMorte != "")
        $qry .= " AND AUTORE.dataMorte LIKE '%" . $dataMorte . "%'"; // Aggiungi apici singoli intorno al valore

    if ($tipo != "")
        $qry .= " AND AUTORE.tipo = $tipo";

    if ($numeroOpere != "")
        $qry.= " AND AUTORE.numeroOpere = $numeroOpere";

    return $qry;
}



?>

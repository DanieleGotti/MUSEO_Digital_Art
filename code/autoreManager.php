<?php

require_once 'connDb.php';

function getAutoreQry($codice, $nome, $cognome, $nazione, $dataNascita, $dataMorte, $tipo, $numeroOpere, $nomeopera): string {
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
            $qry .= " AND AUTORE.tipo LIKE '%" . $tipo . "%'";
    if ($numeroOpere != "")
        $qry.= " AND AUTORE.numeroOpere = $numeroOpere";

        if ($nomeopera != "")
            $qry = "SELECT
                        AUTORE.codice,
                        AUTORE.nome,
                        AUTORE.cognome,
                        AUTORE.nazione,
                        AUTORE.dataNascita,
                        AUTORE.dataMorte,
                        AUTORE.tipo,
                        AUTORE.numeroOpere,
                        OPERA.titolo AS nomeopera
                    FROM
                        AUTORE
                        join
                        OPERA on OPERA.autore= AUTORE.codice
                    WHERE
                        1=1 AND  OPERA.titolo LIKE '%" . $nomeopera . "%'";


    return $qry;
}




function getInserisciQry($codice, $nome, $cognome, $nazione, $dataNascita, $dataMorte, $tipo): string {
    global $conn;

    // Assicurati che i valori di stringa siano racchiusi tra virgolette singole
    $qry = "INSERT INTO AUTORE (codice, nome, cognome, nazione, datanascita, dataMorte, numeroOpere, tipo, nomeopera)
           VALUES ('$codice', '$nome', '$cognome', '$nazione', '$dataNascita', '$dataMorte', '$tipo')";

    return $qry;
}
?>

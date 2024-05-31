<?php

require_once 'connDb.php';

function getAutoreQry($codice, $nome, $cognome, $nazione, $dataNascita, $dataMorte, $tipo, $numeroOpere, $nomeopera, $sort_by = 'codice', $sort_order = 'asc' ): string {
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

        if (!empty($sort_by) && !empty($sort_order)) {
    if ($sort_by == 'dataNascita' || $sort_by == 'dataMorte') {
        $qry .= " ORDER BY STR_TO_DATE(AUTORE." . $sort_by . ", '%d/%m/%Y') " . $sort_order;
    } elseif ($sort_by == 'numeroOpere') {
        $qry .= " ORDER BY CAST(AUTORE." . $sort_by . " AS UNSIGNED) " . $sort_order;
    } else {
        $qry .= " ORDER BY " . $sort_by . " " . $sort_order;
    }
}


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
?>

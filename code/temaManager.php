<?php

require_once 'connDb.php';

function getTemaQry($codice, $descrizione, $numeroSale): string {
    global $conn;

    $qry = "SELECT
                TEMA.codice,
                TEMA.descrizione,
                TEMA.numeroSale
            FROM
                TEMA
            WHERE
                1=1";

    if ($codice != "")
        $qry .= " AND TEMA.codice =  $codice " ; // Aggiungi apici singoli intorno al valore

    if ($descrizione != "")
        $qry .= " AND TEMA.descrizione  LIKE '%" . $descrizione . "%'" ;

    if ($titolo != "")
        $qry .= " AND TEMA.numeroSale  LIKE '%" . $numeroSale . "%'";

    return $qry;
}

//in questo file in teoria non dovrei fare altre query

?>

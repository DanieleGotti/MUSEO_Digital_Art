<?php

require_once 'connDb.php';

function getSalaQry($numero, $nome, $superficie, $temaSala, $descrizione): string {
    global $conn;

    $qry = "SELECT
                SALA.numero,
                SALA.nome,
                SALA.superficie,
                SALA.temaSala,
                TEMA.descrizione
            FROM
                SALA
            LEFT JOIN
                TEMA ON SALA.temaSala = TEMA.codice
            WHERE
                1=1";

    if ($numero != "")
        $qry .= " AND SALA.numero = '$numero'";

    if ($nome != "")
        $qry .= " AND SALA.nome LIKE '%" . $nome . "%'";

    if ($superficie != "")
        $qry .= " AND SALA.superficie LIKE '%" . $superficie . "%'";

    if ($temaSala != "")
        $qry .= " AND SALA.temaSala LIKE '%" . $temaSala . "%'";

    if ($descrizione != "")
        $qry .= " AND TEMA.descrizione LIKE '%" . $descrizione . "%'";

    return $qry;
}

//seconda query unisco autore ed opere
function getSalaQry2($numero, $nome, $superficie, $temaSala, $descrizione, $autoripresenti, $operepresenti): string {
    global $conn;

    $query2 = "SELECT
                SALA.numero,
                SALA.nome,
                SALA.superficie,
                SALA.temaSala,
                AUTORE.cognome,
                OPERA.titolo
            FROM
                SALA
            JOIN
                OPERA ON SALA.numero = OPERA.espostaInSala
            JOIN
                AUTORE ON OPERA.autore = AUTORE.codice
            

            WHERE
                1=1";

    if ($numero != "")
        $query2 .= " AND SALA.numero = '$numero'";

    if ($nome != "")
        $query2 .= " AND SALA.nome LIKE '%" . $nome . "%'";

    if ($superficie != "")
        $query2 .= " AND SALA.superficie LIKE '%" . $superficie . "%'";

    if ($temaSala != "")
        $query2 .= " AND SALA.temaSala LIKE '%" . $temaSala . "%'";

    if ($autoripresenti != "")
        $query2 .= " AND AUTORE.cognome LIKE '%" . $autoripresenti . "%' ";

    if ($operepresenti != "")
        $query2 .= " AND OPERA.titolo LIKE '%" . $operepresenti . "%'";

    return $query2;
}

?>

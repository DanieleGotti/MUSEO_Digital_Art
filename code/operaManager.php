<?php

require_once 'connDb.php';

function getOperaQry($opera, $autore,$nome, $cognome, $titolo, $annoAcquisto, $annoRealizzazione, $tipo, $espostaInSala): string {
    global $conn;

    $qry = "SELECT
                OPERA.opera,
                OPERA.autore,
                AUTORE.nome,
                AUTORE.cognome,
                OPERA.titolo,
                OPERA.annoAcquisto,
                OPERA.annoRealizzazione,
                OPERA.tipo,
                OPERA.espostaInSala
            FROM
                OPERA
            LEFT JOIN
                AUTORE ON OPERA.autore = AUTORE.codice
            JOIN
                SALA ON OPERA.espostaInSala = SALA.numero
            WHERE
                1=1";

    if ($opera != "")
        $qry .= " AND OPERA.opera =  $opera ";

    if ($autore != "")
        $qry .= " AND AUTORE.codice =  $autore " ;
    if ($nome != "")
        $qry .= " AND AUTORE.nome  LIKE '%" . $nome . "%'";
    if ($cognome != "")
        $qry .= " AND AUTORE.cognome LIKE '%" . $cognome . "%'";
    if ($titolo != "")
        $qry .= " AND OPERA.titolo  LIKE '%" . $titolo . "%'";
    if ($annoAcquisto != "")
        $qry .= " AND OPERA.annoAcquisto  LIKE '%" . $annoAcquisto . "%'";
    if ($annoRealizzazione != "")
        $qry .= " AND OPERA.annoRealizzazione LIKE '%" . $annoRealizzazione . "%'";

    if ($tipo != "")
        $qry .= " AND OPERA.tipo LIKE '%" . $tipo . "%'"; // Aggiungi apici singoli intorno al valore

    if ($espostaInSala != "")
        $qry .= " AND OPERA.espostaInSala = $espostaInSala";

    return $qry;
}


function getPaginatedResults($query, $page, $resultsPerPage) {
    global $conn;

    $offset = ($page - 1) * $resultsPerPage;
    $sql = $query . " LIMIT $offset, $resultsPerPage";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row["opera"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["autore"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["titolo"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["annoAcquisto"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["annoRealizzazione"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["tipo"]) . "</td>";
            echo "<td>" . htmlspecialchars($row["espostaInSala"]) . "</td>";
            echo "</tr>";
        }
    } else {
        echo "<tr><td colspan='7'>No results found.</td></tr>";
    }
}

function getTotalResults($query) {
    global $conn;

    $result = $conn->query($query);
    return $result->num_rows;
}

function getPages($totalResults, $resultsPerPage) {
    $totalPages = ceil($totalResults / $resultsPerPage);

    for ($i = 1; $i <= $totalPages; $i++) {
        echo "<a href='index.php?page={$i}'>{$i}</a> ";
    }
}
?>

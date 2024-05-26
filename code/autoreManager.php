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

function printAutoreRow($riga) {
    // Stampa i dati dell'autore e i bottoni Cancella e Modifica
    // Utilizza le informazioni della riga passata come parametro
    echo "<td >" . $riga["codice"] . "</td>";
    echo "<td >" . $riga["nome"] . "</td>";
    echo "<td >" . $riga["cognome"] . "</td>";
    echo "<td >" . $riga["nazione"] . "</td>";
    echo "<td >" . $riga["dataNascita"] . "</td>";
    echo "<td >" . $riga["dataMorte"] . "</td>";
    echo "<td >" . $riga["tipo"] . "</td>";
    echo "<td >" . $riga["numeroOpere"] . "</td>";
    echo '<td><button onclick="editAutore(' . $riga["codice"] . ')">Modifica</button></td>';
    echo '<td><button onclick="deleteAutore(' . $riga["codice"] . ')">Cancella</button></td>';
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_codice'])) {
    $codice = $_POST['delete_codice'];

    // Esegui l'operazione di eliminazione
    $queryDelete = "DELETE FROM AUTORE WHERE codice = :codice";
    $stmt = $conn->prepare($queryDelete);
    $stmt->execute(array(':codice' => $codice));

    // Verifica se l'operazione è stata eseguita con successo
    if ($stmt->rowCount() > 0) {
        echo "Autore eliminato con successo!";
    } else {
        echo "Si è verificato un errore durante l'eliminazione dell'autore.";
    }

    // Termina lo script dopo aver gestito la richiesta di eliminazione
    exit;
}


?>

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

function sanitizeInput($input) {
    // Definisci una whitelist di caratteri accettabili per ciascun campo
    $whitelist = array(
        'codice' => '/^\d+$/', // Solo numeri per il codice
        'nome' => '/^[a-zA-Z\s]+$/',
        'cognome' => '/^[a-zA-Z\s]+$/',
        'nazione' => '/^[a-zA-Z\s]+$/',
        'dataNascita' => '/^\d{4}-\d{2}-\d{2}$/', // Formato data YYYY-MM-DD
        'dataMorte' => '/^\d{4}-\d{2}-\d{2}$/', // Formato data YYYY-MM-DD
        'tipo' => '/^[a-zA-Z\s]+$/',
        'numeroOpere' => '/^\d+$/'
        // Aggiungi gli altri campi...
    );

    // Controlla se l'input corrisponde alla whitelist per ciascun campo
    foreach ($input as $key => $value) {
        if (!empty($value) && !preg_match($whitelist[$key], $value)) {
            // Se l'input non corrisponde alla whitelist, restituisci un messaggio di errore
            return "Il campo '$key' contiene caratteri non validi.";
        }
    }

    // Se tutti i controlli passano, restituisci l'input pulito
    return $input;
}

// Utilizza la funzione sanitizeInput per pulire l'input prima di utilizzarlo
$input = array(
    'codice' => $codice,
    'nome' => $nome,
    'cognome' => $cognome,
    'nazione' => $nazione,
    'dataNascita' => $dataNascita,
    'dataMorte' => $dataMorte,
    'tipo' => $tipo,
    'numeroOpere' => $numeroOpere
);

$sanitizedInput = sanitizeInput($input);

if (is_string($sanitizedInput)) {
    // Se sanitizeInput restituisce una stringa, si è verificato un errore
    echo $sanitizedInput;
} else {
    // Altrimenti, utilizza l'input pulito
    $codice = $sanitizedInput['codice'];
    $nome = $sanitizedInput['nome'];
    $cognome = $sanitizedInput['cognome'];
    $nazione = $sanitizedInput['nazione'];
    $dataNascita = $sanitizedInput['dataNascita'];
    $dataMorte = $sanitizedInput['dataMorte'];
    $tipo = $sanitizedInput['tipo'];
    $numeroOpere = $sanitizedInput['numeroOpere'];
    // Utilizza gli altri campi puliti...
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

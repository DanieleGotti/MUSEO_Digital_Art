<?php
// Connessione al database
require_once 'connDb.php';

// Recupero dei valori dal form
$codice = $_POST['codice'];
$nome = $_POST['nome'];
$cognome = $_POST['cognome'];
$nazione = $_POST['nazione'];
$dataNascita = $_POST['dataNascita'];
$dataMorte = $_POST['dataMorte'];
$tipo = $_POST['tipo'];

// Query per verificare se il codice inserito è maggiore di tutti gli altri ID
$queryMaxCodice = "SELECT MAX(codice) AS max_codice FROM AUTORE";
$resultMaxCodice = $conn->query($queryMaxCodice);
$maxCodiceRow = $resultMaxCodice->fetch(PDO::FETCH_ASSOC);
$maxCodice = $maxCodiceRow['max_codice'];

if ($codice <= $maxCodice) {
    echo "Il codice inserito non è maggiore di tutti gli altri ID. Inserimento non riuscito.";
} else {
    // Query per l'inserimento dei dati nella tabella AUTORE
    $queryInsert = "INSERT INTO AUTORE (codice, nome, cognome, nazione, dataNascita, dataMorte, numeroOpere, tipo)
                    VALUES ('$codice', '$nome', '$cognome', '$nazione', '$dataNascita', '$dataMorte', '$tipo')";

    // Esecuzione della query di inserimento
    if ($conn->exec($queryInsert)) {
        echo "Inserimento riuscito!";
    } else {
        echo "Si è verificato un errore durante l'inserimento nel database.";
    }
}

// Chiudi la connessione al database
$conn = null;
?>

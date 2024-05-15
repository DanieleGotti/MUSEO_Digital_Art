<?php
// Connessione al database
require_once 'connDb.php';

// Recupero dei valori dal form
$codicecreate = isset($_POST['codicecreate']) ? $_POST['codicecreate'] : '';
$nomecreate = isset($_POST['nomecreate']) ? $_POST['nomecreate'] : '';
$cognomecreate = isset($_POST['cognomecreate']) ? $_POST['cognomecreate'] : '';
$nazionecreate = isset($_POST['nazionecreate']) ? $_POST['nazionecreate'] : '';
$dataNascitacreate = isset($_POST['dataNascitacreate']) ? $_POST['dataNascitacreate'] : '';
$dataMortecreate = isset($_POST['dataMortecreate']) ? $_POST['dataMortecreate'] : '';

// Verifica se tutti i campi sono stati inviati
if (empty($codicecreate) || empty($nomecreate) || empty($cognomecreate) || empty($nazionecreate) || empty($dataNascitacreate) {
    echo "Per favore, compila tutti i campi.";
    exit; // Controlla che questa istruzione sia correttamente posizionata e non vi siano parentesi mancanti sopra
}


try {
    // Query per l'inserimento dei dati nella tabella AUTORE
    $queryInsert = "INSERT INTO AUTORE (codice, nome, cognome, nazione, dataNascita, dataMorte, numeroOpere, tipo)
                    VALUES (:codicecreate, :nomecreate, :cognomecreate, :nazionecreate, :dataNascitacreate, :dataMortecreate, NULL, NULL)";

    // Preparazione della query
    $stmt = $conn->prepare($queryInsert);

    // Esecuzione della query di inserimento
    $stmt->execute(array(
        ':codicecreate' => $codicecreate,
        ':nomecreate' => $nomecreate,
        ':cognomecreate' => $cognomecreate,
        ':nazionecreate' => $nazionecreate,
        ':dataNascitacreate' => $dataNascitacreate,
        ':dataMortecreate' => $dataMortecreate
    ));

    // Verifica se l'inserimento è avvenuto con successo
    if ($stmt->rowCount() > 0) {
        echo "Inserimento riuscito!";
    } else {
        echo "Si è verificato un errore durante l'inserimento nel database.";
    }
} catch (PDOException $e) {
    // Gestione degli errori
    echo "Si è verificato un errore durante l'inserimento nel database: " . $e->getMessage();
}

// Chiudi la connessione al database
$conn = null;
?>

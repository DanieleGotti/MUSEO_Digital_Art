<?php
// Connessione al database
require_once 'connDb.php';

// Recupero del codice dalla richiesta POST
$codice = isset($_POST['codice']) ? $_POST['codice'] : '';

// Recupero degli altri valori dal form
$nomecreate = isset($_POST['nomecreate']) ? $_POST['nomecreate'] : '';
$cognomecreate = isset($_POST['cognomecreate']) ? $_POST['cognomecreate'] : '';
$nazionecreate = isset($_POST['nazionecreate']) ? $_POST['nazionecreate'] : '';
$dataNascitacreate = isset($_POST['dataNascitacreate']) ? $_POST['dataNascitacreate'] : '';
$dataMortecreate = isset($_POST['dataMortecreate']) ? $_POST['dataMortecreate'] : '';

// Verifica se la data di nascita è nel formato corretto (dd/mm/yyyy)
if (!empty($dataNascitacreate) && !preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $dataNascitacreate)) {
    echo "<script>alert('La data di nascita non è nel formato corretto (dd/mm/yyyy).'); window.history.back();</script>";
    exit;
}

// Verifica se la data di morte è nel formato corretto (dd/mm/yyyy)
if (!empty($dataMortecreate) && !preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $dataMortecreate)) {
    echo "<script>alert('La data di morte non è nel formato corretto (dd/mm/yyyy).'); window.history.back();</script>";
    exit;
}

// Impostazione del tipo in base alla presenza della data di morte
$tipo = empty($dataMortecreate) ? 'vivo' : 'morto';

// Verifica se la data di morte è stata modificata in modo da essere vuota e cambia il tipo di conseguenza
if (!empty($dataMortecreate) && $tipo === 'morto') {
    $tipo = 'morto';
} else {
    $tipo = 'vivo';
}

// Costruzione della query di aggiornamento
$queryUpdate = "UPDATE AUTORE SET ";
$bindParams = array();

// Aggiunta dei campi da aggiornare alla query
if (!empty($nomecreate)) {
    $queryUpdate .= "nome = :nomecreate, ";
    $bindParams[':nomecreate'] = $nomecreate;
}
if (!empty($cognomecreate)) {
    $queryUpdate .= "cognome = :cognomecreate, ";
    $bindParams[':cognomecreate'] = $cognomecreate;
}
if (!empty($nazionecreate)) {
    $queryUpdate .= "nazione = :nazionecreate, ";
    $bindParams[':nazionecreate'] = $nazionecreate;
}
if (!empty($dataNascitacreate)) {
    $queryUpdate .= "dataNascita = :dataNascitacreate, ";
    $bindParams[':dataNascitacreate'] = $dataNascitacreate;
}
if (!empty($dataMortecreate)) {
    $queryUpdate .= "dataMorte = :dataMortecreate, ";
    $bindParams[':dataMortecreate'] = $dataMortecreate;
}
$queryUpdate .= "tipo = :tipo WHERE codice = :codice";

// Verifica se è stato inserito almeno un campo da aggiornare
if (count($bindParams) == 0) {
    echo "<script>alert('Nessun dato da aggiornare.'); window.history.back();</script>";
    exit;
}

try {
    // Preparazione della query
    $stmt = $conn->prepare($queryUpdate);

    // Esecuzione della query di aggiornamento
    $stmt->execute(array_merge($bindParams, array(':tipo' => $tipo, ':codice' => $codice)));

    // Verifica se l'aggiornamento è avvenuto con successo
    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Aggiornamento riuscito!'); window.location.href = 'autore.php';</script>";
    } else {
        echo "<script>alert('Nessuna modifica effettuata.'); window.history.back();</script>";
    }
} catch (PDOException $e) {
    // Gestione degli errori
    echo "<script>alert('Si è verificato un errore durante l\'aggiornamento nel database: " . $e->getMessage() . "'); window.history.back();</script>";
}

// Chiudi la connessione al database
$conn = null;
?>

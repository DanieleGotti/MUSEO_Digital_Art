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
$tipo = empty($dataMortecreate) ? 'Vivo' : 'Morto';

// Costruzione della query di aggiornamento
$fieldsToUpdate = [];
$bindParams = [];

// Aggiunta dei campi da aggiornare alla query
if (!empty($nomecreate)) {
    $fieldsToUpdate[] = "nome = :nomecreate";
    $bindParams[':nomecreate'] = $nomecreate;
}
if (!empty($cognomecreate)) {
    $fieldsToUpdate[] = "cognome = :cognomecreate";
    $bindParams[':cognomecreate'] = $cognomecreate;
}
if (!empty($nazionecreate)) {
    $fieldsToUpdate[] = "nazione = :nazionecreate";
    $bindParams[':nazionecreate'] = $nazionecreate;
}
if (!empty($dataNascitacreate)) {
    $fieldsToUpdate[] = "dataNascita = :dataNascitacreate";
    $bindParams[':dataNascitacreate'] = $dataNascitacreate;
}
if (!empty($dataMortecreate)) {
    $fieldsToUpdate[] = "dataMorte = :dataMortecreate";
    $bindParams[':dataMortecreate'] = $dataMortecreate;
}

// Verifica se è stato inserito almeno un campo da aggiornare
if (empty($fieldsToUpdate)) {
    echo "<script>alert('Nessun dato da aggiornare.'); window.history.back();</script>";
    exit;
}

$fieldsToUpdate[] = "tipo = :tipo";
$bindParams[':tipo'] = $tipo;
$bindParams[':codice'] = $codice;

// Costruzione della query finale
$queryUpdate = "UPDATE AUTORE SET " . implode(", ", $fieldsToUpdate) . " WHERE codice = :codice";

// Debug: Verifica la query finale e i parametri di binding
error_log("Query Update: $queryUpdate");
foreach ($bindParams as $key => $value) {
    error_log("Binding param $key: $value");
}

try {
    // Preparazione della query
    $stmt = $conn->prepare($queryUpdate);

    // Bind dei parametri
    foreach ($bindParams as $key => $value) {
        $stmt->bindValue($key, $value);
    }

    // Esecuzione della query di aggiornamento
    $stmt->execute();

    // Debug: Verifica il numero di righe modificate
    error_log("Row count: " . $stmt->rowCount());

    // Verifica se l'aggiornamento è avvenuto con successo
    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Aggiornamento riuscito!'); window.location.href = 'autore.php';</script>";
    } else {
        echo "<script>alert('Nessuna modifica effettuata.'); window.history.back();</script>";
    }
} catch (PDOException $e) {
    // Gestione degli errori
    echo "<script>alert('Si è verificato un errore durante l\'aggiornamento nel database: " . $e->getMessage() . "'); window.history.back();</script>";
    error_log("Errore PDO: " . $e->getMessage());
}

// Chiudi la connessione al database
$conn = null;
?>

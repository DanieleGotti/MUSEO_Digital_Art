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

// Impostazione del tipo in base alla presenza della data di morte
$tipo = empty($dataMortecreate) ? 'Vivo' : 'Morto';

if (empty($codicecreate) || empty($nomecreate) || empty($cognomecreate) || empty($nazionecreate) || empty($dataNascitacreate)) {
  echo "<script>alert('Per favore, compila tutti i campi.'); window.history.back();</script>";
  exit;
}

// Verifica se le date hanno il formato corretto
$formatoDataValido = "/^\d{2}\/\d{2}\/\d{4}$/"; // Formato gg/mm/aaaa
if (!preg_match($formatoDataValido, $dataNascitacreate) || (!empty($dataMortecreate) && !preg_match($formatoDataValido, $dataMortecreate))) {
  echo "<script>alert('Il formato della data di nascita o di morte non è valido. Utilizzare il formato gg/mm/aaaa.'); window.history.back();</script>";
  exit;
}


try {
  // Controllo del codice
  $queryCodiceExists = "SELECT COUNT(*) FROM AUTORE WHERE codice = :codice";
  $stmtCodiceExists = $conn->prepare($queryCodiceExists);
  $stmtCodiceExists->execute(array(':codice' => $codicecreate));
  $codiceExists = $stmtCodiceExists->fetchColumn();

  // Controllo di nome e cognome
  $queryNomeCognomeExists = "SELECT COUNT(*) FROM AUTORE WHERE nome = :nome AND cognome = :cognome";
  $stmtNomeCognomeExists = $conn->prepare($queryNomeCognomeExists);
  $stmtNomeCognomeExists->execute(array(':nome' => $nomecreate, ':cognome' => $cognomecreate));
  $nomeCognomeExists = $stmtNomeCognomeExists->fetchColumn();

  // Verifica dei risultati dei controlli
  if ($codiceExists > 0) {
    echo "<script>alert('Il codice esiste già nel database.'); window.history.back();</script>";
  } elseif ($nomeCognomeExists > 0) {
    echo "<script>alert('Esiste già un autore con lo stesso nome e cognome nel database.'); window.history.back();</script>";
  } else {
    // Chiedi conferma all'utente
    $confirmation = "<script>var confirmation = confirm('Sei sicuro di voler procedere con l\'inserimento?'); if (!confirmation) { window.history.back(); }</script>";
    echo $confirmation;

    // Se l'utente conferma, procedi con l'inserimento
    if ($confirmation) {
      // Query per l'inserimento dei dati nella tabella AUTORE
      $queryInsert = "INSERT INTO AUTORE (codice, nome, cognome, nazione, dataNascita, dataMorte, tipo)
      VALUES (:codicecreate, :nomecreate, :cognomecreate, :nazionecreate, :dataNascitacreate, :dataMortecreate, :tipo)";

      // Preparazione della query
      $stmt = $conn->prepare($queryInsert);

      // Esecuzione della query di inserimento
      $stmt->execute(array(
        ':codicecreate' => $codicecreate,
        ':nomecreate' => $nomecreate,
        ':cognomecreate' => $cognomecreate,
        ':nazionecreate' => $nazionecreate,
        ':dataNascitacreate' => $dataNascitacreate,
        ':dataMortecreate' => $dataMortecreate,
        ':tipo' => $tipo
      ));

      // Verifica se l'inserimento è avvenuto con successo
      if ($stmt->rowCount() > 0) {
        echo "<script>alert('Inserimento riuscito!'); window.location.href = 'autore.php';</script>";
      } else {
        echo "<script>alert('Si è verificato un errore durante inserimento nel database.'); window.history.back();</script>";
      }
    }
  }
} catch (PDOException $e) {
  // Gestione degli errori
  echo "<script>alert('Si è verificato un errore durante inserimento nel database: " . $e->getMessage() . "'); window.history.back();</script>";
}

// Chiudi la connessione al database
$conn = null;
?>

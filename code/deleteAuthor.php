<?php
require_once 'connDb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['codice'])) {
    $codice = $_POST['codice'];

    // Esegui l'operazione di eliminazione
    $queryDelete = "DELETE FROM AUTORE WHERE codice = :codice";
    $stmt = $conn->prepare($queryDelete);
    $stmt->execute(array(':codice' => $codice));

    // Verifica se l'operazione è stata eseguita con successo
    if ($stmt->rowCount() > 0) {
        echo "successo"; // Invia una risposta di successo
    } else {
        echo "errore"; // Invia una risposta di errore
    }
}
?>

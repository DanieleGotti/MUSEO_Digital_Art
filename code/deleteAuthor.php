<?php
require_once 'connDb.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['codice'])) {
    $codice = $_POST['codice'];

    try {
        // Inizia una transazione
        $conn->beginTransaction();

        // Esegui l'operazione di eliminazione degli autori
        $queryDeleteAutore = "DELETE FROM AUTORE WHERE codice = :codice";
        $stmtAutore = $conn->prepare($queryDeleteAutore);
        $stmtAutore->execute(array(':codice' => $codice));

        // Esegui l'operazione di eliminazione delle opere associate all'autore
        $queryDeleteOpere = "DELETE FROM OPERA WHERE autore = :codice";
        $stmtOpere = $conn->prepare($queryDeleteOpere);
        $stmtOpere->execute(array(':codice' => $codice));

        // Verifica se entrambe le operazioni sono state eseguite con successo
        if ($stmtAutore->rowCount() > 0 && $stmtOpere->rowCount() > 0) {
            // Conferma la transazione
            $conn->commit();
            echo "<script>alert('Eliminazione riuscita!'); window.location.href = 'autore.php';</script>"; // Invia una risposta di successo
        } else {
            // Annulla la transazione
            $conn->rollBack();
            echo "<script>alert('Errore durante l\'eliminazione. Riprova più tardi.'); window.location.href = 'autore.php';</script>"; // Invia una risposta di errore
        }
    } catch (PDOException $e) {
        // Annulla la transazione in caso di errore
        $conn->rollBack();
        echo "<script>alert('Errore durante l\'eliminazione: " . $e->getMessage() . "'); window.location.href = 'autore.php';</script>"; // Invia una risposta di errore con il messaggio dell'eccezione
    }
}
?>

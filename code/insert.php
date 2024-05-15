<?php
require_once 'connDb.php';

// Get the query from the AJAX request
$query = $_POST['query'];

// Execute the query
try {
  $conn->query($query);
  echo "Autore inserito con successo.";
} catch(PDOException $e) {
  echo "Errore nell'inserimento dell'autore: " . $e->getMessage();
}
?>

<?php

require_once 'connDb.php';

function getTemaCard( $codice){
    global $conn;

$query ="SELECT TEMA.descrizione, TEMA.codice FROM TEMA WHERE TEMA.codice = 2";
try {
  $result = $conn->query($query);
} catch (PDOException $e) {
  echo "<p>DB Error on Query: " . $e->getMessage() . "</p>";
  $error = true;
}

if (!$error) {
?>

  <table class="table">

    <?php
    $i = 0;

    foreach ($result as $riga) {
      $i++;
      $classRiga = 'class="rowOdd"';
      if ($i % 2 == 0) {
        $classRiga = 'class="rowEven"';
      }
      $codice = $riga["codice"];
      $descrizione = $riga["descrizione"];

    ?>

    <?php } ?>
  </table>
<?php }
return $descrizione;
 ?>
}

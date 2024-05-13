<!DOCTYPE HTML>
<html>
<head>
  <title>MUSEO START</title>
  <link rel="stylesheet" href="./css/cssStyle.css">
  <script type="text/javascript" src="./js/jquery-2.0.0.js"></script>
  <script type="text/javascript" src="./js/codices.js"></script>
  <!--<link rel="stylesheet" href="./css/videoclips.css">-->
  <!--<script type="text/javascript" src="./js/jquery-2.0.0.js"></script>-->
  <!--<script type="text/javascript" src="./js/videoclips.js"></script>-->
</head>

<body>

  <?php
  include 'header.html';
  include 'nav.html';
  include 'footer.html'
  ?>

  <div id="filtri">
    <form name="myform" method="POST">
      <input id="codice" name="codice" type="text" placeholder="codice"/>
      <input id="nome" name="nome" type="text" placeholder="Nome"/>
      <input id="cognome" name="cognome" type="text" placeholder="Cognome"/>
      <input id="nazione" name="nazione" type="text" placeholder="Nazione"/>
      <input id="annoNascita" name="annoNascita" type="text" placeholder="Anno Nascita"/>
      <input id="annoMorte" name="annoMorte" type="text" placeholder="Anno Morte"/>
        <input id="tipo" name="tipo" type="text" placeholder="Stato"/>
      <input id="numeroOpere" name="numeroOpere" type="text" placeholder="Numero Opere"/>
      <input type="submit" value="Search"/>
    </form>

    <div id="result">
      <?php

      $codice = "";
      $nome = "";
      $cognome  = "";
      $nazione = "";
      $annoNascita  = "";
      $annoMorte = "";
        $tipo = "";
      $numeroOpere  = "";

      if(count($_POST)>0) {
        $codice = $_POST["codice"];
        $nome = $_POST["nome"];
        $cognome  = $_POST["cognome"];
        $nazione = $_POST["nazione"];
        $annoNascita  = $_POST["annoNascita"];
        $annoMorte = $_POST["annoMorte"];
        $tipo = $_POST["tipo"];
        $numeroOpere  = $_POST["numeroOpere"];
      }
      else if(count($_GET)>0) {
        $codice = $_GET["codice"];
        $nome = $_GET["nome"];
        $cognome  = $_GET["cognome"];
        $nazione = $_GET["nazione"];
        $annoNascita  = $_GET["annoNascita"];
        $annoMorte = $_GET["annoMorte"];
        $tipo = $_GET["tipo"];
        $numeroOpere  = $_GET["numeroOpere"];
      }
      include 'autoreManager.php';
      $error = false; // Inizializza la variabile $error a false

      require_once 'connDb.php';
      $query = getAutoreQry ($codice,	$nome, $cognome ,$nazione,$annoNascita, $annoMorte,$tipo, $numeroOpere);
      echo "<p>codiceQuery: " . $query . "</p>";



      try {
        $result = $conn->query($query);
      } catch(PDOException $e) {
        echo "<p>DB Error on Query: " . $e->getMessage() . "</p>";
        $error = true;
      }

      if(!$error) {
        ?>

        <table class="table">
          <tr class="header">
            <!--th>id </th-->
            <th>Codice</th>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Nazione</th>
            <th>Anno Nascitae</th>
            <th>Anno Morte</th>
            <th>Tipo</th>
            <th>Numermo Opere</th>
          </tr>
          <?php
          $i=0;

          foreach($result as $riga) {
            $i=$i+1;
            $classRiga='class="rowOdd"';
            if($i%2==0) {
              $classRiga='class="rowEven"';
            }
            $codice = $riga["codice"];
            $nome = $riga["nome"];
            $cognome  = $riga["cognome"];
            $nazione = $riga["nazione"];
            $annoNascita  = $riga["annoNascita"];
            $annoMorte = $riga["annoMorte"];
            $tipo = $riga["tipo"];
            $numeroOpere  = $riga["numeroOpere"];

            ?>
            <tr <?php	echo $classRiga; ?> >

              <td > <?php echo $codice; ?> </td>
              <td > <?php echo $nome; ?> </td>
              <td > <?php echo $cognome; ?> </td>
              <td > <?php echo $nazione; ?> </td>
              <td > <?php echo $annoNascita; ?> </td>
              <td > <?php echo $annoMorte; ?> </td>
                <td > <?php echo $tipo; ?> </td>
              <td > <?php echo $numeroOpere; ?> </td>
            </tr>
          <?php } ?>
        </table>
      <?php }  ?>

    </div>
  </div>
</body>
</html>

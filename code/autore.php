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

  include 'nav.html';
  include 'footer.html'
  ?>

  <div id="filtri">
    <form name="myform" method="POST">
      <input id="codice" name="codice" type="text" placeholder="codice"/>
      <input id="nome" name="nome" type="text" placeholder="Nome"/>
      <input id="cognome" name="cognome" type="text" placeholder="Cognome"/>
      <input id="nazione" name="nazione" type="text" placeholder="Nazione"/>
      <input id="dataNascita" name="dataNascita" type="text" placeholder="data Nascita"/>
      <input id="dataMorte" name="dataMorte" type="text" placeholder="data Morte"/>

      <input id="numeroOpere" name="numeroOpere" type="text" placeholder="Numero Opere"/>
      <input id="tipo_vivo" name="tipo" type="radio" value="vivo">
      <label for="tipo_vivo">Vivo</label>
      <input id="tipo_morto" name="tipo" type="radio" value="morto">
      <label for="tipo_morto">Morto</label>
      <input type="submit" value="Search"/>
      <input type="submit" value="RESET"/>
    </form>

      <form name="myform2" method="post">
    <input id="opera" name="nomeopera" type="text" placeholder="Titolo dell'opera">
    <input type="submit" value="Cerca per opera">
</form>

    <div id="result">
      <?php

      $codice = "";
      $nome = "";
      $cognome  = "";
      $nazione = "";
      $dataNascita  = "";
      $dataMorte = "";
        $tipo = "";
      $numeroOpere  = "";
      $nomeopera="";

      if(count($_POST)>0) {
        $codice = $_POST["codice"];
        $nome = $_POST["nome"];
        $cognome  = $_POST["cognome"];
        $nazione = $_POST["nazione"];
        $dataNascita  = $_POST["dataNascita"];
        $dataMorte = $_POST["dataMorte"];
        $tipo = $_POST["tipo"];
        $numeroOpere  = $_POST["numeroOpere"];
        $nomeopera  = $_POST["nomeopera"];
      }
      else if(count($_GET)>0) {
        $codice = $_GET["codice"];
        $nome = $_GET["nome"];
        $cognome  = $_GET["cognome"];
        $nazione = $_GET["nazione"];
        $dataNascita  = $_GET["dataNascita"];
        $dataMorte = $_GET["dataMorte"];
        $tipo = $_GET["tipo"];
        $numeroOpere  = $_GET["numeroOpere"];
        $nomeopera  = $_GET["nomeopera"];
      }
      include 'autoreManager.php';
      $error = false; // Inizializza la variabile $error a false

      require_once 'connDb.php';
      $query = getAutoreQry ($codice,	$nome, $cognome ,$nazione,$dataNascita, $dataMorte,$tipo, $numeroOpere, $nomeopera);




      try {
        $result = $conn->query($query);
      } catch(PDOException $e) {
        echo "<p>DB Error on Query: " . $e->getMessage() . "</p>";
        $error = true;
      }

      if(!$error && $nomeopera!="") {
        ?>

        <table class="table">
          <tr class="header">
            <!--th>id </th-->
            <th>Codice</th>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Nazione</th>
            <th>Data Nascita</th>
            <th>Data Morte</th>
            <th>Tipo</th>
            <th>Numero Opere</th>
            <th>Titolo Opera</th>
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
            $dataNascita  = $riga["dataNascita"];
            $dataMorte = $riga["dataMorte"];
            $tipo = $riga["tipo"];
            $numeroOpere  = $riga["numeroOpere"];
            $nomeopera  = $riga["nomeopera"];

            ?>
            <tr <?php	echo $classRiga; ?> >

              <td > <?php echo $codice; ?> </td>
              <td > <?php echo $nome; ?> </td>
              <td > <?php echo $cognome; ?> </td>
              <td > <?php echo $nazione; ?> </td>
              <td > <?php echo $dataNascita; ?> </td>
              <td > <?php echo $dataMorte; ?> </td>
              <td > <?php echo $tipo; ?> </td>
              <td > <?php echo $numeroOpere; ?> </td>
              <td > <?php echo $nomeopera; ?> </td>
            </tr>
          <?php } ?>
        </table>
      <?php }
      if(!$error && $nomeopera=="") {
        ?>

        <table class="table">
          <tr class="header">
            <!--th>id </th-->
            <th>Codice</th>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Nazione</th>
            <th>Data Nascita</th>
            <th>Data Morte</th>
            <th>Tipo</th>
            <th>Numero Opere</th>
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
            $dataNascita  = $riga["dataNascita"];
            $dataMorte = $riga["dataMorte"];
            $tipo = $riga["tipo"];
            $numeroOpere  = $riga["numeroOpere"];

            ?>
            <tr <?php	echo $classRiga; ?> >

              <td > <?php echo $codice; ?> </td>
              <td > <?php echo $nome; ?> </td>
              <td > <?php echo $cognome; ?> </td>
              <td > <?php echo $nazione; ?> </td>
              <td > <?php echo $dataNascita; ?> </td>
              <td > <?php echo $dataMorte; ?> </td>
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

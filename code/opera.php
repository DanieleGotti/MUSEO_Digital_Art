<!DOCTYPE HTML>
<html>
<head>
  <title>MUSEO START</title>
  <link rel="stylesheet" href="./css/cssStyle.css">
  <script type="text/javascript" src="./js/jquery-2.0.0.js"></script>
  <script type="text/javascript" src="./js/operas.js"></script>
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
      <input id="opera" name="opera" type="text" placeholder="IdOpera"/>
      <input id="autore" name="autore" type="text" placeholder="Autore"/>
      <input id="titolo" name="titolo" type="text" placeholder="Titolo Opera"/>
      <input id="annoAcquisto" name="annoAcquisto" type="text" placeholder="Anno Acquisizione"/>
      <input id="annoRealizzazione" name="annoRealizzazione" type="text" placeholder="Anno Realizzazione"/>
      <input id="tipo" name="tipo" type="text" placeholder="Tipo Opera"/>
      <input id="espostaInSala" name="espostaInSala" type="text" placeholder="Esposta In Sala"/>
      <input type="submit" value="Search"/>
    </form>

    <div id="result">
      <?php

      $opera = "";
      $autore = "";
      $titolo  = "";
      $annoAcquisto = "";
      $annoRealizzazione  = "";
      $tipo = "";
      $espostaInSala  = "";

      if(count($_POST)>0) {
        $opera = $_POST["opera"];
        $autore = $_POST["autore"];
        $titolo  = $_POST["titolo"];
        $annoAcquisto = $_POST["annoAcquisto"];
        $annoRealizzazione  = $_POST["annoRealizzazione"];
        $tipo = $_POST["tipo"];
        $espostaInSala  = $_POST["espostaInSala"];
      }
      else if(count($_GET)>0) {
        $opera = $_GET["opera"];
        $autore = $_GET["autore"];
        $titolo  = $_GET["titolo"];
        $annoAcquisto = $_GET["annoAcquisto"];
        $annoRealizzazione  = $_GET["annoRealizzazione"];
        $tipo = $_GET["tipo"];
        $espostaInSala  = $_GET["espostaInSala"];
      }
      include 'operaManager.php';
      $error = false; // Inizializza la variabile $error a false

      require_once 'connDb.php';
      $query = getOperaQry ($opera,	$autore, $titolo ,$annoAcquisto,$annoRealizzazione, $tipo, $espostaInSala);
      echo "<p>OperaQuery: " . $query . "</p>";



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
            <th>idOpera</th>
            <th>Autore</th>
            <th>Titolo</th>
            <th>Anno Acquisizione</th>
            <th>Anno Realizzazione</th>
            <th>Tipo</th>
            <th>espostaInSala</th>
          </tr>
          <?php
          $i=0;

          foreach($result as $riga) {
            $i=$i+1;
            $classRiga='class="rowOdd"';
            if($i%2==0) {
              $classRiga='class="rowEven"';
            }
            $opera = $riga["opera"];
            $autore = $riga["autore"];
            $titolo  = $riga["titolo"];
            $annoAcquisto = $riga["annoAcquisto"];
            $annoRealizzazione  = $riga["annoRealizzazione"];
            $tipo = $riga["tipo"];
            $espostaInSala  = $riga["espostaInSala"];

            ?>
            <tr <?php	echo $classRiga; ?> >

              <td > <?php echo $opera; ?> </td>
              <td > <?php echo $autore; ?> </td>
              <td > <?php echo $titolo; ?> </td>
              <td > <?php echo $annoAcquisto; ?> </td>
              <td > <?php echo $annoRealizzazione; ?> </td>
              <td > <?php echo $tipo; ?> </td>
              <td > <?php echo $espostaInSala; ?> </td>
            </tr>
          <?php } ?>
        </table>
      <?php }  ?>

    </div>
  </div>
</body>
</html>

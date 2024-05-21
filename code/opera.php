<!DOCTYPE HTML>
<html>
<head>
  <title>MUSEO START</title>
  <link rel="stylesheet" href="./css/cssStyle.css">
  <script type="text/javascript" src="./js/jquery-2.0.0.js"></script>
  <script type="text/javascript" src="./js/operas.js"></script>
</head>

<body>

  <?php
  include 'nav.html';
  include 'footer.html';
  ?>

  <div id="filtri">
    <form name="myform" method="POST">
      <input id="opera" name="opera" type="text" placeholder="IdOpera"/>
      <input id="autore" name="autore" type="text" placeholder="Autore ID"/>
      <input id="nome" name="nome" type="text" placeholder="Nome Autore"/>
      <input id="cognome" name="cognome" type="text" placeholder="Cognome Autore"/>
      <input id="titolo" name="titolo" type="text" placeholder="Titolo Opera"/>
      <input id="annoAcquisto" name="annoAcquisto" type="text" placeholder="Anno Acquisizione"/>
      <input id="annoRealizzazione" name="annoRealizzazione" type="text" placeholder="Anno Realizzazione"/>

      <input id="tipo_scultura" name="tipo" type="radio" value="scultura" />
      <label for="tipo_scultura">Scultura</label>
      <input id="tipo_quadro" name="tipo" type="radio" value="quadro" />
      <label for="tipo_quadro">Quadro</label>

      <input id="espostaInSala" name="espostaInSala" type="text" placeholder="Esposta In Sala"/>
      <input type="submit" value="Search"/>
      <input type="submit" value="RESET"/>
    </form>

    <div id="result">
      <?php
      $opera = "";
      $autore = "";
      $nome = "";
      $cognome  = "";
      $titolo  = "";
      $annoAcquisto = "";
      $annoRealizzazione  = "";
      $tipo = "";
      $espostaInSala  = "";

      if (count($_POST) > 0) {
        $opera = $_POST["opera"];
        $autore = $_POST["autore"];
        $nome = $_POST["nome"];
        $cognome  = $_POST["cognome"];
        $titolo  = $_POST["titolo"];
        $annoAcquisto = $_POST["annoAcquisto"];
        $annoRealizzazione  = $_POST["annoRealizzazione"];
        $tipo = $_POST["tipo"];
        $espostaInSala  = $_POST["espostaInSala"];
      } else if (count($_GET) > 0) {
        $opera = $_GET["opera"];
        $autore = $_GET["autore"];
        $nome = $_GET["nome"];
        $cognome  = $_GET["cognome"];
        $titolo  = $_GET["titolo"];
        $annoAcquisto = $_GET["annoAcquisto"];
        $annoRealizzazione  = $_GET["annoRealizzazione"];
        $tipo = $_GET["tipo"];
        $espostaInSala  = $_GET["espostaInSala"];
      }

      include 'operaManager.php';
      $error = false; // Inizializza la variabile $error a false

      require_once 'connDb.php';
      $query = getOperaQry($opera, $autore, $nome, $cognome, $titolo, $annoAcquisto, $annoRealizzazione, $tipo, $espostaInSala);

      try {
        $result = $conn->query($query);
      } catch (PDOException $e) {
        echo "<p>DB Error on Query: " . $e->getMessage() . "</p>";
        $error = true;
      }

      if (!$error) {
      ?>

        <table class="table">
          <tr class="header">
            <th>idOpera</th>
            <th>Autore</th>
            <th>Nome</th>
            <th>Cognome</th>
            <th>Titolo</th>
            <th>Anno Acquisizione</th>
            <th>Anno Realizzazione</th>
            <th>Tipo</th>
            <th>espostaInSala</th>
          </tr>
          <?php
          $i = 0;

          foreach ($result as $riga) {
            $i++;
            $classRiga = 'class="rowOdd"';
            if ($i % 2 == 0) {
              $classRiga = 'class="rowEven"';
            }
            $opera = $riga["opera"];
            $autore = $riga["autore"];
            $nome = $riga["nome"];
            $cognome  = $riga["cognome"];
            $titolo  = $riga["titolo"];
            $annoAcquisto = $riga["annoAcquisto"];
            $annoRealizzazione  = $riga["annoRealizzazione"];
            $tipo = $riga["tipo"];
            $espostaInSala  = $riga["espostaInSala"];
          ?>
            <tr <?php echo $classRiga; ?> >
              <td><?php echo $opera; ?></td>

              <td>
    <a href="autore.php?codice=<?php echo urlencode($autore); ?>&nome=<?php echo urlencode($nome); ?>&cognome=<?php echo urlencode($cognome); ?>">
      <?php echo $autore; ?>
    </a>
  </td>
              <td><?php echo $nome; ?></td>
              <td><?php echo $cognome; ?></td>
              <td><?php echo $titolo; ?></td>
              <td><?php echo $annoAcquisto; ?></td>
              <td><?php echo $annoRealizzazione; ?></td>
              <td><?php echo $tipo; ?></td>
              <td><a href="sala.php?numero=<?php echo urlencode($espostaInSala); ?>"><?php echo $espostaInSala; ?></a></td>
            
            </tr>
          <?php } ?>
        </table>
      <?php } ?>
    </div>
  </div>
</body>
</html>

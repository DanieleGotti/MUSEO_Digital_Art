<!DOCTYPE HTML>
<html>
<head>
  <title>Opera</title>
  <link rel="stylesheet" href="./css/cssPage.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap">
  <script type="text/javascript" src="./js/jquery-2.0.0.js"></script>
  <script type="text/javascript" src="./js/jsFiltersMove.js"></script>
</head>

<body>
  <?php
  $page = 'Opere';
  include 'header.php';
  include 'nav.html';
  include 'footer.html';
  ?>

  <button id="bottoneFiltri" class="filterButton" onclick="moveFilters()"  onmouseenter="animateIcon(this)" onmouseleave="animateIcon(this)">
    <img src="../img/filtroStatica.png">
  </button>

  <div id="filtri" class="filters">
    <form name="myform" class="form" method="POST">
      <ul class="filterContainer">
        <li class="filterHeader">
          <span class="filterTitle">Filtri</span>
        </li>
        <li class="filterItem">
          <button type="submit" class="button">
            <span class="buttonText">Cerca</span>
            <span class="buttonIcon">
              <img src="../img/cerca.png">
            </span>
          </button>
          <button type="submit" class="button">
            <span class="buttonText">Reset</span>
            <span class="buttonIcon">
              <img src="../img/reset.png">
            </span>
          </button>
        </li>
        <div class="filterScroll">
          <li class="filterItem">
            <input id="opera" class="input" name="opera" type="text"/>
            <label class="placeHolder">ID Opera</label>
          </li>
          <li class="filterItem">
            <input id="titolo" class="input" name="titolo" type="text"/>
            <label class="placeHolder">Titolo</label>
          </li>
          <li class="filterItem">
            <input id="autore" class="input" name="autore" type="text"/>
            <label class="placeHolder">ID Autore</label>
          </li>
          <li class="filterItem">
            <input id="nome" class="input" name="nome" type="text"/>
          <label class="placeHolder">Nome Autore</label>
          </li>
          <li class="filterItem">
            <input id="cognome" class="input" name="cognome" type="text"/>
            <label class="placeHolder">Cognome Autore</label>
          </li>
          <li class="filterItem">
            <input id="annoAcquisto" class="input" name="annoAcquisto" type="text"/>
            <label class="placeHolder">Anno Acquisizione<label>
          </li>
          <li class="filterItem">
            <input id="annoRealizzazione" class="input" name="annoRealizzazione" type="text"/>
            <label class="placeHolder">Anno Realizzazione</label>
          </li>
          <li class="filterItem">
            <input id="espostaInSala" class="input" name="espostaInSala" type="text"/>
            <label class="placeHolder">Esposta in Sala</label>
          </li>
          <li class="filterItem">
            <input id="tipo_scultura" class="radio" name="tipo" type="radio" value="scultura"/>
            <label for="tipo_scultura" class="radioText">Scultura</label>
            <input id="tipo_quadro" class="radio" name="tipo" type="radio" value="quadro"/>
            <label for="tipo_quadro" class="radioText">Quadro</label>
          </li>
        </div>
      </ul>
    </form>
  </div>

  <div id="result" class="tableBody">
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
  }
  else if (count($_GET) > 0) {
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
  $error = false;

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

    <table>
      <thead>
        <tr>
          <th>ID OPERA
            <button class="iconArrow">
              <img src="./img/freccia.png">
            </button>
          </th>
          <th>TITOLO
            <button class="iconArrow">
              <img src="./img/freccia.png">
            </button>
          </th>
          <th>ID AUTORE
            <button class="iconArrow">
              <img src="./img/freccia.png">
            </button>
          </th>
          <th>NOME AUTORE
            <button class="iconArrow">
              <img src="./img/freccia.png">
            </button>
          </th>
          <th>COGNOME AUTORE
            <button class="iconArrow">
              <img src="./img/freccia.png">
            </button>
          </th>
          <th>ANNO ACQUISIZIONE
            <button class="iconArrow">
              <img src="./img/freccia.png">
            </button>
          </th>
          <th>ANNO REALIZZAZIONE
            <button class="iconArrow">
              <img src="./img/freccia.png">
            </button>
          </th>
          <th>TIPO
            <button class="iconArrow">
              <img src="./img/freccia.png">
            </button>
          </th>
          <th>ESPOSTA IN SALA
            <button class="iconArrow">
              <img src="./img/freccia.png">
            </button>
          </th>
        </tr>
      </thead>
      <tbody>
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
            <td><?php echo $titolo; ?></td>
            <td>
              <a href="autore.php?codice=<?php echo urlencode($autore); ?>&nome=<?php echo urlencode($nome); ?>&cognome=<?php echo urlencode($cognome); ?>">
                <?php echo $autore; ?>
              </a>
            </td>
            <td><?php echo $nome; ?></td>
            <td><?php echo $cognome; ?></td>
            <td><?php echo $annoAcquisto; ?></td>
            <td><?php echo $annoRealizzazione; ?></td>
            <td><?php echo $tipo; ?></td>
            <td>
              <a href="sala.php?numero=<?php echo urlencode($espostaInSala); ?>">
                <?php echo $espostaInSala; ?>
              </a>
            </td>
          </tr>
<?php } ?>
        </tbody>
      </table>
<?php } ?>
  </div>
</body>
</html>

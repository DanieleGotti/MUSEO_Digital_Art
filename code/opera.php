<!DOCTYPE HTML>
<html>
<head>
  <title>Opera</title>
  <link rel="stylesheet" href="./css/cssPage.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap">
  <script type="text/javascript" src="./js/jquery-2.0.0.js"></script>
  <script type="text/javascript" src="./js/jsFiltersMove.js"></script>
  <script type="text/javascript" src="./js/jsOpera.js"></script>
</head>

<body>
  <?php
  $page = 'Opere';
  include 'header.php';
  include 'nav.html';
  include 'footer.html';
  ?>
  <button id="bottoneFiltri" class="filterButton" onclick="moveFilters()" onmouseenter="animateIcon(this)" onmouseleave="animateIcon(this)">
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
            <input id="opera" class="input" name="opera" type="text" oninput="controllaOpera()"/>
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
            <label class="placeHolder">Anno Acquisizione</label>
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
            <label for="tipo_scultura" class="radioLabel">Scultura</label>
          </li>
          <li class="filterItem">
            <input id="tipo_quadro" class="radio" name="tipo" type="radio" value="quadro"/>
            <label for="tipo_quadro" class="radioLabel">Quadro</label>
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

    $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'opera';
    $sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'asc';

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
    $query = getOperaQry($opera, $autore, $nome, $cognome, $titolo, $annoAcquisto, $annoRealizzazione, $tipo, $espostaInSala,$sort_by, $sort_order);

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
            <button class="iconArrow" onclick="window.location.href='?sort_by=opera&sort_order=<?php echo $sort_by === 'opera' && $sort_order === 'asc' ? 'desc' : 'asc'; ?>&opera=<?php echo $opera; ?>&titolo=<?php echo $titolo; ?> ?>&nome=<?php echo $nome; ?>&cognome=<?php echo $cognome; ?>&annoAcquisto=<?php echo $annoAcquisto; ?>&annoRealizzazione=<?php echo $annoRealizzazione; ?>&tipo=<?php echo $tipo; ?>&espostaInSala=<?php echo $espostaInSala; ?>'">
              <img src="./img/freccia.png">
            </button>
          </th>
          <th>TITOLO
            <button class="iconArrow" onclick="window.location.href='?sort_by=titolo&sort_order=<?php echo $sort_by === 'titolo' && $sort_order === 'asc' ? 'desc' : 'asc'; ?>&opera=<?php echo $opera; ?>&titolo=<?php echo $titolo; ?>&autore=<?php echo $autore; ?>&nome=<?php echo $nome; ?>&cognome=<?php echo $cognome;  ?>&annoAcquisto=<?php echo $annoAcquisto; ?>&annoRealizzazione=<?php echo $annoRealizzazione; ?>&tipo=<?php echo $tipo; ?>&espostaInSala=<?php echo $espostaInSala; ?>'">
              <img src="./img/freccia.png">
            </button>
          </th>
          <th>ID AUTORE
            <button class="iconArrow" onclick="window.location.href='?sort_by=autore&sort_order=<?php echo $sort_by === 'autore' && $sort_order === 'asc' ? 'desc' : 'asc'; ?>&opera=<?php echo $opera; ?>&titolo=<?php echo $titolo; ?>&autore=<?php echo $autore; ?>&nome=<?php echo $nome; ?>&cognome=<?php echo $cognome; ?>&annoAcquisto=<?php echo $annoAcquisto; ?>&annoRealizzazione=<?php echo $annoRealizzazione; ?>&tipo=<?php echo $tipo; ?>&espostaInSala=<?php echo $espostaInSala; ?>'">
              <img src="./img/freccia.png">
            </button>
          </th>
          <th>NOME AUTORE
            <button class="iconArrow" onclick="window.location.href='?sort_by=nome&sort_order=<?php echo $sort_by === 'nome' && $sort_order === 'asc' ? 'desc' : 'asc'; ?>&opera=<?php echo $opera; ?>&titolo=<?php echo $titolo; ?>&autore=<?php echo $autore; ?>&nome=<?php echo $nome; ?>&cognome=<?php echo $cognome; ?>&annoAcquisto=<?php echo $annoAcquisto; ?>&annoRealizzazione=<?php echo $annoRealizzazione; ?>&tipo=<?php echo $tipo; ?>&espostaInSala=<?php echo $espostaInSala; ?>'">
              <img src="./img/freccia.png">
            </button>
          </th>
          <th>COGNOME AUTORE
            <button class="iconArrow" onclick="window.location.href='?sort_by=cognome&sort_order=<?php echo $sort_by === 'cognome' && $sort_order === 'asc' ? 'desc' : 'asc'; ?>&opera=<?php echo $opera; ?>&titolo=<?php echo $titolo; ?>&autore=<?php echo $autore; ?>&nome=<?php echo $nome; ?>&cognome=<?php echo $cognome; ?>&annoAcquisto=<?php echo $annoAcquisto; ?>&annoRealizzazione=<?php echo $annoRealizzazione; ?>&tipo=<?php echo $tipo; ?>&espostaInSala=<?php echo $espostaInSala; ?>'">
              <img src="./img/freccia.png">
            </button>
          </th>
          <th>ANNO ACQUISIZIONE
            <button class="iconArrow" onclick="window.location.href='?sort_by=annoAcquisto&sort_order=<?php echo $sort_by === 'annoAcquisto' && $sort_order === 'asc' ? 'desc' : 'asc'; ?>&opera=<?php echo $opera; ?>&titolo=<?php echo $titolo; ?>&autore=<?php echo $autore; ?>&nome=<?php echo $nome; ?>&cognome=<?php echo $cognome; ?>&annoAcquisto=<?php echo $annoAcquisto; ?>&annoRealizzazione=<?php echo $annoRealizzazione; ?>&tipo=<?php echo $tipo; ?>&espostaInSala=<?php echo $espostaInSala; ?>'">
              <img src="./img/freccia.png">
            </button>
          </th>
          <th>ANNO REALIZZAZIONE
            <button class="iconArrow" onclick="window.location.href='?sort_by=annoRealizzazione&sort_order=<?php echo $sort_by === 'annoRealizzazione' && $sort_order === 'asc' ? 'desc' : 'asc'; ?>&opera=<?php echo $opera; ?>&titolo=<?php echo $titolo; ?>&autore=<?php echo $autore; ?>&nome=<?php echo $nome; ?>&cognome=<?php echo $cognome; ?>&annoAcquisto=<?php echo $annoAcquisto; ?>&annoRealizzazione=<?php echo $annoRealizzazione; ?>&tipo=<?php echo $tipo; ?>&espostaInSala=<?php echo $espostaInSala; ?>'">
              <img src="./img/freccia.png">
            </button>
          </th>
          <th>TIPO
            <button class="iconArrow" onclick="window.location.href='?sort_by=tipo&sort_order=<?php echo $sort_by === 'tipo' && $sort_order === 'asc' ? 'desc' : 'asc'; ?>&opera=<?php echo $opera; ?>&titolo=<?php echo $titolo; ?>&autore=<?php echo $autore; ?>&nome=<?php echo $nome; ?>&cognome=<?php echo $cognome; ?>&titolo=<?php echo $titolo; ?>&annoAcquisto=<?php echo $annoAcquisto; ?>&annoRealizzazione=<?php echo $annoRealizzazione; ?>&tipo=<?php echo $tipo; ?>&espostaInSala=<?php echo $espostaInSala; ?>'">
              <img src="./img/freccia.png">
            </button>
          </th>
          <th>ESPOSTA IN SALA
            <button class="iconArrow" onclick="window.location.href='?sort_by=espostaInSala&sort_order=<?php echo $sort_by === 'espostaInSala' && $sort_order === 'asc' ? 'desc' : 'asc'; ?>&opera=<?php echo $opera; ?>&titolo=<?php echo $titolo; ?>&autore=<?php echo $autore; ?>&nome=<?php echo $nome; ?>&cognome=<?php echo $cognome; ?>&annoAcquisto=<?php echo $annoAcquisto; ?>&annoRealizzazione=<?php echo $annoRealizzazione; ?>&tipo=<?php echo $tipo; ?>&espostaInSala=<?php echo $espostaInSala; ?>'">
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

<!DOCTYPE HTML>
<html>
<head>
  <title>Sale</title>
  <link rel="stylesheet" href="./css/cssPage.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap">
  <script type="text/javascript" src="./js/jquery-2.0.0.js"></script>
  <script type="text/javascript" src="./js/jsFiltersMove.js"></script>
  <script type="text/javascript" src="./js/jsSala.js"></script>
</head>

<body>
<?php
  $page = 'Sale';
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
            <input id="numero" class="input" name="numero" type="text" oninput="controllaNumero()"/>
            <label class="placeHolder">ID Sala</label>
          </li>
          <li class="filterItem">
            <input id="nome" class="input" name="nome" type="text"/>
            <label class="placeHolder">Nome</label>
          </li>
          <li class="filterItem">
            <input id="superficie" class="input" name="superficie" type="text"/>
            <label class="placeHolder">Superficie</label>
          </li>
          <li class="filterItem">
            <input id="temaSala" class="input" name="temaSala" type="text">
            <label class="placeHolder">Tema</label>
          </li>
          <li class="filterItemLast">
            <input id="descrizione" class="input" name="descrizione" type="text"/>
            <label class="placeHolder">Descrizione</label>
          </li>
          <li>
            <form name="myform2" class="form" method="post">
              <ul class="filterContainer2">
                <li class="filterItem">
                  <input id="opera" class="input" name="nomeopera" type="text">
                  <label class="placeHolder">Titolo dell'opera</label>
                </li>
                <li class="filterItem">
                  <button type="submit" class="button">
                    <span class="buttonText">Cerca per opera</span>
                    <span class="buttonIcon">
                      <img src="../img/operaStatica.png">
                    </span>
                  </button>
                </li>
              </ul>
            </form>
          </li>
        </div>
      </ul>
    </form>
  </div>

  <div id="result" class="tableBody">
    <?php
      $numero = "";
      $nome = "";
      $superficie  = "";
      $numeroOpere = "";
      $temaSala = "";
      $descrizione = "";
      $nomeopera = "";

      $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : 'numero';
      $sort_order = isset($_GET['sort_order']) ? $_GET['sort_order'] : 'asc';

      if(count($_POST) > 0) {
        $numero = $_POST["numero"];
        $nome = $_POST["nome"];
        $superficie = $_POST["superficie"];
        $numeroOpere = $_POST["numeroOpere"];
        $temaSala = $_POST["temaSala"];
        $descrizione = $_POST["descrizione"];
        $nomeopera = $_POST["nomeopera"];
      } else if(count($_GET) > 0) {
        $numero = $_GET["numero"];
        $nome = $_GET["nome"];
        $superficie = $_GET["superficie"];
        $numeroOpere = $_GET["numeroOpere"];
        $temaSala = $_GET["temaSala"];
        $descrizione = $_GET["descrizione"];
        $nomeopera = $_GET["nomeopera"];
      }

      include 'salaManager.php';
      $error = false;

      require_once 'connDb.php';
      $query = getSalaQry($numero, $nome, $superficie, $numeroOpere, $temaSala, $descrizione, $nomeopera, $sort_by, $sort_order);

      try {
        $result = $conn->query($query);
      } catch(PDOException $e) {
        echo "<p>DB Error on Query: " . $e->getMessage() . "</p>";
        $error = true;
      }


  if(!$error&& $nomeopera!="") {
?>

<table>
<thead>
  <tr>
    <th>NUMERO SALA
      <button class="iconArrow" onclick="window.location.href='?sort_by=numero&sort_order=<?php echo $sort_by === 'numero' && $sort_order === 'asc' ? 'desc' : 'asc'; ?>&numero=<?php echo $numero; ?>&nome=<?php echo $nome; ?>&superficie=<?php echo $superficie; ?>&numeroOpere=<?php echo $numeroOpere; ?>&temaSala=<?php echo $temaSala; ?>&descrizione=<?php echo $descrizione; ?>&nomeopera=<?php echo $nomeopera; ?>'">
        <img src="./img/freccia.png">
      </button>
    </th>
    <th>NOME
      <button class="iconArrow" onclick="window.location.href='?sort_by=nome&sort_order=<?php echo $sort_by === 'nome' && $sort_order === 'asc' ? 'desc' : 'asc'; ?>&numero=<?php echo $numero; ?>&nome=<?php echo $nome; ?>&superficie=<?php echo $superficie; ?>&numeroOpere=<?php echo $numeroOpere; ?>&temaSala=<?php echo $temaSala; ?>&descrizione=<?php echo $descrizione; ?>&nomeopera=<?php echo $nomeopera; ?>'">
        <img src="./img/freccia.png">
      </button>
    </th>
    <th>SUPERFICIE
      <button class="iconArrow" onclick="window.location.href='?sort_by=superficie&sort_order=<?php echo $sort_by === 'superficie' && $sort_order === 'asc' ? 'desc' : 'asc'; ?>&numero=<?php echo $numero; ?>&nome=<?php echo $nome; ?>&superficie=<?php echo $superficie; ?>&numeroOpere=<?php echo $numeroOpere; ?>&temaSala=<?php echo $temaSala; ?>&descrizione=<?php echo $descrizione; ?>&nomeopera=<?php echo $nomeopera; ?>'">
        <img src="./img/freccia.png">
      </button>
    </th>
    <th>NUMERO OPERE
      <button class="iconArrow" onclick="window.location.href='?sort_by=numeroOpere&sort_order=<?php echo $sort_by === 'numeroOpere' && $sort_order === 'asc' ? 'desc' : 'asc'; ?>&numero=<?php echo $numero; ?>&nome=<?php echo $nome; ?>&superficie=<?php echo $superficie; ?>&numeroOpere=<?php echo $numeroOpere; ?>&temaSala=<?php echo $temaSala; ?>&descrizione=<?php echo $descrizione; ?>&nomeopera=<?php echo $nomeopera; ?>'">
        <img src="./img/freccia.png">
      </button>
    </th>
    <th>TEMA SALA
      <button class="iconArrow" onclick="window.location.href='?sort_by=temaSala&sort_order=<?php echo $sort_by === 'temaSala' && $sort_order === 'asc' ? 'desc' : 'asc'; ?>&numero=<?php echo $numero; ?>&nome=<?php echo $nome; ?>&superficie=<?php echo $superficie; ?>&numeroOpere=<?php echo $numeroOpere; ?>&temaSala=<?php echo $temaSala; ?>&descrizione=<?php echo $descrizione; ?>&nomeopera=<?php echo $nomeopera; ?>'">
        <img src="./img/freccia.png">
      </button>
    </th>
    <th>DESCRIZIONE TEMA
      <button class="iconArrow" onclick="window.location.href='?sort_by=descrizione&sort_order=<?php echo $sort_by === 'descrizione' && $sort_order === 'asc' ? 'desc' : 'asc'; ?>&numero=<?php echo $numero; ?>&nome=<?php echo $nome; ?>&superficie=<?php echo $superficie; ?>&numeroOpere=<?php echo $numeroOpere; ?>&temaSala=<?php echo $temaSala; ?>&descrizione=<?php echo $descrizione; ?>&nomeopera=<?php echo $nomeopera; ?>'">
        <img src="./img/freccia.png">
      </button>
    </th>
    <th>TITOLO OPERA
      <button class="iconArrow" onclick="window.location.href='?sort_by=nomeopera&sort_order=<?php echo $sort_by === 'nomeopera' && $sort_order === 'asc' ? 'desc' : 'asc'; ?>&numero=<?php echo $numero; ?>&nome=<?php echo $nome; ?>&superficie=<?php echo $superficie; ?>&numeroOpere=<?php echo $numeroOpere; ?>&temaSala=<?php echo $temaSala; ?>&descrizione=<?php echo $descrizione; ?>&nomeopera=<?php echo $nomeopera; ?>'">
        <img src="./img/freccia.png">
      </button>
    </th>
  </tr>
</thead>
<tbody>


<?php
  $i=0;
  foreach($result as $riga) {
    $i=$i+1;
    $classRiga='class="rowOdd"';
    if($i%2==0) {
      $classRiga='class="rowEven"';
  }
  $numero = $riga["numero"];
  $nome = $riga["nome"];
  $superficie  = $riga["superficie"];
  $numeroOpere = $riga["numeroOpere"];
  $temaSala = $riga["temaSala"];
  $descrizione = $riga["descrizione"];
  $nomeopera = $riga["nomeopera"];
?>
        <tr <?php	echo $classRiga; ?> >
          <td > <?php echo $numero; ?> </td>
          <td > <?php echo $nome; ?> </td>
          <td > <?php echo $superficie; ?> </td>
          <td>
            <a href="opera.php?espostaInSala=<?php echo urlencode($numero); ?>">
              <?php echo $numeroOpere; ?>
            </a>
          </td>
          <td>
            <a href="tema.php?codice=<?php echo urlencode($temaSala); ?>">
              <?php echo $temaSala; ?>
            </a>
          </td>
          <td > <?php echo $descrizione; ?> </td>
          <td > <?php echo $nomeopera; ?> </td>
        </tr>
<?php } ?>
      </tbody>
    </table>
<?php }

      if(!$error && $nomeopera=="") {
?>
<table>
<thead>
<tr>
  <th>NUMERO SALA
    <button class="iconArrow" onclick="window.location.href='?sort_by=numero&sort_order=<?php echo $sort_by === 'numero' && $sort_order === 'asc' ? 'desc' : 'asc'; ?>&numero=<?php echo $numero; ?>&nome=<?php echo $nome; ?>&superficie=<?php echo $superficie; ?>&numeroOpere=<?php echo $numeroOpere; ?>&temaSala=<?php echo $temaSala; ?>&descrizione=<?php echo $descrizione; ?>&nomeopera=<?php echo $nomeopera; ?>'">
      <img src="./img/freccia.png">
    </button>
  </th>
  <th>NOME
    <button class="iconArrow" onclick="window.location.href='?sort_by=nome&sort_order=<?php echo $sort_by === 'nome' && $sort_order === 'asc' ? 'desc' : 'asc'; ?>&numero=<?php echo $numero; ?>&nome=<?php echo $nome; ?>&superficie=<?php echo $superficie; ?>&numeroOpere=<?php echo $numeroOpere; ?>&temaSala=<?php echo $temaSala; ?>&descrizione=<?php echo $descrizione; ?>&nomeopera=<?php echo $nomeopera; ?>'">
      <img src="./img/freccia.png">
    </button>
  </th>
  <th>SUPERFICIE
    <button class="iconArrow" onclick="window.location.href='?sort_by=superficie&sort_order=<?php echo $sort_by === 'superficie' && $sort_order === 'asc' ? 'desc' : 'asc'; ?>&numero=<?php echo $numero; ?>&nome=<?php echo $nome; ?>&superficie=<?php echo $superficie; ?>&numeroOpere=<?php echo $numeroOpere; ?>&temaSala=<?php echo $temaSala; ?>&descrizione=<?php echo $descrizione; ?>&nomeopera=<?php echo $nomeopera; ?>'">
      <img src="./img/freccia.png">
    </button>
  </th>
  <th>NUMERO OPERE
    <button class="iconArrow" onclick="window.location.href='?sort_by=numeroOpere&sort_order=<?php echo $sort_by === 'numeroOpere' && $sort_order === 'asc' ? 'desc' : 'asc'; ?>&numero=<?php echo $numero; ?>&nome=<?php echo $nome; ?>&superficie=<?php echo $superficie; ?>&numeroOpere=<?php echo $numeroOpere; ?>&temaSala=<?php echo $temaSala; ?>&descrizione=<?php echo $descrizione; ?>&nomeopera=<?php echo $nomeopera; ?>'">
      <img src="./img/freccia.png">
    </button>
  </th>
  <th>TEMA SALA
    <button class="iconArrow" onclick="window.location.href='?sort_by=temaSala&sort_order=<?php echo $sort_by === 'temaSala' && $sort_order === 'asc' ? 'desc' : 'asc'; ?>&numero=<?php echo $numero; ?>&nome=<?php echo $nome; ?>&superficie=<?php echo $superficie; ?>&numeroOpere=<?php echo $numeroOpere; ?>&temaSala=<?php echo $temaSala; ?>&descrizione=<?php echo $descrizione; ?>&nomeopera=<?php echo $nomeopera; ?>'">
      <img src="./img/freccia.png">
    </button>
  </th>
  <th>DESCRIZIONE TEMA
    <button class="iconArrow" onclick="window.location.href='?sort_by=descrizione&sort_order=<?php echo $sort_by === 'descrizione' && $sort_order === 'asc' ? 'desc' : 'asc'; ?>&numero=<?php echo $numero; ?>&nome=<?php echo $nome; ?>&superficie=<?php echo $superficie; ?>&numeroOpere=<?php echo $numeroOpere; ?>&temaSala=<?php echo $temaSala; ?>&descrizione=<?php echo $descrizione; ?>&nomeopera=<?php echo $nomeopera; ?>'">
      <img src="./img/freccia.png">
    </button>
  </th>

</tr>
</thead>
<tbody>
<?php
  $i=0;
  foreach($result as $riga) {
    $i=$i+1;
    $classRiga='class="rowOdd"';
  if($i%2==0) {
    $classRiga='class="rowEven"';
  }
  $numero = $riga["numero"];
  $nome = $riga["nome"];
  $superficie  = $riga["superficie"];
  $numeroOpere = $riga["numeroOpere"];
  $temaSala = $riga["temaSala"];
  $descrizione = $riga["descrizione"];
?>
        <tr <?php	echo $classRiga; ?> >
          <td > <?php echo $numero; ?> </td>
          <td > <?php echo $nome; ?> </td>
          <td > <?php echo $superficie; ?> m² </td>
          <td>
            <a href="opera.php?espostaInSala=<?php echo urlencode($numero); ?>">
              <?php echo $numeroOpere; ?>
            </a>
          </td>
          <td>
            <a href="tema.php?codice=<?php echo urlencode($temaSala); ?>">
              <?php echo $temaSala; ?>
            </a>
          </td>
          <td > <?php echo $descrizione; ?> </td>
        </tr>
<?php } ?>
      </tbody>
    </table>
<?php } ?>
  </div>
</body>
</html>

<!DOCTYPE HTML>
<html>
<head>
  <title>Temi</title>
  <link rel="stylesheet" href="./css/cssPage.css">
  <link rel="stylesheet" href="./css/cssFooter.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap">
  <script type="text/javascript" src="./js/jquery-2.0.0.js"></script>
  <script type="text/javascript" src="./js/jsFiltersMove.js"></script>
  <script type="text/javascript" src="./js/jsTema.js"></script>
  <script type="text/javascript" src="./js/jsFooter.js"></script>
</head>

<body>
<?php
  $page = 'Temi';
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
            <input id="codice" class="input" name="codice" type="text" oninput="controllaCodice()"/>
            <label class="placeHolder">Codice</label>
          </li>
          <li class="filterItem">
            <input id="descrizione" class="input" name="descrizione" type="text"/>
            <label class="placeHolder">Descrizione</label>
          </li>
        </div>
      </ul>
    </form>
  </div>

  <div id="result" class="tableBody">
<?php
  $codice = "";
  $descrizione = "";
  $numeroSale  = "";
  $sort_by = "codice";
  $sort_order = "asc";

  if(count($_POST)>0) {
    $codice = $_POST["codice"];
    $descrizione = $_POST["descrizione"];
    $numeroSale  = $_POST["numeroSale"];
  }
  else if(count($_GET)>0) {
    $codice = $_GET["codice"];
    $descrizione = $_GET["descrizione"];
    $numeroSale  = $_GET["numeroSale"];
    if (isset($_GET["sort_by"])) {
      $sort_by = $_GET["sort_by"];
      $sort_order = $_GET["sort_order"];
    }
  }

  include 'temaManager.php';
  $error = false;

  require_once 'connDb.php';

  $query = getTemaQry($codice, $descrizione, $numeroSale, $sort_by, $sort_order);

  try {
    $result = $conn->query($query);
  } catch(PDOException $e) {
    echo "<p>DB Error on Query: " . $e->getMessage() . "</p>";
    $error = true;
  }
  if(!$error) {
?>
    <table>
      <thead>
        <tr>
          <th>CODICE 
            <button class="iconArrow" onclick="window.location.href='?sort_by=codice&sort_order=<?php echo $sort_by === 'codice' && $sort_order === 'asc' ? 'desc' : 'asc'; ?>&codice=<?php echo $codice; ?>&descrizione=<?php echo $descrizione; ?>&numeroSale=<?php echo $numeroSale; ?>'">
              <img src="./img/freccia.png">
              </button>
            </th>
          <th>DESCRIZIONE
            <button class="iconArrow" onclick="window.location.href='?sort_by=descrizione&sort_order=<?php echo $sort_by === 'descrizione' && $sort_order === 'asc' ? 'desc' : 'asc'; ?>&codice=<?php echo $codice; ?>&descrizione=<?php echo $descrizione; ?>&numeroSale=<?php echo $numeroSale; ?>'">
              <img src="./img/freccia.png">
            </button>
          </th>
          <th>NUMERO SALE
            <button class="iconArrow" onclick="window.location.href='?sort_by=numeroSale&sort_order=<?php echo $sort_by === 'numeroSale' && $sort_order === 'asc' ? 'desc' : 'asc'; ?>&codice=<?php echo $codice; ?>&descrizione=<?php echo $descrizione; ?>&numeroSale=<?php echo $numeroSale; ?>'">
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
    $codice = $riga["codice"];
    $descrizione = $riga["descrizione"];
    $numeroSale  = $riga["numeroSale"];
?>
          <tr <?php echo $classRiga; ?> >
            <td > <?php echo $codice; ?> </td>
            <td > <?php echo $descrizione; ?> </td>
            <td>
              <a href="sala.php?temaSala=<?php echo urlencode($codice); ?>">
                <?php echo $numeroSale; ?>
              </a>
            </td>
          </tr>
<?php } ?>
        </tbody>
      </table>
<?php }  ?>
  </div>
</body>
</html>

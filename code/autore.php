<!DOCTYPE HTML>
<html>
<head>
  <title>Autori</title>
  <link rel="stylesheet" href="./css/cssPage.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap">
  <script type="text/javascript" src="./js/jquery-2.0.0.js"></script>
  <script type="text/javascript" src="./js/jsFiltersMove.js"></script>
  <script type="text/javascript" src="./js/jsAutore.js"></script>
</head>

<body>
<?php
  $page='Autori';
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
        <li class="filterItem">
          <form name="myformCRUD" method="post">
            <button id="CRUD" name="CRUD" class="button" type="submit" value="CRUD">
              <span class="buttonText">Gestisci Autori</span>
              <span class="buttonIcon">
                <img src="../img/autoreStatica.png">
              </span>
            </button>
          </form>
        </li>
        <li class="filterItem">
          <form name="myformBack" method="post">
            <button id="backButton" name="back" class="button" type="submit" value="Back" onclick="hideCreateButton()">
              <span class="buttonText">Chiudi Gestisci Autori</span>
              <span class="buttonIcon">
                <img src="../img/indietro.png">
              </span>
            </button>
          </form>
        </li>






        <div class="filterScroll">
          <li class="filterItem">
            <input id="codice" class="input" name="codice" type="text"/>
            <label class="placeHolder">Codice Autore</label>
          </li>
          <li class="filterItem">
            <input id="nome" class="input" name="nome" type="text"/>
            <label class="placeHolder">Nome</label>
          </li>
          <li class="filterItem">
            <input id="cognome" class="input" name="cognome" type="text"/>
            <label class="placeHolder">Cognome</label>
          </li>
          <li class="filterItem">
            <input id="nazione" class="input" name="nazione" type="text"/>
            <label class="placeHolder">Nazione</label>
          </li>
          <li class="filterItem">
            <input id="dataNascita" class="input" name="dataNascita" type="text"/>
            <label class="placeHolder">Data Nascita</label>
          </li>
          <li class="filterItem">
            <input id="dataMorte" class="input" name="dataMorte" type="text"/>
            <label class="placeHolder">Data Morte</label>
          </li>
          <li class="filterItemLast">
            <input id="numeroOpere" class="input" name="numeroOpere" type="text"/>
            <label class="placeHolder">Numero Opere</label>
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





    <div id="options" style="display:none;">
      <button id="createButton" onclick="showCreateForm()">Creare</button>
    </div>

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
      $mostra = false;

      if (isset($_POST['CRUD']) && $_POST['CRUD'] === 'CRUD') {
        $mostra = true;
      }

      if(count($_POST) > 0) {
        $codice = $_POST["codice"];
        $nome = $_POST["nome"];
        $cognome  = $_POST["cognome"];
        $nazione = $_POST["nazione"];
        $dataNascita  = $_POST["dataNascita"];
        $dataMorte = $_POST["dataMorte"];
        $tipo = $_POST["tipo"];
        $numeroOpere  = $_POST["numeroOpere"];
        $nomeopera  = $_POST["nomeopera"];
      } else if(count($_GET) > 0) {
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
      $error = false;

      require_once 'connDb.php';
      $query = getAutoreQry($codice, $nome, $cognome, $nazione, $dataNascita, $dataMorte, $tipo, $numeroOpere, $nomeopera);

      try {
          $result = $conn->query($query);
      } catch(PDOException $e) {
          echo "<p>DB Error on Query: " . $e->getMessage() . "</p>";
          $error = true;
      }

      if(!$mostra && !$error && $result->rowCount() > 0) {

        if($nomeopera==""){
          ?>
          <table class="table">
              <tr class="header">
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
              foreach($result as $riga) {
                  $codice = $riga["codice"];
                  $nome = $riga["nome"];
                  $cognome  = $riga["cognome"];
                  $nazione = $riga["nazione"];
                  $dataNascita  = $riga["dataNascita"];
                  $dataMorte = $riga["dataMorte"];
                  $tipo = $riga["tipo"];
                  $numeroOpere  = $riga["numeroOpere"];

                  ?>
                  <tr>
                      <td><?php echo $codice; ?></td>
                      <td><?php echo $nome; ?></td>
                      <td><?php echo $cognome; ?></td>
                      <td><?php echo $nazione; ?></td>
                      <td><?php echo $dataNascita; ?></td>
                      <td><?php echo $dataMorte; ?></td>
                      <td><?php echo $tipo; ?></td>

                      <td>
            <a href="opera.php?autore=<?php echo urlencode($codice); ?>">
              <?php echo $numeroOpere; ?>
            </a>
          </td>
                  </tr>
              <?php } ?>
          </table>
      <?php }
      elseif ($nomeopera!="") {
        ?>
        <table class="table">
            <tr class="header">
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
            foreach($result as $riga) {
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
                <tr>
                    <td><?php echo $codice; ?></td>
                    <td><?php echo $nome; ?></td>
                    <td><?php echo $cognome; ?></td>
                    <td><?php echo $nazione; ?></td>
                    <td><?php echo $dataNascita; ?></td>
                    <td><?php echo $dataMorte; ?></td>
                    <td><?php echo $tipo; ?></td>
                    <td><?php echo $numeroOpere; ?></td>
                    <td><a href="opera.php?titolo=<?php echo urlencode($nomeopera); ?>"><?php echo $nomeopera; ?></a></td>

                    <td><?php echo $nomeopera; ?></td>
                </tr>
            <?php } ?>
        </table>
    <?php
      }
    } else if($mostra && !$error && $result->rowCount() > 0) { ?>
          <div>
            <button id="createButton" onclick="showCreateForm()">Creare</button>
          </div>

          <div id="createForm" style="display:none;">
            <h2>Inserimento nuovo autore</h2>
            <form id="createAuthorForm" method="post" action="insertAuthor.php" onsubmit="return validateForm()">
              <input id="codicecreate" name="codicecreate" type="text" placeholder="Codice">
              <input id="nomecreate" name="nomecreate" type="text" placeholder="Nome">
              <input id="cognomecreate" name="cognomecreate" type="text" placeholder="Cognome">
              <input id="nazionecreate" name="nazionecreate" type="text" placeholder="Nazione">
              <input id="dataNascitacreate" name="dataNascitacreate" type="text" placeholder="Data Nascita">
              <input id="dataMortecreate" name="dataMortecreate" type="text" placeholder="Data Morte">
              <input id="tipo_vivo" name="tipo" type="radio" value="vivo">
              <label for="tipo_vivo">Vivo</label>
              <input id="tipo_morto" name="tipo" type="radio" value="morto">
              <label for="tipo_morto">Morto</label>
              <input type="submit" name="insert" value="Inserisci">
            </form>
          </div>

          <table class="table">
              <tr class="header">
                  <th>Codice</th>
                  <th>Nome</th>
                  <th>Cognome</th>
                  <th>Nazione</th>
                  <th>Data Nascita</th>
                  <th>Data Morte</th>
                  <th>Tipo</th>
                  <th>Numero Opere</th>

                  <th>Modifica</th>
                  <th>Cancella</th>
              </tr>
              <?php
              foreach($result as $riga) {
                  $codice = $riga["codice"];
                  $nome = $riga["nome"];
                  $cognome  = $riga["cognome"];
                  $nazione = $riga["nazione"];
                  $dataNascita  = $riga["dataNascita"];
                  $dataMorte = $riga["dataMorte"];
                  $tipo = $riga["tipo"];
                  $numeroOpere  = $riga["numeroOpere"];

                  ?>
                  <tr>
                      <td><?php echo $codice; ?></td>
                      <td><?php echo $nome; ?></td>
                      <td><?php echo $cognome; ?></td>
                      <td><?php echo $nazione; ?></td>
                      <td><?php echo $dataNascita; ?></td>
                      <td><?php echo $dataMorte; ?></td>
                      <td><?php echo $tipo; ?></td>
                      <td><a href="opera.php?autore=<?php echo urlencode($codice); ?>"><?php echo $numeroOpere; ?></a></td>

                      <td><?php echo $numeroOpere; ?></td>


                      <td><button class="modifica-button" data-id="<?php echo $codice; ?>" onclick="showEditForm(<?php echo $codice; ?>)">Modifica</button></td>
                      <td><button class="cancella-button" data-id="<?php echo $codice; ?>" onclick="cancellaAutore(<?php echo $codice; ?>)">Cancella</button></td>
                  </tr>
                  <tr id="editFormRow<?php echo $codice; ?>" style="display: none;">
                      <td colspan="11">
                          <form id="editForm<?php echo $codice; ?>" method="post" action="editAuthor.php" onsubmit="return validateForm()">
                            <input type="hidden" name="codice" value="<?php echo $codice; ?>"> <!-- Campo nascosto per il codice -->
                        <input id="nomecreate" name="nomecreate" type="text" placeholder="Nome">
                        <input id="cognomecreate" name="cognomecreate" type="text" placeholder="Cognome">
                        <input id="nazionecreate" name="nazionecreate" type="text" placeholder="Nazione">
                        <input id="dataNascitacreate" name="dataNascitacreate" type="text" placeholder="Data Nascita">
                        <input id="dataMortecreate" name="dataMortecreate" type="text" placeholder="Data Morte"><input type="submit" name="edit" value="Modifica">
                          </form>
                      </td>
                  </tr>
              <?php } ?>
          </table>
      <?php } else {
          echo "<p>Nessun risultato trovato.</p>";
      } ?>
    </div>
  </div>



</body>
</html>

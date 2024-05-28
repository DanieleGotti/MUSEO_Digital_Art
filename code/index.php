<!DOCTYPE HTML>
<html>
<head>
  <title>Museo - Digital Art</title>
  <link rel="stylesheet" href="./css/cssHome.css">
  <link rel="stylesheet" href="./css/cssFooter.css">
  <!--<script src="jsIndex.js"></script>-->
  <script type="text/javascript" src="./js/jsFooter.js"></script>
</head>

<body>

  <?php
  $page = 'Home';
  include 'header.php';
  include 'nav.html';
  include 'footer.html';
  ?>

  <div class="indexIntro">
    <div class="indexLogo">
      <img class="logoImage" src="./img/logo.png">
    </div>
    <img class="indexImage" src="./img/prova.jpg">
  </div>

  <div class="indexContent">
    <div class="panel">
      <div class="panelTitle">
        <h3>Scopri i nostri temi</h3>
        <a href="./tema.php">Scopri di più</a>
      </div>
      <div class="horizontalScroll" id="temaCards">

        <?php
        $error = false;
        require_once 'connDb.php';

        $usedCodes = [];

        // Genera 8 card
        for ($j = 0; $j < 8; $j++) {
          do {
            $randomCode = rand(1, 12);
          } while (in_array($randomCode, $usedCodes)); // Continua a generare fino a trovare un codice non usato

          $query = "SELECT TEMA.descrizione, TEMA.codice FROM TEMA WHERE TEMA.codice = $randomCode";

          try {
            $result = $conn->query($query);
          } catch (PDOException $e) {
            echo "<p>DB Error on Query: " . $e->getMessage() . "</p>";
            $error = true;
          }

          if (!$error) {
            foreach ($result as $riga) {
              $i++;
              $classRiga = 'class="rowOdd"';
              if ($i % 2 == 0) {
                $classRiga = 'class="rowEven"';
              }

              $codice = $riga["codice"];
              $descrizione = $riga["descrizione"];
              ?>
              <div class="card">
                <img src="" alt="">
                <p>Codice Tema: <?php echo $codice; ?></p>
                <p> <a href="tema.php?codice=<?php echo urlencode($codice); ?>"><?php echo $descrizione; ?></a></p>



              </div>
              <?php
            }
          } else {
            echo "<div class='card'><p>Nessun tema trovato per codice: $randomCode</p></div>";
          }
        }

        ?>

      </div>
    </div>
  </div>

  <div class="indexContent">
    <div class="panel">
      <div class="panelTitle">
        <h3>Visita le nostre sale</h3>
        <a href="./sala.php">Scopri di più</a>
      </div>
      <div class="horizontalScroll">
        <?php
        $error = false;
        require_once 'connDb.php';

        $usedCodesS = [];

        // Genera 8 card
        for ($j = 0; $j < 8; $j++) {
          do {
            $randomCodeS = rand(1, 30);
          } while (in_array($randomCodeS, $usedCodesS)); // Continua a generare fino a trovare un codice non usato

          $query = "SELECT SALA.numero, SALA.nome, SALA.numeroOpere FROM SALA WHERE SALA.numero = $randomCodeS";

          try {
            $result = $conn->query($query);
          } catch (PDOException $e) {
            echo "<p>DB Error on Query: " . $e->getMessage() . "</p>";
            $error = true;
          }

          if (!$error) {
            foreach ($result as $riga) {
              $i++;
              $classRiga = 'class="rowOdd"';
              if ($i % 2 == 0) {
                $classRiga = 'class="rowEven"';
              }
              $numero = $riga["numero"];
              $nome = $riga["nome"];

              $numeroOpere = $riga["numeroOpere"];

              ?>
              <div class="card">
                <img src="" alt="">
                <p>Numero Sala: <?php echo $numero; ?></p>
                <p>Nome Sala: <a href="sala.php?numero=<?php echo urlencode($numero); ?>"><?php echo $nome; ?></a></p>
                <p>Opere esposte: <?php echo $numeroOpere; ?></p>
              </div>
              <?php
            }
          } else {
            echo "<div class='card'><p>Nessun tema trovato per codice: $randomCode</p></div>";
          }
        }

        ?>
        </div>
      </div>
    </div>

    <div class="indexContent">
      <div class="panel">
        <div class="panelTitle">
          <h3>Ammira le nostre opere</h3>
          <a href="./opera.php">Scopri di più</a>
        </div>
        <div class="horizontalScroll">
          <?php
          $error = false;
          require_once 'connDb.php';

          $usedCodesO = [];

          // Genera 8 card
          for ($j = 0; $j < 8; $j++) {
            do {
              $randomCodeO = rand(1, 1000);
            } while (in_array($randomCodeO, $usedCodesO)); // Continua a generare fino a trovare un codice non usato

            $query = "SELECT OPERA.opera, OPERA.titolo, AUTORE.nome, AUTORE.cognome FROM OPERA JOIN AUTORE ON OPERA.autore = AUTORE.codice WHERE OPERA.opera = $randomCodeO";

            try {
              $result = $conn->query($query);
            } catch (PDOException $e) {
              echo "<p>DB Error on Query: " . $e->getMessage() . "</p>";
              $error = true;
            }

            if (!$error) {
              foreach ($result as $riga) {
                $i++;
                $classRiga = 'class="rowOdd"';
                if ($i % 2 == 0) {
                  $classRiga = 'class="rowEven"';
                }
                $opera = $riga["opera"];
                $titolo  = $riga["titolo"];
                $nome = $riga["nome"];
                $cognome  = $riga["cognome"];

                ?>
                <div class="card">
                  <img src="" alt="">
                  <p>Codice Opera: <?php echo $opera; ?></p>
                  <p>Titolo: <a href="opera.php?=<?php echo urlencode($opera); ?>"><?php echo $titolo; ?></a></p>
                  <p>Autore: <?php echo $nome; ?>  <?php echo $cognome; ?> </p>
                </div>
                <?php
              }
            } else {
              echo "<div class='card'><p>Nessuna opera trovato per codice: $randomCodeO</p></div>";
            }
          }

          ?>
          </div>
        </div>
      </div>

      <div class="indexContent">
        <div class="panel">
          <div class="panelTitle">
            <h3>Risali agli autori</h3>
            <a href="./autore.php">Scopri di più</a>
          </div>
          <div class="horizontalScroll">
            <?php
            $error = false;
            require_once 'connDb.php';

            $usedCodesA = [];

            // Genera 8 card
            for ($j = 0; $j < 8; $j++) {
              do {
                $randomCodeA = rand(1, 100);
              } while (in_array($randomCodeA, $usedCodesA)); // Continua a generare fino a trovare un codice non usato

              $query = "SELECT AUTORE.codice, AUTORE.nome, AUTORE.cognome, AUTORE.nazione FROM AUTORE WHERE AUTORE.codice = $randomCodeA";

              try {
                $result = $conn->query($query);
              } catch (PDOException $e) {
                echo "<p>DB Error on Query: " . $e->getMessage() . "</p>";
                $error = true;
              }

              if (!$error) {
                foreach ($result as $riga) {
                  $i++;
                  $classRiga = 'class="rowOdd"';
                  if ($i % 2 == 0) {
                    $classRiga = 'class="rowEven"';
                  }
                  $codice = $riga["codice"];
                  $nome = $riga["nome"];
                  $cognome  = $riga["cognome"];
                  $nazione = $riga["nazione"];


                  ?>
                  <div class="card">
                    <img src="" alt="">

                    <td>Codice:<?php echo $codice; ?></td>
                    <td>Autore:<a href="autore.php?codice=<?php echo urlencode($codice); ?>"><?php echo $nome; ?>  <?php echo $cognome; ?></a></td>
                    <td>Nazione:<?php echo $nazione; ?></td>
                  </div>
                  <?php
                }
              } else {
                echo "<div class='card'><p>Nessuna opera trovato per codice: $randomCodeO</p></div>";
              }
            }

            ?>
            </div>
          </div>
        </div>
</body>
</html>

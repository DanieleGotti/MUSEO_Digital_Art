<!DOCTYPE HTML>
<html>
<head>
  <title>Museo - Digital Art</title>
  <link rel="stylesheet" href="./css/cssHome.css">
  <script src="jsIndex.js"></script>

</head>

<body>

  <?php
  $page = 'Home';
  include 'header.php';
  include 'nav.html';
  ?>

  <div class="indexIntro">
    <div class="indexLogo">
      <img class="logoImage" src="./img/logo.png">
    </div>
    <img class="indexImage" src="./img/prova.jpg">
  </div>

  <<div class="indexContent">
    <div class="panel">
      <div class="panelTitle">
        <h3>Scopri i nostri temi</h3>
        <a href="./tema.php">Scopri di più</a>
      </div>
      <div class="horizontalScroll" id="temaCards">
        <?php
        require_once 'connDb.php';

        // Query per ottenere le informazioni di una carta con codice 2
        $sql = "SELECT TEMA.descrizione, TEMA.codice FROM TEMA WHERE TEMA.codice = 2";

        try {
          // Esegui la query
          $result = $conn->query($sql);

          // Controllo degli errori nella query
          if (!$result) {
            throw new Exception("Errore nella query: " . $conn->error);
          }

          // Se ci sono risultati, generiamo le carte
          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              echo "<div class='card'>";
              echo "<p class='cardTitle'>Titolo1</p>";
              echo "<p class='descrizione'>" . $row['descrizione'] . "</p>";
              echo "<p class='codice'>Codice Tema: " . $row['codice'] . "</p>";
              echo "</div>";
            }
          } else {
            echo "<p>Nessun tema trovato</p>";
          }
        } catch (Exception $e) {
          // Gestione degli errori
          echo "<p>Errore: " . $e->getMessage() . "</p>";
        }
        ?>
      </div>
    </div>
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
          <div class="card">
            <img src="" alt="">
            <p class="cardTitle">Titolo1</p>
          </div>
          <div class="card">
            <img src="" alt="">
            <p class="cardTitle">Titolo2</p>
          </div>
          <div class="card">
            <img src="" alt="">
            <p class="cardTitle">Titolo3</p>
          </div>
          <div class="card">
            <img src="" alt="">
            <p class="cardTitle">Titolo4</p>
          </div>
          <div class="card">
            <img src="" alt="">
            <p class="cardTitle">Titolo5</p>
          </div>
          <div class="card">
            <img src="" alt="">
            <p class="cardTitle">Titolo6</p>
          </div>
          <div class="card">
            <img src="" alt="">
            <p class="cardTitle">Titolo7</p>
          </div>
          <div class="card">
            <img src="" alt="">
            <p class="cardTitle">Titolo8</p>
          </div>
        </div>
      </div>

      <div class="indexContent">
        <div class="panel">
          <div class="panelTitle">
            <h3>Ammira le nostre opere</h3>
            <a href="./opere.php">Scopri di più</a>
          </div>
          <div class="horizontalScroll">
            <div class="card">
              <img src="" alt="">
              <p class="cardTitle">Titolo1</p>
            </div>
            <div class="card">
              <img src="" alt="">
              <p class="cardTitle">Titolo2</p>
            </div>
            <div class="card">
              <img src="" alt="">
              <p class="cardTitle">Titolo3</p>
            </div>
            <div class="card">
              <img src="" alt="">
              <p class="cardTitle">Titolo4</p>
            </div>
            <div class="card">
              <img src="" alt="">
              <p class="cardTitle">Titolo5</p>
            </div>
            <div class="card">
              <img src="" alt="">
              <p class="cardTitle">Titolo6</p>
            </div>
            <div class="card">
              <img src="" alt="">
              <p class="cardTitle">Titolo7</p>
            </div>
            <div class="card">
              <img src="" alt="">
              <p class="cardTitle">Titolo8</p>
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
              <div class="card">
                <img src="" alt="">
                <p class="cardTitle">Titolo1</p>
              </div>
              <div class="card">
                <img src="" alt="">
                <p class="cardTitle">Titolo2</p>
              </div>
              <div class="card">
                <img src="" alt="">
                <p class="cardTitle">Titolo3</p>
              </div>
              <div class="card">
                <img src="" alt="">
                <p class="cardTitle">Titolo4</p>
              </div>
              <div class="card">
                <img src="" alt="">
                <p class="cardTitle">Titolo5</p>
              </div>
              <div class="card">
                <img src="" alt="">
                <p class="cardTitle">Titolo6</p>
              </div>
              <div class="card">
                <img src="" alt="">
                <p class="cardTitle">Titolo7</p>
              </div>
              <div class="card">
                <img src="" alt="">
                <p class="cardTitle">Titolo8</p>
              </div>
            </div>
          </div>

</body>
</html>

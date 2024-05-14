<!DOCTYPE HTML>
<html>
<head>
  <title>MUSEO START</title>
  <link rel="stylesheet" href="./css/cssStyle.css">
  <script type="text/javascript" src="./js/jquery-2.0.0.js"></script>
</head>

<body>

  <?php
  include 'header.html';
  include 'nav.html';
  include 'footer.html'
  ?>

  <div id="filtri">
    <form name="myform" method="POST">
      <input id="codice" name="codice" type="text" placeholder="Codice"/>
      <input id="descrizione" name="descrizione" type="text" placeholder="Descrizione"/>

        <input type="submit" value="Search"/>
        <input type="submit" value="RESET"/> //miao

    </form>

    <div id="result">
      <?php

      $codice = "";
      $descrizione = "";
      $numeroSale  = "";


      if(count($_POST)>0) {
        $codice = $_POST["codice"];
        $descrizione = $_POST["descrizione"];
        $numeroSale  = $_POST["numeroSale"];

      }
      else if(count($_GET)>0) {
        $codice = $_GET["codice"];
        $descrizione = $_GET["descrizione"];
        $numeroSale  = $_GET["numeroSale"];

      }
      include 'temaManager.php';
      $error = false; // Inizializza la variabile $error a false

      require_once 'connDb.php';
      $query = getTemaQry ($codice,	$descrizione, $numeroSale );
      echo "<p>codiceQuery: " . $query . "</p>";



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
            <th>idcodice</th>
            <th>descrizione</th>
            <th>numeroSale</th>

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
            $descrizione = $riga["descrizione"];
            $numeroSale  = $riga["numeroSale"];


            ?>
            <tr <?php	echo $classRiga; ?> >

              <td > <?php echo $codice; ?> </td>
              <td > <?php echo $descrizione; ?> </td>
              <td > <?php echo $numeroSale; ?> </td>

            </tr>
          <?php } ?>
        </table>
      <?php }  ?>

    </div>
  </div>
</body>
</html>

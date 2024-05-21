<!DOCTYPE HTML>
<html>
<head>
  <title>temi</title>
  <link rel="stylesheet" href="./css/cssTema.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap">
  <script type="text/javascript" src="./js/jquery-2.0.0.js"></script>
</head>

<body>

  <?php
  include 'header.html';
  include 'nav.html';
  ?>

  <div class="back">
    <div id="filtri" class="filters">
      <form name="myform" method="POST">
        <ul class="filterContainer">
          <li class="filterItem">
            <input id="codice" class="input" name="codice" type="text" placeholder=""/>
            <label class="placeHolder">Codice</label>
          </li>
          <li class="filterItem">
            <input id="descrizione" class="input" name="descrizione" type="text" placeholder=""/>
            <label class="placeHolder">Descrizione</label>
          </li>
          <li class="filterItem">
            <input type="submit" value="Search"/>
          </li>
          <li class="filterItem">
            <input type="submit" value="RESET"/>
          </li>
        </ul>
      </form>
    </div>

    <div id="result" class="main">
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
      $error = false;

      require_once 'connDb.php';
      $query = getTemaQry ($codice,	$descrizione, $numeroSale );

      try {
        $result = $conn->query($query);
      } catch(PDOException $e) {
        echo "<p>DB Error on Query: " . $e->getMessage() . "</p>";
        $error = true;
      }

      if(!$error) {
        ?>

        <table class="table">
          <tr class="tableHeader">
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

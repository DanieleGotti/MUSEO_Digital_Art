<!DOCTYPE HTML>
<html>
<head>
  <title>MUSEO START</title>
  <link rel="stylesheet" href="./css/cssStyle.css">
  <script type="text/javascript" src="./js/jquery-2.0.0.js"></script>
  <script type="text/javascript" src="./js/numeros.js"></script>
  <!--<link rel="stylesheet" href="./css/videoclips.css">-->
  <!--<script type="text/javascript" src="./js/jquery-2.0.0.js"></script>-->
  <!--<script type="text/javascript" src="./js/videoclips.js"></script>-->
</head>

<body>

  <?php
  include 'header.html';
  include 'nav.html';
  include 'footer.html'
  ?>

  <div id="filtri">
    <form name="myform" method="POST">
      <input id="numero" name="numero" type="text" placeholder="Id Sala"/>
      <input id="nome" name="nome" type="text" placeholder="Nome"/>
      <input id="superficie" name="superficie" type="text" placeholder="Superficie"/>
      <input id="temaSala" name="temaSala" type="text" placeholder="Tema"/>
      <input type="submit" value="Search"/>
    </form>

    <div id="result">
      <?php

      $numero = "";
      $nome = "";
      $superficie  = "";
      $temaSala= "";
      $descrizione= "";



      if(count($_POST)>0) {
        $numero = $_POST["numero"];
        $nome = $_POST["nome"];
        $superficie  = $_POST["superficie"];
        $temaSala  = $_POST["temaSala"];
        $descrizione  = $_POST["descrizione"];

      }
      else if(count($_GET)>0) {
        $numero = $_GET["numero"];
        $nome = $_GET["nome"];
        $superficie  = $_GET["superficie"];
        $temaSala  = $_GET["temaSala"];
        $descrizione  = $_GET["descrizione"];

      }
      include 'salaManager.php';
      $error = false; // Inizializza la variabile $error a false

      require_once 'connDb.php';
      $query = getSalaQry ($numero,	$nome, $superficie ,$temaSala, $descrizione);
      echo "<p>numeroQuery: " . $query . "</p>";



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
            <th>idnumero</th>
            <th>nome</th>
            <th>superficie</th>
              <th>temaSala</th>
              <th>descrizione</th>

          </tr>
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
              $temaSala = $riga["temaSala"];
              $descrizione = $riga["descrizione"];

            ?>
            <tr <?php	echo $classRiga; ?> >

              <td > <?php echo $numero; ?> </td>
              <td > <?php echo $nome; ?> </td>
              <td > <?php echo $superficie; ?> </td>
              <td > <?php echo $temaSala; ?> </td>
              <td > <?php echo $descrizione; ?> </td>

            </tr>
          <?php } ?>
        </table>
      <?php }  ?>

    </div>
  </div>


    <div id="filtri2">
      <form name="myform2s" method="POST">
        <input id="numero" name="numero" type="text" placeholder="Id Sala"/>
        <input id="nome" name="nome" type="text" placeholder="Nome"/>
        <input id="superficie" name="superficie" type="text" placeholder="Superficie"/>
          <input id="temaSala" name="temaSala" type="text" placeholder="Tema"/>
        <input id="autoripresenti" name="autoripresenti" type="text" placeholder="Autore"/>
          <input id="operepresenti" name="operepresenti" type="text" placeholder="Titolo Opera"/>
        <input type="submit" value="Search"/>
      </form>

      <div id="result2">
        <?php

        $numero = "";
        $nome = "";
        $superficie  = "";
        $temaSala= "";
        $descrizione= "";
        $autoripresenti= "";
        $operepresenti="";



        if(count($_POST)>0) {
          $numero = $_POST["numero"];
          $nome = $_POST["nome"];
          $superficie  = $_POST["superficie"];
          $temaSala  = $_POST["temaSala"];
          $descrizione  = $_POST["descrizione"];
          $autoripresenti=$_POST["autoripresenti"];
          $operepresenti=$_POST["operepresenti"];

        }
        else if(count($_GET)>0) {
          $numero = $_GET["numero"];
          $nome = $_GET["nome"];
          $superficie  = $_GET["superficie"];
          $temaSala  = $_GET["temaSala"];
          $descrizione  = $_GET["descrizione"];
          $autoripresenti=$_GET["autoripresenti"];
          $operepresenti=$_GET["operepresenti"];

        }
        $error = false; // Inizializza la variabile $error a false
        $query2 = getSalaQry2($numero,	$nome, $superficie ,$temaSala, $descrizione, $autoripresenti, $operepresenti);




        try {
          $result2 = $conn->query($query2);
        } catch(PDOException $e) {
          echo "<p>DB Error on Query: " . $e->getMessage() . "</p>";
          $error = true;
        }

        if(!$error) {
          ?>

          <table class="table">
            <tr class="header">
              <!--th>id </th-->
              <th>idnumero</th>
              <th>nome</th>
              <th>superficie</th>
                <th>temaSala</th>
                <th>descrizione</th>
                <th>Nome Autore</th>
                <th>Cognome Autore</th>
                <th>Opera</th>

            </tr>
            <?php
            $i=0;

            foreach($result2 as $riga2) {
              $i=$i+1;
              $classRiga2='class="rowOdd"';
              if($i%2==0) {
                $classRiga2='class="rowEven"';
              }
              $numero = $riga2["numero"];
              $nome = $riga2["nome"];
              $superficie  = $riga2["superficie"];
                $temaSala = $riga2["temaSala"];
                $descrizione = $riga2["descrizione"];
                $autoripresenti = $riga2["autoripresenti"];
                $operepresentie = $riga2["operepresenti"];


              ?>
              <tr <?php	echo $classRiga; ?> >

                <td > <?php echo $numero; ?> </td>
                <td > <?php echo $nome; ?> </td>
                <td > <?php echo $superficie; ?> </td>
                <td > <?php echo $temaSala; ?> </td>
                <td > <?php echo $descrizione; ?> </td>
                <td > <?php echo $autoripresenti; ?> </td>
                <td > <?php echo $operepresenti; ?> </td>
              </tr>
            <?php } ?>
          </table>
        <?php }  ?>

      </div>
    </div>


</body>
</html>

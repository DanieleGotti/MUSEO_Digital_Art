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
  include 'nav.html';
  include 'footer.html';
  ?>

  <div id="filtri">
    <form name="myform" method="POST">
      <input id="numero" name="numero" type="text" placeholder="Id Sala"/>
      <input id="nome" name="nome" type="text" placeholder="Nome"/>
      <input id="superficie" name="superficie" type="text" placeholder="Superficie"/>
      <input id="temaSala" name="temaSala" type="text" placeholder="Tema"/>
      <input id="descrizione" name="descrizione" type="text" placeholder="Descrizione"/>
      <input type="submit" value="Search"/>
      <input type="submit" value="RESET"/>
    </form>


    <form name="myform2" method="post">
    <input id="opera" name="nomeopera" type="text" placeholder="Titolo dell'opera">
    <input type="submit" value="Cerca per opera">
    </form>

    <form name="myform3" method="post">
    <input id="cercaautore" name="cercaautore" type="text" placeholder="Autore">
    <input type="submit" value="Cerca per autore">
    </form>

    <div id="result">
      <?php

      $numero = "";
      $nome = "";
      $superficie  = "";
      $temaSala= "";
      $descrizione= "";
      $nomeopera= "";
        $cercaautore= "";


      if(count($_POST)>0) {
        $numero = $_POST["numero"];
        $nome = $_POST["nome"];
        $superficie  = $_POST["superficie"];
        $temaSala  = $_POST["temaSala"];
        $descrizione  = $_POST["descrizione"];
        $nomeopera  = $_POST["nomeopera"];
          $cercaautore  = $_POST["cercaautore"];
      }
      else if(count($_GET)>0) {
        $numero = $_GET["numero"];
        $nome = $_GET["nome"];
        $superficie  = $_GET["superficie"];
        $temaSala  = $_GET["temaSala"];
        $descrizione  = $_GET["descrizione"];
        $nomeopera  = $_GET["nomeopera"];
        $cercaautore  = $_GET["cercaautore"];
      }
      include 'salaManager.php';
      $error = false; // Inizializza la variabile $error a false

      require_once 'connDb.php';
      $query = getSalaQry ($numero,	$nome, $superficie ,$temaSala, $descrizione, $nomeopera, $cercaautore);
      echo "<p>numeroQuery: " . $query . "</p>";



      try {
        $result = $conn->query($query);
      } catch(PDOException $e) {
        echo "<p>DB Error on Query: " . $e->getMessage() . "</p>";
        $error = true;
      }

      if(!$error&& $nomeopera!="") {
        ?>

        <table class="table">
          <tr class="header">
            <!--th>id </th-->
            <th>ID</th>
            <th>Nome</th>
            <th>Superficie</th>
            <th>Tema Sala</th>
            <th>Descrizione</th>
            <th>Nome Opera</th>
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
            $nomeopera = $riga["nomeopera"];
            ?>
            <tr <?php	echo $classRiga; ?> >

              <td > <?php echo $numero; ?> </td>
              <td > <?php echo $nome; ?> </td>
              <td > <?php echo $superficie; ?> </td>
              <td > <?php echo $temaSala; ?> </td>
              <td > <?php echo $descrizione; ?> </td>
              <td > <?php echo $nomeopera; ?> </td>

            </tr>
          <?php } ?>
        </table>
      <?php }
      if(!$error && $nomeopera=="") {
        if($cercaautore==""){}
        ?>

        <table class="table">
          <tr class="header">
            <!--th>id </th-->
            <th>ID</th>
            <th>Nome</th>
            <th>Superficie</th>
            <th>Tema Sala</th>
            <th>Descrizione</th>
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
      <?php }
      if( $cercaautore!=""){
        ?>

        <table class="table">
          <tr class="header">
            <!--th>id </th-->
            <th>ID</th>
            <th>Nome</th>
            <th>Superficie</th>
            <th>Tema Sala</th>
            <th>Descrizione</th>
            <th>Nome Opera</th>
            <th>Nome Autore</th>
            <th>Cognome Autore</th>
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
            $nomeopera = $riga["nomeopera"];
            $nomeautore=  $riga["nomeautore"];
            $cognomeautore=  $riga["cognomeautore"];
            ?>
            <tr <?php	echo $classRiga; ?> >

              <td > <?php echo $numero; ?> </td>
              <td > <?php echo $nome; ?> </td>
              <td > <?php echo $superficie; ?> </td>
              <td > <?php echo $temaSala; ?> </td>
              <td > <?php echo $descrizione; ?> </td>
              <td > <?php echo $nomeopera; ?> </td>
              <td > <?php echo $nomeautore; ?> </td>
              <td > <?php echo $cognomeautore; ?> </td>
            </tr>
          <?php }
    }?>

    </div>
  </div>



</body>
</html>

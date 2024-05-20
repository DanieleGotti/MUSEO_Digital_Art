<!DOCTYPE HTML>
<html>
<head>
  <title>header</title>
  <link rel="stylesheet" href="./css/cssHeader.css">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
</head>
<body>
  <div class="header">
    <div class="innerHeader">
      <div class="logoContainer">
        <img class="logoImage" src="./img/logo.png">
      </div>
      <ul class="headerLinks">
        <a>
          <li>
<?php echo htmlspecialchars($page); ?>
          </li>
        </a>
      </ul>
    </div>
  </div>
</body>
</html>

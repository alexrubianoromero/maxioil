<?php
session_start();
?>

<!DOCTYPE html>
<html >
<head>
	<meta charset="UTF-8">
	<title>orde captura</title>
    <link rel="stylesheet" href="../css/normalize.css">
  <link rel="stylesheet" href="../css/style.css">
<script src="./js/jquery.js" type="text/javascript"></script>
<style type="text/css">
</style>
</head>
<body>
<div id="container">
  <div id="aviso">
  <h3> CUENTAS POR COBRAR </h3>
</div>
<div id="muestre_cxc">
        <?php include('muestre_cxc.php');  ?>
</div>
</div>	
</body>
</html>
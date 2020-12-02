<?php
 session_start();    
?>
<html>
  <head>
		<meta charset="utf-8"/>
		<title> Projeto-Web </title>
		<link type="text/css" rel="stylesheet" href="css/bootstrap.css"/>
		<link type="text/css" rel="stylesheet" href="css/estilo.css"/>	
		</head>

    <body>
      <?php	
        $pagina = "principal";
        require_once('menu.php'); 
      ?>
      <script type="text/javascript" src="js/jquery.js"></script>
      <script type="text/javascript" src="js/bootstrap.js"></script>
	  </body>  
</html>
<?php
  //selezione dell'heading (o navigation) bar in base all'utente
  if(isset($_SESSION["candidato"])){
    include("header_candidato.php");
  }

  elseif(isset($_SESSION["azienda"])){
    include("header_azienda.php");
  }
  else{
    include("header_visitors.php");
  }
 ?>

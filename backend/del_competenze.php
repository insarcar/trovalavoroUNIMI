<?php
session_start();
include("../common/functions.php");
include("../common/setup.php");

if(!check_proper($_GET["id"], $cid)){
  $error = "Non hai il permesso di accedere a questa pagina";
  header("Location: ../frontend/home.php?error=".$error);
}
//selezione tabella
if(isset($_SESSION['azienda'])){
  $table = "richiede";
  $tipo = "annuncio";
}
else{
  $table = "esplicita";
  $tipo = "curriculum";
}
//eventuali statement che comprendono null values
$nulls = "";
if(empty($_GET['vot'])){
  $nulls .= " AND votazione IS null";
}
else {
  $nulls .= " AND votazione = '{$_GET['vot']}'";
}
if(empty($_GET['lvl'])){
  $nulls .= " AND livello IS null";
}
else {
  $nulls .= " AND livello = '{$_GET['lvl']}'";
}
//costruzione query
$sql = "DELETE from $table
        WHERE id$tipo = '{$_GET['id']}' AND tipoesperienza = '{$_GET['esp']}' AND tiposettore = '{$_GET['sett']}'
        AND titolo = '{$_GET['tit']}' AND ordscolastico = '{$_GET['ord']}' AND nome = '{$_GET['lang']}' AND periodo = '{$_GET['per']}'";
$sql .= $nulls;
//echo $sql;
$cid -> query($sql) or die($cid->error);

header("Location: ../frontend/competenze.php?id=".$_GET['id']);

 ?>

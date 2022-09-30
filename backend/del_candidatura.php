<?php
session_start();
include("../common/functions.php");
include("../common/setup.php");

if(!check_proper($_GET["idc"], $cid)){
  $error = "Non hai il permesso di accedere a questa pagina";
  header("Location: ../frontend/home.php?error=".$error);
}

$sql = "DELETE FROM relativoA WHERE idannuncio = '{$_GET['ida']}' AND idcurriculum = '{$_GET['idc']}'";
$cid -> query($sql) or die($cid->error);

$msg = "Cancellazione della candidatura riuscita";
header("Location: ../frontend/candidature_candidato.php");



 ?>

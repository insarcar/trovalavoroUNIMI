<?php
session_start();
include("../common/functions.php");
include("../common/setup.php");
//cancellazione delle voci referenti in esplicita
$sql = "SELECT COUNT(*) FROM esplicita WHERE idcurriculum = '{$_GET['idc']}'";
$res = $cid -> query($sql) or die($cid->error);

$row = $res -> fetch_row();

if($row[0] > 0){

  $sql = "DELETE FROM esplicita where idcurriculum = '{$_GET['idc']}'";
  $cid -> query($sql) or die($cid->error);

}
//cancellazione delle voci referenti in relativoA
$sql = "SELECT COUNT(*) FROM relativoA WHERE idcurriculum = '{$_GET['idc']}'";
$res = $cid -> query($sql) or die($cid->error);

$row = $res -> fetch_row();

if($row[0] > 0){

  $sql = "DELETE FROM relativoA where idcurriculum = '{$_GET['idc']}'";
  $cid -> query($sql) or die($cid->error);

}

//prelievo quantità di curriculum presenti nella tabella
$sql = "SELECT COUNT(*) FROM curriculum";
$res = $cid -> query($sql) or die($cid->error);
$row = $res -> fetch_row();
//cancellazione
$sql = "DELETE FROM curriculum where idcurriculum = '{$_GET['idc']}'";
$cid -> query($sql) or die($cid->error);

if($row[0]>0){
//se vi sono altri curriculum, dall'id appena cancellato all'id più alto abbassali tutti di 1
  for($id = $_GET['idc'] + 1; $id < $row[0]; $id++){
    $newid = $id - 1;
    $sql = "UPDATE curriculum SET idcurriculum = '$newid' WHERE idcurriculum = '$id'";
    $cid -> query($sql) or die($cid->error);
  }
}
//success, redirect
$msg = "Cancellazione del curriculum riuscita";
header("Location: ../frontend/profilo_candidato.php?user=".$_SESSION['candidato']."&msg=".$msg);



 ?>

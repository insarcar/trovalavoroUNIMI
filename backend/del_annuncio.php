<?php
session_start();
include("../common/functions.php");
include("../common/setup.php");


if(!check_proper($_GET["id"], $cid)){
  $error = "Non hai il permesso di accedere a questa pagina";
  header("Location: ../frontend/home.php?error=".$error);
}
//cancellazione da richiede di tutte le voci referenti
$sql = "SELECT COUNT(*) FROM richiede WHERE idannuncio = '{$_GET['id']}'";
$res = $cid -> query($sql) or die($cid->error);

$row = $res -> fetch_row();

if($row[0] > 0){

  $sql = "DELETE FROM richiede where idannuncio = '{$_GET['id']}'";
  $cid -> query($sql) or die($cid->error);

}
//cancellazione relativoA di tutte le voci referenti
$sql = "SELECT COUNT(*) FROM relativoA WHERE idannuncio = '{$_GET['id']}'";
$res = $cid -> query($sql) or die($cid->error);

$row = $res -> fetch_row();

if($row[0] > 0){

  $sql = "DELETE FROM relativoA where idannuncio = '{$_GET['id']}'";
  $cid -> query($sql) or die($cid->error);

}
//cancellazione da commento di tutte le voci referenti
$sql = "SELECT COUNT(*) FROM commento WHERE idannuncio = '{$_GET['id']}'";
$res = $cid -> query($sql) or die($cid->error);

$row = $res -> fetch_row();

if($row[0] > 0){

  $sql = "DELETE FROM commento where idannuncio = '{$_GET['id']}'";
  $cid -> query($sql) or die($cid->error);

}
//prelevo il numero attuale di elementi nella tabella
$sql = "SELECT COUNT(*) FROM annuncio";
$res = $cid -> query($sql) or die($cid->error);
$row = $res -> fetch_row();
//cancellazione annuncio
$sql = "DELETE FROM annuncio where idannuncio = '{$_GET['id']}'";
$cid -> query($sql) or die($cid->error);
//se vi sono elementi nella tabella
if($row[0]>0){
  //dall'id dell'annuncio appena cancellato fino all'annuncio con l'id più alto abbassali tutti di uno
  for($id = $_GET['id'] + 1; $id < $row[0]; $id++){
    $newid = $id - 1;
    $sql = "UPDATE annuncio SET idannuncio = '$newid' WHERE idannuncio = '$id'";
    $cid -> query($sql) or die($cid->error);
  }
}
//success, redirect
$msg = "Cancellazione dell'annuncio riuscita";
header("Location: ../frontend/profilo_azienda.php?user=".$_SESSION['azienda']."&msg=".$msg);




 ?>

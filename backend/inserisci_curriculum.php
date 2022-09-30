<?php
//setup dati
session_start();
$data = array();
if(isset($_GET["id"])){
  //se viene inserito un nuovo curriculum in risposta ad un annuncio, a questa pagina arriva in GET l'id dell'annuncio
  $data["ida"] = intval($_GET["id"]);
}
$data["descr"] = nl2br(htmlentities($_POST["desc"], ENT_QUOTES, 'UTF-8'));
$data["nomecv"] = filter_var($_POST["nomecv"], FILTER_SANITIZE_STRING);
$data["email"] = $_SESSION["candidato"];

if(isset($_POST["prf"])){
    $data["prf"] = '1';
//se il checkbox 'suProfilo' è checkato
}
else{
  //se non lo è
  $data["prf"] = '0';
}
//setup e inserimento
include("../common/functions.php");
include("../common/setup.php");
$words = explode(' ', $data["nomecv"]);
$data = ins_curriculum($data, $cid);//ritorna l'array di dati per l'id del curriculum appena inserito, che serve per il redirect
keyword_ins($words, $cid);
mysqli_close($cid);

$msg = "Inserimento avvenuto con successo!<br>Ora scegli cosa fare:";
header("Location: ../frontend/svincolo.php?id=".$data["id"]."&msg=".$msg);





 ?>

<?php
//setup dati
session_start();
$data = array();
$data["title"] = nl2br(htmlentities($_POST["title"], ENT_QUOTES, 'UTF-8'));
$data["descr"] = nl2br(htmlentities($_POST["desc"], ENT_QUOTES, 'UTF-8'));
$data["settl"] = $_POST["settl"];
$data["contra"] = $_POST["contra"];
$data["datai"] = $_POST["datai"];
$data["retr"] = $_POST["retr"];
$data["dataf"] = $_POST["dataf"];
$data["durata"] = $_POST["durata"];
$data["nlav"] = $_POST["nlav"];
$data["vis"] = $_POST["vis"];
$data["pvis"] = $_POST["pvis"];
$data["email"] = $_SESSION["azienda"];

//se il contratto è a tempo determinato setto a null i campi relativi
if($data["contra"] !== "Contratto a tempo determinato"){
  $data["dataf"] = null;
  $data["durata"] = null;
  $data["nlav"] = null;

}

if(!isset($data["retr"])){
  $data["retr"] = null;
}
//estrazione settore, e setup array di keywords
include("../common/functions.php");
$data["settl"] = get_settore($data["settl"]);
$words = explode(' ', $data["title"]);
//setup e inserimento, la funzione mi ritorna l'array data, in modo che io possa avere l'id per il redirect
include_once("../common/setup.php");
$data = ins_annuncio($data, $cid);
keyword_ins($words, $cid);

mysqli_close($cid);
//success redirect
$msg = "Inserimento avvenuto con successo!<br>Ora scegli cosa fare:";
header("Location: ../frontend/svincolo.php?id=".$data["id"]."&msg=".$msg);



 ?>

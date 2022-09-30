<?php
session_start();
//selezione della tabella in base all'utente
if(isset($_SESSION["azienda"])){
  $tipo = "richiede";
}
if(isset($_SESSION["candidato"])){
  $tipo = "esplicita";
}
//setup dati
$data = array();
$data["id"] = intval($_GET["id"]);
$data["esp"] = nl2br(htmlentities($_POST["esp"], ENT_QUOTES, 'UTF-8'));
$data["sett"] = $_POST["sett"];
$data["per"] = intval($_POST["per"]);
$data["pert"] = $_POST["pert"];
$data["tit"] = nl2br(htmlentities($_POST["tit"], ENT_QUOTES, 'UTF-8'));
$data["ord"] = $_POST["ord"];
$data["vot"] = $_POST["vot"];
$data["lang"] = filter_var($_POST["lang"], FILTER_SANITIZE_STRING);
$data["lvl"] = $_POST["lvl"];


if(!isset($data["vot"])){
  $data["vot"] = null;
}
if(!isset($data["lvl"])){
  $data["lvl"] = null;
}

if(!isset($data["per"])){
  $data["per"] = null;
}
else{
  if(!isset($data["pert"])){
    $error = "Inserisci l'indicazione di valore del periodo (Anni, o Mesi, o Giorni)";
    header("Location: ins_annuncio.php?error=".$error);
  }
  else{
    //parsing del periodo, da anni/mesi/giorni, a mesi, il valore nascosto di pert è già settato per la conversione numerica
    $data["per"] = ceil($data["per"]*$data["pert"]);
    }
}
//setup estrazione settore e inserimento
include_once("../common/setup.php");
include("../common/functions.php");
$data["sett"] = get_settore($data["sett"]);
ins_competenze($data, $tipo, $cid);
mysqli_close($cid);
//success, redirect
$msg = "Inserimento avvenuto con successo!<br>Ora scegli cosa fare:";
header("Location: ../frontend/svincolo.php?id=".$data["id"]."&msg=".$msg);

 ?>

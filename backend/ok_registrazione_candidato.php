<?php
//setup e pulizia dei dati
$dati = array();
$dati["nome"] = filter_var($_GET["nome"], FILTER_SANITIZE_STRING);
$dati["cogn"] = filter_var($_GET["cogn"], FILTER_SANITIZE_STRING);
$dati["datan"] = $_GET["datan"];
$dati["user"] = trim(mb_strtolower($_GET["user"]));
$dati["pass"] = trim($_GET["psw"]);
$dati["via"] = $_GET["via"];
$dati["nvia"] = filter_var($_GET["nvia"], FILTER_SANITIZE_STRING);
$dati["nciv"] = $_GET["nciv"];
$dati["cit"] = filter_var($_GET["cit"], FILTER_SANITIZE_STRING);
$dati["cap"] = trim($_GET["cap"]);
//inserimento
include("../common/functions.php");
include_once("../common/setup.php");
insert_candidato($dati, $cid);

 ?>

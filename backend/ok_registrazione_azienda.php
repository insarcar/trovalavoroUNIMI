<?php
//setup e pulizia dei dati
$dati = array();
$dati["nome"] = filter_var($_GET["nome"], FILTER_SANITIZE_STRING);
$dati["ragsoc"] = $_GET["ragsoc"];
$dati["piva"] = $_GET["piva"];
$dati["user"] = trim(mb_strtolower($_GET["user"]));
$dati["via"] = $_GET["via"];
$dati["nvia"] = filter_var($_GET["nvia"], FILTER_SANITIZE_STRING);
$dati["nciv"] = $_GET["nciv"];
$dati["cit"] = filter_var($_GET["cit"], FILTER_SANITIZE_STRING);
$dati["cap"] = trim($_GET["cap"]);
$dati["tel"] = $_GET["tel"];
$dati["pass"] = trim($_GET["psw"]);
//inserimento
include("../common/setup.php");
include("../common/functions.php");
insert_azienda($dati, $cid);

 ?>

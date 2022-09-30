<?php
session_start();
include("../common/setup.php");
include("../common/functions.php");
if(!check_proper($_GET["id"], $cid)){

    $error = "Non hai il permesso di accedere a questa pagina";
    header("Location: ../frontend/home.php?error=".$error);

}

$cols = array();

if(!empty($_POST["title"])){

  $cols["titolo"] = nl2br(htmlentities($_POST["title"], ENT_QUOTES, 'UTF-8'));
  $words = explode(' ', $cols["titolo"]);
  keyword_ins($words, $cid);
}
if(!empty($_POST["desc"])){

  $cols["descrizione"] = nl2br(htmlentities($_POST["desc"], ENT_QUOTES, 'UTF-8'));

}
if(!empty($_POST["settl"])){

  $cols["tiposettore"] = get_settore($_POST["settl"]);

}
if(!empty($_POST["contra"])){

  $cols["tipocontratto"] = $_POST["contra"];

}
if(!empty($_POST["dataf"])){

  $cols["datafine"] = $_POST["dataf"];

}
if(!empty($_POST["durata"])){

  $cols["durata"] = $_POST["durata"];

}
if(!empty($_POST["nlav"])){

  $cols["ngionri"] = $_POST["nlav"];
}

if(!empty($_POST["vis"])){

  $cols["tipovisibilita"] = $_POST["vis"];

}

if(!empty($_POST["pvis"])){

  $cols["periodovisibilita"]  = $_POST["pvis"];

}

foreach ($cols as $key => $value) {

  $sql = "UPDATE annuncio SET $key = '$value' WHERE annuncio.idannuncio = '{$_GET["id"]}';";
  $cid -> query($sql) or die(header("Location: ../frontend/ins_annuncio.php?error=".$cid->error."&id=".$_GET["id"]));

}
mysqli_close($cid);
$msg = "Modifica avvenuta con successo!<br>Ora scegli cosa fare:";
header("Location: ../frontend/svincolo.php?id=".$_GET["id"]."&msg=".$msg);

 ?>

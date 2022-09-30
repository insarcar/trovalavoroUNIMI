<?php
session_start();
include("../common/setup.php");
include("../common/functions.php");
if(!check_proper($_GET["id"], $cid)){

    $error = "Non hai il permesso di accedere a questa pagina";
    header("Location: ../frontend/home.php?error=".$error);

}

$cols = array();

if(!empty($_POST["nomecv"])){

  $cols["nomecv"] = filter_var($_POST["nomecv"], FILTER_SANITIZE_STRING);
  //inserimento in keyword
  $words = explode(' ', $cols["nomecv"]);
  keyword_ins($words, $cid);
}
if(!empty($_POST["desc"])){

  $cols["descrizione"] = nl2br(htmlentities($_POST["desc"], ENT_QUOTES, 'UTF-8'));

}
if(isset($_POST["prf"])){

  $cols["suProfilo"] = '1';
}


foreach ($cols as $key => $value) {

  $sql = "UPDATE curriculum SET $key = '$value' WHERE curriculum.idcurriculum = '{$_GET["id"]}';";
  $cid -> query($sql) or die(header("Location: ../frontend/ins_curriculum.php?modifica=true&error=".$cid->error."&id=".$_GET["id"]));

}
mysqli_close($cid);

$msg = "Modifica avvenuta con successo!<br>Ora scegli cosa fare:";
header("Location: ../frontend/curriculum.php?id=".$_GET["id"]."&msg=".$msg);


 ?>

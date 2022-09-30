<?php
session_start();
//setup
include("../common/setup.php");
include("../common/functions.php");
//dati e pulizia
$cols = array();
$cols["giudizio"] = $_POST["giud"];
$cols["esito"] = $_POST["esito"];
$cols["motivazione"] = filter_var($_POST["motiv"], FILTER_SANITIZE_STRING);
//se esito = 'accettato' non serve la motivazione, e la notifica deve essere settata
if($cols["esito"] == "Accettato"){
  $cols["motivazione"] = NULL;
  $cols["notifica"] = '1';
}
else{
  $cols["notifica"] = '0';
}

foreach ($cols as $key => $value) {
  //update della voce della tabella per ogni campo della valutazione
  $sql = "UPDATE relativoA
          JOIN annuncio on relativoA.idannuncio = annuncio.idannuncio
          SET $key = '$value'
          WHERE idcurriculum = '{$_GET['idc']}' AND annuncio.email = '{$_SESSION['azienda']}'";
  if(isset($_GET["ida"])){
    $sql .= " AND relativoA.idannuncio = '{$_GET['ida']}'";
  }
  $cid -> query($sql) or die($cid->error);

}
//redirect al curriculum per il feedback
header("Location: ../frontend/curriculum.php?id=".$_GET["idc"]."&ida=".$_GET["ida"]);
 ?>

<?php//pagina inutilizzata nella build corrente
session_start();

$data = array();

$data["url"] = $_GET["url"];
$data["id"] = intval($_GET["id"]);

if(isset($_SESSION["candidato"])) {
    $data["email"] = $_SESSION["candidato"];
}

else{
  $error = "Non sei autorizzato ad inserire commenti";
  header("Location: ".$_GET["url"]."&error=".$error);
}

$data["contenuto"] = filter_var($_POST["contenuto"], FILTER_SANITIZE_STRING);

include("../common/setup.php");
include("../common/functions.php");
ins_commento($data, $cid);
mysqli_close($cid);

 ?>

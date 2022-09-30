<?php
$user = $_POST["user"];
$pwd = $_POST["pass"];
$type = $_POST["user_ty"];
$url = $_GET["url"];
//preleva l'url per restare sulla pagina corrente
if(isset($_POST["ricordami"])){
    $rem = $_POST["ricordami"];
}
else{
  $rem = '';
}

include_once("../common/setup.php");
include("../common/functions.php");
login($user,$pwd,$type,$cid, $url, $rem);

?>

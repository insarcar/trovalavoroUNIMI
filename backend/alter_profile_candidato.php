<?php
session_start();
$cols = array();
include("../common/functions.php");

if(isset($_FILES["foto"]) && is_uploaded_file($_FILES["foto"]['tmp_name'])){

  $cols["foto"] = upl($_FILES["foto"]);

}



if(!empty($_POST["nome"])){
  $cols["nome"] = filter_var($_POST["nome"], FILTER_SANITIZE_STRING);
}
if(!empty($_POST["cogn"])){
  $cols["cognome"] = filter_var($_POST["cogn"], FILTER_SANITIZE_STRING);
}
if(!empty($_POST["piva"])){
  $cols["datan"] = $_POST["datan"];
}
if(!empty($_POST["user"])){

  $user = $_POST["user"];
  include("../common/setup.php");
  $sql = "UPDATE candidato SET email = '$user' WHERE candidato.email = '{$_SESSION['candidato']}';";
  $cid -> query($sql) or die(header("Location: ../frontend/modifica_profilo_candidato.php?error=".$cid->error));
  mysqli_close($cid);
  $_SESSION["candidato"] = $user;

}
else{
  $user = $_SESSION["candidato"];
}
if(!empty($_POST["psw"])){
  $cols["password"] = $_POST["psw"];
}
if(!empty($_POST["via"]) && !empty($_POST["nvia"]) && !empty($_POST["nciv"])){
  $cols["via"] = $_POST["via"]." ".filter_var($_POST["nvia"], FILTER_SANITIZE_STRING);
  $cols["numero"] = $_POST["nciv"];
}
if(!empty($_POST["cit"]) && !empty($_POST["cap"])){
  $cols["nomec"] = filter_var($_POST["cit"], FILTER_SANITIZE_STRING);
  $cols["CAP"] = $_POST["cap"];
  $ifquery = "select nome, cap from citta where nome = '{$cols['nomec']}' and cap = '{$cols['CAP']}'";
  $res = $cid -> query($ifquery) or die (header("Location: ../frontend/home.php?status=ko&error=".$cid->error));

  if($res -> num_rows == 0){ //SE LA CITTA' NON VIENE TROVATA LA INSERISCO
    $query = "insert into citta values ('{$cols['CAP']}', '{$cols['nomec']}');";
    $res = $cid -> query($query) or die (header("Location: ../frontend/frontend/home.php?status=ko&error=".$cid->error));
  }
}
if(!empty($_POST["descr"])){
  $cols["descrizione"] = filter_var($_POST["descr"], FILTER_SANITIZE_STRING);
}

include("../common/setup.php");

foreach ($cols as $key => $value) {
  $sql = "UPDATE candidato SET $key = '$value' WHERE candidato.email = '$user';";
  $cid -> query($sql) or die(header("Location: ../frontend/modifica_profilo_candidato.php?error=".$cid->error));

}

mysqli_close($cid);

if(!empty($_POST["keys"])){
  $keys = explode(" ", htmlentities($_POST["keys"]));
  $keys = array_unique($keys, SORT_STRING);

  include("../common/setup.php");

  foreach ($keys as $value) {

    $value = filter_var($value, FILTER_SANITIZE_STRING);
    $sqlif = "SELECT * FROM keyword where parola = '$value'";
    $res = $cid -> query($sqlif) or die(header("Location: ../frontend/modifica_profilo_candidato.php?error=".$cid->error));

    if($res -> num_rows == 0){
      $sql = "INSERT into keyword VALUES('$value')";
      $cid -> query($sql) or die(header("Location: ../frontend/modifica_profilo_candidato.php?error=".$cid->error));
    }
    //se è già nel db salta l'iterazione
    $sqlif = "SELECT * FROM disponeCandidato where parola = '$value' AND emailp = '{$_SESSION['candidato']}'";
    $res = $cid -> query($sqlif) or die(header("Location: ../frontend/modifica_profilo_candidato.php?error=".$cid->error));

    if($res -> num_rows > 0){
      continue;
    }

    $sql = "INSERT into disponeCandidato VALUES('$user', '$value')";
    $cid -> query($sql) or die(header("Location: ../frontend/modifica_profilo_candidato.php?error=".$cid->error));
  }
  mysqli_close($cid);
}

$ok = "Modifica avvenuta con successo";
header("Location: ../frontend/profilo_candidato.php?user=".$user."&msg=".$ok);



 ?>

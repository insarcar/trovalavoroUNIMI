<?php
session_start();
include("../common/setup.php");
include("../common/functions.php");
//setup dell'api
if(isset($_POST['action']) && !empty($_POST['action']) ){

        $action = $_POST['action'];
}
elseif (isset($_GET['action']) && !empty($_GET['action'])) {

        $action = $_GET['action'];
}
else{

    exit();

}

//controlla se il nome del curriculum è gia stato usato per il candidato
if($action == 'CONTROLLA_NOMECV'){

  $nomecv = filter_var($_POST["nomecv"], FILTER_SANITIZE_STRING);
  //query
  $sql = "SELECT COUNT(*) FROM curriculum WHERE email = '{$_SESSION['candidato']}' AND nomecv = '$nomecv'";
  $res = $cid -> query($sql);
  //feedback errore per debug
  if($cid -> error){
    echo $cid->error;
  }
  else{
    //se count > 0, significa che vi sono già curriculum del candidato con lo stesso nome
    $row = $res -> fetch_row();
    if($row[0] > 0){
      echo 'false';
    }
    else{
      //altrimenti ok
      echo 'true';
    }
  }

}
//controlla che la partita iva immessa sia univoca nel db
elseif($action == 'CONTROLLA_PIVA'){

  $piva = filter_var($_POST["piva"], FILTER_SANITIZE_STRING);
  //setup query
  $sql = "SELECT COUNT(*) FROM azienda where pIVA = '$piva'";
  $res = $cid -> query($sql);
  //feedback errore per debug
  if($cid -> error){
    echo $cid -> error;
  }
  else{
    //se count > 0, la partita iva è già presente nel db
    $row = $res -> fetch_row();
    if($row[0] > 0){
      echo 'false';
    }
    else{
      //altrimenti ok
      echo 'true';
    }
  }
}
//inserisce il commento nell'annuncio corrente
elseif($action == 'INS_COMMENTO'){

  $cont = filter_var($_POST["commento"], FILTER_SANITIZE_STRING);
  $ida = $_POST['ida'];
  //controllo il numero di commenti gia inseriti
  $ifsql = "SELECT COUNT(*) FROM commento where email = '{$_SESSION['candidato']}' and idannuncio = $ida";
  $res = $cid -> query($ifsql) or die (header("Location: ../frontend/annuncio.php?id=".$data['id']."&error=".$cid->error));
  $row = $res -> fetch_row();
  //se sono 3, o per qualche motivo ignoto, più di 3, errore
  if($row[0] >= 3){
    echo 'false';
  }

  else{
    //setting id del commento
    $sql = "SELECT COUNT(*) FROM commento";
    $res = $cid -> query($sql) or die (header("Location: ../frontend/annuncio.php?id=".$data['id']."&error=".$cid->error));
    $row = $res -> fetch_row();
    $idc = intval($row[0]);
    //inserimento
    $sql = "INSERT into commento values ('$idc', '$ida', '{$_SESSION['candidato']}', '$cont', default)";
    $cid -> query($sql) or die (header("Location: ../frontend/annuncio.php?id=".$data['id']."&error=".$cid->error));
    //estrazione dei commenti per ricaricare con l'ajax response
    $sql = "SELECT candidato.nome, candidato.cognome, candidato.email, candidato.foto, commento.data, commento.contenuto
            FROM commento join candidato on commento.email = candidato.email
            WHERE idannuncio = $ida";
    $res = $cid -> query($sql) or die($cid->error);

    $ret = array();
    $count = 0;
    //riempimento array di risposta
    while($row = $res -> fetch_row()){

      if($row[3] == null){
        $row[3] = 'empty';
      }
      $ret[$count] = $row;
      $count++;

    }
    //risposta
    echo json_encode($ret);

  }

}
//controllo validita email in login
elseif($action == 'LOGIN_EMAIL'){

  $type = $_POST['tipo'];
  $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
  //query
  $sql = "SELECT email FROM $type WHERE email = '$email';";
  $res = $cid -> query($sql);
  //feedback errore per debug
  if($cid->error){
    echo $cid->error;
  }
  else{
    //se non vi sono risultati l'email immessa non è valida
    if($res -> num_rows == 0){
      echo 'false';
    }
    else{
      echo 'true';
    }
  }

}
//controllo validita password al login
elseif($action == 'LOGIN_PASS'){

    $type = $_POST['tipo'];
    $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
    $pass = filter_var($_POST["pass"], FILTER_SANITIZE_STRING);
    //query
    $sql = "SELECT password FROM $type WHERE email = '$email'";
    $res = $cid -> query($sql);
    //feedback errore per debug
    if($cid->error){

      echo $cid->error;

    }
    else{
      //se la password viene immessa prima della mail
      if($res -> num_rows == 0){
        echo 'Immetti prima un email valida';
      }
      else{

        $row = $res -> fetch_row();
        //se la password immessa corrisponde ok, altrimenti errore
        if($row[0] == md5($pass) || $row[0] == $pass){

            echo 'true';
        }
        else{

            echo 'false';
        }
      }

    }
}
//reset delle notifiche alla visita della pagina delle candidature per il candidato
elseif($action == 'RESET_NOTIFICHE'){

  $ret = reset_notifiche($cid); //da functions.php
  echo $ret;


}
//controllo del periodo di visibilita di un annuncio, se scade setta a private
elseif($action == 'CHECK_VIS'){
  //se il periodo di visibilità è minore o uguale alla differenza tra data corrente e data di pubblicazione dell'annuncio (default in giorni), allora setta a private
  $sql = "UPDATE annuncio SET tipovisibilita = 'private' AND periodovisibilita = null WHERE periodovisibilita <= DATEDIFF(CURRENT_DATE, annuncio.datapubb)";
  $cid -> query($sql);
  //feedback errore per debug
  if($cid -> error){
    echo $cid -> error;
  }
  else{
    echo 'true';
  }

}
//risposta ad un annuncio con un curriculum gia inserito
elseif($action == 'RISPONDI'){

  $idc = $_POST['idc'];
  $ida = $_POST['ida'];
  //query
  $sqlif = "SELECT COUNT(*) FROM relativoA WHERE idcurriculum = '$idc' AND idannuncio = '$ida'";
  $res = $cid -> query($sqlif);
  //feedback errore per debug
  if($cid->error){

    echo $cid->error;

  }
  else{
    //se è gia stata inserita una risposta a quell'annuncio con quello stesso curriculum, errore
    $row = $res -> fetch_row();
    if($row[0]>0){

      echo "Hai gia risposto a questo annuncio con questo curriculum!";

    }
    else{
      //altrimenti insert
      $sql = "INSERT into relativoA values ('$ida', '$idc', null, null, null, null)";
      $cid -> query($sql);

      if($cid -> error){

        echo $cid -> error;

      }
      else{
        //restituzione del numero di candidature correnti all'annuncio
        $sql = "SELECT COUNT(*) FROM relativoA WHERE idannuncio = '$ida'";
        $res = $cid -> query($sql);

        if($cid->error){

          echo $cid -> error;

        }
        else{
          $row = $res -> fetch_row();
          $return = "Hai risposto con successo all'annuncio! (".$row[0].")";
          echo $return;
        }


      }
    }
  }
}
elseif($action == 'EMAIL_REG') {

  $email = filter_var($_POST["email"], FILTER_SANITIZE_STRING);
  $table = $_POST["table"];

  $sql = "SELECT COUNT(*) FROM $table WHERE email = '$email'";
  $res = $cid -> query($sql);
  if($cid->error){
    echo $cid -> error;
  }
  else{

    $row = $res -> fetch_row();
    if($row[0] > 0){

      echo 'false';

    }
    else{

      echo 'true';

    }
  }
}
else{
  //invalid action
	$msg = 'invalid action ' . $action;
	echo $msg;

}


 ?>

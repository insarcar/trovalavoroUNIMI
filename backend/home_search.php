<?php
session_start();

//explode dell'input della searchbar, con pulizia di ogni elemento
if(!empty($_POST["search"])){

  $keyword_tokens = explode(' ', $_POST["search"]);

  for($i = 0; $i < count($keyword_tokens); $i++) {
    $keyword_tokens[$i] = filter_var($keyword_tokens[$i], FILTER_SANITIZE_STRING);
  }
  //costruzione della stringa che costituirà la tabella surrogata nella query
  $kwds = implode("','",$keyword_tokens);

}

//selezione della query e del redirect in base all'utente
if(isset($_SESSION["azienda"])){
  //costruzione della query
  $sql = "SELECT DISTINCT candidato.nome, candidato.cognome, candidato.nomec, candidato.descrizione, candidato.email, candidato.foto FROM candidato ";
  $from = "";

  if(!empty($_POST["cit"])){
    //aggiunta del filtro di città
    $where = "WHERE candidato.nomec = '{$_POST['cit']}'";

    if(!empty($_POST["search"])){

      //aggiunta del filtro di searchbar
      $from = "join disponeCandidato on candidato.email = disponeCandidato.emailp ";
      $where .=  " AND (disponeCandidato.parola in ('$kwds'))"; //ricerco le parole nella tabella che ricadono nella tabella surrogata


    }

    $sql .= $from . $where;

  }
  elseif(!empty($_POST["search"])){
    //se non c'è il filtro di città selezionato
    $from = "join disponeCandidato on candidato.email = disponeCandidato.emailp ";
    $where = "WHERE disponeCandidato.parola in ('$kwds')";
    $sql .= $from . $where;

  }


  //redirect
  header("Location: ../frontend/candidati.php?data=".$sql);
}

else{
  //setup query
  $sql = "SELECT DISTINCT annuncio.descrizione, azienda.nome, annuncio.datapubb, annuncio.tipocontratto, annuncio.ngiorni, annuncio.datainizio, annuncio.datafine, azienda.email, annuncio.idannuncio, azienda.logo, annuncio.titolo FROM annuncio JOIN azienda ON annuncio.email = azienda.email ";
  $from = "";
  //se l'utente è candidato
  if(isset($_SESSION["candidato"])){
    //annunci pubblici e riservati al candidato
    $where = "WHERE (annuncio.tipovisibilita = 'public' or annuncio.tipovisibilita = 'specific' and annuncio.tiposettore in (SELECT esplicita.tiposettore FROM curriculum join esplicita on curriculum.idcurriculum = esplicita.idcurriculum WHERE curriculum.email = '{$_SESSION['candidato']}'))";

  }
  else{
    //se è visitatore, solo annunci pubblici
    $where = "WHERE annuncio.tipovisibilita = 'public'";

  }


  if(!empty($_POST["cit"])){
    //filtro città
    $where = " AND azienda.nomec = '{$_POST['cit']}'";

    if(!empty($_POST["search"])){
      //filtro searchbar
      $from = "JOIN disponeAzienda on azienda.email = disponeAzienda.emailp ";
      $where .=  " AND (disponeAzienda.parola in ('$kwds'))";


    }

    $sql .= $from . $where;

  }
  elseif(!empty($_POST["search"])){
    //solo filtro searchbar
    $from = "JOIN disponeAzienda on azienda.email = disponeAzienda.emailp ";
    $where = " AND (disponeAzienda.parola in ('$kwds'))";
    $sql .= $from . $where;

  }
  else{
    $sql .= $from . $where;
  }

  //redirect
  header("Location: ../frontend/annunci.php?data=".$sql);

}


 ?>

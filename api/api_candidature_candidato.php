<?php
session_start();
include("../common/setup.php");
include("leggi_candidature_candidato.php");
//setup dati
$companies = array();
$ads = array();
$results = array();

if (isset($_POST['companies']))
{
  $companies = json_decode($_POST['companies'], true);
}

if (isset($_POST['ads']))
{
  $ads = json_decode($_POST['ads'], true);
}

if (isset($_POST['results']))
{
  $results = json_decode($_POST['results'], true);
}

if(isset($_POST['searchbar'])){
  $search = $_POST['searchbar'];
}

//se ho delle aziende in input
if(!empty($companies))
{
  $sql  = substr($sql, 0, strlen($sql)-1);
  //AND con le espressioni precedenti
  $sql .= " && (azienda.email = ";
  //OR con le espressioni interne
  $iter = " || azienda.email = ";

  for($i=0; $i<count($companies); $i++)
  {   //costruzione
      if($i==0)
      {
        $sql .= "'" . $companies[$i] . "'";
      }
      else
      {
        $sql .= $iter . "'" . $companies[$i] . "'";
      }

      if($i==count($companies)-1)
      {
        $sql .= ");";
      }
  }
}

if(!empty($ads))
{
  $sql  = substr($sql, 0, strlen($sql)-1);
  $sql .= " && (annuncio.idannuncio = ";

  $iter = " || annuncio.idannuncio = ";

  for($i=0; $i<count($ads); $i++)
  {
      if($i==0)
      {
        $sql .= $ads[$i];
      }
      else
      {
        $sql .= $iter . $ads[$i];
      }

      if($i==count($ads)-1)
      {
        $sql .= ");";
      }
  }
}

if(!empty($results))
{
  $sql  = substr($sql, 0, strlen($sql)-1);
  $sql .= " && (relativoa.esito = ";

  $iter = " || relativoa.esito = ";

  for($i=0; $i<count($results); $i++)
  {
      if($i==0)
      {
        $sql .= $results[$i];
      }
      else
      {
        $sql .= $iter . $results[$i];
      }

      if($i==count($results)-1)
      {
        $sql .= ");";
      }
  }
}

//searchbar input
if(!empty($search)){
  $sql  = substr($sql, 0, strlen($sql)-1);
  //explode, pulizia, implode
  $keyword_tokens = explode(' ', $search);
  for($i = 0; $i < count($keyword_tokens); $i++) {
    $keyword_tokens[$i] = filter_var($keyword_tokens[$i], FILTER_SANITIZE_STRING);
  }
  $kwds = implode("','",$keyword_tokens);

  $sql .= " && disponeAzienda.emailp = azienda.email && disponeAzienda.parola IN ('$kwds');";

}
//invio espressione alla funzione che esegue la query finale
include("./func_api.php");
$result = leggi_api($cid, $sql);
$candidature = $result["contenuto"];

if(!empty($candidature))
{
  //stampa
  foreach ($candidature as $key => $value) {
    include("./scrivi_candidatura_candidato.php");
  }

}

else {

  echo "<h5 class='p-3'>Non sono presenti candidature di questo tipo<h5>";

}


?>

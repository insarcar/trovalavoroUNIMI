<?php
session_start();
include("../common/setup.php");
include("leggi_candidature_azienda.php");
//setup dati
$candidates = array();
$ads = array();

if (isset($_POST['candidates']))
{
  $candidates = json_decode($_POST['candidates'], true);
}

if (isset($_POST['ads']))
{
  $ads = json_decode($_POST['ads'], true);
}

if(isset($_POST['searchbar'])){
  $search = $_POST['searchbar'];
}

//se ho dei candidati selezionati
if(!empty($candidates))
{
  $sql  = substr($sql, 0, strlen($sql)-1);
  //AND con le espressioni precedenti
  $sql .= " && (candidato.email = ";
  //OR tra le espressioni interne
  $iter = " || candidato.email = ";

  for($i=0; $i<count($candidates); $i++)
  {   //costruzione
      if($i==0)
      {
        $sql .= "'" . $candidates[$i] . "'";
      }
      else
      {
        $sql .= $iter . "'" . $candidates[$i] . "'";
      }

      if($i==count($candidates)-1)
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

//se ho searchbar input, explode, pulizia, implode in pseudotabella
if(!empty($search)){
  $sql  = substr($sql, 0, strlen($sql)-1);

  $keyword_tokens = explode(' ', $search);
  for($i = 0; $i < count($keyword_tokens); $i++) {
    $keyword_tokens[$i] = filter_var($keyword_tokens[$i], FILTER_SANITIZE_STRING);
  }
  $kwds = implode("','",$keyword_tokens);

  $sql .= " && disponeCandidato.emailp = candidato.email && disponeCandidato.parola IN ('$kwds');";

}
//invio espressione alla funzione che esegue la query finale
include("./func_api.php");
$result = leggi_api($cid, $sql);
$candidature = $result["contenuto"];
//stampa
if(!empty($candidature))
{

  foreach ($candidature as $key => $value) {
    include("./scrivi_candidatura_azienda.php");
  }

}

else {
echo "<h5 class='p-3'>Non sono presenti candidature di questo tipo<h5>";
}


?>

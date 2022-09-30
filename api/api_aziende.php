<?php

include("../common/setup.php");
include("./leggi_azienda.php");
//setup dati
$city = array();
$sectors = array();
$contracts = array();
$where = false;

if (isset($_POST['city']))
{
  $city = json_decode($_POST['city'], true);
}

if (isset($_POST['times']))
{
  $times = json_decode($_POST['times'], true);
}

if (isset($_POST['sectors']))
{
  $sectors = json_decode($_POST['sectors'], true);
}

if (isset($_POST['contracts']))
{
  $contracts = json_decode($_POST['contracts'], true);
}
if(isset($_POST['searchbar'])){
  $search = $_POST['searchbar'];
}

if(!empty($search)){
  //qui non ce la caviamo col LEFT join
  //dobbiamo quindi mettere il join con la clausola where in testa
  $sql  = substr($sql, 0, strlen($sql)-1);
  //explode e pulizia
  $keyword_tokens = explode(' ', $search);
  for($i = 0; $i < count($keyword_tokens); $i++) {
    $keyword_tokens[$i] = filter_var($keyword_tokens[$i], FILTER_SANITIZE_STRING);
  }
  //setup pseudotabella
  $kwds = implode("','",$keyword_tokens);

  $sql .= " JOIN disponeAzienda on azienda.email = disponeAzienda.emailp WHERE disponeAzienda.parola IN ('$kwds');";
  //where è usato per determinare se le espressioni successive cominciano con un WHERE o con un AND ( ...
  $where = true;

}
//se ho delle città
if(!empty($city))
{

  $sql  = substr($sql, 0, strlen($sql)-1);
  //se il predicato WHERE è ancora vuoto
  if ($where === false){
    $sql .= " WHERE (azienda.nomec = ";
    $where = true;
  }
  else {
    //altrimenti AND con le espressioni precedenti
    $sql .= " && (azienda.nomec = ";
  }
  //OR tra gli elementi interni
  $iter = " || azienda.nomec = ";

  for($i=0; $i<count($city); $i++)
  {
      if($i==0)
      {
        $sql .= "'" . $city[$i] . "'";
      }
      else
      {
        $sql .= $iter . "'" . $city[$i] . "'";
      }

      if($i==count($city)-1)
      {
        $sql .= ");";
      }
  }
}


if(!empty($sectors))
{
  $sql  = substr($sql, 0, strlen($sql)-1);

  if ($where === false){
    $sql .= " WHERE (annuncio.tiposettore = ";
    $where = true;
  }
  else {
    $sql .= " && (annuncio.tiposettore = ";
  }

  $iter = " || annuncio.tiposettore = ";

  for($i=0; $i<count($sectors); $i++)
  {
      if($i==0)
      {
        $sql .= "'" . $sectors[$i] . "'";
      }
      else
      {
        $sql .= $iter . "'" . $sectors[$i] . "'";
      }

      if($i==count($sectors)-1)
      {
        $sql .= ");";
      }
  }
}

if(!empty($contracts))
{
  $sql  = substr($sql, 0, strlen($sql)-1);

  if ($where === false){
    $sql .= " WHERE (annuncio.tipocontratto = ";
    $where = true;
  }
  else {
    $sql .= " && (annuncio.tipocontratto = ";
  }

  $iter = " || annuncio.tipocontratto = ";

  for($i=0; $i<count($contracts); $i++)
  {
      if($i==0)
      {
        $sql .= "'" . $contracts[$i] . "'";
      }
      else
      {
        $sql .= $iter . "'" . $contracts[$i] . "'";
      }

      if($i==count($contracts)-1)
      {
        $sql .= ");";
      }
  }
}

//mando la stringa alla funzione, che monta il pezzo finale di query e la esegue
include("./func_api.php");
$result = leggi_api($cid, $sql);
$aziende = $result["contenuto"];
//stampa risultato, o messaggio se non trova niente
if(!empty($aziende))
{
  foreach ($aziende as $key => $value) {
    include("./scrivi_azienda.php");
  }
}
else {
  echo "<h3 class='center'> Ci dispiace ma al momento non sono disponibili aziende con queste caratteristiche. </h3>";
}

?>

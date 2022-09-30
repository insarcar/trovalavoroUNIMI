<?php
session_start();
include("../common/setup.php");
include("leggi_annuncio.php");
//setup array dati
$city = array();
$times = array();
$sectors = array();
$contracts = array();

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
if(isset($_POST['orderbydate'])){
  $order = $_POST['orderbydate'];
}

//se ho delle città
if(!empty($city))
{
  $sql  = substr($sql, 0, strlen($sql)-1);
  //AND con l'espressione booleana che precede le città
  $sql .= " && (azienda.nomec = ";
  //OR tra le città
  $iter = " || azienda.nomec = ";

  for($i=0; $i<count($city); $i++)
  {   //costruzione del pezzo di query
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
//se ho delle date
if(!empty($times))
{
  $sql  = substr($sql, 0, strlen($sql)-1);
  //AND con le espressioni precedenti
  $sql .= " && (DATEDIFF(CURRENT_DATE, annuncio.datapubb) < ";
  //OR tra le date
  $iter = " || DATEDIFF(CURRENT_DATE, annuncio.datapubb) < ";

  for($i=0; $i<count($times); $i++)
  {   //costruzione
      if($i==0)
      {
        $sql .= "'" . $times[$i] . "'";
      }
      else
      {
        $sql .= $iter . "'" . $times[$i] . "'";
      }

      if($i==count($times)-1)
      {
        $sql .= ");";
      }
  }
}
//se ho dei settori lavorativi
if(!empty($sectors))
{
  $sql  = substr($sql, 0, strlen($sql)-1);
  //AND con le espressioni precedenti
  $sql .= " && (annuncio.tiposettore = ";
  //OR tra i settori
  $iter = " || annuncio.tiposettore = ";

  for($i=0; $i<count($sectors); $i++)
  {   //costruzione
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
//se ho delle tipologie di contratto
if(!empty($contracts))
{
  $sql  = substr($sql, 0, strlen($sql)-1);
  //AND con le espressioni precedenti
  $sql .= " && (annuncio.tipocontratto = ";
  //OR tra le tipologie di contratto
  $iter = " || annuncio.tipocontratto = ";

  for($i=0; $i<count($contracts); $i++)
  {   //costruzione
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
//se ho input dalla searchbar
if(!empty($search)){
  $sql  = substr($sql, 0, strlen($sql)-1);
  //explode e pulizia
  $keyword_tokens = explode(' ', $search);
  for($i = 0; $i < count($keyword_tokens); $i++) {
    $keyword_tokens[$i] = filter_var($keyword_tokens[$i], FILTER_SANITIZE_STRING);
  }
  //costruzione della pseudo tabella
  $kwds = implode("','",$keyword_tokens);
  //query
  $sql .= " && disponeAzienda.emailp = azienda.email && disponeAzienda.parola IN ('$kwds');";

}
//se ho un order by
if(!empty($order)){
  $sql  = substr($sql, 0, strlen($sql)-1);
  $sql .= " ORDER BY datapubb $order;";
}
//manda l'espressione costruita alla funzione, che eseguirà la query e restituirà il risultato
include("./func_api.php");
$result = leggi_api($cid, $sql);
$annunci = $result["contenuto"];

if(!empty($annunci))
{ //stampa degli elementi (ovvero manda la response in ciclo)
  foreach ($annunci as $key => $value) {
    include("./scrivi_annuncio.php");
  }
}
else {
  //se non vi sono risultati
  echo "<h3 class='center'> Ci dispiace ma al momento non sono disponibili annunci con queste caratteristiche. </h3>";
}

?>

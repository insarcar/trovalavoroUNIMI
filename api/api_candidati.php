<?php
session_start();
include("../common/setup.php");
include("./leggi_candidato.php");
//setup dati
$city = array();
$sectors = array();
$languages = array();
$studies = array();
$where = false;


if (isset($_POST['city']))
{
  $city = json_decode($_POST['city'], true);
}

if (isset($_POST['sectors']))
{
  $sectors = json_decode($_POST['sectors'], true);
}

if (isset($_POST['languages']))
{
  $languages = json_decode($_POST['languages'], true);
}


if (isset($_POST['studies']))
{
  $studies = json_decode($_POST['studies'], true);
}

if(isset($_POST['searchbar'])){
  $search = $_POST['searchbar'];
}

//setup dei predicati di join a seconda dei risultati, anche qui i LEFT join non bastano
if(!empty($city) || !empty($sectors) || !empty($languages) || !empty($studies)){
  $sql = substr($sql, 0, strlen($sql)-1);
  $sql .= " JOIN curriculum on curriculum.email = candidato.email
  JOIN esplicita on curriculum.idcurriculum = esplicita.idcurriculum;";
}
else {
  $sql = "SELECT DISTINCT candidato.nome, candidato.cognome, candidato.nomec, candidato.descrizione, candidato.email, candidato.foto
          FROM candidato;";
}

if(!empty($city) && empty($sectors) && empty($languages) && empty($studies)) {
  $sql = "SELECT DISTINCT candidato.nome, candidato.cognome, candidato.nomec, candidato.descrizione, candidato.email, candidato.foto
          FROM candidato;";
}
if(!empty($search)){
  $sql = substr($sql, 0, strlen($sql)-1);
  $sql .= " JOIN disponeCandidato on candidato.email = disponeCandidato.emailp;";
}

//se ho delle città selezionate
if(!empty($city))
{
  $sql  = substr($sql, 0, strlen($sql)-1);
  //se il predicato WHERE è ancora vuoto
  if ($where === false){
    $sql .= " WHERE (candidato.nomec = ";
    $where = true;
  }
  else {
    //altrimenti AND con le espressioni precedenti
    $sql .= " && (candidato.nomec = ";
  }
  //OR tra le espressioni interne
  $iter = " || candidato.nomec = ";

  for($i=0; $i<count($city); $i++)
  {   //costruzione
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
  $sql = substr($sql, 0, strlen($sql)-1);

  if ($where === false){
    $sql .= " WHERE (esplicita.tiposettore = ";
    $where = true;
  }else{
    $sql .= " && (esplicita.tiposettore = ";
  }

  $iter = " || esplicita.tiposettore = ";

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

if(!empty($languages))
{
  $sql  = substr($sql, 0, strlen($sql)-1);

  if ($where === false){
    $sql .= " WHERE (esplicita.nome = ";
    $where = true;
  }
  else {
    $sql .= " && (esplicita.nome = ";
  }

  $iter = " || esplicita.nome = ";

  for($i=0; $i<count($languages); $i++)
  {
      if($i==0)
      {
        $sql .= "'" . $languages[$i] . "'";
      }
      else
      {
        $sql .= $iter . "'" . $languages[$i] . "'";
      }

      if($i==count($languages)-1)
      {
        $sql .= ");";
      }
  }
}

if(!empty($studies))
{
  $sql  = substr($sql, 0, strlen($sql)-1);

  if ($where === false){
    $sql .= " WHERE (esplicita.ordscolastico = ";
    $where = true;
  }
  else {
    $sql .= " && (esplicita.ordscolastico = ";
  }

  $iter = " || esplicita.ordscolastico = ";

  for($i=0; $i<count($studies); $i++)
  {
      if($i==0)
      {
        $sql .= "'" . $studies[$i] . "'";
      }
      else
      {
        $sql .= $iter . "'" . $studies[$i] . "'";
      }

      if($i==count($studies)-1)
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
  //implode in pseudotabella
  $kwds = implode("','",$keyword_tokens);

  $sql .= " && disponeCandidato.parola IN ('$kwds')";

}

//mando l'espressione alla funzione che esegue la query finale
include("./func_api.php");
$result = leggi_api($cid, $sql);
$candidati = $result["contenuto"];
//stampa
if(!empty($candidati))
{
  foreach ($candidati as $key => $value) {
    include("./scrivi_candidato.php");
  }
}
else {
  echo "<h3> Ci dispiace ma al momento non sono disponibili candidati con queste caratteristiche. </h3>";
}
?>

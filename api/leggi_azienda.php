<?php
//query di base inviata con l'include all'api
$sql = "SELECT DISTINCT azienda.nome, azienda.nomec, azienda.descrizione, azienda.logo, azienda.email
        FROM azienda
        LEFT JOIN annuncio ON azienda.email = annuncio.email;";

//funzione che esegue la query finale
/*function leggiAziende_api($cid, $sql)
{
  $n=0;

  $aziende=array();
  $risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");

  if ($cid->connect_errno) {
    $risultato["status"]="ko";
    $risultato["msg"]="Impossibile connettersi al database " . $cid->connect_error;
    return $risultato;
  }

  $res = $cid->query($sql);

  if ($res==null)
  {
    $risultato["status"]="ko";
    $risultato["msg"]="Non è stato possibile trovare alcun risultato " . $cid->error;
    return $risultato;
  }

  while($row=$res->fetch_row())
  {
    $aziende[$n]=$row;
    $n++;
  }

  $risultato["contenuto"]=$aziende;
  return $risultato;
}*/


 ?>

<?php
//query di base inviata attraverso l'include
$sql = "SELECT DISTINCT candidato.nome, candidato.cognome, candidato.nomec, candidato.descrizione, candidato.email, candidato.foto
        FROM candidato;";

//funzione che esegue la query finale
/*function leggiCandidati_api($cid, $sql)
{
  $n=0;

  $candidati=array();
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
    $candidati[$n]=$row;
    $n++;
  }

  $risultato["contenuto"]=$candidati;
  return $risultato;
}
*/
?>

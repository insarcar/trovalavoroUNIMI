<?php
//query di base inviata all'api
  if(isset($_SESSION["azienda"]))
  {

      $sql = "SELECT DISTINCT annuncio.titolo, candidato.nome, candidato.cognome, curriculum.nomecv, annuncio.idannuncio, curriculum.idcurriculum, candidato.email
              FROM relativoA JOIN annuncio on relativoA.idannuncio = annuncio.idannuncio
              JOIN curriculum on relativoA.idcurriculum = curriculum.idcurriculum
              JOIN azienda on annuncio.email = azienda.email
              JOIN candidato on curriculum.email = candidato.email
              LEFT JOIN disponeCandidato on curriculum.email = disponeCandidato.emailp
              WHERE azienda.email = '{$_SESSION['azienda']}';";
 }

//funzione che esegue la query finale
/*function leggiCandidatureAzienda_api($cid, $sql)
{

  $n=0;

  $candidature = array();
  $risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");

  if ($cid->connect_errno) {
    echo $cid -> connect_errno;
  }


  $res = $cid->query($sql);

  if ($cid->error)
  {
    echo $cid->error;
  }

  if ($res==null)
  {
    $risultato["status"]="ko";
    $risultato["msg"]="Non è stato possibile trovare alcun risultato " . $cid->error;
    return $risultato;
  }

  while($row=$res->fetch_row())
  {
    $candidature[$n]=$row;
    $n++;
  }

  $risultato["contenuto"]=$candidature;
  return $risultato;
}
*/
?>

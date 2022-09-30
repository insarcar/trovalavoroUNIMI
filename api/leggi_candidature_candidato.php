<?php
//query di base inviata all'api
if (isset($_SESSION["candidato"])) {

  $sql = "SELECT DISTINCT azienda.nome, annuncio.titolo, curriculum.nomecv, relativoA.giudizio, relativoA.esito, relativoA.motivazione, azienda.email, annuncio.idannuncio, curriculum.idcurriculum
          FROM relativoA JOIN annuncio on relativoA.idannuncio = annuncio.idannuncio
          JOIN curriculum on relativoA.idcurriculum = curriculum.idcurriculum
          JOIN azienda on annuncio.email = azienda.email
          JOIN candidato on curriculum.email = candidato.email
          LEFT JOIN disponeAzienda on annuncio.email = disponeAzienda.emailp
          WHERE candidato.email = '{$_SESSION['candidato']}';";

}
/*funzione ch eesegue la query finale
function leggiCandidatureCandidato_api($cid, $sql)
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

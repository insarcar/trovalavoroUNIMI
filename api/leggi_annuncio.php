<?php
  if(isset($_SESSION["candidato"]))
  { //query di base per gli annunci pubblici e riservati
    $sql = "SELECT DISTINCT annuncio.descrizione, azienda.nome, annuncio.datapubb,
            annuncio.tipocontratto, annuncio.ngiorni, annuncio.datainizio, annuncio.datafine,
            azienda.email, annuncio.idannuncio, azienda.logo, annuncio.titolo

            FROM annuncio
            JOIN azienda ON annuncio.email = azienda.email
            LEFT JOIN disponeAzienda ON azienda.email = disponeAzienda.emailp

            WHERE (annuncio.tipovisibilita = 'public' || annuncio.tipovisibilita = 'specific'
            and annuncio.tiposettore in
            (SELECT esplicita.tiposettore
            FROM curriculum JOIN esplicita ON curriculum.idcurriculum = esplicita.idcurriculum
            WHERE curriculum.email = '{$_SESSION['candidato']}'));";
  }
  else {  //query per gli annunci pubblici (visitors)
    $sql = "SELECT DISTINCT annuncio.descrizione, azienda.nome, annuncio.datapubb,
            annuncio.tipocontratto, annuncio.ngiorni, annuncio.datainizio, annuncio.datafine,
            azienda.email, annuncio.idannuncio, azienda.logo, annuncio.titolo

            FROM annuncio
            JOIN azienda ON annuncio.email = azienda.email
            LEFT JOIN disponeAzienda ON azienda.email = disponeAzienda.emailp

            WHERE annuncio.tipovisibilita = 'public';";
  }
//la query di base viene mandata all'api con l'include ad inizio pagina
/*la funzione la esegue
function leggiAnnunci_api($cid, $sql)
{

  $n=0;

  $annunci=array();
  $risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");

  if ($cid->connect_errno) {
    echo $cid -> connect_errno;
  }


  $res = $cid->query($sql);

  if ($cid->error)
  {//feedback per debug
    echo $cid->error;
    }

  while($row=$res->fetch_row())
  {
    $annunci[$n]=$row;
    $n++;
  }

  $risultato["contenuto"]=$annunci;
  return $risultato;
}*/

?>

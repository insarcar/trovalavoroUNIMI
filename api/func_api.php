<?php
//funzione ch eesegue la query finale
function leggi_api($cid, $sql)
{

 $n=0;

 $ricerca = array();
 $risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");

 if ($cid->connect_errno) {
   echo $cid -> connect_errno;
 }


 $res = $cid->query($sql);

 if ($cid->error)
 { //feedback per debug
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
   $ricerca[$n]=$row;
   $n++;
 }

 $risultato["contenuto"]=$ricerca;
 return $risultato;
}

 ?>

<?php
//query per risolvere alcuni problemi di inserimento di valori null (validi) sui quali capita che il db si incarti
function db_unstiff($cid){
  $sql = "SET @@global.sql_mode = 'NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION'";
  $cid -> query($sql);
}
function load_cit($cid){
//caricamento delle citta per la selezione
  $sql = "SELECT nome FROM citta order by nome";
  $res = $cid->query($sql) or die($cid->error);
  $n = 0;
  $ret = array();
  //riempimento
  while($row = $res->fetch_row()){
    $ret[$n] = $row[0];
    $n ++;
  }
  //eliminazione doppioni
  $ret = array_unique($ret, SORT_STRING);
  return $ret;
}
//caricamento server side degli annunci, chiamata nel caso in cui si giunga senza ricerche alla pagina di scorrimento
function leggiAnnunci($cid)
{

  $n=0;
  //setup risposta

  $annunci=array();
  $risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");

  //se è loggato un candidato la query assume forma più specifica
  if(isset($_SESSION["candidato"])){

    $sql = "SELECT annuncio.descrizione, azienda.nome, annuncio.datapubb,
            annuncio.tipocontratto, annuncio.ngiorni, annuncio.datainizio, annuncio.datafine, azienda.email, annuncio.idannuncio, azienda.logo, annuncio.titolo

            FROM annuncio
            JOIN azienda ON annuncio.email = azienda.email

            WHERE annuncio.tipovisibilita = 'public' or annuncio.tipovisibilita = 'specific' and annuncio.tiposettore in
            (SELECT esplicita.tiposettore
            FROM curriculum join esplicita on curriculum.idcurriculum = esplicita.idcurriculum
            WHERE curriculum.email = '{$_SESSION['candidato']}')";
            //cerca annunci pubblici e annunci riservati al candidato
  }
  else{
    //se invece c'è un visitatore cerca solo annunci pubblici
    $sql = "SELECT annuncio.descrizione, azienda.nome, annuncio.datapubb,
            annuncio.tipocontratto, annuncio.ngiorni, annuncio.datainizio, annuncio.datafine, azienda.email, annuncio.idannuncio, azienda.logo, annuncio.titolo

            FROM annuncio
            JOIN azienda ON annuncio.email = azienda.email

            WHERE annuncio.tipovisibilita = 'public';";

  }
  //esecuzione query
  $res = $cid->query($sql) or die();
  //se non c'è risultato
  if ($res==null)
  {
    $risultato["status"]="ko";
    $risultato["msg"]="Non è stato possibile trovare alcun risultato " . $cid->error;
    return $risultato;
  }
  //riempimento
  while($row=$res->fetch_row())
  {
    $annunci[$n]=$row;
    $n++;
  }
  //risposta
  $risultato["contenuto"]=$annunci;
  return $risultato;
}


//lettura delle aziende per la pagina di scorrimento delle aziende
function leggiAziende($cid)
{
  $n=0;
  //setup risultato
  $annunci=array();
  $risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");
  //query
  $sql = "SELECT DISTINCT azienda.nome, azienda.nomec, azienda.descrizione, azienda.logo, azienda.email
          FROM azienda;";

  $res = $cid->query($sql);
  //se non c'è risultato
  if ($res==null)
  {
    $risultato["status"]="ko";
    $risultato["msg"]="Non è stato possibile trovare alcun risultato " . $cid->error;
    return $risultato;
  }
  //se c'è, riempimento
  while($row=$res->fetch_row())
  {
    $aziende[$n]=$row;
    $n++;
  }
  //return
  $risultato["contenuto"]=$aziende;
  return $risultato;
}


//lettura dei candidati per la relativa pagina di scorrimento, quando vi si giunge senza ricerche
function leggiCandidati($cid)
{
  $n=0;
  //setup risultato
  $annunci=array();
  $risultato = array("status"=>"ok","msg"=>"", "contenuto"=>"");

  //query
  $sql = "SELECT DISTINCT candidato.nome, candidato.cognome, candidato.nomec, candidato.descrizione, candidato.email, candidato.foto
          FROM candidato;";

  $res = $cid->query($sql);
  //se non c'è risultato
  if ($res==null)
  {
    $risultato["status"]="ko";
    $risultato["msg"]="Non è stato possibile trovare alcun risultato " . $cid->error;
    return $risultato;
  }
  //se c'è, riempimento
  while($row=$res->fetch_row())
  {
    $candidati[$n]=$row;
    $n++;
  }
  //return
  $risultato["contenuto"]=$candidati;
  return $risultato;
}


//LOGIN: CONTROLLO EMAIL E PASSWORD, PER OGNI MANCANZA DI CORRISPONDENZA, O FAULT DI QUALUNQUE TIPO RITORNO UN MESSAGGIO DI ERRORE ALLA HOME
function login($user, $pwd, $type, $cid, $url, $rem){
  //CONTROLLO PRESENZA DATI
  if(isset($user)){
    //CONTROLLO EMAIL
    $query = "select email from $type where email = '$user';";
    $res = $cid -> query($query) or die (header("Location: ../frontend/home.php?status=ko&error=".$error));
    if($res -> num_rows == 0){
      mysqli_close($cid);
      $error = "Email non valida! Furbetto/a hai cambiato il radio button!";
      header("Location: ../frontend/home.php?status=ko&error=". $error);
    }
    else{
      //CONTROLLO PSW
      $error = "Impossibile accedere al momento, ritenta più tardi, o contatta l'assistenza";
      $query = "select password from $type where email = '$user';";
      $res = $cid -> query($query) or die (header("Location: welcome.php?status=ko&error=".$error));
      $row = $res -> fetch_row();
      if($row[0] == $pwd || $row[0] == md5($pwd)){
        //CHIUDI CONNESSIONE, SETTA SESSIONE
        mysqli_close($cid);
        session_start();
        $_SESSION[$type] = $user;
        //REMEMBER ME: SE CHECKATO SETTA IL COOKIE, ALTRIMENTI SE IL COOKIE E' GIA' SETTATO DISTRUGGILO
        if(!empty($rem)) {
				      setcookie ("member_login",$user,time()+ (10 * 365 * 24 * 60 * 60));
			  }
        else {
  				if(isset($_COOKIE["member_login"])) {
  					setcookie ("member_login","");
  				}
        }
        //TORNA ALLA PAGINA
        if(strpos($url,"/TrovaLavoroUnimi/frontend/index") !== false || strpos($url,"registrazione") !== false|| strpos($url,".php") == false){
          header("Location: ../frontend/home.php");
        }
        else{
            header("Location: ".$url);
        }

      }
      else{
        mysqli_close($cid);
        $error = "Password non valida! Oppure hai cambiato il radio button all'ultimo";
        header("Location: ../frontend/home.php?status=ko&error=". $error . "&user=" . $user);
      }
    }
  }
  else{
    mysqli_close($cid);
    $error = "Prego inserire email e password";
    header("Location: ../frontend/home.php?status=ko&error=".$error);
  }
}



//INSERIMENTO AZIENDA: CONTROLLO PRIMA DI TUTTO SE LA CITTA' INSERITA E' GIA' NEL DB, E IN BASE AL RISULTATO INSERISCO I VALORI OLTRE CHE NELLA TABELLA DELL'UTENTE ANCHE NELLA TABELLA CITTA'
function insert_azienda($dati, $cid){

  $query = "select nome, cap from citta where nome = '{$dati['cit']}' and cap = '{$dati['cap']}'";
  $res = $cid -> query($query) or die (header("Location: ../frontend/registrazione_azienda.php?status=ko&error=".$cid->error."&dati=".serialize($dati)));

  if($res -> num_rows == 0){ //SE LA CITTA' NON VIENE TROVATA LA INSERISCO
    $query = "insert into citta values ('{$dati['cap']}', '{$dati['cit']}');";
    $res = $cid -> query($query) or die (header("Location: ../frontend/frontend/registrazione_azienda.php?status=ko&error=".$cid->error."&dati=".serialize($dati)));
  }
  //INSERIMENTO NELLA TABELLA AZIENDA
  $dati["pass"] = md5($dati["pass"]); //CRIPTO PASSWORD
  $query = "insert into azienda values ('{$dati['user']}', '{$dati['piva']}', '{$dati['pass']}', '{$dati['ragsoc']}', '{$dati['tel']}', '{$dati['fullvia']}', '{$dati['nciv']}', '{$dati['cap']}', '{$dati['cit']}', null,
   '{$dati['nome']}', null, null);";
  $res = $cid -> query($query) or die (header("Location: ../frontend/registrazione_azienda.php?status=ko&error=".$cid->error."&dati=".serialize($dati)));

  //inserimento nome dell'azienda tra le keywords
  $sqlif = "SELECT * FROM keyword where parola = '{$dati['nome']}'";
  $res = $cid -> query($sqlif);
  //controllo prima l'inserimento nella tabella riferita
  if($res -> num_rows == 0){

    $sql = "INSERT into keyword VALUES('{$dati['nome']}')";
    $cid -> query($sql);

  }
  //inserimento nella tabella referente
  $sql = "INSERT into disponeAzienda VALUES ('{$dati['user']}', '{$dati['nome']}')";
  $cid -> query($sql);

  session_start(); //APERTURA SESSIONE PER L'UTENTE APPENA REGISTRATO
  $_SESSION["azienda"] = $dati['user'];
  $ok = "Benvenuto {$dati['nome']}, configura il tuo profilo!";
  header("Location: ../frontend/profilo_azienda.php?user=".$_SESSION["azienda"]."&status=ok&msg=".$ok);
}
///INSERIMENTO CANDIDATO: STESSO PRINCIPIO DI INSERIMENTO AZIENDA
function insert_candidato($dati, $cid){
  //setup query città
  $query = "select nome, cap from citta where nome = '{$dati['cit']}' and cap = '{$dati['cap']}'";
  $res = $cid -> query($query) or die (header("Location:../frontend/registrazione_candidato.php?status=ko&error=".$cid->error."&dati=".serialize($dati)));
  //se la coppia città cap non è nella tabella città inserisci
  if($res -> num_rows == 0){

    $query = "insert into citta values ('{$dati['cap']}', '{$dati['cit']}');";
    $res = $cid -> query($query) or die (header("Location:../frontend/registrazione_candidato.php?status=ko&error=".$cid->error."&dati=".serialize($dati)));

  }
  //inserimento
  $dati['pass'] = md5($dati['pass']);
  $query = "insert into candidato values ('{$dati['user']}', '{$dati['pass']}', '{$dati['nome']}', '{$dati['cogn']}', '{$dati['datan']}', '{$dati['fullvia']}', '{$dati['nciv']}', '{$dati['cap']}', '{$dati['cit']}', null, null);";
  $res = $cid -> query($query) or die (header("Location:../frontend/registrazione_candidato.php?status=ko&error=".$cid->error."&dati=".serialize($dati)));
  //inserimento nome e cognome nelle keywords
  $sqlif = "SELECT * FROM keyword where parola = '{$dati['nome']}'";
  $res = $cid -> query($sqlif);

  if($res -> num_rows == 0){

    $sql = "INSERT into keyword VALUES('{$dati['nome']}')";
    $cid -> query($sql);

  }
  $sql = "INSERT into disponeCandidato VALUES ('{$dati['user']}', '{$dati['nome']}')";
  $cid -> query($sql);

  $sqlif = "SELECT * FROM keyword where parola = '{$dati['cogn']}'";
  $res = $cid -> query($sqlif);

  if($res -> num_rows == 0){

    $sql = "INSERT into keyword VALUES('{$dati['cogn']}')";
    $cid -> query($sql);

  }
  $sql = "INSERT into disponeCandidato VALUES ('{$dati['user']}', '{$dati['cogn']}')";
  $cid -> query($sql);
  //setup sessione
  session_start();
  $_SESSION["candidato"] = $dati['user'];
  //redirect al profilo
  $ok = "Benvenuto {$dati['nome']}, configura il tuo profilo!";
  header("Location: ../frontend/profilo_candidato.php?user=".$_SESSION["candidato"]."&status=ok&msg=".$ok);
}

//CARICAMENTO DATI DI UN PROFILO UTENTE: SELEZIONO LA TABELLA DA CUI ESTRARRE I DATI IN BASE AL TIPO DI UTENTE RICERCATO
function load_profile($user, $type, $cid){

  if($type == "azienda"){
      $query = "select nome, pIva, ragionesociale, cap, nomec, telefono, via, numero, descrizione, logo, foto from azienda where email = '$user'";
      $res = $cid -> query($query) or die (header("Location: ../home.php?error=".$cid->error));
      if($res-> num_rows != 0){
        $row = $res -> fetch_row();
        $data = array();
        $data["nome"] = $row[0];
        $data["piva"] = $row[1];
        $data["rag"] = $row[2];
        $data["cap"] = $row[3];
        $data["cit"] = $row[4];
        $data["tel"] = $row[5];
        $data["adr"] = $row[6]." ".$row[7];
        $data["descr"] = $row[8];
        $data["logo"] = $row[9];
        $data["foto"] = $row[10];

        return $data;
      }
      else {
        $error = "Profilo non trovato";
        header("Location: ../frontend/home.php?error=".$error);
      }
  }
  elseif($type == "candidato"){
    $query = "select nome, cognome, datan, cap, nomec, via, numero, descrizione, foto from candidato where email = '$user'";
    $res = $cid -> query($query) or die (header("Location: ../home.php?error=".$cid->error));
    if($res-> num_rows != 0){
      $row = $res -> fetch_row();
      $data = array();
      $data["nome"] = $row[0];
      $data["cognome"] = $row[1];
      $data["datan"] = $row[2];
      $data["cap"] = $row[3];
      $data["cit"] = $row[4];
      $data["adr"] = $row[5]." ".$row[6];
      $data["descr"] = $row[7];
      $data["foto"] = $row[8];
      return $data;
    }
    else {
      $error = "Profilo non trovato";
      header("Location: ../frontend/home.php?error=".$error);
    }
  }
  else{
    $error = "Errore nella ricerca del profilo";
    header("Location: ../frontend/home.php?error=".$error);

  }
}
//CARICAMENTO DEI DATI DI UN ANNUNCIO
function load_annuncio($id, $cid){

  $sql = "SELECT annuncio.titolo, azienda.nome, azienda.email, annuncio.tiposettore, annuncio.datapubb, annuncio.descrizione, annuncio.tipocontratto, annuncio.datainizio, annuncio.retrlorda, annuncio.datafine, annuncio.durata, annuncio.ngiorni, azienda.logo
          FROM annuncio join azienda on annuncio.email = azienda.email
          WHERE annuncio.idannuncio = '$id'";
  $res = $cid -> query($sql) or die (header("Location: ../frontend/home.php?error=".$cid->error));
  if($res -> num_rows != 0){
    $row = $res -> fetch_row();
    $data = array();
    $data["tit"] = $row[0];
    $data["nome"] = $row[1];
    $data["email"] = $row[2];
    $data["sett"] = $row[3];
    $data["data"] = $row[4];
    $data["descr"] = $row[5];
    $data["contr"] = $row[6];
    $data["datai"] = $row[7];
    $data["retr"] = $row[8];
    $data["dataf"] = $row[9];
    $data["dur"] = $row[10];
    $data["giorni"] = $row[11];
    $data["logo"] = $row[12];
    return $data;
  }
  else{
    $error = "Errore nella ricerca dell'annuncio";
    header("Location: ../frontend/home.php?error=".$error);
  }
}
//CARICAMENTO DEI DATI DI UN CURRICULUM
function load_curriculum($id, $cid){

  $sql = "SELECT curriculum.nomecv, candidato.nome, candidato.cognome, candidato.email, curriculum.descrizione, candidato.foto
          FROM curriculum join candidato on curriculum.email = candidato.email
          WHERE curriculum.idcurriculum = '$id'";
  $res = $cid -> query($sql) or die (header("Location: ../home.php?error=".$cid->error));
  if($res -> num_rows != 0){
    $row = $res -> fetch_row();
    $data = array();
    $data["nomecv"] = $row[0];
    $data["nome"] = $row[1];
    $data["cognome"] = $row[2];
    $data["email"] = $row[3];
    $data["descr"] = $row[4];
    $data["foto"] = $row[5];
    return $data;
  }
  else{
    $error = "Errore nella ricerca del curriculum";
    header("Location: ../frontend/home.php?error=".$error);
  }

}
//CARICAMENTO E STAMPA DELLE COMPETENZE ESPRESSE O RICHIESTE
function load_competenze($id, $tipo, $cid){
    //SELEZIONE DELLA TABELLA ESPRESSE O RICHIESTE
    if($tipo == 'curriculum'){
      $sql = "SELECT tiposettore, tipoesperienza, periodo, titolo, ordscolastico, votazione, nome, livello
              FROM esplicita
              WHERE idcurriculum = $id";
    }
    elseif($tipo == 'annuncio') {
      $sql = "SELECT tiposettore, tipoesperienza, periodo, titolo, ordscolastico, votazione, nome, livello
              FROM richiede
              WHERE idannuncio = $id";
    }
    else{
      echo "Errore fatale nella ricerca delle competenze";
      return false;
    }
    //QUERY
    $res = $cid -> query($sql) or die ($cid->error);
    if ($res -> num_rows == 0) {
      echo "Competenze non trovate";
      return false;
    }
    //INIT DEGLI ARRAY PER TIPO DI COMPETENZA (stringhe da stampare)
    $esp = array();
    $tit = array();
    $lang = array();
    $count = 0;

    //RIEMPIMENTO E COLLOCAZIONE DEI DATI
    if($tipo == 'curriculum'){

      while ($row=$res->fetch_row()) {
        $esp[$count] = $row[1]." nel settore ".$row[0]." per un periodo di ".$row[2]." mesi.";
        $tit[$count] = $row[3]." nell'ordine scolastico ".$row[4]." con voto ".$row[5].".";
        $lang[$count] = $row[6]." con livello ".$row[7].".";
        $count ++;
      }

    }
    else{

      while ($row=$res->fetch_row()) {
        if($row[5] == null){
            $tit[$count] = $row[3]." nell'ordine scolastico ".$row[4];
        }
        else {
            $tit[$count] = $row[3]." nell'ordine scolastico ".$row[4]." con voto minimo ".$row[5].".";
        }
        if ($row[7] == null) {
            $lang[$count] = $row[6];
        }
        else {
            $lang[$count] = $row[6]." con livello minimo ".$row[7].".";
        }
        $esp[$count] = $row[1]." nel settore ".$row[0]." per un periodo minimo di ".$row[2]." mesi.";


        $count ++;
      }

    }


    //ELIMINAZIONE DELLE RIDONDANZE

    $esp = array_unique($esp, SORT_STRING);
    $tit = array_unique($tit, SORT_STRING);
    $lang = array_unique($lang, SORT_STRING);

    //STAMPA
    echo "<li>Esperienze lavorative riportate:<br><ul>";
    foreach ($esp as $value) {
      echo "<li>$value</li>";
    }
    echo "</ul></li>";

    echo "<li>Titoli di studio riportati:<br><ul>";
    foreach ($tit as $value) {
      echo "<li>$value</li>";
    }
    echo "</ul></li>";

    echo "<li>Conoscenze di lingue riportate:<br><ul>";
    foreach ($lang as $value) {
      echo "<li>$value</li>";
    }
    echo "</ul></li>";

}
//CONTROLLA SE UN CURRICULUM E' IN RISPOSTA AD UN ANNUNCIO POSTATO DALL'UTENTE AZIENDA
function ctrl_risposta($user, $id, $cid){


  $sql = "SELECT * FROM relativoA join annuncio on relativoA.idannuncio = annuncio.idannuncio WHERE annuncio.email = '$user' and relativoA.idcurriculum = $id";
  $res = $cid -> query($sql) or die (header("Location: ../home.php?error=".$cid->error));

  return ($res -> num_rows != 0);

}
//RESTITUISCE IL SETTORE DALLA STRINGA TRONCATA DEL SELECT (capita, misteriosamente, che la stringa non pervenga intera al backend)
function get_settore($data){

  $sett  = array('Acquisti, logistica, magazzino' , 'Amministrazione, contabilita, segreteria' , 'Commercio al dettaglio, GDO, Retail' ,
          'Finanza, banche e credito' , 'Ingegneria' , 'Professioni e mestieri' , 'Settore farmaceutico' , 'Affari legali' , 'Arti grafiche, design'
           , 'Edilizia, immobiliare' , 'Formazione, istruzione' , 'Marketing, comunicazione' , 'Pubblica amministrazione' , 'Turismo, ristorazione'
           , 'Altre' , 'Attenzione al cliente' , 'Farmacia, medicina, salute' , 'Informatica, IT e telecomunicazioni'
           , 'Operai, produzione, qualita' , 'Risorse umane, recruiting' , 'Vendite');

    foreach ($sett as $value) {

      if(strpos($value,$data) !== false && strpos($value,$data) == 0){
        return $value;
      }
    }
}
//INSERIMENTO ANNUNCIO: SET ID, E INSERT
function ins_annuncio($data, $cid){
  //setup id
  $sql = "SELECT COUNT(*) FROM annuncio";
  $res = $cid -> query($sql) or die (header("Location: ../frontend/ins_annuncio.php?error=".$cid->error));
  $row = $res -> fetch_row();

  $data["id"] = intval($row[0]);

  $dur = intval($data["durata"]);
  //utilizzo NULLIF per i valori eventualmente nulli
  $sql = "INSERT into annuncio values
      ('{$data['id']}', '{$data['title']}', default, NULLIF('{$data['pvis']}', ''), '{$data['descr']}', NULLIF('{$data['retr']}', ''), '{$data['datai']}', '{$data['vis']}',
     '{$data['email']}',NULLIF('{$data['settl']}',''), '{$data['contra']}', NULLIF('$dur', 0), NULLIF('{$data['dataf']}',''), NULLIF('{$data['nlav']}', ''))";

  $res = $cid -> query($sql) or die (header("Location: ../frontend/ins_annuncio.php?error=".$cid->error));
  return $data;
}

//INSERIMENTO CURRICULUM: SE VIENE INSERITO IN RISPOSTA AD UN ANNUNCIO LO INSERISCO ANCHE IN RELATIVOA
function ins_curriculum($data, $cid){

  $sendback = ""; //serve in caso di errore per restituire l'id dell'annuncio in GET al frontend
  //setup id
  $sql = "SELECT COUNT(*) FROM curriculum";
  $res = $cid -> query($sql) or die (header("Location: ../frontend/ins_curriculum.php?error=".$cid->error.$sendback));
  $row = $res -> fetch_row();

  $data["id"] = intval($row[0]);

  if(isset($data["ida"])){
    //se arriva anche l'id dell'annuncio dal backend allora inserisco anche in risposta
    $sqlrel = "INSERT into relativoA values ('{$data['ida']}', '{$data['id']}', null, null, null, null)";
    $sendback = "&id=".$data["ida"];
  }


  //inserimento
  $sql = "INSERT into curriculum values ('{$data['id']}', '{$data['nomecv']}', '{$data['email']}', '{$data['prf']}', '{$data['descr']}')";

  $res = $cid -> query($sql) or die (header("Location: ../frontend/ins_curriculum.php?error=".$cid->error.$sendback));

  if(isset($data["ida"])){
    //carica in risposta se serve
      $res = $cid -> query($sqlrel) or die (header("Location: ../frontend/annuncio.php?error=".$cid->error.$sendback));
  }

  return $data;
}
//INSERIMENTO DELLE COMPETENZE: CONTROLLO ANCHE SE NELLA TABELLA DA CUI SONO REFERENZIATE SONO GIA' PRESENTI, SE NON LO SONO LE INSERISCO
function ins_competenze($data, $tipo, $cid){

  $sql = "INSERT into $tipo values('{$data['id']}', '{$data['sett']}', '{$data['esp']}', '{$data['ord']}', '{$data['tit']}', '{$data['lang']}', '{$data['per']}', NULLIF('{$data['vot']}',''), NULLIF('{$data['lvl']}', ''))";
  //query di inserimento
  $sqlif = "SELECT * FROM competenze WHERE tiposettore = '{$data['sett']}' and tipoesperienza = '{$data['esp']}' and ordscolastico = '{$data['ord']}' and titolo = '{$data['tit']}' and nome = '{$data['lang']}'";
  //query di ricerca nella tabella referenziata

  $res = $cid -> query($sqlif) or die(header("Location: ../frontend/ins_competenze.php?id=".$data["id"]."&error=".$cid->error));

  if($res -> num_rows == 0){
    $sqlif = "INSERT into competenze values('{$data['sett']}', '{$data['esp']}', '{$data['ord']}', '{$data['tit']}', '{$data['lang']}')";
    $res = $cid -> query($sqlif) or die(header("Location: ../frontend/ins_competenze.php?id=".$data["id"]."&error=".$cid->error));
  }

  $res = $cid -> query($sql) or die(header("Location: ../frontend/ins_competenze.php?id=".$data["id"]."&error=".$cid->error));

}

//INSERIMENTO COMMENTO CON CONTROLLO DI CONTEGGIO
/*function ins_commento($data, $cid){

  $ifsql = "SELECT COUNT(*) FROM commento where email = '{$data['email']}' and idannuncio = '{$data['id']}'";
  $res = $cid -> query($ifsql) or die (header("Location: ../frontend/annuncio.php?id=".$data['id']."&error=".$cid->error));
  $row = $res -> fetch_row();

  if($row[0] >= 3){
    $error = "Non puoi pubblicare ulteriori commenti per questo annuncio!";
    header("Location: ../frontend/annuncio.php?id=".$data['id']."&error=".$error);
  }

  else{

    $sql = "SELECT COUNT(*) FROM commento";
    $res = $cid -> query($sql) or die (header("Location: ../frontend/annuncio.php?id=".$data['id']."&error=".$cid->error));
    $row = $res -> fetch_row();
    $data["idc"] = intval($row[0]);

    $sql = "INSERT into commento values ('{$data['idc']}', '{$data['id']}', '{$data['email']}', '{$data['contenuto']}', default)";
    $res = $cid -> query($sql) or die (header("Location: ../frontend/annuncio.php?id=".$data['id']."&error=".$cid->error));
    header("Location: ../frontend/annuncio.php?id=".$data['id']);
  }
}*/
//CONTROLLO DI ACCESSO ALLA SERIE DI PAGINE SUCCESSIVE ALL'INSERIMENTO DEL CURRICULUM/ANNUNCIO
function check_proper($id,$cid){
  //selezione tabella in base all'utente
  if(isset($_SESSION["candidato"])){
    $table = "curriculum";
    $email = $_SESSION["candidato"];
  }
  elseif(isset($_SESSION["azienda"])){
    $table = "annuncio";
    $email = $_SESSION["azienda"];
  }
  else{
    return false;
  }
  //l'accesso è lecito non solo quando è settata la sessione giusta, ma l'id del curriculum o dell'annuncio corrisponde
  //a chi tenta di accedervi (in modifica eccetera)
  $sql = "SELECT COUNT(*)
          FROM $table
          WHERE email = '$email' and id$table = $id";

  $res = $cid -> query($sql) or die($cid->error);
  $row = $res -> fetch_row();
  if($row[0] == 0){
    return false;
  }
  else{
    return true;
  }

}
//STAMPA DELLA TABELLA PER LA GESTIONE DELLE COMPETENZE DI UN DATO CURRICULUM/ANNUNCIO
function table_competenze($id, $cid){
  //tabella competenze per il curriculum del candidato
  if(isset($_SESSION["candidato"])){
    $table = "esplicita";
    $where = "idcurriculum";
  }
  else{
    //tabella competenze per l'annuncio dell'azienda
    $table = "richiede";
    $where = "idannuncio";
  }
  $sql = "SELECT tipoesperienza, tiposettore, periodo, titolo, ordscolastico, votazione, nome, livello
          FROM $table
          WHERE $where = $id";
  $res = $cid -> query($sql) or die("Errore nella ricerca delle competenze");
  //se non vi sono competenze inserite
  if($res-> num_rows == 0){
    echo "Nessuna competenza inserita finora";
  }
  else{
    //stampa body della tabella
    while($row = $res -> fetch_row()){
      echo "<tr>";
      echo "<td>".$row[0]."</td>";
      echo "<td>".$row[1]."</td>";
      echo "<td>".$row[2]." mesi</td>";
      echo "<td>".$row[3]."</td>";
      echo "<td>".$row[4]."</td>";
      echo "<td>".$row[5]."</td>";
      echo "<td>".$row[6]."</td>";
      echo "<td>".$row[7]."</td>";
      echo "<td class = 'text-center'><a class='tably confirm' href='../backend/del_competenze.php?id=$id&esp=$row[0]&sett=$row[1]&per=$row[2]&tit=$row[3]&ord=$row[4]&vot=$row[5]&lang=$row[6]&lvl=$row[7]'><i class='fas fa-times'></i></a></td>";
      echo "<tr>";
    }
  }
}
//STAMPA DELLA TABELLA DELLE CANDIDATURE INVIATE DAL CANDIDATO O RICEVUTE DALL'AZIENDA
function table_candidature($cid){

  $ret = array();
  //query in base all'utente
  if(isset($_SESSION["azienda"])){
    $sql = "SELECT annuncio.titolo, candidato.nome, candidato.cognome, curriculum.nomecv, annuncio.idannuncio, curriculum.idcurriculum, candidato.email
            FROM relativoA JOIN annuncio on relativoA.idannuncio = annuncio.idannuncio
            JOIN curriculum on relativoA.idcurriculum = curriculum.idcurriculum
            JOIN azienda on annuncio.email = azienda.email
            JOIN candidato on curriculum.email = candidato.email
            WHERE annuncio.email = '{$_SESSION['azienda']}'";
  }
  else{

    $sql = "SELECT azienda.nome, annuncio.titolo, curriculum.nomecv, relativoA.giudizio, relativoA.esito, relativoA.motivazione, azienda.email, annuncio.idannuncio, curriculum.idcurriculum
            FROM relativoA JOIN annuncio on relativoA.idannuncio = annuncio.idannuncio
            JOIN curriculum on relativoA.idcurriculum = curriculum.idcurriculum
            JOIN azienda on annuncio.email = azienda.email
            JOIN candidato on curriculum.email = candidato.email
            WHERE curriculum.email = '{$_SESSION['candidato']}'";
  }

  $res = $cid -> query($sql) or die (header("Location: ../frontend/home.php?error=".$cid->error));
  if($res -> num_rows == 0){
    //se non vi sono candidature relative al candidato o all'azienda che tenta di visualizzare
    if(isset($_SESSION["azienda"])){
        $ret["msg"] = "Nessuno si è ancora candidato ai tuoi annunci.";
    }
    else{
      $ret["msg"] = "Non ti sei ancora candidato a nessun annuncio";
    }
    return $ret;
  }
  else{
    //se ve ne sono riempio la risposta con i contenuti
    $count = 0;
    $content = array();
    while($row = $res -> fetch_row()){
      $content[$count] = $row;
      $count++;
    }
    $ret["cont"] = $content;
    return $ret;
  }
}
//UPLOAD DEI FILE IMMAGINE PER FOTO E LOGO, NELLA MODIFICA DEL PROFILO
function upl($img){
  //impostazione del path voluto
  $target_dir = "../img/";
  $target_file = $target_dir . basename($img["name"]);

  //se il file non è un'immagine errore
  $check = getimagesize($img["tmp_name"]);
  if(!$check) {
      $error = "Il file non è un'immagine";
      header("Location: ../frontend/modifica_profilo_azienda.php?error=".$error);
  }
  //se il file esiste gia restituisco il path senza inserire nuovamente nella cartella
  if (file_exists($target_file)) {

      return $target_file;
  }
  //controllo estensione
  $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "gif" ) {
      $error = "Sono permessi solo i formati JPG, JPEG, PNG & GIF.";
      header("Location: ../frontend/modifica_profilo_azienda.php?error=".$error);

  }
  //inserimento nella cartella e restituzione del path da inserire nel db
  if (copy($img["tmp_name"], $target_file)) {

      return $target_file;
  }
  else{
      $error = "C'è stato un errore nell'upload.";
      header("Location: ../frontend/modifica_profilo_azienda.php?error=".$error);

  }
}
//Caricamento del numero di notifiche da visualizzare in heading bar per un candidato
function notifiche($cid){

  $sql = "SELECT COUNT(*) FROM relativoA join curriculum on relativoA.idcurriculum = curriculum.idcurriculum
          WHERE notifica = '1' and email = '{$_SESSION['candidato']}'";
  $res = $cid -> query($sql) or die($cid->error);

  $row = $res -> fetch_row();
  $ret = intval($row[0]);

  return $ret;

}
//reset delle notifiche chiamata dall'api
function reset_notifiche($cid){
  //trovo gli id dei curriculum con la notifica alzata, resettare anche notifiche eventualmente non alzate è invariante
  $sql = "SELECT relativoA.idcurriculum FROM relativoA join curriculum on relativoA.idcurriculum = curriculum.idcurriculum
          WHERE notifica = '1' and email = '{$_SESSION['candidato']}'";
  $res = $cid -> query($sql) or die($cid->error);
  if($cid -> error){
    return $cid-> error;
  }
  $n = 0;
  $ids = array();
  while($row = $res -> fetch_row()){

    $ids[$n] = intval($row[0]);

  }
  //per ogni id update set notifica a 0
  foreach ($ids as $value) {

    $sql = "UPDATE relativoA SET notifica = '0' WHERE idcurriculum = $value";
    $res = $cid -> query($sql);
    if($cid -> error){
      return $cid-> error;
    }

  }
  //return per la response
  return 'true';


}
//controllo se vi sono all'attivo valutazioni per il curriculum corrente da parte dell'azienda che lo visualizza
//per l'annuncio specifico derivato dal percorso dalla pagina delle candidature
function check_valutazione($id, $ida, $cid){

  $sql = "SELECT COUNT(*) FROM relativoA
          JOIN annuncio on relativoA.idannuncio = annuncio.idannuncio
          WHERE annuncio.idannuncio = '$ida' AND idcurriculum = '$id' AND esito is not null";
  $res = $cid -> query($sql) or die($cid->error);
  $row = $res -> fetch_row();

  return $row[0];
}
//stampa della valutazione dell'azienda sul curriculum
//la specificita dell'annuncio o della valutazione deriva dal percorso effettuato per arrivare alla pagina del curriculum
function print_valutazione($id, $ida, $cid){

  $sql = "SELECT giudizio, esito, motivazione FROM relativoA
          JOIN annuncio on relativoA.idannuncio = annuncio.idannuncio
          WHERE annuncio.idannuncio = '$ida' AND idcurriculum = '$id' AND esito is not null
          ORDER BY esito";

  $res = $cid -> query($sql) or die($cid->error);

  $row = $res -> fetch_row();

  echo "<hr>";
  echo '<h3 class="my-3 alert alert-primary">La tua valutazione</h3>';
  echo "<ul>";
  echo "<li>Giudizio: $row[0]</li>";
  echo "<li>Esito: $row[1]</li>";
  if($row[1] == "Non accettato"){
    echo "<li>Motivazione: $row[2]</li>";
  }
  echo "</ul>";


}
//conteggio delle candidature per un annuncio
function count_candidature($id,$cid){

  $sql = "SELECT COUNT(*) FROM relativoA WHERE idannuncio = '$id'";
  $res = $cid -> query($sql) or die ($cid->error);
  $row = $res -> fetch_row();
  if($row[0] == 1){
    $return = "1 candidatura a questo annuncio";
  }
  else{

    $return = $row[0]. " candidature a questo annuncio";

  }

  return $return;

}
//controllo se il candidato ha curriculum disponibili con cui rispondere ad un annuncio
function check_curriculums($cid){

  $sql = "SELECT COUNT(*) FROM curriculum WHERE email = '{$_SESSION['candidato']}'";
  $res = $cid -> query($sql) or die($cid->error);
  $row = $res -> fetch_row();
  if($row[0]>0){
    return true;
  }
  else{
    return false;
  }
}
//lista dei curriculum disponibili per un candidato
function curriculum_list($cid){

  $sql = "SELECT idcurriculum, nomecv FROM curriculum WHERE email = '{$_SESSION['candidato']}'";
  $res = $cid -> query($sql) or die($cid->error);
  $n = 0;
  $ret = array();
  while($row = $res -> fetch_row()){
    $ret[$n] = $row;
    $n++;
  }
  return $ret;
}
//inserimento delle keyword
function keyword_ins($w, $cid){
  //selezione tabella
  if(isset($_SESSION['candidato'])){

    $table = 'disponeCandidato';
    $user = $_SESSION['candidato'];

  }
  else{

    $table = 'disponeAzienda';
    $user = $_SESSION['azienda'];

  }

  foreach ($w as $value) {
    //per ogni parola controllo se è presente nella tabella referenziata
    $sqlif = "SELECT * FROM keyword where parola = '$value'";
    $res = $cid -> query($sqlif);
    if($res -> num_rows == 0){
      //se non lo è inserisco
      $sql = "INSERT into keyword VALUES('$value')";
      $cid -> query($sql);

    }
    //controllo se è già presente, salta iterazione se lo è
    $sqlif = "SELECT * FROM $table where parola = '$value' AND emailp = '$user'";
    $res = $cid -> query($sqlif);

    if($res -> num_rows > 0){
      continue;
    }

    //insert nella tabella referente
    $sql = "INSERT into $table VALUES('$user', '$value')";
    $cid -> query($sql);

  }

}

?>

<?php

include("../common/setup.php");

if(isset($_GET["user"])){
  //se l'utente è proprietario del profilo visualizza tutto

    $sql = "SELECT titolo, idannuncio, datapubb, descrizione, tipocontratto, ngiorni, datainizio, datafine, periodovisibilita, tipovisibilita, DATEDIFF(CURRENT_DATE, datapubb) FROM annuncio where email = '$user'";

}
elseif(isset($_SESSION["candidato"])){
  //se è un candidato visualizza gli annunci pubblici e quelli a lui riservati
   $sql = "SELECT titolo, idannuncio, datapubb, descrizione, tipocontratto, ngiorni, datainizio, datafine FROM annuncio
           WHERE (tipovisibilita = 'public' or tipovisibilita = 'specific' and tiposettore in
           (SELECT esplicita.tiposettore
           FROM curriculum join esplicita on curriculum.idcurriculum = esplicita.idcurriculum
           WHERE curriculum.email = '{$_SESSION['candidato']}')) and email = '$user'";

}
else{

  //se è un visitatore visualizza gli annunci pubblici
  $sql = "SELECT titolo, idannuncio, datapubb, descrizione, tipocontratto, ngiorni, datainizio, datafine FROM annuncio where email = '$user' and tipovisibilita = 'public'";

}
//esecuzione query
$res_data = $cid->query($sql) or die($cid-> error);
if($res_data -> num_rows == 0){
  //se non vi sono annunci
  echo "<p>Nessun annuncio trovato</p>";
}
while($row = mysqli_fetch_array($res_data)){
  //stampa
  ?>  <div class="row">
    <div class="col-11 rounded listing">
      <h3 class="text-primary"><?php echo $row[0] ?></h3>
      <p><small><?php echo $row[2] ?></small></p>
      <p><?php echo $row[3] ?></p>
      <small><?php echo "$row[4] ";
            if(isset($row[5])) {echo "| Numero di giorni lavorativi per settimana: $row[4] ";}
            echo "| A partire dal: $row[6] ";
            if(isset($row[7])) {echo " fino al: $row[7]";}
      ?></small> <br>
      <?php if(isset($_GET["user"])) { //informazioni di gestione per l'utente
        echo "Visibilita: ";
        if($row[9] = 'public'){
          echo "Pubblico | Visibile per altri ". ($row[8] - $row[10]). " giorni";
        }
        elseif($row[9] = 'specific'){
          echo "Riservato | Visibile per altri ". ($row[8] - $row[10]). " giorni";
        }
        else{
          echo "Privato";
        }
        echo "<br>";
      } ?>
      <div class="d-flex flex-row mt-3">
        <a class="btn btn-primary" href="annuncio.php?id=<?php echo $row[1] ?>"> Vai all'Annuncio <i class='fas fa-arrow-right' style='padding-left: 0.3rem'></i></a>
        <?php
          if(isset($_GET["user"])){ //link di modifica e cancellazione per l'utente
            ?>
            <a class="ml-auto p-2 text-success" href="ins_annuncio.php?modifica=true&id=<?php echo $row[1] ?>"><i class="fas fa-pen"></i></a>
            <a class="p-2 text-danger confirm" href="../backend/del_annuncio.php?id=<?php echo $row[1] ?>"><i class="fas fa-times"></i></a>
          <?php
          }
          ?>

      </div>
    </div>
  </div>
  <hr>
  <?php
}

include("../frontend/modals.php");
mysqli_close($cid);

 ?>

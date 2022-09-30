<?php

include("../common/setup.php");

if(isset($_GET["user"])){
    //se l'utente è proprietario del profilo visualizza tutto
    $sql = "SELECT nomecv, idcurriculum, descrizione, suProfilo FROM curriculum where email = '$user'";
}
else{
    //altrimenti visualizza solo quelli che il proprietario ha messo disponibili sul proprio profilo
    $sql = "SELECT nomecv, idcurriculum, descrizione FROM curriculum where email = '$user' and suProfilo = '1'";
}

//esecuzione query
$res_data = $cid->query($sql) or die($cid -> error);
if($res_data -> num_rows == 0) {
  //se l'utente non ha curriculum visualizzabili
  echo "<p>Nessun curriculum trovato</p>";
}
while($row=$res_data->fetch_row()){

  ?>  <div class="row">
    <div class="col-11 rounded listing">
      <h3 class="text-primary"><?php echo $row[0] ?></h3>
      <p><?php echo $row[2] ?></p>
      <?php
       if(isset($_GET["user"])){//info di gestione per il proprietario
         if($row[3] == '1'){
           echo "<small>Visibile sul Profilo</small><br>";
         }
         else{
           echo "<small>Non visibile sul Profilo</small><br>";
         }
       }
       ?>
      <div class="d-flex flex-row mt-3">
        <a class="btn btn-primary" href="curriculum.php?id=<?php echo $row[1] ?>"> Vai al Curriculum <i class='fas fa-arrow-right' style='padding-left: 0.3rem'></i></a>
        <?php
          if(isset($_GET["user"])){//link di gestione per il proprietario
            ?>
            <a class="ml-auto p-2 text-success" href="ins_curriculum.php?modifica=true&id=<?php echo $row[1] ?>"><i class="fas fa-pen"></i></a>
            <a class="p-2 text-danger confirm" href="../backend/del_curriculum.php?idc=<?php echo $row[1] ?>"><i class="fas fa-times"></i></a>
          <?php
          }
          ?>

      </div>
    </div>
  </div>
  <?php
  echo "<hr>";
}

include("../frontend/modals.php");
mysqli_close($cid);

 ?>

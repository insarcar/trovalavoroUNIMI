<?php //setup
  session_start();
  if($_GET["id"] != '0' && empty($_GET["id"]) || !isset($_GET["id"])){
    //senza id non posso caricare nessun annuncio

    $error = "Errore nel caricamento della pagina";
    header("Location: home.php?error=".$error);
  }
  else{
    $id = $_GET["id"];
  }
  //caricamento dati dell'annuncio
  include("../common/functions.php");
  include_once("../common/setup.php");
  $data = array();
  $data = load_annuncio($id,$cid);
  mysqli_close($cid);
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title><?php echo $data["tit"] ?></title>
  <?php include("../common/head.php") ?>
  <style media="screen">
    .listing{
       box-shadow: 1px 1px 1px 1px #c7c7c7;
       border-top-left-radius: 50%;
       border-top-right-radius: 50%;
    }
    .img-fluid{
      box-shadow: 1px 1px 1px 1px #c7c7c7;
    }
    .pagy{
      margin-top: -5%;
    }

  </style>
</head>

<body>

  <!-- Navigation -->
  <?php //heading bar
  include("../header/header.php") ?>

  <!-- Page Content -->
  <div class="container">

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="home.php">Home</a>
      </li>
      <li class="breadcrumb-item">
        <a href="profile.php?azienda=<?php echo $data["email"] ?>"><?php echo $data["nome"] ?></a>
      </li>
      <li class="breadcrumb-item active"><?php echo $data["tit"] ?></li>
    </ol>

    <!-- Info in testa -->
    <h1 class="mt-4 mb-3 text-left alert alert-primary" style="margin-bot: 0"><?php echo $data["tit"] ?></h1>
    <div class="row text-left">
      <div class="col mb-3 ml-3">
        <small><a href="profile.php?azienda=<?php echo $data["email"] ?>" style = "color:blue"><?php echo $data["nome"] ?></a><?php if(isset($data["sett"]) || !empty($data["sett"])) echo "<br>". $data["sett"] ?><br><?php echo $data["data"] ?><br></small>
        <small class="badge badge-primary" id = "count_candidature"><?php
        //conteggio delle candidature per annuncio
        include("../common/setup.php");
        echo count_candidature($id,$cid);
        mysqli_close($cid);
         ?></small>
      </div>

    </div>



    <!-- Corpo principale -->
    <div class="row">
      <div class="col-4">
        <a href="profile.php?azienda=<?php echo $data["email"] ?>">
          <img class="img-fluid rounded-circle post-img" <?php if(!empty($data["logo"])){ echo "src= \"{$data['logo']}\"";} else{ echo "src =  \"https://picsum.photos/id/870/150/150?grayscale&blur=1\"";} ?> alt="">
        </a>
      </div>


      <div class="col-8 pagy">
        <h3 class="my-3 alert alert-primary">Descrizione Annuncio</h3>
        <p><?php echo $data["descr"] ?></p>
        <h3 class="my-3 alert alert-primary">Dettagli</h3>
        <ul>
          <li>Tipo Contratto: <?php echo $data["contr"] ?></li>
          <li>Data di inizio: <?php echo $data["datai"] ?></li>
          <?php if($data["retr"] !== null){ ?>
          <li>Eventuale retribuzione lorda: <?php echo $data["retr"] ?></li>
        <?php  }?>


        </ul>
        <?php if ($data["contr"] == "Contratto a tempo determinato"){
          //se offre un contratto a tempo determinato mostra le info relative ?>
            <h3 class="my-3 alert alert-primary">Dettagli contratto a tempo determinato</h3>
            <ul>
            <li>Data termine: <?php echo $data["dataf"] ?></li>
            <li>Durata: <?php echo $data["dur"] ?></li>
            <li>Giorni lavorativi a settimana: <?php echo $data["giorni"] ?></li>
            </ul>
        <?php } ?>

        <h3 class="my-3 alert alert-primary">Competenze richieste</h3>
        <ul>
            <?php
            //caricamento delle competenze richieste se ve ne sono
            include("../common/setup.php");
            load_competenze($id, 'annuncio', $cid);

             ?>
        </ul>
        <?php //se un candidato sta visualizzando
        if(isset($_SESSION["candidato"])){
          //se ha dei curriculum disponibili
          if(check_curriculums($cid)){
            //fanne una lista di selezionabili
            $currs = curriculum_list($cid);
            echo '<select class="form-control" id = "sel-curriculum" name="idc">';
            echo "<option value = ''>Nuovo Curriculum</option>";
            foreach($currs as $val){
              echo "<option value = '$val[0]'>$val[1]</option>";
            }
            echo "</select>";
            //al variare della selezione la funzionalita in js deciderà se fare una ajax call per la risposta
            //o rimandare alla pagina di inserimento di un nuovo curriculum con l'id dell'annuncio attached
          }?>



        <a class="btn btn-primary" id = "resp" href="ins_curriculum.php?id=<?php echo $id ?>">Rispondi ad Annuncio
          <i class="fas fa-comment" style="padding-left: 0.3rem"></i>
        </a>
        <?php
          mysqli_close($cid);
          }
          //se sta visualizzando un'azienda e corrisponde al proprietario dell'annuncio visualizza opzioni
          if(isset($_SESSION["azienda"]) && $_SESSION["azienda"] == $data["email"]){ ?>
          <div class="d-lg-flex flex-row mt-2 mb-1">
          <a class="btn btn-primary mr-1" href="ins_annuncio.php?modifica=true&id=<?php echo $id ?>">Modifica
            <i class="fas fa-pen" style="padding-left: 0.3rem"></i>
          </a>
          <a class="btn btn-primary mr-1 confirm" href="../backend/del_annuncio.php?id=<?php echo $id ?>">Cancella
            <i class="fas fa-times" style="padding-left: 0.3rem"></i>
          </a>
          <a class="btn btn-primary mr-1 mt-1 mt-lg-0" href="ins_competenze.php?id=<?php echo $id ?>">Inserisci competenze
            <i class="fas fa-plus" style="padding-left: 0.3rem"></i>
          </a>
          <a class="btn btn-primary mt-1 mt-lg-0" href="competenze.php?id=<?php echo $id ?>">Visualizza/Gestisci competenze
            <i class="fas fa-pen" style="padding-left: 0.3rem"></i>
          </a>
        </div>
        <?php } ?>
          </div>

    </div>
    <hr>

          <?php

            include("modals.php");
          //commenti ai piedi dell'annuncio
          include("../backend/commenti.php");

          ?>


  </div>


<?php include("../common/footer.php") ?>


</body>

</html>

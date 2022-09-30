<?php //setup e permessi
      session_start();
      //senza id non c'è curriculum da caricare
      if($_GET["id"] != '0' && empty($_GET["id"]) || !isset($_GET["id"])){

        $error = "Errore nel caricamento della pagina";
        header("Location: home.php?error=".$error);
      }
      else{
        $id = $_GET["id"];
      }
      //setup e prelievo dati principali
      include("../common/functions.php");
      include_once("../common/setup.php");
      $data = array();
      $data = load_curriculum($id, $cid);
      mysqli_close($cid)?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title><?php echo $data["nomecv"] ?></title>
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
      margin-top: -2.5%;
    }
  </style>
</head>

<body>

  <!-- Navigation -->
  <?php include("../header/header.php") ?>

  <!-- Page Content -->
  <div class="container">

    <!-- Page Heading/Breadcrumbs -->
    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="home.php">Home</a>
      </li>
      <li class="breadcrumb-item">
        <a href="profile.php?candidato=<?php echo $data["email"] ?>"><?php echo $data["nome"]." ".$data["cognome"] ?></a>
      </li>
      <li class="breadcrumb-item active"><?php echo $data["nomecv"] ?></li>
    </ol>

    <h1 class="mt-4 mb-3 text-left alert alert-primary"><?php echo $data["nomecv"] ?></h1>
    <div class="row text-left">
      <div class="col-2 mb-2 ml-3">
        <small><a href="profile.php?candidato=<?php echo $data["email"] ?>" style = "color:blue"><?php echo $data["nome"]." ".$data["cognome"] ?></a></small>
      </div>
    </div>



    <!-- Corpo curriculum -->
    <div class="row">
      <div class="col-4 text-center">
        <a href="profile.php?candidato=<?php echo $data["email"] ?>">
          <img class="img-fluid rounded-circle post-img" <?php if(!empty($data["foto"])){ echo "src= \"{$data['foto']}\"";}else{echo "src = \"https://picsum.photos/id/1005/300/300?grayscale\"";} ?> alt="">
        </a>
      </div>


      <div class="col-8 pagy">
        <h3 class="my-3 alert alert-primary">Descrizione Curriculum</h3>
        <p><?php
          if($data["descr"] == null){
            echo "Nessuna descrizione trovata";
          }
          else {
            echo $data["descr"];
          }
           ?></p>
        <h3 class="my-3 alert alert-primary">Competenze espresse</h3>
        <ul>
          <?php
          //prelievo e stampa delle competenze espresse nel curriculum
          include("../common/setup.php");
          load_competenze($id, 'curriculum', $cid);

           ?>
        </ul>
        <?php if(isset($_SESSION["azienda"]) && isset($_GET["ida"]) && !empty($_GET["ida"]) && ctrl_risposta($_SESSION["azienda"], $id, $cid)){
          //se l'utente che visualizza è un'azienda, e arriva al curriculum dal percorso giusto per valutarlo (se è in risposta all'annuncio corrispondente nella pagina delle candidature) ?>
        <a class="btn btn-primary" href="" data-toggle = "modal" data-target = "#valModal">Valuta
          <i class="fas fa-comment" style="padding-left: 0.3rem"></i>
        </a>
        <?php
        //se c'è una valutazione già effettuata stampa
        if(check_valutazione($id, $_GET["ida"], $cid)){

          print_valutazione($id, $_GET["ida"], $cid);

        }
        }
        mysqli_close($cid);
        if(isset($_SESSION["candidato"]) && $_SESSION["candidato"] == $data["email"]){
          //se l'utente è un candidato ed è il proprietario visualizza le opzioni ?>
        <a class="btn btn-primary" href="ins_curriculum.php?modifica=true&id=<?php echo $id ?>">Modifica
          <i class="fas fa-pen" style="padding-left: 0.3rem"></i>
        </a>
        <a class="btn btn-primary confirm" href="../backend/del_curriculum.php?idc=<?php echo $id ?>">Cancella
          <i class="fas fa-times" style="padding-left: 0.3rem"></i>
        </a>

        <a class="btn btn-primary mr-1 mt-1 mt-lg-0" href="ins_competenze.php?id=<?php echo $_GET["id"] ?>">Inserisci competenze
          <i class="fas fa-plus" style="padding-left: 0.3rem"></i>
        </a>
        <a class="btn btn-primary mt-1 mt-lg-0" href="competenze.php?id=<?php echo $_GET["id"] ?>">Visualizza/Gestisci competenze
          <i class="fas fa-pen" style="padding-left: 0.3rem"></i>
        </a>
      <?php } ?>

      </div>

    </div>
    <hr>


  </div>


</div>
<?php include("../frontend/modals.php") ?>
<?php include("../common/footer.php") ?>
</body>

</html>

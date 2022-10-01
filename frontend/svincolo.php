<?php
//interfase tra inserimento/modifica di un annuncio/curriculum e l'inserimento delle competenze/gestione delle competenze/gestione dell'annuncio/curriculum
session_start();
include("../common/setup.php");
include("../common/functions.php");
if($_GET["id"] != '0' && empty($_GET["id"]) || !isset($_GET["id"])){

  $error = "C'è stato un errore nel redirect";
  header("Location: ../frontend/home.php?error=".$error);

}
//controllo dei permessi (proprietario di cosa vado effettivamente a gestire)
if(!check_proper($_GET["id"], $cid)){
  $error = "Non hai il permesso di accedere a questa pagina";
  header("Location: ../frontend/home.php?error=".$error);
}
mysqli_close($cid);
if(isset($_SESSION["azienda"])){
  $user = "Vai al tuo annuncio";
}
else{
  $user = "Vai al tuo curriculum";
}




?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Scegli</title>
    <?php include("../common/head.php") ?>

    <style media="screen">
      .listing, .els{
         box-shadow: 1px 1px 1px 1px #c7c7c7;
      }
    </style>

  </head>
  <body>
    <?php include("../header/header.php") ?>
    <div class="container">

    <ol class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="home.php">Home</a>
      </li>
      <li class="breadcrumb-item">
        <a href=<?php if(isset($_SESSION["candidato"])){
          echo "curriculum.php?id=".$_GET["id"];
        }
        else{
          echo "annuncio.php?id=".$_GET["id"];
        }  ?>><?php if(isset($_SESSION["candidato"])){
          echo "Curriculum";
        }
        else{
          echo "Annuncio";
        }  ?></a>
      </li>
      <li class="breadcrumb-item active">Opzioni</li>
    </ol>
    <h1 class="mt-4 mb-3 text-center alert alert-primary" style="margin-bottom: 2%"><?php
      if(isset($_GET["msg"]) && !empty($_GET["msg"])){
        echo $_GET["msg"];
      }
      else{
        echo "Inserimento/Modifica avvenuta con successo (ma ho perso il messaggio, o ci sei arrivato da solo)";
      } ?></h1>
    <div class="d-lg-flex flex-row-lg mt-2 mb-1 justify-content-center">
      <a class="btn btn-primary mr-2" href="<?php if(isset($_SESSION["candidato"])){echo "curriculum";}else{echo "annuncio";} ?>.php?id=<?php echo $_GET["id"] ?>"><?php echo $user ?>
        <i class="fas fa-arrow-right" style="padding-left: 0.3rem"></i>
      </a>
      <a class="btn btn-primary mr-2" href="ins_competenze.php?id=<?php echo $_GET["id"] ?>">Inserisci più competenze
        <i class="fas fa-plus" style="padding-left: 0.3rem"></i>
      </a>
      <a class="btn btn-primary" href="competenze.php?id=<?php echo $_GET["id"] ?>">Visualizza/Gestisci competenze
        <i class="fas fa-pen" style="padding-left: 0.3rem"></i>
      </a>
    </div>
  </div>
  <?php include("../common/footer.php") ?>

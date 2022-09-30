<?php
//setup
session_start();
include("../common/setup.php");
include("../common/functions.php");
//controllo permessi
if(isset($_SESSION["candidato"])){
  $user = $_SESSION["candidato"];
}
else{
  $error = "Non hai il permesso di accedere a questa pagina";
  header("Location: ../frontend/home.php?error=".$error);
}
//selezione dell'azione (inserimento, risposta, modifica)
if(isset($_GET["id"])){

  if(isset($_GET["modifica"])){
    //se modifica, controlla i permessi del candidato
    if(!check_proper($_GET["id"], $cid)){

        $error = "Non hai il permesso di accedere a questa pagina";
        header("Location: ../frontend/home.php?error=".$error);

    }
      $bread = "Modifica curriculum";
      $method = "../backend/alter_curriculum.php?id=".$_GET["id"];
  }
  else {
    $bread = "Inserimento curriculum in risposta";
    $method = "../backend/inserisci_curriculum.php?id=".$_GET["id"];
  }
  //senza id non posso modificare o rispondere
  if($_GET["id"] != '0' && empty($_GET["id"])){

    $error = "C'è stato un errore nel redirect";
    header("Location: ../frontend/home.php?error=".$error);

  }
}
else{
  $method = "../backend/inserisci_curriculum.php";
}
mysqli_close($cid);
?>
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Inserimento Curriculum</title>
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
          <a href="../frontend/profile.php?candidato=<?php echo $_SESSION["candidato"] ?>">Profilo</a>
        </li>
        <li class="breadcrumb-item active"><?php if(isset($bread)){echo $bread;}else{echo "Inserimento Curriculum";} ?></li>
      </ol>
      <?php if(isset($_GET["error"])){
      echo "<h3 class = 'alert alert-danger'>".$_GET["error"]."</h3>";
      } ?>

    <form method="post" action=<?php echo $method ?>>

      <div class="row">
        <div class="col">
            <span class="d-flex badge badge white els"><h2 class = "text-primary text-bold mt-2">Descrizione</h2></span>
        </div>

      </div>
      <div class="row mt-2 mb-2">
        <div class="col">

            <textarea class="form-control listing" name = "desc" placeholder="scrivi una descrizione..." rows="7" <?php if(!isset($_GET["id"])) echo "required"?>></textarea>


        </div>

      </div>

      <div class="mb-4 mt-2" id="accordion" role="tablist" aria-multiselectable="true">

      <div class="card bg-info els">
        <div class="card-header" role="tab" id="headingFour">
          <h5 class="mb-0">
            <a class="collapsed text-white" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">Altri dettagli</a>
          </h5>
        </div>
        <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour">
          <div class="card-body">
            <div class="row mt-1">

              <div class="col">
                <span class="u-alert" id="form-nomecv">Hai gia usato questo nome per un altro tuo curriculum</span>
                <div class="d-inline-flex badge badge-info">
                    <input class="form-control c-form-input flex-grow-1" type="text" id = "nomecv" name="nomecv" placeholder="Nome del curriculum" oninput="isValid(this)"<?php if(!isset($_GET["id"])) echo "required"?>/>
                    <div class="input-group">

                      <input class="ml-5 form-control" type="checkbox" id = "prf" name="prf" value = "Pubblica sul tuo profilo"/>
                      <div class="p-2 mt-2">Caricalo sul profilo</div>
                    </div>



                </div>

                </div>

              </div>
          </div>
        </div>
      </div>


      <div class="row mt-2 mb-4">
        <div class="col">
          <input class="btn btn-lg btn-outline-success els" type="submit" name="Conferma" value="Conferma">

        </div>

      </div>



      </div>

    </form>

    </div>

  </body>
  <?php include("../common/footer.php") ?>
</html>

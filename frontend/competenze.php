<?php //setup e permessi
      session_start();
      include("../common/setup.php");
      include("../common/functions.php");
      if(empty($_GET["id"]) || !isset($_GET["id"])){
        //se non c'è id nell'url errore (gestione delle competenze necessita dell'id dell'annuncio/curriculum che vado a gestire)
        $error = "C'è stato un errore nel redirect";
        header("Location: ../frontend/home.php?error=".$error);

      }
      //se l'utente non è proprietario dell'annuncio/curriculum
      if(!check_proper($_GET["id"], $cid)){
        $error = "Non hai il permesso di accedere a questa pagina";
        header("Location: ../frontend/home.php?error=".$error);
      }
      mysqli_close($cid);
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Gestione Competenze</title>
    <?php include("../common/head.php") ?>
    <style media="screen">
      .tably:link{
        color: white;

      }
      .tably:hover{
        color: #e1f0f0;
      }
      .tably:visited{
        color: #e9ecef;
      }

    </style>
  </head>

  <body>

    <?php include("../header/header.php") ?>



    <div class="container">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="../frontend/home.php">Home</a>
        </li>
        <li class="breadcrumb-item">
          <a href=<?php if(isset($_SESSION["candidato"])){
            echo "../frontend/curriculum.php?id=".$_GET["id"];
          }
          else{
            echo "../frontend/annuncio.php?id=".$_GET["id"];
          }?>><?php if(isset($_SESSION["candidato"])){
            echo "Curriculum";
          }
          else{
            echo "Annuncio";
          }?></a>
        </li>
        <li class="breadcrumb-item active">Competenze</li>
      </ol>
      <div class="row">

        <div class="col-sm">


            <table class="table table-dark table-striped table-hover text-white">
              <thead>
                <tr>
                  <th>Esperienza Lavorativa</th>
                  <th>Settore Lavorativo</th>
                  <th>Periodo</th>
                  <th>Titolo di studio</th>
                  <th>Ordine scolastico</th>
                  <th>Voto</th>
                  <th>Lingua</th>
                  <th>Livello</th>
                  <th>Cancella</th>
                </tr>
              </thead>
              <tbody>
                <?php //stampa del corpo
                      include("../common/setup.php");
                      table_competenze($_GET["id"], $cid);
                      mysqli_close($cid);
                      ?>

              </tbody>
            </table>
            <a class="btn btn-primary mt-2" href="ins_competenze.php?id=<?php echo $_GET["id"] ?>">Inserisci più competenze
              <i class="fas fa-plus" style="padding-left: 0.3rem"></i>
            </a>

            <?php include("../frontend/modals.php") ?>

            </div>
    </div>
  </body>
  <?php include("../common/footer.php") ?>
</html>

<?php
//setup e permessi
session_start();
include("../common/functions.php");
if(!isset($_SESSION["azienda"])){
  $error = "Non sei autorizzato a visualizzare questa pagina!";
  header("Location: ../frontend/home.php?error=".$error);
}
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Candidature</title>
    <?php include("../common/head.php") ?>
    <script src = "../js/filtri.js"></script>
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

      @media (min-width:992px){
        #bd-docs-nav{
          display:block!important;

        }
      }
    </style>
  </head>
  <body>
    <?php include("../header/header.php") ?>



    <div class="container-fluid">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="home.php">Home</a>
        </li>
        <li class="breadcrumb-item">
          <a href="profile.php?azienda=<?php echo $_SESSION["azienda"] ?>">Profilo</a>
        </li>
        <li class="breadcrumb-item active">Candidature</li>
      </ol>
      <div class="row">

      <?php
      //prelievo dati
      include("../common/setup.php");
      $data = table_candidature($cid);
      //sidebar
      include("../common/sidebar_azienda_candidature.php");
      mysqli_close($cid);
       ?>

        <div class="col">

            <?php if(!isset($data["msg"])){ //se ho dei risultati guido l'utente alla valutazione
                echo '<h4 class="alert alert-primary">Clicca su un curriculum per valutarlo, o vedere la tua valutazione ed eventualmente rivalutarlo!</h4>';
            } ?>

            <table class="table table-dark table-striped table-hover text-white">
              <thead>
                <tr>
                  <th>Titolo annuncio</th>
                  <th>Candidato</th>
                  <th>Nome Curriculum</th>
                </tr>
              </thead>
              <tbody id="tabella_candidature_azienda">
                <?php
                //se non trovo candidature messaggio
                if(isset($data["msg"])){
                  echo "<p>".$data["msg"]."</p>";
                }
                else{
                  foreach ($data["cont"] as $value) {
                    //se le trovo, stampa
                    echo "<tr>";
                    echo "<td><a class = 'tably' href = 'annuncio.php?id=$value[4]'>".$value[0]."</a></td>";
                    echo "<td><a class = 'tably' href = 'profile.php?candidato=$value[6]'>".$value[1]." ".$value[2]."</a></td>";
                    echo "<td><a class = 'tably' href = 'curriculum.php?id=$value[5]&ida=$value[4]'>".$value[3]."</a></td>";

                  }
                }

                 ?>

              </tbody>
            </table>
            <br>
            <br>

            <?php include("../frontend/modals.php") ?>
  </body>
  <?php include("../common/footer.php") ?>
</html>

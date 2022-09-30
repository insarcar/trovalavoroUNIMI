<?php
//setup e permessi
session_start();
include("../common/functions.php");
if(!isset($_SESSION["candidato"])){
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

    <?php include("../header/header.php")?>



    <div class="container-fluid">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="home.php">Home</a>
        </li>
        <li class="breadcrumb-item">
          <a href="profile.php?candidato=<?php echo $_SESSION["candidato"] ?>">Profilo</a>
        </li>
        <li class="breadcrumb-item active">Candidature</li>
      </ol>
      <div class="row">
      <?php
      //prelievo dati
      include("../common/setup.php");
      $data = table_candidature($cid);
      mysqli_close($cid);
      //sidebar
      include("../common/sidebar_candidato_candidature.php"); ?>

        <div class="col-sm">

            <?php if(isset($_GET['msg'])){
              //cancellazione confermata
              echo "<h4 class = 'alert alert-success'>". $_GET['msg']. "</h4>";
            } ?>

            <table class="table table-dark table-striped table-hover text-white">
              <thead>
                <tr>
                  <th>Azienda</th>
                  <th>Titolo Annuncio</th>
                  <th>Curriculum</th>
                  <th>Giudizio</th>
                  <th>Esito</th>
                  <th>Motivazione</th>
                  <th class="text-center">Ritira</th>
                </tr>
              </thead>
              <tbody id="tabella_candidature_candidato">
                <?php

                //stampa risultati
                if(isset($data["msg"])){
                  echo "<p>".$data["msg"]."</p>";
                }
                else{
                  foreach ($data["cont"] as $value) {
                    /*if($value[4] == 'Accettato'){
                      $value[5] = '';
                    }*/
                    echo "<tr>";
                    echo "<td><a class = 'tably' href = 'profile.php?azienda=$value[6]'>".$value[0]."</a></td>";
                    echo "<td><a class = 'tably' href = 'annuncio.php?id=$value[7]'>".$value[1]."</a></td>";
                    echo "<td><a class = 'tably' href = 'curriculum.php?id=$value[8]'>".$value[2]."</a></td>";
                    echo "<td>".$value[3]."</td>";
                    echo "<td>".$value[4]."</td>";
                    echo "<td>".$value[5]."</td>";
                    echo "<td class = 'text-center'><a class='tably confirm' href='../backend/del_candidatura.php?ida=$value[7]&idc=$value[8]'><i class='fas fa-times'></i></a></td>";
                    echo "<tr>";
                  }
                }

                 ?>


              </tbody>
            </table>
            <?php include("../frontend/modals.php") ?>

            </div>
    </div>
  </body>
  <?php include("../common/footer.php") ?>
</html>

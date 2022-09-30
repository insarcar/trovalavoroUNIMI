<?php //standard setup
session_start();
include("../common/functions.php");
//visualizzabile solo dalle aziende
if(!isset($_SESSION["azienda"])){
  $error = "Non hai il permesso di visitare questa pagina";
  header("Location: ../frontend/home.php?error=".$error);
}



 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Candidati</title>
    <?php include("../common/head.php")
    //questa pagina utilizza filtri?>
    <script src = "../js/filtri.js"></script>

    <style media="screen">
      .listing{
         box-shadow: 1px 1px 1px 1px #c7c7c7;
      }
      .btn{
        margin-bottom: 3%;
      }
      .img-fluid{
        margin-left: -2%;
        margin-top: 4%;
      }

      @media (min-width: 992px){
      #bd-docs-nav{
          display: block!important;
        }
      }
    </style>

  </head>
  <body>
    <?php include("../common/setup.php") ?>
    <?php include("../header/header.php") ?>
    <div class="container-fluid">

        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="home.php">Home</a>
          </li>
          <li class="breadcrumb-item active">Candidati</li>
        </ol>

      <h1 class="mt-4 alert alert-primary text-left">Candidati</h1>

      <div class="row flex-fl-nowrap" id ="bodyrow">

        <?php

        include("../common/sidebar_azienda_candidati.php") ?>



          <div class="col-12 col-md-9 col-xl-8 md-3 pl-md-3 bd-content" id =  "candidati" >

            <?php
              //se arrivo dalla home-search, esegui query
              if(isset($_GET["data"])){

                $candidati = array();
                $res = $cid -> query($_GET["data"]) or die ($cid->error);
                if ($res-> num_rows == 0){

                  echo "<h4 class = 'col alert alert-warning'>Nessun risultato trovato.</h4>";
                }
                else {
                  //riempimento
                  $n = 0;
                  while($row = $res -> fetch_row()){
                    $candidati[$n] = $row;
                    $n++;
                  }

                }

              }
              else{
                //altrimenti funzione di lettura di base
                $result = leggiCandidati($cid);
                $candidati = $result["contenuto"];

              }

              mysqli_close($cid);
              //stampa
            ?>

            <?php foreach ($candidati as $value): ?>


              <div class="row rounded listing text-center text-md-left">
                <div class="col-md-2">
                  <a href="profile.php?candidato=<?php echo $value[4] ?>">
                    <img class="img-fluid rounded-circle mb-3 mb-0 profile-img" <?php if(!empty($value[5])){ echo "src= \"{$value[5]}\"";}else{echo "src = \"https://picsum.photos/id/1005/150/150?grayscale\"";} ?> alt="">
                  </a>
                </div>

                <div class="col-md">

                  <h3>
                    <?php echo "$value[0] $value[1]"; ?>
                  </h3>

                  <p>
                    <small>
                      <?php echo "$value[2]"; ?>
                    </small>
                  </p>

                    <?php if(isset($value[3])) {echo "<p> $value[3] </p>";}
                          else { echo "<br>"; }?>

                  <br>
                  <a class="btn btn-primary" href="profile.php?candidato=<?php echo $value[4] ?>"> Vai a Candidato <i class="fas fa-eye" style="padding-left: 0.3rem"></i>

                  </a>
                </div>
              </div>

              <hr>

            <?php endforeach; ?>



        </div>

      </div>


    </div>

    <?php include("../frontend/modals.php") ?>
    <?php include("../common/footer.php") ?>

  </body>
</html>

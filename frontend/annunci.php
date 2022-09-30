<?php
//standard setup
session_start();
//le aziende non dovrebbero vedere i competitors
if(isset($_SESSION["azienda"])){
  $error = "Non hai il permesso di visitare questa pagina";
  header("Location: ../frontend/home.php?error=".$error);
}
include("../common/functions.php");
include("../common/setup.php"); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Annunci</title>
    <?php include "../common/head.php";?>
    <!-- è una delle pagine che usano filtri -->
    <script src = "../js/filtri.js"></script>
    <style media="screen">
     /*elementi caratteristici della pagina*/
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

    <?php //heading bar
    include "../header/header.php";?>

<div class="container-fluid">

  <h1 class="mt-4 alert alert-primary text-left">Annunci</h1>

  <ol class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="home.php">Home</a>
    </li>
    <li class="breadcrumb-item active">Annunci</li>
  </ol>

  <div class="row flex-xl-nowrap">

    <?php
    //sidebar dei filtri
      include("../common/setup.php");
      include "../common/sidebar_visitors_annunci.php";



      //se mi arriva la query dalla home search bar eseguila
      if(isset($_GET["data"])){
        $annunci = array();
        $res = $cid -> query($_GET["data"]) or die ($cid->error);
        if ($res-> num_rows == 0){

          $msg = "<h4 class = 'col alert alert-warning'>Nessun risultato trovato.</h4>";

        }
        else{
          $n = 0;
          while($row = $res -> fetch_row()){
            $annunci[$n] = $row;
            $n++;
          }

        }
      }
      else {
        //altrimenti leggi annunci
        $result = leggiAnnunci($cid);
        $annunci = $result["contenuto"];

      }

      //stampa dei risultati php
    ?>

          <div class="col-12 col-md-9 col-xl-8 md-3 pl-md-3 bd-content" id = "annunci">

            <?php if(isset($msg)) echo $msg ?>
            <?php foreach ($annunci as $value): ?>
              <div class="row listing text-center text-md-left">
                <div class="col-md-2">
                  <a href="profile.php?azienda=<?php echo $value[7] ?>">
                    <img class="img-fluid rounded-circle mb-3 mb-md-0 profile-img" <?php if(!empty($value[9])){ echo "src= \"{$value[9]}\"";} else{ echo "src =  \"https://picsum.photos/id/870/150/150?grayscale&blur=1\"";} ?> alt="">
                  </a>
                </div>
                <div class="col-md-8">
                  <h3>
                    <?php echo "$value[10]"; ?>
                  </h3>

                  <small>
                    <a href="profile.php?azienda=<?php echo $value[7] ?>" style="color:blue">
                      <?php echo "$value[1]"; ?>
                    </a>
                  </small>

                  <br>
                    <p>
                      <small>
                        <?php echo "$value[2]";?>
                      </small>
                    </p>

                  <p> <?php echo "$value[0]";?> </p>

                  <small>
                    <?php echo "$value[3] ";
                          if(isset($value[4])) {echo "| Numero di giorni lavorativi per settimana: $value[4] ";}
                          echo "| A partire dal: $value[5] ";
                          if(isset($value[6])) {echo " fino al: $value[6]";}
                    ?>
                  </small>
                  <br>

                  <a class="btn btn-primary mb-2" href="annuncio.php?id=<?php echo $value[8] ?>">Vai ad Annuncio
                    <i class="fas fa-arrow-right" style="padding-left: 0.3rem"></i>
                  </a>
                </div>
              </div>
              <hr>

            <?php endforeach; ?>





            </div>

          </div>
        </div>
  </div>


        <?php  include("../frontend/modals.php") ?>

  </body>
  <?php include("../common/footer.php") ?>
</html>

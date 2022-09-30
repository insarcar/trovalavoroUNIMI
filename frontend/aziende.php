<?php //standard setup
session_start();
if(isset($_SESSION["azienda"])){
  $error = "Non hai il permesso di visitare questa pagina";
  header("Location: ../frontend/home.php?error=".$error);
}
include("../common/functions.php"); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Aziende</title>
    <?php include("../common/head.php")
    //questa pagina usa filtri?>
    <script src="../js/filtri.js"></script>
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
    <?php //heading bar
    include("../header/header.php") ?>

    <div class="container-fluid">

      <!-- Page Heading/Breadcrumbs -->
      <h1 class="mt-4 alert alert-primary text-left">Aziende</h1>

      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="home.php">Home</a>
        </li>
        <li class="breadcrumb-item active">Aziende</li>
      </ol>

      <div class="row flex-xl-nowrap">

      <?php
      //sidebar dei filtri
      include("../common/setup.php");
      include("../common/sidebar_visitors_aziende.php");
      //lettura delle aziende
        $result = leggiAziende($cid);
        $aziende = $result["contenuto"];

        //Stampa del corpo della pagina
      ?>
    <div class="col-12 col-md-9 col-xl-8 md-3 pl-md-3 bd-content" id = "aziende">


      <?php foreach ($aziende as $value): ?>

        <div class="row listing text-center text-md-left mt-2 mb-2">
          <div class="col-md-2">
            <a href="profile.php?azienda=<?php echo $value[4] ?>">
              <img class="img-fluid rounded-circle mb-3 mt-3 profile-img" <?php if(!empty($value[3])){ echo "src= \"{$value[3]}\"";} else{ echo "src =  \"https://picsum.photos/id/870/150/150?grayscale&blur=1\"";} ?> alt="">
            </a>
          </div>
          <div class="col-md-8">
            <h3>
              <?php echo "$value[0]"; ?>
            </h3>

            <p>
              <small>
                <?php echo "$value[1]"; ?>
              </small>
            </p>

              <?php if(isset($value[2])) {echo "<p> $value[2] </p>";}
                    else { echo "<br>"; }?>

            <br>
            <a class="btn btn-primary mb-3" href="profile.php?azienda=<?php echo $value[4] ?>">Vai ad Azienda
              <i class="fas fa-arrow-right" style="padding-left: 0.3rem"></i>
            </a>
          </div>
        </div>
        <hr>

      <?php endforeach; ?>




    </div>
  </div>
  <?php include("../frontend/modals.php") ?>
  <?php include("../common/footer.php") ?>


  </body>
</html>

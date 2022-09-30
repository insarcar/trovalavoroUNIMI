<?php
session_start();
//se c'è un utente loggato, è più elegante non lasciargli visualizzare questa pagina
if(isset($_SESSION['candidato']) || isset($_SESSION['azienda'])){
  header("Location: ../frontend/home.php");
}
include("../common/setup.php");
include("../common/functions.php");
db_unstiff($cid);
mysqli_close($cid);
 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>TrovaLavoroUNIMI</title>
    <?php include "../common/head.php";?>

  </head>
  <body>
<!-- Navigation header-->
    <?php include "../header/header.php"; ?>

      <div class="container">
        <div class="carousel slide" id="carouselExampleIndicators" data-ride="carousel">

          <!-- Slide indicators -->
          <ol class="carousel-indicators">
            <li class="active" data-target="#carouselExampleIndicators" data-slide-to="0"></li>
            <li class="" data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            <li class="" data-target="#carouselExampleIndicators" data-slide-to="2"></li>
          </ol>

          <div class="carousel-inner" role="listbox">
            <!-- Slide One - Set the background image for this slide in the line below -->
            <div class="carousel-item active rounded imagy" style="background-image:linear-gradient(rgba(255,255,255,.2), rgba(255,255,255,.2)), url('https://www.quietrev.com/wp-content/uploads/2016/05/More-than-Trust-Falls-The-Evolution-of-a-Team_SOURCE_stocksy.jpg')">
              <div class="carousel-caption d-none d-md-block">
                <h3 class="text-body">Trova subito il lavoro che cerchi!</h3>
                <p class="text-body lead font-italic font-weight-normal">TrovaLavoroUNIMI è il portale che ti fa accedere al mondo del lavoro</p>
              </div>
            </div>

            <!-- Slide Two - Set the background image for this slide in the line below -->
            <div class="carousel-item rounded" style="background-image:linear-gradient(rgba(255,255,255,.4), rgba(255,255,255,.4)), url('https://trainingindustry.com/content/uploads/2019/07/Building-Trust-and-Improving-Communication-7.9.19.jpg')">
              <div class="carousel-caption d-none d-md-block">
                <h3 class="text-body">Semplicita e trasparenza</h3>
                <p class="text-body lead font-italic font-weight-normal">I lavoratori sono da sempre la nostra priorita ed il nostro obbietivo è quello di abbattere le distanze tra dipendenti e datori di lavoro.
                TrovaLavoroUNIMI ti permette di comunicare in maniera semplice e rapida con le aziende su tutto il territorio italiano.</p>
              </div>
            </div>

            <!-- Slide Two - Set the background image for this slide in the line below -->
            <div class="carousel-item rounded" style="background-image:linear-gradient(rgba(255,255,255,.4), rgba(255,255,255,.4)), url('https://www.voglioviverecosi.com/wp-content/uploads/2019/03/LAVORO-AZIENDE-ITALINE-ESTERO-1900x1080.jpg')">
              <div class="carousel-caption d-none d-md-block">
                <h3 class="text-body">Il lavoro è qui che ti aspetta</h3>
                <p class="text-body lead font-italic font-weight-normal">Iscriviti subito su TrovaLavoroUNIMI per cercare i lavori più adatti a te.</p>
              </div>
            </div>
          </div>

          <!-- Previous slide navigator -->
          <a class="carousel-control-prev" role="button" href="#carouselExampleIndicators" data-slide="prev">
            <i class="fas fa-chevron-left fa-lg" aria-hidden="true" style="color:black"></i>
          </a>

          <!-- Next slide navigator -->
          <a class="carousel-control-next" role="button" href="#carouselExampleIndicators" data-slide="next">
            <i class="fas fa-chevron-right fa-lg" aria-hidden="true" style="color:black"></i>
          </a>

        </div>
      </div>


    <!-- Sign up buttons -->
    <div class="container">

      <h1 class="my-4">Benvenuto su TrovaLavoroUNIMI</h1>
      <div class="row">



        <div class="col-lg-5 mb-5">
          <div class="card h-100">
            <h4 class="card-header">Registrati come candidato</h4>
            <div class="card-body">
              <p class="card-text">Entra su TrovaLavoroUNIMI e trova centinaia di annunci per trovare il lavoro adatto per te. Numerose aziende ti stanno aspettando!</p>
            </div>
            <div class="card-footer">
              <a href="registrazione_candidato.php" class="btn btn-primary">Registrati ora!</a>
            </div>
          </div>
        </div>


      <div class="col-lg-5 mb-5 offset-md-2">
        <div class="card h-100">
          <h4 class="card-header">Registrati come azienda</h4>
          <div class="card-body">
            <p class="card-text">Su TrovaLavoroUNIMI potrai cercare facilmente il personale più adatto e qualificato per la tua attivita.</p>
          </div>
          <div class="card-footer">
            <a href="registrazione_azienda.php" class="btn btn-primary">Registrati ora!</a>
          </div>
        </div>
      </div>

    </div>
  </div>

    <?php include "../frontend/modals.php" ?>



  </body>
  <?php include("../common/footer.php") ?>
</html>

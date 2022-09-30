<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>

    <?php include("../common/head.php");
          include("../common/functions.php");?>


    <title>Home</title>
  </head>
  <body>
    <?php include("../header/header.php") ?>

    <div class="container-fluid">
      <?php if(isset($_GET["error"])){
        //visualizzazione generica del messaggio di errore
      echo "<h3 class = 'alert alert-danger'>".$_GET["error"]."</h3>";
      } ?>
      <div class="jumbotron jumbotron-fluid bg rounded">
        <div class="row" style = "margin:10%">
          <div class="col">
            <h1 class="display-4 text-white">
              <?php
              //messaggio nel jumbotron a seconda dell'utente
              if(isset($_SESSION["azienda"])){
                echo "Trova i candidati migliori";
              }
              else{
                echo "Trova le offerte che fanno per te";
              }
            ?></h1>
            <form method="post" action = "../backend/home_search.php">

              <div class="d-lg-flex flex-lg-row">


                  <select class="form-control" name="cit">

                        <option value="">Seleziona citta</option>
                        <?php
                        //select filtro città, prelievo delle città dal DB
                        include("../common/setup.php");
                        $citta = array();
                        $citta = load_cit($cid);


                        foreach ($citta as $value) {
                          echo " <option value=$value>$value</option>";
                        }
                        mysqli_close($cid);
                         ?>
                       </select>
                  <input type="search" class="form-control ds-input w-100 mr-2" name = "search" style="margin-bottom: 1rem" id="search-input" placeholder="Cerca..." aria-label="Search for..." autocomplete="off" spellcheck="false" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-owns="algolia-autocomplete-listbox-0" dir="auto" style="position: relative; vertical-align: top;">
                  <input type="submit" class="btn btn-success w-50" value="Cerca" style = "height: 50%">
              </div>

            </form>

          </div>

        </div>
      </div>
      <hr>


    </div>
    <?php include("../frontend/modals.php") ?>
    <?php include("../common/footer.php") ?>

  </body>
</html>

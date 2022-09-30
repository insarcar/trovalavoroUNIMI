<?php
//setup e permessi
session_start();
include("../common/functions.php");
if(isset($_SESSION["azienda"])){
  $user = $_SESSION["azienda"];
}
else{
  $error = "Non hai il permesso di accedere a questa pagina";
  header("Location: ../frontend/home.php?error=".$error);
}
//selezione azione (inserimento o modifica), con controllo dei permessi per la modifica
include("../common/setup.php");
if(isset($_GET["id"])){
  if(!check_proper($_GET["id"], $cid)){

      $error = "Non hai il permesso di accedere a questa pagina";
      header("Location: ../frontend/home.php?error=".$error);

  }
  if($_GET["id"] != '0' && empty($_GET["id"])){

    $error = "C'è stato un errore nel redirect";
    header("Location: ../frontend/home.php?error=".$error);

  }
  $bread = "Modifica annuncio";
  $method = "../backend/alter_annuncio.php?id=".$_GET["id"];
}
else{
  $method = "../backend/inserisci_annuncio.php";
}
mysqli_close($cid);
 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Inserimento Annuncio</title>
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
          <a href="../frontend/profile.php?azienda=<?php echo $_SESSION["azienda"] ?>">Profilo</a>
        </li>
        <li class="breadcrumb-item active"><?php if(isset($bread)){echo $bread;}else{echo "Inserimento Annuncio";}?></li>
      </ol>

    <?php if(isset($_GET["error"])){
    echo "<h3 class = 'alert alert-danger'>".$_GET["error"]."</h3>";
    } ?>

    <form method="post" action=<?php echo $method ?>>
      <div class="row">
        <div class="col">
            <span class="d-flex badge badge white els"><h2 class = "text-primary text-bold mt-2">Titolo</h2></span>
        </div>

      </div>

      <div class="row mt-2 mb-2">
        <div class="col">

            <textarea class="form-control listing" name = "title" placeholder="scrivi un titolo..." rows="2" <?php if(!isset($_GET["id"])) echo "required"?>></textarea>


        </div>

      </div>
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
        <div class="card-header" role="tab" id="headingOne">
          <h5 class="mb-0">
            <a class="collapsed text-white" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Altri dettagli</a>
          </h5>
        </div>
        <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
          <div class="card-body">
            <div class="row mt-1">

              <div class="col">
                <span class="u-alert" id="form-datai">Immetti una data di inizio valida</span>
                <span class="u-alert text-right" id="form-retr">Immetti un formato di retribuzone valido (Max 8 cifre intere seguite da 2 decimali, es: 100.00)</span>
                <div class="d-lg-flex flex-lg-row badge badge-info">
                  <div class="p-2 mt-2">Data d'inizio del rapporto lavorativo:</div>
                  <input class="form-control ml-2 c-form-input" type="date" id = "datai" name="datai" placeholder="Data di inizio" oninput="isValid(this)" <?php if(!isset($_GET["id"])) echo "required"?>/>
                  <input class="ml-2 form-control c-form-input" type="text" id = "retr" name="retr" pattern = "^[0-9]{1,8}[.][0-9]{2}" oninput="isValid(this)" placeholder="Eventuale retribuzone lorda"/>
                </div>
                <div class="d-lg-flex flex-lg-row badge badge-info">

                  <div class="p-2 mt-2">Eventuale settore lavorativo associato:</div>
                  <select class="form-control ml-2" name="settl">
                    <?php

                      echo "<option value=''> </option>";

                    $sett  = array('Acquisti, logistica, magazzino' , 'Amministrazione, contabilita, segreteria' , 'Commercio al dettaglio, GDO, Retail' ,
                            'Finanza, banche e credito' , 'Ingegneria' , 'Professioni e mestieri' , 'Settore farmaceutico' , 'Affari legali' , 'Arti grafiche, design'
                             , 'Edilizia, immobiliare' , 'Formazione, istruzione' , 'Marketing, comunicazione' , 'Pubblica amministrazione' , 'Turismo, ristorazione'
                             , 'Altre' , 'Attenzione al cliente' , 'Farmacia, medicina, salute' , 'Informatica, IT e telecomunicazioni'
                             , 'Operai, produzione, qualita' , 'Risorse umane, recruiting' , 'Vendite');

                      foreach ($sett as $value) {
                        echo "<option value=$value>$value</option>";
                      }

                     ?>

                  </select>
                    <div class="p-2 mt-2">Specifica del tipo di contratto offerto:</div>
                    <select class="form-control ml-2" name="contra" id = "Contratto" oninput="showDetails(this)"<?php if(!isset($_GET["id"])) echo "required"?>>
                      <?php if(isset($_GET["id"])){
                        echo "<option value=''> </option>";
                      } ?>
                      <option value="Contratto a tempo determinato">A tempo determinato</option>
                      <option value="Contratto a tempo indeterminato">A tempo indeterminato</option>
                      <option value="Contratto a chiamata">A chiamata</option>
                    </select>


                </div>


                </div>

              </div>
          </div>
        </div>
      </div>
      <div class="card bg-info els">
        <div class="card-header determinato" role = "tab" id="headingThreeA" style="display:block">
          <h5 class = "mb-0">
            <a class="collapsed text-white" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Dettagli del contratto a tempo determinato <?php if(!isset($_GET['id'])) echo "(obbligatori)";?></a>
          </h5>
        </div>
        <div class="collapse" id="collapseThree" role="tabpanel" aria-labelledby="headingThreeA">
          <div class="card-body">
            <div class="row mt-1">
              <div class="col">
                <span class="u-alert" id="form-durata">Immetti una durata valida</span>

                <div class="d-lg-flex flex-lg-row badge badge-info">

                    <input class="form-control ml-2 c-form-input" type="number" id = "durata" name="durata" placeholder="Durata dell'impiego in mesi" min = 0 oninput="isValid(this)" <?php if(!isset($_GET["id"])) echo "required"?>/>
                    <div class="p-2 mt-2">Numero giorni lavorativi settimanali:</div>
                    <select class="form-control ml-2" name="nlav" id = "nlav" <?php if(!isset($_GET["id"])) echo "required"?>>
                      <?php if(isset($_GET["id"])){
                        echo "<option value=''> </option>";
                      } ?>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                    </select>
                </div>
                <span class="u-alert text-right" id="form-dataf">Immetti una data di fine valida</span>
                <div class="d-lg-flex flex-lg-row badge badge-info">
                  <div class="p-2 mt-2">Data di termine rapporto lavorativo:</div>
                  <input class="form-control ml-2 c-form-input" type="date" id = "dataf" name="dataf" oninput="isValid(this)" placeholder="Data di fine" <?php if(!isset($_GET["id"])) echo "required"?>/>
                </div>

              </div>

            </div>

          </div>

        </div>

      </div>
      <div class="card bg-info els">
        <div class="card-header" role="tab" id="headingTwo">
          <h5 class="mb-0">
            <a class="collapsed text-white" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Visibilita</a>
          </h5>
        </div>
        <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
          <div class="card-body">
            <div class="row mt-1">

              <div class="col">
                <span class="u-alert text-right" id="form-pvis">Immetti un periodo valido</span>
                <div class="d-lg-flex flex-lg-row badge badge-info">

                  <select class="form-control mr-2" name="vis" id = "vis" <?php if(!isset($_GET["id"])) echo "required"?>>
                    <?php if(isset($_GET["id"])){
                      echo "<option value=''> </option>";
                    } ?>
                    <option value="private">Privato</option>
                    <option value="public">Pubblico</option>
                    <option value="specific">Riservato</option>
                  </select>
                  <input class="form-control c-form-input" type="number" id = "pvis" name="pvis" placeholder="Periodo di visibilita in giorni"  min = "1" oninput="isValid(this)"/>



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

      </div>

    </form>

    </div>
<?php include("../common/footer.php") ?>
  </body>
</html>

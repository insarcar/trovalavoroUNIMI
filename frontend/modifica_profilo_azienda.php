<?php
//setup e permessi
session_start();
include("../common/functions.php");
if(!isset($_SESSION["azienda"])){
  $error = "Non sei autorizzato a visualizzare questa pagina";
  header("Location: ../frontend/home.php?error=".$error);
}


 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <title>Modifica Profilo</title>
    <?php include("../common/head.php") ?>

    <style media="screen">
    .file-upload input[type='file'] {
      display: none;
    }
    @media (min-width: 768px) {
      .mediatic{
         margin-top:-0.5%; margin-left:3%;
       }
      .img-mediatic{
        margin-top: -2.5%;
      }
    }
    @media (min-width: 992px) {
      .mediatic{
         margin-top:-7.5%; margin-left:3%;
       }
    }
    </style>
  </head>
  <body>
    <?php include("../header/header.php") ?>
    <div class="container emp-profile" style = "box-shadow: 2px 2px 2px 2px">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="home.php">Home</a>
        </li>
        <li class="breadcrumb-item">
          <a href="profile.php?azienda=<?php echo $_SESSION["azienda"] ?>">Profilo</a>
        </li>
        <li class="breadcrumb-item active">Modifica Profilo</li>
      </ol>
      <h4 class= 'alert alert-primary'>Lascia vuoti i campi che non vuoi modificare</h4>

        <form method="post" action="../backend/alter_profile_azienda.php" enctype="multipart/form-data" onsubmit="formSubmit(this)">
          <div class="row flex-row-reverse">
            <div class="col-md-2">
              <div class="text-center mx-auto d-block">
                <img src="http://placehold.it/150x150" class="img-fluid rounded-circle"/>
                <label for="logo" class="file-upload btn btn-primary btn-sm btn-block rounded-pill shadow mt-1"><i class="fas fa-upload mr-2"></i><small class="font-weight-bolder">Cambia Logo</small>
                    <input id="logo" type="file" name = "logo" oninput="isValid(this)">
                </label>
                <span class="u-alert" id="form-logo">Max 20 MB, formati permessi [JPG, PNG, JPEG, GIF]</span>

              </div>


            </div>
            <div class="col-md-2 mt-2">
              <div class="text-center mx-auto d-block img-mediatic">
                <img src="http://placehold.it/150x150" class="img-fluid rounded"/>
                <label for="foto" class="file-upload btn btn-primary btn-block rounded-pill shadow mt-1"><i class="fas fa-upload mr-2"></i><small class="font-weight-bolder">Cambia Foto</small>
                    <input id="foto" type="file" name = "foto" oninput="isValid(this)">
                </label>
                <span class="u-alert" id="form-foto">Max 20 MB, formati permessi [JPG, PNG, JPEG, GIF]</span>


              </div>
            </div>
            <div class="col mt-2">
              <div class="profile-head">

                    <div class="d-lg-flex flex-row-lg ml-4 mb-1">
                      <input type="text" class ="form-control c-form-input" name="nome" id="nome" placeholder="Nome dell'azienda" pattern = "^[A-Za-zàòèéùì' ]+$" oninput="isValid(this)">

                      <select class ="form-control" name="ragsoc" id="ragsoc">
                        <option value=""> </option>
                        <option value="S.s.">S.s.</option>
                        <option value="S.a.s.">S.a.s.</option>
                        <option value="S.n.c.">S.n.c.</option>
                        <option value="S.p.a.">S.p.a.</option>
                        <option value="S.a.p.a.">S.a.p.a.</option>
                        <option value="S.r.l.">S.r.l.</option>
                        <option value="S.r.ls.">S.r.ls.</option>
                        <option value="Cooperativa Sociale">Cooperativa sociale</option>

                      </select>
                      <input type="submit" class="btn btn-info pull-right" value="Conferma">

                    </div>

                    <span class="u-alert" id="form-nome">Immetti un formato di nome valido</span>
                    <span class="u-alert" id="form-submit">Correggi i campi non validi</span>




                  <ul class="nav nav-tabs d-flex flex-row justify-content-center justify-content-md-start" id="myTab" role="tablist">
                      <li class="nav-item">
                          <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Dati</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Descrizione</a>
                      </li>
                  </ul>
              </div>


              </div>

            </div>
            <div class="row">

              <div class="col-md-7 mediatic">
                <div class="tab-content profile-tab" id="myTabContent">
                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">



                                  <div class="row">
                                      <div class="col">
                                        <p class="alert alert-info text-info text-left">Modifica i tuoi dati</p>
                                        <div class="form-group">
                                          <input type="text" class ="form-control c-form-input" name="piva" id="piva" placeholder="Partita Iva" pattern = "^[0-9]{11}$" oninput="isValid(this)">
                                          <span class="u-alert" id="form-piva">Immetti una partita IVA valida</span>
                                        </div>
                                        <div class="form-group">
                                          <input type="text" class ="form-control c-form-input" name="user" id="user" placeholder="Email" pattern="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$" oninput="isValid(this)">
                                          <span class="u-alert" id="form-user">Immetti un formato di E-mail valido</span>
                                        </div>
                                        <div class="form-group">
                                          <input type="password" class ="form-control c-form-input" name="psw" id="psw" placeholder="Password" pattern = "^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" minlength = "8" maxlength= "30" oninput="isValid(this)">
                                          <span class="u-alert" id="form-psw">Immetti un formato di password valido (almeno 8 caratteri, almeno una lettera ed un numero)</span>
                                        </div>
                                        <div class="form-group">
                                          <input type="password" class ="form-control c-form-input" name="psw2" id="psw2" placeholder="Reinserisci Password" oninput="isValid(this)">
                                            <span class="u-alert" id="form-psw2">Le password non corrispondono</span>
                                        </div>
                                        <div class="d-lg-flex flex-row-lg">
                                          <select class="form-control" name="via">
                                            <option value=""> </option>
                                            <option value="Via">Via</option>
                                            <option value="Piazza">Piazza</option>
                                            <option value="Corso">Corso</option>
                                            <option value="Vicolo">Vicolo</option>
                                          </select>
                                          <input type="text" class="form-contro c-form-inputl" name="nvia" id = "nvia" placeholder="Nome della via, piazza o vicolo" pattern = "^[A-Za-zàòèéùì' ]+$" oninput="isValid(this)">
                                          <input type="text" class="form-control c-form-input" name="nciv" id = "nciv" placeholder="Numero civico" pattern = "^[0-9]{1,3}([/]?)([A-Z]?)$" oninput="isValid(this)">

                                        </div>
                                        <span class="u-alert" id="form-nvia">Immetti un nome di via valido</span>
                                        <span class="u-alert" id="form-nciv">Immetti un numero civico valido</span>
                                        <div class="form-group">
                                          <input type="text" class="form-control c-form-input" name="cit" id = "cit" placeholder="Citta" pattern = "^[A-Za-zàòèéùì' ]+$" oninput="isValid(this)">
                                          <span class="u-alert" id="form-cit">Immetti una città valida</span>
                                          <input type="text" class="form-control c-form-input" name="cap" id = "cap" placeholder="CAP generico" pattern = "^[0-9]+$" minlength = "5" maxlength="5" oninput="isValid(this)">
                                          <span class="u-alert" id="form-cap">Immetti un CAP valido</span>
                                        </div>

                                        <div class="form-group">

                                          <input class="form-control c-form-input" type="text" name="tel" placeholder="Numero di Telefono" pattern = "^[+0-9]+$" minlength = "11" maxlength="13" oninput="isValid(this)">
                                          <span class="u-alert" id="form-tel">Immetti un numero di telefono valido</span>
                                        </div>
                                      </div>
                                  </div>

                            </div>

                            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                              <div class="row">
                                <div class="col-lg">
                                  <p class="alert alert-info text-info text-right">Inserisci una descrizione e delle keyword</p>
                                  <textarea class="form-control" name="descr" placeholder="inserisci una descrizione..." rows="7"></textarea>
                                  <hr>
                                  <textarea class="form-control" name = "keys" placeholder="inserisci una serie di keywords separate da spazi..." rows="3"></textarea>
                                  <hr>
                                  </a>
                                </div>
                              </div>

                          </div>

            </div>
          </div>


        </form>
    </div>
 </div>
 <?php include("../common/footer.php") ?>
  </body>
</html>

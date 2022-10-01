<?php
//setup e permessi
session_start();
//se c'è un utente loggato, è più elegante non lasciargli visualizzare questa pagina
if(isset($_SESSION['candidato']) || isset($_SESSION['azienda'])){
  header("Location: ../frontend/home.php");
}
$error ="";
$dati=array();
if (isset($_GET["status"]))
{
  if (isset($_GET["error"])){
    $error = $_GET["error"];
    if(isset($_GET["dati"])){
      $dati = unserialize($_GET["dati"]);
    }
  }
}

 ?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

  <head>
    <title>Registrazione Candidato</title>
    <?php include("../common/head.php"); ?>
  </head>

  <body>
    <?php include("../header/header.php"); ?>
     <section class ="signup">
       <div class="container-fluid" style="margin-top: 4.5%">
          <div class="signup-form">
            <form class="signup-form" action="../backend/ok_registrazione_candidato.php" method="get">
              <h2 class = "form-title">Registrazione<br>Candidati</h2>
              <p class = "hint-text">Inserisci i tuoi dati, per inserirti nel portale!</p>
              <?php if(isset($error)){echo "<div class = 'alert-danger'>".$error."</div>";} ?>
              <div class="form-group">
                <input type="text" class ="form-control c-form-input" name="nome" id="nome" placeholder="Nome" required pattern = "^[A-Za-zàòèéùì' ]+$" oninput="isValid(this)" value = <?php if(isset($dati["nome"])) echo $dati["nome"];
                                                                                                                              else echo "";?>>
                <span class="u-alert" id="form-nome">Immetti un formato di nome valido</span>
                <input type="text" class ="form-control c-form-input" name="cogn" id="cogn" placeholder="Cognome" required pattern = "^[A-Za-zàòèéùì' ]+$" oninput="isValid(this)" value = <?php if(isset($dati["cogn"])) echo $dati["cogn"];
                                                                                                                              else echo "";?>>
               <span class="u-alert" id="form-cogn">Immetti un formato di cognome valido</span>
              </div>
              <div class="form-group">


                Data di nascita:<input type="date" class ="form-control c-form-input" name="datan" id="datan" placeholder="Data di nascita" required oninput="isValid(this)" value = "<?php if(isset($dati["datan"])) echo $dati["datan"];
                                                                                                                              else echo "";?>">
                <span class="u-alert" id="form-datan">Devi avere almeno 16 anni</span>
              </div>
              <div class="form-group">
                <input type="text" class ="form-control c-form-input" name="user" id="user" placeholder="Email" required pattern="^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$" oninput="isValid(this)" value = <?php if(isset($dati["user"])) echo $dati["user"];
                                                                                                                              else echo "";?>>
                <span class="u-alert" id="form-user">Immetti un formato di E-mail valido (o questa E-mail è già stata usata)</span>
              </div>
              <div class="form-group">
                <input type="password" class ="form-control c-form-input" name="psw" id="psw" placeholder="Password" required pattern = "^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$" minlength = "8" maxlength= "30" oninput="isValid(this)">
                <span class="u-alert" id="form-psw">Immetti un formato di password valido (almeno 8 caratteri, almeno una lettera ed un numero)</span>
              </div>
              <div class="form-group">
                <input type="password" class ="form-control c-form-input" name="psw2" id="psw2" placeholder="Reinserisci Password" required oninput="isValid(this)">
                <span class="u-alert" id="form-psw2">Le password non corrispondono</span>
              </div>
              <div class="form-group">
                <select class="form-control" name="via" required value = <?php if(isset($dati["tvia"])) echo $dati["tvia"];
                                                                                        else echo "";?>>
                  <option value="Via">Via</option>
                  <option value="Piazza">Piazza</option>
                  <option value="Corso">Corso</option>
                  <option value="Vicolo">Vicolo</option>
                </select>
                <input type="text" class="form-control c-form-input" name="nvia" id = "nvia" placeholder="Nome della via, piazza o vicolo" required pattern = "^[A-Za-zàòèéùì' ]+$" oninput="isValid(this)" value = <?php if(isset($dati["via"])) echo $dati["via"];
                                                                                                                              else echo "";?>>
                <span class="u-alert" id="form-nvia">Immetti un formato di nome della via valido</span>
                <input type="text" class="form-control c-form-input" name="nciv" id = "nciv" placeholder="Numero civico" required pattern = "^[0-9]{1,3}([/]?)([A-Z]?)$" oninput="isValid(this)" value = <?php if(isset($dati["nciv"])) echo $dati["nciv"];
                                                                                                                              else echo "";?>>
                <span class="u-alert" id="form-nciv">Immetti un formato di numero civico valido</span>
              </div>
              <div class="form-group">
                <input type="text" class="form-control c-form-input" name="cit" id = "cit" placeholder="Citta" required pattern = "^[A-Za-zàòèéùì' ]+$" oninput="isValid(this)" value = <?php if(isset($dati["cit"])) echo $dati["cit"];
                                                                                                                              else echo "";?>>
                <span class="u-alert" id="form-cit">Immetti un formato di nome di città valido</span>
                <input type="text" class="form-control c-form-input" name="cap" id = "cap" placeholder="CAP generico" required pattern = "^[0-9]+$" minlength = "5" maxlength="5" oninput="isValid(this)" value = <?php if(isset($dati["cap"])) echo $dati["cap"];
                                                                                                                              else echo "";?>>
                <span class="u-alert" id="form-cap">Immetti un formato di CAP valido</span>
              </div>
              <div class="form-group" style = "padding-left:25px">
                <input type="submit" name="submit" id = "submit" class="btn btn-success" value="Registrati">
                <input type="reset" name="reset" id = "reset" class="btn btn-secondary" value="Ricompila">
              </div>
            </form>
            <div class="text-center">Hai già un account account? <a href="#" class = "text-primary" data-toggle="modal" data-target="#login-modal">Sign in</a></div>
          </div>

         </div>
     </section>

     <?php include("../frontend/modals.php") ?>
  </body>
</html>

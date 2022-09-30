<!-- Login modal -->
<div id="login-modal" class="modal fade" tabindex="-1">
  <div class="modal-dialog" role="dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class='col-12 modal-title text-center'>
          Accedi!
        </h3>
        <button type='button' class='close' data-dismiss='modal' aria-label='Close' style="position: fixed;" >
          <span aria-hidden='true'>&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="POST" action="../backend/login_exe.php?url=<?php/*prelievo dell'URL corrente per il redirect alla stessa pagina*/ echo $_SERVER['REQUEST_URI'] ?>" onsubmit="login()">
         <p class="align-items-center">Vuoi accedere come candidato o come azienda?</p>
         <input id = "r1" type="radio" name="user_ty" value="candidato" required>  Candidato
         <input id = "r2" type="radio" name="user_ty" value="azienda">  Azienda <br><br>
         <input class="form-control c-form-input" id = "email" type="text" name="user" oninput="isValid(this)" placeholder="E-mail" required>
         <span class="u-alert" id="form-email">E-mail non valida</span>
         <input class="form-control c-form-input" id = "pass" type="password" name="pass" oninput="isValid(this)" placeholder="Password" required>
         <span class="u-alert" id="form-pass">Password non valida</span>
         <br>Ricordami: <input type="checkbox" id = "rem" name="ricordami">
      </div>
      <div class="modal-footer">
          <input type="reset" class="btn btn-default" value="Reset">
          <input type="submit" class="btn btn-primary" value="Invia">
        </form>
      </div>
    </div>
  </div>
</div>



<!-- Sign up modal -->
<div id="signup-modal" class="modal fade" tabindex="-1">
  <div class="modal-dialog" role="dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class='col-12 modal-title text-center'>
          Crea il tuo account!
          <button type='button' class='close' data-dismiss='modal' aria-label='Close' style="position: fixed">
            <span aria-hidden='true'>&times;</span>
          </button>
        </h3>
      </div>
      <div class="modal-body">
              <p class="items-align-center">Vuoi registrarti come candidato o come azienda?</p>

              <a href="registrazione_candidato.php"> <button type="button" class="btn btn-primary">Candidato</button></a>
              <a href="registrazione_azienda.php"> <button type="button" class="btn btn-primary">Azienda</button></a>


      </div>
      <div class="modal-footer">



      </div>
    </div>
  </div>
</div>




<!-- Modal valutazione -->
<div class="modal fade" id="valModal">
<div class="modal-dialog">
<div class="modal-content">

  <div class="modal-header">
    <h4 class="modal-title">Valuta</h4>
    <button type="button" class="close" data-dismiss="modal">&times;</button>
  </div>


  <div class="modal-body">
    <div class="container p-2 rounded" style="background-color:#e9ecef">
      <div class="row">
        <div class="col">
          <form method="post" action="../backend/valuta.php?idc=<?php echo $_GET["id"]."&ida=".$_GET["ida"];?>">
            <div class="d-flex flex-row">

              <div class="badge badge-info text-left">
                Esprimi un Giudizio
              </div>
            </div>

            <select class="form-control mt-2" name="giud" required>
              <option value="Adeguato">Adeguato</option>
              <option value="Pienamente adeguato">Pienamente Adeguato</option>
              <option value="Non adeguato">Non Adeguato</option>
              <br>

            </select>

              <div class="d-flex flex-row mt-2">

                <div class="badge badge-info text-left">
                  Assegna un Esito
                </div>
              </div>
            <select class="form-control mt-2" id = "esito" name="esito" oninput = "showMotiv(this)" required>
                <option value="Accettato">Accettato</option>
                <option value="Non Accettato">Non Accettato</option>
            </select>
            <textarea class="form-control" id= "motiv" name="motiv" rows="3" placeholder="Motivazione se non accettato..." style="display:none;"></textarea>
            <div class="d-flex flex-row justify-content-end mt-2">
              <input class="btn btn-primary btn-md" type="submit" value="Conferma">
            </div>

          </form>
        </div>

      </div>
    </div>
  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
  </div>

</div>
</div>
</div>

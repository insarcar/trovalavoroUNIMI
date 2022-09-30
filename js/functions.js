
const inputList = Array.prototype.slice.call(document.getElementsByTagName('input')).filter(item => item.type !== 'submit' && item.type !== 'checkbox');
const input = inputList.concat(Array.prototype.slice.call(document.getElementsByTagName('textarea')));
//interfaccia di validazione per l'input nei form
function isValid(input) {

  const target = input.id ? input.id : input.target.id; // input.target.id se input.id = undefined (se la funzione viene chiamata fuori dal DOM)
  //partita iva alla registrazione delle aziende
  if(target == "user"){

    reg_email(target);
  }

  if(target == "piva"){

    check_piva(target);
  }
  //email al login
  if(target == "email"){

    login_email(target);

  }
  //password al login
  if(target == "pass"){

    login_pass(target);

  }
  //nome del curriculum
  if(target == "nomecv"){

    valNomecv(target);

  }
  //data di fine nell'annuncio
  if(target == "dataf"){

    if(valDataf(target)){

      document.getElementById(target).setCustomValidity('');
    }
    else{
      document.getElementById(target).setCustomValidity("Invalid date");
    }
  }
  //data d'inizio nell'annuncio
  if(target == "datai"){

    valDatai(target);
  }
  //foto e logo
  if(target == "foto" || target == "logo"){
   //console.log(fileValid(document.getElementById(target)));
   if(fileValid(document.getElementById(target))){

        window.alert("Immagine caricabile con successo");
        document.getElementById(target).setCustomValidity('');

    }
    else {

        document.getElementById(target).setCustomValidity("File is too big or invalid extension");
    }

  }
  //data di nascita del candidato
  if(target == "datan"){

    valDatan(target);

  }
  //reinserimento password alla registrazione
  if(target == "psw2"){
    var password = document.getElementById("psw");

    if(password.value != input.value) {
      document.getElementById(target).setCustomValidity("Passwords Don't Match");
    }
    else {
      document.getElementById(target).setCustomValidity('');
    }
  }
  //salvo la validita (boolean) in una variabile
  const valid = document.getElementById(target).validity.valid;

  if(valid){
    //se il campo è valido rimuovo la 'sottoclasse' invalid dal messaggio di errore
    //rimuovo l'attributo html role (alert)
    //valido il campo falsando aria-invalid
    document.getElementById(`form-${target}`).classList.remove('invalid');
    document.getElementById(`form-${target}`).removeAttribute('role');
    document.getElementById(target).setAttribute('aria-invalid', 'false');
  }
  else{
    //se non è valido aggiungo la sottoclasse, il role alert, ed invalido il campo
    document.getElementById(`form-${target}`).classList.add('invalid');
    document.getElementById(`form-${target}`).setAttribute('role', 'alert');
    document.getElementById(target).setAttribute('aria-invalid', 'true');
  //  console.log(document.getElementById(target));
  }


  return valid;
}

function reg_email(target){

  var email = $('#'+target).val();
  var action = "EMAIL_REG";
  var url = $(location).attr('href');
  var table;
  if(url.indexOf("candidato") > -1){
    table = "candidato";
  }
  else{
    table = "azienda";
  }
  console.log(email);
  console.log(table);
  const valid = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
  $.ajax({
    method: "post",
    url: "../api/api.php",
    data: {email, action, table},
    success: function(res, status){
      if(res == 'true' && valid.test(email)){

        document.getElementById(target).setCustomValidity('');
        document.getElementById(`form-${target}`).classList.remove('invalid');
        document.getElementById(`form-${target}`).removeAttribute('role');
        document.getElementById(target).setAttribute('aria-invalid', 'false');

      }
      else{
        console.log(res);
        document.getElementById(target).setCustomValidity('Double "email" or incorrect format');
        document.getElementById(`form-${target}`).classList.add('invalid');
        document.getElementById(`form-${target}`).setAttribute('role', 'alert');
        document.getElementById(target).setAttribute('aria-invalid', 'true');
      }
    }
    })
}

//validazione dei file in input, logo o foto
function fileValid(fdata){
 //setup per la tagli amassima le estensioni valide
 //estrazione del path temporaneo del file
 var maxSize = '20480';
 var validExt = ".png, .gif, .jpeg, .jpg";
 var filePath = fdata.value;
 //controllo dell'estensione del file, estrazione con substring a partire dal punto
 var getFileExt = filePath.substring(filePath.lastIndexOf('.') + 1).toLowerCase();
 var pos = validExt.indexOf(getFileExt);
 var flag = false;
 var flag1 = false;

 if(pos < 0) {

 	flag = false;

  }
  else {

    flag = true;

  }
  //controllo della taglia massima (20MB)
  if (fdata.files && fdata.files[0]) {

   var fsize = fdata.files[0].size/1024;

   if(fsize > maxSize) {

      flag1 = false;

   }
   else {

     flag1 = true;

   }
 }

 return flag && flag1;
}
//validazione dell'eta minima per iscriversi alla piattaforma
function valDatan(target){

  var today = new Date();
  var datan = new Date(document.getElementById(target).value);

  var age = Number(today.getFullYear()) - Number(datan.getFullYear());
  // eta = differenza in anni tra current date e data di nascita
  var m = Number(today.getMonth()) - Number(datan.getMonth());
  if (m < 0 || (m === 0 && Number(today.getDate()) < Number(datan.getDate()))) {
    //se la differenza tra i mesi è minore di zero, o uguale a zero e quella tra i giorni è minore di zero
    //allora l'eta va diminuita di uno
    age--;
  }
  //se l'eta risulta minore di 16 non è valida
  if (age < 16){

    document.getElementById(target).setCustomValidity("Age requirements not met");
  }
  else{
    document.getElementById(target).setCustomValidity('');
  }

}
//cambio l'obbligatorieta del periodo di visibilita per gli annunci in base alla visibilita
$(function(){
  $('#vis').change(function(input){
    const target = input.id ? input.id : input.target.id;
    var elm = document.getElementById(target).value;
    if(elm !== "private" && elm !== ''){
      document.getElementById("pvis").required = true;
    }
    else {
      document.getElementById("pvis").required = false;
      $("#pvis").val(null);
    }
  })
})
//mostra dettagli per il contratto a tempo determinato se selezionato
function showDetails(input){
  //estraggo il valore di contratto e l'elemento da mostrare
  const target = input.id ? input.id : input.target.id;
  var elm = document.getElementById(target).value;
  var show = document.getElementById("headingThreeA");

  if(elm == "Contratto a tempo determinato"){
    //se a tempo determinato mostro e i suoi campi diventano required
    show.style.display = "block";
    document.getElementById("durata").required = true;
    document.getElementById("nlav").required = true;
    document.getElementById("dataf").required = true;
  }
  else if(elm == ''){
    show.style.display = "block";
    document.getElementById("durata").required = false;
    document.getElementById("nlav").required = false;
    document.getElementById("dataf").required = false;
    //no altrimenti
  }
  else{
    //toggle collapse e svuota i valori, validandoli se non erano validati
    $('#collapseThree').collapse('hide');
    show.style.display = "none";
    document.getElementById("durata").required = false;
    document.getElementById("nlav").required = false;
    document.getElementById("dataf").required = false;
    $('#durata').val(null);
    $('#nlav').val(null);
    $('#dataf').val(null);
    document.getElementById("durata").setCustomValidity('');
    document.getElementById("nlav").setCustomValidity('');
    document.getElementById("dataf").setCustomValidity('');
  }


}
//validazione della data di inizio inserita nell'annuncio
function valDatai(target){

  var today = new Date();
  var datai = new Date(document.getElementById(target).value);

  var y = Number(today.getFullYear()) - Number(datai.getFullYear());
  var m = Number(today.getMonth()) - Number(datai.getMonth());
  var d = Number(today.getDate()) - Number(datai.getDate());
  //sostanzialmente se la data di inizio immessa viene prima della current date è invalida
  if(y > 0 || y == 0 && m > 0 || y == 0 && m == 0 && d >= 0){

    document.getElementById(target).setCustomValidity('Invalid start date');
  }
  else{

    document.getElementById(target).setCustomValidity('');
  }

}
//validazione della data di fine dell'annuncio
//il controllo è comunque leggero, e aggirabile, inserendo prima un valore valido per la data di fine, e poi cambiando i valori di data di inizio o di durata
//chiaramente non è negli interessi di chi compila un annuncio falsare questo genere di dati
//oltretutto una gestione di tale problema è complicata dal fatto che la data di fine può non essere un campo obbligatorio, e come tale non dovrebbe bloccare a priori l'immissione del form
//quindi per non esacerbare l'articolazione superflua di queste funzioni si ritiene che il problema sia trascurabile
function valDataf(target){

  //prendo data fine, data inizio, e durata
  var dataf = new Date(document.getElementById(target).value);
  var datai = new Date(document.getElementById("datai").value);
  //se manca la data di inizio invalida il valore immesso nella data di fine
  console.log(datai);
  if(!Date.parse(datai)){
    return false;
  }
  //se manca la durata invalida il valore immesso nella data di fine
  var durata = document.getElementById("durata").value * 30;
  if(durata == 0 || durata == null){
    return false;
  }
  // 3 variabili di controllo per l'anno il mese ed il giorno
  var y = Number(dataf.getFullYear()) - Number(datai.getFullYear());
  var m = 12 - Number(datai.getMonth()) + Number(dataf.getMonth()) % 12 ; //quanti mesi restano da anno intero a data d'inizio
  var d = 0;
  if(y < 0 || y == 0 && Number(dataf.getMonth()) - Number(datai.getMonth()) <= 0 || y == 0 && m == 0 && Number(dataf.getDate()) - Number(datai.getDate()) <= 0){
    //se il controllo sull'anno è minore di zero, o se uguale a zero e la differenza di mesi tra fine e inizio è <= 0
    //o se entrambi uguali a zero e differenza di gionrni tra fine e inizio è <= 0 la data di fine è invalidata
    return false;


  }
  else{
    //altrimenti considero il resto delle casistiche calcolando i giorni previsti totali tra inizio e fine
    if(y > 1){
     //se la differenza in anni è di almeno 2
     d += 365 * (y - 1);

    }
    console.log(y);
    if(y == 0){
      m = Number(dataf.getMonth()) - Number(datai.getMonth());
    }
    console.log(m);
    d += 30 * m;
    d += Number(dataf.getDate()) - Number(datai.getDate());
    //console.log(y+" "+m+" " + d + " " + durata);
    var res = d-durata;
    console.log(res);
    if(d - durata > 14 || d - durata < -14){ // data l'approssimativita inseriamo un periodo di tolleranza di due settimane
      //confronto i giorni previsti con la durata
      // se entro fuori range invalida
      return false;

    }
    else{
      //se dentro il range valida
      return true;
    }
  }
}
//mostra e rende required la text area per le motivazioni nella valutazione se l'esito è negativo
function showMotiv(input){
  //estraggo l'esito e la textarea da mostrare e rendere required
  const target = input.id ? input.id : input.target.id;
  var elm = document.getElementById(target).value;
  var show = document.getElementById("motiv");

  if(elm == "Non Accettato"){
    //se non accettato display+required
    show.style.display = "block";
    show.required = true;

  }
  else{
    //se accettato hide+not required
    show.style.display = "none";
    show.required = false;

  }
}

//input ctrl per l'unicità della partita iva
function check_piva(target){
  //estrazione variabili e dichiarazione del regex
  var piva = document.getElementById(target).value;
  var action = 'CONTROLLA_PIVA';
  const valid = /^[0-9]{11}$/;

  $.ajax({
    method: "post",
    url: "../api/api.php",
    data: {piva, action},
    success: function(res, status){
      console.log(res);
      if(res == 'true' && valid.test(piva)){
        //se il controllo è positivo e la regex corrisponde
        console.log(valid);
        document.getElementById(target).setCustomValidity('');
        document.getElementById(`form-${target}`).classList.remove('invalid');
        document.getElementById(`form-${target}`).removeAttribute('role');
        document.getElementById(target).setAttribute('aria-invalid', 'false');

      }
      else{
        //errore altrimenti
        console.log(valid);
        document.getElementById(target).setCustomValidity('Double "pIva" or incorrect format');
        document.getElementById(`form-${target}`).classList.add('invalid');
        document.getElementById(`form-${target}`).setAttribute('role', 'alert');
        document.getElementById(target).setAttribute('aria-invalid', 'true');

      }
    }
  })

}
//input ctrl per il nome del curriculum, chiamata da isValid
function valNomecv(target){
  //estraggo l'input e dichiaro l'azione
  var nomecv = document.getElementById(target).value;
  var action = 'CONTROLLA_NOMECV';
  //ajax request
  $.ajax({
    method: "post",
    url: "../api/api.php",
    data: {nomecv, action},
    success: function(res, status){

      if(res == 'true'){
        //se true è valido
        //per qualche motivo la funzione chiamante (isValid) cambia le proprieta css ogni due chiamate con di mezzo queste ajax request
        //perciò la soluzione improvvisata è di introdurre ridondanza nel codice che cambia il css, poco elegante ma efficace
        document.getElementById(target).setCustomValidity('');
        document.getElementById(`form-${target}`).classList.remove('invalid');
        document.getElementById(`form-${target}`).removeAttribute('role');
        document.getElementById(target).setAttribute('aria-invalid', 'false');

      }
      else if(res == 'false'){
        //se false non valido
        document.getElementById(target).setCustomValidity('Double "Nome Curriculum"');
        document.getElementById(`form-${target}`).classList.add('invalid');
        document.getElementById(`form-${target}`).setAttribute('role', 'alert');
        document.getElementById(target).setAttribute('aria-invalid', 'true');

      }
      else{
        //messaggi per il debug
        window.alert(res);

      }
    }
  })
}
//input ctrl per l'email nel login, chiamata da isValid
function login_email(target){
  //estraggo il radio selezionato, se non ve ne sono selezionati errore
  if (document.getElementById('r1').checked) {

    var tipo = document.getElementById('r1').value;
  }
  else if(document.getElementById('r2').checked){

    var tipo = document.getElementById('r2').value;

  }
  else{

    document.getElementById("email").setCustomValidity('Missing radio');
    window.alert("Seleziona il tipo di utente per cui stai loggando!");
    return false;
  }
  //estraggo email e dichiaro l'action per l'api
  var email = document.getElementById(target).value;
  var action = 'LOGIN_EMAIL';
  //ajax request
  $.ajax({
    method:"post",
    url: "../api/api.php",
    data: { action, email, tipo },
    success: function(res, status){

      console.log(status);
      console.log(res);
      if(res == 'true'){
        //se true è valida
        document.getElementById("email").setCustomValidity('');
        document.getElementById(`form-${target}`).classList.remove('invalid');
        document.getElementById(`form-${target}`).removeAttribute('role');
        document.getElementById(target).setAttribute('aria-invalid', 'false');

      }
      else if(res == 'false'){
        //se false non è valida
        document.getElementById("email").setCustomValidity('Invalid email');
        document.getElementById(`form-${target}`).classList.add('invalid');
        document.getElementById(`form-${target}`).setAttribute('role', 'alert');
        document.getElementById(target).setAttribute('aria-invalid', 'true');

      }
      else{
        //per altri tipi di errori window alert
        window.alert(res);

        document.getElementById("email").setCustomValidity('Invalid email');
        document.getElementById(`form-${target}`).classList.add('invalid');
        document.getElementById(`form-${target}`).setAttribute('role', 'alert');
        document.getElementById(target).setAttribute('aria-invalid', 'true');
      }

    }
  })
}
//input ctrl per la password nel login, chiamata da isValid
function login_pass(target){
    //estraggo il radio selezionato, se non ve ne sono selezionati errore
    if (document.getElementById('r1').checked) {

      var tipo = document.getElementById('r1').value;
    }
    else if(document.getElementById('r2').checked){

      var tipo = document.getElementById('r2').value;

    }
    else{
      document.getElementById(target).setCustomValidity('Missing radio');
      window.alert("Seleziona il tipo di utente in cui stai loggando!");
      return false;
    }
    //estraggo email e password e dichiaro l'action per l'api
    var email = document.getElementById("email").value;
    var pass = document.getElementById(target).value;
    var action = 'LOGIN_PASS';
    //ajax request
    $.ajax({
      method:"post",
      url: "../api/api.php",
      data: {action, email, pass, tipo},
      success: function(res, status){

        console.log(status);
        console.log(res);
        if(res == 'true'){
          //se torna true è valida, i parametri del css e di aria invalid vengono modificati anche qui per le ragioni spiegate sopra

          document.getElementById(target).setCustomValidity('');
          document.getElementById(`form-${target}`).classList.remove('invalid');
          document.getElementById(`form-${target}`).removeAttribute('role');
          document.getElementById(target).setAttribute('aria-invalid', 'false');

        }
        else if(res == 'false'){

          //se torna false non è valida
          document.getElementById(target).setCustomValidity('Invalid password');
          document.getElementById(`form-${target}`).classList.add('invalid');
          document.getElementById(`form-${target}`).setAttribute('role', 'alert');
          document.getElementById(target).setAttribute('aria-invalid', 'true');

        }
        else{
          //per altri tipi di errori window alert
          window.alert(res);
          document.getElementById(target).setCustomValidity('Invalid password');
          document.getElementById(`form-${target}`).classList.add('invalid');
          document.getElementById(`form-${target}`).setAttribute('role', 'alert');
          document.getElementById(target).setAttribute('aria-invalid', 'true');

        }
      }
    })
}

//inserimento del commento, con caricamento dei commenti + il nuovo in caso di successo
function ins_commento(ida){
  //prendo il commento e dichiaro l'azione per l'api
  var commento = document.getElementById("commento").value;
  var action = 'INS_COMMENTO';
  //ajax request
  $.ajax({
    method:"post",
    url:"../api/api.php",
    data: {ida, action, commento},
    success: function(res, status){
      //parse dell'array di risposta
      res = JSON.parse(res);
      if(JSON.stringify(res) == 'false'){
        //se l'api ritorna false messaggio d'errore
        window.alert("Non puoi inserire più di tre commenti per annuncio");

      }
      else{

        //altrimenti costruisco la lista di commenti
        var commlist = "<ul class='media-list'>";

        for(i = 0; i < res.length; i++){

          var cont = res[i];

          if(cont[3] == 'empty'){

            var img = '../img/meme.jpg';

           }
           else{
             var img = cont[3];
           }
          console.log(img);

          commlist += "<li class='media'>";
          commlist += "<a href='../frontend/profile.php?candidato=";
          commlist += cont[2];
          commlist += "' class='pull-left'>";
          commlist += "<img class = 'img-fluid rounded-circle comment-img' src=\'"+img+"\'";
          commlist += "class='img-circle img-fluid rounded-circle mr-1'>";
          commlist += "</a>";
          commlist += "<div class='media-body ml-2'>";
          commlist += "<span class='text-muted pull-right'>";
          commlist += "<small class='text-muted'>"+ cont[4] +"</small>";
          commlist += "</span><strong class='text-success'><a href='profile.php?candidato=" + cont[2] + "'>" + cont[0] + " " + cont[1] + "</a></strong>";
          commlist += "<p>" + cont[5] + "</p></div></li>";

        }

        commlist += "</ul>";
        //e la carico nell'elemento del DOM che ha id "commenti"
        $('#commenti').html(commlist);
      }
    }
  });
}

//reset delle notifiche on click sul link in navbar (Notifiche)
$(function(){
  $('.notif').click(function(e){
    //blocco il redirect
    e.preventDefault();
    //definisco action per l'api
    var action = 'RESET_NOTIFICHE';
    var link = this.href;
    //ajax request
    $.ajax({
      method:"post",
      url:"../api/api.php",
      data:{action},
      success:function(res, status){

        if(res == 'true'){
            //se va tutto bene redirect
            location.href = link;

        }
        else {
          //altrimenti prompta l'errore
          window.alert(res);
        }

      }
    })
  })
})
//gestione della visibilita degli annunci
$(function(){
  $(document).ready(function(e){
    //prima di "caricare" ogni pagina
    var action = 'CHECK_VIS';
    $.ajax({
      method:"post",
      url:"../api/api.php",
      data: {action},
      success: function(res, status){

        console.log(res+" "+status);
        if(res !== 'true'){
          window.alert(res);
        }
      }
    })
  })
})
//original = window.alert;
//Ripsosta ad un annuncio con un curriculum
$(function(){
  $('#sel-curriculum').change(function(e){
    //prendo l'id del curriculum
    //l'id dell'annuncio dall'url
    //costruisco il link per l'eventuale redirect
    var idc = $('#sel-curriculum').val();
    var url = $(location).attr('href');
    var ida = url.substring( url.lastIndexOf('=') + 1 );
    var redir = 'ins_curriculum.php?id=' + ida;
    var count = $('#count_candidature').text();
    console.log(idc);
    console.log(ida);
    console.log(count);

    //se ho un curriculum selezionato faccio prevent default sul link
    //unbind per evitare la doppia chiamata
    $('#resp').unbind('click');
    if(idc !== ''){
        //window.alert = original;
        $(function(){
            $('#resp').click(function(f){
              f.preventDefault();
              var action = 'RISPONDI';
              console.log(idc + action);
              //ajax request per risposta
              $.ajax({
                method:"post",
                url:"../api/api.php",
                data:{idc, ida, action},
                success:function(res, status){

                  console.log(res + " " + status);

                  window.alert(res);
                  //messaggio di successo
                  if(res.includes("Hai risposto con successo all'annuncio!")){

                    var number = parseInt(res.charAt(res.lastIndexOf('(') + 1));

                    console.log(number);
                    if(number == 1){
                      count = " candidatura a questo annuncio";
                    }
                    else{
                      count = " candidature a questo annuncio";
                    }
                    //cambio eventualmente il numero di candidature in display sull'annuncio
                    count = number + count;
                    $('#count_candidature').text(count);
                  }

                }
              });
            });
        })

    }
    else{
      //window.alert = function(){};
      //se non ho selezionato curriculum rimando alla pagina di inserimento di un nuovo curriculum
      $(function(){
        $('#resp').click(function(z){
            location.href = redir;
        })

      })
    }
    return false;
  })
})

//jquery per la finestra di dialogo che chiede conferma alla cancellazione
$(function() {
  $('.confirm').click(function(e) {
      e.preventDefault();
      if (window.confirm("Sicuro di voler cancellare?")) {
          location.href = this.href;
      }
  });
});
//jquery per la conferma del logout
$(function(){
  $('#logout').click(function(e){
    e.preventDefault();
    if(window.confirm("Sicuro di voler vare Logout?")){
      location.href = this.href;
    }
  });
});

//filtri per la pagina di scorrimento degli annunci
function filter_annunci(){
  //estrazione filtri
  var cityCheckBox = document.getElementsByClassName("city_filter");
  var timeCheckBox = document.getElementsByClassName("time_filter");
  var sectorCheckBox = document.getElementsByClassName("sector_filter");
  var contractCheckBox = document.getElementsByClassName("contract_filter");
  var searchbar = $('#searchbar').val();
  var orderbydate = $('#orderbydate').val();

  //estrazione lunghezze per formare l'array di variabili pulito
  var cityCount = cityCheckBox.length;
  var timeCount = timeCheckBox.length;
  var sectorCount = sectorCheckBox.length;
  var contractCount = contractCheckBox.length;
  //istanzio stack vuoti da riempire
  var city = [];
  var times = [];
  var sectors = [];
  var contracts = [];
  //push nello stack, o rimozione dalla struttura se il checkbox viene annullato
  for (i=0; i<cityCount; i++) {
    if ( cityCheckBox[i].checked === true) {
      city.push(cityCheckBox[i].value);
    }
    if ( city.includes(cityCheckBox[i].value) && cityCheckBox[i].checked === false) {
      city.splice( city.indexOf(cityCheckBox[i].value), 1 );
    }
  }


  //push nello stack, o rimozione dalla struttura se il checkbox viene annullato
  for (i=0; i<timeCount; i++) {
    if ( timeCheckBox[i].checked === true) {
      times.push(timeCheckBox[i].value) ;
    }
    if ( times.includes(timeCheckBox[i].value) && timeCheckBox[i].checked === false) {
      times.splice( times.indexOf(timeCheckBox[i].value), 1 );
    }
  }


  //push nello stack, o rimozione dalla struttura se il checkbox viene annullato
  for (i=0; i<sectorCount; i++) {
    if ( sectorCheckBox[i].checked === true) {
      sectors.push(sectorCheckBox[i].value) ;
    }
    if ( sectors.includes(sectorCheckBox[i].value) && sectorCheckBox[i].checked === false) {
      sectors.splice( sectors.indexOf(sectorCheckBox[i].value), 1 );
    }

  }


  //push nello stack, o rimozione dalla struttura se il checkbox viene annullato
  for (i=0; i<contractCount; i++) {
    if ( contractCheckBox[i].checked === true) {
      contracts.push(contractCheckBox[i].value) ;
    }
    if ( contracts.includes(contractCheckBox[i].value) && contractCheckBox[i].checked === false) {
      contracts.splice( contracts.indexOf(contractCheckBox[i].value), 1 );
    }
  }


  //feedback per debug
  console.log(city);
  console.log(times);
  console.log(sectors);
  console.log(contracts);
  console.log(searchbar);
  //ajax call
  $.ajax ({
    method: "post",
    url: "../api/api_annunci.php",
    data: { orderbydate, searchbar, city : JSON.stringify(city), times : JSON.stringify(times), sectors : JSON.stringify(sectors), contracts : JSON.stringify(contracts)},
    success: function(res, status) {
    //  console.log(res);
    //sostituisco il contenuto nel DOM
      $("#annunci").html(res);
    }
  });

}

//filtri per la pagina di scorrimento dei candidati
function filter_candidati()
{
  //estrazione filtri
  var cityCheckBox = document.getElementsByClassName("city_filter");
  var sectorCheckBox = document.getElementsByClassName("sector_filter");
  var languageCheckBox = document.getElementsByClassName("language_filter");
  var studyCheckBox = document.getElementsByClassName("study_filter");
  var searchbar = $('#searchbar').val();

  var cityCount = cityCheckBox.length;
  var sectorCount = sectorCheckBox.length;
  var languageCount = languageCheckBox.length;
  var studyCount = studyCheckBox.length;
  //setup stack
  var city = [];
  var sectors = [];
  var languages = [];
  var studies = [];
  //push nello stack, o rimozione dalla struttura se il checkbox viene annullato
  for (i=0; i<cityCount; i++) {
    if ( cityCheckBox[i].checked === true) {
      city.push(cityCheckBox[i].value);
    }
    if ( city.includes(cityCheckBox[i].value) && cityCheckBox[i].checked === false) {
      city.splice( city.indexOf(cityCheckBox[i].value), 1 );
    }
  }


  //push nello stack, o rimozione dalla struttura se il checkbox viene annullato
  for (i=0; i<sectorCount; i++) {
    if ( sectorCheckBox[i].checked === true) {
      sectors.push(sectorCheckBox[i].value) ;
    }
    if ( sectors.includes(sectorCheckBox[i].value) && sectorCheckBox[i].checked === false) {
      sectors.splice( sectors.indexOf(sectorCheckBox[i].value), 1 );
    }
  }


  //push nello stack, o rimozione dalla struttura se il checkbox viene annullato
  for (i=0; i<languageCount; i++) {
    if ( languageCheckBox[i].checked === true) {
      languages.push(languageCheckBox[i].value) ;
    }
    if ( languages.includes(languageCheckBox[i].value) && languageCheckBox[i].checked === false) {
      languages.splice( languages.indexOf(languageCheckBox[i].value), 1 );
    }
  }


  //push nello stack, o rimozione dalla struttura se il checkbox viene annullato
  for (i=0; i<studyCount; i++) {
    if ( studyCheckBox[i].checked === true) {
      studies.push(studyCheckBox[i].value) ;
    }
    if ( studies.includes(studyCheckBox[i].value) && studyCheckBox[i].checked === false) {
      studies.splice( studies.indexOf(studyCheckBox[i].value), 1 );
    }
  }
  //feedback per debug
  console.log(city);
  console.log(sectors);
  console.log(languages);
  console.log(studies);
  //ajax call
  $.ajax ({
    method: "post",
    url: "../api/api_candidati.php",
    data: { searchbar, city : JSON.stringify(city), languages : JSON.stringify(languages), sectors : JSON.stringify(sectors), studies : JSON.stringify(studies)},
    success: function(res, status) {
      console.log(res);
      //sostituisco il contenuto nel DOM
      $("#candidati").html(res);
    }
  });

}
//gestione filtri per la pagina aziende
function filter_aziende()
{
  //estrazione filtri
  var cityCheckBox = document.getElementsByClassName("city_filter");
  var sectorCheckBox = document.getElementsByClassName("sector_filter");
  var contractCheckBox = document.getElementsByClassName("contract_filter");
  var searchbar = $('#searchbar').val();

  var cityCount = cityCheckBox.length;
  var sectorCount = sectorCheckBox.length;
  var contractCount = contractCheckBox.length;
  //setup stack
  var city = [];
  var sectors = [];
  var contracts = [];
  //push nello stack, o rimozione dalla struttura se il checkbox viene annullato
  for (i=0; i<cityCount; i++) {
    if ( cityCheckBox[i].checked === true) {
      city.push(cityCheckBox[i].value);
    }
    if ( city.includes(cityCheckBox[i].value) && cityCheckBox[i].checked === false) {
      city.splice( city.indexOf(cityCheckBox[i].value), 1 );
    }
  }


  //push nello stack, o rimozione dalla struttura se il checkbox viene annullato
  for (i=0; i<sectorCount; i++) {
    if ( sectorCheckBox[i].checked === true) {
      sectors.push(sectorCheckBox[i].value) ;
    }
    if ( sectors.includes(sectorCheckBox[i].value) && sectorCheckBox[i].checked === false) {
      sectors.splice( sectors.indexOf(sectorCheckBox[i].value), 1 );
    }

  }


  //push nello stack, o rimozione dalla struttura se il checkbox viene annullato
  for (i=0; i<contractCount; i++) {
    if ( contractCheckBox[i].checked === true) {
      contracts.push(contractCheckBox[i].value) ;
    }
    if ( contracts.includes(contractCheckBox[i].value) && contractCheckBox[i].checked === false) {
      contracts.splice( contracts.indexOf(contractCheckBox[i].value), 1 );
    }
  }


  //feedback per debug
  console.log(city);
  console.log(sectors);
  console.log(contracts);

  $.ajax ({
    method: "post",
    url: "../api/api_aziende.php",
    data: { searchbar, city : JSON.stringify(city), sectors : JSON.stringify(sectors), contracts : JSON.stringify(contracts)},
    success: function(res, status) {
      console.log(res);
      //sostituisco il contenuto nel DOM
      $("#aziende").html(res);
    }
  });

}

//gestione filtri per la pagina candidature delle aziende
function filter_candidature_azienda()
{
  //estrazione filtri
  var candidateCheckBox = document.getElementsByClassName("candidato_filter");
  var adCheckBox = document.getElementsByClassName("annuncio_filter");
  var searchbar = $('#searchbar').val();

  var candidateCount = candidateCheckBox.length;
  var adCount = adCheckBox.length;
  //setup stack
  var candidates = [];
  var ads = [];

//push nello stack, o rimozione dalla struttura se il checkbox viene annullato
  for (i=0; i<candidateCount; i++) {
    if ( candidateCheckBox[i].checked === true) {
      candidates.push(candidateCheckBox[i].value);
    }
    if ( candidates.includes(candidateCheckBox[i].value) && candidateCheckBox[i].checked === false) {
      candidates.splice( candidates.indexOf(candidateCheckBox[i].value), 1 );
    }
  }
//push nello stack, o rimozione dalla struttura se il checkbox viene annullato
  for (i=0; i<adCount; i++) {
    if ( adCheckBox[i].checked === true) {
      ads.push(adCheckBox[i].value) ;
    }
    if ( ads.includes(adCheckBox[i].value) && adCheckBox[i].checked === false) {
      ads.splice( ads.indexOf(adCheckBox[i].value), 1 );
    }

  }
  //feedback per debug
  console.log(candidates);
  console.log(ads);
  //ajax call
  $.ajax ({
    method: "post",
    url: "../api/api_candidature_aziende.php",
    data: { searchbar, candidates : JSON.stringify(candidates), ads : JSON.stringify(ads)},
    success: function(res, status) {
      console.log(res);
      //sostituisco il contenuto nel DOM
      $("#tabella_candidature_azienda").html(res);
    }
  });

}


//gestione filtri per la pagina candidature del candidato
function filter_candidature_candidato()
{
  //estrazione filtri
  var companyCheckBox = document.getElementsByClassName("azienda_filter");
  var adCheckBox = document.getElementsByClassName("annuncio_filter");
  var resultCheckBox = document.getElementsByClassName("esito_filter");
  var searchbar = $('#searchbar').val();

  var companyCount = companyCheckBox.length;
  var adCount = adCheckBox.length;
  var resultCount = resultCheckBox.length;
  //setup stack
  var companies = [];
  var ads = [];
  var results = [];

//push nello stack, o rimozione dalla struttura se il checkbox viene annullato
  for (i=0; i<companyCount; i++) {
    if ( companyCheckBox[i].checked === true) {
      companies.push(companyCheckBox[i].value);
    }
    if ( companies.includes(companyCheckBox[i].value) && companyCheckBox[i].checked === false) {
      companies.splice( companies.indexOf(companyCheckBox[i].value), 1 );
    }
  }
//push nello stack, o rimozione dalla struttura se il checkbox viene annullato
  for (i=0; i<adCount; i++) {
    if ( adCheckBox[i].checked === true) {
      ads.push(adCheckBox[i].value) ;
    }
    if ( ads.includes(adCheckBox[i].value) && adCheckBox[i].checked === false) {
      ads.splice( ads.indexOf(adCheckBox[i].value), 1 );
    }
  }
//push nello stack, o rimozione dalla struttura se il checkbox viene annullato
  for (i=0; i<resultCount; i++) {
    if ( resultCheckBox[i].checked === true) {
      results.push(resultCheckBox[i].value) ;
    }
    if ( results.includes(resultCheckBox[i].value) && resultCheckBox[i].checked === false) {
      results.splice( results.indexOf(resultCheckBox[i].value), 1 );
    }
  }
  //feedback per debug
  console.log(companies);
  console.log(ads);
  console.log(results);
  //ajax call
  $.ajax ({
    method: "post",
    url: "../api/api_candidature_candidato.php",
    data: { searchbar, companies : JSON.stringify(companies), ads : JSON.stringify(ads), results : JSON.stringify(results)},
    success: function(res, status) {
      console.log(res);
      //sostituisco il contenuto nel DOM
      $("#tabella_candidature_candidato").html(res);
    }
  });

}

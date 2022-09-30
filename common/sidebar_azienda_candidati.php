<div class="col-12 col-md-3 bd-sidebar"  style = "margin-bottom:3%">
  <div class="bd-search d-flex align-items-center">
      <!-- Search -->
      <input type="search" class="form-control ds-input w-100" style="margin-bottom: 1rem" id="searchbar" oninput="filter_candidati()" placeholder="Cerca..." aria-label="Search for..." autocomplete="off" spellcheck="false" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-owns="algolia-autocomplete-listbox-0" dir="auto" style="position: relative; vertical-align: top;">

    <button class="btn btn-link bd-search-docs-toggle d-lg-none p-0 ml-3" type="button" data-toggle="collapse" data-target="#bd-docs-nav" aria-controls="bd-docs-nav" aria-expanded="false" aria-label="Toggle docs navigation" style="margin-bottom: 1rem;">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30" focusable="true">
        <title>Menu</title>
          <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"></path>
      </svg>
    </button>

  </div>

  <div class="collapse navbar-collapse show" id="bd-docs-nav">

    <nav class="bd-links bg-dark h-100 rounded">

        <div class="list-group-item list-group-item-action sidebar-separator-title d-flex align-items-center menu-collapsed bg-dark">
          <small class="text-white align-items-center" style="font-family: fontFigo;">FILTRI</small>
        </div>

          <div class="bd-toc-item">

        <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="bg-secondary list-group-item list-group-item-action flex-column align-items-start text-light font-weight-normal">
            <div class="w-100">
              <span class="menu-collapsed">Area geografica</span>
              <i class="fa fa-map-marker" aria-hidden="true" style="padding-left: 0.5rem"></i>
          </div>

        </a>

        <!-- Cities -->
        <div id="submenu1" class="collapse sidebar-submenu w-100 justify-content-start">
            <a href="#" class="list-group-item list-group-item-action bg-secondary text-light font-weight-normal flex-column">
              <span class="menu-collapsed">

                <?php

                              //Vengono caricate dal DB

                              $citta = array();
                              $citta = load_cit($cid);

                              foreach($citta as $value)
                              {

                                echo "$value  <input type='checkbox' class='city_filter' value='$value' onclick='filter_candidati()'> <br>";

                              }

                 ?>

              </span>
            </a>
        </div>


      </div class="bd-toc-item">

      <div class="bd-toc-item">

        <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-secondary list-group-item list-group-item-action flex-column align-items-start text-light font-weight-normal">
            <div class="w-100">
                <span class="menu-collapsed">Settore lavorativo</span>
                <i class="fa fa-industry" aria-hidden="true" style="padding-left: 0.5rem"></i>
            </div>
        </a>

        <!-- Sectors -->
        <div id="submenu2" class="collapse sidebar-submenu w-100 justify-content-start align-items-center">
            <a href="#" class="list-group-item list-group-item-action bg-secondary text-light font-weight-normal flex-column">
              <span class="menu-collapsed">

                <?php
                  //Vengono caricati dal DB
                  $sql2 = "SELECT settoreLavorativo.tiposettore FROM settoreLavorativo";
                  $res = $cid->query($sql2);

                  while($row=$res->fetch_row())
                  {
                    echo "$row[0]  <input type='checkbox' class='sector_filter' value='$row[0]' onclick='filter_candidati()'> <br>";
                  }

                ?>

              </span>
            </a>
        </div>

        </div class="bd-toc-item">

        <div class="bd-toc-item">

          <a href="#submenu3" data-toggle="collapse" aria-expanded="false" class="bg-secondary list-group-item list-group-item-action flex-column align-items-start text-light font-weight-normal">
              <div class="w-100">
                  <span class="menu-collapsed">Lingue conosciute</span>
                  <i class="fa fa-language" aria-hidden="true" style="padding-left: 0.5rem"></i>
              </div>
          </a>

          <!-- Langs -->
          <div id="submenu3" class="collapse sidebar-submenu w-100 justify-content-start align-items-center">
              <a href="#" class="list-group-item list-group-item-action bg-secondary text-light font-weight-normal flex-column">
                <span class="menu-collapsed">

                  <?php
                    //non vengono attualmente caricati dal DB perchè presenti in numero esiguo rispetto ad un'eventuale richiesta
                    $lingue = array('Inglese','Francese','Spagnolo','Portoghese','Tedesco','Arabo','Cinese',
                    'Afar','Afrikaans','Albanese','Amarico','Assamese','Armeno','Aymara','Azero','Baschiro','Basco','Birmano','Bielorusso','Bulgaro','Bihari','Bengali/Bengalese','Bretone','Catalano','Ceco','Croato','Danese','Dzongkha','Ebraico','Esperanto','Estone','Filippino',
                    'Finlandese','Gallese','Giapponese','Giavanese','Georgiano','Greco','Groenlandese','Guarani','Gujarati','Hausa','Hindi','Kashmiri','Kazako','Kannada', 'Khmer','Kinyarwanda','Kirghiso','Kirundi','Koreano','Kurdo','Indonesiano','Inuit','Irlandese','Islandese',
                    'Latino','Lettone','Lituano','Macedone','Malgascio','Māori','Malayalam','Malese','Maltese','Mongolo','Moldavo','Marathi','Nepalese','Norvegese','Olandese','Persiano','Punjabi','Polacco','Pashtu','Romancio','Romeno','Russo','Sanscrito','Scozzese','Sindhi',
                    'Sango','Serbo','Serbo-Croato','Singalese','Slovacco','Sloveno','Samoano','Shona','Somalo','Sotho','Sundanese','Svedese','Swahili','Tamil','Telugu','Tagico','Thailandese','Tibetano', 'Tigrino','Turkmeno','Tongano','Turco','Ucraino','Ungherese','Uzbeko',
                    'Vietnamita','Yiddish');


                      foreach ($lingue as $value) {
                        echo $value." <input type='checkbox' class='language_filter' value='$value' onclick='filter_candidati()'> <br>";
                      }
                   ?>

                </span>
              </a>
          </div>
        </div class="bd-toc-item">

        <div class="bd-toc-item">

          <a href="#submenu4" data-toggle="collapse" aria-expanded="false" class="bg-secondary list-group-item list-group-item-action flex-column align-items-start text-light font-weight-normal">
              <div class="w-100">
                  <span class="menu-collapsed">Titolo di studio</span>
                  <i class="fa fa-graduation-cap" aria-hidden="true" style="padding-left: 0.5rem"></i>
              </div>
          </a>

          <!-- Ordine scolastico -->
          <div id="submenu4" class="collapse sidebar-submenu w-100 justify-content-start align-items-center">
              <a href="#" class="list-group-item list-group-item-action bg-secondary text-light font-weight-normal flex-column">
                <span class="menu-collapsed">

                  <?php

                  $study  = array('Scuola primaria','Istruzione secondaria di primo grado','Istruzione secondaria di secondo grado','Istruzione superiore','Alta formazione artistica, musicale e coreutica');

                    foreach ($study as $value) {
                      echo $value." <input type='checkbox' class='study_filter' name='study' value='$value' onclick='filter_candidati();'> <br>";
                    }
                   ?>

                </span>
              </a>
          </div>
        </div class="bd-toc-item">

    </nav>
  </div>
</div>

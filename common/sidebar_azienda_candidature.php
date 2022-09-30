<div class="col-12 col-md-3 bd-sidebar"  style = "margin-bottom:3%">

    <!-- Search -->
    <input type="search" class="form-control ds-input w-100" style="margin-bottom: 1rem" id="searchbar" oninput="filter_candidature_azienda()" placeholder="Cerca..." aria-label="Search for..." autocomplete="off" spellcheck="false" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-owns="algolia-autocomplete-listbox-0" dir="auto" style="position: relative; vertical-align: top;">

    <button class="btn btn-link bd-search-docs-toggle d-lg-none p-0 ml-3" type="button" data-toggle="collapse" data-target="#bd-docs-nav" aria-controls="bd-docs-nav" aria-expanded="false" aria-label="Toggle docs navigation" style="margin-bottom: 1rem;">
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 30 30" width="30" height="30" focusable="true">
        <title>Menu</title>
          <path stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-miterlimit="10" d="M4 7h22M4 15h22M4 23h22"></path>
      </svg>
    </button>


  <div class="collapse navbar-collapse show" id="bd-docs-nav">

    <nav class="bd-links bg-dark h-100 rounded">

        <div class="list-group-item list-group-item-action sidebar-separator-title d-flex align-items-center menu-collapsed bg-dark">
          <small class="text-white align-items-center" style="font-family: fontFigo;">FILTRI</small>
        </div>

          <div class="bd-toc-item">

        <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="bg-secondary list-group-item list-group-item-action flex-column align-items-start text-light font-weight-normal">
            <div class="w-100">
                <span class="menu-collapsed">Candidato</span>
                <i class="fas fa-user-alt" aria-hidden="true" style="padding-left: 0.5rem"></i>
            </div>
        </a>

        <!-- Candidati -->
        <div id="submenu1" class="collapse sidebar-submenu w-100 justify-content-start">
            <a href="#" class="list-group-item list-group-item-action bg-secondary text-light font-weight-normal flex-column">
              <span class="menu-collapsed">
                <?php if(!isset($data["msg"])){
                  //prelievo e stampa, con eliminazione dei doppioni
                  $strings = array();
                  $n = 0;
                  foreach ($data["cont"] as $value) {
                    $strings[$n] = $value[1]." ".$value[2]. ' <input class = "candidato_filter" type="checkbox" onclick= "filter_candidature_azienda()" value="'.$value[6].'"> <br>';
                    $n++;
                }
                $strings = array_unique($strings, SORT_STRING);
                foreach ($strings as $value) {
                  echo $value;
                }
              }
              else{
                echo "Nessun filtro disponibile";
              } ?>
              </span>
            </a>
        </div>


      </div class="bd-toc-item">

      <div class="bd-toc-item">

        <a href="#submenu2" data-toggle="collapse" aria-expanded="false" class="bg-secondary list-group-item list-group-item-action flex-column align-items-start text-light font-weight-normal">
            <div class="w-100">
                <span class="menu-collapsed">Annunci</span>
                <i class="fa fa-briefcase" aria-hidden="true" style="padding-left: 0.5rem"></i>
            </div>
        </a>

        <!-- Annunci -->
        <div id="submenu2" class="collapse sidebar-submenu w-100 justify-content-start align-items-center">
            <a href="#" class="list-group-item list-group-item-action bg-secondary text-light font-weight-normal flex-column">
              <span class="menu-collapsed">

                <?php //prelievo e stampa con eliminazione dei doppioni
                  if(!isset($data["msg"])){
                  $titoli=array();
                  $t = 0;
                  foreach ($data["cont"] as $value) {
                      $titoli[$t] = $value[0]. " <input class = 'annuncio_filter' type='checkbox' name='time_filter' onclick = 'filter_candidature_azienda()' value='$value[4]'> <br>";
                      $t++;
                }
                $titoli = array_unique($titoli, SORT_STRING);
                foreach ($titoli as $value) {
                  echo $value;
                }
              }
              else{
                echo "Nessun filtro disponibile";
              }  ?>

              </span>
            </a>
        </div>

        </div class="bd-toc-item">


    </nav>
  </div>
</div>

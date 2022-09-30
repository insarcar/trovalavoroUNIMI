<!-- Order by -->
<div class="col-12 col-md-3 bd-sidebar"  style = "margin-bottom:3%">
  <small class = "badge badge-primary">Ordina per data di pubblicazione</small>
  <select class="form-control" id = "orderbydate" name="orderby" onchange = "filter_annunci()">
    <option value="">Seleziona Ordine</option>
    <option value="DESC">Dal più recente</option>
    <option value="ASC">Dal più datato</option>
  </select>
  <div class="bd-search d-flex align-items-center">
      <!-- Searchbar -->
      <input type="search" class="form-control ds-input w-100" style="margin-bottom: 1rem" id="searchbar" onkeyup="filter_annunci()" placeholder="Cerca..." aria-label="Search for..." autocomplete="off" spellcheck="false" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-owns="algolia-autocomplete-listbox-0" dir="auto" style="position: relative; vertical-align: top;">

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

      <a href="#submenu4" data-toggle="collapse" aria-expanded="false" class="bg-secondary list-group-item list-group-item-action flex-column align-items-start text-light font-weight-normal">
          <div class="w-100">
              <span class="menu-collapsed">Area geografica</span>
              <i class="fa fa-map-marker" aria-hidden="true" style="padding-left: 0.5rem"></i>
          </div>
      </a>

      <!-- Cities -->
      <div id="submenu4" class="collapse sidebar-submenu w-100 justify-content-start">
          <a href="#" class="list-group-item list-group-item-action bg-secondary text-light font-weight-normal flex-column">
            <span class="menu-collapsed">


              <?php

                            //prelievo dal DB

                            $citta = array();
                            $citta = load_cit($cid);

                            foreach($citta as $value)
                            {

                              echo "$value  <input type='checkbox' class='city_filter' value='$value' onclick='filter_annunci()'> <br>";

                            }

               ?>




            </span>
          </a>
      </div>
    </div class="bd-toc-item">

    <div class="bd-toc-item">

        <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="bg-secondary list-group-item list-group-item-action flex-column align-items-start text-light font-weight-normal">
            <div class="w-100">
                <span class="menu-collapsed">Data di pubblicazione</span>
                <i class="fa fa-calendar" aria-hidden="true" style="padding-left: 0.5rem"></i>
            </div>
        </a>

        <!-- Data pubblicazione -->
        <div id="submenu1" class="collapse sidebar-submenu w-100 justify-content-start">
            <a href="#" class="list-group-item list-group-item-action bg-secondary text-light font-weight-normal flex-column">
              <span class="menu-collapsed">
                Un giorno <input type="checkbox" class="time_filter" value="1" onclick='filter_annunci()'><br>
                Una settimana <input type="checkbox" class="time_filter" value="7" onclick='filter_annunci()'><br>
                Un mese <input type="checkbox" class="time_filter" value="31" onclick='filter_annunci()'><br>
                Tre mesi <input type="checkbox" class="time_filter" value="90" onclick='filter_annunci()'><br>
                Sei mesi <input type="checkbox" class="time_filter" value="180" onclick='filter_annunci()'><br>
                Un anno <input type="checkbox" class="time_filter" value="365" onclick='filter_annunci()'>
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

        <!-- Settore lavorativo -->
        <div id="submenu2" class="collapse sidebar-submenu w-100 justify-content-start align-items-center">
            <a href="#" class="list-group-item list-group-item-action bg-secondary text-light font-weight-normal flex-column">
              <span class="menu-collapsed">

                <?php
                //prelievo dal DB
                $sett = "SELECT * FROM settoreLavorativo";
                $res = $cid -> query($sett);

                while($row=$res->fetch_row())
                {
                  echo "$row[0]  <input type='checkbox' class='sector_filter' value='$row[0]' onclick='filter_annunci()'> <br>";
                }
                 ?>

              </span>
            </a>
        </div>

        </div class="bd-toc-item">

        <div class="bd-toc-item">

          <a href="#submenu3" data-toggle="collapse" aria-expanded="false" class="bg-secondary list-group-item list-group-item-action flex-column align-items-start text-light font-weight-normal">
              <div class="w-100">
                  <span class="menu-collapsed">Tipologia di contratto</span>
                  <i class="fa fa-file" aria-hidden="true" style="padding-left: 0.5rem"></i>
              </div>
          </a>

          <!-- Tipologia di contratto -->
          <div id="submenu3" class="collapse sidebar-submenu w-100 justify-content-start align-items-center">
              <a href="#" class="list-group-item list-group-item-action bg-secondary text-light font-weight-normal flex-column">
                <span class="menu-collapsed">

                  Contratto a tempo indeterminato: <input type="checkbox" class="contract_filter" value="Contratto a tempo indeterminato" onclick='filter_annunci()'><br>
                  Contratto a tempo determinato: <input type="checkbox" class="contract_filter" value="Contratto a tempo determinato" onclick='filter_annunci()'><br>
                  Contratto a chiamata: <input type="checkbox" class="contract_filter" value="Contratto a chiamata" onclick='filter_annunci()'>

                </span>
              </a>
          </div>
        </div class="bd-toc-item">


    </nav>
  </div>
</div>

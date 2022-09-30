<div class="col-12 col-md-3 bd-sidebar"  style = "margin-bottom:3%">
  <div class="bd-search d-flex align-items-center">
      <!-- searchbar -->
      <input type="search" class="form-control ds-input w-100" style="margin-bottom: 1rem" id="searchbar" oninput="filter_aziende()" placeholder="Cerca..." aria-label="Search for..." autocomplete="off" spellcheck="false" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-owns="algolia-autocomplete-listbox-0" dir="auto" style="position: relative; vertical-align: top;">

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

                      //prelievo dal DB

                        $citta = array();
                        $citta = load_cit($cid);

                        foreach($citta as $value)
                        {

                          echo "$value  <input type='checkbox' class='city_filter' value='$value' onclick='filter_aziende()'> <br>";

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

        <!-- Settore lavorativo -->
        <div id="submenu2" class="collapse sidebar-submenu w-100 justify-content-start align-items-center">
            <a href="#" class="list-group-item list-group-item-action bg-secondary text-light font-weight-normal flex-column">
              <span class="menu-collapsed">

            <?php
              //prelievo dal DB
              $sql2 = "SELECT settoreLavorativo.tiposettore FROM settoreLavorativo";
              $res = $cid->query($sql2);

              while($row=$res->fetch_row())
              {
                echo "$row[0] <input type='checkbox' class='sector_filter' value='$row[0]' onclick='filter_aziende()'> <br>";
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

                  Contratto a tempo indeterminato: <input type="checkbox" class="contract_filter" onclick='filter_aziende()' value="Contratto a tempo indeterminato"><br>
                  Contratto a tempo determinato: <input type="checkbox" class="contract_filter" onclick='filter_aziende()' value="Contratto a tempo determinato"><br>
                  Contratto a chiamata: <input type="checkbox" class="contract_filter" onclick='filter_aziende()' value="Contratto a chiamata">

                </span>
              </a>
          </div>
        </div class="bd-toc-item">

    </nav>
  </div>
</div>

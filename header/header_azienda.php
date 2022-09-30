<header>
  <nav class="stroke navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">



      <a class="navbar-brand" href="home.php">
        <h2 class="navbar-logo">TrovaLavoroUNIMI</h2>
      </a>

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarResponsive">

        <ul class="navbar-nav ml-auto">

          <li class="nav-item active">
            <a class="nav-link" href="candidature_azienda.php">Notifiche
              <i class="fa fa-bell-o" aria-hidden="true"></i>
            </a>
          </li>

          <li class="nav-item active">
            <a class="nav-link" href="../frontend/candidati.php">Candidati
              <i class="fa fa-users" aria-hidden="true"></i>
            </a>
          </li>

          <li class="nav-item active">
            <a class="nav-link" href="profile.php?azienda=<?php echo $_SESSION["azienda"] ?>">Profilo
              <i class="fa fa-building-o" aria-hidden="true"></i>
            </a>
          </li>


          <li class="nav-item active">
            <a class="nav-link" id = "logout" href="../backend/logout.php">Logout
              <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
            </a>
          </li>


        </ul>
      </div>
    </div>
  </nav>
</header>

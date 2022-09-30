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

            <?php
              //conteggio notifiche
             include("../common/setup.php");
             $notifica = notifiche($cid);
             mysqli_close($cid);
             ?>
            <a class="nav-link notif" href="candidature_candidato.php">Notifiche<?php /*GESTIONE DELLE NOTIFICHE PER IL CANDIDATO*/if($notifica > 0) echo "<div class='badge badge-danger'> $notifica</div>"?>
              <i class="fa fa-bell-o" aria-hidden="true"></i>
            </a>
          </li>

          <li class="nav-item active">
            <a class="nav-link" href="aziende.php">Aziende
              <i class="fa fa-building-o" aria-hidden="true"></i>
            </a>
          </li>

          <li class="nav-item active">
            <a class="nav-link" href="annunci.php">Annunci
              <i class="fa fa-briefcase" aria-hidden="true"></i>
            </a>
          </li>

          <li class="nav-item active">
            <a class="nav-link" href="profile.php?candidato=<?php echo $_SESSION["candidato"] ?>">Profilo
              <i class="fa fa-user" aria-hidden="true"></i>
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

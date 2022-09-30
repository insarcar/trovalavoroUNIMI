<?php session_start();
      //setup e permessi
      include("../common/functions.php");
      if(isset($_GET["user"])){
        $user = $_GET["user"];
        //in caso qualcuno compili l'URL sapendo la struttura che ci sta dietro
        if(isset($_SESSION['azienda']) && $user !== $_SESSION['azienda'] || !isset($_SESSION['azienda'])){
          $error = "Uè brighella!";
          header("Location: ../frontend/home.php?error=".$error);
        }
      }
      elseif(isset($_GET["profile"])){
        if(isset($_SESSION['azienda'])){

          $error = "Non hai il permesso di visualizzare questa pagina!";
          header("Location: ../frontend/home.php?error=".$error);

        }
        $user = $_GET["profile"];
      }
      if(empty($user) || !isset($user)){

        $error = "C'è stato un errore nel redirect";
        header("Location: ../frontend/home.php?error=".$error);

      }
        //prelievo dei dati
        $data = array();
        include("../common/setup.php");
        $data = load_profile($user, "azienda", $cid);
        mysqli_close($cid);
       ?>
  <head>

    <?php include("../common/head.php"); ?>
    <title><?php echo $data["nome"] ?></title>
    <style media="screen">
    .listing{
       box-shadow: 1px 1px 1px 1px #c7c7c7;
    }
    .btn{
      margin-bottom: 3%;
    }

    .img-fluid{
      box-shadow: 1px 1px 1px 1px #c7c7c7;
    }
    .emp-profile{
      box-shadow: 2px 2px 2px 2px;
    }
    @media (min-width:992px){
      #bd-docs-nav{
        display:block!important;

      }
    }


    </style>
  </head>
  <body>
    <?php include("../header/header.php") ?>

    <div class=<?php if(isset($_GET["user"])){
      echo "container-fluid";
    }
    elseif(isset($_GET["profile"])){
      echo "container";
    }
    ?>>


      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="home.php">Home</a>
        </li>
        <li class="breadcrumb-item active"><?php echo $data["nome"] ?></li>
      </ol>


      <div class="row">
        <?php if (isset($_GET["user"])) {
            include("../common/sidebar_azienda_profilo.php");
        }?>

        <div class="col mt-0 mr-3 emp-profile">

          <?php if(isset($_GET["msg"])){
                echo "<h4 class= 'alert alert-success'>". $_GET["msg"]."</h4>";
          } ?>

          <div class="text-center">
              <img class="img-fluid rounded profile-cover" <?php if(!empty($data["foto"])){ echo "src= \"{$data['foto']}\"";}else{echo "src = \"https://picsum.photos/id/1021/980/360\"";} ?>  alt=""/>
          </div>
          <hr>


                    <div class="row">
                        <div class="col-md-4">
                            <div class="text-center">
                                <img class="img-fluid rounded-circle profile-img" <?php if(!empty($data["logo"])){ echo "src= \"{$data['logo']}\"";} else{ echo "src = \"https://picsum.photos/id/870/150/150?grayscale&blur=1\"";} ?> alt=""/>
                            </div>
                        </div>
                        <div class="col-md mt-2 mt-md-0">
                            <div class="profile-head text-center text-md-left">
                                        <h5>
                                            <?php echo $data["nome"]." ".$data["rag"] ?>
                                        </h5>
                                <ul class="nav nav-tabs d-flex flex-row justify-content-center justify-content-md-start" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Descrizione</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Annunci</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                    </div>
                    <div class="row mt-4">
                        <div class="col-4">
                            <div class="profile-work">
                                <p>Informazioni di Contatto<br>
                                <?php echo $data["adr"] ?><br>
                                <?php echo $data["cit"]." ".$data["cap"] ?><br>
                                <?php echo $user ?><br>
                                <?php echo $data["tel"] ?><br>
                                <?php echo $data["piva"] ?><br>
                                </p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="tab-content profile-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                            <div class="row">
                                                <div class="col pagy">
                                                   <p><?php if(!empty($data["descr"])) {echo $data["descr"];} else {echo "Nessuna descrizione trovata";} ?></p>
                                                </div>
                                            </div>
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                    <?php //prelievo e stampa degli annunci
                                    include("../backend/load_annunci.php");
                                    include("../frontend/modals.php"); ?>



                                  </div>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>

          </div>
  </body>

    <?php include("../common/footer.php") ?>

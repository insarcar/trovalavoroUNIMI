<?php session_start();

      //pre heading
      //serve per distinguere il profilo dell'utente navigante dagli altri profili

      if(isset($_GET["candidato"])) {

          if(isset($_SESSION["candidato"]) && $_SESSION["candidato"] == $_GET["candidato"]){

              header("Location: profilo_candidato.php?user=".$_GET["candidato"]);

          }
          else header("Location: profilo_candidato.php?profile=".$_GET["candidato"]);

      }

      if(isset($_GET["azienda"])) {

        if(isset($_SESSION["azienda"]) && $_SESSION["azienda"] == $_GET["azienda"]){

            header("Location: profilo_azienda.php?user=".$_GET["azienda"]);

        }
        else  header("Location: profilo_azienda.php?profile=".$_GET["azienda"]);

      }

?>

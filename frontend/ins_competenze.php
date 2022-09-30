<?php
//setup, controllo id e permessi
session_start();
include("../common/setup.php");
include("../common/functions.php");
if($_GET["id"] != '0' && empty($_GET["id"]) || !isset($_GET["id"])){

  $error = "C'è stato un errore nel redirect";
  header("Location: ../frontend/home.php?error=".$error);

}
if(!check_proper($_GET["id"], $cid)){
  $error = "Non hai il permesso di accedere a questa pagina";
  header("Location: ../frontend/home.php?error=".$error);
}
mysqli_close($cid);
if(isset($_SESSION["azienda"])){
  $user = $_SESSION["azienda"];
}
else{
  $user = $_SESSION["candidato"];
}


 ?>

 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <title>Inserimento Competenze</title>
     <?php include("../common/head.php") ?>

     <style media="screen">
       .listing, .els{
          box-shadow: 1px 1px 1px 1px #c7c7c7;
       }
     </style>

   </head>
   <body>
     <?php include("../header/header.php") ?>
     <div class="container">

       <ol class="breadcrumb">
         <li class="breadcrumb-item">
           <a href="home.php">Home</a>
         </li>
         <li class="breadcrumb-item">
           <a href=<?php if(isset($_SESSION["candidato"])){
             echo "../frontend/curriculum.php?id=".$_GET["id"];
           }
           else{
             echo "../frontend/annuncio.php?id=".$_GET["id"];
           }  ?>><?php if(isset($_SESSION["candidato"])){
             echo "Curriculum";
           }
           else{
             echo "Annuncio";
           }  ?></a>
         </li>
         <li class="breadcrumb-item active">Inserimento Competenze</li>
       </ol>

     <?php if(isset($_GET["error"])){
     echo "<h3 class = 'alert alert-danger'>".$_GET["error"]."</h3>";
     } ?>

     <form method="post" action="../backend/inserisci_competenze.php?id=<?php echo $_GET["id"] ?>">

       <div class="row">
         <div class="col">
             <span class="d-flex badge badge-white els"><h2 class = "text-primary text-bold mt-2">Competenze</h2></span>
         </div>

       </div>
       <div class="mb-4 mt-2" id="accordion" role="tablist" aria-multiselectable="true">
         <div class="card bg-dark els">
           <div class="card-header" role="tab" id="headingOne">
             <h5 class="mb-0">
               <a class = "collapsed text-white" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="false" aria-controls="collapseOne">Esperienze lavorative</a>
             </h5>
           </div>

           <div id="collapseOne" class="collapse show" role="tabpanel" aria-labelledby="headingOne">
             <div class="card-body">
               <div class="row mt-1">

                 <div class="col">
                   <span class="u-alert" id="form-esp">Immetti un formato valido per l'esperienza (niente numeri)</span>
                   <span class="u-alert text-right" id="form-per">Immetti un valore valido per il periodo (Interi > 0)</span>
                   <div class="d-lg-flex flex-lg-row badge badge-dark">
                       <input class="form-control c-form-input" type="text" id = "esp" name="esp" placeholder="Esperienza Lavorativa" pattern = "^[^0-9]+$" oninput="isValid(this)" required/>
                       <div class="p-2 mt-2">Relativa a</div>
                       <select class="form-control mr-2" name="sett" id = "sett" required>
                         <?php
                         $sett  = array('Acquisti, logistica, magazzino' , 'Amministrazione, contabilita, segreteria' , 'Commercio al dettaglio, GDO, Retail' ,
                                 'Finanza, banche e credito' , 'Ingegneria' , 'Professioni e mestieri' , 'Settore farmaceutico' , 'Affari legali' , 'Arti grafiche, design'
                                  , 'Edilizia, immobiliare' , 'Formazione, istruzione' , 'Marketing, comunicazione' , 'Pubblica amministrazione' , 'Turismo, ristorazione'
                                  , 'Altre' , 'Attenzione al cliente' , 'Farmacia, medicina, salute' , 'Informatica, IT e telecomunicazioni'
                                  , 'Operai, produzione, qualita' , 'Risorse umane, recruiting' , 'Vendite');

                           foreach ($sett as $value) {
                             echo "<option value=$value>$value</option>";
                           }
                          ?>
                       </select>
                       <div class="p-2 mt-2"><?php if(isset($_SESSION["azienda"])){
                                                     echo "Per un periodo minimo di:";
                                                   }
                                                   else{
                                                     echo "Per un periodo di:";
                                                   } ?></div>
                       <input class="form-control mr-2 c-form-input" type="number" id = "per" name="per" placeholder="Periodo" min = "1" oninput="isValid(this)" required/>
                       <select class="form-control" name="pert" id = "pert">
                         <option value=12>Anni</option>
                         <option value=1>Mesi</option>
                         <option value=0.25>Settimane</option>

                       </select>

                   </div>

                   </div>

                 </div>
             </div>
           </div>
         </div>
         <div class="card bg-dark els">
           <div class="card-header" role="tab" id="headingTwo">
             <h5 class="mb-0">
               <a class="collapsed text-white" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">Titoli di studio
               </a>
             </h5>
           </div>
           <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo">
             <div class="card-body">
               <div class="row mt-1">

                 <div class="col">
                   <span class="u-alert" id="form-tit">Immetti un formato valido per il titolo (niente numeri)</span>
                   <span class="u-alert text-right" id="form-vot">Immetti un formato valido per il voto (Max 3 cifre seguite eventualmente da una L o un + per la lode)</span>
                   <div class="d-lg-flex flex-lg-row badge badge-dark">
                       <input class="form-control c-form-input" type="text" id = "tit" name="tit" placeholder="Titolo" pattern = "^[^0-9]+$" oninput="isValid(this)" required/>
                       <div class="p-2 mt-2">Nell'ordine</div>
                       <select class= "form-control mr-2" id = "ord" name = "ord" required/>
                               <?php
                                  $ord = array('Scuola primaria', 'Istruzione secondaria di primo grado', 'Istruzione secondaria di secondo grado', 'Istruzione superiore', 'Alta formazione artistica, musicale e coreutica');
                                  foreach ($ord as $value) {
                                    echo "<option value = '$value'>$value</option>";
                                  }
                                ?>
                      </select>
                       <div class="p-2 mt-2"><?php if(isset($_SESSION["azienda"])){
                                                     echo "Eventuale voto minimo:";
                                                   }
                                                   else{
                                                     echo "Con un voto di:";
                                                   } ?></div>
                       <input class="form-control mr-2 c-form-input" type="text" id = "vot" name="vot" placeholder="Voto" pattern="^[0-9]{1,3}([L+]?)$" oninput="isValid(this)" <?php if(isset($_SESSION["candidato"])) echo "required" ?>/>

                   </div>

                   </div>

                 </div>
             </div>
           </div>
         </div>
         <div class="card bg-dark els">
           <div class="card-header" role="tab" id="headingThree">
             <h5 class="mb-0">
               <a class="collapsed text-white" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">Lingue conosciute</a>
             </h5>
           </div>
           <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree">
             <div class="card-body">
               <div class="row mt-1">

                 <div class="col">
                   <span class="u-alert" id="form-lang">Immetti un formato valido per la lingua (niente numeri)</span>
                   <div class="d-flex badge badge-dark">
                       <input class="form-control c-form-input" type="text" id = "lang" name="lang" placeholder="Lingua" pattern = "^[^0-9]+$" oninput="isValid(this)" required/>
                       <div class="p-2 mt-2"><?php if(isset($_SESSION["azienda"])){
                                                     echo "Eventuale livello minimo:";
                                                   }
                                                   else{
                                                     echo "Livello:";
                                                   } ?></div>
                       <select class="ml-2 form-control" name="lvl" id = "lvl" <?php if(isset($_SESSION["candidato"])) echo "required" ?>>
                         <?php if (isset($_SESSION["azienda"])) {
                              echo "<option value=''> </option>";
                         } ?>
                         <option value="Base">Base</option>
                         <option value="Medio">Medio</option>
                         <option value="Avanzato">Avanzato</option>

                       </select>

                   </div>

                   </div>

                 </div>
             </div>
           </div>
         </div>
       </div>

       <div class="row mt-2 mb-4">
         <div class="col">
           <input class="btn btn-lg btn-outline-success els" type="submit" name="Conferma" value="Conferma">

         </div>

       </div>



       </div>

     </form>

     </div>
<?php include("../common/footer.php") ?>
   </body>
 </html>

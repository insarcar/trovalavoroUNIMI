<div class="container">


<div class="my-3 alert alert-primary">
    Commenti
</div>
<?php if(isset($_GET["error"])){
  echo "<h5 class='my-3 alert alert-primary'>".$_GET["error"]."</h5>";
} ?>
<div class="d-flex flex-row-md">
<?php if(isset($_SESSION["candidato"])){ ?>
<div class="col">

      <div class="panel-body">
          <form action="../backend/ins_commento.php?id=<?php echo $_GET["id"] ?>&url=<?php echo $_SERVER['REQUEST_URI'] ?>" method="post">
            <textarea class="form-control" name= "contenuto" id = "commento" placeholder="scrivi un commento..." rows="3"></textarea>
            <br>
            <!--Textarea di inserimento, onclick sul bottone chiama l'inserimimento del commento -->
            <button type="button" id = "posta" class= "btn btn-info pull-right" name="button" onclick = "ins_commento(<?php echo $_GET['id'] ?>)">Posta</button>
            <div class="clearfix"></div>
          </form>
          <hr>
      </div>
</div>
<?php } ?>
<div class="col" id = "commenti" >
          <?php
            //corpo della sezione dei commenti 
            include("../common/setup.php");
            $sql = "SELECT COUNT(*) FROM commento where idannuncio = $id";
            $res = $cid->query($sql) or die ($cid->error);
            $row = $res -> fetch_row();
            if($row[0] == 0){
              echo "<h4 id = 'nocomment' class = 'my-3 alert alert-warning'>Nessun commento trovato</h4>";
            }
            else {
              echo "<ul class='media-list'>";
              $sql = "SELECT candidato.nome, candidato.cognome, candidato.email, candidato.foto, commento.data, commento.contenuto
                      FROM commento join candidato on commento.email = candidato.email
                      WHERE idannuncio = $id";
              $res = $cid -> query($sql) or die($cid->error);
              while($row=$res->fetch_row()){
                ?>
                <li class="media">
                    <a href="<?php echo "../frontend/profile.php?candidato=".$row[2] ?>" class="pull-left">
                        <img class = "img-fluid rounded-circle comment-img" <?php if(!empty($row[3])){ echo "src= \"{$row[3]}\"";}else{echo "src = \"http://bootdey.com/img/Content/user_1.jpg\"";} ?>alt="" class="img-circle img-fluid rounded-circle mr-1">
                    </a>
                    <div class="media-body ml-2">
                        <span class="text-muted pull-right">
                            <small class="text-muted"><?php echo $row[4] ?></small>
                        </span>
                        <strong class="text-success"><a href="profile.php?candidato=<?php echo $row[2]; ?>"><?php echo $row[0]." ".$row[1]; ?></a></strong>
                        <p>
                            <?php echo $row[5]; ?>
                        </p>
                    </div>
                </li>
                <?php
              }
              echo "</ul>";
            }


           ?>

      </div>
  </div>
</div>

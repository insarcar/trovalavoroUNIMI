<?php
echo '<div class="row listing text-center text-md-left">';
echo  '<div class="col-md-2">';
echo    "<a href='profile.php?azienda=$value[7]>'>";
echo      '<img class="img-fluid rounded-circle mb-3 mb-md-0 profile-img"';
if(!empty($value[9])){
  echo "src= \"{$value[9]}\"";
}
else{
  echo "src =  \"https://picsum.photos/id/870/150/150?grayscale&blur=1\"";
}
echo 'alt="">';
echo    "</a>";
echo  "</div>";
echo  '<div class="col-md-8">';
echo    "<h3>$value[10]</h3>";
echo   "<small>";
echo      "<a href='profile.php?azienda=$value[7]' style='color:blue'>";
echo $value[1];
echo       "</a></small><br><p><small>";
echo $value[2];
echo "</small></p><p>$value[0]</p>";
echo "<small>$value[3] ";

if(isset($value[4])){
  echo "| Numero di giorni lavorativi per settimana: $value[4] ";
}
echo "| A partire dal: $value[5] ";
if(isset($value[6])){
  echo " fino al: $value[6]";
}
echo "</small><br>";
echo    "<a class='btn btn-primary mb-2' href='annuncio.php?id=$value[8]'>Vai ad Annuncio";
echo '<i class="fas fa-arrow-right" style="padding-left: 0.3rem"></i></a></div></div><hr>';
?>

<?php

echo '<div class="row rounded listing text-center text-md-left">';
echo  '<div class="col-md-2">';
echo    "<a href='profile.php?candidato=$value[4]'>";
echo     '<img class="img-fluid rounded-circle mb-3 mb-0 profile-img"';
if(!empty($value[5])){
  echo "src= \"{$value[5]}\"";
}
else{
  echo "src = \"https://picsum.photos/id/1005/150/150?grayscale\"";
}
echo " alt=''>";
echo '</a></div><div class="col-md"><h3>';
echo "$value[0] $value[1]</h3><p><small>$value[2]</small></p>";

if(isset($value[3])){
  echo "<p> $value[3] </p>";
}
else{
   echo "<br>";
 }
echo "<br>";


echo "<a class='btn btn-primary' href='profile.php?candidato=$value[4]'> Vai a Candidato <i class='fas fa-eye' style='padding-left: 0.3rem'></i></a></div></div><hr>";

?>

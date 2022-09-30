<?php


echo "<div class='row listing text-center text-md-left mt-2 mb-2'>";
echo  "<div class='col-md-2'>";
echo   " <a href='profile.php?azienda=$value[4]'>";
echo  '<img class="img-fluid rounded-circle mb-3 mt-3 profile-img"';
if(!empty($value[3])){
   echo "src= \"{$value[3]}\"";
 }
else{
  echo "src =  \"https://picsum.photos/id/870/150/150?grayscale&blur=1\"";
}
echo    "alt=''></a>";
echo  "</div>";
echo  "<div class='col-md-8'>";
echo    "<h3>";
echo      "$value[0]";
echo   "</h3>";

echo    "<p>";
echo      "<small>";
echo        "$value[1]";
echo      "</small>";
echo    "</p>";

        if(isset($value[2])) {echo "<p> $value[2] </p>";}
            else { echo "<br>"; }

echo    "<br>";
echo    "<a class='btn btn-primary mb-3' href='profile.php?azienda=$value[4]'>Vai ad Azienda";
echo     "<i class='fas fa-arrow-right' style='padding-left: 0.3rem'></i>";
echo    "</a>";
echo  "</div>";
echo "</div>";
echo "<hr>";

?>

<?php

echo "<tr>";
echo "<td><a class = 'tably' href = 'profile.php?azienda=$value[6]'>".$value[0]."</a></td>";
echo "<td><a class = 'tably' href = 'annuncio.php?id=$value[7]'>".$value[1]."</a></td>";
echo "<td><a class = 'tably' href = 'curriculum.php?id=$value[8]'>".$value[2]."</a></td>";
echo "<td>".$value[3]."</td>";
echo "<td>".$value[4]."</td>";
echo "<td>".$value[5]."</td>";
echo "<td class = 'text-center'><a class='tably confirm' href='../backend/del_candidatura.php?ida=$value[7]&idc=$value[8]'><i class='fas fa-times'></i></a></td>";
echo "<tr>";

?>

<?php
/**************************************
 * 
 * Filnamn: show-articles.php
 * Författare: Lova Duvnäs
 * Date: 2020-03-30
 * 
 * 1. Filen visar en tabell över
 *    alla rader i databasen
 *************************************/
require_once 'header.php';
?>

<h2>Inläggs översikt</h2>

<?php
require_once '../db.php';

$stmt = $db->prepare("SELECT * FROM articles ORDER BY publicationDate DESC");


$stmt->execute();


echo"<table class='table'>";
echo"<tr>
<th>Rubrik</th>
<th>Datum</th>
<th>Synlighet </th>
<th> </th> 
<th> </th>

</tr>";


while($row= $stmt->fetch(PDO::FETCH_ASSOC)) :
    $id= htmlspecialchars($row['id']);
    $title= htmlspecialchars_decode($row['title']);
    $content= htmlspecialchars($row['content']);
    $puplicationDate= htmlspecialchars($row['publicationDate']);
    $visibility= htmlspecialchars($row['visibility']);
    echo "<tr>
    <td> <a href='update.php?id=$id' 
    class='disable'>
    $title 
    </a>  </td>
    <td>$puplicationDate</td>";
 
  if (strpos($row["visibility"], 'hidden') === false){
    echo "
  <td>
  <a href='unpublish.php?id=$id' class='btn btn-outline-success btn-sm'>
  <i class='fa fa-eye'></i>

</a> </td> ";} else{
  echo "
  <td>
<a href='publish.php?id=$id'   class='btn btn-outline-warning btn-sm'>
<i class='fa fa-eye-slash'></i>

</a> 
  </td>";}
  echo"
  <td>   
<a href='update.php?id=$id' 
class='btn btn-outline-primary  btn-sm'>
Redigera <i class='fa fa-edit'></i>
</a>  
</td>

  <td>   
  <a href='delete.php?id=$id' 
  class='btn btn-outline-danger btn-sm'>
  Ta bort <i class='fa fa-trash'></i>
</a>  
  </td>


    </tr>";
  
endwhile;

echo'</table>';



require_once 'footer.php';

?>


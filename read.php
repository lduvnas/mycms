<?php 
/**************************************
 * 
 * Filnamn: read.php
 * Författare: Lova Duvnäs
 * Date: 2020-03-29
 * 
 * Hämtar in inlägg ifrån databasen
 * 
 * 
 *************************************/


require_once 'db.php';
require_once 'admin/convert-linebreaks.php';

$stmt = $db->prepare("SELECT * FROM articles ORDER BY publicationDate DESC");

$stmt->execute();

echo "<div class='row'>";

while($row= $stmt->fetch(PDO::FETCH_ASSOC)) :
    $id= htmlspecialchars($row['id']);
    $title= htmlspecialchars($row['title']);
    $content= htmlspecialchars($row['content']);
    $puplicationDate= htmlspecialchars($row['publicationDate']);
    $visibility= htmlspecialchars($row['visibility']);
    $image= htmlspecialchars($row['image']);
    $link= htmlspecialchars($row['link']);

    if (strpos($row["visibility"], 'hidden') === false){
  
    
?>
   
   <div class="card mb-5 w-100">

  <div class="card-body ">
    <h2 class="card-title mb-1"> <?php echo nl2br(htmlspecialchars_decode($title))?></h2>
    <p class="card-text mb-4"><small class="text-muted"><?php echo $puplicationDate ?> / Okategoriserade  </small></p>
    <?php 
if (!empty($image)) { 
  echo"
   <img class='img-fluid' src='images/$image' alt=''>";}
      ?>
    <p class="card-text"><?php echo nl2p(htmlspecialchars_decode($content))?>
    </p>
<?php 
if (!empty($link)) { 
  echo"
  <div class='embed-responsive embed-responsive-16by9'>
  <iframe class='embed-responsive-item' src='https://www.youtube.com/embed/$link' allowfullscreen></iframe>
</div>";}
      ?>

    <p class="card-text mt-2"><small class="text-muted"><?php echo $puplicationDate ?> / Okategoriserade / Lova Duvnäs 
    <a href='#' class='float-right' > <?php echo rand(5, 15);?>
  <i class='fa fa-comment'></i>
</a>
  </small></p>

  </div>
</div>
   
    <?php
    }
endwhile;


echo '</div>'
?>
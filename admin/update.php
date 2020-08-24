<?php

/**************************************
 * 
 * Filnamn: update.php
 * Författare: Lova Duvnäs
 * Date: 2020-03-29
 * 
 * Filen visar ett formulär 
 * med data från en enda rad som hämtas 
 * från databasen med hjälp av id
 * 
 * Uppdaterar databasen med 
 * ny data från formuläret
 * 
 *************************************/


require_once '../db.php';
require_once 'convert-linebreaks.php';

if(isset($_GET['id'])){
  $id = htmlspecialchars($_GET['id']);
  $sql = "SELECT * FROM articles WHERE id = :id";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id' , $id );
  $stmt->execute();

  if($stmt->rowCount() > 0){
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $title = $row['title'];
    $content  = $row['content'];
    $image = $row['image'];
    $link  = $row['link'];
  }else{
    header('Location:index.php');
    exit;
  }

}else{
  header('Location:index.php');
  exit;
}


if($_SERVER['REQUEST_METHOD'] === 'POST'){

  $id   = htmlspecialchars($_POST['id']);
  $title = htmlspecialchars($_POST['title']);
  $content  = htmlspecialchars_decode($_POST['content']);
  $image = htmlspecialchars($_FILES['image']['name']);
  $link  = htmlspecialchars($_POST['link']);
 
  $newLink = substr($link,17);

  $sql = "UPDATE articles
          SET title = :title, content = :content, link = :link 
          WHERE id = :id";

  $stmt = $db->prepare($sql);

  $stmt->bindParam(':title', $title);
  $stmt->bindParam(':content' , $content);
  $stmt->bindParam(':link' , $newLink);
  $stmt->bindParam(':id'  , $id);


  
  $stmt->execute();


  if (!empty($_FILES['image']['name'])) {

   //Bild uppladdning
    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
   
   $result = move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

   if ($result) {
    $_POST['image']= $image;

     $sql = "UPDATE articles
     SET image = :image 
     WHERE id = :id";

     $stmt = $db->prepare($sql);
     $stmt->bindParam(':image' , $image);
     $stmt->bindParam(':id'  , $id);
     
    $stmt->execute();
     

   } 

}

 header('Location:show-articles.php');
 exit;
 require_once 'header.php';
}
?>
<a href='show-articles.php' class='btn btn-outline-primary btn-sm'>
<i class='fa fa-chevron-left'></i> Tillbaka
</a>
<h3 class='mt-3'>Uppdatera Inlägg</h3>


<form action="#" method="POST" enctype="multipart/form-data">
<div class="form-group">
  <label class="col-form-label" for="inputDefault">Rubrik</label>
  <input  name="title"
      type="text" 
      class="form-control mb-3"
      value="<?php echo $title ?>">
</div>

  <div class="form-group">
      <label for="exampleTextarea">Inlägg</label>
      <textarea name="content"
      type="text" 
      class="form-control mb-3"
      value="<?php echo htmlspecialchars_decode($content) ?>"
      rows="14"><?php echo htmlspecialchars_decode($content)  ?></textarea>
    </div>

    <?php 

if (!empty($image)) { 
  echo"

  <img class='rounded float-right' src='../images/$image' alt=''>
  <figcaption class='figure-caption'>Nuvarande bild</figcaption>
";
    }
      ?>
 
   

    <div class="form-group w-50">
    <div class="input-group mb-3">
      <div class="custom-file ">
        <input type="file" name="image" class="custom-file-input" id="inputGroupFile02">
        <label class="custom-file-label" for="inputGroupFile02"><?php echo $image ?></label>
      </div>
    </div>
    </div>


    <div class="form-group w-50">
  <label class="col-form-label" for="inputDefault">Bädda in Youtube klipp</label>
  <input name="link" type="text" class="form-control" value="<?php if (!empty($link)) { echo "https://youtu.be/$link";}; ?>" id="inputDefault">
</div>


    <button type="submit" class="btn btn-outline-success">Uppdatera</button>

    <input type="hidden" name="id" value="<?php echo $id; ?>">
    
</form>

<?php
  require_once 'footer.php';
?>
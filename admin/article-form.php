<?php
/**************************************
 * 
 * Filnamn: article-form.php
 * Författare: Lova Duvnäs
 * Date: 2020-03-29
 * 
 * Filen innehåller ett formulär
 * som skickar data till databasen
 * 
 *************************************/

require_once '../db.php';

if($_SERVER['REQUEST_METHOD'] === 'POST') :

  $sql = "INSERT INTO articles (title, content, image, link)
          VALUES ( :title , :content, :image, :link ) ";

  $stmt = $db->prepare($sql);

  $title = htmlspecialchars($_POST['title']);
  $content  = htmlspecialchars($_POST['content']);
  $image = htmlspecialchars($_FILES['image']['name']);
  $link = htmlspecialchars($_POST['link']);
  
  //Youtube länk som tar bort första 17 tecken på strängen
  $newLink = substr($link,17);
  
  $stmt->bindParam(':title' , $title );
  $stmt->bindParam(':content'  , $content);
  $stmt->bindParam(':image'  , $image);
  $stmt->bindParam(':link'  , $newLink);

  if (!empty($_FILES['image']['name'])) {
    $target_dir = "../images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $result = move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

   if ($result) {
     $_POST['image']= $image;
   } 
  } 
  
  $stmt->execute();

  header('Location:show-articles.php');
endif;
require_once 'header.php';
?>

<h3 class='mt-3'>Nytt inlägg</h3>

<form action="#" method="POST" enctype="multipart/form-data">
<div class="form-group">
  <label class="col-form-label" for="inputDefault">Rubrik</label>
  <input name="title" type="text" class="form-control" placeholder="Ange rubrik till ditt inlägg" id="inputDefault">
</div>

  <div class="form-group">
      <label for="exampleTextarea">Inlägg</label>
      <textarea name="content" class="form-control" id="exampleTextarea" rows="14"></textarea>
    </div>

  
       <div class="form-group w-50">
    <div class="input-group mb-3">
      <div class="custom-file ">
        <input type="file" name="image" class="custom-file-input" id="inputGroupFile02">
        <label class="custom-file-label" for="inputGroupFile02">Välj en bild</label>
      </div>
    </div>
    </div>


  <input type="hidden" name="visibility" value="<?php echo $visibility; ?>">


<div class="form-group w-50">
  <label class="col-form-label" for="inputDefault">Bädda in Youtube klipp</label>
  <input name="link" type="text" class="form-control" placeholder="Ange youtube filmens delningslänk" id="inputDefault">
</div>

    <button type="submit" class="btn btn-primary">Publicera</button>
</form>


<?php
require_once 'footer.php';

?>
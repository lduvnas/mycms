<?php

/**************************************
 * 
 * Filnamn: unpublish.php
 * Författare: Lova Duvnäs
 * Date: 2020-03-30
 * 
 * 1. Filen sätter ett värde på visability hidden
 *    med hjälp av ett id
 *************************************/

require_once '../db.php';

if(isset($_GET['id'])){

  $id = htmlspecialchars($_GET['id']); 


  $sql = "UPDATE articles SET visibility = 'hidden' WHERE id = :id";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->execute();
}

header('Location:show-articles.php');


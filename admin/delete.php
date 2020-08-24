<?php

/**************************************
 * 
 * Filnamn: delete.php
 * Författare: Lova Duvnäs
 * Date: 2020-03-29
 * 
 * 1. Filen tar bort en rad från databasen
 *    med hjälp av ett id
 *************************************/

require_once '../db.php';

if(isset($_GET['id'])){

  $id = htmlspecialchars($_GET['id']); 

  $sql = "DELETE FROM articles WHERE id = :id";
  $stmt = $db->prepare($sql);
  $stmt->bindParam(':id', $id);
  $stmt->execute();
}

header('Location:show-articles.php');


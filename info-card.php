<?php 
/**************************************
 * 
 * Filnamn: info-card.php
 * Författare: Lova Duvnäs
 * Date: 2020-03-30
 * 
 * 1. Informations-kort på bloggens
 *    startsida
 *************************************/
echo "

<div class='card float-right ml-5' style='width: 18rem;'>
  <img src='images/photo125.jpg' class='card-img-top' alt='...'>
  <div class='card-body'>
    <h5 class='card-title'>Lova Duvnäs</h5>
    <p class='card-text'>Här kommer lite information om mig. Lorem ipsum dolor sit amet, 
    consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore 
    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation 
    ullamco laboris nisi ut aliquip ex ea commodo consequat. <br><br>
    Duis aute irure dolor in reprehenderit in voluptate velit esse cillum 
    dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, 
    sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
  </div>

  <ul class='list-group list-group-flush'>
  <h6 class='m-3'>Kategorier</h6>
    <li class='list-group-item'><a href='#' class='card-link'>Okategoriserat</a></li>
    <li class='list-group-item'><a href='#' class='card-link'>Resor</a></li>
    <li class='list-group-item'><a href='#' class='card-link'>Recept</a></li>
    <li class='list-group-item'><a href='#' class='card-link'>Tips</a></li>
    <li class='list-group-item'><a href='#' class='card-link'>Inredning</a></li>
  </ul>
  <div class='card-body'>
    <a href='#' class='card-link'>About</a>
    <a href='#' class='card-link'>Contact</a>
  </div>
</div>";

?>
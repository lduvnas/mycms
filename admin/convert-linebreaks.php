<?php 
/**************************************
 * 
 * Filnamn: convert-linebreaks.php
 * Författare: Lova Duvnäs
 * Date: 2020-03-30
 * 
 * 1. Filen innehåller en funktion
 *    som sätter varje nytt stycke i p-taggar
 *************************************/

function nl2p($string) {
        $string_parts = explode("\n", $string);

        $string = '<p>' . implode('</p><p>', $string_parts) . '</p>';	
      
        return str_replace("<p></p>", '', $string);	
      }

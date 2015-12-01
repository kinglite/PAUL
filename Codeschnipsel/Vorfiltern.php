<?php

function filterfunktion($input){
$input=strip_tags($input);
$input=str_replace("\n", "", $input);
$input=trim($input);
return $input;
}

?>

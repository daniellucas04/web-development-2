<?php
function media($array) {
    $media = 0;
    foreach($array as $value) {
        $media += $value;
    }
    
    return $media / sizeof($array);
}

$array = array(1, 2, 3, 4);
echo media($array);
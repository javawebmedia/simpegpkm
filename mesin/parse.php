<?php
function Parse_Data($data, $p1, $p2){
    $data = " " .$data; // Add a space to avoid issues with strpos
    $hasil = "";
    $awal = strpos($data, $p1);
    if ($awal !== false){ // Use strict comparison to avoid unexpected behavior
        $akhir = strpos(strstr($data, $p1), $p2);
        if ($akhir !== false){ // Use strict comparison to avoid unexpected behavior
            $hasil = substr($data, $awal + strlen($p1), $akhir - $awal - strlen($p1)); // Correct calculation for substring
        }
    }
    return $hasil;    
}
?>
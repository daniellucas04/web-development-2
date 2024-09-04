<?php
function jurosSimples($capital, $taxa, $tempo) {
    return number_format($capital * ($taxa/100) * $tempo, 2);
}

function jurosCompostos($capital, $juros, $tempo) {
    $montante = $capital * ((1 + ($juros/100)) ** $tempo);
    return number_format($montante - $capital, 2);
}

/**
 * capital = 1000
 * taxa = 10
 * tempo = 36
 */
echo '<h1>Juros simples</h1>';
echo jurosSimples(1000, 10, 36);


/**
 * capital = 1000
 * taxa = 10
 * tempo = 36
 */
echo '<h1>Juros compostos</h1>';
echo jurosCompostos(1000, 10, 36);
<?php
if ( isset($_POST['peso']) AND isset($_POST['altura']) ) {
    $peso = filter_var(str_replace(',', '.', $_POST['peso']), FILTER_VALIDATE_FLOAT);
    $altura = filter_var(str_replace(',', '.', $_POST['altura']), FILTER_VALIDATE_FLOAT);

    if ( !empty($peso) AND !empty($altura) ) {
        echo $peso / $altura**2;
    } else {
        echo 'Necessário informar o peso e a altura.';
    }
} else {
    echo 'Informe o peso e a altura.';
}
?>
<?php

require_once 'connDb.php';

function getTemaQry($codice, $descrizione, $numeroSale,$sort_by = 'codice', $sort_order = 'asc'): string {
    global $conn;

    $qry = "SELECT
                TEMA.codice,
                TEMA.descrizione,
                TEMA.numeroSale
            FROM
                TEMA
            WHERE
                1=1";

    if ($codice != "")
        $qry .= " AND TEMA.codice =  $codice " ; // Aggiungi apici singoli intorno al valore

    if ($descrizione != "")
        $qry .= " AND TEMA.descrizione  LIKE '%" . $descrizione . "%'" ;

        if (!empty($sort_by) && !empty($sort_order)) {
          $qry .= " ORDER BY " . $sort_by . " " . $sort_order;
        }


    return $qry;
}

function sanitizeInput($input) {
    
    $whitelist = array(
        'codice' => '/^\d+$/', // Solo numeri per il codice
        'descrizione' => '/^[a-zA-Z\s]+$/',
        'numeroSale' => '/^\d+$/' // Solo numeri per il numero di sale

    foreach ($input as $key => $value) {
        if (!empty($value) && !preg_match($whitelist[$key], $value)) {

            return "Il campo '$key' contiene caratteri non validi.";
        }
    }

    return $input;
}

$input = array(
    'codice' => $codice,
    'descrizione' => $descrizione,
    'numeroSale' => $numeroSale

);

$sanitizedInput = sanitizeInput($input);

if (is_string($sanitizedInput)) {
    echo $sanitizedInput;
} else {

    $codice = $sanitizedInput['codice'];
    $descrizione = $sanitizedInput['descrizione'];
    $numeroSale = $sanitizedInput['numeroSale'];
}


?>

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

//in questo file in teoria non dovrei fare altre query
function getTery($codice, $descrizione, $numeroSale, $sort_by = 'codice', $sort_order = 'asc') {
  $query = "SELECT * FROM TEMA WHERE 1=1";

  if(!empty($codice)) {
    $query .= " AND codice LIKE '%" . $codice . "%'";
  }
  if(!empty($descrizione)) {
    $query .= " AND descrizione LIKE '%" . $descrizione . "%'";
  }
  if(!empty($numeroSale)) {
    $query .= " AND numeroSale = '" . $numeroSale . "'";
  }

  if (!empty($sort_by) && !empty($sort_order)) {
    $query .= " ORDER BY " . $sort_by . " " . $sort_order;
  }

  return $query;
}
?>

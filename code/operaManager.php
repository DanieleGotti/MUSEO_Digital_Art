<?php

require_once 'connDb.php';

function getOperaQry($opera, $autore,$nome, $cognome, $titolo, $annoAcquisto, $annoRealizzazione, $tipo, $espostaInSala, $sort_by = 'opera', $sort_order = 'asc'): string {
  global $conn;

  $qry = "SELECT
  OPERA.opera as opera,
  OPERA.autore,
  AUTORE.nome,
  AUTORE.cognome,
  OPERA.titolo,
  OPERA.annoAcquisto,
  OPERA.annoRealizzazione,
  OPERA.tipo,
  OPERA.espostaInSala
  FROM
  OPERA
  LEFT JOIN
  AUTORE ON OPERA.autore = AUTORE.codice
  JOIN
  SALA ON OPERA.espostaInSala = SALA.numero
  WHERE
  1=1";

  if ($opera != "")
  $qry .= " AND OPERA.opera =  $opera ";

  if ($autore != "")
  $qry .= " AND AUTORE.codice =  $autore " ;
  if ($nome != "")
  $qry .= " AND AUTORE.nome  LIKE '%" . $nome . "%'";
  if ($cognome != "")
  $qry .= " AND AUTORE.cognome LIKE '%" . $cognome . "%'";
  if ($titolo != "")
  $qry .= " AND OPERA.titolo  LIKE '%" . $titolo . "%'";
  if ($annoAcquisto != "")
  $qry .= " AND OPERA.annoAcquisto  LIKE '%" . $annoAcquisto . "%'";
  if ($annoRealizzazione != "")
  $qry .= " AND OPERA.annoRealizzazione LIKE '%" . $annoRealizzazione . "%'";

  if ($tipo != "")
  $qry .= " AND OPERA.tipo LIKE '%" . $tipo . "%'"; // Aggiungi apici singoli intorno al valore

  if ($espostaInSala != "")
  $qry .= " AND OPERA.espostaInSala = $espostaInSala";

  if (!empty($sort_by) && !empty($sort_order)) {
    $qry .= " ORDER BY " . $sort_by . " " . $sort_order;
  }

  return $qry;
}
?>

<?php

require_once 'connDb.php';

function getSalaQry($numero, $nome, $superficie, $numeroOpere, $temaSala, $descrizione, $nomeopera, $sort_by = 'numero', $sort_order = 'asc' ): string {
  global $conn;

  $qry = "SELECT DISTINCT
  SALA.numero,
  SALA.nome,
  SALA.superficie,
  SALA.numeroOpere,
  SALA.temaSala,
  TEMA.descrizione
  FROM
  SALA
  LEFT JOIN
  TEMA ON SALA.temaSala = TEMA.codice
  WHERE
  1=1";

  if ($numero != "")
  $qry .= " AND SALA.numero = '$numero'";

  if ($nome != "")
  $qry .= " AND SALA.nome LIKE '%" . $nome . "%'";

  if ($superficie != "")
  $qry .= " AND SALA.superficie LIKE '%" . $superficie . "%'";

  if ($numeroOpere != "")
  $qry .= " AND SALA.numeroOpere LIKE '%" . $numeroOpere . "%'";

  if ($temaSala != "")
  $qry .= " AND SALA.temaSala = ' $temaSala '";

  if ($descrizione != "")
  $qry .= " AND TEMA.descrizione LIKE '%" . $descrizione . "%'";

  if ($nomeopera != ""){
    $qry = " SELECT DISTINCT
    SALA.numero,
    SALA.nome,
    SALA.superficie,
    SALA.numeroOpere,
    SALA.temaSala,
    TEMA.descrizione,
    OPERA.titolo AS nomeopera
    FROM
    SALA
    LEFT JOIN
    TEMA ON SALA.temaSala = TEMA.codice
    JOIN OPERA on OPERA.espostaInSala=SALA.numero
    WHERE
    1=1 AND OPERA.titolo LIKE '%" . $nomeopera . "%'";
  }

  if (!empty($sort_by) && !empty($sort_order)) {
    $qry .= " ORDER BY " . $sort_by . " " . $sort_order;
  }

  return $qry;
}
?>

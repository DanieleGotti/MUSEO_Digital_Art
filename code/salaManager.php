<?php

require_once 'connDb.php';

function getSalaQry($numero, $nome, $superficie, $temaSala, $descrizione, $nomeopera, $cercaautore ): string {
    global $conn;

    $qry = "SELECT DISTINCT
                SALA.numero,
                SALA.nome,
                SALA.superficie,
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

    if ($temaSala != "")
        $qry .= " AND SALA.temaSala LIKE '%" . $temaSala . "%'";

    if ($descrizione != "")
        $qry .= " AND TEMA.descrizione LIKE '%" . $descrizione . "%'";

    if ($nomeopera != ""){
        $qry = " SELECT DISTINCT
                    SALA.numero,
                    SALA.nome,
                    SALA.superficie,
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

  if($cercaautore !=""){
      $qry =( " SELECT DISTINCT
                  SALA.numero,
                  SALA.nome,
                  SALA.superficie,
                  SALA.temaSala,
                  TEMA.descrizione,
                  AUTORE.nome,
                  AUTORE.cognome
                  SALA
              JOIN
                  TEMA ON SALA.temaSala = TEMA.codice
              JOIN (OPERA 
              JOIN AUTORE on AUTORE.codice=OPERA.autore) on OPERA.espostaInSala=SALA.numero
              WHERE
                  1=1 AND  AUTORE.nome LIKE '%" . $cercaautore . "%'" );
}

    return $qry;
}


?>

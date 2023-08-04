<?php
class DashboardProvider
{
  private $connection;

  public function __construct($connection)
  {
    $this->connection = $connection;
  }

  public function dashboard()
  {


    // ============================
    $query = "SELECT   R.id
        , R.ritmo
        , COUNT(P.id) total
     FROM icnt_ritmos R
     JOIN icnt_pontos P ON P.ritmo = R.id
 GROUP BY P.ritmo
 ORDER BY total DESC;";
    $stmt = $this->connection->prepare($query);
    $stmt->execute();
    $rythm = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $p = array(
        "id" => $id,
        "ritmo" => $ritmo,
        "total" => $total
      );
      array_push($rythm, $p);
    }


    // ============================
    $query = "SELECT   L.id
        , L.linha
        , COUNT(P.id) total
   FROM icnt_linha L
   JOIN icnt_pontos P 
     ON P.linha = L.id
GROUP BY   P.linha DESC
ORDER BY   total DESC
      , L.linha;";
    $stmt = $this->connection->prepare($query);
    $stmt->execute();
    $lines = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $p = array(
        "id" => $id,
        "linha" => $linha,
        "total" => $total
      );
      array_push($lines, $p);
    }

    // ============================
    $query = "SELECT   C.id
        , C.categoria
        , COUNT(P.id) total
   FROM icnt_categoria_linha C
   JOIN icnt_linha L
     ON L.categoria = C.id
   JOIN icnt_pontos P 
     ON P.linha = L.id
GROUP BY   L.categoria DESC
ORDER BY   total ASC
      , L.linha;";
    $stmt = $this->connection->prepare($query);
    $stmt->execute();
    $categories = array();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
      extract($row);
      $p = array(
        "id" => $id,
        "categoria" => $categoria,
        "total" => $total
      );
      array_push($categories, $p);
    }

    $dash_response = array(
      "total_per_rythm" => $rythm,
      "total_per_category" => $categories,
      "total_per_line" => $lines
    );
    return $dash_response;
  }
}

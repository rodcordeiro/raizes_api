<?php
class DashboardProvider {
    private $connection;

    public function __construct($connection){
        $this->connection = $connection;
    }

    public function dashboard(){
        $dash_response = array();

        // ============================
        $query = "SELECT   R.id
        , R.ritmo
        , COUNT(P.id) total
     FROM icnt_ritmos R
     JOIN icnt_pontos P ON P.ritmo = R.id
 GROUP BY P.ritmo
 ORDER BY total DESC;";
        $stmt = $this->connection->prepare($query);
        $rythm = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          extract($row);
          $p = array(
            "id" => $id,
            "ritmo" => $ritmo,
            "total" => $total
          );
          array_push($rythm,$p);
        }
        array_push($dash_response,$rythm);


        // ============================
        $query = "SELECT   L.id
        , L.linha
        , COUNT(P.id) total
   FROM icnt_linha L
   JOIN icnt_pontos P 
     ON P.linha = L.id
GROUP BY   P.linha DESC
ORDER BY   total ASC
      , L.linha;";
        $stmt = $this->connection->prepare($query);
        $lines = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          extract($row);
          $p = array(
            "id" => $id,
            "linha" => $linha,
            "total" => $total
          );
          array_push($lines,$p);
        }
        array_push($dash_response,$lines);

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
        $categories = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
          extract($row);
          $p = array(
            "id" => $id,
            "categoria" => $linha,
            "total" => $total
          );
          array_push($categories,$p);
        }
        array_push($dash_response,$categories);

        return $dash_response;
    }
}
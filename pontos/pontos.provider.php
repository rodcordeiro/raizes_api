<?php
class PontosProvider
{
    private $connection;

    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    private function getLines()
    {
        $query = "select L.id, L.linha,L.categoria from icnt_linha L; ";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $lines = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // print_r($row);
            extract($row);
            $p = array(
                "id" => $id,
                "linha" => $linha,
                "categoria" => $categoria
            );
            array_push($lines, $p);
        }
        return $lines;
    }

    private function getPontos()
    {
        $query = "select P.id
        , P.ritmo as rythm_id
    , R.ritmo as rythm_description
    , P.linha as line_id
    , L.linha as line_description
    , P.tipo
    , P.ponto
    , P.audio_link
 from icnt_pontos P
 JOIN icnt_ritmos R ON R.id = P.ritmo
 JOIN icnt_linha L ON L.id = P.linha;";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $pontos = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // print_r($row);
            extract($row);
            $p = array(
                "id" => $id,
                "rythm_id" => $rythm_id,
                "rythm_description" => $rythm_description,
                "line_id" => $line_id,
                "line_description" => $line_description,
                "tipo" => $tipo,
                "ponto" => $ponto,
                "audio_link" => $audio_link,
            );
            array_push($pontos, $p);
        }
        return $pontos;
    }

    public function filterByLine($line)
    {
        $query = "select P.id
        , P.ritmo as rythm_id
    , R.ritmo as rythm_description
    , P.linha as line_id
    , L.linha as line_description
    , P.tipo
    , P.ponto
    , P.audio_link
 from icnt_pontos P
 JOIN icnt_ritmos R ON R.id = P.ritmo
 JOIN icnt_linha L ON L.id = P.linha
WHERE P.linha = {$line};";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $pontos = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // print_r($row);
            extract($row);
            $p = array(
                "id" => $id,
                "rythm_id" => $rythm_id,
                "rythm_description" => $rythm_description,
                "line_id" => $line_id,
                "line_description" => $line_description,
                "tipo" => $tipo,
                "ponto" => $ponto,
                "audio_link" => $audio_link,
            );
            array_push($pontos, $p);
        }
        return $pontos;
    }
    public function getData()
    {
        $lines = $this->getLines();
        $pontos = $this->getPontos();
        $dash_response = array("linhas" => $lines, 'pontos' => $pontos);

        return $dash_response;
    }
  public function oldData(){
    $pontos = array();

        $query = "select P.id
        , P.ritmo as rythm_id
    , R.ritmo as rythm_description
    , P.linha as line_id
    , L.linha as line_description
    , P.tipo
    , P.ponto
    , P.audio_link
 from icnt_pontos P
 JOIN icnt_ritmos R ON R.id = P.ritmo
 JOIN icnt_linha L ON L.id = P.linha;";
        $stmt = $this->connection->prepare($query);
        $stmt->execute();
        $pontos = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            // print_r($row);
            extract($row);
            $p = array(
                "id" => $id,
                "ritmo" => $rythm_description,
                "idLinha" => $line_id,
                "linha" => $line_description,
                "tipo" => $tipo,
                "ponto" => $ponto,
                "audioLink" => $audio_link,
            );
            array_push($pontos, $p);
        }
$lines = $this->getLines();
    $data = array(
      "pontos"=>$pontos,
      "linhas"=>$lines
    );
    return $data;
  }
}

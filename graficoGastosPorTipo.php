<?php

require_once "contaBiblioteca.php";

$inicio = $_GET["inicio"];
$fim = $_GET["fim"];

$dados = listarGastosPorPeriodo($inicio, $fim);

$tipos = array();
$gastos = array();

foreach ($dados as $d) {
  array_push($tipos, $d["tipos"]);
  array_push($gastos, $d["gastos"]);
}

$response = array(
  "tipos" => $tipos,
  "gastos" => $gastos
);

echo json_encode($response);

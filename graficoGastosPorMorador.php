<?php

require_once "contaBiblioteca.php";

$inicio = $_GET["inicio"];
$fim = $_GET["fim"];

$dados = listarGastosPorMorador($inicio, $fim);

$moradores = array();
$gastos = array();

foreach ($dados as $d) {
  array_push($moradores, $d["moradores"]);
  array_push($gastos, $d["gastos"]);
}

$response = array(
  "moradores" => $moradores,
  "gastos" => $gastos
);

echo json_encode($response);

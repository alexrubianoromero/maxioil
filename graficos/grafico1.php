<?php

require_once ('../../jpgraph-4.2.2/src/jpgraph.php');
require_once ('../../jpgraph-4.2.2/src/jpgraph_bar.php');

// Creamos el grafico
$datos=array(6,5,8,6);
$labels=array("pepe","juanita","Maria","Luis");

$grafico = new Graph(800, 700, 'auto');
$grafico->SetScale("textlin");
$grafico->title->Set("Ejemplo de GraficaAlex Rubiano");
$grafico->xaxis->title->Set("trabajadores123");
$grafico->xaxis->SetTickLabels($labels);
$grafico->yaxis->title->Set("Horas Trabajadas");

$barplot1 =new BarPlot($datos);
$barplot1->SetWidth(50); // 30 pixeles de ancho para cada barra

$grafico->Add($barplot1);
$grafico->Stroke();

?>
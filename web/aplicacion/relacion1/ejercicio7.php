<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ],
    [
        "TEXTO" => "Relacion 1",
        "LINK" => "/aplicacion/relacion1/index.php"
    ],
    [
        "TEXTO" => "Ejercicio7",
        "LINK" => ""
    ]
];

// Nombres en español (date() y format() devuelven los nombres en inglés)
const meses = array(1=>"enero", "febrero", "marzo", "abril", "mayo", "junio",
            "julio", "agosto", "septiembre", "octubre", "noviembre", "diciembre");
const dias  = array("domingo", "lunes", "martes", "miércoles", "jueves", "viernes", "sábado");



//dibuja la plantilla de la vista
inicioCabecera("EJERCICIO 7");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 7", $barraUbi);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************


    


//vista
function cabecera() {}
//vista
function cuerpo()
{



?>
<h2>MOSTRAR FECHAS</h2> <br>
<?php

// Fechas (timestamps) con las que se trabaja
$actual   = time();
$concreta = mktime(12, 45, 0, 3, 29, 2024);                 // 29/3/2024 a las 12:45
$restada  = mktime((int)date('H') - 4, (int)date('i'), (int)date('s'),
                (int)date('n'), (int)date('j') - 12, (int)date('Y'));

?>
<h2>Con funciones de fecha</h2>

<h3>Fecha actual</h3>
<?php
echo date("d/m/Y", $actual) . "<br />\n";
echo "dia " . date("d", $actual) . ", mes " . meses[(int)date("n", $actual)] .
    ", año " . date("Y", $actual) . ", dia de la semana " . dias[(int)date("w", $actual)] . "<br />\n";
echo date("H:i:s", $actual) . "<br />\n";
?>

<h3>29/3/2024 a las 12:45</h3>
<?php
echo date("d/m/Y", $concreta) . "<br />\n";
echo "dia " . date("d", $concreta) . ", mes " . meses[(int)date("n", $concreta)] .
    ", año " . date("Y", $concreta) . ", dia de la semana " . dias[(int)date("w", $concreta)] . "<br />\n";
echo date("H:i:s", $concreta) . "<br />\n";
?>

<h3>Fecha actual menos 12 días y 4 horas</h3>
<?php
echo date("d/m/Y", $restada) . "<br />\n";
echo "dia " . date("d", $restada) . ", mes " . meses[(int)date("n", $restada)] .
    ", año " . date("Y", $restada) . ", dia de la semana " . dias[(int)date("w", $restada)] . "<br />\n";
echo date("H:i:s", $restada) . "<br />\n";


// Fechas (DateTime) con las que se trabaja
$dtActual   = new DateTime();
$dtConcreta = DateTime::createFromFormat("j/n/Y H:i", "29/3/2024 12:45");
$dtRestada  = new DateTime();
$dtRestada->sub(new DateInterval("P12DT4H"));              // 12 días y 4 horas
?>

<h2>Con la clase DateTime</h2>

<h3>Fecha actual</h3>
<?php
echo $dtActual->format("d/m/Y") . "<br />\n";
echo "dia " . $dtActual->format("d") . ", mes " . meses[(int)$dtActual->format("n")] .
    ", año " . $dtActual->format("Y") . ", dia de la semana " . dias[(int)$dtActual->format("w")] . "<br />\n";
echo $dtActual->format("H:i:s") . "<br />\n";
?>

<h3>29/3/2024 a las 12:45</h3>
<?php
echo $dtConcreta->format("d/m/Y") . "<br />\n";
echo "dia " . $dtConcreta->format("d") . ", mes " . meses[(int)$dtConcreta->format("n")] .
    ", año " . $dtConcreta->format("Y") . ", dia de la semana " . dias[(int)$dtConcreta->format("w")] . "<br />\n";
echo $dtConcreta->format("H:i:s") . "<br />\n";
?>

<h3>Fecha actual menos 12 días y 4 horas</h3>
<?php
echo $dtRestada->format("d/m/Y") . "<br />\n";
echo "dia " . $dtRestada->format("d") . ", mes " . meses[(int)$dtRestada->format("n")] .
    ", año " . $dtRestada->format("Y") . ", dia de la semana " . dias[(int)$dtRestada->format("w")] . "<br />\n";
echo $dtRestada->format("H:i:s") . "<br />\n";

}


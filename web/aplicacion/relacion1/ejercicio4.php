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
        "TEXTO" => "Ejercicio4",
        "LINK" => ""
    ]
];
//Constante con la cantidad de filas para los arrays
const FILAS =5;

//Funcion que genera el array sin una cantidad definida de filas
function generarArrayFijo()
{
    $datos = array();
    for ($numero = 1; $numero <= 5; $numero++) {
        // el número N se repite N veces
        for ($repeticion = 0; $repeticion < $numero; $repeticion++) {
            $datos[] = $numero;
        }
    }
    return $datos;
}

//Funcion que genera el array con una cantidad definida de filas
function generarArrayFilas($filas)
{
    $datos = array();
    for ($numero = 1; $numero <= $filas; $numero++) {
        for ($repeticion = 0; $repeticion < $numero; $repeticion++) {
            $datos[] = $numero;
        }
    }
    return $datos;
}

//dibuja la plantilla de la vista
inicioCabecera("EJERCICIO 4");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 4", $barraUbi);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************


    


//vista
function cabecera() {}
//vista
function cuerpo()
{



?>
<h2>MOSTRAR MATRIZ</h2> <br>
<?php

// Funcion que muestra el array con una cantidad de filas
function vistaArray($datos)
{
    $anterior = null;
    foreach ($datos as $valor) {
        if ($anterior !== null && $valor != $anterior) {
            echo "<br />\n";
        }
        echo $valor . " ";
        $anterior = $valor;
    }
    echo "<br>\n";
    echo "Total de elementos: " . count($datos) . "<br />\n";
}

// Llamadas a las funciones para crear los arrays
$arrayFijo  = generarArrayFijo();
$arrayFilas = generarArrayFilas(FILAS);

// Mostrar los arrays
vistaArray($arrayFijo);
echo "<br />\n";
vistaArray($arrayFilas);


}

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
        "TEXTO" => "Ejercicio6",
        "LINK" => ""
    ]
];

//Funcion que crea el vector con los valores 
function crearVector()
{
    return array("primera" => 12.56, 24 => true, 67 => 23.76);
}

//dibuja la plantilla de la vista
inicioCabecera("EJERCICIO 6");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 6", $barraUbi);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************


    


//vista
function cabecera() {}
//vista
function cuerpo()
{



?>
<h2>MOSTRAR ARRAY CON DIFERENTES TIPOS DE FOREACH</h2> <br>
<?php

//Funcion que comprueba si el texto es un boolean
function textoValor($valor)
{
    if(is_bool($valor)){
        return $valor ? true : false;
    }
    return $valor;
}


// Simula foreach ($array as $indice => $valor) con funciones de recorrido
function vistaConRecorrido($vector)
{
    echo "<h2>Simulando foreach con funciones de recorrido</h2>\n";

    reset($vector);                       // puntero al primer elemento
    while (key($vector) !== null) {       // key() devuelve null al salirse del array
        $indice = key($vector);
        $valor  = current($vector);
        echo "indice: " . $indice . " valor: " . textoValor($valor) . "<br />\n";
        next($vector);                    // avanza el puntero
    }
}


// Simula foreach con array_keys y array_values
function vistaConKeysValues($vector)
{
    echo "<h2>Simulando foreach con array_keys y array_values</h2>\n";

    $indices = array_keys($vector);
    $valores = array_values($vector);

    for ($i = 0; $i < count($indices); $i++) {
        echo "indice: " . $indices[$i] . " valor: " . textoValor($valores[$i]) . "<br />\n";
    }
}

//Llamada a la funcion para crear el vector
$vector = crearVector();

//Llamada a las funciones
vistaConRecorrido($vector);
vistaConKeysValues($vector);

}

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
        "TEXTO" => "Ejercicio5",
        "LINK" => ""
    ]
];

//Funcion que permite crear un vector 
function crearVector()
{
    $vector = array();
    $vector[1] = "esto es una cadena";
    $vector["posi1"] = 25.67;
    $vector[] = false;                 // PHP le asigna la posición 2
    $vector["ultima"] = array(2, 5, 96);
    $vector[56] = 23;
    return $vector;
}

//dibuja la plantilla de la vista
inicioCabecera("EJERCICIO 5");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 5", $barraUbi);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************


    


//vista
function cabecera() {}
//vista
function cuerpo()
{



?>
<h2>MOSTRAR MATRIZ Y MOSTRAR TIPOS DE VALOR</h2> <br>
<?php

//Funcion que permite comprobar que tipo de valor es (boolean, integer, etc.)
function describirValor($valor)
{
    switch (gettype($valor)) {
        case "integer":
            return "Entero con valor " . $valor . ", en binario " . decbin($valor);
        case "double":
            return $valor . " que al cuadrado es " . ($valor * $valor);
        case "string":
            return "-" . $valor . "-";
        case "boolean":
            $actual  = $valor ? "true" : "false";
            $opuesto = !$valor ? "true" : "false";
            return $actual . " y su opuesto " . $opuesto;
        default:
            return "tipo no contemplado";
    }
}

//Funcion que permite recorrer el vector
function vistaVector($vector)
{
    foreach ($vector as $posicion => $contenido) {
        $tipo = gettype($contenido);

        if (is_array($contenido)) {
            echo "- posicion " . $posicion . " contenido (" . $tipo . ")<br />\n";
            foreach ($contenido as $subPosicion => $subContenido) {
                echo "&nbsp;&nbsp;&nbsp;&nbsp;- posicion " . $subPosicion .
                    " contenido (" . gettype($subContenido) . ") " .
                    describirValor($subContenido) . "<br />\n";
            }
        } else {
            echo "- posicion " . $posicion . " contenido (" . $tipo . ") " .
                describirValor($contenido) . "<br />\n";
        }
    }
}

//Llamada a la creacion del vector
$vector = crearVector();

//Llamada a la vista del vector
vistaVector($vector);

}

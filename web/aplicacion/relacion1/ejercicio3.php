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
        "TEXTO" => "Ejercicio3",
        "LINK" => ""
    ]
];
// Creacion de los arrays, uno sin datos y otro con los datos desde array()
$miArray =[];
$miArray2 = array(
    1 => "hola",
    16 => 6542.123,
    54 => true,
    "uno" => "cadena",
    "dos" =>  true,
    "tres" => 1.345,
    "ultima" => [1,34,"nueva"]
);
//dibuja la plantilla de la vista
inicioCabecera("EJERCICIO 3");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 3", $barraUbi);
cuerpo($miArray2); //llamo a la vista
finCuerpo();
// **********************************************************


    


//vista
function cabecera() {}
//vista
function cuerpo($miArray2)
{


//Metemos los valores que nos piden
$miArray[1] = "hola";
$miArray[16] = 654.21;
$miArray[54] = true;

array_push($miArray,34);

//Aqui lo metemos con una posicion de cadena
$miArray["uno"] = "cadena";
$miArray["dos"] = true;
$miArray["tres"] = 1.345;






?>
<h2>MOSTRAR ARRAY</h2> <br>
<?php

//Recorremos con un bucle foreach los array
foreach($miArray as $elem){
    echo "Elementos del array: ".$elem."<br>";
}

// Aqui lo recorremos con el segundo array
foreach($miArray2 as $clave=> $elem){
    if (is_array($elem)) {
            echo "Elemento del segundo array [" . $clave . "]: " . implode(", ", $elem) . "<br>";
        } else {
            echo "Elemento del segundo array [" . $clave . "]: " . $elem . "<br>";
        }
}


}

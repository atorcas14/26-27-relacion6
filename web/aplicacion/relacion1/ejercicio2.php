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
        "TEXTO" => "Ejercicio2",
        "LINK" => ""
    ]
];
// Constante con la cantidad de veces que se van a lanzar los dados
const N = 1000;

//dibuja la plantilla de la vista
inicioCabecera("EJERCICIO 2");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 2", $barraUbi);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

// Funcion que lanza 6 veces los dados
function lanzar6veces(){
    $tiradas = array();
    for($i=0;$i<6;$i++){
        $tiradas[$i] =mt_rand(1,6); 
    }
    return $tiradas;
}

// Funcion que lanza los dados tantas veces como se quiera
function contarCaras($lanzamientos){
    //array con las frecuencias de las caras
    $frecuenciaCaras = [
        1=>0,
        2=>0,
        3=>0,
        4=>0,
        5=>0,
        6=>0
    ];
    $i=0;

    
    while ($i<$lanzamientos){
    $resultadoTirada = (mt_rand() % 6) + 1;
    $frecuenciaCaras [$resultadoTirada]++;
    $i++;
}
return $frecuenciaCaras;
    
}

// Funcion para mostrar los resultados de los dados
function vistaDados($tiradas, $conteo, $lanzamientos)
{
    foreach ($tiradas as $indice => $valor) {
        echo "Lanzamiento " . ($indice + 1) . " del dado: " . $valor . "<br />\n";
    }

    echo "<br />\n<br />\n";

    echo "Lanzado el dado " . $lanzamientos . " veces<br />\n";
    foreach ($conteo as $cara => $veces) {
        $porcentaje = round($veces * 100 / $lanzamientos, 1);
        echo "El " . $cara . " ha salido " . $veces .
            " con un porcentaje de " . $porcentaje . "%<br />\n";
    }
}

//vista
function cabecera() {}
//vista
function cuerpo()
{



?>
<h2>LANZAMIENTO DE UN DADO</h2> 
<?php


// El controlador obtiene los arrays
$tiradas = lanzar6Veces();
$conteo  = contarCaras(N);

// Se muestra la página y se pasan los arrays a la vista como parámetros
inicioCabecera("PRACTICA");
finCabecera();

vistaDados($tiradas, $conteo, N);


}

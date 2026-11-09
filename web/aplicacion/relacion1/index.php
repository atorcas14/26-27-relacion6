<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ],
    [
        "TEXTO" => "Inicio",
        "LINK" => ""
    ]
];
//dibuja la plantilla de la vista
inicioCabecera("APLICACION RELACION 1");
cabecera();
finCabecera();
inicioCuerpo("Inicio Relación 1", $barraUbi);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{
?>
    <br><br>
    <ul>
        <li><a href="ejercicio1.php">Ejercicio1</a></li>
        <li><a href="ejercicio2.php">Ejercicio2</a></li>
        <li><a href="ejercicio3.php">Ejercicio3</a></li>
        <li><a href="ejercicio4.php">Ejercicio4</a></li>
        <li><a href="ejercicio5.php">Ejercicio5</a></li>
        <li><a href="ejercicio6.php">Ejercicio6</a></li>
        <li><a href="ejercicio7.php">Ejercicio7</a></li>
    </ul>
<?php
}

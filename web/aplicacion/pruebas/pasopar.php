<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador

//Datos basicos
$nombre ="Alberto";
$edad = 25;

$basicos = [
    "nombre"=>$nombre,
    "edad"=> $edad
];

//relleno otras 
$otras = rellenarOtras();


//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("PASO PARAMETROS");
cuerpo($basicos,$otras); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {
    ?>
    <!-- esto va en el head-->
     <?php
     
     }
     //vista
     function cuerpo($bas, $ot)
     {
         ?>
    <br><br>
    Elemento de pruebas
    <br><br>
    
    <?php
    echo "Mi nombre es {$bas["nombre"]} de {$bas["edad"]} años";
}


function rellenarOtras(){
    return "de 2º DAW";
}
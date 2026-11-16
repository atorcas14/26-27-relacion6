<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
$barra = [
    [
        "TEXTO" => "inicio",
        "ENLACE" => "/index.php"
    ],
    [
        "TEXTO" => "pruebas",
        "ENLACE" => "/aplicacion/pruebas/index.php",
    ],
    [
        "TEXTO" => "index",
    ]
];
//$usuario = getenv("MYSQL_USER");


//dibuja la plantilla de la vista
inicioCabecera("Mi aplicacion");
cabecera();
finCabecera();
inicioCuerpo("cargar pagina", $barra);
cuerpo();  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}

//vista
function cuerpo()
{
    $id=15;
?>
    <br><br>
    <h2>primera forma: enlace</h2>
    <a href="<?= "otrapagina.php?id=$id&nombre=alberto" ?>">Enlace a otra pagina</a>
    <br><br>
<form method="post"  action="otrapagina.php?id=<?=$id+5?>">
        <input type="hidden" name="id" value="<?= $id?>">        
        <select name="id" id="">
            <option value="1">Primero</option>
            <option value="2">Segundo</option>
            <option value="3">Tercero</option>
        </select>
        <label>nombre:</label>
        <input type="text" name="nombre" value="<?= $id?>">
        <br><br>
        <input type="submit" name="enviar" value="Enviar"> 
        <input type="submit" name="borrado" value="E1">
        <input type="submit" name="insertar" value="E3">

</form>


<?php


}

<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("2DAW APLICACION");
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
    Elemento de pruebas
    <br><br>
    <a href="basicas.php">Funcionamiento basico</a> <br> <br>
    <a href="../clases/curso2026/index.php">Curso2026</a><br><br>
    <a href="cadenas.php">Cadenas</a>
<?php
}

<?php
include_once(dirname(__FILE__) . "/../../../cabecera.php");
//controlador
$barra=[
    [
        "TEXTO"=>"inicio", 
        "ENLACE"=>"/index.php",
        "ADICIONAL"=> ">>"],
    [
        "TEXTO"=>"Curso2026"
    ],
    [
        "TEXTO"=>"index",
        "ADICIONAL"=>"&copy;&copy"
    ]
];
$usuario=getenv("MYSQL_USER");

//dibuja la plantilla de la vista
inicioCabecera("Curso2026");
cabecera();
finCabecera();
inicioCuerpo("Curso2026",$barra);
cuerpo();  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() 
{}

//vista
function cuerpo()
{
?>
    <br><br>
    Hola, estás en Index.php
    adios
    <a href="./aplicacion/pruebas/index.php">Acceso a pruebas</a>
<?php
}

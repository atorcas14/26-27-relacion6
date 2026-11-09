<?php
include_once(dirname(__FILE__) . "/cabecera.php");
//controlador
$barra=[
    [
        "TEXTO"=>"inicio", 
        "ENLACE"=>"/index.php",
        "ADICIONAL"=> ">>"],
    [
        "TEXTO"=>"otro"
    ],
    [
        "TEXTO"=>"index",
        "ADICIONAL"=>"&copy;&copy"
    ]
];
$usuario=getenv("MYSQL_USER");

//dibuja la plantilla de la vista
inicioCabecera("tienda");
cabecera();
finCabecera();
inicioCuerpo("TIENDA",$barra);
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

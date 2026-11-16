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

$id=0;
if (isset($_GET["id"]))
    {
        $id=intval($_GET["id"]);

    }
//compruebo que el id es correcto

$datos["id"]=$id;

$nombre="";
if (isset($_GET["nombre"]))
    {
        $id = intval(($_REQUEST["id"]));
        $nombre=mb_trim($_GET["nombre"]);
    }
//valido nombre
$datos["nombre"]=$nombre;


//dibuja la plantilla de la vista
inicioCabecera("Mi aplicacion");
cabecera();
finCabecera();
inicioCuerpo("otra pagina", $barra);
cuerpo($datos);  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}

//vista
function cuerpo(array $datos)
{
?>
    <br><br>
    Esta es la pagina cargada
    <br><br>
<?php
    //llllll

    echo "se ha recibido un id {$datos["id"]} y nombre {$datos["nombre"]}";

}
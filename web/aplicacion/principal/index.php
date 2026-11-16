<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "../../clases/curso2026/Muebles.php");
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

$muebles = dameMuebles();
$seleccion = 0;
$detalle = null;
$error = "";

if (isset($_POST["mostrar"])) {
    $s = postCadena("mueble");
    if (\VALNORMAL\validaEntero($s, 1, count($muebles), 0)) {
        $seleccion = $s;
        $detalle = propiedadesMueble($muebles[$s]);
    } else {
        $error = "Debe seleccionarse un mueble válido";
    }
}

//dibuja la plantilla de la vista
inicioCabecera("Curso2026");
cabecera();
finCabecera();
inicioCuerpo("Curso2026",$barra);
cuerpo($muebles, $seleccion, $detalle, $error);  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() 
{}

function mostrarTabla(array $muebles)
    {
        echo "<table border='1' cellpadding='4'>";
        echo "<tr><th>Índice</th><th>Tipo</th><th>Nombre</th><th>Fabricante</th><th>Año</th><th>Precio</th></tr>";
        foreach ($muebles as $i => $m) {
            echo "<tr><td>$i</td><td>" . esc(get_class($m)) . "</td><td>" . esc($m->getNombre())
                . "</td><td>" . esc($m->getFabricante()) . "</td><td>" . esc($m->getAnio())
                . "</td><td>" . esc($m->getPrecio()) . "</td></tr>";
                // . "</td><td>" . esc($m->getMaterial()) . "</td></tr>";
        }
        echo "</table>";
    }

function mostrarFormulario(array $muebles, int $seleccion)
    {
        echo "<form method='post' action='" . esc($_SERVER["PHP_SELF"]) . "'>";
        echo "<p><label>Mueble: <select name='mueble'>";
        foreach ($muebles as $i => $m) {
            $sel = ($i === $seleccion) ? " selected" : "";
            echo "<option value='$i'$sel>" . esc("$i - " . get_class($m) . " - " . $m->getNombre() . " (" . $m->getPrecio() . " €)") . "</option>";
        }
        echo "</select></label></p>";
        echo "<button type='submit' name='mostrar'>Mostrar Mueble</button> ";
        echo "<button type='submit' name='modificar' formaction='modificar.php' formtarget='_blank'>Modificar Mueble</button>";
        echo "</form>";
    }

function mostrarDetalle(array $detalle)
    {
        echo "<h3>Propiedades</h3>";
        foreach ($detalle["lineas"] as $etiqueta => $valor) {
            echo "<strong>" . esc($etiqueta) . ":</strong> " . esc(textoValor($valor)) . "<br>";
        }
        echo "<h3>Características</h3>";
        if (!$detalle["caracteristicas"]) {
            echo "Sin características<br>";
        }
        foreach ($detalle["caracteristicas"] as $nombre => $valor) {
            echo "<strong>" . esc($nombre) . ":</strong> " . esc(textoValor($valor)) . "<br>";
        }
    }


//vista
function cuerpo($muebles, $seleccion, $detalle, $error)
{
    echo "<p><a href='/aplicacion/principal/pruebas.php'>Ir a pruebas.php</a></p>";

    echo "<h2>Muebles</h2>";
    mostrarTabla($muebles);
    echo "<h2>Seleccionar mueble</h2>";
    mostrarFormulario($muebles, $seleccion);
    if ($error !== "") {
        echo "<p style='color:#b00020'>" . esc($error) . "</p>";
    }
    if ($detalle !== null) {
        mostrarDetalle($detalle);
    }

}

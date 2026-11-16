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
        "TEXTO"=>"Modificar"
    ],
    [
        "TEXTO"=>"index",
        "ADICIONAL"=>"&copy;&copy"
    ]
];
$usuario=getenv("MYSQL_USER");

$muebles = dameMuebles();
$mueble = null;
$id = 0;
$errores = [];
$guardado = false;
$datos = [];

$idPost = postCadena("mueble");
if (\VALNORMAL\validaEntero($idPost, 1, count($muebles), 0)) {
    $id = $idPost;
    $mueble = $muebles[$id];

    // Datos iniciales: los del mueble
    $datos = [
        "nombre" => $mueble->getNombre(),
        "fabricante" => $mueble->getFabricante(),
        "pais" => $mueble->getPais(),
        "anio" => $mueble->getAnio(),
        "fechaIni" => $mueble->getFechaIniVenta(),
        "fechaFin" => $mueble->getFechaFinVenta(),
        "precio" => $mueble->getPrecio(),
    ];
    $adicionales = $mueble->damePropiedadesAdicionales();
    foreach ($adicionales as $n) {
        $getter = "get" . ucfirst($n);
        $datos[$n] = $mueble->$getter();
    }

    if (isset($_POST["guardar"])) {
        foreach (array_keys($datos) as $campo) {
            $datos[$campo] = postCadena($campo);
        }

        // ---- Mitad 1: instancia auxiliar y métodos set ----
        $clase = get_class($mueble);
        $aux = new $clase("AUX");

        if ($aux->setNombre($datos["nombre"])) $datos["nombre"] = $aux->getNombre();
        else $errores["nombre"][] = "Nombre obligatorio, máximo 40 caracteres";

        if ($aux->setFabricante($datos["fabricante"])) $datos["fabricante"] = $aux->getFabricante();
        else $errores["fabricante"][] = "Fabricante no válido";

        if ($aux->setPais($datos["pais"])) $datos["pais"] = $aux->getPais();
        else $errores["pais"][] = "País: máximo 20 caracteres";

        if ($aux->setAnio($datos["anio"])) $datos["anio"] = $aux->getAnio();
        else $errores["anio"][] = "Año entre 2020 y " . date("Y");

        if ($aux->setFechaIniVenta($datos["fechaIni"])) $datos["fechaIni"] = $aux->getFechaIniVenta();
        else $errores["fechaIni"][] = "Fecha dd/mm/aaaa, no anterior al 1 de enero del año de fabricación";

        if ($aux->setFechaFinVenta($datos["fechaFin"])) $datos["fechaFin"] = $aux->getFechaFinVenta();
        else $errores["fechaFin"][] = "Fecha dd/mm/aaaa, no anterior a la fecha de inicio";

        // ---- Mitad 2: condiciones directas ----
        $datos["precio"] = str_replace(",", ".", trim($datos["precio"]));
        if (!is_numeric($datos["precio"]) || (float)$datos["precio"] < 30) {
            $errores["precio"][] = "El precio debe ser un número no menor de 30";
        }

        foreach ($adicionales as $n) {
            $v = trim($datos[$n]);
            if ($n === "porcentajeReciclado") {
                if (!ctype_digit($v) || (int)$v > 100) {
                    $errores[$n][] = "El porcentaje debe ser un entero entre 0 y 100";
                }
            } elseif ($n === "peso") {
                $v = str_replace(",", ".", $v);
                if (!is_numeric($v) || (float)$v < 15 || (float)$v > 300) {
                    $errores[$n][] = "El peso debe estar entre 15 y 300";
                }
            } elseif ($n === "serie") {
                if ($v === "") {
                    $errores[$n][] = "La serie no puede estar vacía";
                }
            }
            $datos[$n] = $v;
        }

        // ---- Todo correcto: se actualiza el mueble real ----
        if (!$errores) {
            $mueble->setNombre($datos["nombre"]);
            $mueble->setFabricante($datos["fabricante"]);
            $mueble->setPais($datos["pais"]);
            $mueble->setAnio($datos["anio"]);
            $mueble->setFechaIniVenta($datos["fechaIni"]);
            $mueble->setFechaFinVenta($datos["fechaFin"]);
            $mueble->setPrecio($datos["precio"]);
            foreach ($adicionales as $n) {
                $setter = "set" . ucfirst($n);
                $mueble->$setter($datos[$n]);
            }
            $guardado = true;
        }
    }
}

//dibuja la plantilla de la vista
inicioCabecera("Modificar");
cabecera();
finCabecera();
inicioCuerpo("Modificar",$barra);
cuerpo($mueble, $id, $datos, $errores,$guardado);  //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() 
{}

function campoTexto(string $etiqueta, string $campo, array $datos, array $errores)
{
    echo "<p><label>" . esc($etiqueta) . ": <input type='text' name='$campo' value='" . esc($datos[$campo]) . "'></label><br>";
    if (isset($errores[$campo])) {
        foreach ($errores[$campo] as $e) {
            echo "<span style='color:#b00020'>" . esc($e) . "</span><br>";
        }
    }
    echo "</p>";
}

function mostrarFormularioModificar(MuebleBase $mueble, int $id, array $datos, array $errores)
{
    echo "<form method='post' action='" . esc($_SERVER["PHP_SELF"]) . "'>";
    echo "<input type='hidden' name='mueble' value='$id'>";
    echo "<p>Tipo: <strong>" . esc(get_class($mueble)) . "</strong></p>";

    campoTexto("Nombre", "nombre", $datos, $errores);
    campoTexto("Fabricante", "fabricante", $datos, $errores);
    campoTexto("País", "pais", $datos, $errores);
    campoTexto("Año", "anio", $datos, $errores);
    campoTexto("Inicio de venta (dd/mm/aaaa)", "fechaIni", $datos, $errores);
    campoTexto("Fin de venta (dd/mm/aaaa)", "fechaFin", $datos, $errores);
    campoTexto("Precio", "precio", $datos, $errores);
    foreach ($mueble->damePropiedadesAdicionales() as $n) {
        campoTexto($n, $n, $datos, $errores);
    }

    echo "<p><input type='submit' name='guardar' value='Guardar cambios'></p>";
    echo "</form>";
}

function mostrarResumenModificado(MuebleBase $mueble)
{
    $detalle = propiedadesMueble($mueble);
    echo "<h3>Datos guardados</h3>";
    foreach ($detalle["lineas"] as $etiqueta => $valor) {
        echo "<strong>" . esc($etiqueta) . ":</strong> " . esc(textoValor($valor)) . "<br>";
    }
    echo "<h3>Características</h3>";
    foreach ($detalle["caracteristicas"] as $nombre => $valor) {
        echo "<strong>" . esc($nombre) . ":</strong> " . esc(textoValor($valor)) . "<br>";
    }
}


//vista
function cuerpo($mueble, $id, $datos, $errores, $guardado)
{

    echo "<h2>Modificar mueble</h2>";
    if ($mueble === null) {
        echo "<p style='color:#b00020'>No se ha indicado un mueble válido.</p>";
    } elseif ($guardado) {
        mostrarResumenModificado($mueble);
    } else {
        mostrarFormularioModificar($mueble, $id, $datos, $errores);
    }
    echo "<p><a href='/aplicacion/principal/index.php'>Ir a Index.php</a></p>";


}

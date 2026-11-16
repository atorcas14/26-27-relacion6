<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
include_once(dirname(__FILE__) . "/../../scripts/librerias/val_normal.php");
include_once(dirname(__FILE__) . "/../clases/curso2026/Caracteristicas.php"); //Caracteristicas
include_once(dirname(__FILE__) . "/../clases/curso2026/MuebleBase.php"); //MuebleBase
include_once(dirname(__FILE__) . "/../clases/curso2026/MuebleReciclado.php"); //MuebleReciclado
include_once(dirname(__FILE__) . "/../clases/curso2026/MuebleTradicional.php"); //MuebleTradicional
//controlador
$barraUbi = [
    ["TEXTO" => "Inicio", "LINK" => "/index.php"],
    ["TEXTO" => "Principal", "LINK" => ""]
];

// Ejecuta algo que debe fallar y devuelve el error capturado
function t_error(callable $f): string
{
    try {
        $f();
        return "SIN ERROR (no era lo esperado)";
    } catch (Throwable $e) {
        return "Error esperado (" . get_class($e) . "): " . $e->getMessage();
    }
}

function t_v($valor): string
{
    return var_export($valor, true);
}

$pruebas = [];

// =============== 1) Caracteristicas (objeto suelto) ===============
$l = [];
$c = new Caracteristicas();
$c->color = "rojo";
$c->ancho = 50;
$c->saliente = true;
$l[] = "Creadas color, ancho y saliente. count = " . count($c);
$l[] = "toString: " . $c;
$l[] = "Lectura: color = " . $c->color . ", ancho = " . $c->ancho;

$c->ancho = 60;
$l[] = "Modificar ancho (conserva su posición): " . $c;

$texto = [];
foreach ($c as $nombre => $valor) { $texto[] = $nombre . "=" . (is_bool($valor) ? t_v($valor) : $valor); }
$l[] = "foreach (orden inverso): " . implode(", ", $texto);

$l[] = "isset(color): " . t_v(isset($c->color)) . " | isset(noExiste): " . t_v(isset($c->noExiste));
unset($c->color);
$l[] = "Tras unset(color): " . $c . " (count " . count($c) . ")";
$l[] = "Leer característica inexistente: " . t_error(fn() => $c->noExiste);

$c->ULTIMA = "fin";
$l[] = "Se indica ULTIMA: " . $c;
$l[] = "Nueva característica tras ULTIMA: " . t_error(function () use ($c) { $c->nueva = 1; });
$c->ancho = 99;
$l[] = "Modificar una existente tras ULTIMA (permitido): ancho = " . $c->ancho;
$l[] = "Eliminar ULTIMA: " . t_error(function () use ($c) { unset($c->ULTIMA); });
$l[] = "Estado final: " . $c;
$pruebas["1) Caracteristicas"] = $l;

// =============== 2) MuebleReciclado ===============
$l = [];
$m1 = new MuebleReciclado("silla eco", "Verde", "Francia", 2021, "01/06/2021", "31/12/2035", 80, 60);
$l[] = "m1: " . $m1;
$l[] = "damePropiedadesAdicionales: " . implode(", ", $m1->damePropiedadesAdicionales());
$l[] = "Getters: " . $m1->getNombre() . " | " . $m1->getFabricante() . " | " . $m1->getPais() . " | "
     . $m1->getAnio() . " | " . $m1->getFechaIniVenta() . " | " . $m1->getFechaFinVenta() . " | "
     . $m1->getPrecio() . " | " . $m1->getPorcentajeReciclado();

$l[] = "setNombre('sofá'): " . t_v($m1->setNombre("sofá")) . " -> " . $m1->getNombre();
$l[] = "setNombre(''): " . t_v($m1->setNombre("")) . " -> sigue " . $m1->getNombre();
$l[] = "setNombre(41 caracteres): " . t_v($m1->setNombre(str_repeat("a", 41))) . " -> sigue " . $m1->getNombre();
$l[] = "setFabricante('Ikea'): " . t_v($m1->setFabricante("Ikea")) . " -> " . $m1->getFabricante();
$l[] = "setFabricante('FaMu:Ikea'): " . t_v($m1->setFabricante("FaMu:Ikea")) . " -> " . $m1->getFabricante();
$l[] = "setPais('Italia'): " . t_v($m1->setPais("Italia")) . " -> " . $m1->getPais();
$l[] = "setPais(21 caracteres): " . t_v($m1->setPais(str_repeat("p", 21))) . " -> sigue " . $m1->getPais();
$l[] = "setAnio(2019): " . t_v($m1->setAnio(2019)) . " -> sigue " . $m1->getAnio();
$l[] = "setAnio(2022): " . t_v($m1->setAnio(2022)) . " -> " . $m1->getAnio();
$l[] = "setAnio(2021): " . t_v($m1->setAnio(2021)) . " -> " . $m1->getAnio();
$l[] = "setFechaIniVenta('31/12/2020'): " . t_v($m1->setFechaIniVenta("31/12/2020")) . " -> sigue " . $m1->getFechaIniVenta();
$l[] = "setFechaIniVenta('1/2/2021'): " . t_v($m1->setFechaIniVenta("1/2/2021")) . " -> " . $m1->getFechaIniVenta();
$l[] = "setFechaFinVenta('01/01/2000'): " . t_v($m1->setFechaFinVenta("01/01/2000")) . " -> sigue " . $m1->getFechaFinVenta();
$l[] = "setFechaFinVenta('30/06/2030'): " . t_v($m1->setFechaFinVenta("30/06/2030")) . " -> " . $m1->getFechaFinVenta();
$l[] = "setPrecio(10): " . t_v($m1->setPrecio(10)) . " -> sigue " . $m1->getPrecio();
$l[] = "setPrecio(99.5): " . t_v($m1->setPrecio(99.5)) . " -> " . $m1->getPrecio();
$l[] = "setPorcentajeReciclado(101): " . t_v($m1->setPorcentajeReciclado(101)) . " -> sigue " . $m1->getPorcentajeReciclado();
$l[] = "setPorcentajeReciclado(75): " . t_v($m1->setPorcentajeReciclado(75)) . " -> " . $m1->getPorcentajeReciclado();
$l[] = "m1 tras los set: " . $m1;
$pruebas["2) MuebleReciclado"] = $l;

// =============== 3) MuebleTradicional ===============
$l = [];
$m2 = new MuebleTradicional("armario", "Roble", "Portugal", 2022, "01/01/2022", "31/12/2040", 300, 120.5, "A7");
$l[] = "m2: " . $m2;
$l[] = "damePropiedadesAdicionales: " . implode(", ", $m2->damePropiedadesAdicionales());
$l[] = "Getters: peso " . $m2->getPeso() . " | serie " . $m2->getSerie();
$l[] = "setPeso(10): " . t_v($m2->setPeso(10)) . " -> sigue " . $m2->getPeso();
$l[] = "setPeso(301): " . t_v($m2->setPeso(301)) . " -> sigue " . $m2->getPeso();
$l[] = "setPeso(100): " . t_v($m2->setPeso(100)) . " -> " . $m2->getPeso();
$l[] = "setSerie(''): " . t_v($m2->setSerie("")) . " -> sigue " . $m2->getSerie();
$l[] = "setSerie('Z9'): " . t_v($m2->setSerie("Z9")) . " -> " . $m2->getSerie();
$l[] = "m2 tras los set: " . $m2;
$pruebas["3) MuebleTradicional"] = $l;

// =============== 4) Valores por defecto en el constructor ===============
$l = [];
$m3 = new MuebleReciclado("banco", "", "ESPAÑA", 1999, "01/01/2000", "01/01/1990", 5, 150);
$l[] = "m3 (año, fechas, precio y % inválidos -> defectos): " . $m3;
$m4 = new MuebleTradicional("cajonera", "FaMu:Roble", "ESPAÑA", 2020, "01/01/2020", "31/12/2040", 50, 500, "");
$l[] = "m4 (peso y serie inválidos -> defectos): " . $m4;
$l[] = "Nombre vacío en el constructor: " . t_error(fn() => new MuebleReciclado("   "));
$pruebas["4) Valores por defecto"] = $l;

// =============== 5) Sin propiedades dinámicas ===============
$l = [];
$l[] = "Asignar propiedad nueva: " . t_error(function () use ($m1) { $m1->color = "rojo"; });
$l[] = "Leer propiedad privada: " . t_error(fn() => $m1->nombre);
$l[] = "Leer propiedad privada de la hija: " . t_error(fn() => $m2->peso);
$l[] = "Es final MuebleReciclado: " . t_v((new ReflectionClass('MuebleReciclado'))->isFinal());
$l[] = "Es final MuebleTradicional: " . t_v((new ReflectionClass('MuebleTradicional'))->isFinal());
$l[] = "Es abstracta MuebleBase: " . t_v((new ReflectionClass('MuebleBase'))->isAbstract());
$pruebas["5) Sin sobrecarga dinámica"] = $l;

// =============== 6) Características en los muebles ===============
$l = [];
$n = $m1->anadirCaracteristicas('saliente', true, 'precio', 300);
$l[] = "anadirCaracteristicas('saliente', true, 'precio', 300) -> $n añadidas";
$n = $m1->anadirCaracteristicas('color', 'rojo', 'huerfano');
$l[] = "anadirCaracteristicas('color', 'rojo', 'huerfano') -> $n añadida (el último, impar, se desecha)";
$l[] = "huerfano existe: " . t_v(isset($m1->getCaracteristicas()->huerfano));
$l[] = "getCaracteristicas() es un objeto Caracteristicas: " . t_v($m1->getCaracteristicas() instanceof Caracteristicas);
$l[] = "Características: " . $m1->getCaracteristicas();

$texto = [];
foreach ($m1->getCaracteristicas() as $nombre => $valor) { $texto[] = $nombre; }
$l[] = "foreach (orden inverso): " . implode(", ", $texto);

$m1->anadirCaracteristicas('precio', 350);
$l[] = "Modificar 'precio' con anadirCaracteristicas: " . $m1->getCaracteristicas()->precio;
$m1->getCaracteristicas()->precio = 400;
$l[] = "Modificar 'precio' con el objeto: " . $m1->getCaracteristicas()->precio;

$l[] = "Nombre no válido: " . t_error(fn() => $m1->anadirCaracteristicas(5, "x"));
$l[] = "Mueble sin características no las muestra: " . t_v(!str_contains((string)$m2, "características"));

$m2->anadirCaracteristicas('patas', 4, 'ULTIMA', 'fin');
$l[] = "m2 con ULTIMA: " . $m2;
$l[] = "Añadir una nueva tras ULTIMA: " . t_error(fn() => $m2->anadirCaracteristicas('nueva', 1));
$m2->anadirCaracteristicas('patas', 6);
$l[] = "Modificar una existente tras ULTIMA: patas = " . $m2->getCaracteristicas()->patas;
$l[] = "m1 final: " . $m1;
$pruebas["6) Características en el mueble"] = $l;

// =============== 7) Límite de instancias y puedeCrear ===============
$l = [];
$puede = MuebleBase::puedeCrear($quedan);
$l[] = "Creados 4 de " . MuebleBase::MAXIMO_MUEBLES . ". puedeCrear: " . t_v($puede) . ", quedan $quedan";
$m5 = new MuebleTradicional("estante");
$l[] = "m5 con valores por defecto: " . $m5;
$puede = MuebleBase::puedeCrear($quedan);
$l[] = "Tras crear m5. puedeCrear: " . t_v($puede) . ", quedan $quedan";
$l[] = "Crear uno más: " . t_error(fn() => new MuebleReciclado("de más"));
$pruebas["7) Límite de instancias"] = $l;

//dibuja la plantilla de la vista
inicioCabecera("PRUEBAS");
cabecera();
finCabecera();
inicioCuerpo("Pruebas", $barraUbi);
cuerpo($pruebas);
finCuerpo();

// **********************************************************

//vista
function cabecera() {}

//vista
function cuerpo($pruebas)
{
    echo "<p><a href='/aplicacion/principal/index.php'>Ir a formulario</a></p><br>";
    echo "<pre style='white-space:pre-wrap'>";
    foreach ($pruebas as $titulo => $lineas) {
        echo "<strong>" . ($titulo) . "</strong>\n";
        foreach ($lineas as $linea) {
            echo $linea . "\n";
        }
        echo "\n";
    }
    echo "</pre>";
}
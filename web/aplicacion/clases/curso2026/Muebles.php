<?php
include_once(dirname(__FILE__) . "../../../../scripts/librerias/val_normal.php"); 
include_once(dirname(__FILE__) . "../../curso2026/Caracteristicas.php"); 
include_once(dirname(__FILE__) . "../../curso2026/MuebleBase.php"); 
include_once(dirname(__FILE__) . "../../curso2026/MuebleReciclado.php"); 
include_once(dirname(__FILE__) . "../../curso2026/MuebleTradicional.php"); 

// Único punto donde se definen los muebles. Índices desde 1.
function dameMuebles(): array
{
    static $muebles = null;   // se conserva entre llamadas de la misma petición

    if ($muebles === null) {
        $m1 = new MuebleReciclado("silla eco", "Verde", "Francia", 2021, "01/06/2021", "31/12/2035", 80,60); //Materiales::Aluminio,60);
        $m1->anadirCaracteristicas("color", "verde", "apilable", true);

        $m2 = new MuebleTradicional("armario", "Roble", "Portugal", 2022, "01/03/2022", "31/12/2040", 300, 120.5, "A7");
        $m2->anadirCaracteristicas("puertas", 3, "material", "roble");

        $m3 = new MuebleReciclado("banco de jardín", "Eco", "ESPAÑA", 2023, "15/05/2023", "31/12/2038", 150,85);// Materiales::Madera,85);
        $m3->anadirCaracteristicas("longitud", 150, "exterior", true);

        $m4 = new MuebleTradicional("cómoda", "Pino", "ESPAÑA", 2020, "01/01/2020", "31/12/2040", 220, 80, "B2");
        $m4->anadirCaracteristicas("cajones", 4, "acabado", "barnizado");

        $m5 = new MuebleReciclado("estantería", "Reutil", "Italia", 2024, "01/02/2024", "31/12/2040", 95,40);//Materiales::Hierro ,40);
        $m5->anadirCaracteristicas("baldas", 5, "montaje", "fácil");

        $muebles = [1 => $m1, 2 => $m2, 3 => $m3, 4 => $m4, 5 => $m5];
    }
    return $muebles;
}
    function esc($texto): string
    {   
        return $texto;
    }

function postCadena(string $clave): string
    {
        return (isset($_POST[$clave]) && is_string($_POST[$clave])) ? $_POST[$clave] : "";
    }

function textoValor($valor): string
    {
        if (is_bool($valor)) return $valor ? "true" : "false";
        if (is_array($valor)) return json_encode($valor);
        return (string)$valor;
    }

// Propiedades sin usar __toString: getters + damePropiedadesAdicionales
function propiedadesMueble(MuebleBase $m): array
    {
        $lineas = [
            "Clase" => get_class($m),
            "Nombre" => $m->getNombre(),
            "Fabricante" => $m->getFabricante(),
            "País" => $m->getPais(),
            "Año de fabricación" => $m->getAnio(),
            "Inicio de venta" => $m->getFechaIniVenta(),
            "Fin de venta" => $m->getFechaFinVenta(),
            "Precio" => $m->getPrecio(),
            // "Material" => $m->getMaterialDescripcion(),
        ];
        foreach ($m->damePropiedadesAdicionales() as $nombre) {
            $getter = "get" . ucfirst($nombre);
            $lineas[$nombre] = $m->$getter();
        }
        $caracteristicas = [];
        foreach ($m->getCaracteristicas() as $nombre => $valor) {
            $caracteristicas[$nombre] = $valor;
        }
        return ["lineas" => $lineas, "caracteristicas" => $caracteristicas];
    }

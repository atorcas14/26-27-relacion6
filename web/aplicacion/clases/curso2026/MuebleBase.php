<?php

abstract class MuebleBase{
    //Constante
    // private const $MAXIMO_MUEBLES=0;

    // Variable de clase
    private static $mueblesCreados=0;

    //Variables
    protected string $nombre;
    protected string $fabricante = "FaMu";
    protected string $pais = "ESPAÑA";
    protected int $anio = 2020;
    protected string $fechaIniVenta;
    protected string $fechaFinVenta;
    protected string $precio;
}
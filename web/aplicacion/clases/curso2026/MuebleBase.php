<?php

abstract class MuebleBase{
    //Constante
    // private const $MAXIMO_MUEBLES=0;

    // Variable de clase
    private static $mueblesCreados=0;

    //Variables
    protected string $_nombre;
    protected string $_fabricante = "FaMu";
    protected string $_pais = "ESPAÑA";
    protected int $_anio = 2020;
    protected string $_fechaIniVenta;
    protected string $_fechaFinVenta;
    protected float $_precio;

    /**
     * Funcion para el constructor
     *
     * @param string $nombre
     * @param string $fabricante
     * @param string $pais
     * @param integer $anio
     * @param string $fechaIniVenta
     * @param string $fechaFinVenta
     * @param float $precio
     */
    public function __construct(string $nombre, string $fabricante="FaMu",string $pais="ESPAÑA",
                                int $anio=2020,string $fechaIniVenta,string $fechaFinVenta, float $precio){
        $this -> _nombre = $nombre;
        $this -> _fabricante = $fabricante;
        $this -> _pais = $pais;
        $this -> _anio = $anio;
        $this -> _fechaIniVenta = $fechaIniVenta;
        $this -> _fechaFinVenta = $fechaFinVenta;
        $this -> _precio = $precio;
    }
}
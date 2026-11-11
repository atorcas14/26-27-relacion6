<?php
include_once(dirname(__FILE__)."../../../../scripts/librerias/val_normal.php");

final class MuebleReciclado extends MuebleBase{

    //Variable
    private int $porcentajeReciclado = 10;

    /**
     * Constructor
     *
     * @param string $nombre
     * @param string $fabricante
     * @param string $pais
     * @param integer $anio
     * @param string $fechaIniVenta
     * @param string $fechaFinVenta
     * @param float $precio
     * @param integer $porcentajeReciclado
     */
    #[Override]
    public function __construct(string $nombre, string $fabricante = "FaMu:", string $pais = "ESPAÑA", 
                                int $anio = 2020, string $fechaIniVenta = "01/01/2020", 
                                string $fechaFinVenta = "31/12/2040", float $precio = 30.0, int $porcentajeReciclado=10){
        parent::__construct($nombre, $fabricante, $pais, $anio, $fechaIniVenta, $fechaFinVenta, $precio);
        if(!$this-> setPorcentajeReciclado($porcentajeReciclado)){
            $this -> porcentajeReciclado=10;
        }
    }

    //Getter's and setter's
        public function getPorcentajeReciclado(): int
    {
        return $this->porcentajeReciclado;
    }

    public function setPorcentajeReciclado(mixed $porcentaje): bool
    {
        $v = $porcentaje;
        if (!\VALNORMAL\validaEntero($v, 0, 100, 10)) {
            return false;
        }
        $this->porcentajeReciclado = $v;
        return true;
    }
    
    /**
     * Redefinicion del metodo que devuelve un array
     *
     * @return array
     */
    #[Override]
    public function damePropiedadesAdicionales(): array
    {
        return ["porcentajeReciclado"];
    }

    /**
     * Redefinicion de toString
     *
     * @return string
     */
    #[Override]
    public function __toString(): string
    {
        return parent::__toString(). ", porcentaje reciclado ". $this->porcentajeReciclado;
    }
}
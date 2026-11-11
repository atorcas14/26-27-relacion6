<?php
include_once(dirname(__FILE__)."../../../../scripts/librerias/val_normal.php");

final class MuebleTradicional extends MuebleBase{
    private float $peso = 15.0;
    private string $serie = "S01";

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
     * @param float $peso
     * @param string $serie
     */
    public function __construct(string $nombre,string $fabricante = "FaMu:",string $pais = "ESPAÑA",
                                int $anio = 2020,string $fechaIniVenta = "01/01/2020",
                                string $fechaFinVenta = "31/12/2040",float $precio = 30.0,
                                float $peso = 15.0,string $serie = "S01") {
        parent::__construct($nombre, $fabricante, $pais, $anio, $fechaIniVenta, $fechaFinVenta, $precio);

        if (!$this->setPeso($peso)) {
            $this->peso = 15.0;
        }
        if (!$this->setSerie($serie)) {
            $this->serie = "S01";
        }
    }

    //Getter's and setter's 
    public function getPeso(): float
    {
        return $this->peso;
    }

    public function setPeso(mixed $peso): bool
    {
        $v = $peso;
        if (!\VALNORMAL\validaEntero($v, 15.0, 300.0, 15.0)) {
            return false;
        }
        $this->peso = $v;
        return true;
    }

    public function getSerie(): string
    {
        return $this->serie;
    }

    public function setSerie(string $serie): bool
    {
        $v = trim($serie);
        // El enunciado no limita la serie: solo se exige que no esté vacía
        if ($v === "") {
            return false;
        }
        $this->serie = $v;
        return true;
    }

    /**
     * Redefinicion de la funcion que devuelve un array
     *
     * @return array
     */
    public function damePropiedadesAdicionales(): array
    {
        return ["peso", "serie"];
    }

    /**
     * Redefinicion de toString
     *
     * @return string
     */
    public function __toString(): string
    {
        return parent::__toString() . ", peso " . $this->peso . ", serie " . $this->serie;
    }
}
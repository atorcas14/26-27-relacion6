<?php
include_once(dirname(__FILE__)."../../../../scripts/librerias/val_normal.php");

abstract class MuebleBase{
    
    const MAXIMO_MUEBLES=5;
    
    private static int $mueblesCreados = 0;

    // Propiedades (privadas: solo con set/get)
    private string $nombre = "";
    private string $fabricante = "FaMu:";
    private string $pais = "ESPAÑA";
    private int $anio = 2020;
    private string $fechaIniVenta = "01/01/2020";
    private string $fechaFinVenta = "31/12/2040";
    private float $precio = 30.0;

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
     */
    public function __construct(string $nombre,string $fabricante = "FaMu:",string $pais = "ESPAÑA",
                                int $anio = 2020,string $fechaIniVenta = "01/01/2020",string $fechaFinVenta = "31/12/2040",
                                float $precio = 30.0) {
        // Límite de instancias
        if (self::$mueblesCreados >= self::MAXIMO_MUEBLES) {
            throw new Exception("No se pueden crear más de " . self::MAXIMO_MUEBLES . " muebles");
        }

        // El nombre es obligatorio: si falla, error
        if (!$this->setNombre($nombre)) {
            throw new InvalidArgumentException("El nombre del mueble no es válido");
        }

        // Resto de campos: si falla el set, valor por defecto
        if (!$this->setFabricante($fabricante)) $this->fabricante = "FaMu:";
        if (!$this->setPais($pais)) $this->pais = "ESPAÑA";
        if (!$this->setAnio($anio)) $this->anio = 2020;

        // Si falla, "01/01/anio" (el año ya está asignado)
        if (!$this->setFechaIniVenta($fechaIniVenta)) {
            $this->fechaIniVenta = "01/01/" . $this->anio;
        }
        if (!$this->setFechaFinVenta($fechaFinVenta)) $this->fechaFinVenta = "31/12/2040";
        if (!$this->setPrecio($precio)) $this->precio = 30.0;

        self::$mueblesCreados++;   // solo cuenta si se ha creado bien
    }

    // ---------- Sin sobrecarga dinámica de propiedades ----------
    //Getter's and setter's
    public function __set(string $nombre, mixed $valor): void
    {
        throw new Error("No se pueden crear ni asignar propiedades dinámicas: $nombre");
    }

    public function __get(string $nombre): mixed
    {
        throw new Error("Propiedad inaccesible o inexistente: $nombre");
    }

    // ---------- Nombre ----------
    public function getNombre(): string { return $this->nombre; }

    public function setNombre(string $nombre): bool
    {
        $v = mb_strtoupper(trim($nombre));
        if ($v === "" || !\VALNORMAL\validaCadena($v, 40, "")) {
            return false;
        }
        $this->nombre = $v;
        return true;
    }

    // ---------- Fabricante ----------
    public function getFabricante(): string { return $this->fabricante; }

    public function setFabricante(string $fabricante): bool
    {
        $v = trim($fabricante);
        if (!str_starts_with($v, "FaMu:")) {
            $v = "FaMu:" . $v;
        }
        $this->fabricante = mb_substr($v, 0, 30);   // se recorta a 30
        return true;
    }

    // ---------- País ----------
    public function getPais(): string { return $this->pais; }

    public function setPais(string $pais): bool
    {
        $v = trim($pais);
        if (!\VALNORMAL\validaCadena($v, 20, "")) {
            return false;
        }
        $this->pais = $v;
        return true;
    }

    // ---------- Año ----------
    public function getAnio(): int { return $this->anio; }

    public function setAnio(mixed $anio): bool
    {
        $v = $anio;
        if (!\VALNORMAL\validaEntero($v, 2020, (int)date("Y"), 2020)) {
            return false;
        }
        $this->anio = $v;
        return true;
    }

    // ---------- Fecha inicio de venta ----------
    public function getFechaIniVenta(): string { return $this->fechaIniVenta; }

    public function setFechaIniVenta(string $fecha): bool
    {
        $v = $fecha;
        if (!\VALNORMAL\validaFecha($v, "")) {
            return false;
        }
        // No puede ser anterior al 1 de enero del año de fabricación
        $ini = DateTime::createFromFormat('!d/m/Y', $v);
        $minimo = DateTime::createFromFormat('!d/m/Y', "01/01/" . $this->anio);
        if ($ini < $minimo) {
            return false;
        }
        $this->fechaIniVenta = $v;   // ya viene saneada (dd/mm/aaaa)
        return true;
    }

    // ---------- Fecha fin de venta ----------
    public function getFechaFinVenta(): string { return $this->fechaFinVenta; }

    public function setFechaFinVenta(string $fecha): bool
    {
        $v = $fecha;
        if (!\VALNORMAL\validaFecha($v, "")) {
            return false;
        }
        $fin = DateTime::createFromFormat('!d/m/Y', $v);
        $ini = DateTime::createFromFormat('!d/m/Y', $this->fechaIniVenta);
        if ($fin < $ini) {
            return false;
        }
        $this->fechaFinVenta = $v;
        return true;
    }

    // ---------- Precio ----------
    public function getPrecio(): float { return $this->precio; }

    public function setPrecio(mixed $precio): bool
    {
        $v = $precio;
        // Mínimo 30; el máximo es solo un tope técnico
        if (!\VALNORMAL\validaReal($v, 30.0, 999999999.0, 30.0)) {
            return false;
        }
        $this->precio = $v;
        return true;
    }

    /**
     * Funcion que lo redefinen las clases hijas con las propiedades necesarias
     *
     * @return array
     */
    public function damePropiedadesAdicionales(): array
    {
        return [];
    }

    /**
     * Funcion que devuelve si se pueden crear mas muebles
     *
     * @param [type] $numero
     * @return boolean
     */
    public static function puedeCrear(&$numero): bool
    {
        $numero = self::MAXIMO_MUEBLES - self::$mueblesCreados;
        return $numero > 0;
    }

    /**
     * Funcion que muestra todos los elementos
     */
    public function __toString(): string
    {
        return "MUEBLE de clase " . get_class($this)
            . " con nombre " . $this->nombre
            . ", fabricante " . $this->fabricante
            . ", fabricado en " . $this->pais
            . " a partir del año " . $this->anio
            . ", vendido desde " . $this->fechaIniVenta
            . " hasta " . $this->fechaFinVenta
            . ", precio " . $this->precio;
    }
}
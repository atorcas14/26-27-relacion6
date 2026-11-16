<?php
class Caracteristicas implements IteratorAggregate, Countable{

    private array $_props = [];          
    private bool $_bloqueada = false;    

    // Crear o modificar una característica
    public function __set(string $nombre, mixed $valor): void
    {
        if (!array_key_exists($nombre, $this->_props)) {
            // Es nueva: no se admite si ya se indicó ULTIMA
            if ($this->_bloqueada) {
                throw new Exception("No se puede añadir la característica $nombre: ya se indicó ULTIMA");
            }
            if ($nombre === "ULTIMA") {
                $this->_bloqueada = true;
            }
        }
        $this->_props[$nombre] = $valor;   // si ya existía, conserva su posición
    }

    public function __get(string $nombre): mixed
    {
        if (!array_key_exists($nombre, $this->_props)) {
            throw new Exception("La característica $nombre no existe");
        }
        return $this->_props[$nombre];
    }

    public function __isset(string $nombre): bool
    {
        return isset($this->_props[$nombre]);
    }

    public function __unset(string $nombre): void
    {
        if ($nombre === "ULTIMA") {
            throw new Exception("La característica ULTIMA no se puede eliminar");
        }
        unset($this->_props[$nombre]);
    }

    // foreach: orden inverso al de incorporación
    public function getIterator(): Generator
    {
        foreach (array_reverse($this->_props, true) as $nombre => $valor) {
            yield $nombre => $valor;
        }
    }

    public function count(): int
    {
        return count($this->_props);
    }

    /**
     * Funcion para crear el numero de serie
     *
     * @return integer
     */
    public function numero_serie():int{
        $num = rand(0,999999999999999);
        return $num;
    }

    /**
     * Funcion de toString
     *
     * @return string
     */
    public function __toString(): string
    {
        $partes = [];
        foreach ($this->_props as $nombre => $valor) {
            if (is_bool($valor)) {
                $texto = $valor ? "true" : "false";
            } elseif (is_array($valor)) {
                $texto = json_encode($valor);
            } else {
                $texto = (string)$valor;
            }
            $partes[] = $nombre . ":" . $texto;
            // $partes[] .= numero_serie();
        }
        return implode(";", $partes);
    }
}
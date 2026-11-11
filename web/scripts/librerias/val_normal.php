<?php
namespace VALNORMAL;

/**
 * Funcion que valida un valor entero
 *
 * @param integer $var
 * @param integer $min
 * @param integer $max
 * @param integer $defecto
 * @return boolean
 */
function validaEntero(int &$var, int $min, int $max, int $defecto):bool{
    $limpio = preg_replace('/[^0-9+-]/', '', (string)$var);

    
    if (preg_match('/^[+-]?\d+$/', $limpio) && (int)$limpio >= $min && (int)$limpio <= $max) {
        $var = (int)$limpio;      
        return true;
    }
    $var = $defecto;
    return false;
}

/**
 * Funcion que valida un numero real
 *
 * @param float $var
 * @param float $min
 * @param float $max
 * @param float $defecto
 * @return boolean
 */
function validaReal (float &$var, float $min, float $max, float $defecto):bool{

    $limpio = preg_replace('/[^0-9.+-]/', '', (string)$var);

    if (is_numeric($limpio) && (float)$limpio >= $min && (float)$limpio <= $max) {
        $var = (float)$limpio; 
        return true;
    }
    $var = $defecto;
    return false;
}

/**
 * Funcion que valida una fecha
 *
 * @param string $var
 * @param string $defecto
 * @return boolean
 */
function validaFecha(string &$var,string $defecto):bool{
    $fecha = trim($var);

    if (preg_match('#^(\d{1,2})/(\d{1,2})/(\d{4})$#', $fecha, $m)
        && checkdate((int)$m[2], (int)$m[1], (int)$m[3])) {
        $var = sprintf("%02d/%02d/%04d", $m[1], $m[2], $m[3]);   
        return true;
    }
    $var = $defecto;
    return false;
}

/**
 * Funcion que valida una hora
 *
 * @param string $var
 * @param string $defecto
 * @return boolean
 */
function validaHora(string &$var, string $defecto): bool{
    
    $hora = trim($var);

    if (preg_match('/^(\d{1,2}):(\d{1,2}):(\d{1,2})$/', $hora, $m)
        && (int)$m[1] <= 23 && (int)$m[2] <= 59 && (int)$m[3] <= 59) {
        $var = sprintf("%02d:%02d:%02d", $m[1], $m[2], $m[3]);   
        return true;
    }
    $var = $defecto;
    return false;
}

/**
 * Funcion que valida un email
 *
 * @param string $var
 * @param string $defecto
 * @return boolean
 */
function validaEmail(string &$var, string $defecto): bool{
    // Sanear: quitar todo lo que no pueda ir en un email
    $email = preg_replace('/[^a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~@\[\]-]/', '', $var);

    // Formato aaaaa@bbbb.ccc
    if (preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*\.[a-zA-Z]{2,}$/', $email)) {
        $var = $email;
        return true;
    }
    $var = $defecto;
    return false;
}

/**
 * Funcion que valida una cadena
 *
 * @param string $var
 * @param integer $longitud
 * @param string $defecto
 * @return boolean
 */
function validaCadena(string &$var, int $longitud, string $defecto): bool{
    if (mb_strlen($var) <= $longitud) {
        return true;
    }
    $var = $defecto;
    return false;
}

/**
 * Funcion que valida una expresion 
 *
 * @param string $var
 * @param string $expresion
 * @param string $defecto
 * @return boolean
 */
function validaExpresion(string &$var, string $expresion, string $defecto): bool{
    // @ evita el aviso si la expresión regular está mal escrita (devuelve false)
    if (@preg_match($expresion, $var) === 1) {
        return true;
    }
    $var = $defecto;
    return false;
}

/**
 * Funcion que valida un rango de valores en un array
 *
 * @param mixed $var
 * @param array $posibles
 * @param integer $tipo
 * @return boolean
 */
function validaRango(mixed $var, array $posibles, int $tipo = 1): bool{
    if ($tipo === 1) {
        return in_array($var, $posibles, true);          
    }
    if ($tipo === 2) {
        return (is_int($var) || is_string($var)) && array_key_exists($var, $posibles);   // claves
    }
    return false;
}
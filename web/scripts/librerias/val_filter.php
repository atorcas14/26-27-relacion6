<?php
namespace VALFILTER;

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
    $limpiar = filter_var($var,FILTER_SANITIZE_NUMBER_INT);
    $resultado = filter_var($limpiar,FILTER_VALIDATE_INT, ["options" => ["min_range"=>$min, "max_range"=>$max]]);
    if(!$resultado){
        return false;
    }
    $var=$defecto;
    return true;
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

    $limpiar = filter_var($var,FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $resultado = filter_var($limpiar,FILTER_VALIDATE_FLOAT);

    if($resultado||$resultado<$min||$resultado>$max){
        return false;
        $var=$defecto;
    }

    $var=$defecto;
    return true;
}

/**
 * Funcion que valida una fecha
 *
 * @param string $var
 * @param string $defecto
 * @return boolean
 */
function validaFecha(string &$var, string $defecto):bool{
    $fecha = trim($var);
    $formato = filter_var($fecha,FILTER_VALIDATE_REGEXP, [
        "options" => ["regexp" => '#^\d{1,2}/\d{1,2}/\d{4}$#']
    ]);

    if(!$formato){
        [$dia,$mes,$anio] = explode("/",$formato);
        if(checkdate((int)$mes, (int)$dia, (int)$anio)){
            $var = sprintf("%02d/%02d/%04d", $dia, $mes, $anio);
            return true;
        }
    }
    $var=$defecto;
    return false;
}

/**
 * Funcion que valida una hora
 *
 * @param string $var
 * @param string $defecto
 * @return boolean
 */
function validaHora (string &$var, string $defecto): bool{
    $hora = trim($var);
    $formato = filter_var($hora,FILTER_VALIDATE_REGEXP,[
        "options" => ["regexp" => '/^\d{1,2}:\d{1,2}:\d{1,2}$/']
    ]);

    if(!$formato){
        [$h, $mi, $s] = explode(":", $formato);
        
        if ((int)$h <= 23 && (int)$mi <= 59 && (int)$s <= 59) {
            $var = sprintf("%02d:%02d:%02d", $h, $mi, $s);
            return true;
        }
    }
    $var=$defecto;
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
    
    $limpio = filter_var($var, FILTER_SANITIZE_EMAIL);

    if (filter_var($limpio, FILTER_VALIDATE_EMAIL) === false) {
        $var = $defecto;
        return false;
    }
    $var = $limpio;
    return true;
}

/**
 * Funcion que valida una cadena 
 * siendo este igual que en val_normal
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
    $resultado = @filter_var($var, FILTER_VALIDATE_REGEXP, [
        "options" => ["regexp" => $expresion]
    ]);

    // Comparar con !== false: una cadena "0" que coincide es válida
    if ($resultado !== false) {
        return true;
    }
    $var = $defecto;
    return false;
}

/**
 * Funcion que valida un rango de valores en un array
 * siendo este igual que en val_normal
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
        return (is_int($var) || is_string($var)) && array_key_exists($var, $posibles);
    }
    return false;
}
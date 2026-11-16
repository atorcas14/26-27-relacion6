<?php
/**
 * Enumeracion de materiales
 */
enum Materiales:int{
    case Madera=5;
    case Hierro=10;
    case Plastico=15;
    case Aluminio=20;
}

/**
 * Funcion que devuelve el nombre de los materiales
 *
 * @param Materiales $materiales
 * @return string
 */
function dameNombre(Materiales $materiales):string{
    return  $materiales -> name;
}

/**
 * Funcion que devuelve el numero de los materiales
 *
 * @param Materiales $material
 * @return integer
 */
function dameNumero(Materiales $material):int{
    return $material -> value;
}
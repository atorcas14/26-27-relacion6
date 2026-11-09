<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("Pruebas basicas");
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{
?>
    <br><br> esto es html
    <?php
        echo "klñfffdj";  // esto es un comentario

        $cadena=date("d/m/Y H:i:s");

        $hoy = new DateTime();
        $cadena = $hoy -> format("d/m/Y H:i:s");

        // Le sumo 2 dias y 15 horas, 30 min 
        $hoy -> add(new DateInterval("P2DT15H30M"));


        $var1=25;
        $cadena='esto es una cadena';

        $var1+=0b1000;
        echo $var1;

        $una_cadena="hola";
        $unaCadena="adios";

        $var1-=17;

        echo "$var1";

        $unaCadena=45;
        echo $unaCadena;
        if (isset($cadena2))
             echo $cadena2;

        // echo "el numero real $real";
        
        $real=1234.56789012345678901;
        $real+=  0.432109876549;

        $real=1234.5678901;
        $real+=  0.4321099;

        //$real=12 * "hola";
        echo "el numero \$var1 es {$var1}<br>".PHP_EOL;
        echo 'el numero es $var1<br>'.PHP_EOL;

        $real=null;

        echo "el numero real $real";

        $var=125;
        $tipo= gettype($var);
        $var=(string)$var;
        $tipo= gettype($var);
        settype($var,"double");
        $tipo= gettype($var);
        $var=intval($var);
        $tipo= gettype($var);


        $var ="0";
        if ($var)
            $cadena="var no vale false";
        
        $var ="0";
        if ("0000")
            $cadena="var no vale false";

        $var ="";
        if ($var)
            $cadena="var no vale false";
        
        $var =0;
        if ($var)
            $cadena="var no vale false";

        $var =1;
        if ($var)
            $cadena="var no vale false";

        $var=1+true;
        $var=1+1.5;
        $var=1+"1hola";
        $var=1+"1.5hola";
        //$var=1+"hola";
        //$var=1+[];
        $aux=125;
        $var="hola ".$aux;
        $aux=true;
        $var="hola ".$aux;
        $aux=[];
        // $var="hola ".$aux;
        $aux="adios";
        $var="hola ".$aux;

        //referencia
        $var1=100;
        $var2=$var1;
        $var3=&$var1;
        $var2=150;
        $var3=200;

        unset($var3);

        // $var1+=NUME;

        // $var1+=NUME1;

        //operadores
        $var=15/2;

        if ("25"==25)
            $var="iguales";
        
        if ("25hola"==25)
            $var="iguales";

        if ("25"===25)
            $var="iguales";
        
        if ("25"!=25)
            $var="distintos";
        if ("25"!==25)
            $var="distintos";

        $var=14>25;
        $var=14<25;
        $var=14<=>25;

        if (isset($var3))
            $var=$var3;
          elseif (isset($mivar))
              $var=$mivar;
            else 
                $var=27;

        $var=$var3??$mivar??27;

        $var=0b11111;
        $var=$var>>1;
        $var=$var<<1;
        
        $var=0b1010 & 0b0101;
        $var=0b1010 | 0b0101;


        $var=7;
        if ($var==1)
              $cadena="uno";
            elseif ($var==2)
                    $cadena="dos";
                else
                      $cadena="otro";
        
        $var=1;
        switch ($var)
        {
            case 1: $cadena="uno";
                    break;
            case 2: $cadena="dos";
                    break;
            default: $cadena="otro";
        }


}

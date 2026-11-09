<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
//dibuja la plantilla de la vista
inicioCabecera("APLICACION PRIMER TRIMESTRE");
cabecera();
finCabecera();
inicioCuerpo("ARRAY");
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************

//vista
function cabecera() {}
//vista
function cuerpo()
{

     $miArray[3]=23;
     $miArray[7]=1234;
     $miArray[]=54;
     
      $total=0;

      $final=count($miArray);
      for($i=0;$i<$final;$i++){
           if (isset($miArray[$i]))
                $total+=$miArray[$i];
               else
                 $final++;
    }

     $miArray["nueva"]=24;


    $total=0;
    $total1=0;
    foreach($miArray as $i=>$valor)
        {
            $total+=$miArray[$i];
            $total1+=$valor;
        }


}

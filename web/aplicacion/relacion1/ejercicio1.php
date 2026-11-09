<?php
include_once(dirname(__FILE__) . "/../../cabecera.php");
//controlador
$barraUbi = [
    [
        "TEXTO" => "Inicio",
        "LINK" => "/index.php"
    ],
    [
        "TEXTO" => "Relacion 1",
        "LINK" => "/aplicacion/relacion1/index.php"
    ],
    [
        "TEXTO" => "Ejercicio1",
        "LINK" => ""
    ]
];
//dibuja la plantilla de la vista
inicioCabecera("EJERCICIO 1");
cabecera();
finCabecera();
inicioCuerpo("Ejercicio 1",$barraUbi);
cuerpo(); //llamo a la vista
finCuerpo();
// **********************************************************



//vista
function cabecera() {}
//vista
function cuerpo()
{

//Variables definidas en distintas bases
$binario = 0b101101; // variable en decimal
$octal = 0755; //variable en octal
$hexadecimal = 0x1F4; //variable en hexadecimal

// Otros valores para las funciones
$decimal = 3.14159;
$numero  = 255;
$base4   = "3121"; // número en base 4 (en forma de cadena)
?>
    <h2>Variables en binario, octal y hexadecimal</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>Variable</th>
        <th>Valor en decimal</th>
        <th>Valor en su base</th>
    </tr>
    <tr>
        <td>$binario</td>
        <td><?php echo $binario; ?></td>
        <td><?php echo decbin($binario); ?> (base 2)</td>
    </tr>
    <tr>
        <td>$octal</td>
        <td><?php echo $octal; ?></td>
        <td><?php echo decoct($octal); ?> (base 8)</td>
    </tr>
    <tr>
        <td>$hexadecimal</td>
        <td><?php echo $hexadecimal; ?></td>
        <td><?php echo strtoupper(dechex($hexadecimal)); ?> (base 16)</td>
    </tr>
</table>
 
<h2>Funciones matemáticas</h2>
<table border="1" cellpadding="5">
    <tr>
        <th>Función</th>
        <th>Llamada</th>
        <th>Resultado</th>
    </tr>
    <tr>
        <td>round</td>
        <td>round(<?php echo $decimal; ?>, 2)</td>
        <td><?php echo round($decimal, 2); ?></td>
    </tr>
    <tr>
        <td>floor</td>
        <td>floor(<?php echo $decimal; ?>)</td>
        <td><?php echo floor($decimal); ?></td>
    </tr>
    <tr>
        <td>ceil</td>
        <td>ceil(<?php echo $decimal; ?>)</td>
        <td><?php echo ceil($decimal); ?></td>
    </tr>
    <tr>
        <td>pow</td>
        <td>pow(2, 10)</td>
        <td><?php echo pow(2, 10); ?></td>
    </tr>
    <tr>
        <td>sqrt</td>
        <td>sqrt(144)</td>
        <td><?php echo sqrt(144); ?></td>
    </tr>
    <tr>
        <td>Entero a hexadecimal (dechex)</td>
        <td>dechex(<?php echo $numero; ?>)</td>
        <td><?php echo dechex($numero); ?></td>
    </tr>
    <tr>
        <td>Base 4 a base 8 (base_convert)</td>
        <td>base_convert("<?php echo $base4; ?>", 4, 8)</td>
        <td><?php echo base_convert($base4, 4, 8); ?></td>
    </tr>
    <tr>
        <td>abs</td>
        <td>abs(-25.7)</td>
        <td><?php echo abs(-25.7); ?></td>
    </tr>
    <tr>
        <td>max</td>
        <td>max(3, 9, 27, 5)</td>
        <td><?php echo max(3, 9, 27, 5); ?></td>
    </tr>
    <tr>
        <td>fmod</td>
        <td>fmod(17, 5)</td>
        <td><?php echo fmod(17, 5); ?></td>
    </tr>
    <tr>
        <td>pi</td>
        <td>pi()</td>
        <td><?php echo pi(); ?></td>
    </tr>
</table>

<?php
}

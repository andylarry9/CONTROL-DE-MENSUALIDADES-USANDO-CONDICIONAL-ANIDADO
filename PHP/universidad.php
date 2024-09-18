<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mensualidad de Universidad</title>
    <style>
       body {
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        background-color: #f0f0f0; /* Color de fondo del body */
    }

    .container {
        width: 80%; /* Ancho de la caja */
        max-width: 600px; /* Ancho máximo de la caja */
        padding: 20px; /* Espaciado interno */
        background-color: #ffffff; /* Color de fondo de la caja */
        border: 1px solid #cccccc; /* Borde de la caja */
        border-radius: 8px; /* Radio de borde */
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Sombra */
    }
          header {
            margin-bottom: 20px; /* Ajusta el margen según tus necesidades */
            text-align: center; /* Centra el texto dentro del encabezado */
        }
         
        
    </style>
</head>
<body>
    <div class="container">
<header>
    <h2 id="centrado">Mensualidad de Universidad</h2>
    <img src="https://images.hola.com/images/026b-12be755bd68c-88fa12421828-1000/horizontal-480/chicos-de-acceso-a-la-universidad.jpg" 
         width="530" height="300"/>
</header>
<?php
error_reporting(0);
$alumno = $_POST['txtAlumno']; 
$categoria = $_POST['selCategoria'];
$promedio = $_POST['txtPromedio'];
if ($categoria == 'A') $selA = 'SELECTED'; else $selA = ""; 
if ($categoria == 'B') $selB = 'SELECTED'; else $selB = ""; 
if ($categoria == 'C') $selC = 'SELECTED'; else $selC = "";
if ($categoria == 'D') $selD = 'SELECTED'; else $selD = "";

$mAlumno = '';
$mCategoria = ''; 
$mPromedio = '';
$montoCancelar = '';

if (empty($alumno))
    $mAlumno = 'Debe registrar el nombre del alumno';
if ($categoria == 'seleccione')
    $mCategoria = 'Debe seleccionar una categoria';
if (empty($promedio) || !is_numeric($promedio))
    $mPromedio = 'Debe registrar correctamente el promedio'; 
elseif ($promedio < 0 || $promedio > 20)
    $mPromedio = 'El promedio debe estar entre 0 y 20';

// Cálculo del descuento
$descuento = 0;
if ($promedio < 12) {
    $descuento = 0;
} elseif ($promedio >= 13 && $promedio <= 15) {
    $descuento = 0.10;
} elseif ($promedio >= 16 && $promedio <= 17) {
    $descuento = 0.15;
} elseif ($promedio >= 18 && $promedio <= 19) {
    $descuento = 0.25;
} elseif ($promedio == 20) {
    $descuento = 0.50;
}

// Cálculo del monto a pagar con descuento
if ($categoria == 'A') {
    $monto = 850;
} elseif ($categoria == 'B') {
    $monto = 750;
} elseif ($categoria == 'C') {
    $monto = 650;
} elseif ($categoria == 'D') {
    $monto = 500;
} else {
    $monto = 0;
}
$montoDescuento = $monto * $descuento;
$montoCancelar = $monto - $montoDescuento;

?>

<section>
    <form name="frmUniversidad" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <table border="0" width="800" cellspacing="0" cellpadding="0" aling="center">
            <tr>
                <td width="200">Nombre completo del alumno</td> 
                <td width="400"><input type="text" name="txtAlumno" size="30" value="<?php echo $alumno; ?>" /></td> 
                <td id="error"><?php echo $mAlumno; ?></td>
            </tr> 
            <tr>
                <td>Seleccione categoría</td>
                <td>
                    <select name="selCategoria">
                        <option value="seleccione" SELECTED>Seleccione categoría</option> 
                        <option value="A" <?php echo $selA; ?> >A</option> 
                        <option value="B" <?php echo $selB; ?> >B</option> 
                        <option value="C" <?php echo $selC; ?> >C</option> 
                        <option value="D" <?php echo $selD; ?> >D</option> 
                    </select>
                </td>
                <td id="error"><?php echo $mCategoria; ?></td>
            </tr>
            <tr>
                <td>Ingrese Promedio</td>
                <td><input type="text" name="txtPromedio" value="<?php echo $promedio; ?>" /></td>                                        
                <td id="error"><?php echo $mPromedio; ?></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" value="Procesar" name="btnProcesar"/></td>
            </tr>
            <tr>
                <td>Monto de mensualidad:</td>
                <td><?php echo '$'. number_format($monto, 2, '.', ''); ?> </td>
            </tr>
              <tr>
                <td>Monto de descuento:</td>
                <td><?php echo '$'. number_format($montoDescuento, 2, '.', ''); ?> </td>
            </tr>
              <tr>
                <td>Monto a cancelar</td>
                <td><?php echo '$'. number_format($montoCancelar, 2, '.', ''); ?> </td>
            </tr>
        </table>
    </form>
</section>
    </div>
</body>
</html>

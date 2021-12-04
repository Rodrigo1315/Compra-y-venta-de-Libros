<?php
/* este archivo se repite tantas veces como informes queramos tener*/
require_once('class.ezpdf.php');
$pdf = new Cezpdf('a4');
$pdf->selectFont('../fonts/courier.afm');
$pdf->ezSetCmMargins(1,1,1.5,1.5);

$conexion = mysqli_connect("localhost","root", "");
mysqli_select_db($conexion,"libros");
$queEmp = "SELECT * FROM libros_venta";
$resEmp = mysqli_query($conexion, $queEmp) or die(mysqli_error());
$totEmp = mysqli_num_rows($resEmp);

$ixx = 0;
while($datatmp = mysqli_fetch_assoc($resEmp)) { 
	$ixx = $ixx+1;
	$data[] = array_merge($datatmp, array('num'=>$ixx));
}
$titles = array(
				'Id_Libro'=>'<b>ID</b>',
				'Titulo'=>'<b>TITULO</b>',
				'Autor'=>'<b>AUTOR</b>',
				'Categoria'=>'<b>CATEGORIA</b>',
				'stock'=>'<b>STOCK</b>',
				'precio'=>'<b>PRECIO</b>'
				);
$options = array(
				'shadeCol'=>array(0.9,0.9,0.9),
				'xOrientation'=>'center',
				'width'=>500
			);
$txttit = "<b>INVENTARIO </b>\n";
$txttit.= "SE PRESENTA ACONTINUACION EL INVENTARIO ACTUAL DE TODOS LOS LIBROS EN EL SISTEMA\n";

$pdf->ezText($txttit, 12);
$pdf->ezTable($data, $titles, '', $options);
$pdf->ezText("\n\n\n", 10);
$pdf->ezText("<b>Fecha:</b> ".date("d/m/Y"), 10);
$pdf->ezText("<b>Hora:</b> ".date("H:i:s")."\n\n", 10);
$pdf->ezStream();
?>
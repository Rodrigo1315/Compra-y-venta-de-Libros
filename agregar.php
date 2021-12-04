<html>
    <head>
<table align="right">
            <tr>
                <?php date_default_timezone_set('America/Santiago');
                $vaFecha=date('d-m-y');
                ?>
                <td>Fecha:</td>
                <td><input type="text" name="caja_fecha" value="<?php echo $vaFecha;?>" disabled=disabled></td>
            </tr>
        </table>

        <script language="javascript">
var RelojID24 = null
var RelojEjecutandose24 = false
function DetenerReloj24 (){
if(RelojEjecutandose24)
clearTimeout(RelojID24)
RelojEjecutandose24 = false}
function MostrarHora24 () {
var ahora = new Date()
var horas = ahora.getHours()
var minutos = ahora.getMinutes()
var segundos = ahora.getSeconds()
var ValorHora
//establece las horas
if (horas < 10)
ValorHora = "0" + horas
else
ValorHora = "" + horas
//establece los minutos
if (minutos < 10)
ValorHora += ":0" + minutos
else
ValorHora += ":" + minutos
//establece los segundos
if (segundos < 10)
ValorHora += ":0" + segundos
else
ValorHora += ":" + segundos
document.reloj24.txtDigitos.value = ValorHora
//si se desea tener el reloj en la barra de estado, reemplazar la anterior por esta
//window.status = ValorHora
RelojID24 = setTimeout("MostrarHora24()",1000)
RelojEjecutandose24 = true
}
function IniciarReloj24 () {
DetenerReloj24()
MostrarHora24()
}
</script>  

    <script> 
    function ValidaSoloNumeros(){
	  if((event.keyCode < 48) || (event.keyCode > 57))
        event.returnValue = false;

      }

    function ValidaSoloLetras(){
	  if((event.keyCode != 32) && (event.keyCode < 65) ||
	     (event.keyCode > 90) && (event.keycode <97) || (event.keycode > 122))
	      event.returnValue = false;
	  }
    </script>
    <body onload="IniciarReloj24()">
     <form name="reloj24">
         <input type="text" size="8" name="txtDigitos" value=" " disabled=disabled>
     </form>

    </head>
    <body bgcolor="#D4AC0D">
        <form action="" method="POST">
            <?php error_reporting(0)?>
              <center>
                  <font color="" size="5" face="stencil"><h1>"MANTENEDOR DE VENTA"</h1></font>
                  <img src="cintaa.png" width="500" height="50">
                  <font color="" size="5" face="stencil"><h2>*AGREGAR LIBRO*</h2></font>
                  <table>
                <tr>
                    <td>ID:</td>
                    <td><input type="text" name="txtid"  size="2" onkeypress="ValidaSoloNumeros()"></td>
                </tr>
                <tr>
                    <td>TITULO:</td>
                    <td><input type="text" name="txttitulo" value="" size="30" onkeypress="ValidaSoloLetras()">
                </tr>
                <tr>
                    <td>AUTOR:</td>
                    <td><input type="text" name="txtautor" onkeypress="ValidaSoloLetras()"</td>
                </tr>
                <tr>
                    <td>CATEGORIA:</td>
                    <td>
                        <?php
                            include("funciones.php");
                            $cnn = Conectar();
                            $sql = "SELECT Descripcion FROM categoria";
                            $result = mysqli_query($cnn,$sql);
                        ?>
                            <select name="txtcategoria">
                                <?php while($row = mysqli_fetch_array($result)){
                                echo '<option>'. $row["Descripcion"];}
                                ?>
                            </select>
                    </td>
                </tr>
                <tr>
                    <td>STOCK:</td>
                    <td><input type="text" name="txtstock"  size="2" onkeypress="ValidaSoloNumeros()"></td>
                </tr>
                  <tr>
                    <td>PRECIO:</td>
                    <td>$<input type="text" name="txtprecio"  size="8" onkeypress="ValidaSoloNumeros()"></td>
                </tr>
                <tr>
                    <td></td>
                    <td><input type="submit" name="btnagregar" value="AGREGAR"</td>
                </tr>
            </table>
                   <?php 
                     if ($_POST['btnagregar']=="AGREGAR") {
                         $cnn=Conectar();

                         $id=$_POST['txtid'];
                         $titulo=$_POST['txttitulo'];
                         $autor=$_POST['txtautor'];
                         $categoria=$_POST['txtcategoria'];
                         $stock=$_POST['txtstock'];
                         $precio=$_POST['txtprecio'];
                         $rs = mysqli_query($cnn,"select * from libros_venta where Id='$id'");
                            if($row=mysqli_fetch_array($rs)){
                                echo"<script>alert('Ya existe un Libro registrado con esa ID')</script>";
                            }else{
                                if(empty($id) || empty($titulo) || empty($autor) || empty($categoria) || empty($stock) || empty($precio)){
                                      echo"<script>alert('Los campos obligatorios deben contener datos')</script>";
                                }else{
                                    $sql="insert into libros_venta values('$id','$titulo','$autor','$categoria','$stock','$precio')";
                                     mysqli_query($cnn,$sql);
                                     echo"<script>alert('Se Agregado Exitosamente El Libro')</script>";
                                }
                            }
                        }
                   ?>
            <br>
                        <a href="index.php"><img src="home.png" width="80" height="80"></a>
                        <a href="admin.php"><img src="return.png" width="80" height="80"></a>
              </center>
        </form>
    </body>
</html>
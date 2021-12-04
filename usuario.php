<html>
    <head>

    </head>
    <body bgcolor="#D4AC0D">
        <form action="" method="POST">
            <?php error_reporting(0)?>
              <center>
                  <font color="" size="5" face="stencil"><h1>COMPRA DE LIBROS </h1></font>
                  <img src="libros.png" width="200" height="200">
                  <br><br>
                  <table>
                      <tr>
                          <td>Id:</td>
                          <td><input type="text" name="txtid" value=""></td>
                      </tr>
                      <tr>
                          <td>Nombre:</td>
                          <td><input type="text" name="txtnombre" value=""></td>
                      </tr>
                      <tr>
                          <td>Apellido:</td>
                          <td><input type="text" name="txtapellido" value=""></td>
                      </tr>
                      <tr>
                          <td>Correo:</td>
                          <td><input type="text" name="txtcorreo" value=""></td>
                      </tr>
                      <tr>
                          <td>Direccion:</td>
                          <td><input type="text" name="txtdireccion" value=""></td>
                      </tr>
                      <tr>
                          <td>Fono:</td>
                          <td><input type="text" name="txtfono" value=""></td>
                      </tr>
                  </table>
                  <input type="submit" name="btnguardar" value="Guardar">
                  <br>
                  <?php
                        if ($_POST['btnguardar']=="Guardar"){
                        include ("funciones.php");
                            $cnn= Conectar();
                                  $id=$_POST['txtid'];
                                  $nombre=$_POST['txtnombre'];
                                  $apellido=$_POST['txtapellido'];
                                  $correo=$_POST['txtcorreo'];
                                  $direccion=$_POST['txtdireccion'];
                                  $fono=$_POST['txtfono'];
                                  $rs = mysqli_query($cnn,"select * from cliente where Id='$id'");
                            if($row=mysqli_fetch_array($rs)){
                                echo"('Ya existe un Cliente registrado con esa ID')";
                            }else{
                                if(empty($id) || empty($nombre) || empty($apellido) || empty($correo) || empty($direccion) || empty($fono)){
                                      echo"('Los campos obligatorios deben contener datos')";
                                }else{
                                    $sql="insert into cliente values('$id','$nombre','$apellido','$correo','$direccion','$fono')";
                                     mysqli_query($cnn,$sql);
                                     echo"('Se Han Guardado Correctamente sus Datos')";
                                }
                            }
                        }
                  ?>
                   <br>
                   <?php
                             if ($_POST['btnbuscar']=="Buscar"){
                             include ("funciones.php");
                             $cnn= Conectar();
                             $titulo=$_POST['txttitulo'];
                             $rs=mysqli_query($cnn,"select * from libros_venta where Titulo='$titulo'");
                                if ($row=mysqli_fetch_array($rs)){
                                    $titulo= $row[1];
                                    $autor= $row[2];
                                    $categoria=$row[3];
                                    $stock= $row[4];
                                    $precio= $row[5];
                                    
                                }else{
                                    echo"<script>alert('No tenemos este libro en la tienda')</script>";
                                }
                              }
                             ?>
                  <table>
                      <tr>
                          <td>ID Cliente:</td>
                          <td><input type="text" name="txtidcliente" value="<?php echo $id?>" size="2"></td>
                      </tr>
                      <tr>
                          <td>Titulo:</td>
                          <td><input type="text" name="txttitulo" value="<?php echo $titulo?>" size="30"</td>
                          <td><input type="submit" name="btnbuscar" value="Buscar"></td>
                          
                      </tr>
                       <tr>
                          <td>Autor:</td>
                          <td><input type="text" name="txtautor" value="<?php echo $autor?>" size="20" readonly=readonly></tr>
                      </tr>
                      <tr>
                          <td>Categoria:</td>
                          <td><input type="text" name="txtcategoria" value="<?php echo $categoria?>" size="20" readonly=readonly></td>
                      </tr>
                      <tr>
                          <td>Stock Disponible:</td>
                          <td><input type="text" name="txtstock" value="<?php echo $stock?>" size="2"  readonly=readonly></td>
                      </tr>
                      <tr>
                          <td>Precio:</td>
                          <td><input type="text" name="txtprecio" value="<?php echo $precio?>" size="10"  readonly=readonly</td>
                      </tr>
                      <tr>
                          <td>Retiro:</td>
                          <td><input type="radio" name="retiro" value="1">En Tienda
                              <input type="radio" name="retiro" value="2">A Domicilio</td>
                     </tr>
                  </table> 
                  <br>
                  <input type="submit" name="btncomprar" value="Comprar">
                  <?php
                              if ($_POST['btncomprar']=="Comprar") {
                                  include ("funciones.php");
                                  $cnn=Conectar();
                                  
                                  $id=$_POST['txtidcliente'];
                                  $titulo=$_POST['txttitulo'];
                                  $autor=$_POST['txtautor'];
                                  $categoria=$_POST['txtcategoria'];
                                  $stock=$_POST['txtstock'];
                                  $precio=$_POST['txtprecio'];
                                  $retiro=$_POST['retiro'];
                                  
                                 $sql="insert into venta values('$id','$titulo','$autor','$categoria','$stock','$precio','$retiro')";
                                     mysqli_query($cnn,$sql);
                                     echo"<script>alert('Se a realizado su compra correctamente')</script>";

                              }
                            ?>
                  <br><br>
                  <a href="index.php"><img src="home.png" width="100" height="100"></a>
              </center>
        </form>
    </body>
</html>
<html>
    <head>
        <title>ADMIN</title>
    </head>
    <body bgcolor="#17A589">
    <form action="" method="POST" >
        <?php error_reporting(0)?>
       <center>
           <font color="white" face="stencil"><h1>INICIO DE SESION</h1></font>
       <table>
           <tr>
               <td><img src="login.png" width="50" height="50"></td>
               <td>USUARIO:</td>
               <td><input type="text" name="txtusua" value=""></td>
           </tr>
           <tr>
               <td><img src="login2.png" width="50" height="50"></td>
               <td>CLAVE:</td>
               <td><input type="password" name="txtclave" value=""></td>
           </tr>
       </table>
               <input type="submit" name="btningresar" value="INGRESAR">
               <br><br>
               <a href="index.php"><img src="home.png" width="100" height="100"></a>
        <?php 
                 if ($_POST['btningresar']=="INGRESAR" ) {
                 include("funciones.php");
                     $cnn=Conectar();
                     $usu=$_POST['txtusua'];
                     $cla=$_POST['txtclave'];
                     $sql="select * from admin where Usuario='$usu' and Clave='$cla'";
                     $rs=mysqli_query($cnn,$sql);
                        if (mysqli_num_rows($rs) !=0){
                        if ($row=mysqli_fetch_array($rs)){
                            $nom=$row[1];
                            $id=$row[2];
                                switch ($id) {
                                    case 1:
                                          echo"<script>alert('Bienvenido $nom!!')</script>";
                                          echo"<script type='text/javascript'>window.location='admin.php'</script>";
                                        
                                    default:
                                          echo"<script>alert('Usted no es Usuario')</script>";
                                          echo"<script type='text/javascript'>window.location='Index.php'</script>";
                                          break;
                                  }
                            }
                         }else{
                            echo"<script>alert('Usuario o Clave incorrecta')</script>";
                         }
                    }
        ?>
    </form>   
       </center>
    </body>
</html>
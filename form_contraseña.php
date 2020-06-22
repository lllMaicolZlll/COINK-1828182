<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>recuperar contraseña</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="css/est.css">
  <link rel="stylesheet" href="css/estilo_perfil.css">
 
 
  <link rel="stylesheet" href="css/estilo_subida.css">
  <link rel="stylesheet" href="css/estilo_vista.css">
  <link rel="stylesheet" href="css/estilo_carta.css">
  <link rel="stylesheet" href="bcss/bootstrap.min.css">
  <title>Coink | Colombia Viva</title>
  <script src="Bjs/bootstrap.min.js"></script>
</head>
<body class="pigg"> <!--  la clase pigg la esamos utilizando para agregar un fondo con imgaen a cierta parte de la pagina-->
    <?php
    //Incluimos el menu
include('php/conexion.php');

?>
<div class="container pigg"id="form1"><!-- este contenedor lo estamos utilizando para contener el formulario de recuperar_contraseña-->
    <div class="row"> <!-- esta ROW   la estamos utilisando para asignar una pocicion --> 
        <div class="col-lg-4"></div> <!-- este DIV lo estamos utilizando para generar un espacio vacio-->
        <div class="col-lg-4 bg-dark p-5 rounded text-light" >  <!-- este DIV lo estamos utilizando para almacenar el contenido del formulario-->
            <p class="h3">Recuperar contraseña</p>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
            ingrese el codigo:
            <!-- esta funcion javascript es para que un usuario solo pueda escribir numeros -->
            <input type="text" onkeypress="return soloNumeros(event)" class="form-control"name="codigo">
            <br>
            <input type="submit" class="float-right btn btn-danger"name="enviarCodigo" value="Enviar">
            </form>
        </div>
        <div class="col-lg-4"></div> <!-- este DIV lo estamos utilizando para generar un espacio vacio-->
    
    </div>
</div>

<?php 
//Verificamos que presiono el boton enviar
if(isset($_POST['enviarCodigo'])){
    //Tramos el dato
    //$codigo = codigo enviado al correo para confirmar la identidad
    $codigo = $_POST['codigo'];
    //Consultamos si el dato coincide con el codigo dado
    $query = mysqli_query($conexion,"SELECT * FROM codigorecuperacion WHERE codigo='$codigo'");
    $num = mysqli_num_rows($query);
    if($num > 0){
        $row = mysqli_fetch_array($query);
        //id_u = identificacion del usuario
        $id_u = $row['id_u'];
        if($id_u){
            //Si conciden mostramos un nuevo formulario de recupaerar la contraseña
            echo "<script>document.getElementById('form1').style.display = 'none';</script>";
            ?>
            <div class="container">
                <center>
              <div class="row">
                  <div class="col-lg-4"></div>
                  <div class="col-lg-4 bg-dark p-5 rounded text-light">
                        
                           
                  <p class="h3">Recuperar contraseña</p>
                        <form action="cambiarContra.php" method="post" >
                                    <input type="text" value="<?php echo $id_u ?>"hidden name="id_u">
                                    <label for="contra1">contraseña</label>
                                    <input type="password" name="contra1" class="form-control" placeholder="Contraseña">
                                    <br>
                                    <label for="contra2">Confirmar contraseña</label>
                                    <input type="password" name="contra2" class="form-control" placeholder="Confirmar contraseña">
                                    <br>
                                    <input type="submit" name="confirmar" class="btn btn-danger float-right" value="Cambiar">

                                    </form>
                                    <?php
                                
                                }
                            }else{
                                //Si el codigo no coincide mostramos un mensaje
                                echo "<script>alert('Codigo equivocado')</script>";

                            }
                            
                        }
                        ?>

                  </div>
                  <div class="col-lg-4"></div></center>
              </div>
            </div>
            




</body>
</html>

<script>
//Funcion para que solo se puedan escribir numeros
function soloNumeros(e)
              {
                var key = window.Event ? e.which : e.keyCode
                return ((key >= 48 && key <= 57) || (key==8))
              }
</script>

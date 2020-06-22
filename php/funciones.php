<?php
/*
Funcion para iniciar Sesion  
recivimos los siguientes parametros

$correo = correo electronico de un usuario
$contra = contraseña del usuario
$conexion = nos trae la conexion a la base de datos
$link = trae el link donde se incuentra el usuario
*/
function iniciarSesion($correo,$contra,$conexion,$link){
  // Se verifica que los campos si contienen datos
  if($correo == "" || $contra == ""){
    //Si las variables estan vacias se inicia de nuevo el modal de inicio de sesion con un mensaje
    ?>
            <script>
              // ajax para mostrar el modal iniciar con un mensaje
              $('#iniciar').modal('show');
            </script>
          <div class="alert alert-danger text-center" role="alert">
          Ingrese los datos!
          </div>
          <?php
  }else{
    //Si las variables contienen datos, se consulta si el correo y la contraseña estan en la base de datos
    $query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE correo='$correo' AND contra='$contra'");
    if(!$query){
      //Si la consulta falla se le informa al usuario de un error
     ?>
            <script>
            // ajax para mostrar el modal iniciar con un mensaje
              $('#iniciar').modal('show');
            </script>
          <div class="alert alert-danger text-center" role="alert">
          Problemas para conectar con el servidor, intente mas tarde
          </div>
     <?php
    }else{
      //Si no hay errores miramos el numero de registros de la consulta
      $num = mysqli_num_rows($query);
      if($num >0){
        //Si, si hay registros traemos el estado de el correo consultado
          $row = mysqli_fetch_array($query);
          //Guardamos el estado del usuario en una variable
          $estado = $row['estado'];
          if($estado == "ban"){
            // Si el estado es igual a ban se le informa al usuario que no puede ingresar
            ?>
                <script>
                // ajax para mostrar el modal iniciar
                  $('#iniciar').modal('show');
                </script>
              <div class="alert alert-danger text-center" role="alert">
              Cuenta betada para mas informacion de <a href=""> click aqui!</a>
              </div>
          <?php
          }else{
            //Traemos el cargo del usuario, el nombre y el correo y los guardamos en variables
            $cargo = $row['cargo'];
            $nombre = $row['nombres'];
            $contra1 = $row['contra'];
            //Verificamos si el cargo del usuario es admin
            if($cargo == "admin" ){
            //Si el cargo es igual a admin y guardamos el id en una sesion
            $_SESSION['id'] = $row['id'];
            //Mostramos un mensaje de bienvenida
            ?>
            <script type="text/javascript">
            alert("Bienvenido Administrador");
            //Redireccionamos a la ubicacion donde se incuentra el usuario
            window.location="<?php echo $link?>";
            </script>
            <?php
            //Si el cargo no es admin, miramos si es igual a start
            }elseif($cargo == "start"){
            //SI el cargo es start osea estandar, guardamos el id en una sesion
            $_SESSION['id'] = $row['id'];
            //Mostramos un mensaje de bienvenida
            ?>
            <script type="text/javascript">
              alert("Iniciando corretamente");
              //Redireccionamos a la ubicacion donde se incuentra el usuario
            window.location="<?php $link?>";      
            </script>
            <?php
              
            }else{
              //Si no es ninguno de los dos cargos, le enviamos un mensaje
              ?>
                <script>
                // ajax para mostrar el modal iniciar
                  $('#iniciar').modal('show');
                </script>
              <div class="alert alert-danger text-center" role="alert">
              Correo o contraseña incorrecta!
              </div>
              <?php
          
            }
          }
      
      }else{
        //Si no hay en la consulta mostramos un mensaje
        ?>
                <script>
                // ajax para mostrar el modal iniciar
                  $('#iniciar').modal('show');
                </script>
              <div class="alert alert-danger text-center" role="alert">
              Correo o contraseña incorrecta!
              </div>
              <?php
      }
   
    }
   
  }
   
}
  
/* 
Funcion para el registro de un usuario 
recivimos los siguientes parametros

$conexion = nos trae la conexion a la base de datos
$nombres = nombres de el usuario
$apellido = apellidos del usuario
$correo = correo electronico de un usuario
$contra = contraseña del usuario
$contra1 = confirmacion de la contraseña del usuario
*/
function registrarUser($conexion,$nombres,$apellidos,$correo,$contra,$contra1){
  //Verificamos que los datos no esten vacios 
  if($nombres == "" || $apellidos =="" || $correo =="" || $contra =="" || $contra1 =="" ){
    //Si estan vacios, enviamos un mensaje
    ?>
     <script>
     // ajax para mostrar el modal registrar
          $('#registro').modal('show');
        </script>
        <div class="alert alert-danger text-center" role="alert">
          Rellene los datos
        </div>
    <?php
  }else{
    //Si, si hay datos, miramos si las contraseñas coinciden
    if($contra == $contra1){
      //Si las contraseñas coinciden, consultamos si hay algun correo igual en la base de datos
      $query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE correo='$correo'");
      //Guardamos el numero de registros con el correo en la base de datos
      $num = mysqli_num_rows($query);
      if($num > 0){
        //Si el correo esta en la base de datos enviamos un mensaje
        ?>
          <script>
          // ajax para mostrar el modal registro
            $('#registro').modal('show');
          </script>
          <div class="alert alert-danger text-center" role="alert">
            Correo ya registrado!
          </div>
        <?php
      }else{
        //Si el correo no esta en la base de datos, insertamos toda la informacion en la base de datos
        $insert = mysqli_query($conexion,"INSERT INTO `usuarios`(`id`, `nombres`, `aprellidos`, `correo`, `contra`, `cargo`, `estado`) VALUES (NULL,'$nombres','$apellidos','$correo','$contra','start','activo')");
        if(!$insert){
          //Si la insercion falla, mostramos un mensaje
          ?>
          <script>
          // ajax para mostrar el modal registro
            $('#registro').modal('show');
          </script>
          <div class="alert alert-danger text-center" role="alert">
            Error en el insert, intente mas tarde
          </div>
        <?php
  
        }else{
          //Si se inserto bien mostramos un mensaje y abrimos el modal de iniciar sesion
          ?>
          <script type="text/javascript">
          alert('Registrado correctamente, inicia sesion');
          // ajax para mostrar el modal iniciar
          $('#iniciar').modal('show');
          </script>
          <?php
  
        }
      }
  
    }else{
      //Si las contraseñas no son iguales mostramos un mensaje
      ?>
      <script>
        // ajax para mostrar el modal registro
            $('#registro').modal('show');
          </script>
      <div class="alert alert-danger text-center" role="alert">
        Las contraseñas no coinciden!
      </div>
    <?php
    }
  }
 

}
/* Funcion para mostrar diseños y colores en las categorias */
function bolitas($color){
  ?>

  <div class="spinner-grow " style="background-color:<?php echo $color;?>"role="status">
  <span class="sr-only" >Loading...</span>
</div>
<div class="spinner-grow" style="background-color:<?php echo $color;?>"role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow " style="background-color:<?php echo $color;?>"role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow " style="background-color:<?php echo $color;?>"role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow " style="background-color:<?php echo $color;?>"role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow "style="background-color:<?php echo $color;?>" role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow " style="background-color:<?php echo $color;?>"role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow " style="background-color:<?php echo $color;?>"role="status">
  <span class="sr-only">Loading...</span>
</div>
<?php
}
//Funcion para ar darle en el boton ver mas muestre mas proyectos
function cartasMas(){
  ?>
  <div id="massCartas"class="container"></div></div>
  <center>
  <i class="fas fa-piggy-bank text-danger"><input type="submit" value="Ver más" class=" btn subir text-danger font-weight-bold" onclick="masCartas()"></i>
  </center>
  <br><br>
  <script>
  //Llamamos a la funcion mas cartas para mostrar mas cartas
  function masCartas(){
    //de finimos n va a valer 3 para que el solo se muestren 3 cartas
    var n = 3;
    while (n>0){
      //Mostramos en el div mas cartas, nuevas cartas con nuevos proyectos
     document.getElementById('massCartas').innerHTML += "<div class='container'><div class='row'><div class='col-sm-4 col-12 '><div class='wrap'><div class='tarjeta-wrap'><div class='tarjeta'><div class='adelante'><div class='card text-white'><img src='img/img-5.jpg' class='card-img' style='height: 350px;' alt='...'><div class='card-img-overlay'><h5 class='card-title'>Card title</h5><p class='card-text'>This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p><p class='card-text'>Last updated 3 mins ago</p></div></div></div><div class='atras text-white bg-dark'><img src='img/muestra.png' class='card-img-top perfil rounded-circle' alt='...'><div class='card-body'><p class='crea'>Kailo</p><div class='progress blue'><span class='progress-left'><span class='progress-bar'></span></span><span class='progress-right'><span class='progress-bar'></span></span><div class='progress-value'>90%</div></div><p class='h6 valor'>45.000.000 / 40 dias</p><img src='img/corazon.png ' class='like'alt=''><p class='h6 valor1'>50</p><button type='button' class='btn-ini btn  bg-danger btn-sm float-right'>ver mas</button></div></div></div></div></div></div><div class='col-sm-4 col-12 '><div class='wrap'><div class='tarjeta-wrap'><div class='tarjeta'><div class='adelante'><div class='card text-white'><img src='img/img-5.jpg' class='card-img' style='height: 350px;' alt='...'><div class='card-img-overlay'><h5 class='card-title'>Card title</h5><p class='card-text'>This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p><p class='card-text'>Last updated 3 mins ago</p></div></div></div><div class='atras text-white bg-dark'><img src='img/muestra.png' class='card-img-top perfil rounded-circle' alt='...'><div class='card-body'><p class='crea'>Kailo</p><div class='progress blue'><span class='progress-left'><span class='progress-bar'></span></span><span class='progress-right'><span class='progress-bar'></span></span><div class='progress-value'>90%</div></div><p class='h6 valor'>45.000.000 / 40 dias</p><img src='img/corazon.png ' class='like'alt=''><p class='h6 valor1'>50</p><button type='button' class='btn-ini btn  bg-danger btn-sm float-right'>ver mas</button></div></div></div></div></div></div><div class='col-sm-4 col-12 '><div class='wrap'><div class='tarjeta-wrap'><div class='tarjeta'><div class='adelante'><div class='card text-white'><img src='img/img-5.jpg' class='card-img' style='height: 350px;' alt='...'><div class='card-img-overlay'><h5 class='card-title'>Card title</h5><p class='card-text'>This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p><p class='card-text'>Last updated 3 mins ago</p></div></div></div><div class='atras text-white bg-dark'><img src='img/muestra.png' class='card-img-top perfil rounded-circle' alt='...'><div class='card-body'><p class='crea'>Kailo</p><div class='progress blue'><span class='progress-left'><span class='progress-bar'></span></span><span class='progress-right'><span class='progress-bar'></span></span><div class='progress-value'>90%</div></div><p class='h6 valor'>45.000.000 / 40 dias</p><img src='img/corazon.png ' class='like'alt=''><p class='h6 valor1'>50</p><button type='button' class='btn-ini btn  bg-danger btn-sm float-right'>ver mas</button></div></div></div></div></div></div></div></div> ";
      n = n -1;
    }
  }
  </script>
  <?php
}

/*
Funcion registro de datos personales, para poder subir un proyecto

parametros
$id = identificador del usuario
$conexion = conexion con la base de datos
$iden = cedula del usuario
$fecha = dia, mes y año de nacimiento
$dereccion = direccion de su casa
$municipio = municipio en el que vive
$contra = contraseña del usuario
*/
function registroDoos($id,$conexion,$iden,$fecha,$direccion,$municipio,$contra){
    //Verificamos que los datos no esten vacios
  if($id == "" ||$conexion == "" ||$iden == "" ||$fecha == "" ||$direccion == "" ||$municipio == "" ||$contra == "" || $municipio =="municipio"){
    //Si estan vacios, enviamos un mensaje
    ?>
     <script>
     //ajax para abrir el modal registroDos con un mensaje
          $('#registroDos').modal('show');
        </script>
        <div class="alert alert-danger text-center" role="alert">
          Rellene todos los datos
        </div>
    <?php
  }else{
    //Si, si hay datos, miramos si las contraseñas coinciden
    $query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE id='$id' AND contra='$contra'");
    $num = mysqli_num_rows($query);
    if($num>0){
      //Si,la cntraseña conincide insertamos los datos
      $insert = mysqli_query($conexion,"UPDATE usuarios SET `identificacion`='$iden',`municipio`='$municipio',`fecha`='$fecha',`dirrecion`='$direccion' WHERE id='$id'");
    if(!$insert){
      //Si la insercion falla, mostramos un mensaje
      ?>
      <script>
           $('#registroDos').modal('show');
         </script>
         <div class="alert alert-danger text-center" role="alert">
           Problema inesppperado, intente mas tarde
         </div>
     <?php
    }else{
      //Si se inserta correctamente, enviamos un mensaje, y redirecionamos para que pueda subir un proyecto
    ?>
    <script>
    alert("Registro exitoso");
    window.location="sub-pro.php";
    </script>
    <?php
    }
    }else{
      ?>
      <script>
           $('#registroDos').modal('show');
         </script>
         <div class="alert alert-danger text-center" role="alert">
           La contraseña no coincide
         </div>
     <?php
    }
    
  }
}

//Funcion para abrir el modal del segundo formulario
function registro2(){
  ?>
  <script>
  //ajax para abrir el modal registroDos
  $('#registroDos').modal('show');
  </script>
  <?php
}
/*
Funcion para verificar si el usuario ha complatado el segundo registro

parametros

$id = identificador del usuario
$conexion = conexion con la base de datos
*/
function reelogin($id,$conexion){
  //Consultamos si el usuario ya ingreso el documento
  $query= mysqli_query($conexion,"SELECT * FROM usuarios WHERE id='$id' AND identificacion>0");
  $row = mysqli_fetch_array($query);
  if( $row['identificacion']>0){
    //Si ya hay un documento, puede ser redirecionado a subir un proyecto
   ?>
   <script>
   window.location="sub-pro.php";
   </script>
   <?php
  }
}
/*
Funcion para traer el numero de dias de un proyecto

parametros

$conexion = conexion con la base de datos
$id_p = identificador de un proyecto

*/
function getDias($conexion,$id_p){
//Consultamos en la tabla meta el id de un proyecto
$query = mysqli_query($conexion,"SELECT * FROM meta WHERE id_proyecto='$id_p'");
$row = mysqli_fetch_array($query);
//Guardamos el dato en la variable dias
$dias = $row['dias'];
//Retornamos el dato
return $dias;
           
}

/*
Funcion para traer el numero de proyectos activos

parametros

$conexion = conexion con la base de datos
*/
function NumProyectosActivos($conexion){
  //Consultamos todos los proyectos que tengan un estado
  $query = mysqli_query($conexion,"SELECT * FROM proyecto WHERE estado='activo'");
  //Guardamos el dato en la variable dias
  $num = mysqli_num_rows($query);
  //Retornamos el dato
  return $num;
}

/*
Funcion para traer el dinero que tiene recaudado un proyecto actualmente
parametros

$conexion = conexion con la base de datos
$id_p = identificador del proyecto
*/
function getDineroActual($conexion,$id_p){
  //Consultamos en la tabla meta con id del proyecto
  $query = mysqli_query($conexion,"SELECT * FROM meta WHERE id_proyecto='$id_p'");
  $row = mysqli_fetch_array($query);
  //Traemos el dinero actual del proyecto y lo guardamos en una variable
  $dinero_actual = $row['dinero_actual'];
  //Retornamos el dato
  return $dinero_actual;
}

/*
Funcion para traer el dinero que propone un proyecto a recaudar

parametros

$conexion = conexion con la base de datos
$id_p = identificador del proyecto
*/
function getDinero($conexion,$id_p){
  //Consultamos en la tabla meta con id del proyecto
  $query = mysqli_query($conexion,"SELECT * FROM meta WHERE id_proyecto='$id_p'");
  $row = mysqli_fetch_array($query);
  //Traemos el dinero que propone un proyecto a recaudar y lo guardamos en una variable
  $dinero = $row['dinero'];
  //Retornamos el dato
  return $dinero;
}
/*
Funcion el nombre de un usuario
parametros

$conexion = conexion con la base de datos
$id_u = identificador del usuario

*/
function getNombre($conexion,$id_u){
  //Consultamos en la tabla usuario con id del usuario
  $query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE id='$id_u'");
  $row = mysqli_fetch_array($query);
  //Traemos el nombre del usuario y lo guardamos en una variable
  $nombre = $row['nombres'];
  //Retornamos el dato
  return $nombre;
}

/*
Funcion traer el apellido de un usuario
parametros

$conexion = conexion con la base de datos
$id_u = identificador del usuario
*/
function getApellido($conexion,$id_u){
  //Consultamos en la tabla usuario con id del usuario
  $query = mysqli_query($conexion,"SELECT * FROM `usuarios` WHERE id='$id_u'");
  $row = mysqli_fetch_array($query);
  //Traemos el apellido del usuario y lo guardamos en una variable
  $apellido = $row['aprellidos'];
  //Retornamos el dato
  return $apellido;
}
/*
Funcion para traer la descripcion de un usuario
parametros

$conexion = conexion con la base de datos
$id_u = identificador del usuario
*/
function getDescripcion($conexion,$id_u){
  //Consultamos en la tabla usuario con id del usuario
  $query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE id='$id_u'");
  $row = mysqli_fetch_array($query);
  //Traemos la descripcion del usuario y lo guardamos en una variable
  $nombre = $row['descripcion'];
  //Retornamos el dato
  return $nombre;

}
/*
Funcion para traer el municipio de un usuario
parametros

$conexion = conexion con la base de datos
$id_u = identificador del usuario
*/
function getMunicipio($conexion,$id_u){
  //Consultamos en la tabla usuario con id del usuario
  $query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE id='$id_u'");
  $row = mysqli_fetch_array($query);
  //Traemos el munisipio del usuario y lo guardamos en una variable
  $nombre = $row['municipio'];
  //Retornamos el dato
  return $nombre;
}

/*
Funcion para insertar un comentario
parametros

$conexion = conexion con la base de datos
$mensaje = comentario
$id_u = identificador del usuario
$id_p = identificador del proyecto
$id_c = identificador del creador del proyecto
$link = ubicacion (url) del proyecto
*/
function insertarComentario($conexion,$mensaje,$id_u,$id_p,$id_c,$link){
  //Verificamos que el mensaje no este vacio
  if($mensaje != ""){
    //Insertamos el comentario
    $query = mysqli_query($conexion,"INSERT INTO `comentarios`(`id_c`, `id_u`, `id_p`, `mensaje`) VALUES (NULL,$id_u,$id_p,'$mensaje')");
    if($query){
      //Si se inserto con exito, llamamos a la funcion para generar una notificaion le pasamos los parametros y mostramos mensajes
      generarNotificacion($conexion,$id_c,"Alguien a comentado tu proyecto","Comentario","novisto",$link);
      echo "<script>alert('Comentario Enviado')</script>";
      echo "<script>window.location='$link'</script>";

    }else{
      //Si el insert no funciono, enviamos un mensaje
      echo "<script>alert('Error')</script>";
    }
  }else{
    //Si el mensaje esta vacio enviamos un mensaje
    echo "<script>alert('El mensaje no es apropiado')</script>";
  }
}

/*
Funcion para generar una notificaion
parametros

$conexion = conexion con la base de datos
$id_c = identificador del creador del proyecto
$parrafo = contenido de la notificacion
$sobre = titulo de la notificacion
$estado = visto o no visto
$link = ubicacion (url) de donde viene la notificacion
*/
function generarNotificacion($conexion,$id_c,$parrafo,$sobre,$estado,$link){
  //Insertamos los datos, entre ellos el mensaje y estado, fecha
  $query = mysqli_query($conexion,"INSERT INTO `notificaciones`(`id_n`, `id_user`, `parrafo_n`, `sobre`, `estado`, `link`) VALUES (NULL,$id_c,'$parrafo','$sobre','$estado','$link')");
  if(!$query){
    //Si el insert falla mostramos un mensaje
    echo "<script>alert('Error notificacion')</script>";
  }
}

/*
Funcion para actualizar el estado de las notificaciones
parametros

$conexion = conexion con la base de datos
$id_n = identificador de la notificacion
*/
function notificacionVista($conexion,$id_n){
  //Actualizamos el estado a visto de la notificaion
  $query = mysqli_query($conexion,"UPDATE notificaciones SET estado='visto' WHERE id_n='$id_n'");
}

/*
Funcion para traer el link de una notificaion
parametros

$conexion = conexion con la base de datos
$id_n = identificador de la notificacion
*/
function consultaLink($conexion,$id_n){
  //Consultamos en las notificaciones con el id de la notificaion
  $query = mysqli_query($conexion,"SELECT * FROM notificaciones WHERE id_n = '$id_n'");
  $row = mysqli_fetch_array($query);
  //Traemos el dato y guardamos el dato en una variable
  $link = $row['link'];
  //Retornamos el dato
  return $link;
}

/*
Funcion para actualizar la fecha actual de un proyecto
parametros

$conexion = conexion con la base de datos
$id_p = identificador del proyecto
*/
function actualizarFecha($conexion,$id_p){
  //Se actualiza la fecha actual con la hora local del servidor
  $query = mysqli_query($conexion,"UPDATE meta SET fecha_actual=current_timestamp() WHERE id_proyecto='$id_p'");
}

/*
Funcion para mostrar la descripcion de una notificacion
parametros

$conexion = conexion con la base de datos
$id_n = identificador de la notificacion
*/
function getDrescripcionNotificacion($conexion,$id_n){
  //Consultamos en las notificaiones
  $query = mysqli_query($conexion,"SELECT * FROM notificaciones WHERE id_n='$id_n'");
  $num = mysqli_num_rows($query);
  //Confirmamos que si allan notificaciones
  if($num >0){
    $row = mysqli_fetch_array($query);
    //Traemos el dato y lo guardamos en una variable
    $description = $row['descripcion'];
  }
  //Retornamos el dato
  return $description;

}

/*
Funcion para mostrar el motivo del reporte
parametros

$conexion = conexion con la base de datos
$id_4 = identificador del reporte
*/
function getSobreReporte($conexion,$id_r){
  //Consultamos los reportes
  $query = mysqli_query($conexion,"SELECT * FROM reportes WHERE id_re='$id_r'");
  $num = mysqli_num_rows($query);
  //Confirmamos que si allan reportes
  if($num >0){
    $row = mysqli_fetch_array($query);
    //Traemos el dato y lo guardamos en una variable
    $sobre= $row['motivo'];
  }
  //Retornamos el dato
  return $sobre;
}

/*
Funcion para mostrar el saldo de un usuario
parametros

$conexion = conexion con la base de datos
$id_u = identificador del usuario
*/
function getSaldo($conexion,$id_u){
  //Consultamos en los usuarios
  $query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE id=$id_u");
  $num = mysqli_num_rows($query);
  //Confirmamos que el usuario exista
  if($num >0){
    $row = mysqli_fetch_array($query);
    //Traemos el dato y lo guardamos en una variable
    $saldo= $row['saldo'];
  }
  //Retornamos el dato
  return $saldo;

}

/*
Funcion para insertar el saldo
parametros

$conexion = conexion con la base de datos
$id_u = identificador del usuario
$saldo = saldo actual del usuario
*/
function setSaldo($conexion,$id_u,$saldo){
  //Actualizamos el saldo que por defecto es 0
  $query = mysqli_query($conexion,"UPDATE `usuarios` SET `saldo`='$saldo' WHERE id=$id_u");
  if($query){
    //Si el saldo se actualizo correctamente mostramos mensajes, y redirecionamos
    echo "<script>alert('Recargado correctamente')</script>";
    echo "<script>window.location='recargar.php'</script>";

  }
}

/*
Funcion para aportar a un proyecto
parametros

$conexion = conexion con la base de datos
$saldo = saldo actual del usuario
$dinero = cantidad a donar
$id_p = identificador del proyecto
$id = identificador del usuario donador
$link = ubicacion (url) del proyecto
$id_c = identificador del creador del proyecto
*/
function donar($conexion,$saldo,$dinero,$id_p,$id,$link,$id_c){
  //Confirmamos que el usuario tenga mas saldo del que quiere donar
  if($saldo <= $dinero){
    echo "<script>alert('No tienes suficiente dinero, Recarga...')</script>";
  }else{
    //Verificamos que la donacion sea mallor a 100
    if($dinero > 100){
      //Le restamos al saldo la cantidad de la donacion
        $saldo = $saldo-$dinero;
      //Actualizamos el saldo del usuario
      $query = mysqli_query($conexion,"UPDATE `usuarios` SET `saldo`='$saldo' WHERE id='$id'");
      if($query){
        //Traemos el dinero actual del proyecto y le sumamos la donacion
        $query = mysqli_query($conexion,"SELECT * FROM meta WHERE id_proyecto = '$id_p'");
        $row = mysqli_fetch_array($query);
        $dinero2 =$row['dinero_actual'] + $dinero;
        //Traemos el numero de aportadores del proyecto y le sumamos 1
        $query = mysqli_query($conexion,"SELECT * FROM proyecto WHERE id= '$id_p'");
        $row = mysqli_fetch_array($query);
        $con = $row['n_con'] +1;
        //Insertamos el nuevo dinero actual del proyecto y el numero de seguidores
        $query = mysqli_query($conexion,"UPDATE `proyecto` SET `n_con`='$con' WHERE id='$id_p'");
        $query = mysqli_query($conexion,"UPDATE `meta` SET `dinero_actual`='$dinero2' WHERE id_proyecto='$id_p'");
        if($query){
          //Llamamos a la funcion generar una notificacion y le mostramos al creador del proyecto que alguien le a donado
          generarNotificacion($conexion,$id_c,'Alguien contribuyo $'.$dinero.' a tu proyecto','Contribucion','novisto',$link);
          //Registramos en otra tabla la donacion
          $query = mysqli_query($conexion,"INSERT INTO `donaciones`(`id`, `id_user`, `id_p`,`cantidad`) VALUES (NULL,'$id','$id_p','$dinero')");
          //Mostramos mensaje
          echo "<script>alert('Exito!!')</script>";
          echo "<script>window.location='$link'</script>";

        }
      }
    }else{
      echo "<script>alert('No puedes donar esta cantidad de dinero')</script>";
    }
    
  }
}

/*
Funcion para notificar cuando un proyecto llega a la meta de dinero
parametros

$conexion = conexion con la base de datos
$id_p = identificador del proyecto
$id_c = identificador del creador del proyecto
$link = ubicacion (url) del proyecto
*/
function notiMetaDinero($conexion,$id_p,$id_c,$link){
  //Traemos el dinero a recaudar y el dienro actual de un proyecto
  $query = mysqli_query($conexion,"SELECT * FROM meta WHERE id_proyecto='$id_p'");
  $row = mysqli_fetch_array($query);
  //Verificamos que ya no se le aya notificado
  $query = mysqli_query($conexion,"SELECT * FROM notificaciones WHERE sobre='Completado' AND id_user='$id_c' ");
  $num = mysqli_num_rows($query);
  if($num != 0){
      //Verificamos que el diero actual es igual o superior al dinero a recaudar
      if($row['dinero_actual'] >= $row['dinero']){
      //Llamamos a la funcion generar notificacion
      generarNotificacion($conexion,$id_c,'Tu proyecto acaba dde llegar a su meta de dinero ','Copletado','novisto',$link);
     }
  } 
}

/*
Funcion para notificar cuando un proyecto termino su tiempo
parametros

$conexion = conexion con la base de datos
$id_p = identificador del proyecto
$id_c = identificador del creador del proyecto
$link = ubicacion (url) del proycto
*/
function notiMetaDias($conexion,$id_p,$id_c,$link){
  //Traemos los dias que le quedan al proyecto
  $query = mysqli_query($conexion,"SELECT * FROM meta WHERE id_proyecto='$id_p'");
  $row = mysqli_fetch_array($query);
  //Verificamos que no se le aya notificado antes
  $query = mysqli_query($conexion,"SELECT * FROM notificaciones WHERE sobre='Tiempo de recaudacion terminado' AND id_user='$id_c' ");
  $num = mysqli_num_rows($query);
  if($num < 1){
    //Verificamos que los dias que le quedan al proyecto sean igual a 0
    if($row['dias'] == 0){
      //Actualisamos el estado a terminado
      $query = mysqli_query($conexion,"UPDATE proyecto SET estado='terminado' WHERE id='$id_p'");
      //Verificamos si alcanzo su meta de dinero
      if($row['dinero_actual'] >= $row['dinero']){
      //Notificamos que a terminado su tiempo de recaudacion y que alcanzo su meta de dinero
      generarNotificacion($conexion,$id_c,'Tu proyecto ya finalizo con sus dias establecidos alcansaste tu meta','Tiempo de reaudadcion terminado','novisto',$link);
      generarNotificacion($conexion,$id_c,'Tu proyecto ya finalizo con sus dias establecidos alcansaste tu meta','Tiempo de reaudadcion terminado','novisto','ver.php?pro='.$id_p);
     }else{
      //Notificamos que su tiempo se ha terminado y que puede volver a intentarlo luego
      generarNotificacion($conexion,$id_c,'Tu proyecto ya finalizo con sus dias establecidos pero  no recaudaste lo suficiente vuleve a intetarlo luego','Tiempo de reaudadcion terminado','novisto',$link);
     }
    }
  }
  
}

/*
Funcion para guardar una imagen de usuario
parametros

$conexion = conexion con la base de datos
$nombreImagen = nombre de la imagen
$tmp = tipo de archivo
$id = identificador del usuario
*/
function setImagen($conexion,$nombreImagen,$tmp,$id){
  //Definimos la ruta de la imagen
  $archivo = "img/".$nombreImagen;
  //Movemos la imagen a una carpeta
  move_uploaded_file($tmp,$archivo);
  //Actualizamos en la base de datos la direccion de la imagen
  $query = mysqli_query($conexion,"UPDATE `usuarios` SET `foto`='$archivo' WHERE id='$id'");
  //Mostramos un mensaje
  if($query){
      echo "<script>alert('enviada')</script>";
  }else{
      echo "<script>alert('Error')</script>"; 
  }
}

/*
Funcion para mostrar una imagen de perfil de un usuario
parametros

$conexion = conexion con la base de datos
$id_u = identificador del usuario
*/
function getImagen($conexion,$id){
  //Consultamos en los usuarios
  $query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE id='$id'");
  $row = mysqli_fetch_array($query);
  //Traemos la direccion de una imagen y la guardamos en una variable
  $imagen = $row['foto'];
  //Retornamos la direccion
  return $imagen;
}

/*
Funcion para recuperar la contraseña
parametros

$conexion = conexion con la base de datos
$correo = correo electronico
*/
function olvidasteContrasena($conexion,$correo){
  //Verificamos que el correo no este vacio
  if($correo == ""){
    //Abrimos un modal con un mensaje
    ?>
      <script>
       $('#contrasena').modal('show');
      </script>
      <div class="alert alert-danger text-center" role="alert">
      Ingrese el correo!
      </div>
      <?php
  }else{
    //Consutamos que el correo si este registrado
    $query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE correo='$correo'");
    if(!$query){
      ?>
        <script>
          $('#contrasena').modal('show');
          
        </script>
        <div class="alert alert-danger text-center" role="alert">
        Problemas para conectar con el servidor, intente mas tarde
        </div>
        <?php
    }
  }
}

/*
Funcion para calcular el porcentaje del dinero actual de un proyecto
parametros

$dinero = meta de dinero
$dinero_a = dinero actual
*/
function porcentaje($dinero,$dinero_a){
  //Dividimos el dinero meta con el dinero actual y lo multiplicamos por 100
  $porcentaje = ($dinero_a /$dinero )*100;
  //Si el porcentaje es mayor a 100 lo dejamos en 100
    if($porcentaje > 100){
      $porcentaje = 100;                  
    }
    //Retornamos el dato
    return $porcentaje;
}

/*
Funcion para actualizar los dias de un proyecto
parametros

$conexion = conexion con la base de datos
$id_p = identificador del proyecto
*/
function contarDias($conexion,$id_p){
  //Consultamos los datos del proyecto
  $query = mysqli_query($conexion,"SELECT * FROM meta WHERE id_proyecto='$id_p'");
  $row = mysqli_fetch_array($query);
  $dias = $row['dias'];
  $fecha_a = $row['fecha_actual'];
  $fecha_limite =$row['fecha_limite'];
  $fecha = date("Y-m-d");
  //Verificamos si la fecha del servidor es mayor a la fecha actual
  if($fecha > $fecha_a){
    //Le restamos a los dias un dia
    $dias = $dias- 1;
    //Actualizamos los dias en la base de datos
    $query = mysqli_query($conexion,"UPDATE `meta` SET `fecha_actual`='$fecha',`dias`='$dias' WHERE id_proyecto='$id_p'");
  }

}

/*
Funcion para mostrar el titulo de los proyectos destacados
parametros

$conexion = conexion con la base de datos
$num = numero del proyecto destacado
*/
function mostrarTituloDestacado($conexion,$num){
  //Consultamos que proyecto esta en destacados
  $query = mysqli_query($conexion,"SELECT * FROM destacados WHERE num='$num' order by num asc limit 1");
  $row = mysqli_fetch_array($query);
  $id_ps = $row['id_p'];
  //Traemos el nombre del proyecto
  $query = mysqli_query($conexion,"SELECT * FROM proyecto WHERE id='$id_ps'");
  $row = mysqli_fetch_array($query);
  $titulo = $row['nom_proyecto'];
  //Retornamos el dato
  return $titulo;
}

/*
Funcion para mostrar el parrafo principal de los proyectos destacados
$conexion = conexion con la base de datos
$num = numero del proyecto
*/
function mostrarParrafoDestacado($conexion,$num){
  //Consultamos que proyecto esta en destacados
  $query = mysqli_query($conexion,"SELECT * FROM destacados WHERE num='$num' order by num asc limit 1");
  $row = mysqli_fetch_array($query);
  $id_ps = $row['id_p'];
  //Traemos el parrafo del proyecto
  $query = mysqli_query($conexion,"SELECT * FROM proyecto WHERE id='$id_ps'");
  $row = mysqli_fetch_array($query);
  $parrafo_p = $row['p_principal'];
  //Retornamos el dato
  return $parrafo_p;
}

/*
Funcion para mostrar la imagen principal de los proyectos destacados
parametros

$conexion = conexion con la base de datos
$num = numero del proyecto
*/
function mostrarImagenDestacado($conexion,$num){
  //Consultamos que proyecto esta en destacados
  $query = mysqli_query($conexion,"SELECT * FROM destacados WHERE num='$num' order by num asc limit 1");
  $row = mysqli_fetch_array($query);
  $id_ps = $row['id_p'];
  //Traemos la direccion de la imagen del proyecto
  $query = mysqli_query($conexion,"SELECT * FROM proyecto WHERE id='$id_ps'");
  $row = mysqli_fetch_array($query);
  $imagen = $row['imagen_p'];
  //Retornamos el dato
  return $imagen;
}

/*
Funcion para mostrar el video principal de los proyectos destacados
parametros

$conexion = conexion con la base de datos
$num = numero del proyecto
*/
function mostrarVideoDestacado($conexion,$num){
  //Consultamos que proyecto esta en destacados
  $query = mysqli_query($conexion,"SELECT * FROM destacados WHERE num='$num' order by num asc limit 1");
  $row = mysqli_fetch_array($query);
  $id_ps = $row['id_p'];
  //Traemos la direccion del video del proyecto
  $query = mysqli_query($conexion,"SELECT * FROM proyecto WHERE id='$id_ps'");
  $row = mysqli_fetch_array($query);
  $video = $row['video_p'];
  //Cortamos la direccion del video donde alla un = y guardamos el recorte en una variable
    list($palabra1, $palabra2) = explode('=', $video);    
  //Mostramos el video
   $video ='<iframe width="560" height="315" src="https://www.youtube.com/embed/'.$palabra2.'" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
  //Retornamos la vista del video 
  return $video;
}

/*
Funcion para Traer el id de los proyectos destacados
parametros

$conexion = conexion con la base de datos
$num = numero del proyecto
*/
function mostrarIdDestacado($conexion,$num){
  //Consultamos en destacados un proyecto
  $query = mysqli_query($conexion,"SELECT * FROM destacados WHERE num='$num' order by num DESC limit 1");
  $row = mysqli_fetch_array($query);
  $id_ps = $row['id_p'];
  //Retornamos el id
  return $id_ps;
}
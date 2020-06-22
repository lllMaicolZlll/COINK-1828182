  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<?php 
//Iniciamos una sesion
session_start();
//Incluimos la conexion
include('php/conexion.php');
//Incluimos las funciones
include('php/funciones.php');
?>

<!--https://www.dafont.com/es/heydings-icons.font
    https://www.dafont.com/es/multimedia-icons.font
    https://www.dafont.com/es/aquawax-pro-pictograms.font -->

    <!-- esta es especial
     https://www.dafont.com/es/e-commerce.font-->


<!doctype html>
<html lang="en">
<head>

  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.9.0/css/all.css"integrity="sha384-i1LQnF23gykqWXg6jxC2ZbCbUMxyw5gLZY6UiUS98LYV5unm8GWmfkIS6jqJfb4E" crossorigin="anonymous">
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="css/est.css">
  <link rel="stylesheet" href="css/estilo_perfil.css">
 
 
  <link rel="stylesheet" href="css/estilo_subida.css">
  <link rel="stylesheet" href="css/estilo_vista.css">
  <link rel="stylesheet" href="css/estilo_carta.css">
  <link rel="stylesheet" href="bcss/bootstrap.min.css">
  <title>Coink | Colombia Viva</title>
  <script src="Bjs/bootstrap.min.js"></script>

  <!--Libreria Php miler-->

    

  <!--Fin Php miler-->
</head>
<body style="user-select:none; ">



<form action="<?php $_SERVER['PHP_SELF']?>" method="post">
  <div class="con container-fluid py-2">
  <div class="row ">
    <div class="col-12 ">
      <span class="navbar-toggler-icon"></span>
    <a class="navbar-brand text-danger font-weight-bold" href="index.php"><i class="fas fa-piggy-bank text-danger"></i>COINK</a>

       

  <?php
  //Verificamos si hay activa una sesion
if(isset($_SESSION['id'])){
  $id = $_SESSION['id'];
//Consultamos los datos del usuario
$query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE id='$id'");  
/*
$row = array con los datos de un usuario
$nombre = nombres de un usuario
$saldo = saldo de un usuario
$cargo = cargo del usuario
*/
$row = mysqli_fetch_array($query);
$nombre = $row['nombres'];
$saldo = $row['saldo'];
$cargo = $row['cargo'];
//Si el cargo es recargar se redireciona a recargar
if($cargo == 'rec'){
  echo "<script>window.location='recargar.php'</script>";
}
//Verificamos de que parte viene el usuario
if($link == "sub-pro.php" || $link == "admin_p.php"){
  ?>
  <?php
}else{
  //Verificamos si el cargo es admin
  if($cargo = $row['cargo'] == "admin"){
    //Le mostramos un boton para que pueda ir a administrar los proyectos
    ?>
    <a class="btn subir text-danger" href="admin_p.php"><span style="cursor:pointer;">Administrar proyectos</span> </a>
    <?php
  }else{
      ?>
    </form>
    <?php
    //Si es un usuario estandar, confirmamos que tenga los datos suficientes para subir un proyecto
    if($row['identificacion']>0 && $row['dirrecion'] != "" && $row['fecha']!=""){
      //Consultamos si el usuario tiene algun proyecto
      $query = mysqli_query($conexion,"SELECT * FROM proyecto WHERE id_user='$id'");
      $num = mysqli_num_rows($query);
      $row = mysqli_fetch_array($query);
      //Con firmamos si el proyecto no esta baneado
      if($num >0 && $row['estado'] != "ban" ){
        //Traemos los datos del proyecto
        //$id_p2 = identificador del proyecto del usuario
        $id_p2 = $row['id'];
        //$titulo = titulo del proyecto del usuario
        $titulo = $row['nom_proyecto'];
        //Abilitamos un boton para que pueda administrar su proyecto
        ?>
        <button class="btn subir text-danger" name="admin_p"><span style="cursor:pointer;"> Administrar <?php echo $titulo?></span> </button>
        <?php
      }else{
        //Si no tiene ningun proyecto abilitamos un boton para subir un proyecto
       ?>
      <a class="btn subir text-danger" href="sub-pro.php"><span style="cursor:pointer;"> Subir un proyecto</span> </a>
      <?php 
      }
      
    }else{
      //Si no tiene los datos suficientes para subir un proyecto, le abilitamos un modal para subir los datos
      ?>
      <a class="btn  subir text-danger" data-toggle="modal" data-target="#registroDos"><span style="cursor:pointer;"> Subir un proyecto</span> </a>
      <?php
    }
  }
}

  ?>
   <div class="btn-group mr-4 float-right">
   <p class="subir text-danger" style="font-size:20px; margin:5px;"><span class=" " ><?php  echo "$".$saldo ?></span> </p>

  <button type="button" class="btn btn-outline-danger dropdown-toggle border-0 " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
  <?php
  //Funcion para traer la imagen de un usuario
    $imagen = getImagen($conexion,$id);
    //Si el usuario no tiene una imagen se muestra una por defecto
    if($imagen == ""){
      ?>
      <img type ="file" src="img/ava.png " class="img-fluid rounded-circle img_button" alt="Responsive image">
      <?php
    }else{
      //Si, si tiene una imagen la mostramos
      ?>
      <img type ="file" src="<?php echo $imagen?>" class="img-fluid rounded-circle img_button" alt="Responsive image">
      <?php
    }
 ?>
  </button>

  <div class="dropdown-menu float-left mr-5" >

          <i class="fas fa-user-edit text-danger ml-1 float-left" ><input  class="btn  subir text-dark" type="submit" name="perfil" value="<?php echo $nombre?>"> </i>
          <?php
          //Consultamos si el usuario tiene notificaciones en estado no visto
          $query = mysqli_query($conexion,"SELECT * FROM notificaciones WHERE id_user='$id' AND estado='novisto'");
          $num = mysqli_num_rows($query);
          if($num == 0){
            //Si no tiene notificaciones nuevas mostramos solo el boton notificaciones
            ?>
            <i class="far fa-bell text-danger ml-1 float-left"><input class="btn  subir text-dark" type="submit" name="noti" value="Notificaciones"></i>
            <?php
          }else{
            //Si tiene notificaciones nuevas mostramos el boton de notificacion con diferente estilo y el numero de notificaciones nuevas
            ?>
            <i class="fas fa-bell text-danger ml-1 float-left"><input class="btn  subir text-dark" type="submit" name="noti" value="Notificaciones <?php echo $num?>"></i>
            <?php
          }
          if($cargo=='admin'){
            //Si el usuario es un admin mostramos un nuevo boton para ver los proyectos terminados
            ?>
            <i class="fas fa-check text-danger ml-1 float-left"><input class="btn  subir text-dark" type="submit" name="terminados" value="Terminados"></i>
            <?php
          }
          ?>
              <i class="far fa-times-circle text-danger ml-1 float-left"><input class="btn  subir text-dark" type="submit" name="cerrar" value="Cerrar sesión"></i>

  </div>
</div>
      
    </div>
  </div>

</div>
<?php
     
}else{ 
      //Mostramos los boton para abrir los modales de inicio de sesion y registro de usuario
  ?>
      <a class="text-dark " style="float:right; padding:10px; cursor:pointer;"  onclick="$('#registro').modal('show')"><i class="fas fa-user-plus text-danger" ></i> Registrarse</a>
      <a class="text-dark  " style="float:right; padding:10px; cursor:pointer;"  onclick="$('#iniciar').modal('show')"><i class="fas fa-sign-in-alt text-danger"> </i>Iniciar sesión</a>
      
      </div>
    </div>
  
  </div>
  
  <?php
  }
  //Si presiona el boton terminados redireccionamos a la pagina de proyectos terminados
  if(isset($_POST['terminados'])){
    header("Location:terminados.php");
  }
  //Si presiona el boton notificaciones redireccionamos a la pagina de notificaciones
  if(isset($_POST['noti'])){
    header("Location:notificaciones.php");
  }
  //SI presiona el boton perfil refireccionamos a la pagina del perfil
    if(isset($_POST['perfil'])){
      header("Location:perfil.php");
    }
    //Si preciona el boton cerrar se cierra la sesion y se redirecciona a la ruta en la que cerro sesion
    if(isset($_POST['cerrar'])){
     
    session_destroy();
    header("Location: $link");
    }

?>


  <br>

  <div class="container">
    <div class="row" >
      <div class="col-sm-4 col-lg-4">
      <?php
      //Mostramos las categorias con su respectivo link y color
      echo "<a href='categoria.php?cate=eventos&color=violet' style=''class='btn6 btn btnn'><i class='fas fa-glass-cheers'></i> Eventos</a>";
      echo "<a href='categoria.php?cate=ecologia&color=yellowgreen' class='btn3 btn'><i class='fas fa-leaf'> </i> Ecológico</a>";
      echo "<a href='categoria.php?cate=deportes&color=red' class='btn4 btn'> <i class='fas fa-running' ></i> Deportes</a>";
      ?> 
      </div>
      <?php
      //Si el usuario biene de subir un proyecto, no mostramos nada
      if($link == "sub-pro.php"){
        ?>
        <div class="col-sm-4 col-lg-3 buscador">
        </div>
        <?php
      }else{
        //Buscador
        ?>
        <div class="col-sm-3 col-3 buscador">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="input-group">
      <input class="form-control buscador" type="text"  placeholder="Buscar" aria-label="Bucar" name="palabra">
      <button class="btn btn-outline-danger my-2 my-sm-0" type="submit" name="buscar"><i class="fas fa-search"></i></button>
      </div>
      </form>
      </div>
      <?php
      }
      ?>
      
      
      <div class="col-sm-4 col-lg-5" >
      <?php
       echo "<a class='btn2 btn' href='categoria.php?cate=arte&color=blue'> <i class='fas fa-paint-brush'> </i> Arte</a>";
       echo "<a href='categoria.php?cate=productos&color=gold' class='btn5 btn btnn'> <i class='fas fa-box-open'> </i> Productos</a>";
       echo "<a href='categoria.php?cate=fundaciones&color=orangered' class='btn7 btn btnn'><i class='fas fa-home'> </i> Fundaciones</a>";
      ?>
      </div>
      <div class="col-12">
        <hr >
      </div>
    </div>
  </div>





  <!-- Inicio de session -->
  <div class="modal fade " id="iniciar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">

    <!--Content-->
    <div class="modal-content ">

      <!--Body-->
     
        <div class="modal-body mb-0 p-0 m-5">
      <h1 class="text-center text-muthed">Inicio de sesión</h1>
  <hr>
      <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
  <div class="form-col">
    <div class="form-group">
      <label for="inputEmail4">Correo</label>
      <input type="text" class="form-control uno" id="inputEmail4" placeholder="Correo" name="correo">
    </div>
    <div class="form-group">
      <label for="inputPassword4">Contraseña</label>
      <input type="password" class="form-control uno" id="inputPassword4" placeholder="Contraseña" name="contra">
    </div>
  </div>
  <?php 
  //Si presiona el boton iniciar se ejecuta la funcion iniciarSesion
  if(isset($_POST['iniciar'])){
      iniciarSesion($_POST['correo'],$_POST['contra'],$conexion,$link);
   
   }
   //Si presiona en buscar envia la palabra a la pagina buscador
   if(isset($_POST['buscar'])){
      $palabra = $_POST['palabra'];
      echo "<script>window.location='buscador.php?pa=$palabra'</script>";
   }
    
  

  ?>
  <center>  
  <div class="modal-footer justify-content-center flex-column flex-md-row">
        <i class="fas fa-universal-access text-danger"><input type="submit"class="navbar-brand btn  subir text-dark font-weight-bold" value="Iniciar sesion" name="iniciar"></i>
      </div>

      <a onclick=" $('#iniciar').modal('hide');$('#contrasena').modal('show')"><span class="mr-4 text-danger" style="cursor:pointer">¿Olvidaste la contraseña?</span></a>
      <a onclick=" $('#iniciar').modal('hide');$('#registro').modal('show')"><span class="mr-4 text-danger" style="cursor:pointer">¡Registrate..!</span></a>
      
    </div>
     
  </div>
  </center>
  </form>
</div>
        </div>
      </div>
  </div>
</div>

<!--Modal de olvidaste tu contraseña-->
<div class="modal fade" id="contrasena" tabindex="-1" role="dialog" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="text-center">Recupera tu cuenta</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="recuperar_contraseña.php" method="post">
      <div class="modal-body">
        <label for="inputEmail4">Ingresa tu correo electrónico para recuperar tu cuenta.</label>
        <input type="email" class="form-control" id="inputEmail4" placeholder="Ej. usuario@servidor.com" name="recuperar_correo">
      </div>
      
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Cancelar</button>
        <input type="submit" class="btn" name="enviar_correo" value="Enviar">
        </form>
      </div>
    </div>
  </div>
</div>
   <!--Fin modal de olvidaste la contraseña-->

<!-- Modal registrarse -->
<div class="modal fade" id="registro" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">

    <!--Content-->
    <div class="modal-content">

      <!--Body-->
      <div class="modal-body mb-0 p-0 m-5">
      <h1 class="text-center text-muthed">Registrate</h1>
  <hr>
      <form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Nombres</label>
      <input type="text" class="form-control uno" id="inputEmail4" placeholder="Nombres" name="nombre">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Apellidos</label>
      <input type="text" class="form-control uno" id="inputPassword4" placeholder="Apellidos" name="apellidos">
    </div>
  </div>
  <div class="form-group">
    <label for="inputAddress">Correo electrónico</label>
    <input type="email" class="form-control uno" id="inputAddress" placeholder="mail@mail.com" name="correo">
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Contraseña</label>
      <input type="password" class="form-control uno" id="inputEmail4" placeholder="Contraseña" name="contra">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Repite la contraseña</label>
      <input type="password" class="form-control uno" id="inputPassword4" placeholder="Contraseña" name="contra1">
    </div>
  </div>
  <center>
  <?php 
  //Si presiona el boton registrar se ejecuta la funcion registrarUser
  if(isset($_POST['registrar'])){
    registrarUser($conexion,$_POST['nombre'],$_POST['apellidos'],$_POST['correo'],$_POST['contra'],$_POST['contra1']);
  }
    
  ?>
  <div class="custom-control custom-checkbox mb-3">
    <label class="text-muthed" for="customControlValidation1">Al registrarte acepta los <a href="">Términos y condiciones</a></label>
    <div class="invalid-feedback">Example invalid feedback text</div>
  </div>
  <div class="modal-footer justify-content-center flex-column flex-md-row">
  <i class="fas fa-universal-access text-danger"><input type="submit" class="navbar-brand btn  subir text-dark font-weight-bold" name="registrar" value="Registrarse" ></i>
        <!-- Si presiona click se cierra el modal de registro y se abre el de iniciar sesion -->
        <a onclick="$('#registro').modal('hide');$('#iniciar').modal('show')"><span class="mr-4 text-danger" style="cursor:pointer">¿Ya tienes una cuenta?</span></a>
      </div>
  </center>
</form>
</div>     
    </div>
  </div>
</div>

<!-- Modal formulario para subir un proyecto -->
<div class="modal fade" id="registroDos" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
<!--Body-->
<div class="modal-body mb-0 p-0 m-5">
<h1 class="text-center text-muthed">Rellena estos casos</h1>
<hr>
<form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail4">Numero de documento</label>
<input type="text" class="form-control uno" id="inputEmail4" placeholder="1001236452" name="iden">
</div>

<div class="form-group col-md-6">
<label for="inputPassword4">Fecha de nacimiento</label>
<input type="date" class="form-control uno" id="inputPassword4" name="fecha">
</div>
</div>
<div class="form-group">
<label for="inputAddress">Dirección</label>
<input type="text" class="form-control uno" id="inputAddress" placeholder="Calle 18 No 106-64" name="direccion">
</div>
<div class="form-row">
<div class="form-group col-md-6">
<label for="inputEmail4" >Municipio</label>
<select id="inputState"name="municipio" class="form-control">
  <option class="dropdown-header">Municipio</option>
  <option>Medellín</option>
  <option>Envigado</option>
  <option>Itaüí</option>
  <option>Bello</option>
  <option>Sabaneta</option>
  <option>Barbosa</option>
  <option>Girardota</option>
  <option>Copacabana</option>
  <option>La estrella</option>
  <option>Caldas</option>
</select>
</div>
<div class="form-group col-md-6">
<label for="inputPassword4">Contraseña</label>
<input type="password" class="form-control uno" id="inputPassword4" placeholder="Contraseña" name="contra">
</div>
</div>
<center>
<?php
//Si presiona completar se ejcuta la funcion registroDos
if(isset($_POST['completar'])){
  registroDoos($id,$conexion,$_POST['iden'],$_POST['fecha'],$_POST['direccion'],$_POST['municipio'],$_POST['contra']);
}
//Si presiona administrar proyecto, envia a la pagina del proyecto
if(isset($_POST['admin_p'])){
  echo "<script>window.location='ver.php?pro=$id_p2'</script>";
}
?>
<div class="custom-control custom-checkbox mb-3">
<label class="text-muthed" for="customControlValidation1">Asegurese de leer los <a href="">Términos y condiciones</a></label>
<div class="invalid-feedback">Example invalid feedback text</div>
</div>
<div class="modal-footer justify-content-center flex-column flex-md-row">
<i class="fas fa-universal-access text-danger"><input type="submit" class="navbar-brand btn  subir text-dark font-weight-bold" name="completar" value="Completar" ></i>
</div>
</center>
</form>
</div>     
</div>
</div>
</div>

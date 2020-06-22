<?php 
  //Definimos la ruta en la que estamos
   $link = "perfil.php";
   //Incluimos el menu
   include("menu.php");
   
  //Si nos traen un dato por metodo get lo consultamos en usuarios
  if(isset($_GET['user'])){
    //$id_user = identificacion del usuario que queremos ver su perfil
    $id_user = $_GET['user'];
    $query= mysqli_query($conexion,"SELECT * FROM usuarios WHERE id='$id_user'");
    $num = mysqli_num_rows($query);
    //Treamos los datos
    if($num > 0){
      ?>
<br><br> <br>

    <center> 
    <div class="container">
    <?php
    //Mostramos la imagen del usuario
    $imagen = getImagen($conexion,$id_user);
    //Si no tiene una imagen se pone una standar
    if($imagen == ""){
      ?>
      <img type ="file" src="img/ava.png " class="im-p "alt="">
      <?php
    }else{
      //Si el usuario si tiene una foto, se muestra
      ?>
      <img type ="file" src="<?php echo $imagen?>" class="im-p "alt="">
      <?php
    }
    //Escribirmos los datos publicos del usuario nombres, apellidos, descripcion y municipio
    echo "<br>".getNombre($conexion,$id_user)." ".getApellido($conexion,$id_user);
    echo "<br><br> <p class='text-muthed'>".getDescripcion($conexion,$id_user)."</p>";
    echo "<br>".getMunicipio($conexion,$id_user)."</p>";

    ?>
      <?php
    }else{
      //Si no hay usuarios registrados que coincidan con el dato obtenido por get, se redirecciona al index
      echo "window.location='index.php'";
    }
  }else{
    //Si no resivimos ningun dato por get consultamos los datos del usuario
    $query= mysqli_query($conexion,"SELECT * FROM usuarios WHERE id='$id'");
if(!$query){
echo "error en el query";
}
$row= mysqli_fetch_array($query);
?>
<br><br> <br>

<center> 
<div class="container">
<?php
//Mostramos la imagen de perfil
$imagen = getImagen($conexion,$id);
if($imagen == ""){
  ?>
  <img type ="file" src="img/ava.png " class="im-p "alt="">
  <?php
}else{
  ?>
  <img type ="file" src="<?php echo $imagen?>" class="im-p "alt="">
  <?php
}

 ?>

<form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
<br><br>
<?php 
//Mostramos un boton para editar el perfil, este abilita un formulario
      if(isset($_POST['editar_perfil'])){?>
     <center>
      <div class="col-lg-8">
       <div class="input-group mb-3">
      <div class="custom-file">
        <input type="file" class="bg-secondary text-light btn w-100" name="img">
      </div>

      </div>
     
     </center>
      
      <div class="input-group-append">
      
    </div>
        <?php
       } ?>
  
  <?php 
      if(isset($_POST['editar_perfil'])){
        ?>
       <input type="submit" value="Guardar" class=" btn btn-danger btn-sm" name="guardar_perfil">
       <input type="submit" value="Cancelar" class=" btn btn-secondary btn-sm" name="cancelar">
      </form>
      <br>
       <input type="submit" value="Canbiar contraseña" class=" btn btn-secondary btn-sm" data-toggle="modal" data-target="#cambiar">
       <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">

        <?php
      }else{?>
        <input type="submit" value="Editar perfil" class=" btn btn-secondary btn-sm" name="editar_perfil">
        
        <?php
      }
      
      ?>
<p class="text-center display-4"><?php echo $row['nombres']," ",$row['aprellidos']?></p>
<p class="">Medellin</p><hr>
<div class="container ">
      <?php 
      //Si la descripcion esta vacia mostramos una estandar
        if($row['descripcion'] ==""){
          ?>
          <textarea name="descripcion" id="" cols="150" rows="10" class=" desc text-center"  maxlength="500" placeholder="<?php echo "descripcion"?>"></textarea>
          <?php
        }else{
            if(isset($_POST['editar_perfil'])){
          //Si la descripcion si tiene contenido la mostramos
          ?>
          <textarea name="descripcion" id="" cols="150" rows="10" class=" desc text-center"  maxlength="500" placeholder="<?php echo $row['descripcion']?>"></textarea>
          <?php
          }else{
            ?>
            <textarea name="descripcion" id="" cols="150" rows="10" class="desc text-center" placeholder="<?php echo $row['descripcion'];?>" readonly="readonly"></textarea>
            <?php
          }
        }
        
      }
   
      
      
      ?>
    </div>

</center>
</div>
 <div class="cont-1 container">

 <hr>
 
  <div class="row">
  
    
    <div class="col-3 offset-1">
     
  
    </div>
   
    
    </div>
  </div>
</div>
</form>
<br><br><br>
<?php
//Si presiona guardar traemos los datos
if(isset($_POST['guardar_perfil'])){
  //$descripcion = descripcion del usuario
  $descripcion = $_POST['descripcion'];
  //Llamamos la funcion setImagen para guardar la imagen en la base de datos
    setImagen($conexion,$_FILES['img']['name'],$_FILES['img']['tmp_name'],$id);
    //Si la descripcion no esta vacia la actualizamos en la base de datos
  if($descripcion == ""){
    $descripcion = $row['descripcion'];
  }
  $update = mysqli_query($conexion,"UPDATE usuarios SET `descripcion`='$descripcion' WHERE id='$id'");
  
  
  
 


?>
<script type="text/javascript"> 
    window.location="perfil.php";
    </script>
<?php
}
   ?>
<!-- Modal para cambiar la contraseña-->
<div class="modal fade " id="cambiar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content  ">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Cambiar contraseña</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <label for="contraA">Contraseña actual</label>
        <input type="password" name="contraA"  class="form-control" placeholder="*******">
        <label for="contra1">Nueva contraseña</label>
        <input type="password" name="contra1"  class="form-control" placeholder="*******">
        <label for="contra2">Confirmar contraseña</label>
        <input type="password" name="contra2"  class="form-control" placeholder="*******">

        <?php 
        //Si presiona cambiar traemos los datos del formulario
if(isset($_POST['cambiar'])){
  /*
  $contra = contraseña actial
  $contra1 = nueva contraseña
  $contra2 = confirmacion de la nueva contraseña
  */
  $contra = $_POST['contraA'];
  $contra1 = $_POST['contra1'];
  $contra2 = $_POST['contra2'];
  //Consultamos la informacion del usuario
  $query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE id='$id'");
  $row = mysqli_fetch_array($query);
  //Verificamos que la contraseña actual coincida con la contraseña en la base de datos
  if($contra == $row['contra']){
    //Confirmamos que las nuevas contraseñas coincidan
    if($contra1 == $contra2){
      //Actualizamos la nueva contraseña
    $query = mysqli_query($conexion,"UPDATE `usuarios` SET `contra`='$contra1' WHERE id='$id'");
      if($query){
        //Mostramos un mensaje de exito
        echo "<script>alert('Contraseña cambiada')</script>";
      }
    }else{
      //Si las contraseñas no coinciden mostramos un mensaje
            ?>
             <script>
             //ajax para mostrar el model cambiar
              $('#cambiar').modal('show');
            </script>
            <br>
          <div class="alert alert-danger text-center" role="alert">
          Las contraseñas no coinciden
          </div>
          <?php
    }
  }else{
    //Si la contraseña actual no coincide con la de la base de datos mostramos un mensaje
           ?>
           <script>
           //ajax para mostrar el model cambiar
              $('#cambiar').modal('show');
            </script>
            <br>
          <div class="alert alert-danger text-center" role="alert">
          La contraseña actual es incorrecta
          </div>
          <?php
  }
  
}
?>
            
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

        <button type="submit" class="btn btn-danger" name="cambiar">Guardar</button>
      </form>
      </div>
    </div>
  </div>
</div>
<?php
  


?>
  </body>
</html>

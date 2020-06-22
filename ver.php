<?php

//Verificamos que venga un dato por metodo get
if($_GET['pro']){
  $id_p = $_GET['pro'];
  //Definimos la ruta en la que estamos
  $link = "ver.php?pro=".$id_p;
  //incluimos el menu
  include('menu.php');
  //Consultamos el proyecto con el dato que vino en el metodo get
  $query = mysqli_query($conexion,"SELECT * FROM proyecto  WHERE id='$id_p'");
  //Si la consulta da error mostramos un mensaje
  if(!$query){
    echo "<script>alert('Haa')</script>";
  }
  $row = mysqli_fetch_array($query);
  //Traemos los datos del proyecto
  $linkv = $row['video_p'];
  $nombre = $row['nom_proyecto'];
  
  $pp = $row['p_principal'];
  $cate = $row['categoria'];
  $id_c = $row['id_user'];
  $n_con = $row['n_con'];
  $estado = $row['estado'];
  //Verificamos que el proyecto este activo y que el usuario sea un admin
  if($estado == 'espera' && $cargo != 'admin' && $id != $id_c || $estado == 'ban'){
    echo "<script>window.location='index.php?';</script>";
  }else if($estado == "activo" || $cargo == 'admin' || $id == $id_c){
  //Consultamos los datos del usuario
  $query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE id='$id_c'");
  $row = mysqli_fetch_array($query);
  $nom_c = $row['nombres'];
  $municipio = $row['municipio'];
  //Consultamos los datos de el proyecto
  $query = mysqli_query($conexion,"SELECT * FROM meta WHERE id_proyecto='$id_p'");
  $row = mysqli_fetch_array($query);
  $dias = $row['dias'];
  $d_actual = $row['dinero_actual'];
  $dinero = $row['dinero'];
  $i = 0;
  //Llamamos esta funcion para verificar si el dinero llega a su meta
  notiMetaDinero($conexion,$id_p,$id_c,$link);

  
 

  ?>
    <br><br><br>
    <div class="container-fluid pigg">
          <div class="row">

              <div class="col-12"><p class="h1 text-center"><?php echo $nombre ?></p></div>
          </div>
          <div class="row">
              <div class="col-12"><p class="h3 text-muted text-center"><?php echo $pp ?></p></div>
          </div>
          <div class="row mt-5">
              <div class="col-2"></div>
              <div class="col-8"><div class="embed-responsive embed-responsive-16by9">
              <?php 
                  //Cortamos el link de el video donde alla un =
                  list($palabra1, $palabra2) = explode('=', $linkv);    
                ?>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo $palabra2 ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div></div>
              <div class="col-2"></div>
          </div>
          <div class="row mt-5">
            <div class="col-4">
                  <div class="media position-relative">
                  <!-- Mostramos la imagen del usuario -->
                  <?php $imagen = getImagen($conexion, $id_c);
                    if($imagen == ""){
                      ?>
                        <img type ="file" src="img/ava.png " class="img-fluid rounded-circle ml-5 border border-danger ima_crea " alt="Responsive image">
                      <?php
                     }else{
                      ?>
                        <img type ="file" src="<?php echo $imagen?>" class="img-fluid rounded-circle ml-5 border border-danger ima_crea " alt="Responsive image">
                      <?php
                     }
              
                  
                  
                   ?>
                   <a href="perfil.php?user=<?php echo $id_c ?>">
                          <div class="media-body ml-2">
                            <h5 class="mt-0 text-muted">Un proyecto de</h5>
                            <p class="h5"><?php echo $nom_c ?></p>
                            
                          </div>
                        </div>
                  </a>
            </div>
            <div class="col-4">
                  <div class="media position-relative">
                          <img src="https://image.flaticon.com/icons/png/512/103/103461.png" class="img-fluid rounded-circle ml-5 border border-danger ima_cate mt-2" alt="Responsive image">
                          <div class="media-body ml-2">
                            <h5 class="mt-0 text-muted">Categoria</h5>
                            <p class="h5"><?php echo $cate ?></p>

                            
                          </div>
                        </div>
                  
            </div>
            <div class="col-4 float-left">

                  <div class="media position-relative ">
                          <img src="https://image.shutterstock.com/image-vector/red-map-icon-sign-vector-260nw-621041408.jpg" class="img-fluid rounded-circle ml-5 border border-danger ima_cate mt-2" alt="Responsive image">
                          <div class="media-body ml-2">
                            <h5 class="mt-0 text-muted">Creado en</h5>
                            <p class="h5"><?php echo $municipio ?></p>
                            
                          </div>
                        </div>
            </div>
          </div>
          <div class="row mt-3">
              <div class="col-12" style="background:#FCCFCF;">
                      <div class="">
                        <?php
                          //Calculamos el porcentaje entre el dinero actual y el dinero meta y lo mostramos con estilo
                          $porcentaje = porcentaje(getDinero($conexion,$id_p),getDineroActual($conexion,$id_p));
                        ?>
                              <div class="progress-bar bg-danger progres" role="progressbar" style="width:<?php echo $porcentaje.'%'  ?> "   aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
              </div>
          </div>
      </div>
      <div class="container-fluid">
          <div class="row mt-2 text-center">
            
              <div class="col-1">
                  <p class="h4 mb-0"><?php echo $dias ?></p>
                  <p class="h5 mt-0 text-muted">Dias</p>
              </div>
                <div class="col-2" onclick="$('#donadores').modal('show')">
                          <p class="h4 mb-0"><?php echo $n_con?></p>
                          <p class="h5 mt-0 text-muted">Aprotadores</p>
                      </div>
              <div class="col-2">
                      <p class="h4 mb-0"><?php echo "$".$d_actual ?></p>
                      <p class="h5 mt-0 text-muted"><?php echo "$".$dinero ?></p>
                  </div>
                
              
              <div class="col-7 mt-2 pl-5">
                      
                      <a href="https://twitter.com/?lang=es"  class="btn btn-outline-secondary">TWIT</a>
                      <a href="www.gmail.com"  class="btn btn-outline-success mr-5">GMAI</a>
                      <?php 
                      //Verificamos si hay alguna sesion
                      if(isset($id)){
                        //Consultamos en los seguidores el usuario
                        $query = mysqli_query($conexion,"SELECT * FROM seguir WHERE id_user='$id' AND id_p='$id_p'");
                        $num = mysqli_num_rows($query);
                        if($num > 0){
                          $query = mysqli_query($conexion,"SELECT * FROM seguir WHERE id_p='$id_p'");
                          $num = mysqli_num_rows($query);
                          //Si presiona click se le abrira un modal con la lista de seguidores
                          ?>
                          <button onclick="$('#seguidores').modal('show')" class="btn btn-outline-danger">♥ <?php echo $num ?></button> 
                          <?php
                        }else{
                          $query = mysqli_query($conexion,"SELECT * FROM seguir WHERE id_p='$id_p'");
                          $num = mysqli_num_rows($query);
                          ?>
                          <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                          <button type="submit" class="btn btn-outline-danger" name="like">♥ <?php echo $num ?></button> 
                          </form>
                        <?php
                        }
                      }else{
                        $query = mysqli_query($conexion,"SELECT * FROM seguir WHERE id_p='$id_p'");
                          $num = mysqli_num_rows($query);
                        ?>
                        <button  class="btn btn-outline-danger" onclick="$('#seguidores').modal('show')" >♥ <?php echo $num ?></button> 
                        <?php
                      }
                      
                      ?>
                      
                      
                      <?php
                      
                      $p=0;
                      //Verificamos si hay un id
                        if(isset($id)){
                          //Si presiona like
                          if(isset($_POST['like'])){
                            //Se inserta en la tabla de seguidores
                            $query = mysqli_query($conexion,"INSERT INTO `seguir`(`id`, `id_user`, `id_p`) VALUES (NULL,'$id','$id_p')");
                            if($query){
                              //Se notifica al creador del proyecto que lo an seguido y se muestran mensajes
                              generarNotificacion($conexion,$id_c,"Alguien a comensado a seguirte","Nuevo Seguidor",'novisto',$link);
                              echo "<script>alert('Siguiendo')</script>";
                              echo "<script>window.location='$link'</script>";
                            }
                          }
                          ?>
                          <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#donar" name="donar">APORTA AL PROYECTO</button>
                          <?php
                          //Consultamos si el usuario actual es el dueño de el proyecto
                          $query = mysqli_query($conexion,"SELECT * FROM proyecto WHERE id='$id_p' AND id_user='$id'");
                          $num = mysqli_num_rows($query);
                          if($num == 1){
                            //Le habilitamos un boton para que pueda editar el proyecto
                            $p = 1;
                            $red = "editarVer.php?pro=".$id_p;
                            ?>
                          <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                          </form>
                            <?php
                          }
                        }
                      ?>
              </div>
          </div>
        </div>
  <hr>
  <div class="container">
    <div class="row">

    <div class="col-lg-8">

    <?php 
    //Verificamos que el usuario presiono editar
    if(isset($_POST['editar']))
    {
      //Redirecionamos a la pagina para editar
      echo "<script>window.location='editarVer.php?pro=$id_p'</script>";
    }
      //Consultamos los detalles de el proyecto
        $query = mysqli_query($conexion,"SELECT * FROM detaller_pro WHERE id_proyecto='$id_p'");
        $row = mysqli_fetch_array($query);
        //Traemos los datos
        $id_detalle = $row['id_detalle'];
          $titulo = $row['titulo_p'];
          $parrafo = $row['parrafo'];
          $imagenUno = $row['imagen'];
          
          ?>
  
        <p class="h3 mb-5 mt-4"><?php echo $titulo ?> </p>
          <p class="h5"><?php echo $parrafo ?>
          <br>
              </p>
              <?php
              //Verificamos si el proyecto ya ha subido imagenes
                if($imagenUno == "" && $p ==1 || $imagenUno == "img/" && $p == 1){
                  //Si no hay imagen habilitamos boton para que pueda subir una imagen
                  ?>
                  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data"class="btn btn-danger">
                     
                  <input type="file"  id="file" name="foto"/>
                  <input type="submit" name="imagenUno" value="Subir imagen"  class="btn btn-dark">
                  
                  </form>
                  <?php
                  
                }else{
                  //Mostramos la imagen
                  ?>
                  <img src="<?php echo $imagenUno ?>" class="img-fluid mt-2" alt="Responsive image">
                  <?php
                }
                //Si va a subir la primera imagen traemos los datos de la imagen
                if(isset($_POST['imagenUno'])){
                  $nombreImagenUno = $_FILES['foto']['name'];
                  $tmpUno = $_FILES['foto']['tmp_name'];
                  //Definimos la ruta del archivo
                  $archivoUno = "img/".$nombreImagenUno;
                  //Movemos la imagen a una carpeta
                  move_uploaded_file($tmpUno,$archivoUno);
                  //Subimos la imagen a la base de datos
                  $query= mysqli_query($conexion,"UPDATE `detaller_pro` SET `imagen`='$archivoUno' WHERE id_detalle='$id_detalle'");
                  if($query){
                    echo "<script>window.location='$link'</script>";
                  }
                  
                }
              ?>
            
  
       
        <?php 
        $id_detalle = $id_detalle +1;
        //Consultamos los detalles del proyecto
        $query = mysqli_query($conexion,"SELECT * FROM detaller_pro WHERE id_proyecto='$id_p' AND id_detalle='$id_detalle'");
        //Traemos los datos
        $row = mysqli_fetch_array($query);
          $titulo = $row['titulo_p'];
          $parrafo = $row['parrafo'];
          $imagen = $row['imagen'];
          
          ?>
            
        <p class="h3 mb-5 mt-4"><?php echo $titulo ?> </p>
          <p class="h5"><?php echo $parrafo ?>
          <br>
              </p>
              <?php
              //Verificamos si el proyecto tiene alguna imagen
                if($imagen == "" && $p ==1 || $imagen == "img/" && $p == 1){
                  //Habilitmaos para que el dueño del proyecto pueda subir una imagen
                  ?>
                  <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" class="btn btn-danger">

                  <input type="file"class="mb-3" id="file" name="fotoDos" class="btn btn-danger"/>
                  
                  
                  <input type="submit" name="imagenDos" value="Subir imagen" class="btn btn-dark">
                  </form>
                  <?php
                  
                }else{
                  //Mostramos la imagen que esta en la base de datos
                  ?>
                  <img src="<?php echo $imagen ?>" class="img-fluid mt-2" alt="Responsive image">
                  <?php
                }
                //Si va a subir la primera imagen traemos los datos de la imagen
                if(isset($_POST['imagenDos'])){
                  $nombreImagenUno = $_FILES['fotoDos']['name'];
                  $tmpUno = $_FILES['fotoDos']['tmp_name'];
                  //Definimos la ruta del archivo
                  $archivoUno = "img/".$nombreImagenUno;
                  //Movemos la imagen a una carpeta
                  move_uploaded_file($tmpUno,$archivoUno);
                  //Subimos la imagen a la base de datos
                  $query= mysqli_query($conexion,"UPDATE `detaller_pro` SET `imagen`='$archivoUno' WHERE id_detalle='$id_detalle'");
                  if($query){
                    echo "<script>window.location='$link'</script>";
                  }
                  
                }
              ?>
            
    
  
          <?php
         $id_detalle = $id_detalle +1;
         //Consultamos los detalles del proyecto
         $query = mysqli_query($conexion,"SELECT * FROM detaller_pro WHERE id_proyecto='$id_p' AND id_detalle='$id_detalle'");
         $row = mysqli_fetch_array($query);
           $titulo = $row['titulo_p'];
           $parrafo = $row['parrafo'];
           $imagen = $row['imagen'];
              
           ?>
          
         <p class="h3 mb-5 mt-4"><?php echo $titulo ?> </p>
           <p class="h5"><?php echo $parrafo ?>
           
           <br>
               </p>
               <?php
               //Verificamos si el proyecto tiene alguna imagen
                 if($imagen == "" && $p ==1 || $imagen == "img/" && $p == 1){
                   //Habilitmaos para que el dueño del proyecto pueda subir una imagen
                   ?>
                  
                   <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" class="btn btn-danger">
                  
                   <input type="file"class="mb-3" id="file" name="fotoTres"/>
              
                   
                   <input type="submit" name="imagenTres" value="Subir imagen" class="btn btn-dark">
                   </form>
                   <?php
                   
                 }else{
                   //Mostramos la imagen que esta en la base de datos
                   ?>
                   <img src="<?php echo $imagen ?>" class="img-fluid mt-2" alt="Responsive image">
                   <?php
                 }
                 if(isset($_POST['imagenTres'])){
                   //Si va a subir la primera imagen traemos los datos de la imagen
                   $nombreImagenUno = $_FILES['fotoTres']['name'];
                   $tmpUno = $_FILES['fotoTres']['tmp_name'];
                   //Definimos la ruta del archivo
                   $archivoUno = "img/".$nombreImagenUno;
                   //Movemos la imagen a una carpeta
                   move_uploaded_file($tmpUno,$archivoUno);
                   //Subimos la imagen a la base de datos
                   $query= mysqli_query($conexion,"UPDATE `detaller_pro` SET `imagen`='$archivoUno' WHERE id_detalle='$id_detalle'");
                   if($query){
                     echo "<script>window.location='$link'</script>";
                   }
                   
                 }
               ?>
             
        
    </div>
     <div class="col-lg-4">
       
       <?php 
       //Consultamos las recompesas del proyecto
        $query = mysqli_query($conexion,"SELECT * FROM recompensa WHERE id_proyecto='$id_p'");
        $row = mysqli_fetch_array($query);
        $imagen = $row['imagen'];
        ?>
        <!-- Si presiona en recompensa se abrira un modal mostrando las recompensas -->
        <div class="col-12" <?php if(isset($id)){?>onclick="$('#recompensa').modal('show')"<?php } ?>class="card hover_c">
         <div  >
         <?php
         //Verificamos si el proyecto tiene alguna imagen de recompensa
         if($imagen == "" && $p ==1 || $imagen == "img/" && $p == 1){
           //Habilitmaos para que el dueño del proyecto pueda subir una imagen
                  ?>
                  <div class="col-lg-3"><form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data" class="btn btn-danger">
                  <input type="file"class="mb-3" id="file" name="fotoR"/> 
                  <input type="submit" name="imagenR" value="Subir imagen" class="btn btn-dark">
                  </form></div>
                  
                  <?php
                  
                }else{
                  //Mostramos la imagen que esta en la base de datos
                  ?>
                  <img src="<?php echo $imagen ?>" class="img-fluid mt-2" alt="Responsive image">
                  <?php
                }
                //Si va a subir la primera imagen traemos los datos de la imagen
                if(isset($_POST['imagenR'])){
                  $nombreImagenUno = $_FILES['fotoR']['name'];
                  $tmpUno = $_FILES['fotoR']['tmp_name'];
                  //Definimos la ruta del archivo
                  $archivoUno = "img/".$nombreImagenUno;
                  //Movemos la imagen a una carpeta
                  move_uploaded_file($tmpUno,$archivoUno);
                  //Subimos la imagen a la base de datos
                  $query= mysqli_query($conexion,"UPDATE `recompensa` SET `imagen`='$archivoUno' WHERE id_proyecto='$id_p'");
                  if($query){
                    echo "<script>window.location='$link'</script>";
                  }
                  
                }
              ?>
            
       
          <div class="card-body col-lg-12">
             <p class="card-text"><?php echo $titulo_r =$row['titulo_r'] ?><br><hr> <?php echo $descripcion_r = $row['descripcion'] ?><br><hr> <?php echo $valor_r= $row['valor']?></p>
          </div>
          </div>
        </div>
        

       </div>
     </div>
    </div> 
</div>
  <?php 
  //Consultamos si existe algun cargo
    if(isset($cargo)){

    }else{
      $cargo = "";
    }
  }else{
    echo "<script>window.location='index.php'</script>";
  }
  //Verificamos si el usuario es un admin, y el proyecto esta en espera
  if($cargo == 'admin' && $estado=='espera'){
    //Mostramos un formulario para el admin aprobar o banear el proyecto
    ?>
    <center>
      <br><br>
    <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
    <input class="btn btn-success"type="submit" name="apro" value="Aprovar">
    <input class="btn btn-warning"type="submit" name="rec" value="Falta">
    <input class="btn btn-danger"type="submit" name="ban" value="Rechazar">
    <br><br> 
    </form>
    </center>
    
    <?php
    //Verificamos si el admin aprobo el proyecto
    if(isset($_POST['apro'])){
      //Actualizamos el estado del proyecto de espera a activo
      $update = mysqli_query($conexion,"UPDATE proyecto SET estado='activo' WHERE id='$id_p'");
      if($update){
        //Notificamos al usuario creador del proyecto que su proyecto a sido aprovado
        $query = mysqli_query($conexion,"INSERT INTO `notificaciones`(`id_n`, `id_user`, `parrafo_n`, `sobre`, `estado`) VALUES (NULL,$id_c,'Tu Proyecto ha sido aprovado desde este momento comensaras a ','Proyecto aprovado','novisto')");
        echo "<script>window.location='$link'</script>";

      }
    }
    //Verificamos si el admin presiona en aun le falta
    if(isset($_POST['rec'])){
      //Notificamos al creador del proyecto que aun le falta informacion a su proyecto
      $query = mysqli_query($conexion,"INSERT INTO `notificaciones`(`id_n`, `id_user`, `parrafo_n`, `sobre`, `estado`) VALUES (NULL,$id_c,'Consideramos que tu proyecto no tiene informacion suficiente','Proyecto Incompleto','novisto')");
      echo "<script>window.location='$link'</script>";

    }
    //Verificamos si el usuario es admin y el proyecto esta activo
  }else if($cargo == 'admin' && $estado == 'activo'){
    //Mostramos un formulario para ponerlo en destacados o banearlo
    ?>
      <center>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
        <br><br><br>
        <div class="container">
        <div class="row">
          

            <div class="col-lg-4"> <input class="btn btn-danger"type="submit" name="ban" value="banear"></div>
            <div class="col-lg-4"> <select class="form-control"name="num">
          <option value="1">Uno</option>
          <option value="2">Dos</option>
          <option value="3">Tres</option>
        </select></div>
            <div class="col-lg-4"><input class="btn btn-dark"type="submit" name="destacado" value="Añadir a destacados"></div>

           </div>
         

        </div>


        </form>
      </center>
    <?php

  }
  //Si presiona destacado el admin elije el numero del slider donde va a estar el proyecto
  if(isset($_POST['destacado'])){
    //Traemos los datos
    $num = $_POST['num'];
    //Consultamos si el proyecto ya esta en destacados
    $query = mysqli_query($conexion,"SELECT * FROM destacados WHERE num='$num'");
    $numm = mysqli_fetch_array($query);
    if($numm >0){
      //Mostramos un mensaje
      echo "<script>alert('El proyecto ya esta en destacados')</script>";
      //Actualizamos el numero en el que va a estar en el slider
      $query = mysqli_query($conexion,"UPDATE `destacados` SET `id_p`='$id_p' WHERE `num`='$num'");
    }else{
      //Si no esta en destacados insertamos el id del proyecto
      $query = mysqli_query($conexion,"INSERT INTO `destacados` (`id_d`, `id_p`, `num`) VALUES (NULL, '$id_p', '$num')");
    }
    if($query){
      //Mostramos un mensaje
      echo "<script>alert('Enviado')</script>";
    }
  }
  //Si el admin presiona banear
  if(isset($_POST['ban'])){
    //Actualizamos el estado del proyecto de espera a ban
    $update = mysqli_query($conexion,"UPDATE proyecto SET estado='ban' WHERE id='$id_p'");
    if($update){
      //Notificamos al creador del proyecto que su proyecto ha sido baneado
      $query = mysqli_query($conexion,"INSERT INTO `notificaciones`(`id_n`, `id_user`, `parrafo_n`, `sobre`, `estado`) VALUES (NULL,$id_c,'Tu Proyecto ha sido rechazado, no cuenta con suficiente ','Proyecto Rechazado','novisto')");
      echo "<script>window.location='index.php'</script>";
    }
  }
  ?>
  <hr>
  <br><br>
  <div class="container-fluid">
    <h1 class="text-center">Comentarios</h1>
  </div>
  <br><br>
  <div class="container">
    
      <?php
      //Consultamos los comentarios que tiene este proyecto
      $query = mysqli_query($conexion,"SELECT * FROM comentarios WHERE id_p='$id_p'");
      $num = mysqli_num_rows($query);
      $i = 0;
      //Creamos un ciclo para mostrar todos los comentarios
      while($num > $i ){
        //Traemos los datos y los mostramos
        $row = mysqli_fetch_array($query);
        $id_u = $row['id_u'];
        ?>
        <div class="row"> 
        <?php
        echo $nombre = getNombre($conexion,$id_u);
        echo $apellido = " ".getApellido($conexion,$id_u)."<br>";
        echo $mensaje = $row['mensaje']."<br>";
        echo $fecha = $row ['fecha']."<hr></div><br>";
        $i = $i +1;
      }
      ?>
    
  </div>
  <hr>
</div> 
    
  <br><br>
  <!-- Comentarios -->
  <div class="container">
      <div class="row">
        <div class="col-7"> 
            <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            <textarea name="comentario" id="" cols="102" rows="5" placeholder="Deja un comentario" style="padding: 9px;"></textarea>
        </div>

          <div class="col-lg-5">
            <img src="" alt="">
          </div>
        </div>
      <div class="row">
        <div class="col-lg-7 mt-2 ">
              <?php 
              //Si existe una sesion habilitamos un boton para enviar el comentario
              if(isset($id)){
                ?>
              
                <input class="btn btn-danger float-right" type="submit" name="comentar" value="Enviar">
                <?php
              }
                ?>
                 </form>
        </div>
   <div class="col-lg-5">
     
        <!--BOTON PARA REPORTES-->
      <?php
      //Si existe una sesion habilitamos un boton para abrir un modal para reportar
      if(isset($id)){
        ?>

        <input class="btn btn-primary float-right" data-toggle="modal" data-target="#reporte" style="margin-left:40%;" type="submit" name="reporte" value="Reportar"></div>
        
  <?php
      }
      ?> 
  
         
     
      </div>
      
</div>
      
 
  
   
      <!-- Modal reportes -->
      <center>
<div class="modal fade" id="reporte" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"> REPORTE</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php $_SERVER['PHP_SELF'] ?>" method="POST">
      <div class="modal-body">
        <div class="form-group">
          <div class="col-10"><label for="exampleFormControlSelect1">Motivo de reporte</label>
    <select  name=" select" class="form-control" id="exampleFormControlSelect1">
      <option name="uno">Contenido inapropiado</option>
      <option name="dos">Proyecto falso</option>
      <option name="tres">Robo de proyecto</option>
      <option name="cuatro">meta exagerada</option>
    </select></div>
    
  </div>
  
  <label for="exampleFormControlSelect1">Descripción </label>
    <div class="form-group "><textarea name="descripcion" id="" cols="60" rows="5"></textarea></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Salir</button>
        <input name="enviar" type="submit" class="btn btn-danger" value="Enviar reporte">
        
    </form>
      </div>
    </div>
  </div>
</div>
<?php 
//Traemos los datos del formulario reportes
if(isset($_POST['enviar'])){
    $motivo = $_POST['select'];
    $descripcion = $_POST['descripcion'];
    //Guardamos el reporte
    $query = mysqli_query($conexion, "INSERT INTO `reportes`(`id_re`, `motivo`, `descripcion`, `id_p`) VALUES (NULL,'$motivo','$descripcion',$id_p )");
    if($query){
      //Consultamos el ultimo reporte
        $query = mysqli_query($conexion, "SELECT * FROM reportes WHERE id_p='$id_p' order by id_p asc limit 1 ");
        $row = mysqli_fetch_array($query);
        $sobre =  getSobreReporte($conexion,$row['id_re']);
        //Notificamos al creador del proyecto y al administrador sobre el reporte
        generarNotificacion($conexion,$id_c,$sobre,'Tu proyecto ha sido reportado','novisto','');
        generarNotificacion($conexion,1,$sobre,$descripcion ,'novisto',$link);
    }
}
?>
</center>
<!-- donar -->

<div class="modal fade" id="donar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Contribuir</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <center>
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
      <div class="modal-body">
        
        <?php 
        $saldo = getSaldo($conexion,$id);
        ?>
        <p class="h3">Tu saldo : <?php echo $saldo; ?></p>

        <br>
        <input type="number" name="dinero" placeholder="<?php echo $saldo ?>" class="form-group form-control">
        <br><br>
        Countribuido : 
         <p class="h4 mb-0"><?php echo "$".$d_actual ?></p>
         <p class="h5 mt-0 text-muted"><?php echo "$".$dinero ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <input name="donar" type="submit" class="btn btn-danger" value="Contribuir">
      </form>
      </center>
      
      </div>
    </div>
  </div>
</div>
<!-- recompensa -->

<div class="modal fade" id="recompensa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Contribuir</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
      recompensa : <?php echo $titulo_r?><br>
      <?php echo $descripcion_r;?>
      <div class="modal-body">
        <?php
        $saldo = getSaldo($conexion,$id);
        echo "Tu saldo : ".$saldo;
        ?>
        <br>
        <input type="number" name="dineroR" placeholder="<?php echo $valor_r ?>" class="form-group">
        <br><br>
        Countribuido : 
         <p class="h4 mb-0"><?php echo "$".$d_actual ?></p>
         <p class="h5 mt-0 text-muted"><?php echo "$".$dinero ?></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <input name="comprarRecompensa" type="submit" class="btn btn-danger" value="Contribuir">
      </form>
      </div>
    </div>
  </div>
</div>
<!-- fin -->
<!-- modal Donadores-->
<div class="modal fade" id="donadores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Donadores</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php 
        //Consultamos las donaciones
        $query = mysqli_query($conexion,"SELECT * FROM donaciones WHERE id_p='$id_p'");
        $num = mysqli_num_rows($query);
        //Verificamos que si hay notificaciones
        if($num > 0){
          $i = 0;
          //Creamos un ciclo para mostrar a los contribuidores
          while($num > $i ){
            //Traemos los datos
            $row = mysqli_fetch_array($query);
            $id_u = $row['id_user'];
            //Mostramos los datos y que redireccionen al perfil del donador
            ?>
           <a href="perfil.php?user=<?php echo $id_u ?>"><?php  echo getNombre($conexion,$id_u)." ".getApellido($conexion,$id_u)." "; if(isset($id)){if($id == $id_c){ echo "Contribuido : ".$row['cantidad']; } }?> </a><?php
            echo "<br>";
            $i = $i+1;
          }
        }else{
          //Mostramos un mensaje
          echo "No hay aportadores";
        }
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

      </div>
    </div>
  </div>
</div>
<!-- fin -->
<!-- modal Seguidores-->
<div class="modal fade" id="seguidores" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Seguidores</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
        //Consultamos los seguidores 
        $query = mysqli_query($conexion,"SELECT * FROM seguir WHERE id_p='$id_p'");
        $num = mysqli_num_rows($query);
        //Verificamos que si hay contribuidores
        if($num > 0){
          $i = 0;
          //Creamos un ciclo para mostrar los contribuidores
          while($num > $i ){
            //Traemos los datos
            $row = mysqli_fetch_array($query);
            $id_u = $row['id_user'];
            //Mostramos los datos y que redireccionen al perfil del seguidor
            ?>
           <a href="perfil.php?user=<?php echo $id_u ?>"><?php  echo getNombre($conexion,$id_u)." ".getApellido($conexion,$id_u). "</a>";
            echo "<br>";
            $i = $i+1;
          }
        }else{
          //Mostramos un mensaje
          echo "No hay aportadores";
        }
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

      </div>
    </div>
  </div>
</div>
<!-- fin -->
      <br><br><br><br>
  <?php
  //Si presiona donar llamamos a la funcion donar
  if(isset($_POST['donar'])){
    donar($conexion,$saldo,$_POST['dinero'],$id_p,$id,$link,$id_c);
  }
  //Si presiona comentar llamamos a una funcion para comentar un comentario
  if(isset($_POST['comentar'])){
    
    insertarComentario($conexion,$_POST['comentario'],$id,$id_p,$id_c,$link);
    
  }
}else{
  echo "<script>window.location='index.php'</script>";

}

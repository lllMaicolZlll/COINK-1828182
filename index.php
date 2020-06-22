<?php 
//Definimos la ruta en la que estamos
$link = "index.php";
?>

<!doctype html>
<html lang="en">
<?php 
//Incluimos el menu
include('menu.php');

?>

<!-- slider de destacados listo :D -->
<div class="container-fluid pigg"><div class="container ">
  <div class="row">
    <div class="col-12 hola">
      <div id="carouselExampleIndicators" class="carousel slide con2" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators"class="rounded-circle active" style="height: 15px; width:15px;" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators"class="rounded-circle " style="height: 15px; width:15px;" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators"class="rounded-circle" style="height: 15px; width:15px;" data-slide-to="2"></li>
        </ol>
        <!-- ajax para mostrar el moda del proyecto 1 -->
        <a onclick="$('#proyecto1').modal('show')">
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active">
          <!-- llamamos a la funcion mostrarImagenDestacado para mostrar la imagen principal del proyecto destacado -->
            <img class="d-block w-100 sli" src="<?php echo mostrarImagenDestacado($conexion,1) ?>"  alt="First slide">
            <div class="carousel-caption d-none d-md-block fond">
            <!-- llamamos a la funcion mostrarIdDestacado para mostrar el id del proyecto destacado -->
             <a href="ver.php?pro=<?php echo mostrarIdDestacado($conexion,1)?>" class="sin"> <h5 class="titulo"><?php echo mostrarTituloDestacado($conexion,1) ?></h5>
              <!-- llamamos a la funcion mostrarParrafoDestacado para mostrar el parrafp principal del proyecto destacado -->
              <p class="titulo h6 "><?php echo mostrarParrafoDestacado($conexion,1) ?></p>
              </a>  
              </a>
            </div>
          </div>
          <!-- ajax para mostrar el moda del proyecto 1 -->
          <a onclick="$('#proyecto2').modal('show')">
          <div class="carousel-item">
           <!-- llamamos a la funcion mostrarImagenDestacado para mostrar la imagen principal del proyecto destacado -->
            <img class="d-block w-100 sli" src="<?php echo mostrarImagenDestacado($conexion,2) ?>"  alt="Second slide">
            <div class="carousel-caption d-none d-md-block fond">
             <!-- llamamos a la funcion mostrarIdDestacado para mostrar el id del proyecto destacado -->
             <a href="ver.php?pro=<?php echo mostrarIdDestacado($conexion,2)?>"class="sin"> <h5 class="titulo "><?php echo mostrarTituloDestacado($conexion,2) ?></h5>
              <!-- llamamos a la funcion mostrarParrafoDestacado para mostrar el parrafp principal del proyecto destacado -->
              <p class="titulo h6 "><?php echo mostrarParrafoDestacado($conexion,2) ?></p>
              </a>
               </a>
            </div>
          </div>
          <!-- ajax para mostrar el moda del proyecto 1 -->
          <a onclick="$('#proyecto3').modal('show')">
          <div class="carousel-item">
            <!-- llamamos a la funcion mostrarImagenDestacado para mostrar la imagen principal del proyecto destacado -->
            <img class="d-block w-100 sli" src="<?php echo mostrarImagenDestacado($conexion,3) ?>"  alt="Second slide">
            <div class="carousel-caption d-none d-md-block fond">
            <!-- llamamos a la funcion mostrarIdDestacado para mostrar el id del proyecto destacado -->
             <a href="ver.php?pro=<?php echo mostrarIdDestacado($conexion,3)?>"class="sin"> <h5 class="titulo "><?php echo mostrarTituloDestacado($conexion,3) ?></h5>
              <!-- llamamos a la funcion mostrarParrafoDestacado para mostrar el parrafp principal del proyecto destacado -->
              <p class="titulo h6 "><?php echo mostrarParrafoDestacado($conexion,3) ?></p>
              </a>
               </a>
            </div>
          </div>
        </div>
       

      </div>
    </div>
  </div>
  <br>
</div></div>


<br><br>
<!--  fin slider -->
<!-- inicio de proyectos-->
    <?php 
    //Consultamos los proyectos activos
    $query = mysqli_query($conexion,"SELECT * FROM proyecto WHERE estado='activo'");
    if(!$query){
      echo "Error intente mas tarde";
    }
    $num = mysqli_num_rows($query);
    //$num = numero de proyectos activos
    if($num > 0){
      //$i = contador
      $i = 0;
      ?>
      <div class="container"><!-- contenedor para mantenerlas centradas-->
          <div class="row">

          <?php
          //Creamos un ciclo para mostrar los proyectos
          while($i < $num){
            /*
          $row = array con los datos consultados de un proyecto
          $id_p = identificador del proyecto
          $cate = categoria del proyecto
          $nombre = titulo del proyecto
          $pp = parrafo principal del proyecto
          $video = video principal del proyecto
          $imagen = imagen principal del proyecto
          $id_c = identificacion del usuario creador del proyecto
          */
            $row = mysqli_fetch_array($query);
            $id_p = $row['id'];
            $id_c = $row['id_user'];
            //Funcion para saber cuantos dias le quedan
            contarDias($conexion,$id_p);
            //Funcion para notificar si llega a su meta de tiempo o dinero
            notiMetaDias($conexion,$id_p,$id_c,$link);
            $cate = $row['categoria'];
            $nombre = $row['nom_proyecto'];
            $pp = $row['p_principal'];
            $video = $row['video_p'];
            $imagen = $row['imagen_p'];
            $red = "ver.php?pro=".$id_p;
        
           ?>
           <div class="col-lg-4">
          <div class="card m-5 hover_c" style="width: 18rem; cursor:pointer;" onclick="window.location='<?php echo $red ?>'" >

              <img src="<?php echo $imagen ?>" class="card-img-top" alt="...">
              <div class="card-body p-0">
                <h5 class="card-title mt-2 px-3"><?php echo $nombre?></h5>
                <p class="card-text px-3"><?php echo $pp ?></p>
                
    
                <p class="h6 mt-5 mb-2 ml-3"><?php echo $cate ?></p>
                <div class=""style="background:#FCCFCF;">
                  <?php 
                      //Llamamos esta funcion para calcular el porcentaje de el dinero recaudado actualmente para mostrarlo en una barra
                      $porcentaje = porcentaje(getDinero($conexion,$id_p),getDineroActual($conexion,$id_p));
                      
                  ?>
                  <div class="progress-bar bg-danger pro" role="progressbar" style="width: <?php echo $porcentaje.'%' ?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <div class="row">
                  <div class="col-6">
                    <p class="h4 mb-0 mt-3 ml-3"><?php echo getDias($conexion,$id_p); ?></p>
                <p class="h6 pt-0 mt-0 mb-3 ml-3 text-muted">Dias</p>
                  </div>
                  <div class="col-6 pl-0">
                    <p class="h4 mb-0 mt-3"><?php echo "$".getDineroActual($conexion,$id_p)?></p>
                    <p class="h6 pt-0 mt-0 mb-3  text-muted"><?php echo "$".getDinero($conexion,$id_p) ?></p>
                  </div>
                </div>
              </div> 
          </div>
          </div>
          </a>
           <?php
           $id_a = $id_p;
           //sumamos uno al contador
           $i = $i + 1;
          }
          ?>
          </div> 
          </div>
          <?php
          $proyectos = 1;
    }else{
      $proyectos = 0;
    }
    ?>

   

<!-- VIDEO 1 -->
<div class="modal fade" id="proyecto1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">

    <!--Content-->
    <div class="modal-content">

      <!--Body-->
      <div class="modal-body mb-0 p-0">

        <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
        <!-- Funcion para mostrar el video principal del proyeco destacado -->
          <?php echo mostrarVideoDestacado($conexion,1) ?>
        </div>

      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center flex-column flex-md-row">
                                                                              <!-- Funcion para mostrar el id del proyeco destacado -->
      <a class="navbar-brand text-danger font-weight-bold" href="ver.php?pro=<?php echo mostrarIdDestacado($conexion,1)?>"><i class="fas fa-piggy-bank text-danger"></i>Ver más!!</a>

        <span class="mr-4">¡Compartenos!</span>

        <div>
        <button type="button" class="btn btn-outline-primary"><i class="fab fa-facebook"></i></button>
        <button type="button" class="btn btn-outline-secondary"><i class="fab fa-twitter-square"></i></button>

         
         
        </div>
        <button type="button" class="btn btn-outline-danger my-2 my-sm-0 mt-3" data-dismiss="modal">Cerrar</button>


      </div>

    </div>
  </div>
</div>
<!-- VIDEO 2 -->
<div class="modal fade" id="proyecto2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">

    <!--Content-->
    <div class="modal-content">

      <!--Body-->
      <div class="modal-body mb-0 p-0">

        <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
        <!-- Funcion para mostrar el video principal del proyeco destacado -->
          <?php echo mostrarVideoDestacado($conexion,2) ?>
            allowfullscreen></iframe>
        </div>

      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center flex-column flex-md-row">
                                                                              <!-- Funcion para mostrar el id del proyeco destacado -->
      <a class="navbar-brand text-danger font-weight-bold" href="ver.php?pro=<?php echo mostrarIdDestacado($conexion,2)?>"><i class="fas fa-piggy-bank text-danger"></i>Ver más!!</a>

        <span class="mr-4">¡Compartenos!</span>

        <div>
        <button type="button" class="btn btn-outline-primary"><i class="fab fa-facebook"></i></button>
        <button type="button" class="btn btn-outline-secondary"><i class="fab fa-twitter-square"></i></button>

         
         
        </div>
        <button type="button" class="btn btn-outline-danger my-2 my-sm-0 mt-3" data-dismiss="modal">Cerrar</button>


      </div>

    </div>
  </div>
</div>
<!-- VIDEO 3 -->
<div class="modal fade" id="proyecto3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">

    <!--Content-->
    <div class="modal-content">

      <!--Body-->
      <div class="modal-body mb-0 p-0">

        <div class="embed-responsive embed-responsive-16by9 z-depth-1-half">
        <!-- Funcion para mostrar el video principal del proyeco destacado -->
         <?php echo mostrarVideoDestacado($conexion,3) ?>
            allowfullscreen></iframe>
        </div>

      </div>

      <!--Footer-->
      <div class="modal-footer justify-content-center flex-column flex-md-row">
                                                                            <!-- Funcion para mostrar el id del proyeco destacado -->
      <a class="navbar-brand text-danger font-weight-bold" href="ver.php?pro=<?php echo mostrarIdDestacado($conexion,3)?>"><i class="fas fa-piggy-bank text-danger"></i>Ver más!!</a>

        <span class="mr-4">¡Compartenos!</span>

        <div>
        <button type="button" class="btn btn-outline-primary"><i class="fab fa-facebook"></i></button>
        <button type="button" class="btn btn-outline-secondary"><i class="fab fa-twitter-square"></i></button>

         
         
        </div>
        <button type="button" class="btn btn-outline-danger my-2 my-sm-0 mt-3" data-dismiss="modal">Cerrar</button>


      </div>

    </div>
  </div>
</div>
<?php
//Funcion cuantos proyectos activos hay, si hay mas de cinco se abilita la obsion para mostrar mas proyectos
if(NumProyectosActivos($conexion) > 5){
  cartasMas($proyectos);
}

?>

<!doctype html>
<html lang="en">
  <?php 
  //Traemos por metodo get, el nombre de la categoria y el color de esta
  $categoria = $_GET['cate'];
  $color = $_GET['color'];
  //Definimos la ruta en la que estamos
  $link = "categoria.php?cate=$categoria&color=$color";
  //Incluimos el menu
  include('menu.php');
  ?>

  <div class="container"> <!-- este container lo utilizamos para contener las categorias  -->
      <br><br> <!-- br = lo utilizamos para agregar un espacio entre contenedores-->
      <center> <!-- center= lo tilizamos para amntener centrado todo lo que este dentro de la etiqueta -->
      <h1><?php echo $categoria?></h1><!-- H1 lo utilizamos para gargar un tamaño a la letra -->
      <?php 
      //Llamamos a la funcion bolitas para mostras una decoracion y le pasamos como parametro un color
      bolitas($color)?>
      </center>
   
      <hr> <!-- lo utilizamos para agragar un linea divisora entre los elementos de la pagina -->
      <br> <br>
  </div>
      <!-- inicio de proyectos-->
      <?php 
      //Consultamos los proyectos que esten activos y cumplan con el nombre de la categoria
    $query = mysqli_query($conexion,"SELECT * FROM proyecto WHERE estado='activo' AND categoria='$categoria'");
    //Si algo falla mostramos un mensaje
    if(!$query){
      echo "Error intente mas tarde";
    }
    //Si hay proyectos que coincidan con lo anterior traemos sus datos
    $num = mysqli_num_rows($query);
    if($num > 0){
      $i = 0;
      ?>
      <div class="container"><!-- contenedor para mantener las tarjetas centradas-->
          <div class="row">
          <?php
          //Creamos un ciclo para mostrar los datos de los proyectos
          while($i < $num){
            /*
          $row = array con los datos consultados de un proyecto
          $id_p = identificador del proyecto
          $cate = categoria del proyecto
          $nombre = titulo del proyecto
          $pp = parrafo principal del proyecto
          $video = video principal del proyecto
          $imagen = imagen principal del proyecto
          */
            $row = mysqli_fetch_array($query);
            $id_p = $row['id'];
            $cate = $row['categoria'];
            $nombre = $row['nom_proyecto'];
            $pp = $row['p_principal'];
            $video = $row['video_p'];
            $imagen = $row['imagen_p'];
            //llamamos a la funcion getDias para ver los dias de recaudacion del proyecto, le pasamos como parametros la conexion y el identificador del proyecto
            $dias = getDias($conexion,$id_p);
            //llamamos a la funcion getDias para ver el dinero meta del proyecto, le pasamos como parametros la conexion y el identificador del proyecto
            $dinero = getDinero($conexion,$id_p);
            //llamamos a la funcion getDias para ver el dinero actual del proyecto, le pasamos como parametros la conexion y el identificador del proyecto
            $dinero_a = getDineroActual($conexion,$id_p);
           ?>
           <div class="col-lg-4"><!-- este DIV se esta utilizando para generar el espacio que van a ocupar las targetas -->
          <div class="card m-5 hover_c" style="width: 18rem; cursor:pointer;" onclick="ver()" ><!-- este DIV los estamos utilizando como cuerpo_mayor de la targeta   -->
              <img src="<?php echo $imagen ?>" class="card-img-top" alt="..."> <!-- estamos insertando la imgaen de la targeta del proyecto-->
              <div class="card-body p-0"><!-- este DIV los estamos utilizando como cuerpo de la targeta   -->
                <h5 class="card-title mt-2 px-3"><?php echo $nombre?></h5><!--H5 se utiliza para agregar un tamaño a la letra  -->
                <p class="card-text px-3"><?php echo $pp ?></p><!-- P = se utiliza para agregar texto -->
                
    
                <p class="h6 mt-5 mb-2 ml-3"><?php echo $cate ?></p><!-- P = se utiliza para agregar texto -->
                <div class="" style="background:#FCCFCF;"> <!-- este DIV lo estamos utilizando para contener la barra de progreso -->
                  <?php 
                      //llamamos a la funcion porcentaje para calcular el porcentaje de dinero del proyecto
                      //le pasamos como parametros el dinero actual y el dinero meta del proyecto
                      $porcentaje = porcentaje(getDinero($conexion,$id_p),getDineroActual($conexion,$id_p));
                      
                  ?>
                  <div class="progress-bar bg-danger pro" role="progressbar" style="width: <?php echo $porcentaje.'%' ?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div> <!-- este DIV lo estamos utilizando para generar la barra de progreso -->
                </div>
                <div class="row"><!-- este ROW para asignar una posicio a la parte inferior de la targeta  --> 
                  <div class="col-6"><!-- este  DIV lo estamos utilizando para contener los dias-->
                    <p class="h4 mb-0 mt-3 ml-3"><?php echo $dias ?></p>
                <p class="h6 pt-0 mt-0 mb-3 ml-3 text-muted">Dias</p>
                  </div>
                  <div class="col-6 pl-0"><!-- este  DIV lo estamos utilizando para contener el dinero -->
                    <p class="h4 mb-0 mt-3"><?php echo "$".$dinero_a?></p>
                    <p class="h6 pt-0 mt-0 mb-3  text-muted"><?php echo "$".$dinero ?></p>
                  </div>
                </div>
              </div> 
          </div>
          </a>
          <script>
          function ver(){
            <?php
            echo "window.location='ver.php?pro=$id_p'";
            ?>
          }
          </script>
          </div>
           <?php
           $id_a = $id_p;
           //aumentamos en uno al contador
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

  <?php
  //llamamos a la funcion numProyectosActivos para saber cuantos proyectos activos hay
  //si hay mas de cinco proyectos llamamos a la funcion cartasMas para mostrar un boton para mostrar mas cartas
  if(NumProyectosActivos($conexion) > 5){
    cartasMas($proyectos);
  }
  ?>


        <!--fin de proyectos-->
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      </body>
      </html>

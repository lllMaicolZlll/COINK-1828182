<?php 
//Traemos la palabra buscada por el motodo get
//$palabra = palabra buscada
$palabra = $_GET['pa'];
//Definimos la ruta en la que estamos
$link = "buscador.php?pa=$palabra";
//Incluimos el menu
include("menu.php");
//Mostramos la palabra buscada
echo "<h1 class='text-center'>".$palabra."</h1>";
//Consultamos la palabra buscada entre los nombres de los proyectos que estan activos
$query = mysqli_query($conexion,"SELECT * FROM proyecto WHERE nom_proyecto LIKE '%$palabra%' AND estado='activo'");
//$num = numero de proyectos relacionados con la palabra buscada y que tengan un estado activo
$num = mysqli_num_rows($query);
if($num == 0){
  //Si no se incuentra ninguna relacion con los proyectos y la parabra mostramos un mensaje
  echo "No hay resultados";
}else{
  //$i = contador
  $i = 0;
  ?>
  <div class="container">
  <?php
  //Creamos un ciclo para mostrar todos los proyectos relacionados con las palabras
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
    
   ?>
   <div class="col-lg-4"> <!-- este DIV se esta utilizando para generar el espacio que van a ocupar las targetas -->
  <div class="card m-5 hover_c" style="width: 18rem; cursor:pointer;" onclick="ver()" ><!-- este DIV los estamos utilizando como cuerpo_mayor de la targeta   -->
      <img src="<?php echo $imagen ?>" class="card-img-top" alt="..."> <!-- estamos insertando la imgaen de la targeta del proyecto-->
      <div class="card-body p-0"> <!-- este DIV los estamos utilizando como cuerpo de la targeta   -->
        <h5 class="card-title mt-2 px-3"><?php echo $nombre?></h5><!--H5 se utiliza para agregar un tamaño a la letra  -->
        <p class="card-text px-3"><?php echo $pp ?></p> <!-- P = se utiliza para agregar texto-->
        

        <p class="h6 mt-5 mb-2 ml-3"><?php echo $cate ?></p><!-- P = se utiliza para agregar texto -->
        <div class="" style="background:#FCCFCF;"><!-- este DIV lo estamos utilizando para contener la barra de progreso -->
                  <?php              
                  //Llamamos esta funcion para calcular el porcentaje de el dinero recaudado actualmente para mostrarlo en una barra
                      $porcentaje = porcentaje(getDinero($conexion,$id_p),getDineroActual($conexion,$id_p));
                      
                  ?>
                  <div class="progress-bar bg-danger pro" role="progressbar" style="width: <?php echo $porcentaje.'%' ?>" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div><!-- este DIV lo estamos utilizando para generar la barra de progreso -->
                </div>
        <div class="row"><!-- este ROW para asignar una posicio a la parte inferior de la targeta  --> 
          <div class="col-6"><!-- este  DIV lo estamos utilizando para contener los dias-->
            <p class="h4 mb-0 mt-3 ml-3"><?php echo getDias($conexion,$id_p); ?></p>
        <p class="h6 pt-0 mt-0 mb-3 ml-3 text-muted">Dias</p>
          </div>
          <div class="col-6 pl-0"><!-- este  DIV lo estamos utilizando para contener el dinero -->
            <p class="h4 mb-0 mt-3"><?php echo "$".getDineroActual($conexion,$id_p)?></p>
            <p class="h6 pt-0 mt-0 mb-3  text-muted"><?php echo "$".getDinero($conexion,$id_p) ?></p>
          </div>
        </div>
      </div> 
  </div>
  </a>
  <script>
  //Esta funcion es para redireccionar al proyecto al cual le an dado click
  function ver(){
    <?php
    echo "window.location='ver.php?pro=$id_p'";
    ?>
  }
  </script>
  </div>
   <?php
   $id_a = $id_p;
   //sumamos uno al contador
   $i = $i + 1;
  }
?>
</div>
<?php
}

?>


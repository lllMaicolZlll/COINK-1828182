<?php
//Definimos la ubicacion en la que estamos
$link = "terminados.php";
//Incluimos el menu
include("menu.php");
//Verificamos que exista una variable de sesion
if(isset($_SESSION['id'])){
    $id=$_SESSION['id'];
    //Consultamos la informacion del usuario
    $query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE id='$id'");
    $row = mysqli_fetch_array($query);
    $cargo = $row['cargo'];
    $id_a = 0;
    //Verificamos que el usuario sea un admin
    if($cargo == "admin"){
      //Consultamos los proyectos con estado terminado
        $query = mysqli_query($conexion,"SELECT * FROM proyecto WHERE estado='terminado'");
        $num = mysqli_num_rows($query);
        //Si no hay proyectos terminados mostramos un mensaje
        if($num == 0){
          ?>
          <div class="container">
            <div class="row">
              <div class="col-lg-3"></div>
              <div class="col-lg-7">
                <H1>No hay proyectos Terminados</H1>
              </div>
              <div class="col-lg-2"></div>
            </div>
          </div>
          <?php
        }
        //$i = contadoe
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
          $dias = meta de dias
          $dinero = meta de dinero
          $dinero_a = dinero actual recaudado
          */
          $row = mysqli_fetch_array($query);
          $id_p = $row['id'];
          $cate = $row['categoria'];
          $nombre = $row['nom_proyecto'];
          $pp = $row['p_principal'];
          $video = $row['video_p'];
          $imagen = $row['imagen_p'];
          $dias = getDias($conexion,$id_p);
          $dinero = getDinero($conexion,$id_p);
          $dinero_a = getDineroActual($conexion,$id_p);
         ?>
         <div class="col-lg-4">
        <div class="card m-5 hover_c" style="width: 18rem; cursor:pointer;" onclick="ver()" >
            <img src="<?php echo $imagen ?>" class="card-img-top" alt="...">
            <div class="card-body p-0">
              <h5 class="card-title mt-2 px-3"><?php echo $nombre?></h5>
              <p class="card-text px-3"><?php echo $pp ?></p>
              
  
              <p class="h6 mt-5 mb-2 ml-3"><?php echo $cate ?></p>
              <div class="" style="background:#FCCFCF;">
                  <?php 
                      //Llamamos esta funcion para calcular el porcentaje de el dinero recaudado actualmente para mostrarlo en una barra
                      $porcentaje = porcentaje(getDinero($conexion,$id_p),getDineroActual($conexion,$id_p));
                      
                  ?>
                  <div class="progress-bar bg-danger pro" role="progressbar" style="width: <?php echo $porcentaje.'%' ?>"  aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
              <div class="row">
                <div class="col-6">
                  <p class="h4 mb-0 mt-3 ml-3"><?php echo $dias ?></p>
              <p class="h6 pt-0 mt-0 mb-3 ml-3 text-muted">Dias</p>
                </div>
                <div class="col-6 pl-0">
                  <p class="h4 mb-0 mt-3"><?php echo "$".$dinero_a?></p>
                  <p class="h6 pt-0 mt-0 mb-3  text-muted"><?php echo "$".$dinero ?></p>
                </div>
              </div>
            </div> 
        </div>
        </a>
        <script>
        //Funcion para redireccionar a la vista del proyecto
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
        </div>
        <?php
    }else{
      //Redireccionamos al inicio
        echo "<script>window.location='index.php'</script>";  
    }

}else{
  //Redireccionamos al inicio
    echo "<script>window.location='index.php'</script>";
}

?>
<?php 
//Definimos la ruta en la que nos encontramos
$link = "admin_p.php";
//Incluimos el menu
include("menu.php");
//Verificamos que este activa una sesion
if(isset($_SESSION['id'])){
    $id=$_SESSION['id'];
    //Consultamos la informacion del usuario
    $query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE id='$id'");
    $row = mysqli_fetch_array($query);
    //$cargo = cargo del usuario estandar o admin
    $cargo = $row['cargo'];
    $id_a = 0;
    if($cargo == "admin"){
      //Si el cargo del usuario es admin consultamos los proyectos que tienen como estado en espera
        $query = mysqli_query($conexion,"SELECT * FROM proyecto WHERE estado='espera' AND id!='$id_a'");
        // $num = numero de proyectos con estado en espera
        $num = mysqli_num_rows($query);
        if($num == 0){
          //Si no hay proyectos en espera mostramos un mensaje
          ?>
          <div class="container"><!--  contenedor para organizar la pocicion del mensage "No hay proyectos disponibles"-->
            <div class="row"> <!-- "ROW = FILA" la utilizamos para asignar una posicion al mensaje-->
              <div class="col-lg-3"></div> <!-- con este DIV estamos asignando el tamaño qeur queremos que este vacio-->
              <div class="col-lg-7"> <!-- con este DIV asignamos un tamaño al cajon en donde esta el mensaje -->
                <H1>No hay proyectos disponibles</H1> <!-- H1 = se utiliza para asignar un tamaño de letra en este caso al mensage "No hay proyectos disponibles"-->
              </div>
              <div class="col-lg-2"></div>
            </div>
          </div>
          <?php
        }
        
        
        ?>
        <div class="container"><!-- contenedor para mantenerlas centradas-->
        <div class="row"><!-- este ROW para asignar una posicion al contenedor -->
        <?php
        //$i = contador iniciado en 0
        $i = 0;
        //Creamos un ciclo para mostrar toda la informacion de los proyecto que estan en espera
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
          $query = mysqli_query($conexion,"SELECT * FROM meta WHERE id_proyecto='$id_p'");
          //$row = array con los datos consultados de un proyecto
          $row = mysqli_fetch_array($query);
          //Llamamos esta funcion para traer los dias y le pasamos como parametro el identificador del proyeto
          $dias = getDias($conexion,$id_p);
          //Llamamos esta funcion para traer el dinero a recaudar y le pasamos como parametro el identificador del proyeto
          $dinero = getDinero($conexion,$id_p);
          //Llamamos esta funcion para traer el dinero recaudado y le pasamos como parametro el identificador del proyeto
          $dinero_a = getDineroActual($conexion,$id_p);
         ?>
         <div class="col-lg-4"> <!-- este DIV se esta utilizando para generar el espacio que van a ocupar las targetas -->
        <div class="card m-5 hover_c" style="width: 18rem; cursor:pointer;" onclick="ver()" > <!-- este DIV los estamos utilizando como cuerpo_mayor de la targeta   -->
            <img src="<?php echo $imagen ?>" class="card-img-top" alt="..."> <!-- estamos insertando la imgaen de la targeta del proyecto-->
            <div class="card-body p-0"> <!-- este DIV los estamos utilizando como cuerpo de la targeta   -->
              <h5 class="card-title mt-2 px-3"><?php echo $nombre?></h5> <!--H5 se utiliza para agregar un tamaño a la letra  -->
              <p class="card-text px-3"><?php echo $pp ?></p> <!-- P = se utiliza para agregar texto-->
              
  
              <p class="h6 mt-5 mb-2 ml-3"><?php echo $cate ?></p> <!-- P = se utiliza para agregar texto -->
              <div class="" style="background:#FCCFCF;">  <!-- este DIV lo estamos utilizando para contener la barra de progreso -->
                  <?php 
                      //Llamamos esta funcion para calcular el porcentaje de el dinero recaudado actualmente para mostrarlo en una barra
                      $porcentaje = porcentaje(getDinero($conexion,$id_p),getDineroActual($conexion,$id_p));
                      
                  ?>
                  <div class="progress-bar bg-danger pro" role="progressbar" style="width: <?php echo $porcentaje.'%' ?>"  aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div> <!-- este DIV lo estamos utilizando para generar la barra de progreso -->
                </div>
              <div class="row">  <!-- este ROW para asignar una posicio a la parte inferior de la targeta  --> 
                <div class="col-6"> <!-- este  DIV lo estamos utilizando para contener los dias-->
                  <p class="h4 mb-0 mt-3 ml-3"><?php echo $dias ?></p>
              <p class="h6 pt-0 mt-0 mb-3 ml-3 text-muted">Dias</p>
                </div>
                <div class="col-6 pl-0"> <!-- este  DIV lo estamos utilizando para contener el dinero -->
                  <p class="h4 mb-0 mt-3"><?php echo "$".$dinero_a?></p>
                  <p class="h6 pt-0 mt-0 mb-3  text-muted"><?php echo "$".$dinero ?></p>
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
        </div>
        <?php
    }else{
      //Si el cargo no es admin redireccionamos al index
        echo "<script>window.location='index.php'</script>";  
    }

}else{
  //Si no existe una sesion redireccionamos al index
    echo "<script>window.location='index.php'</script>";
}

?>
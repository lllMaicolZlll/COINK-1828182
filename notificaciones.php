<?php
//Definimos cual es la ruta en la que nos encontramos
$link = "notificaciones.php";
//Incluimos el menu
include("menu.php");
//Verificamos que esiste una sesion
if((!$id)){
    //Si no existe una sesion redireccionamos al index
    ?>
    <script type="text/javascript">
    window.location="index.php";
    
    </script>
    <?php
}else{
    //Si existe una sesion consultamos las notificacion para el usuario
    $query = mysqli_query($conexion,"SELECT * FROM notificaciones WHERE id_user='$id' order by id_n desc"); 
    $num = mysqli_num_rows($query);
    if($num == 0){
        //Si no hay notificaciones para el usuario le enviamos un mensaje
        ?>
        <div class="container">
            <div class="row">
                <div class="col">
                    <h4 class="display-4">No tienes notificaciones</h4>
                    
                </div>
            </div>
        </div>
        <?php
    }else{
        ?>
        <br><br><br>
        <div class="container bg-white">
        <br>
        <?php
        //$i = contador
        $i = 0;
        //Creamos un ciclo para mostrar todas las notificaciones
           while($i<$num){
           //Traemos los datos de la base de datos
           $row = mysqli_fetch_array($query);
           /*
           $id_n = identificacion de la notificacion
           $parrafo = prrafo de la notificacion
           $sobre = tema de la notificacion
           $fecha = fecha de la notificacion
           */
           $id_n = $row['id_n'];
           $parrafo = $row['parrafo_n'];
           $sobre = $row['sobre'];
           $fecha = $row['fecha'];
        ?>
            
            <div class="">
                <div class="col">
                <hr>
                <!-- Llamamos a la funcion consultar link para traer el link del proyecto, del cual se le a notificado al usuario -->
                    <!-- Si es un usuario estandar mostramos primero el motivo de la notificacion -->
                    <h4 class="text-muthed"><a href="<?php echo consultaLink($conexion,$id_n)?>"><?php if($cargo == 'start'){
                        echo $sobre;
                    }else{
                    //Si el usuario no es estandar, mostramos primero la descripcion de la notificacion 
                      echo $parrafo;  
                    } 
                    ?> </a>
                    
                   <?php
                        //Confirmamos el estado de la notificacion
                      if($row['estado']=="novisto"){
                        $estado = "Nuevo";
                        ?>
                        <!-- Si tiene un estado nuevo mostramos el mensaje de nueva notificacion-->
                        <span class="badge badge-danger"><?php echo $estado ?></span></h4>
                        <?php
                      }else{
                          //Si el estado es visto no mostramos nada
                          $estado = "visto";
                      }
                    ?>
                    <hr>
                    <!-- Si es un usuario estandar mostramos la descripcion de la notificacion -->
                    <p><?php if($cargo == 'start'){
                        echo $parrafo;
                    }else{
                        //Si el usuario no es estandar mostramos el sobre
                      echo $sobre;
                    }  
                    ?></p>
                    <br><br>
                </div>
            </div>
                    
        <?php
        $i = $i +1;
        //Llamamos esta funcion para cambiar el estado de las notificaciones no vistas
        notificacionVista($conexion,$id_n);
?>
<br><br><br>
<?php
//Escribimos la fecha de la notificacion
echo $fecha;

    } 

    ?>
    
    </div>
    <?php
    }
    

 }
?>
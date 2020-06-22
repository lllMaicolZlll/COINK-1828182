<?php 
//Incluimos la conexion ala base de datos
include("php/conexion.php");
//Confirmamos que se alla presionado el boton
if(isset($_POST['confirmar'])){
    //Traemos los datos
    /*
    $contra1 = contraseña nueva
    $contra2 = confirmacion de la contraseña nueva
    $id_u = identificador del usuario
    */
    $contra1 = $_POST['contra1'];
    $contra2 = $_POST['contra2'];
    $id_u  = $_POST['id_u'];
    
    if($contra1 == $contra2){
        //Confirmamos que las contraseñas coincidan y la actualizamos a nueva contraseña
        $query = mysqli_query($conexion,"UPDATE `usuarios` SET `contra`='$contra1' WHERE id='$id_u'");
        if($query){
            //Si la accion se realiza correctamente eliminamos el codigo de recuperacion
            $query = mysqli_query($conexion,"DELETE FROM `codigorecuperacion` WHERE id='$id_u'");
            if($query){
                //Mostramos un mensaje de exito si todo sale bien
                echo "<script>alert('Contraseña cambiada, inicie sesion')</script>";
                echo "<script>window.location='index.php'</script>";
            }else{
                //Si algo resulta mal mostramos un mensaje
                echo "<script>alert('Error')</script>"; 
            }
           

        }else{
           echo "<script>alert('Error')</script>";

        }
    }else{
        //Si las contraseñas no son iguales mostramos un mensaje
            echo "<script>alert('Las contraseñas no coinciden')</script>";
        }  
}

?>
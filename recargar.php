<?php
//Incluimos la conexion
include("php/conexion.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Recargar</title>
</head>
<body>
<br>
<?php 
//Iniciamos una sesion
session_start();
//Verificamos que este activa un variable de sesion
if(isset($_SESSION['id'])){
    $id = $_SESSION['id'];
    //Consultamos los datos del usuario
    $query= mysqli_query($conexion,"SELECT * FROM usuarios WHERE id='$id'");
    $row = mysqli_fetch_array($query);
    $cargo = $row['cargo'];
    //Verificamos que el cargo sea el de recargador
    if($cargo == 'rec'){
        ?>

        <?php
        //Mostramos un mensaje de bienvenida
        echo "<h1 class='text-center'>Bienvenido ".$row['nombres']."</h1>";
    ?>
    <hr>
    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
    <div class="container">
        <div class="row">
            <div class="col-lg-5"></div>
            <div class="col-lg-4"><input type="submit" name="cerrar" class="btn btn-danger" value="Cerrar Sesion"></div>
            <div class="col-lg-3"></div>
        </div>
    </div>
        
    </form>
    <br><br>
    <div class="container">
        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
        <div class="input-group">
      <input class="form-control buscador" type="text"  placeholder="Buscar" aria-label="Bucar" name="palabra">
      <button class="btn btn-outline-danger my-2 my-sm-0" type="submit" name="buscar">Buscar</button>
      </div>
      <br>
      </form>
     <table class="table">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Nombres</th>
            <th scope="col">Apellidos</th>
            <th scope="col">Email</th>
            <th scope="col">Recargar</th>
            </tr>
        </thead>
        <?php
        //Verificamos si presiono buscar
        if(isset($_POST['buscar'])){
            //Traemos la palabra a buscar
            $palabra = $_POST['palabra'];
            //Verificamos si la palabra buscada coincide con el nombre, apellido o correo de un usuario
            $query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE correo LIKE '%$palabra%' AND estado='activo' AND cargo='start' OR nombres LIKE '%$palabra%' AND estado='activo' AND cargo='start' OR aprellidos LIKE '%$palabra%' AND estado='activo' AND cargo='start'");

        }else{
            //Si no a presionado el boton buscar Consultamos los usuarios estandar activos
            $query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE estado='activo' AND cargo='start' LIMIT 10");
        }
        
        ?>
        <tbody>
        <?php 
        
        $num = mysqli_num_rows($query);
        //$i contador
        $i = 1;
        if($num == 0){
            //Si no hay usuario que coincidan se muestra un mensaje
            echo "<script>alert('No se incontraron resultados')</script>";
            echo "<script>window.location='recargar.php'</script>";
        }else{
            //Creamos un ciclo para mostrar los usuarios y un boton para recargar
         while($i < $num+1){
             /*
             $row = array con los datos del usuario
             */
            $row = mysqli_fetch_array($query);
            ?>
            <tr>
            <form action="recarga.php" method="post">
            <input type="text" value="<?php echo $row['id'] ?>" name="id_u" hidden>
            <th scope="row"><?php echo $row['id'] ?></th>
            <td><?php echo $row['nombres'] ?></td>
            <td><?php echo $row['aprellidos'] ?></td>
            <td><?php echo $row['correo'] ?></td>
            <td><input type="submit" name="recargar" value="Recargar"class="btn btn-success"></td>
            </tr>
            </form>
            <?php
            //Sumamos uno al contador
            $i = $i +1;
        }   
        }
        
        ?>
        
        </tbody>
        </table>
    </div>
   
    <?php
    }else{
        echo "<script>window.location='index.php'</script>";
    }
    
    
}else{
    ?>
    <!-- Formulario para iniciar sesion un recargador -->
    <div class="container">
        <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Si tienes algun problema!</strong> Comunicate de inmediato al 911.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <hr>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Codigo</label>
                    <input type="text" name="email"class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                    <small id="emailHelp" class="form-text text-muted">Problemas con tu codigo..? click <a href="">aqui</a>.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Contraseña</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" name="contra">
                </div>
                <hr>
                <?php
                //Si presiona ingresar, traemos los datos del formulario
                if(isset($_POST['ingresar'])){
                    $contra =$_POST['contra'];
                    $email = $_POST['email'];
                    //verificamos que los datos no esten vacios
                    if($contra == "" && $email == ""){
                        ?>
                        <div class="alert alert-danger" role="alert">
                            Complete todos los datos!
                        </div>
                        <?php
                    }else{
                        //Consultamos el usuario que coincida con los datos
                        $query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE correo='$email' AND contra='$contra' AND cargo='rec'");
                        if(!$query){
                            //Si falla algo mostramos un mensaje
                            echo "Error";
                        }
                        $num = mysqli_num_rows($query);
                        if($num <1){
                            //Si no se incuentran resultados mostramos un mensajo
                            ?>
                        <div class="alert alert-danger" role="alert">
                            Contraseña o codigo incorrecto!
                        </div>
                        <?php
                        }else{
                            //Si se inisia correctamente se inicia una sesion y se recarga la pagina
                            $row =mysqli_fetch_array($query);
                            $_SESSION['id'] = $row['id'];
                            echo $_SESSION['id'];
                            echo "<script>window.location='recargar.php'</script>";
                        }
                    }
                }
                ?>
                <button type="submit" class="btn btn-primary" name="ingresar">Ingresar</button>
            </form>
        </div>
        <div class="col-lg-3"></div>
        
        </div>
    </div>
    <?php
}
//Si presiona cerrar, se cierra la sesion y se redireciona 
if(isset($_POST['cerrar'])){
    session_destroy();
    echo "<script>window.location='recargar.php'</script>";
}

?>

<br><br>

        

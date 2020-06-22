<?php
//se verifica si preciono el boton recargar o el boton envioRecarga de la pagina recargar.php 
if(isset($_POST['recargar']) || $_POST['envioRecarga']){
    //incluimos la conexion
    include('php/conexion.php');
    //incluimos las funciones
    include('php/funciones.php');
    //$id_u = identificador del usuario a recargar
    $id_u = $_POST['id_u'];
    ?>
    <div class="container">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <form action="" method="post"> 
    <br>
    <?php
    //llamamos a la funcion getImagen para mostrar la imagen de perfil del usuario
    $imagen = getImagen($conexion,$id_u);
    //si no tiene ninguna imagen mostramos una por defecto
    if($imagen == ""){
      ?>
      <div class="container">
        <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
        <center>
            <img type ="file" src="img/ava.png " style="width:100px; heigth:100px;" class="im-p "alt="">
        </center>
            </div>
            <div class="col-lg-4"></div>
        </div>
      </div>
      <?php
    }else{
        //Si, si tiene una imagen la mostramos
      ?>
      <div class="container">
        <div class="row">
        <div class="col-lg-4"></div>
        <div class="col-lg-4">
        <center>
            <img type ="file" src="<?php echo $imagen?>" style="width:100px; heigth:100px;" class="im-p "alt="">
        </center>
            </div>
            <div class="col-lg-4"></div>
        </div>
      </div>
      <?php
    }
    ?>
            
      
    <div class="alert alert-light text-center" role="alert">
    <!-- Llamamos las funciones getNombre y getApellido para mostrar los nombres y los apellidos del usuario -->
    Recarga a : <?php echo getNombre($conexion,$id_u)." ".getApellido($conexion,$id_u);?>
    <br>
    <!-- llamamos a la funcion get saldo para mostrar el saldo del usuario -->
    Saldo actual : <?php echo $saldo = getSaldo($conexion,$id_u);?> 
    </div>
     <hr>
    
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-1"></div>
            <div class="col-lg-11">
            <!-- boton de 1000 -->
            <input type="button" class="btn mil" name="mil" onclick="clickMil()" value="1000" style="cursor:pointer">
            <!-- boton de 2000 -->
            <input type="button" class="btn dosk" name="dosk" onclick="clickDos()" value="2000" style="cursor:pointer">
            <!-- boton de 5000 -->
            <input type="button" class="btn cincok" name="cincok" onclick="clickTres()" value="5000" style="cursor:pointer">
            </div>
            <br><br>
            <div class="col-lg-1"></div>
            <div class="col-lg-11">
            <!-- boton de 10000 -->
            <input type="button" class="btn diezk" name="diezk" onclick="clickCuatro()"  value="10000" style="cursor:pointer">
            <!-- boton de 20000 -->
            <input type="button" class="btn veintek" name="veintek" onclick="clickCinco()"  value="20000" style="cursor:pointer">
            <!-- boton de 50000 -->
            <input type="button" class="btn cincuentak" name="cincuentak" onclick="clickSeis()"  value="50000" style="cursor:pointer">
            </div>
             <input type="text" value="<?php echo $id_u ?>" name="id_u" hidden> 
            
             <div class="container"> 
             <hr>
             <div class="row">
             <div class="col-lg-3"></div>
              <label for="otrov" class="text-muted">Total a recargar :</label>
             <div class="col-lg-2"><input type="text" class="form-control " value="0" name="total" id="total">
             <br>
             <input type="submit" class="btn btn-success"name="envioRecarga" value="Recargar">
             </div>
             <div class="col-lg-7"></div>
             
             
             </div>
             
             </div>
           
           
            
            </form>
        </div>
    </div>
    
    <?php
    //si preciona el boton envioRecarga se calcula el total a recargar y se actualiza el saldo del usuario
    if(isset($_POST['envioRecarga'])){
        /*
        $total= total de dinero a recargar
        $saldo = saldo actual de un usuario
        $id_u = identificador de un usuario
        */
        $total = $_POST['total'];
        $total = $total + $saldo;
        if($total > 0){
            //llamamos la funcion setSaldo para actualizar el saldo del usuario
            setSaldo($conexion,$id_u,$total);
        }
    }
}else{
    echo "<script>window.location='error.php'</script>";
}
//Estilos de los botones para recargar
?>
<style>
.mil{
    background-image: url('img/mil.jpg');
    background-size: cover;
    height:150px;
    width:300px;
    padding: 10px;
}
.dosk{
    background-image: url('img/dos.jpg');
    height:150px;
    width:300px;
    background-size: cover;
    padding: 10px;
}
.cincok{
    background-image: url('img/cin.jpg');
    height:150px;
    width:300px;
    background-size: cover;
    padding: 10px;
}
.diezk{
    background-image: url('img/10.png');
    height:150px;
    width:300px;
    background-size: cover;
    padding: 10px;
}
.veintek{
    background-image: url('img/veinte.png');
    height:150px;
    width:300px;
    background-size: cover;
    padding: 10px;
}
.cincuentak{
    background-image: url('img/cinco.jpg');
    height:180px;
    width:300px;
    background-size: cover;
    padding: 10px;
}

</style>
<script>
//Funcion para sumar 1000 al total
function clickMil(){
    //al dar click traemos el total a recargar  
    var recarga  = document.getElementById("total").value;
    //lo transformamos en int
    recarga = parseInt(recarga);
    //le sumamos 1000
    recarga  = recarga + 1000;
    //y escribimos el resultado
    document.getElementById("total").value = recarga;
}
//Funcion para sumar 2000 al total
function clickDos(){
    //al dar click traemos el total a recargar 
    var recarga  = document.getElementById("total").value;
    //lo transformamos en int
    recarga = parseInt(recarga);
    //le sumamos 2000
    recarga  = recarga + 2000;
    //y escribimos el resultado
    document.getElementById("total").value = recarga;
}
//Funcion para sumar 5000 al total
function clickTres(){
    //al dar click traemos el total a recargar 
    var recarga  = document.getElementById("total").value;
    //lo transformamos en int
    recarga = parseInt(recarga);
    //le sumamos 5000
    recarga  = recarga + 5000;
    //y escribimos el resultado
    document.getElementById("total").value = recarga;
}
//Funcion para sumar 10000 al total
function clickCuatro(){
    //al dar click traemos el total a recargar
    var recarga  = document.getElementById("total").value;
    //lo transformamos en int
    recarga = parseInt(recarga);
    //le sumamos 10000
    recarga  = recarga + 10000;
    //y escribimos el resultado
    document.getElementById("total").value = recarga;
}
//Funcion para sumar 20000 al total
function clickCinco(){
    //al dar click traemos el total a recargar
    var recarga  = document.getElementById("total").value;
    //lo transformamos en int
    recarga = parseInt(recarga);
    //le sumamos 20000
    recarga  = recarga + 20000;
    //y escribimos el resultado
    document.getElementById("total").value = recarga;
}
//Funcion para sumar 50000 al total
function clickSeis(){
    //al dar click traemos el total a recargar
    var recarga  = document.getElementById("total").value;
    //lo transformamos en int
    recarga = parseInt(recarga);
    //le sumamos 50000
    recarga  = recarga + 50000;
    //y escribimos el resultado
    document.getElementById("total").value = recarga;
}
</script>
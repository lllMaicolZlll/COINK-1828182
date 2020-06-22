<?php 
//Definimos la ruta en la que estamos
$link ="sub-pro.php";
//Incluimos el menu
include('menu.php');
//Verificamos si existe una variable sesion
if(isset($_SESSION['id'])){
  $id=$_SESSION['id'];
  //Consultamos los usuarios que tengan algunos datos especiales
  $query= mysqli_query($conexion,"SELECT * FROM usuarios WHERE id='$id' AND identificacion>0");
  $row = mysqli_fetch_array($query);
  $nombre = $row['nombres'];
  //Si el dato de la identificacion existe consultamos si el usuario tiene un proyecto
  if($row['identificacion']>0){
    $query = mysqli_query($conexion,"SELECT * FROM proyecto WHERE id_user='$id'");
    $num = mysqli_num_rows($query);
    $row2 = mysqli_fetch_array($query);
    //Consultamos el estado del proyecto
  if($num >0 && $row2['estado'] == 'activo' || $row2['estado'] == 'espera'){
      echo "<script> window.location='index.php'</script>";
  }
  }else{
    ?>
    <script>
    window.location="index.php";
    </script>
    <?php
  }
?>


<!-- Formuario de proyecto -->
<div class="container-fluid pigg">
<div class="row">
    <div class="col-2  shadow-lg pt-3 pl-0 pr-3  bg-white rounded">
                <?php
                //Mostramos la imagen del usuario
                $imagen = getImagen($conexion,$id);
                if($imagen == ""){
                  ?>
                  <img type ="file" src="img/ava.png " class="img-fluid rounded-circle ml-5 border border-danger w-50 h-20 " alt="Responsive image">
                  <?php
                }else{
                  ?>
                <img src="<?php echo $imagen ?>" class="img-fluid rounded-circle ml-5 border border-danger w-50 h-20 " alt="Responsive image">
                  <?php
                }
              ?>
               <p class="h3 font-italic ml-4"><?php echo $nombre; ?></p>
            <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
            <ul class="list-group list-group-flush mt-5 pr-0">
                    <button id="p1" data-target="#carouselExampleIndicators " data-slide-to="0" class="list-group-item h5">Paso #1</button>
                    <button id="p2" disabled data-target="#carouselExampleIndicators" data-slide-to="1"  class="list-group-item h5">Paso #2</button>
                    <button  id="p3" disabled data-target="#carouselExampleIndicators" data-slide-to="2" class="list-group-item h5">Paso #3</button>
                    <button id="p4" disabled data-target="#carouselExampleIndicators" data-slide-to="3"class="list-group-item h5">Paso #4</button>
                    <button id="p5" disabled data-target="#carouselExampleIndicators" data-slide-to="4"class="list-group-item h5">Paso #5</button>
            </ul>
                <p class="h6 text-center font-italic text-muted">Coink /R/</p>
      </div>

      <div class="col-1"></div>
      
      <div class="col-8 mt-5 shadow bg-white p-3 mb-5  rounded" >
                    <div id="carouselExampleIndicators" class="carousel slide " data-ride="carousel" data-interval="1000000000">
                            <ol class="carousel-indicators">
                              <li data-target="#carouselExampleIndicators " data-slide-to="0" class="active bg-danger mt-5 more-top"></li>
                              <li id="pp2" style="display:none;" data-target="#carouselExampleIndicators" data-slide-to="1" class="bg-danger mt-5"></li>
                              <li id="pp3" style="display:none;" disabled data-target="#carouselExampleIndicators" data-slide-to="2" class="bg-danger mt-5"></li>
                              <li id="pp4" style="display:none;" disabled data-target="#carouselExampleIndicators" data-slide-to="3" class="bg-danger mt-5"></li>
                              <li id="pp5" style="display:none;" disabled data-target="#carouselExampleIndicators" data-slide-to="4" class="bg-danger mt-5"></li>
                            </ol>
                            
                            
                            <div class="carousel-inner">
                              <div class="carousel-item active">
                                  <div class="formu_1" onkeyup="pasoUno()">
                                  <div class="container">
                                    <div class="row">
                                      <div class="col-12">
                                         <p class="h2 text-muted">Titulo</p>
                                      <input name="nombre"id="titulo" type="text" class="form-control mb-5" placeholder="Coink te ayuda" id="" >
                                      
                                      <p class="h3 text-muted">Link video</p>
                                      <input name="link" id="link"type="text" class="form-control " placeholder="ww.youtube.com.co.org.tugfa.:v" id="" >
                                      </div>
                                    </div>
                                       <div class="row mt-3">
                                         <div class="col-6">
                                         <p class="h3 text-muted mt-3">Dias para recaudar</p>
        <div class="form-group col-md-4 ">
          <select id="dias" class="form-control" name="dias">
             <option noselect>0</option>
             <option>8</option>
            <option>15</option>
             <option>20</option>
             <option>25</option>
             <option>30</option>
             <option>35</option>
             <option>40</option>
            <option>50</option>
             <option>60</option>
             <option>80</option>
           </select>
        </div>
        <div id="gg" style="display:none;">hola</div>
        <p class="h3 text-muted mt-4">Dineo a recaudar</p>
                                    <div class="form-group col-md-4">
                                      <input name="dinero"id="dinero" onkeypress="return soloNumeros(event)" type="text" class=" form-control"placeholder="100.000">
                                    </div>
                                         </div>
                                         <div class="col-6">
                                           <label id="largeFile" for="file" >
                                          <input type="file"class="mb-3" id="file" name="fotoUno"/>
                                      </label>
                            
                                      </div>
                                       </div>
                                   </div>
                                  </div>      
                              </div>

                              <div class="carousel-item">
                                    <div class="formu_2" onmousemove="pasoDos()" >
                                    <div class="container">
                                       <div class="row">
                                         <div class="col-9"><p class="h2 text-muted">Parrafo principal</p>
                                      <textarea  name="pp" id="pp"class="p-3 border-bottom" cols="70" rows="7" placeholder="Tu proyecto en 100 palabras"></textarea>
                                          </div>
                                       <div class="col-3">
                                    
                                         <img src="img/muestra_r.png" class="img-fluid h-100" alt="Responsive image" >
                                          
                                       </div>
       
                                    </div>


                                    <div class="row">
                                        <div class="col-12"><p class="h2 text-muted mb-3"> Categoria </p></div>
                                        
                                        <div class="col-2"> <button  onclick="pasoDos()" id="catUno" onclick="" value="arte" type="button" class="btn btn2 btn-light boton_cate p-0" > 
                                      <i class='fas fa-paint-brush'> </i>
                                         <p class="h6">Arte</p>
                                      </button></div>
                                        <div class="col-2"><button  onclick="pasoDos()" id="catDos"  value="eco" type="button" class="btn btn3 btn-light boton_cate p-0" >
                                      <i class='fas fa-leaf'> </i> 
                                      <p class="h6">Ecologico</p>
                                      </button></div>
                                        <div class="col-2"><button  onclick="pasoDos()" id="catTres" type="button" class="btn btn4 btn-light boton_cate p-0" >
                                      <i class='fas fa-running' ></i> 
                                      <p class="h6">Deportes</p>
                                      </button></div>
                                        <div class="col-2"><button  onclick="pasoDos()"id="catCua" type="button" class="btn btn5 btn-light boton_cate p-0" >
                                      <i class='fas fa-box-open'> </i> 
                                      <p class="h6">Productos</p>
                                      </button></div>
                                        <div class="col-2"><button  onclick="pasoDos()"id="catCin" type="button" class="btn btn6 btn-light boton_cate p-0" >
                                      <i class='fas fa-glass-cheers'></i>
                                      <p class="h6">Eventos</p>
                                      </button></div>
                                        <div class="col-2"><button  onclick="pasoDos()"id="catSix" type="button" class="btn btn7 btn-light boton_cate p-0" >
                                      <i class='fas fa-home'></i> 
                                      <p class="h6">Fundaciones</p>
                                        </button></div>
                                          <input type="text" id="catee"value="" name="cate" hidden>
                                        </div>
                                      </div>
                                    </div>
                                </div>
                              <div class="carousel-item">
                                  <div class="formu_3" onkeyup="pasoTres()">
                                                                                    <div class="container">
                                                          <nav>
                                                              <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                                                <a class="nav-item nav-link text-danger active " id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">parrafo 1</a>
                                                                <button  disabled class="nav-item nav-link text-danger" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">parrafo 2</button>
                                                                <button disabled class="nav-item nav-link text-danger" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">parrafo 3</button>
                                                                <input  type="submit" name="mas_p" class="nav-item nav-link text-danger "   value="+">                                                                   

                                                      </div>
                                                          </nav>

                                                  <div class="tab-content" id="nav-tabContent">
                                                      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                                        <div class="row">
                                                          <div class="col-8"><p class="h2 text-muted mt-3">Titulo parrafo</p>
                                                          <input type="text" name="tp1" class="form-control mb-5" placeholder="objetivo de Coink" id="tp1" >
                                                            <textarea type="text" name="pa1" id="pa1" cols="70" rows="10" placeholder="El objetivo de coink es ayudar" class="p-3"></textarea></div>
                                                            <div class="col-4">                                     
                                                              
                                                            </div>
                                                        </div>
                                                      </div>
                                                        <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                                        <div class="row">
                                                          <div class="col-8"><p class="h2 text-muted mt-3">Titulo parrafo</p>
                                                              <input type="text" name="tp2" class="form-control mb-5" placeholder="Problema" id="tp2" >
                                                              <textarea type="text" name="pa2" id="pa2" cols="70" rows="10" placeholder="No hay financiamiento para proyectos" class="p-3"></textarea>
                                                          </div>
                                                          <div class="col-4">                                     
                                                            
                                                          </div>
                                                          </div>
                                                        </div>
                                                        
                                                      <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                                                      <div class="row">
                                                        <div class="col-8">
                                                                <p class="h2 text-muted mt-3">Titulo parrafo</p>
                                                                <input type="text" name="tp3"class="form-control mb-5 " placeholder="Solucion" id="tp3" >
                                                                <textarea type="text" name="pa3" id="pa3" cols="70" rows="10" placeholder="Coink plataforma crowfunding bien echo" class="p-3"></textarea>
                                                        </div>
                                                        <div class="col-4">                                     
                                                            
                                                        </div>
                                                        </div>
                                                      </div>
                                                  
                                                    </div>
                                                  </div>
</div>
</div>
     <div class="carousel-item">
         <div class="formu_4" onkeyup="pasoCua()">

         <div class="container">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
              <a class="nav-item nav-link text-danger active " id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">recompensa 1</a>
              <a class="nav-item nav-link text-danger" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">+</a>

            </div>
        </nav>
<div class="tab-content" id="nav-tabContent">
    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
      <div class="row">
        <div class="col-8"><p class="h2 text-muted mt-3">Titulo recompensa</p>
        <input type="text" name="tr" class="form-control mb-5" placeholder="3 panes" id="tr" >
          <textarea type="text"name="pr" id="pr" cols="70" rows="7" placeholder="que tiene la recompensa" class="p-3"></textarea></div>
          <div class="col-4">                      
            <p class="h4 text-muted mt-4"> valor </p>  
            <input onkeypress="return soloNumeros(event)" type="text" name="valor"class="form-control" placeholder="3 panes" id="valor" >
                
          </div>
      </div>
    </div>
    </div>
      
   
  </div>
  
</div>

</div>
<div class="carousel-item">
  <center>
  <div class="formu_4" >
         <img src="img/cerdito.jpg" style="height:400px; width:400px;"alt="">
         <input class="btn btn-outline-danger" style="margin-top:40%;" type="submit" value="Enviar" name="enviar">
 
    </div>
  </center>
       
    </div>
   </div>
  </div>
     </div>
      </div>
    </div>
    </form>
    <script>
            //Confirmamos que los campos del paso uno tengan algun dato, y avilitamos el paso 2
            function pasoUno(){
                if ($('#titulo').val().length != 0 && $('#link').val().length != 0 && $('#dias').val().length != 0 && $('#dinero').val().length != 0) {
                  document.getElementById("p2").disabled = false;
                  document.getElementById("pp2").style.display = "block";
                }
            }
            //Confirmamos que los campos del dos uno tengan algun dato, y avilitamos el paso 3
            function pasoDos(){
              
              $(".boton_cate").click(function(){
               var id= $(this).attr('id');
               if(id == "catUno"){
                 var cate = "arte";
               }else if(id == "catDos"){
                var cate = "ecologia";
               }else if(id=="catTres"){
                var cate = "deportes";
               }else if(id=="catCua"){
                var cate = "productos";
               }else if(id=="catCin"){
                var cate = "eventos";
               }else if(id=="catSix"){
                var cate = "fundaciones";
               }
               
               if($('#pp').val().length != 0 && cate != undefined){
                  document.getElementById("p3").disabled = false;
                  document.getElementById("pp3").style.display = "block";
                  document.getElementById("catee").value=cate;
               }
                 
              });
              
            }
            //Confirmamos que los campos del paso tres tengan algun dato, y avilitamos el paso 4
            function pasoTres(){
              var titulo = document.getElementById("tp1").value;
              var parrafo = document.getElementById("pa1").value;
              if(titulo != "" && parrafo != ""){
                document.getElementById("nav-profile-tab").disabled = false;
                document.getElementById("nav-profile-tab").setAttribute("style", "background-color:#fff; ");
                var titulo2 = document.getElementById("tp2").value;
                var parrafo2 = document.getElementById("pa2").value;
                if(titulo2 != "" && parrafo2 != ""){
                  document.getElementById("nav-contact-tab").disabled = false;
                  document.getElementById("nav-contact-tab").setAttribute("style", "background-color:#fff; ");
                  var titulo3 = document.getElementById("tp3").value;
                  var parrafo3 = document.getElementById("pa3").value;
                  if(titulo3 != "" && parrafo3 != ""){
                    document.getElementById("p4").disabled = false;
                    document.getElementById("pp4").style.display = "block";
                  }
                }
              }
            }
            //Confirmamos que los campos del paso cuatro tengan algun dato, y avilitamos el paso 5 que es enviar
            function pasoCua(){
              var titulor = document.getElementById("tr").value;
              var parrafor = document.getElementById("pr").value;
              var valor = document.getElementById("valor").value;
              if(titulor != "" && parrafor != "" && valor != ""){
                document.getElementById("p5").disabled = false;
                document.getElementById("pp5").style.display = "block";
              }
            }  
            //Funcion para que el usuario solo pueda ingresar numeros
            function soloNumeros(e)
              {
                var key = window.Event ? e.which : e.keyCode
                return ((key >= 48 && key <= 57) || (key==8))
              }
    </script>
   
<?php
//Si presion el boton enviar se traen todos los datos del formulario
 if(isset($_POST['enviar'])){

  $nombreImagenUno = $_FILES['fotoUno']['name'];
  $tmpUno = $_FILES['fotoUno']['tmp_name'];
  $titulo1 = $_POST['nombre']; 
  $link = $_POST['link'];
  $dias = $_POST['dias'];
  $dinero = $_POST['dinero'];
  //Verificamos que los primeros no esten vacios
  if($titulo1 !="" && $link != "" && $dias != "" && $dinero != ""){
    $parrafop = $_POST['pp'];
    $cate = $_POST['cate'];
    //Verificamos que estos datos no esten vacios
    if($parrafop != "" && $cate != ""){
      $tp1 = $_POST['tp1']; $pa1 = $_POST['pa1'];
      $tp2 =$_POST['tp2']; $pa2 = $_POST['pa2'];
      $tp3 =$_POST['tp3'];  $pa3 = $_POST['pa3'];
      //Verificamos que estos datos no esten vacios
      if($tp1 != "" && $pa1 != "" && $tp2 != "" && $pa2 != "" && $tp3 != "" && $pa3 != ""){
        $tr = $_POST['tr'];
        $pr = $_POST['pr'];
        $valor =$_POST['valor'];  
        //Verificamos que estos datos no esten vacios
        if($tr != "" && $pr != "" && $valor != ""){
          $id = $_SESSION['id'];
          //Definimos la ruta de la imagen
          $archivoUno = "img/".$nombreImagenUno;
          //Movemos la imagen a una carpeta
          move_uploaded_file($tmpUno,$archivoUno);
          //Insertamos los primeros datos en proyecto
          $query = mysqli_query($conexion,"INSERT INTO proyecto(`id`, `id_user`, `nom_proyecto`, `estado`, `categoria`, `p_principal`, `imagen_p`,`video_p`) VALUES (NULL,$id,'$titulo1','espera','$cate','$parrafop','$archivoUno','$link')");
          //Consultamos los datos del proyecto recien insertado
          $slect = mysqli_query($conexion,"SELECT id FROM proyecto WHERE id_user='$id' AND nom_proyecto ='$titulo1'");
          $row = mysqli_fetch_array($slect);
          $id_p = $row['id'];
          if(!$query){
            echo "error al insertar proyecto";
          }else{
            //Ahora insertamos otros datos en los detallos
            $query = mysqli_query($conexion,"INSERT INTO `detaller_pro`(`id_detalle`, `id_proyecto`, `titulo_p`, `parrafo`, `imagen`) VALUES (NULL,$id_p,'$tp1','$pa1',''),(NULL,$id_p,'$tp2','$pa2',''),(NULL,$id_p,'$tp3','$pa3','')");
            if(!$query){
              //Si este insert falla se elimina el proyecto
              echo "error 2 insert";
              $query = mysqli_query($conexion,"DELETE FROM proyecto WHERE id = '$id_p'");
            }else{
              //Ahora insertamos en metas
              $query = mysqli_query($conexion,"INSERT INTO `meta`(`id_meta`, `dinero`,`dinero_actual`, `id_proyecto`,`dias`) VALUES (NULL,$dinero,0,$id_p,$dias)");
              if(!$query){
                //Si el insert falla eliminamos de proyecto y de detalles
                echo "error 3 insert";
                $query = mysqli_query($conexion,"DELETE FROM proyecto WHERE id = '$id_p'");
                $query = mysqli_query($conexion,"DELETE FROM detaller_pro WHERE id_proyecto = '$id_p'");
              }else{
                //Ahora insertamos en recompensas
                $query = mysqli_query($conexion,"INSERT INTO `recompensa`(`id_recompensa`, `id_proyecto`,`valor`,`titulo_r`, `descripcion`, `imagen`) VALUES (NULL,$id_p,'$valor','$tr','$pr','')");
                if(!$query){
                  //Si el insert falla eliminamos de metas, proyectos y detalles
                  echo "error en el 4 insert";
                  $query = mysqli_query($conexion,"DELETE FROM meta WHERE id_proyecto = '$id_p'");
                  $query = mysqli_query($conexion,"DELETE FROM proyecto WHERE id = '$id_p'");
                  $query = mysqli_query($conexion,"DELETE FROM detaller_pro WHERE id_proyecto = '$id_p'");
                }else{
                    //Si todo resulta bien redireccionamos a la vista del proyecto recien subido
                    echo "<script>window.location='ver.php?pro=$id_p'</script>";
                }
              }
            }
          }
        }else{
          //Si estos datos estan vacios mostramos un mensaje
          echo "Faltaron campos en el paso 4";
        }
      }else{
        //Si estos datos estan vacios mostramos un mensaje
        echo "Faltaron campos en el paso 3";
      }
    }else{
      //Si estos datos estan vacios mostramos un mensaje
      echo "Faltaron campos en el paso 2";
    }

  }else{
    //Si estos datos estan vacios mostramos un mensaje
    echo "Faltaron campos del paso 1";
  }
 }
}else{
  //Si no tiene los datos suficientes para subir un proyecto lo redireccionamos
 echo "<script>window.location='index.php'</script>";
}
?>


<?php

if(isset($_GET['pro'])){
    $id_p = $_GET['pro'];
    $link = "editarVer.php?pro=";
    include("menu.php");
    if(isset($id)){
        $query = mysqli_query($conexion,"SELECT * FROM proyecto WHERE id='$id_p' AND id_user='$id'");
        $num = mysqli_num_rows($query);
        if($num == 1){
        $query = mysqli_query($conexion,"SELECT * FROM proyecto  WHERE id='$id_p'");
        $row = mysqli_fetch_array($query);
        $linkv = $row['video_p'];
        $nombre = $row['nom_proyecto'];
        $pp = $row['p_principal'];
        $cate = $row['categoria'];
        $id_c = $row['id_user'];
        $n_con = $row['n_con'];
        $estado = $row['estado'];
        if($estado == "espera" && !$cargo || $estado == 'ban'){
            echo "<script>window.location='index.php';</script>";
        }else if($estado == "activo" || $cargo == 'admin'){
        $query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE id='$id_c'");
        $row = mysqli_fetch_array($query);
        $nom_c = $row['nombres'];
        $municipio = $row['municipio'];
        $query = mysqli_query($conexion,"SELECT * FROM meta WHERE id_proyecto='$id_p'");
        $row = mysqli_fetch_array($query);
        $dias = $row['dias'];
        $d_actual = $row['dinero_actual'];
        $dinero = $row['dinero'];
        $i = 0;
?>

<br><br><br>
    <div class="container-fluid pigg">
          <div class="row">
              <div class="col-12"><input type="text"name="nombre" class="h1 text-center" value="<?php echo $nombre ?>"></div>
          </div>
          <div class="row">
              <div class="col-12"><input type="text" name="pp" class="h3 text-muted text-center" value="<?php echo $pp ?>"></p></div>
          </div>
          <div class="row mt-5">
              <div class="col-2"></div>
              <div class="col-8"><div class="embed-responsive embed-responsive-16by9">
                <?php echo $link?>
                <iframe width="560" height="315" src="https://www.youtube.com/embed/WLE7hcSgxlM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                </div></div>
              <div class="col-2"></div>
          </div>
          <div class="row mt-5">
            <div class="col-4">
                  <div class="media position-relative">
                          <img src="https://images.pexels.com/photos/210600/pexels-photo-210600.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="img-fluid rounded-circle ml-5 border border-danger ima_crea " alt="Responsive image">
                          <div class="media-body ml-2">
                            <h5 class="mt-0 text-muted">Un proyecto de</h5>
                            <p class="h5"><?php echo $nom_c ?></p>
                            
                          </div>
                        </div>

            </div>
            <div class="col-4">
                  <div class="media position-relative">
                          <img src="https://image.flaticon.com/icons/png/512/103/103461.png" class="img-fluid rounded-circle ml-5 border border-danger ima_cate mt-2" alt="Responsive image">
                          <div class="media-body ml-2">
                            <h5 class="mt-0 text-muted">Categoria</h5>
                            <p class="h5"><?php echo $cate ?></p>
                            
                          </div>
                        </div>
                  
            </div>
            <div class="col-4 float-left">

                  <div class="media position-relative ">
                          <img src="https://image.shutterstock.com/image-vector/red-map-icon-sign-vector-260nw-621041408.jpg" class="img-fluid rounded-circle ml-5 border border-danger ima_cate mt-2" alt="Responsive image">
                          <div class="media-body ml-2">
                            <h5 class="mt-0 text-muted">Creado en</h5>
                            <p class="h5"><?php echo $municipio ?></p>
                            
                          </div>
                        </div>
            </div>
          </div>
          <div class="row mt-3">
              <div class="col-12">
                      <div class="progress progres2">
                              <div class="progress-bar bg-danger progres" role="progressbar" style="width: 55%;" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
              </div>
          </div>
      </div>
      <div class="container-fluid">
          <div class="row mt-2 text-center">
            
              <div class="col-1">
                  <p class="h4 mb-0"><?php echo $dias ?></p>
                  <p class="h5 mt-0 text-muted">Dias</p>
              </div>
                <div class="col-2">
                          <p class="h4 mb-0"><?php echo $n_con?></p>
                          <p class="h5 mt-0 text-muted">Aprotadores</p>
                      </div>
              <div class="col-2">
                      <p class="h4 mb-0"><?php echo "$".$d_actual ?></p>
                      <p class="h5 mt-0 text-muted"><?php echo "$".$dinero ?></p>
                  </div>
                
              
              <div class="col-7 mt-2 pl-5">
                      <button type="button" class="btn btn-primary">FACE</button>
                      <button type="button" class="btn btn-secondary">TWIT</button>
                      <button type="button" class="btn btn-success mr-5">GMAI</button>

                      <button type="button" class="btn btn-outline-danger"> ♥ Añadir</button>
              
                      <button type="button" class="btn btn-danger" onclick="$('#donacion').modal('show')" name="donar">APORTA AL PROYECTO</button>
                      <?php
                        if(isset($id)){
                          $query = mysqli_query($conexion,"SELECT * FROM proyecto WHERE id='$id_p' AND id_user='$id'");
                          $num = mysqli_num_rows($query);
                          if($num == 1){
                            $red = "editarVer.php?pro=".$id_p;
                            ?>
                          <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
                          <button type="submit" class="btn btn-outline-danger" name="editar"> ♥ Editar</button>
                          </form>
                            <?php
                          }
                        }
                      ?>
              </div>
          </div>
        </div>
  <hr>




    <?php
            }
        }else{
        echo "<script>window.location='index.php'</script>";
        }
    }
}
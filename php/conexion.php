<?php 
// Creamos la conexion
$conexion = mysqli_connect('localhost','root','','coink');
if(!$conexion){
// Si la conexion falla redirecion a la pagina error
?>
<script type="text/javascript">
window.location="error.php";
</script>

<?php
}



?>
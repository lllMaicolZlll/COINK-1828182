
<?php
    //**Incluimos la conexión a la base de datos */
    include('php/conexion.php');
    //**Requerimos de las importaciones de las clases de PHPMailer en el espacio de nombres global*/
    //**Estas deben estar en la parte superior de tu script, no dentro de una función*/
    require('php/Exception.php');
    require('php/OAuth.php');
    require('php/PHPMailer.php');
    require('php/SMTP.php');


        //**Se creo una variable llamada "correo", la cual sirve para almacenar los correos que se envian por el metodo "POST"*/
        //**Tenemos el "recuperar_correo" que es la acción de un formulario que se encuentra en "menu.php"*/
        //**Este sirve para traer el correo que se ingresa en el formulario que esta en "menu.php" */
        $correo = $_POST['recuperar_correo'];
        //**Guardamos la respuesta de la consulta en la base de datos */
        $query =mysqli_query($conexion,"SELECT * FROM usuarios WHERE correo='$correo'");
        //**Traemos la consulta que se hizo en la base de datos de la tabla usuarios*/
        $row = mysqli_num_rows($query);
        //**Verificamos si el correo que esta en la base de datos si existe*/
        if($row==1){
            //**Traemos los datos del usuario en la base de datos*/
            $codigo = mysqli_fetch_array($query);
            //**Verifica en donde se encuentra el archivo de recuperar la contraseña, y si el usuario si existe en tal archivo*/
            $ruta = 'localhost/coinkgg/form_contraseña.php?codigo='.$codigo['id'];
            //**Facilita obtener numeros aleatorios con la funcioón "rand", se esta generando 5 números aleatorios*/
            //**que recibe un par de valores, el mínimo y el máximo de los números aleatorios a generar */
            $codigoRecuperar = rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
            //**Guardamos dicho número aleatorio en una tabla de la base de datos */
            $query = mysqli_query($conexion,"SELECT * FROM codigorecuperacion WHERE codigo='$codigoRecuperar'");
            //**Se trae el número que se guardo en la tabla "codigorecuperacion" de la base de datos*/
            $num = mysqli_num_rows($query);
            //**En el condicional if se verifica si el codigo ya esta creado en la tabla "codigorecuperacion", si no el condifional corre normal*/
            if($num > 0){
                //**Este otro condicional verifica si el codigo ya esta creado, si el codigo ya esta creado, se genera otro nuevo*/
                while($num < 1){
                    //**Se genera otro nuevo codigo */
                    $codigoRecuperar = rand(0,9).rand(0,9).rand(0,9).rand(0,9).rand(0,9);
                    //**Se guarda en la tabla de la base de datos "codigorecuperacion" */
                    $query = mysqli_query($conexion,"SELECT * FROM codigorecuperacion WHERE codigo='$codigoRecuperar'");
                    //**Se trae el codigo que se guardo en la tabla "codigorecuperacion"*/
                    $num = mysqli_num_rows($query);
                }
            }
            //**Guardamos la respuesta de la consulta en la base de datos*/
            $query = mysqli_query($conexion,"SELECT * FROM usuarios WHERE correo='$correo'");
            //**Traemos la consulta que se hizo en la base de datos de la tabla usuarios*/
            $row= mysqli_fetch_array($query);
            //**Se trae la id principal del usuario de la tabla "usuarios" de la base de datos" */
            $id_u = $row['id'];
            //**Se trae la el nombre principal del usuario de la tabla "usuarios" de la base de datos" */
            $nombre = $row['nombres'];
            //**Se inserta la id, codigo, nombre, del usuario en la tabla "codigorecuperacion"*/
            //**Se gurda todo esto para ver que usuario quiere cambiar la contraseña*/
            $query = mysqli_query($conexion,"INSERT INTO `codigorecuperacion`(`id`, `id_u`, `codigo`) VALUES (NULL,$id_u,$codigoRecuperar)");
            //**En este condicional traemos los datos del usuario que estan en la tabla de "codigorecuperacion" de la base de datos*/
            if($query){
                //**Se creo una variable llamada "mensaje", es la me se va a mostrar el codigo en el correo del usuario*/
                $mensaje= $nombre."Tu codigo para recuperar la contraseña es ".$codigoRecuperar;
                //** Configuración del servidor */
                //**La creación de instancias y pasar `true` habilita las excepciones */
                $mail = new PHPMailer\PHPMailer\PHPMailer();
                //**Enviar usando SMTP */
                $mail->isSMTP();
                //**Habilita la salida de depuración detallada*/
                $mail->SMTPDebug = 0;
                //**Asignamos a Host el nombre de nuestro servidor smtp */
                $mail->Host = 'smtp.gmail.com';
                //**Establece el puerto por defecto del servidor SMTP */
                $mail->Port = 587;
                //** Habilita el cifrado TLS*/
                $mail->SMTPSecure = 'tls';
                //**Establece la autentificación SMTP */
                $mail->SMTPAuth = true;
                //**	Establece el nombre de usuario SMTP */
                $mail->Username = "Coink8182@gmail.com";
                //**Establece la contraseña del servidor SMTP */
                $mail->Password = "CoinkJME8182";
                //**Destinatarios*/
                //**Establece la dirección de correo de origen del Mensaje*/
                $mail->setFrom('Coink8182@gmail.com', 'COINK');
                //**Indicamos cual es la dirección de destino del correo*/
                $mail->addAddress($correo);
                //**Asignamos asunto y cuerpo del mensaje */
                $mail->Subject = "Cambiar contraseña";
                //**El cuerpo del mensaje lo ponemos en formato html, haciendo que se vea en negrita */
                $mail->Body = $mensaje;
                //**Codificación de caracteres capaz de codificar todos los caracteres posibles */
                $mail->CharSet = 'UTF-8';
                //**Establece el tipo de mensaje a HTML */
                $mail->IsHTML(true);
                //**Se envia el mensaje, si no ha habido problemas */
                if(!$mail->send()){
                    echo "Error al enviar el E-Mail:".$mail->ErrorInfo;

                }else{
                    echo "<script>window.location='form_contraseña.php'</script>";
                }
            }else{
                echo "<script>alert('Error')</script>";
            }
            
        }else{
            echo "<script type='text/javascript'>alert('Error correo no existe');</script>";
            echo "<script>window.location='index.php'</script>";
        }
    
?>

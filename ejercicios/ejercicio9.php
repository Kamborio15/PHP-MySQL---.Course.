<?php
/**
 * PHPMailer simple file upload and send example
 */
$msg = '';
if (array_key_exists('userfile', $_FILES)) {
    // First handle the upload
    // Don't trust provided filename - same goes for MIME types
    // See http://php.net/manual/en/features.file-upload.php#114004 for more thorough upload validation
    $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['userfile']['name']));
    if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
        // Upload handled successfully
        // Now create a message
        // This should be somewhere in your include_path
        require '../PHPMailer/PHPMailerAutoload.php';
        $mail = new PHPMailer;

        // Dirección y nombre introducidas en el formulario
        $userAddress = $_POST['userAddress'];
        $userName = $_POST['userName'];

        // Permite incluir HTML en el email
        $mail->isHTML(true);
        $mensaje = "<p>Name: '".$userName."'</p><p>Address: '".$userAddress."'</p>";
        
        $mail->setFrom('adminallende@example.com', 'Admin Allende');
        $mail->addAddress($userAddress, $userName);
        $mail->Subject = 'Envio de ficheros con PHPMailer';
        $mail->Body = $mensaje;
       
        // Attach the uploaded file
        $mail->addAttachment($uploadfile, $_FILES['userfile']['name']);
        if (!$mail->send()) {
            $msg .= "Error Mail: " . $mail->ErrorInfo;
        } else {
            $msg .= "Mensaje enviado";
        }
    } else {
        $msg .= 'Error al mover el fichero a ' . $uploadfile;
    }
}

$titulo="PHPMailer Upload";
$descripcion="Envio de email con la clase PHPMailer tras rellenar el formulario de datos.";

include('../inc/header2.php');
if (empty($msg)) { ?>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="userAddress">
                Address: <input class="form-control" type="text" name="userAddress" id="userAddress" required>
            </label>
        </div>
        <div class="form-group">
            <label for="userName">
                User Name: <input class="form-control" type="text" name="userName" id="userName" required>
            </label>
        </div>
        <div class="form-group">
            <input type="hidden" name="MAX_FILE_SIZE" value="100000"> Send this file: 
            <input name="userfile" type="file">
        </div>
        <input type="submit" class="btn btn-small" value="Send File">
    </form>
<?php } else {
    echo $msg;
} 

include('../inc/footer2.php'); ?>

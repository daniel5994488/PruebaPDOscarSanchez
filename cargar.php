<?php
include 'Dominio/Destinatario.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'Conexion/Exception.php';
require 'Conexion/PHPMailer.php';
require 'Conexion/SMTP.php';

$mysql = new mysqli("163.178.107.10", "laboratorios", "UCRSA.118", "PDPersona");
$consulta = $mysql->prepare("SELECT id,Nombre,PrimerApellido,SegundoApellido,Cedula,Correo from Destinatarios");
$consulta->execute();
$resultado = $consulta->get_result();
$consulta->close();
$DestinatariosArreglo = [];

while ($fila = $resultado->fetch_array())
{
    $Destinatarios = new Destinatario($fila['id'], $fila['Nombre'], $fila['PrimerApellido'], $fila['SegundoApellido'], $fila['Cedula'], $fila['Correo']);
    array_push($DestinatariosArreglo, $Destinatarios);
}
$data['Destinatarios'] = $DestinatariosArreglo;
foreach ($data['Destinatarios'] as $key => $value)
{
    foreach ($_FILES["archivo"]['tmp_name'] as $key => $tmp_name)
    {
        if ($_FILES["archivo"]["name"][$key])
        {
            $filename = $_FILES["archivo"]["name"][$key];
            $ruta = $_FILES["archivo"]["tmp_name"][$key]; //Obtenemos el nombre original del archivo
            $ext = explode(".", $filename);
            $nombre=$value->getNombre();
            $Apellido1=$value->getPrimerApellido();
            $Apellido2=$value->getSegundoApellido();
            $correo=$value->getCorreo();
            if (strpos($ext[0], $value->getNombre()) !== false && strpos($ext[0], $value->getPrimerApellido()) !== false || strpos($ext[0], $value->getSegundoApellido()) !== false)
            {
            echo "El archivo $filename se envia a $nombre $Apellido1 $Apellido2 correo $correo <br>";
             $mail = new PHPMailer(true);

                try
                {
                    //Server settings
                    $mail->SMTPDebug = 0; // Enable verbose debug output
                    $mail->isSMTP(); // Send using SMTP
                    $mail->Host = 'smtp.gmail.com'; // Set the SMTP server to send through
                    $mail->SMTPAuth = true; // Enable SMTP authentication
                    $mail->Username = 'daniel59948@gmail.com'; // SMTP username
                    $mail->Password = 'silasolfamiredo599'; // SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption;
                    $mail->Port = 587; // TCP port to connect to, use 465 for
                    $mail->setFrom('daniel59948@gmail.com', 'PD');
                    $mail->addAddress($value->getCorreo(), $value->getNombre()); // Add a recipient             //
                    $mail->addAttachment($ruta,$filename);         // Add attachments
                    $mail->isHTML(true);
                    $mail->Body = 'Tu archivo';

                    $mail->send();
                }
                catch(Exception $e)
                {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } //if comprobar que existe el usuario con datos de la Base de datos
            
        } //if existe archivo
        
    } //recorrer arreglo de archivos
    
} //recorrer arrglo de destinatarios


?>
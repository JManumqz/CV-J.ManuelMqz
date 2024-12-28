<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar los datos del formulario
    $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';
    $email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '';
    $message = isset($_POST['message']) ? nl2br(htmlspecialchars($_POST['message'])) : ''; // nl2br convierte los saltos de línea en <br>

    // Validar que todos los campos estén completos
    if (empty($name) || empty($email) || empty($phone) || empty($message)) {
        exit; // Si algún campo está vacío, simplemente salimos sin mostrar ningún mensaje
    }

    // Validar el formato del email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        exit; // Si el email no es válido, salimos sin mostrar ningún mensaje
    }

    // Destinatario
    $to = "atcventas@mmproyectosd.com"; // Tu correo electrónico

    // Asunto del correo
    $subject = "Nuevo mensaje de contacto desde la página web";

    // Cuerpo del mensaje en HTML
    $body = "<h2>Nuevo mensaje de contacto</h2>
             <p><strong>Nombre:</strong> $name</p>
             <p><strong>Email:</strong> $email</p>
             <p><strong>Teléfono:</strong> $phone</p>
             <p><strong>Mensaje:</strong><br> $message</p>";

    // Cabeceras del correo
    $headers = "MIME-Version: 1.0" . "\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8" . "\r\n";
    $headers .= "From: $email" . "\r\n";  // El correo del remitente
    $headers .= "Reply-To: $email" . "\r\n";  // La dirección de respuesta

    // Enviar el correo
    if (mail($to, $subject, $body, $headers)) {
        echo "Hubo un error al enviar el correo. Intenta nuevamente.";
    } else {
        echo "Correo enviado correctamente, en breve nos pondremos en contacto!, espera se rediccionará al sitio web";
    }

    // Esperar 5 segundos y redirigir al inicio
    echo '<script type="text/javascript">
            setTimeout(function(){
                window.location.href = "/";
            }, 5000);
          </script>';
}
?>


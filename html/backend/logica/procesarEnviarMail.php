<?php
$to      = 'emgabo@gmail.com';
$subject = 'Solicitud de Activacion de Usuario';
$message = '<h1>Buenos dias! Usuario<h2> <hr> <p>Se ha creado el usuario bla bla, para seguir usandolo, es necesario que active su cuenta, puede usar este link: <a href=http://192.168.1.15/nsfe/view/activate.php?id=das57ds7d455asd4asd66sad6sa45ds4a>Activar ahora</a>. Si usted no solicito este usuario, le pedimos que ingrese en este link para poder eliminarlo: <a href=http://192.168.1.15/nsfe/view/deactivate.php?id=das57ds7d455asd4asd66sad6sa45ds4a>Eliminar ahora</a></p>';
$headers = 'From: no-reply@ninjastore.uy' . "\r\n" .
    'Reply-To: no-reply@ninjastore.uy' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?> 
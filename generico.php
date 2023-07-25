<?php
// Activamos la visibilidad de errores, esto nos sirve para encontrar errores en la ejecución.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

header('Access-Control-Allow-Origin: *');

// -----------------------------------------------------------------------------
// VERIFICACION DE VARIABLES

// Comprobamos que exista el email donde queremos recibir el formulario.
if (!isset($_POST['destino'])) {
	echo "Debe configurar el email de destino.";
	die();
} else if ($_POST['destino'] == '') {
	echo "El email de destino no puede estar vacio.";
	die();
}

// Comprobamos que exista el asunto
if (!isset($_POST['asunto'])) {
	echo "Debe configurar el asunto.";
	die();
} else if ($_POST['asunto'] == '') {
	echo "El asunto no puede estar vacio.";
	die();
}

// Guardamos el email donde queremos recibir el formulario.
$email_to = $_POST['destino'];

// Asunto
$email_subject = $_POST['asunto'];



// -----------------------------------------------------------------------------
// CONSTRUCCION DEL EMAIL

// Armamos el cuerpo del mensaje
$email_message = "<h2>Consulta por Jubilación y reajuste</h2>";
$email_message .= "<table>";

foreach ($_POST as $key => $value) {
	if ($key != 'asunto' && $key != 'destino') {
		$email_message .= "<tr><td>" . strtoupper($key) . ":</td><td>" . $value . "</td></tr>";
	}
}

$email_message .= "</table>";
$email_message .= "<hr>Enviado desde la web de Jubilate.Reajuste<hr>



// -----------------------------------------------------------------------------
// PREPARAMOS EL ENCABEZADO DEL EMAIL
$email_from = "no-reply@c2350127.ferozo.com"; // Aquí pueden reemplazarlo por un email que exista en el servidor y dominio.
$headers  = "From: " . strip_tags($email_from) . "\r\n";
$headers .= "Reply-To: " . strip_tags($email_from) . "\r\n";
$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=UTF-8\r\n";



// -----------------------------------------------------------------------------
// Ahora se envía el e-mail usando la función mail() de PHP
// La funcion "mail()" devuelve "true" en caso de enviar, y "false" en caso de fallar.
if (mail($email_to, $email_subject, $email_message, $headers)) {
	echo "¡El formulario se ha enviado a <b>" . $email_to . "</b>!";
} else {
	echo "No se pudo enviar el correo a <b>" . $email_to . "</b>!";
}

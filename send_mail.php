<?php
  $name = '';
  $email = '';
  $tel = '';
  $subject = 'Mensaje desde el formulario de contacto';
  $message = '';
  if (isset($_POST['f_name'])) {
    $name = $_POST['f_name'];
  }
  if (isset($_POST['email'])) {
    $email = $_POST['email'];
  }
  if (isset($_POST['message'])) {
    $message = $_POST['message'];
  }
  require dirname(__FILE__) . '/libs/PHPMailer/PHPMailerAutoload.php';
  $mail = new PHPMailer();
  $mail->setFrom($email, $name);
  $mail->setAddress('hola@cholao.co', 'Cholao');
  $mail->isHTML(true);
  $mail->Subject = $subject;
  $body = '<p>Mensaje desde el formulario de contacto:</p>';
  $body .= '<p><strong>Nombre:</strong> ' . $name . '<br />';
  $body .= '<strong>Email:</strong> ' . $email . '<br />';
  $body .= '<strong>Mensaje:</strong> ' . $message . '<br /></p>';

  $response = array(
    'error' => array(
      'title' => 'Error de envio',
      'text' => 'Ha ocurrido un error al tratar de enviar el mensaje'
    )
  );

  if (!$mail->send()) {
    $response = array(
      'error' => array(
        'title' => 'Error de envio',
        'text' => 'Ocurrio el siguiente error: ' . $mail->ErrorInfo
      )
    );
  } else {
    $response = array(
      'success' => array(
        'title' => 'Envio exitoso',
        'text' => 'He recibido con éxito tu mensaje, pronto me pondré en contacto contigo'
      )
    );
  }
  echo json_encode($response);
  exit();
?>

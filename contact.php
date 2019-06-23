<?php
    use PHPMailer\PHPMailer\PHPMailer;
    require './PHPMailer-master/vendor/autoload.php';

    $fromEmail = $_POST['email'];
    $fromName = $_POST['name'];

    $sendToEmail = 'email';
    $sendToName = 'email';
    $subject = 'Nowa wiadomość z formularza kontaktowego. Temat: ' . $_POST['subject'];
    $fields = array('name' => 'Name:', 'email' => 'Email:', 'message' => 'Message:');
    $okMessage = 'Wiadomość została wysyłania - odpowiemy najszybciej jak to możliwe!';
    $errorMessage = 'Wystąpił problem podczas wysyłania wiadomości. Proszę spróbować później';

    error_reporting(E_ALL & ~E_NOTICE);

    try {
        
        if(count($_POST) == 0) throw new \Exception('Form is empty');
        $emailTextHtml .= "<h3>Szczegóły wiadomości:</h3><hr>";
        $emailTextHtml .= "<table>";

        foreach ($_POST as $key => $value) {
            if (isset($fields[$key])) {
                $emailTextHtml .= "<tr><th>$fields[$key]</th><td>$value</td></tr>";
            }
        }
        
        $emailTextHtml .= "</table><hr>";
        $emailTextHtml .= "<p>Miłego dnia!</p>";
        
        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->Host       = 'host';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'username';
        $mail->Password   = 'password';
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        $mail->CharSet = "UTF-8";
        $mail->setLanguage('pl', 'PHPMailer-master/vendor/phpmailer/phpmailer/language/');
        $mail->setFrom($fromEmail, $fromName);
        $mail->addAddress($sendToEmail, $sendToName);
        $mail->addReplyTo($_POST['email'], $_POST['name']);
        $mail->Subject = $subject;
        $mail->Body = $emailTextHtml;
        $mail->isHTML(true);    
        
        if(!$mail->send()) {
            throw new \Exception('Wysłanie wiadomości nie powiodło się. ' . $mail->ErrorInfo);
        }
        
        $responseArray = array('type' => 'success', 'message' => $okMessage);
    } catch (\Exception $e) {
        $responseArray = array('type' => 'danger', 'message' => $e->getMessage());
    }

    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
        $encoded = json_encode($responseArray);
        
        header('Content-Type: application/json');
        echo $encoded;
    } else {
        echo $responseArray['message'];
    }
?>
<?php
$to = "i.am.not.common.jn@gmail.com";
$subject = "Nowa wiadomość z formularza";

$message = "Imię i nazwisko: " . $_POST['name'] . "\n";
$message .= "E-mail: " . $_POST['email'] . "\n";
$message .= "Telefon: " . $_POST['phone'] . "\n";
$message .= "Wiadomość:\n" . $_POST['message'];

$headers = "From: " . $_POST['email'];

if (mail("njeremi0@gmail.com", $subject, $message)) {
  echo "Wiadomość wysłana!";
} else {
  echo "Błąd przy wysyłaniu.";
}
?>
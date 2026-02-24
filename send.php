<?php
// Włączamy raportowanie błędów, żebyś widział co jest nie tak
ini_set('display_errors', 1);
error_reporting(E_ALL);

$to = "kasia.kula@winnicatyniec.pl";
$subject = "Nowa wiadomosc z formularza";

// Pobieranie danych w sposób kompatybilny ze starym PHP
$name    = isset($_POST['name']) ? strip_tags($_POST['name']) : 'Brak';
$email   = isset($_POST['email']) ? $_POST['email'] : '';
$phone   = isset($_POST['phone']) ? strip_tags($_POST['phone']) : 'Brak';
$message_content = isset($_POST['message']) ? strip_tags($_POST['message']) : '';

// Bardzo prosta walidacja e-maila
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    die("Blad: Niepoprawny adres e-mail.");
}

// Budowanie treści
$body = "Imie: $name\n";
$body .= "E-mail: $email\n";
$body .= "Telefon: $phone\n";
$body .= "Wiadomosc:\n$message_content";

// Nagłówki jako zwykły ciąg znaków (string) - najbardziej kompatybilne
$headers = "From: kasia.kula@winnicatyniec.pl" . "\r\n"; // ZMIEŃ NA E-MAIL W TWOJEJ DOMENIE
$headers .= "Reply-To: " . $email . "\r\n";
$headers .= "Content-Type: text/plain; charset=utf-8";

// Wysyłka
if (mail($to, $subject, $body, $headers)) {
    http_response_code(200);
    echo "success";
} else {
    http_response_code(500);
    echo "error";
}
?>
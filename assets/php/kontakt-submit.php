<?php
// assets/php/kontakt-submit.php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

// Nur POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    http_response_code(405);
    echo json_encode([
        'success' => false,
        'error' => 'Methode nicht erlaubt.'
    ]);
    exit;
}

// JSON einlesen
$raw = file_get_contents('php://input');
$data = json_decode($raw, true);

if (!is_array($data)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => 'Ungültige Anfrage.'
    ]);
    exit;
}

// Felder
$name = trim($data['name'] ?? '');
$email = trim($data['email'] ?? '');
$package   = trim($data['package'] ?? '');
$subject = trim($data['subject'] ?? '');
$message = trim($data['message'] ?? '');
$website = trim($data['website'] ?? '');
$formToken = $data['form_token'] ?? '';

// Honeypot
if ($website !== '') {
    echo json_encode(['success' => true]);
    exit;
}

// Token prüfen
if ($formToken !== 'partner_contact_v1') {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => 'Ungültiges Formular-Token.'
    ]);
    exit;
}

// Pflichtfelder
if ($name === '' || $email === '' || $message === '') {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => 'Bitte fülle alle Pflichtfelder aus (Name, E-Mail, Nachricht).'
    ]);
    exit;
}

// E-Mail validieren
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    http_response_code(400);
    echo json_encode([
        'success' => false,
        'error' => 'Bitte gib eine gültige E-Mail-Adresse an.'
    ]);
    exit;
}

// Konfiguration
$recipient = 'business@hundekuchenlive.de';
$subjectPrefix = '[Partneranfrage] ';
$baseSubject = $subject !== '' ? $subject : 'Neue Kontaktanfrage über die Website';
$mailSubject = sprintf('%s%s (von %s)', $subjectPrefix, $baseSubject, $name ?: 'unbekannt');

$dateTime = date('d.m.Y H:i:s');
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unbekannt';

$subjectDisplay = $subject !== '' ? $subject : '(kein Betreff angegeben)';
$packageDisplay = $package !== '' ? $package : 'noch nicht ausgewählt';

$mailBody = <<<TXT
Neue Partneranfrage über das Kontaktformular

Kontakt:
- Name:           {$name}
- E-Mail:         {$email}
- Betreff:        {$subjectDisplay}
- Gewünschtes Paket: {$packageDisplay}

Nachricht:
{$message}
TXT;


// PHPMailer + SMTP
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../../config.php';
require __DIR__ . '/../../PHPMailer/PHPMailer-7.0.2/src/Exception.php';
require __DIR__ . '/../../PHPMailer/PHPMailer-7.0.2/src/PHPMailer.php';
require __DIR__ . '/../../PHPMailer/PHPMailer-7.0.2/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = SMTP_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = SMTP_USER;
    $mail->Password = SMTP_PASS;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = SMTP_PORT;
    $mail->CharSet = 'UTF-8';
    $mail->Encoding = 'base64';

    // Meta nur in technischen Headern
    $mail->addCustomHeader('X-Form-IP', $ip);
    $mail->addCustomHeader('X-Form-Submitted-At', $dateTime);

    $mail->setFrom('no-reply@hundekuchenlive.de', 'hundekuchenlive Website');
    $mail->addAddress($recipient);
    $mail->addReplyTo($email, $name);
    $mail->addBCC('hundekuchenlive@impressum4u.de');

    $mail->isHTML(false);
    $mail->Subject = $mailSubject;
    $mail->Body = $mailBody;

    $result = $mail->send();

    if ($result) {
        error_log('Kontaktformular: Mail erfolgreich an SMTP übergeben.');
        echo json_encode([
            'success' => true,
            'message' => 'Anfrage erfolgreich gesendet.'
        ]);
    } else {
        error_log('Kontaktformular: send() returned false: ' . $mail->ErrorInfo);
        http_response_code(500);
        echo json_encode([
            'success' => false,
            'error' => 'Beim Versenden der Mail ist ein Fehler aufgetreten.'
        ]);
    }
} catch (Exception $e) {
    error_log('Kontaktformular: SMTP-Fehler: ' . $mail->ErrorInfo);

    http_response_code(500);
    echo json_encode([
        'success' => false,
        'error' => 'Beim Versenden der Mail ist ein Fehler aufgetreten.'
    ]);
}
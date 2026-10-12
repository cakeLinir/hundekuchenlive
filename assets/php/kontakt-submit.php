<?php
// assets/php/kontakt-submit.php
declare(strict_types=1);

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

header('Content-Type: application/json; charset=utf-8');

function respond(array $payload, int $status = 200): void
{
    http_response_code($status);
    echo json_encode($payload, JSON_UNESCAPED_UNICODE);
    exit;
}

function read_field(array $data, string $key): string
{
    $value = $data[$key] ?? '';
    return is_string($value) ? trim($value) : '';
}

// Nur POST
if (($_SERVER['REQUEST_METHOD'] ?? '') !== 'POST') {
    header('Allow: POST');
    respond(['success' => false, 'error' => 'Methode nicht erlaubt.'], 405);
}

// JSON einlesen
$raw = file_get_contents('php://input');
$data = json_decode((string) $raw, true);

if (!is_array($data)) {
    respond(['success' => false, 'error' => 'Ungültige Anfrage.'], 400);
}

// Felder (Zeilenumbrüche in Name/Betreff entfernen)
$name = (string) preg_replace('/[\r\n]+/', ' ', read_field($data, 'name'));
$email = read_field($data, 'email');
$package = (string) preg_replace('/[\r\n]+/', ' ', read_field($data, 'package'));
$subject = (string) preg_replace('/[\r\n]+/', ' ', read_field($data, 'subject'));
$message = read_field($data, 'message');
$website = read_field($data, 'website');
$formToken = read_field($data, 'form_token');

// Honeypot: Bots bekommen "Erfolg", es wird nichts gesendet
if ($website !== '') {
    respond(['success' => true]);
}

// Längen begrenzen (Schutz vor Mailbomben/Missbrauch)
$limits = [
    'name' => [$name, 150],
    'email' => [$email, 200],
    'subject' => [$subject, 200],
    'package' => [$package, 100],
    'message' => [$message, 5000],
];

foreach ($limits as $label => [$value, $max]) {
    if (mb_strlen($value, 'UTF-8') > $max) {
        respond([
            'success' => false,
            'error' => "Das Feld \"$label\" ist zu lang (max. $max Zeichen).",
        ], 400);
    }
}

// CSRF-Token prüfen
require_once __DIR__ . '/csrf.php';

if (!csrf_verify($formToken)) {
    respond([
        'success' => false,
        'error' => 'Sicherheitsprüfung fehlgeschlagen. Bitte lade die Seite neu und versuche es erneut.',
    ], 403);
}

// Pflichtfelder
if ($name === '' || $email === '' || $message === '') {
    respond([
        'success' => false,
        'error' => 'Bitte fülle alle Pflichtfelder aus (Name, E-Mail, Nachricht).',
    ], 400);
}

// E-Mail validieren
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    respond(['success' => false, 'error' => 'Bitte gib eine gültige E-Mail-Adresse an.'], 400);
}

// Rate-Limiting erst jetzt, damit Korrekturen von Tippfehlern nicht blockiert werden
require_once __DIR__ . '/rate-limit.php';

if (!rate_limit_check(rate_limit_client_ip(), 'contact_form')) {
    header('Retry-After: 60');
    respond([
        'success' => false,
        'error' => 'Zu viele Anfragen. Bitte warte kurz und versuche es später erneut.',
    ], 429);
}

// Mail zusammenstellen
$recipient = 'business@hundekuchenlive.de';
$baseSubject = $subject !== '' ? $subject : 'Neue Kontaktanfrage über die Website';
$mailSubject = sprintf('[Partneranfrage] %s (von %s)', $baseSubject, $name);

$dateTime = date('d.m.Y H:i:s');
$ip = $_SERVER['REMOTE_ADDR'] ?? 'unbekannt';

$subjectDisplay = $subject !== '' ? $subject : '(kein Betreff angegeben)';
$packageDisplay = $package !== '' ? $package : 'noch nicht ausgewählt';

$mailBody = <<<TXT
Neue Partneranfrage über das Kontaktformular

Kontakt:
- Name:              {$name}
- E-Mail:            {$email}
- Betreff:           {$subjectDisplay}
- Gewünschtes Paket: {$packageDisplay}

Nachricht:
{$message}
TXT;

// PHPMailer + SMTP
try {
    require __DIR__ . '/../../config.php';
    require_once __DIR__ . '/../../PHPMailer/PHPMailer-7.0.2/src/Exception.php';
    require_once __DIR__ . '/../../PHPMailer/PHPMailer-7.0.2/src/PHPMailer.php';
    require_once __DIR__ . '/../../PHPMailer/PHPMailer-7.0.2/src/SMTP.php';

    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = SMTP_HOST;
    $mail->SMTPAuth = true;
    $mail->Username = SMTP_USER;
    $mail->Password = SMTP_PASS;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = SMTP_PORT;
    $mail->Timeout = 15;
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

    $mail->send();

    respond(['success' => true, 'message' => 'Anfrage erfolgreich gesendet.']);
} catch (Throwable $e) {
    error_log('Kontaktformular-Fehler: ' . $e->getMessage());
    respond([
        'success' => false,
        'error' => 'Beim Versenden der Mail ist ein Fehler aufgetreten.',
    ], 500);
}

<?php
header('Content-Type: application/json');

$name  = $_POST['Name']  ?? '';
$email = $_POST['Email'] ?? '';
$ptf   = $_POST['Ptf']   ?? '';
$brw   = $_POST['Brw']   ?? '';
$os    = $_POST['Os']    ?? '';

$name  = trim(str_replace(["\r", "\n", ","], ' ', $name));
$email = trim(str_replace(["\r", "\n", ","], ' ', $email));
$ptf   = trim(str_replace(["\r", "\n", ","], ' ', $ptf));
$brw   = trim(str_replace(["\r", "\n", ","], ' ', $brw));
$os    = trim(str_replace(["\r", "\n", ","], ' ', $os));

function getUserIP() {
    if (isset($_SERVER["HTTP_CF_CONNECTING_IP"])) {
        return $_SERVER["HTTP_CF_CONNECTING_IP"];
    }
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $parts = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        return trim($parts[0]);
    }
    return $_SERVER['REMOTE_ADDR'] ?? 'Unknown';
}

$ip = getUserIP();
$time = date('Y-m-d H:i:s');

$logFile = '../../logs/presentation_submissions.txt';
$logEntry = "[$time] IP: $ip | Name: $name | Email: $email | OS: $os | Browser: $brw\n";
@file_put_contents($logFile, $logEntry, FILE_APPEND | LOCK_EX);

echo json_encode([
    'status' => 'success',
    'message' => 'Attendance verified successfully'
]);

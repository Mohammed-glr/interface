<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

session_start();

$input = json_decode(file_get_contents('php://input'), true);

$naam = $input['name'] ?? '';
$email = $input['email'] ?? '';
$straat = $input['street'] ?? '';
$huisnummer = $input['huisnummer'] ?? '';
$stad = $input['city'] ?? '';
$postcode = $input['zipcode'] ?? '';


$naam = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$straat = $_POST['street'] ?? '';
$huisnummer = $_POST['huisnummer'] ?? '';
$stad = $_POST['city'] ?? '';
$postcode = $_POST['zipcode'] ?? '';
$cart = isset($_POST['cart']) ? json_decode($_POST['cart'], true) : [];

$errors = [];

if (empty($naam) || empty($email) || empty($straat) || empty($huisnummer) || empty($stad) || empty($postcode)) {
    $errors[] = "Vul alle velden in.";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "Ongeldig e-mailadres.";
}
if (!preg_match("/^[0-9]{4}\s?[A-Z]{2}$/", $postcode)) {
    $errors[] = "Ongeldige postcode.";
}
if (!preg_match("/^[0-9]+$/", $huisnummer) || !is_numeric($huisnummer)) {
    $errors[] = "Ongeldig huisnummer.";
}

if (empty($errors)) {
    $_SESSION['form_data'] = [
        'name' => $naam,
        'email' => $email,
        'street' => $straat,
        'huisnummer' => $huisnummer,
        'city' => $stad,
        'zipcode' => $postcode
    ];

    $orderDetails = [
        'name' => $naam,
        'email' => $email,
        'street' => $straat,
        'huisnummer' => $huisnummer,
        'city' => $stad,
        'zipcode' => $postcode,
        'cart' => $cart
    ];

    $filePath = '../orders/order_' . time() . '.txt';
    file_put_contents($filePath, json_encode($orderDetails, JSON_PRETTY_PRINT));

    $_SESSION['order_file'] = $filePath;
    header('Location: bestel_verwerk_view.php');
    exit;
} else {
    print "<h2>Foutmelding</h2><ul>";
    foreach ($errors as $error) {
        print "<li>$error</li>";
    }
    print "</ul><a href='../pages/bestel.php'>Ga terug naar de bestelpagina</a>";
    exit;
}
?>
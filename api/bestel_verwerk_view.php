<?php
session_start();
$orderFilePath = $_SESSION['order_file'] ?? null;
$orderDetails = $orderFilePath && file_exists($orderFilePath) ? json_decode(file_get_contents($orderFilePath), true) : [];
$naam = $orderDetails['name'] ?? 'Onbekend';
$email = $orderDetails['email'] ?? 'Onbekend';
$straat = $orderDetails['street'] ?? 'Onbekend';
$huisnummer = $orderDetails['huisnummer'] ?? 'Onbekend';
$stad = $orderDetails['city'] ?? 'Onbekend';
$postcode = $orderDetails['zipcode'] ?? 'Onbekend';
$cart = $orderDetails['cart'] ?? [];
$totalPrice = 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bestelling Verwerkt</title>
    <link rel="stylesheet" href="../styles/globals.css">
    <link rel="stylesheet" href="../styles/bestel.css">
</head>
<body>
    <div class="container">
        <h1>Bedankt voor uw bestelling!</h1>
        <p>Uw bestelling is succesvol verwerkt.</p>
        
        <h2>Bestelgegevens:</h2>
        <ul>
            <li><strong>Naam:</strong> <?= htmlspecialchars($naam); ?></li>
            <li><strong>E-mailadres:</strong> <?= htmlspecialchars($email); ?></li>
            <li><strong>Straat:</strong> <?= htmlspecialchars($straat); ?></li>
            <li><strong>Huisnummer:</strong> <?= htmlspecialchars($huisnummer); ?></li>
            <li><strong>Stad:</strong> <?= htmlspecialchars($stad); ?></li>
            <li><strong>Postcode:</strong> <?= htmlspecialchars($postcode); ?></li>
        </ul>

        <div class="order-summary">
            <h2>Bestelde artikelen:</h2>
            <?php if (empty($cart)): ?>
                <p>Geen artikelen in de bestelling.</p>
            <?php else: ?>
                <div class="order-items">
                    <?php foreach ($cart as $item): ?>
                        <?php $totalPrice += $item['price']; ?>
                        <div class="order-item">
                            <img src="<?= htmlspecialchars($item['image']); ?>" alt="<?= htmlspecialchars($item['name']); ?>">
                            <p><strong><?= htmlspecialchars($item['name']); ?></strong></p>
                            <p>€<?= number_format($item['price'], 2, ',', '.'); ?></p>
                        </div>
                    <?php endforeach; ?>
                </div>
                <p class="total-price">Totaal: €<?= number_format($totalPrice, 2, ',', '.'); ?></p>
            <?php endif; ?>
        </div>

        <button>
            <a href="../index.html" class="button">Terug naar Home</a>
        </button>
        <button>
            <a href="../pages/overZicht.html" class="button">Terug naar Overzicht</a>
        </button>
    </div>
</body>
</html>
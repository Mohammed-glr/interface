<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winkelmand</title>
    <link rel="stylesheet" href="../styles/bestel.css">
    <link rel="stylesheet" href="../styles/navbar.css">
    <link rel="stylesheet" href="../styles/globals.css">
    <script src="../scripts/hamburger.js" defer></script>
    <script src="../scripts/bestel.js" defer></script>
</head>
<body>
    <div class="naVcontainer">
        <nav>
            <div class="hamburger" id="hamburger-icon">
                &#9776; 
            </div>
            <ul id="navbar" class="navbar">
                <li><a href="../index.php">Home</a></li>
                <li><a href="./about.html">Over Ons</a></li>
                <li><a href="./overZicht.html">Overzicht</a></li>
            </ul>
        </nav>
    </div>
    
    <section class="cart-page">
        <h1>Winkelmand</h1>
        
        <div id="cart-items"></div>

        <div class="cart-total">
            <p>Totaal: €<span id="total-price">0.00</span></p>
        </div>
        
        <?php
        session_start();
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        ?>

        <form id="order-form" method="POST" action="../backendBestel/bestel_verwerk.php">
            <h2>Bestellen</h2>

            <input type="hidden" name="csrf_token" value="<?php echo $_SESSION['csrf_token']; ?>">
            <input type="hidden" name="cart" id="cart-data">

            <div class="form-field">
                <label for="name">Naam</label>
                <input type="text" id="name" name="name" required placeholder="Vul je naam in" />
            </div>

            <div class="form-field">
                <label for="email">E-mailadres</label>
                <input type="email" id="email" name="email" required placeholder="Vul je e-mail in" />
            </div>

            <div class="form-field">
                <label for="street">Straat</label>
                <input type="text" id="street" name="street" required placeholder="Vul je straat in" />
            </div>

            <div class="form-field">
                <label for="housenumber">Huisnummer</label>
                <input type="text" id="housenumber" name="huisnummer" required placeholder="Vul je huisnummer in" />
            </div>

            <div class="form-field">
                <label for="city">Stad</label>
                <input type="text" id="city" name="city" required placeholder="Vul je stad in" />
            </div>

            <div class="form-field">
                <label for="zipcode">Postcode</label>
                <input type="text" id="zipcode" name="zipcode" required pattern="^\d{4}\s?[A-Za-z]{2}$" placeholder="Vul je postcode in (bijv. 1234 AB)" />
                <small>Formaat: 1234 AB</small>
            </div>

            <div class="form-field">
                <button type="submit" id="checkout-button">Afrekenen</button>
            </div>
        </form>
    </section>

    <script>
        document.getElementById('order-form').addEventListener('submit', function() {
            document.getElementById('cart-data').value = localStorage.getItem('cart');
        });
    </script>
</body>
</html>

<?php 
session_start();

// Vérifier si le panier existe dans la session
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])):
    foreach ($_SESSION['cart'] as $item):
        // Assurez-vous que le prix est un nombre à virgule flottante et que la quantité est un entier
        $price = (float)$item['price']; 
        $quantity = (int)$item['quantity']; 
        $totalPrice = $price * $quantity; // Calcul du prix total

        // Affichage de l'élément dans le panier
?>
    <p>Produit: <?= htmlspecialchars($item['name']); ?>, Quantité: <?= $quantity; ?>, Prix total: DT<?= number_format($totalPrice, 2, ',', ' '); ?></p>
<?php endforeach; ?>
    <a href="checkout.php" class="checkout-button">Passer à la commande</a>
<?php else: ?>
    <p>Votre panier est vide.</p>
<?php endif; ?> 



<?php 
/*
session_start();

// Vérifier si le panier existe dans la session
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])):
    foreach ($_SESSION['cart'] as $item):
?>
    <p>Produit: <?= $item['name']; ?>, Quantité: <?= $item['quantity']; ?>, Prix total: DT<?= number_format($item['price'] * $item['quantity'], 2); ?></p>
<?php endforeach; ?>
    <a href="checkout.php" class="checkout-button">Passer à la commande</a>
<?php else: ?>
    <p>Votre panier est vide.</p>
<?php endif; */
?>





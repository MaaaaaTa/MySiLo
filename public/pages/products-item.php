<?php
require_once '../config/db.php';
require_once '../includes/header.php';

$product = null;

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM products WHERE id = $id";
    $result = $conn->query($sql);
    if ($result) {
        $product = $result->fetch_assoc();
    }
}
?>

<a href="../catalog.php">Назад в каталог</a>
<hr>

<?php if ($product): ?>
    <h1>Карточка товара: <?php echo htmlspecialchars($product['title']); ?></h1>
    <p><b>ID товара:</b> <?php echo $product['id']; ?></p>
    <p><b>Название:</b> <?php echo htmlspecialchars($product['title']); ?></p>
    <p><b>Цена:</b> <?php echo number_format($product['price'], 2, '.', ' '); ?> руб.</p>
<?php else: ?>
    <p style="color: red;">Товар не найден!</p>
<?php endif; ?>

<?php 
require_once '../includes/footer.php';
?>

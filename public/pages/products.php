

<?php
try {
    $stmt = $pdo->query("SELECT id, title, price FROM products ORDER BY id ASC");
    $products = $stmt->fetchAll();

    if (!empty($products)) {
        echo '<table>';
        echo '<thead><tr><th>Идентификатор (ID)</th><th>Наименование товара</th><th>Стоимость (руб.)</th></tr></thead>';
        echo '<tbody>';
        foreach ($products as $product) {
            echo '<tr>';
            // Применяем htmlspecialchars для предотвращения XSS-уязвимостей при выводе данных
            echo '<td>' . htmlspecialchars($product['id']) . '</td>';
            echo '<td>' . htmlspecialchars($product['title']) . '</td>';
            echo '<td>' . htmlspecialchars($product['price']) . ' руб.</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<p>В таблице "products" базы данных пока нет записей. Добавьте их через phpMyAdmin.</p>';
    }
} catch (PDOException $e) {
    echo '<div class="error-box">';
    echo '<strong>Ошибка выполнения SQL-запроса:</strong> ' . htmlspecialchars($e->getMessage());
    echo '</div>';
}
?>

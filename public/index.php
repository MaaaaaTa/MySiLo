<?php
$host = 'MySQL-8.0';
$users = 'root';
$password = '';
$database = 'lab_db';

$mysqli = new mysqli($host, $users, $password, $database);
if ($mysqli->connect_error) {
    die('Ошибка подключения: ' . $mysqli->connect_error);
}
$mysqli->set_charset('utf8mb4');

$sql = "SELECT id, name, email FROM users";
$result = $mysqli->query($sql);

echo "<h1>Список пользователей</h1>";
if ($result->num_rows > 0) {
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>Имя</th><th>Email</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Нет данных.";
}
// --- ДОБАВИТЬ ЭТОТ БЛОК ДЛЯ ВЫВОДА ТОВАРОВ ---
$sql_products = "SELECT id, title, price FROM products";
$result_products = $mysqli->query($sql_products);

echo "<h1>Список товаров</h1>";
if ($result_products && $result_products->num_rows > 0) {
    echo "<table border='1' cellpadding='5'>";
    echo "<tr><th>ID</th><th>Название</th><th>Цена</th></tr>";
    while ($row_products = $result_products->fetch_assoc()) {
        echo "<tr>";
         echo "<td>" . htmlspecialchars($row_products['id']) . "</td>";
        echo "<td>" . htmlspecialchars($row_products['title']) . "</td>";
        echo "<td>" . htmlspecialchars($row_products['price']) . " руб.</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Нет данных о товарах.";
}




$mysqli->close();
?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require_once __DIR__ . '/config/db.php';
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$page = basename($page);
$page_file = __DIR__ . "/pages/{$page}.php";
include_once __DIR__ . '/includes/header.php';
if (file_exists($page_file)) {
    include $page_file;
} else {
    header("HTTP/1.0 404 Not Found");
    echo '<div class="error-box">';
    echo '<h2>Ошибка 404: Страница не найдена</h2>';
    echo '<p>Запрошенный вами раздел меню или внутренний модуль отсутствует на данном сервере.</p>';
    echo '</div>';
}
include_once __DIR__ . '/includes/footer.php';
?>
<?php
$servername = "arschool.mysql.ukraine.com.ua:3306";
$username = "arschool_lombobomberg";
$password = "8a)kN2~4rA";
$dbname = "arschool_lombobomberg"; // Замініть на назву вашої бази даних

// Створення з'єднання
$conn = new mysqli($servername, $username, $password, $dbname);

// Перевірка з'єднання
if ($conn->connect_error) {
    die("Помилка з'єднання: " . $conn->connect_error);
}

// Отримання тексту
$sql = "SELECT section, text_content FROM site_text";
$result = $conn->query($sql);

$texts = []; // Ініціалізація змінної

if ($result->num_rows > 0) {
    // Виведення даних
    while($row = $result->fetch_assoc()) {
        $texts[$row['section']] = $row['text_content'];
    }
} else {
    echo "0 результатів";
}

$conn->close();
?>
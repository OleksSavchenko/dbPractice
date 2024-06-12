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

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $section = $_POST['section'];
    $text_content = $_POST['text_content'];

    $stmt = $conn->prepare("UPDATE site_text SET text_content = ? WHERE section = ?");
    $stmt->bind_param("ss", $text_content, $section);

    if ($stmt->execute() === TRUE) {
        echo "Запис успішно оновлений";
    } else {
        echo "Помилка оновлення запису: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

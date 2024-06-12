<?php
session_start(); // Стартуємо сесію

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Перевірка чи отримали дані з форми
    if(isset($_POST['email']) && isset($_POST['password'])) {
        // Отримуємо дані з форми
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Підключення до бази даних
        $servername = "arschool.mysql.ukraine.com.ua:3306";
        $username = "arschool_lombobomberg";
        $password_db = "8a)kN2~4rA";
        $dbname = "arschool_lombobomberg";

        $conn = new mysqli($servername, $username, $password_db, $dbname);

        // Перевірка з'єднання
        if ($conn->connect_error) {
            die("Помилка з'єднання: " . $conn->connect_error);
        }

        // Захист від SQL-ін'єкцій
        $email = $conn->real_escape_string($email);
        $password = $conn->real_escape_string($password);

        // Запит до бази даних
        $sql = "SELECT id FROM Users WHERE username = '$email' AND password = '$password'";
        $result = $conn->query($sql);

        // Перевірка чи знайдено результат
        if ($result->num_rows > 0) {
            // Отримуємо UserID
            $row = $result->fetch_assoc();
            $userID = $row['id'];

            // Зберігаємо UserID в сесії
            $_SESSION['id'] = $userID;

            // Виведення UserID перед перенаправленням
            echo "Ваш UserID: " . $userID . ". Ви будете перенаправлені на іншу сторінку через 5 секунд.";

            // Перенаправляємо на index1.php через 5 секунд
            header("refresh:5;url=admin.php");
            exit();
        } else {
            echo "Неправильний email або пароль.";
        }

        // Закриття з'єднання з базою даних
        $conn->close();
    } else {
        echo "Не всі дані були введені.";
    }
}
?>
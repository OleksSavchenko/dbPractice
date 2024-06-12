<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редагування тексту</title>
    <link rel="stylesheet" href="styles2.css">
</head>
<body>

<?php
include 'fetch_text.php';
if (!isset($texts) || !is_array($texts)) {
    $texts = [];
}
?>

<h1>Редагування тексту</h1>

<form id="update-form" action="update_text.php" method="post">
    <div class="form-group">
        <label for="section">Секція:</label>
        <select id="section" name="section" onchange="updateTextContent()">
            <?php foreach ($texts as $section => $content): ?>
                <option value="<?php echo htmlspecialchars($section); ?>"><?php echo htmlspecialchars($section); ?></option>
            <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="text_content">Текст:</label>
        <textarea id="text_content" name="text_content" rows="5"><?php echo htmlspecialchars(reset($texts)); ?></textarea>
    </div>
    <button type="submit">Оновити</button>
    <a href="index.php">Вернутися на сайт</a>
</form>

<script>
    function updateTextContent() {
        var section = document.getElementById('section').value;
        var textContent = <?php echo json_encode($texts); ?>;
        document.getElementById('text_content').value = textContent[section] || '';
    }

    // Додано JavaScript для переадресації після натискання кнопки "Оновити"
    document.getElementById('update-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Запобігаємо стандартній відправці форми

        var formData = new FormData(this); // Отримуємо дані форми
        var xhr = new XMLHttpRequest(); // Створюємо новий об'єкт XMLHttpRequest

        xhr.open('POST', this.action, true); // Налаштовуємо запит POST на URL форми

        xhr.onload = function() {
            if (xhr.status === 200) {
                // Переадресація на іншу сторінку після успішної відправки форми
                window.location.replace("admin.php");
            } else {
                alert('Сталася помилка при оновленні тексту. Спробуйте ще раз.');
            }
        };

        xhr.send(formData); // Відправляємо дані форми за допомогою AJAX
    });
</script>

</body>
</html>

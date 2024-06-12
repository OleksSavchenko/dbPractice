<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Виробник зернових культур</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Стили для модального окна */
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            text-align: center;
            border-radius: 8px;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<?php include 'fetch_text.php'; ?>

<header>
    <div class="container">
        <nav>
            <ul>
                <li><a href="#about">Про нас</a></li>
                <li><a href="#partnership">Співпраця</a></li>
                <li><a href="#contact">Зв'язатися з нами</a></li>
                <li><a href="form.html">Вхід</a></li>
            </ul>
        </nav>
    </div>
</header>

<section class="hero">
    <div class="container">
        <div class="text">
            <h1><?php echo $texts['hero_title']; ?></h1>
            <a href="#btn-more" class="button"><?php echo $texts['hero_button']; ?></a>
        </div>
        <img class="image" src="./asset/трактор.jpg" alt="Валовий збір зернових культур">
    </div>
</section>

<section class="about">
    <div class="container"><a name="about"></a><a name="btn-more"></a>
        <div class="image">
            <img src="./asset/пшениця.jpg" alt="Фото зерна">
        </div>
        <div class="text">
            <h2><?php echo $texts['about_title']; ?></h2>
            <p><?php echo $texts['about_text']; ?></p>
            <div class="logo-and-text">
                <img class="logo" src="./asset/лого.png" alt="Логотип">
                <p><?php echo $texts['about_safe_storage']; ?></p>
            </div>
        </div>
    </div>
</section>

<a name="partnership"></a>
<section class="partnership">
    <div class="container">
        <div class="text">
            <h2><?php echo $texts['partnership_title']; ?></h2>
            <h3><?php echo $texts['partnership_subtitle']; ?></h3>
            <ul>
                <li><?php echo $texts['partnership_benefit_quality']; ?></li>
                <li><?php echo $texts['partnership_benefit_prices']; ?></li>
                <li><?php echo $texts['partnership_benefit_range']; ?></li>
                <li><?php echo $texts['partnership_benefit_reliability']; ?></li>
                <li><?php echo $texts['partnership_benefit_flexibility']; ?></li>
            </ul>
            <a href="#btn" class="button"><?php echo $texts['partnership_button']; ?></a>
        </div>
    </div>
</section>

<section class="contact">
    <div class="container">
        <a name="contact"></a><a name="btn"></a>
        <p><?php echo $texts['contact_intro']; ?></p>
        <p><?php echo $texts['contact_offer']; ?></p>
        <h2><?php echo $texts['contact_title']; ?></h2>
        <form id="contact-form" action="send_email.php" method="post">
            <div class="form-group">
                <label for="name"><?php echo $texts['contact_name_label']; ?></label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="reply_email"><?php echo $texts['contact_email_label']; ?></label>
                <input type="email" id="reply_email" name="reply_email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="message"><?php echo $texts['contact_message_label']; ?></label>
                <textarea id="message" name="message" class="form-control" rows="5" required></textarea>
            </div>
            <button type="submit" class="button"><?php echo $texts['contact_submit_button']; ?></button>
        </form>
    </div>
</section>

<!-- Модальне вікно -->
<div id="successModal" class="modal">
    <div class="modal-content">
        <span class="close">&times;</span>
        <p><?php echo $texts['modal_success']; ?></p>
    </div>
</div>

<script>
    // JavaScript для обробки форми і показу модального вікна
    document.getElementById('contact-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Запобігає перезавантаженню сторінки
        var formData = new FormData(this);

        // Відправка форми через AJAX
        var xhr = new XMLHttpRequest();
        xhr.open('POST', this.action, true);
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Показати модальне вікно при успішній відправці
                var modal = document.getElementById('successModal');
                modal.style.display = 'flex';

                // Закриття модального вікна при натисканні на хрестик
                var closeBtn = document.getElementsByClassName('close')[0];
                closeBtn.onclick = function() {
                    modal.style.display = 'none';
                }

                // Закриття модального вікна при натисканні поза ним
                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.style.display = 'none';
                    }
                }

                // Очистити форму
                document.getElementById('contact-form').reset();
            } else {
                alert('Сталася помилка при надсиланні повідомлення. Спробуйте ще раз.');
            }
        };
        xhr.send(formData);
    });
</script>

</body>
</html>
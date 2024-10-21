<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Мальцев Никита Олегович">
    <meta name="discription" content="Изучение php">
    <meta name="keywords" content="php">
    <link rel="stylesheet" href="./laba4.css">
    <title>Лабораторные работы</title>
</head>

<body>
    <div class="container">
        <div class="header">
            <p class="header__text">Лабораторная работа №4</p>
            <a href="../index.php" class="header__link"> На главную</a>
        </div>

        <div class="main">
            <h1 class="main__head">Вариант 12</h1>

            <form method="POST" action="">
                <h2 class="main__head__small">Задание 1:</h2>
                <p class="main__text">Даны три целых числа: A, B, C. Проверить истинность высказывания:
                    «Каждое из чисел A, B, C положительное».</p>
                <input class="main__input__one" type="numeric" name="number1_a" placeholder="Введите значение A"
                    required />
                <input class="main__input__one" type="numeric" name="number1_b" placeholder="Введите значение B"
                    required />
                <input class="main__input__one" type="numeric" name="number1_c" placeholder="Введите значение C"
                    required />
                <button class="main__button" name="one">Решить задачу</button>
            </form>

            <?php
            if (isset($_POST['one'])) {

                $number1_a = $_POST["number1_a"];
                $number1_b = $_POST["number1_a"];
                $number1_c = $_POST["number1_b"];

                if (is_numeric($number1_a) && is_numeric($number1_b) && is_numeric($number1_c)) {
                    if ($number1_a > 0 && $number1_b > 0 && $number1_c > 0) {
                        echo "<p class='main__text'>TRUE</p>";
                    } else {
                        echo "<p class='main__text'>FALSE</p>";
                    }
                } else {
                    echo "<p class='main__text'>Введите числовое значение</p>";
                }
            }
            ?>

            <form method="POST" action="">
                <h2 class="main__head__small">Задание 2:</h2>
                <p class="main__text">Даны три числа. Найти наименьшее из них.</p>
                <input class="main__input__one" type="numeric" name="number2_a" placeholder="Введите значение A"
                    required />
                <input class="main__input__one" type="numeric" name="number2_b" placeholder="Введите значение B"
                    required />
                <input class="main__input__one" type="numeric" name="number2_c" placeholder="Введите значение C"
                    required />
                <button class="main__button" name="two">Решить задачу</button>
            </form>

            <?php
            if (isset($_POST['two'])) {

                $number2_a = $_POST["number2_a"];
                $number2_b = $_POST["number2_b"];
                $number2_c = $_POST["number2_c"];

                if (is_numeric($number2_a) && is_numeric($number2_b) && is_numeric($number2_c)) {

                    echo "<p class='main__text'>" . "Минимальное число  " . min($number2_a, $number2_b, $number2_c), "</p>";

                } else {
                    echo "<p class='main__text'>Введите числовое значение</p>";
                }
            }
            ?>

            <form method="POST" action="">
                <h2 class="main__head__small">Задание 3:</h2>
                <p class="main__text">Вычислить значение функции y=f(x) при произвольных значениях x.</p>
                <input class="main__input__one" type="numeric" name="number3_x" placeholder="Введите значение X"
                    required />

                <button class="main__button" name="three">Решить задачу</button>
            </form>

            <?php
            if (isset($_POST['three'])) {

                $number3_x = $_POST["number3_x"];


                if (is_numeric($number3_x)) {

                    if ((-2 < $number3_x) && ($number3_x <= 0)) {
                        $number3_y = 1 / (1 + 2.1 * abs($number3_x));

                    } elseif ($number3_x <= -2) {
                        $number3_y = cos(0.7 * $number3_x ** 2) + 0.5 * $number3_x;
                    } elseif ($number3_x > 0) {
                        $number3_y = sqrt(1 + (2.72**(2.1*$number3_x)));
                    }

                } else {
                    echo "<p class='main__text'>Введите числовое значение</p>";
                }
                echo "<p class='main__text'>" . "y = " . $number3_y, "</p>";
            }
            ?>

            <form method="POST" action="">
                <h2 class="main__head__small">Задание 4:</h2>
                <p class="main__text">Вычислить значение функции y=f(x) при произвольных значениях x. Для вычисления
                    значения функции использовать оператор switch.</p>
                <input class="main__input__one" type="numeric" name="number4_x" placeholder="Введите значение X"
                    required />

                <button class="main__button" name="four">Решить задачу</button>
            </form>

            <?php
            if (isset($_POST['four'])) {

                $number4_x = $_POST["number4_x"];

                if (is_numeric($number4_x)) {

                    switch ($number4_x) {
                        case 0:
                            $number4_y = 1 / (1 + 2.1 * abs($number4_x));
                            echo "<p class='main__text'>" . "y = " . $number4_y, "</p>";
                            break;
                        case -2:
                            $number4_y = cos(0.7 * $number4_x ** 2) + 0.5 * $number4_x;
                            echo "<p class='main__text'>" . "y = " . $number4_y, "</p>";
                            break;
                        case 1:
                            $number4_y = sqrt(1 + (exp($number4_x)) ** (2.1 * $number4_x));
                            echo "<p class='main__text'>" . "y = " . $number4_y, "</p>";
                            break;
                        default:
                            echo "x не равно 0, -2 или 1";
                    }
                } else {
                    echo "<p class='main__text'>Введите числовое значение</p>";
                }
            }
            ?>
        </div>

        <div class="footer">
            <p class="footer__text">Проверил: С. В. Умбетов</p>
        </div>
    </div>

</body>
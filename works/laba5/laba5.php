<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Мальцев Никита Олегович">
    <meta name="discription" content="Изучение php">
    <meta name="keywords" content="php">
    <link rel="stylesheet" href="./laba5.css">
    <title>Лабораторные работы</title>
</head>

<body>
    <div class="container">
        <div class="header">
            <p class="header__text">Лабораторная работа №5</p>
            <a href="../../index.php" class="header__link"> На главную</a>
        </div>

        <div class="main">
            <h1 class="main__head">Вариант 12</h1>

            <form method="POST" action="">
                <h2 class="main__head__small">Задание 1:</h2>
                <p class="main__text">Дан набор ненулевых целых чисел; признак его завершения — чис-ло 0. Вывести сумму
                    всех положительных четных чисел из данного набора. Если требуемые числа в наборе отсутствуют, то
                    вывести 0.</p>
                <input class="main__input__one" type="numeric" name="number1_a" placeholder="Введите значение A"
                    required />

                <button class="main__button" name="one">Решить задачу</button>
            </form>
            

            <?php
            if (isset($_POST['one'])) {
                $summ = 0;
                $number1_a = $_POST["number1_a"];
                if (is_numeric($number1_a)) {
                    $number1_a = strval($number1_a);
                    $str_nuber = str_split($number1_a);
                    for ($i = 0; $i < count($str_nuber); $i++) {
                        if ($str_nuber[$i] != 0) {
                            if ($str_nuber[$i] > 0) {
                                $summ = $summ + $str_nuber[$i];
                            }
                        } else {
                            break;
                        }
                    }
                    echo "<p class='main__text'>" . $summ . "</p>";
                } else {
                    echo "<p class='main_text'>Введите числовое значение</p>";
                }
            }
            ?>

            <form method="POST" action="">
                <h2 class="main__head__small">Задание 2:</h2>
                <p class="main__text"> Дано целое число N (> 0). Найти произведение 1.1 · 1.2 · 1.3 · … (N
                    сомножителей).

                </p>
                <input class="main__input__one" type="numeric" name="number2_a" placeholder="Введите значение A"
                    required />
                <button class="main__button" name="two">Решить задачу</button>
            </form>

            <?php
            if (isset($_POST['two'])) {
                $number2_a_proizv = 1;
                $number2_a = $_POST["number2_a"];

                if (is_numeric($number2_a)) {
                    $number2_a = strval($number2_a);
                    $str_nuber2 = str_split($number2_a);
                    if ($number2_a > 0) {
                        for ($i = 0; $i < count($str_nuber2); $i++) {
                            $number2_a_proizv = $number2_a_proizv * $str_nuber2[$i]; 
                        }
                    }else{
                        echo "<p class='main__text'>Введите число больше нуля</p>";

                    }

                } else {
                    echo "<p class='main__text'>Введите числовое значение</p>";
                }echo "<p class='main__text'>".$number2_a_proizv."</p>";
            }
            ?>


        </div>

        <div class="footer">
            <p class="footer__text">Проверил: С. В. Умбетов</p>
        </div>
    </div>

</body>
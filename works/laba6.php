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
            <p class="header__text">Лабораторная работа №6</p>
            <a href="../index.php" class="header__link"> На главную</a>
        </div>

        <div class="main">
            <h1 class="main__head">Вариант 12</h1>

            <form method="POST" action="">
                <h2 class="main__head__small">Задание 1:</h2>
                <p class="main__text">Дан массив A размера N. Вывести вначале его элементы с четными номерами
                    (в порядке возрастания номеров), а затем — элементы с нечетны-ми номерами (также в порядке
                    возрастания номеров):
                    A2,A4,A6,. . ., A1,A3,A5, . . . . Условный оператор не использовать.</p>
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
                    for ($i = 0; $i < count($str_nuber); $i = $i + 2) {
                        echo "<p class='main__text'>" . "четный " . $str_nuber[$i] . "</p>";
                    }
                    for ($i = 1; $i < count($str_nuber); $i = $i + 2) {
                        echo "<p class='main__text'>" . "не четный " . $str_nuber[$i] . "</p>";
                    }

                } else {
                    echo "<p class='main_text'>Введите числовое значение</p>";
                }
            }
            ?>

            <form method="POST" action="">
                <h2 class="main__head__small">Задание 2:</h2>
                <p class="main__text"> Дан массив размера N (N — четное число). Поменять местами первую и вторую
                    половины массива.

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
                    if ((strlen($number2_a) % 2) == 0) {
                        for ($i = 0; $i < strlen($number2_a) / 2; $i++) {
                            $t = $number2_a[$i];
                            $number2_a[$i] = $number2_a[strlen($number2_a)/2 + $i];
                            $number2_a[strlen($number2_a)/2+$i]=$t;
                        }
                    } else {
                        echo "<p class='main__text'>Массив должен быть четным</p>";
                    }
                } else {
                    echo "<p class='main__text'>Введите числовое значение</p>";
                }
                echo "<p class='main__text'>".$number2_a."</p>";
            }
            ?>


        </div>

        <div class="footer">
            <p class="footer__text">Проверил: С. В. Умбетов</p>
        </div>
    </div>

</body>
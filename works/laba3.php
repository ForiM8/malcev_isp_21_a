<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Мальцев Никита Олегович">
    <meta naem="discription" content="Изучение php">
    <meta name="keywords" content="php">
    <link rel="stylesheet" href="laba3.css">
    <title>Лабораторные работы</title>
</head>
<body>
        <div class="container">
            <div class="header">
                <p class="header__text">Лабораторная работа №3</p>
                <a href="../index.php" class="header__link"> На главную</a>
            </div>

            <div class="main">
                <h1 class="main__head">Вариант 12</h1>
                
                <h2 class="main__head__small">Задание 1:</h2>
                <p class="main__text">Даны катеты прямоугольного треугольника a и b. 
                    Найти его гипотенузу c и периметр P.</p>
                <form method="POST" action="">
                    <input class="main__input__one" type="numeric" name="a" placeholder="Введите значение a" required />
                    <input class="main__input__one" type="numeric" name="b" placeholder="Введите значение b" required />
                    <button class="main__button" name="one">Решить задачу</button>
                </form>

                <?php 
                if (isset($_POST['one'])) {

                    $a = htmlspecialchars($_POST["a"]);
                    $b = htmlspecialchars($_POST["b"]);
            
                    if (is_numeric($a) && is_numeric($b)) {
                        $c = sqrt($a**2 + $b**2);
                        $P = $a + $b + $c;
                        echo "<p class='main__text'>Гипотенуза: " .$c . "</p>";
                        echo "<p class='main__text'>Периметр: " .$P. "</p>";
                    } else {
                        echo "<p class='main__text'>Введите числовые значения для a и b.</p>";
                    }
                }
                ?>

                <h2 class="main__head__small">Задание 2:</h2>
                <p class="main__text">Дано трехзначное число. Вывести число, полученное
                     при прочтении исходного числа справа налево.</p>
                <form method="POST" action="">
                    <input class="main__input__two" type="text" name="number" placeholder="Введите трехзначное число" required />
                    <button class="main__button" name="two">Решить задачу</button>
                </form>
                <?php 
                if (isset($_POST['two'])) {

                    $number = htmlspecialchars($_POST["number"]);
                    if (is_numeric($number)) {
                        if (strlen(strval($number))==3) {
                            echo "<p class='main__text'>Ответ: " .strrev($number). "</p>";
                        } else {
                            echo "<p class='main__text'>Введите трехзначное число</p>";
                        }
                    } else {
                        echo "<p class='main__text'>Введите числовые значения.</p>";
                    }
                }
                ?>
            </div>

            <div class="footer">
                <p class="footer__text">Проверил:  С. В. Умбетов</p>
            </div>
        </div>
 
</body>
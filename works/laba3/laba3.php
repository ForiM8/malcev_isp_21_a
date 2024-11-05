<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Мальцев Никита Олегович">
    <meta name="discription" content="Изучение php">
    <meta name="keywords" content="php">
    <link rel="stylesheet" href="laba3.css">
    <title>Лабораторные работы</title>
</head>

<body>
    <div class="container">
        <?php
        include("../../components/header/header.php");
        ?>

        <div class="main">
            <a href="../../index.php" class="header__link"> На главную</a>
            <h1 class="main__head">Вариант 11</h1>

            <h2 class="main__head__small">Задание 1:</h2>
            <p class="main__text">Даны два ненулевых числа. Найти сумму,
                разность, произведение и частное их модулей.</p>
            <?php

            $a = -2;
            $b = 5;
            $summ = abs($a) + abs($b);
            $razn = abs($a) - abs($b);
            $proiz = abs($a) * abs($b);
            $chast = abs($a) / abs($b);
            echo "<p class='main__text'>Исходные данные: a = " . $a . "; b = " . $b . "</p>";
            echo "<p class='main__text'> Модуль от числа " . $a . " = " . abs($a) . " от числа " . $b . " = " . abs($b) . "</p>";
            echo "<p class='main__text'>" . abs($a) . " + " . abs($b) . " = " . $summ . "</p>";
            echo "<p class='main__text'>" . abs($a) . " - " . abs($b) . " = " . $razn . "</p>";
            echo "<p class='main__text'>" . abs($a) . " * " . abs($b) . " = " . $proiz . "</p>";
            echo "<p class='main__text'>" . abs($a) . " / " . abs($b) . " = " . $chast . "</p>";
            ?>
            <h2 class="main__head__small">Задание 2:</h2>
            <p class="main__text">Дано трехзначное число. Найти сумму и произведение его цифр.</p>
            <?php

            $number = 536;
            $edinici = $number % 10;
            $decytki = $number % 100;
            $decytki = intdiv($decytki, 10);
            $sotni = intdiv($number, 100);
            $summ = $edinici + $decytki + $sotni;
            $proizv = $edinici * $decytki * $sotni;
            echo "<p class='main__text'>Исходное число - " . $number . "</p>";
            echo "<p class='main__text'>" . $sotni . "+" . $decytki . "+" . $edinici . "=" . $summ . "</p>";
            echo "<p class='main__text'>" . $sotni . "*" . $decytki . "*" . $edinici . "=" . $proizv . "</p>";
            ?>
        </div>

        <?php
        include("../../components/footer/footer.php");
        ?>
    </div>

</body>
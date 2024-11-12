<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Мальцев Никита Олегович">
    <meta name="discription" content="Изучение php">
    <meta name="keywords" content="php">
    <link rel="stylesheet" href="./laba7.css">
    <title>лаба7</title>
</head>

<body>
    <div class="container">
        <?php
        include("../../components/header/header.php");
        ?>

        <div class="main">
            <a href="../../index.php" class="header__link"> На главную</a>
            <h1 class="main__head">Вариант 12</h1>

            <form method="POST" action="">
                <h2 class="main__head__small">Задание 1:</h2>
                <p class="main__text">Дана матрица размера M × N. Вывести ее элементы в следующем порядке: первый
                    столбец сверху вниз, второй столбец снизу вверх, третий столбец сверху вниз, четвертый столбец
                    снизу вверх и т. д.</p>
                <input class="main__input__one" type="numeric" name="number1_m" placeholder="Введите значение М"
                    required />
                <input class="main__input__one" type="numeric" name="number1_n" placeholder="Введите значение N"
                    required />

                <button class="main__button" name="one">Решить задачу</button>
            </form>


            <?php
            if (isset($_POST['one'])) {
                $m = $_POST["number1_m"];
                $n = $_POST["number1_n"];
                if (is_numeric($m) && is_numeric($n)) {
                    echo "<br> M = $m, N = $n\n";
                    $massiv = [];
                    for ($i = 0; $i < $m; $i++) {
                        $row = [];
                        for ($j = 0; $j < $n; $j++) {
                            $row[] = rand(0, 9);
                        }
                        $massiv[] = $row;
                    }
                    foreach ($massiv as $key) {echo "<br>[" . implode(' ', $key) . "]" . "\n";}
                    echo "<br>Меняем строки и столбцы местами для упрощения вывода\n";
                    $preobrazMassiv = [];
                    for ($i = 0; $i < $n; $i++) {
                        $preobrazMassiv[$i] = [];
                        for ($j = 0; $j < $m; $j++) {
                            $preobrazMassiv[$i][] = $massiv[$j][$i];
                        }
                    }
                    foreach ($preobrazMassiv as $key) {echo "<br>[" . implode(' ', $key) . "]" . "\n";}
                    for ($i = 0; $i < $n; $i++) {
                        if ($i % 2 == 0) {
                            echo "<br>" . "$i столбец " . implode(' ', $preobrazMassiv[$i]) . "\n"; 
                        } else {
                            echo "<br>" . "$i столбец " . implode(' ', array_reverse($preobrazMassiv[$i])) . "\n";
                        }
                    }
                } else {
                    echo "m,n должны быть числами";
                }
            }
            ?>

            <form method="POST" action="">
                <h2 class="main__head__small">Задание 2:</h2>
                <p class="main__text"> Дана матрица размера M × N и целое число K (1 ≤ K ≤ N ). Удалить столбец матрицы
                    с номером K.

                </p>
                <input class="main__input__one" type="numeric" name="number2_m" placeholder="Введите значение М"
                    required />
                <input class="main__input__one" type="numeric" name="number2_n" placeholder="Введите значение N"
                    required />
                <input class="main__input__one" type="numeric" name="number2_k" placeholder="Введите значение K"
                    required />
                <button class="main__button" name="two">Решить задачу</button>
            </form>

            <?php
            if (isset($_POST['two'])) {
                $m = $_POST["number2_m"];
                $n = $_POST["number2_n"];
                $k = $_POST["number2_k"];
                if (is_numeric($m) && is_numeric($n) && is_numeric($k)) {
                    if (($k >= 1) && ($k <= $n)) {
                        echo "<br> M = $m, N = $n\n";
                        $massv = [];
                        for ($i = 0; $i < $m; $i++) {
                            $row = [];
                            for ($j = 0; $j < $n; $j++) {
                                $row[] = rand(0, 9);
                            }
                            $massiv[] = $row;
                        }
                        foreach ($massiv as $key) {echo "<br>[" . implode(' ', $key) . "]" . "\n";}
                        echo "<br>Удаляем указанный столбец\n";
                        $preobrazMassiv = [];
                        for ($i = 0; $i < $n; $i++) {
                            $preobrazMassiv[$i] = [];
                            for ($j = 0; $j < $m; $j++) {
                                unset($massiv[$j][$k - 1]);
                            }
                        }
                        foreach ($massiv as $key) { echo "<br>[" . implode(' ', $key) . "]" . "\n"; }
                    } else {
                        echo "k должно быть (1 ≤ K ≤ N )";
                    }
                } else {
                    echo "m,n,k должны быть числами";
                }
            }
            ?>

            <?php
            include("../../components/footer/footer.php");
            ?>
        </div>

</body>
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
        <script>var countdownNumberEl = document.getElementById('countdown-number');
var countdown = 10;

countdownNumberEl.textContent = countdown;

setInterval(function() {
  countdown = --countdown <= 0 ? 10 : countdown;

  countdownNumberEl.textContent = countdown;
}, 1000);</script>

        <div class="main">

            <?php

            class UserTable
            {
                protected $users;

                public function __construct()
                {
                    $this->users = [
                        ['id' => 1, 'name' => 'Никита'],
                        ['id' => 2, 'name' => 'Макс'],
                        ['id' => 3, 'name' => 'Саня'],
                        ['id' => 4, 'name' => 'Антон'],
                        ['id' => 5, 'name' => 'Федор']
                    ];
                }
                public function Tabel()
                {
                    echo '<table border="1">';
                   
                    foreach ($this->users as $user) {
                        echo '<tr>';
                            echo '<td>' . htmlspecialchars($user['id']) . '</td>';
                            echo '<td>' . htmlspecialchars($user['name']) . '</td>';
                        echo '</tr>';
                    }

                    echo '</table>';
                }
            }

                        
            
            ?>

        </div>

      
</body>
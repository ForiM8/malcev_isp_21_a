<?php
session_start(); 

$conn = new mysqli("localhost", "toprs1ew_bd", "Qw123456Qw!", "toprs1ew_bd");
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

if (!isset($_SESSION['name'])) {
    echo "Пользователь не найден.";
    exit;
}

$sql = "SELECT id, name, score FROM users ORDER BY score DESC";
$result = $conn->query($sql);

    echo '
    <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Таблица результатов</title>
    <link rel="stylesheet" href="tableScore.css">
</head>
<body>
    <div class="main">
        <div class="main__container">
            <div class="main__container__header">
            <a href="../../../../index.php" class="main__container__header-exit"></a>
                Рейтинг пользователей
            </div>
            <table class="table">
                <thead class="table__thead">
                    <tr class="table__thead__tr">
                        <th class="table__thead__tr-th">№</th>
                        <th class="table__thead__tr-th">Имя</th>
                        <th class="table__thead__tr-th">Очки</th>
                    </tr>
                </thead>
                <tbody class="table__tbody">';
                
                $rank = 1;  
                while ($user = $result->fetch_assoc()) {
                    echo '
                    <tr class="table__tbody__tr">
                        <td class="table__tbody__tr-td">' . $rank++ . '</td>
                        <td class="table__tbody__tr-td">' . htmlspecialchars($user['name']) . '</td>
                        <td class="table__tbody__tr-td">' . htmlspecialchars($user['score']) . '</td>
                    </tr>';
                }

    echo '</tbody>
            </table>
        </div>
    </div>

</body>
</html>';

    
    
    
    
    
    


$conn->close();
?>

<?php 
session_start(); 

if (!isset($_SESSION['name'])) {
    echo "Пользователь не найден.";
    exit;
}

$apiUrl = 'toprs1rp.beget.tech/posts/allUser'; 

$ch = curl_init($apiUrl);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 

$response = curl_exec($ch);

$responseDecoded = json_decode($response, true);

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
foreach ($responseDecoded as $user) {
    // Печатаем строку таблицы для каждого пользователя
    echo '
    <tr class="table__tbody__tr">
        <td class="table__tbody__tr-td">' . $rank++ . '</td>
        <td class="table__tbody__tr-td">' . htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8') . '</td>
        <td class="table__tbody__tr-td">' . htmlspecialchars($user['score'], ENT_QUOTES, 'UTF-8') . '</td>
    </tr>';
}

echo '</tbody>
        </table>
    </div>
</div>

</body>
</html>';
?>

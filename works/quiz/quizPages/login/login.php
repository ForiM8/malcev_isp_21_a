<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $score = 0;
    $create_at = date('Y-m-d H:i:s');
    $update_at = $create_at;

    $data = [
        'name' => $name,
        'score' => $score,
        'create_at' => $create_at,
        'update_at' => $update_at
    ];

    $url = 'http://toprs1rp.beget.tech/posts/addUser';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));

    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded'
    ]);

    $response = curl_exec($ch);

    if (curl_errno($ch)) {
        echo 'Ошибка cURL: ' . curl_error($ch);
    }

    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    $responseData = json_decode($response, true);

    if (isset($responseData['user_id'])) {
        $_SESSION['name'] = $name;
        $_SESSION['user_id'] = $responseData['user_id'];
        header("Location: ../quesOne/quesOne.php");
        exit;
    } else {
        echo 'Ошибка при добавлении пользователя';
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Мальцев Никита Олегович">
    <meta name="description" content="Изучение php">
    <meta name="keywords" content="php">
    <link rel="stylesheet" href="./login.css">
    <title>Регистрация</title>
</head>
<body>
    <div class="main">
        <div class="main__container">
            <form action="" method="POST">
                <div class="main__container__login">
                    <div class="main__container__login-name">Регистрация</div>
                    <input class="main__container__login-input" type="text" name="name" placeholder="Введите свое имя" required>
                    <button class="main__container__login-button" type="submit">Продолжить</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
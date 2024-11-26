<?php
session_start();

// Соединение с базой данных
$conn = new mysqli("localhost", "toprs1ew_bd", "Qw123456Qw!", "toprs1ew_bd");
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $score = 0; 
    $create_at = date('Y-m-d H:i:s');
    $update_at = $create_at;

    // Проверка на существование пользователя
    $check_sql = "SELECT COUNT(*) FROM users WHERE name = '$name'";
    $result = $conn->query($check_sql);
    $count = $result->fetch_row()[0];

    if ($count > 0) {
        echo "Пользователь с таким именем уже существует. Пожалуйста, выберите другое имя.";
    } else {
        // Вставка нового пользователя
        $sql = "INSERT INTO users (name, score, create_at, update_at) 
                VALUES ('$name', $score, '$create_at', '$update_at')";
        
        if ($conn->query($sql) === TRUE) {
            $_SESSION['name'] = $name;
            header("Location: ../quesOne/quesOne.php");
            exit;
        } else {
            echo "Ошибка: " . $conn->error;
        }
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

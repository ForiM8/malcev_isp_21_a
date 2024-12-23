<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user = $_POST['user'];
    $score = 0;
    function get_ip_list()
    {
	$list = array();
	if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
		$ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
		$list = array_merge($list, $ip);
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
		$list = array_merge($list, $ip);
	} elseif (!empty($_SERVER['REMOTE_ADDR'])) {
		$list[] = $_SERVER['REMOTE_ADDR'];
	}
	
	$list = array_unique($list);
	return implode(',', $list);
    }
    $ip_address = get_ip_list();
    $create_at = date('Y-m-d H:i:s');
    $update_at = $create_at;

    $data = [
        'user' => $user,
        'text' => $text,
        'ip_address' => $ip_address,
        'create_at' => $create_at,
        'update_at' => $update_at
    ];

    $url = 'http://toprs1rp.beget.tech/api/messages/add';

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
        $_SESSION['user'] = $user;
        $_SESSION['user_id'] = $responseData['user_id'];
        $_SESSION['ip_address'] = get_ip_list();
        header("Location: people.php");
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
                    <input class="main__container__login-input" type="text" name="user" placeholder="Введите свое имя" required>
                    <button class="main__container__login-button" type="submit">Продолжить</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
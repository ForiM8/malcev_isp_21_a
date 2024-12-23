<?php
session_start();

if (!isset($_SESSION['user'])) {
    echo "Пользователь не найден.";
    exit;
}

if (!isset($_SESSION['user_id'])) {
    echo "ID пользователя не найден.";
    exit;
}

$user_id = $_SESSION['user_id'];

$apiUrl = 'http://toprs1rp.beget.tech/api/messages';

$ch = curl_init($apiUrl);

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if ($response === false) {
    echo "Ошибка при выполнении запроса к API.";
    exit;
}

$responseDecoded = json_decode($response, true);

$displayedUsers = [];

echo '
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chats</title>
    <link rel="stylesheet" href="./people.css">
</head>

<body>
    <div class="main">
        <div class="main__container">

            <div class="main__container__header">
                <div class="main__container__header__container">
                    <div class="main__container__header__container__left">
                        <div class="main__container__header__container__left-img"></div>
                        <div class="main__container__header__container__left-text">People</div>
                    </div>
                    <div class="main__container__header__container__right">
                        <div class="main__container__header__container__right-camera"></div>
                        <div class="main__container__header__container__right-pencil"></div>
                    </div>
                </div>
            </div>

            <div class="main__container__main">';
            foreach ($responseDecoded as $user) {
                if ($user_id != $user['id'] && !in_array($user['user'], $displayedUsers)) {
                    $displayedUsers[] = $user['user'];
                    echo '
                    <div class="main__container__main__people">
                        <a href="./messenger.php?user_id=' . htmlspecialchars($user['id'], ENT_QUOTES, 'UTF-8') . '" class="main__container__main__people-avatarka"></a>
                        <div class="main__container__main__people__containerText">
                            <div class="main__container__main__people__containerText-name">' . htmlspecialchars($user['user'], ENT_QUOTES, 'UTF-8') . '</div>
                            <div class="main__container__main__people__containerText-hand"></div>
                        </div>
                    </div>';
                }
            }

            echo '</div>

            <div class="main__container__footer">
                <div class="main__container__footer__container">
                    <a href="./chats.php" class="main__container__footer__container-chats"></a>
                    <div class="main__container__footer__container-people"></div>
                    <div class="main__container__footer__container-discover"></div>
                </div>
            </div>
        </div>
    </div>
    <script>

    </script>
</body>

</html>';
?>

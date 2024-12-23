<?php
session_start();

// Проверка сессии

$score = $_SESSION['$score'];
$username = $_SESSION['name'];

$user_id = $_SESSION['user_id'];
$api_url = "http://toprs1rp.beget.tech"; 

function makeApiRequest($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
    ));
    $response = curl_exec($ch);
    if (curl_errno($ch)) {

    }
    curl_close($ch);

    return json_decode($response, true);
}
function makePatchRequest($url, $data) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PATCH');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
    ));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    $response = curl_exec($ch);
    if (curl_errno($ch)) {
        echo 'Ошибка cURL: ' . curl_error($ch);
    }
    curl_close($ch);

    return json_decode($response, true);
}


$id =  $_SESSION['$id'];


$question_url = "$api_url/index.php?q=posts/allQues/$id";
$question = makeApiRequest($question_url);


if ($question) {
    $correct_answer = $question['answer'];
    
        if (isset($_GET['answer'])) {
            $user_answer = intval($_GET['answer']);

            if ($user_answer == $correct_answer) {
                $new_score = $score + 1;
                
            }

            $next_id = $id + 1;
            if ($next_id == 11) {
                $_SESSION['$score']=$new_score;
                    $_SESSION['$id'] = $next_id; 
                    $update_score_url = "$api_url/index.php?q=posts/pathUser/$user_id";
                    $update_data = array(
                    
                    'score' => $new_score,
                    );

                    $response = makePatchRequest($update_score_url, $update_data);
                $_SESSION['name'] = $username;
                header("Location: ../tableScore/tableScore.php");
                exit();
            } else {
                
                if ($user_answer == $correct_answer) {
                    $_SESSION['$score']=$new_score;
                    $_SESSION['$id'] = $next_id; 
                    $update_score_url = "$api_url/index.php?q=posts/pathUser/$user_id"; 
                    $update_data = array(
                    
                    'score' => $new_score,
                    );

                    $response = makePatchRequest($update_score_url, $update_data);
                
                }else{
                    $score = $_SESSION['$score'];

                    $_SESSION['$score'] = $score;
                    $_SESSION['$id'] = $next_id;
                    
                    $update_score_url = "$api_url/index.php?q=posts/pathUser/$user_id"; 
                    $update_data = array(
        
                    'score' => $score,
                    );

                    $response = makePatchRequest($update_score_url, $update_data);
                }
                $_SESSION['name'] = $username;
                header("Location: quesTwo.php");
                exit();
            }
        }

        echo '
        <!DOCTYPE html>
        <html lang="ru">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Квиз</title>
            <link rel="stylesheet" href="./quesOne.css">
        </head>
        <body>
            <div class="main">
                <div class="main__container">
                    <div class="main__container__header">
                        <a href="../../../../index.php" class="main__container__header-exit"></a>
                        <div class="main__container__header-item">
                            <div id="countdown">
                                <div id="countdown-number"></div>
                                <svg class="main__container__header-itemsvg">
                                    <circle class="main__container__header-itemsvg_circle" r="18" cx="20" cy="20"></circle>
                                </svg>
                            </div>
                        </div>
                        <div class="main__container__header-score">
                            <svg style="position: relative; transform: none; margin-right:3px" version="1.0" xmlns="http://www.w3.org/2000/svg" width="13px" height="13px"
                                viewBox="0 0 24.000000 24.000000" preserveAspectRatio="xMidYMid meet">
                                <g transform="translate(0.000000,24.000000) scale(0.100000,-0.100000)" fill="#fff" stroke="none">
                                    <path d="M149 161 l-52 -59 -28 20 c-27 20 -49 18 -49 -5 0 -7 4 -6 10 3 8 12 13 11 39 -8 l30 -22 52 60 c29 33 54 58 57 56 8 -8 -100 -176 -113 -176 -7 0 27 17 -45 38 -17 20 -27 28 -21 17 15 -32 59 -68 74 -62 16 6 117 167 117 186 0 23 -20 9 -71 -48z" />
                                </g>
                            </svg> ' . $score . '
                        </div>
                    </div>
                    <img src="' . htmlspecialchars($question['image'], ENT_QUOTES, 'UTF-8') . '" class="main__container__image" alt="Image">
                    <div class="main__container__question">
                        <div class="main__container__question-countQuestion">Вопрос ' . $id . ' из 10</div>
                        <div class="main__container__question-question">' . htmlspecialchars($question['title'], ENT_QUOTES, 'UTF-8') . '</div>
                    </div>
                    <div class="main__container__answers">
                        <form method="GET" action="">
                            <input type="hidden" name="id" value="' . $id . '" />
                            <button type="submit" class="main__container__button-question" name="answer" value="1">' . htmlspecialchars($question['question_1'], ENT_QUOTES, 'UTF-8') . '</button>
                            <button type="submit" class="main__container__button-question" name="answer" value="2">' . htmlspecialchars($question['question_2'], ENT_QUOTES, 'UTF-8') . '</button>
                            <button type="submit" class="main__container__button-question" name="answer" value="3">' . htmlspecialchars($question['question_3'], ENT_QUOTES, 'UTF-8') . '</button>
                        </form>
                    </div>
                </div>
            </div>
            <script>
            var countdownNumberEl = document.getElementById("countdown-number");
            var countdown = 30;

            countdownNumberEl.textContent = countdown;

            setInterval(function() {
                countdown = --countdown <= 0 ? 30 : countdown;

                countdownNumberEl.textContent = countdown;
                if(countdown == 1){
                    window.location.href = "quesTwo.php";
                }
            }, 1000);
            </script>
        </body>
        </html>';
    
} else {
    echo "Ошибка при получении вопроса.";
}
?>

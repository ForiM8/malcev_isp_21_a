<?php
session_start(); 

$conn = new mysqli("localhost", "toprs1ew_bd", "Qw123456Qw!", "toprs1ew_bd");
if ($conn->connect_error) {
    die("Ошибка подключения: " . $conn->connect_error);
}

$username = $_SESSION['name'];

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    $id = 1;
}

$sql = "SELECT * FROM questions WHERE id = $id AND is_del = 0";
$result = $conn->query($sql);
$next_id = $id + 1;

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $correct_answer = $row['answer'];

    $score_sql = "SELECT score FROM users WHERE name = '$username'";
    $score_result = $conn->query($score_sql);

    if ($score_result->num_rows > 0) {
        $score_row = $score_result->fetch_assoc();
        $score = $score_row['score'];

        if (isset($_GET['answer'])) {
            $user_answer = intval($_GET['answer']);

            if ($user_answer == $correct_answer) {
                $new_score = $score + 1;

                $update_score_sql = "UPDATE users SET score = $new_score WHERE name = '$username'";
                $conn->query($update_score_sql);
            }

            if ($next_id == 11) {
                header("Location: ../tableScore/tableScore.php");
                exit();
            } else {
                header("Location: quesOne.php?id=$next_id");
                exit();
            }
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
                    <a href="../../../index.php" class="main__container__header-exit"></a>
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
                <img src="' . $row['image'] . '" class="main__container__image" alt="Image"></img>
                <div class="main__container__question">
                    <div class="main__container__question-countQuestion">Вопрос ' . $id . ' из 10</div>
                    <div class="main__container__question-question">' . $row['title'] . '</div>
                </div>
                <div class="main__container__answers">
                    <form method="GET" action="">
                        <input type="hidden" name="id" value="' . $id . '" />
                        <button type="submit" class="main__container__button-question" name="answer" value="1">' . $row['question_1'] . '</button>
                        <button type="submit" class="main__container__button-question" name="answer" value="2">' . $row['question_2'] . '</button>
                        <button type="submit" class="main__container__button-question" name="answer" value="3">' . $row['question_3'] . '</button>
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
                window.location.href = "quesOne.php?id='.$next_id.'";
        
            }
            
        }, 1000);
        
        </script>
    </body>
    </html>';
}

$conn->close();
?>

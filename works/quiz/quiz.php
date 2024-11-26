<?php
$conn = new mysqli("localhost", "toprs1ew_bd", "9kszv&pm0WKd", "toprs1ew_bd");
if ($conn->connect_error) {
    die("РћС€РёР±РєР°: " . $conn->connect_error);
}

$number = 0;
$answer = 0;

$isJson = false;


if (isset($_GET['number'])) {
    if (isset($_GET['answer'])) {

        $isJson = true;
        $sql = "SELECT * FROM questions WHERE is_del = 0 ";
    } else {
        $sql = "SELECT * FROM questions WHERE is_del = 0 AND id = " . intval($_GET['number']);
    }


} else {
    $sql = "SELECT * FROM questions WHERE is_del = 0";
}



$result = $conn->query($sql);

if (isset($result)) {

    if ($isJson) {

        echo json_encode($result->fetch_assoc());
    } else {

            echo '<!DOCTYPE html>
    <html lang="ru">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Мальцев Никита Олегович">
        <meta name="discription" content="Изучение php">
        <meta name="keywords" content="php">
        <link rel="stylesheet" href="./quiz.css">
        <title>Лабораторные работы</title>
    </head>';

    echo"<body>";
        echo'<div class="main">';
            echo'<div class="main__container">';

                echo'<div class="main__container__header">';
                    echo'<div class="main__container__header-item">1</div>';
                    echo'<div class="main__container__header-item">2</div>';
                    echo'<div class="main__container__header-item">3</div>';
                echo'</div>';
                foreach($result as $row){
                    echo'<div class="main__container__image">img</div>';

                    echo'<div class="main__container__question">;';
                        echo'<div class="main__container__question-countQuestion">question 5 of 10</div>';
                        echo'<div class="main__container__question-question">'. $row["title"] .'</div>';
                    echo'</div>';
                
                    echo'<div class="main__cintainer__button">';
                        if($row["is_del"] == 0) echo'<div class="main__cintainer__button-question">'. $row["question_1"] .'</div>';
                        if($row["answer"] == 0) echo'<div class="main__cintainer__button-question">'. $row["question_2"] .'</div>';
                        if($row["answer"] == 0)echo'<div class="main__cintainer__button-question">'. $row["question_2"] .'</div>';
                    echo'</div>';
                }
            echo'</div>';
        echo'</div>';
    echo"</body>";
    echo"</html>'";
    }
    echo "</table>";
    $result->free();

    echo '</body></html>';


} else {
    echo "РћС€РёР±РєР°: " . $conn->error;
}

$conn->close();

?>
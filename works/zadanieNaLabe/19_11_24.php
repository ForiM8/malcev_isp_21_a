<?php

$method = $_SERVER['REGUES_METHOD'];
$reguest = explode("/", trim($_SERVER['REQUEST_URI'], "/"), );

var_dump($method);
var_dump($_SERVER['REQUEST_URI']);

//posts/all rwtuen all posts
//posts/id/1 return specific post
//posts/add add post yo db

if ($reguest[0] !== '') {
    var_dump($reguest);

    switch ($reguest[0]) {
        case "posts";

            switch ($reguest[1]) {
                case "all";
                    echo json_encode([
                        'sucsess' => "true",
                        'list' => [1, 2, 3]
                    ]);
                    break;

                //post/id
                case "id";
                    echo json_encode([
                        'sucsess' => "true",
                        'id' => $reguest[2],
                        'text' => "some text"
                    ]);
                    break;

                case "add";
                    echo json_encode([
                        'sucsess' => "true",
                        'list' => [1, 2, 3]
                    ]);
                    break;
            }
            break;
    }
} else {
    echo "index api page";
}

//1) список пользователей
//2) список эндпоинтов
//3) эндпоинт который создает пользователь
//4) добавить вопрос

?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Мальцев Никита Олегович">
    <meta name="discription" content="Изучение php">
    <meta name="keywords" content="php">
    <link rel="stylesheet" href="./laba7.css">
    <title>лаба7</title>
</head>

<body>
    <div class="container">
        

        <div class="main">

            <?php

            class EditTable extends UserTable
            {
                public function editUser($id, $name)
                {
                    foreach ($this->users as &$user) {
                        if ($user['id'] == $id) {
                            $user['name'] = $name;
                            break;
                        }
                    }
                }
            }
            $editTable = new EditTable();

            $editTable->Tabel();

            $editTable->editUser(1, 'Иван');

            $editTable->Tabel();

            ?>

        </div>

        
</body>
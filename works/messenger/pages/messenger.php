<?php
session_start();

// Ensure 'selected_user_id' is set when a user is selected
if (isset($_GET['user_id'])) {
    $_SESSION['selected_user_id'] = $_GET['user_id'];
}

// Ensure user session is valid
if (!isset($_SESSION['user'])) {
    echo "Пользователь не найден.";
    exit;
}

$session_ip_address = $_SESSION['ip_address'];

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
$user_id = $_SESSION['selected_user_id'];

$apiUrl = "http://toprs1rp.beget.tech/api/messages/get/$user_id";
$ch = curl_init($apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
$responseDecoded = json_decode($response, true);

// Fetch all messages
$apiUrlMessage = "http://toprs1rp.beget.tech/api/messages";
$chMessage = curl_init($apiUrlMessage);
curl_setopt($chMessage, CURLOPT_RETURNTRANSFER, true);
$responseMessage = curl_exec($chMessage);
$responseDecodedMessage = json_decode($responseMessage, true);
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chats</title>
    <link rel="stylesheet" href="./messenger.css">
</head>
<body>
    <div class="main">
        <div class="main__container">
            <div class="main__container__header">
                <div class="main__container__header__container">
                    <div class="main__container__header__container__left">
                        <a href="./people.php" class="main__container__header__container__left-back"></a>
                        <div class="main__container__header__container__left-img"></div>
                        <div class="main__container__header__container__left__containerText">
                            <div class="main__container__header__container__left__containerText-name"><?= htmlspecialchars($responseDecoded['user'], ENT_QUOTES, 'UTF-8') ?></div>
                            <div class="main__container__header__container__left__containerText-messenger">messenger</div>
                        </div>
                    </div>
                    <div class="main__container__header__container__right">
                        <div class="main__container__header__container__right-camera"></div>
                        <div class="main__container__header__container__right-pencil"></div>
                    </div>
                </div>
            </div>

            <div class="main__container__main">
                <div class="main__container__main__right">
                   
                                <div class="between" style="display: flex; justify-content: space-between;">
                                    <div class="ff"></div>
                                    <div class="main__container__main__right__people">
                                        <div class="main__container__main__right__people__nameTime">
                                            <div class="main__container__main__right__people__nameTime-time">
                                               
                                            </div>
                                        </div>
                                        <div class="main__container__main__right__people__peopleContainer">
                                            <div class="main__container__main__right__people__peopleContainer__containerText">
                                                <div class="main__container__main__right__people__peopleContainer__containerText-name"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                          
                                
                </div>
            </div>

            <div class="main__container__footer">
                <form id="messageForm" method="POST">
                    <div class="main__container__footer__container">
                        <div class="main__container__footer__container-image"></div>
                        <input class="main__container__footer__container-input" type="text" name="text" id="messageInput"></input>
                        <button class="main__container__footer__container-accept" type="submit"></button>
                    </div>
                </form>
            </div>
        </div>
    </div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('messageForm');

    form.addEventListener('submit', function(event) {
        event.preventDefault();

        const text = document.getElementById('messageInput').value;
        const create_at = new Date().toISOString().slice(0, 19).replace('T', ' '); 
        const update_at = create_at;

        fetch('https://api.ipify.org?format=json')
        .then(response => response.json())
        .then(data => {
        const ip_address = data.ip;

                const dataToSend = new FormData();
                dataToSend.append('user', '<?php echo htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8'); ?>');
                dataToSend.append('text', text);
                dataToSend.append('ip_address', ip_address);
                dataToSend.append('create_at', create_at);
                dataToSend.append('update_at', update_at);

                console.log("Отправляем данные: ", {
                    user: '<?php echo htmlspecialchars($_SESSION['user'], ENT_QUOTES, 'UTF-8'); ?>',
                    text: text,
                    ip_address: ip_address,
                    create_at: create_at,
                    update_at: update_at
                });

                fetch('http://toprs1rp.beget.tech/api/messages/add', {
                    method: 'POST',
                    body: dataToSend
                })
                .then(response => response.json()) 
                .then(responseData => {
                    console.log("Ответ JSON: ", responseData);

                    if (responseData.user_id) {
                        updateMessages(ip_address); 
                        document.getElementById('messageInput').value = ''; 
                    } else {
                        console.error('Ошибка при добавлении сообщения');
                    }
                })
                .catch(error => {
                    console.error('Ошибка при отправке запроса:', error);
                });
            })
            .catch(error => {
                console.error('Ошибка при получении IP-адреса:', error);
            });
    });

    function updateMessages(ip_address) {
        const session_ip_address = '<?php echo $_SESSION['ip_address']; ?>';
        fetch('http://toprs1rp.beget.tech/api/messages')
            .then(response => response.json())
            .then(data => {
                console.log("Полученные сообщения: ", data);

                if (Array.isArray(data)) {
                    const messagesContainer = document.querySelector('.main__container__main__right');
                    messagesContainer.innerHTML = ''; 

                    data.forEach(user => {
                        if (user.text && user.text.trim() !== '') {
                                if (user.ip_address === session_ip_address){
                                const messageElement = document.createElement('div');
                                messageElement.classList.add('between');
                                messageElement.innerHTML = `
                                   <div class="between" style="display: flex; justify-content: space-between;">
                                        <div class="ff"></div>
                                        <div class="main__container__main__right__people">
                                            <div class="main__container__main__right__people__nameTime">
                                                <div class="main__container__main__right__people__nameTime-time">
                                                    ${new Date(user.create_ad).toLocaleTimeString()}
                                                </div>
                                            </div>
                                            <div class="main__container__main__right__people__peopleContainer">
                                                <div class="main__container__main__right__people__peopleContainer__containerText">
                                                    <div class="main__container__main__right__people__peopleContainer__containerText-name">${user.text}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                `;
                                
                              
                                    messagesContainer.appendChild(messageElement);
                                
                            }else{
                                const messageElement = document.createElement('div');
                                messageElement.classList.add('between');
                                messageElement.innerHTML = `
                                        <div class="between" style="display: flex; justify-content: space-between;">
                                        <div id='div-02' class="ff"></div>
                                        <div class="main__container__main__right__people">
                                            <div class="main__container__main__right__people__nameTime">
                                                <div class="main__container__main__right__people__nameTime-name">${user.user}</div>
                                                <div class="main__container__main__right__people__nameTime-time">
                                                    ${new Date(user.create_ad).toLocaleTimeString()}
                                                </div>
                                            </div>
                                            <div class="main__container__main__right__people__peopleContainer">
                                                <div class="main__container__main__right__people__peopleContainer__containerText">
                                                    <div class="main__container__main__right__people__peopleContainer__containerText-name">${user.text}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                                messagesContainer.appendChild(messageElement);
                                var el = document.getElementById("div-02");
                                el.remove(); 
                            }
                        }
                    });
                    messagesContainer.scrollTop = messagesContainer.scrollHeight;
                }
            })
           
    }

   
    updateMessages('<?php echo $_SESSION['user_ip']; ?>');  

   
    setInterval(() => {
        updateMessages('<?php echo $_SESSION['user_ip']; ?>');
    }, 1000);  
});
</script>


</body>
</html>

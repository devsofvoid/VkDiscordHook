<?php 
if (!isset($_REQUEST)) { 
    return; 
} 
$confirmation_token = '0f5c65fc'; // Токен подтверждения
$data = json_decode(file_get_contents('php://input')); 
$lelu = json_decode(file_get_contents('php://input'), true); 
switch ($data->type) { 
    case 'confirmation': 
    echo $confirmation_token; 
    break; 
    case 'wall_post_new':
    $messageSS = $data->object->text;
    $currenttime = $data->object->date;
    $url = "https://discordapp.com/api/webhooks/587552493194444806/AFPqskP9cx1Zg6b8wT_-7AchyzXSQ8ldyWksgo1GCOYU-r_Py4fu4y3NUqGEZqVv_Roa"; // Веб хук
    $hookObject = json_encode([
        "content" => "",
        "username" => "",
        "avatar_url" => "",
        "tts" => false,
        "embeds" => [
            [
                "title" => "",
                "type" => "rich",
                "description" => "$messageSS",
                "url" => "",
                "timestamp" => "",
                "color" => "blue",
                "footer" => [
                    "text" => "(C) VOID • Дата: $currenttime",
                    "icon_url" => "https://pngicon.ru/file/uploads/vk.png"
                ],
                "thumbnail" => [
                    "url" => "https://pbs.twimg.com/profile_images/972154872261853184/RnOg6UyU_400x400.jpg"
                ],
                "author" => [
                    "name" => "Новая новость ВК!"
                ]
            ]
        ]
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );
    $ch = curl_init();
    curl_setopt_array( $ch, [
        CURLOPT_URL => $url,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $hookObject,
        CURLOPT_HTTPHEADER => [
            "Length" => strlen( $hookObject ),
            "Content-Type" => "application/json"
        ]
    ]);
    $response = curl_exec( $ch );
    curl_close( $ch );
    break;
}
?> 

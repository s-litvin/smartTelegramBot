<?php
$log_file = 'data.txt';


function dequeue() {
    $queue_file = 'queue.txt';
    $handle = fopen($queue_file, 'r+');
    if ($handle) {
        $item = fgets($handle);
        file_put_contents($queue_file, file_get_contents($queue_file, false, null, strlen($item)));
        fclose($handle);
        return $item;
    } else {
        return false;
    }
}


$jsonLine = dequeue();
if (!$jsonLine) {
    return;
}

$data = json_decode($jsonLine, true);

if (isset($data['error'])) {
    file_put_contents($log_file, $data['error'] . PHP_EOL, FILE_APPEND);
    return;
}

$text = isset($data['text']) ? $data['text'] : '';
$link = isset($data['link']) ? $data['link'] : '';
$chatId = isset($data['chatID']) ? $data['chatID'] : null;

if (!$text || $chatId === null) {
    return;
}

$openai_api_key = 'sk-bsCneF0AozCeellKydZHT3BlbkXXXXXXXXXXXXX';

$url = 'https://api.openai.com/v1/chat/completions';

$data = [
    'model' => 'gpt-3.5-turbo',
    'messages' => [
        [
            'role' => 'user',
            'content' => 'Перефразируй этот текст, чтоб он звучал в позитивном тоне и с льбовью к Украине и имел столько же предложений, как исходный: '  . PHP_EOL .  $text
        ]
    ],
    'temperature' => 1.0
];

$ch = curl_init($url);

$headers = [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $openai_api_key
];

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$response = curl_exec($ch);
$content = '';

if (curl_errno($ch)) {
    file_put_contents($log_file, json_encode(['error' => curl_error($ch)]) . PHP_EOL, FILE_APPEND);
    return;
} else {

    $obj = json_decode($response, true);
    $content = $obj['choices'][0]['message']['content'];
    file_put_contents($log_file,
        '[' . date("Y-m-d H:i:s") . ']' . PHP_EOL .
        'CHAT ID ' . PHP_EOL . $chatId . PHP_EOL . PHP_EOL .
        'ORIGINAL: ' .  PHP_EOL . $text . PHP_EOL . PHP_EOL .
        'chatGPT VERSION: ' . PHP_EOL . $content. PHP_EOL . PHP_EOL . PHP_EOL,
        FILE_APPEND);

}

curl_close($ch);


if (!$chatId) {
    return;
}

$botID = '6012435967:AAF-0w3cOjqm_Jp8UaXXXXXXXXXXXXXX';
$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => 'https://api.telegram.org/bot' . $botID . '/sendMessage',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{"chat_id": "' . $chatId . '", "text": "' . $content . '", "disable_notification": true}',
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
]);
$response = curl_exec($curl);
curl_close($curl);

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => 'https://api.telegram.org/bot' . $botID . '/sendMessage',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'{"chat_id": "' . $chatId . '", "text": "<tg-spoiler><i><u><b>ORIGINAL:</b></u></i> ' .
        addslashes(PHP_EOL . $text) . '</tg-spoiler>", "parse_mode":"HTML", "disable_notification": "true"}',
    CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
]);
$response = curl_exec($curl);
curl_close($curl);

echo $content;
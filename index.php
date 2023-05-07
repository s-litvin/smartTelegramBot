<?php

function enqueue($item) {
    $queue_file = 'queue.txt';
    $queue_handle = fopen($queue_file, 'a');
    fwrite($queue_handle, $item . PHP_EOL);
    fclose($queue_handle);
}

$post_data = $_POST;
$text = isset($_POST['text']) ? $_POST['text'] : '';
$link = isset($_POST['link']) ? $_POST['link'] : '';
$chatId = isset($_POST['chatid']) ? $_POST['chatid'] : null;

$text = preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function($match) {
    return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
}, $text);

if (!$text) {
    return;
}

enqueue(json_encode([
    'text' => $text,
    'chatID' => $chatId,
    'link' => $link
]));

echo 'OK';
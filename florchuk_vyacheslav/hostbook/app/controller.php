<?php
namespace controller;

include_once "bootstrap.php";

// Создаем пустой массив комментариев
$comments = [];


// Подключаемся к файлу для чтения
function connectForRead($path) {
    static $attempts;
    if (!file_exists($path) || !is_readable($path)){
        if ($attempts > 2){
            die("Unable to open storage file for reading\n");
        }
        touch($path);
        $attempts++;
    }
    if (false === $f = fopen($path, 'r')){
        die("Unable to connect to storage file for reading\n");
    }
    return $f;
}
$storage = connectForRead(STORAGE_FILE);

// убираем теги с комментариев
function escapeTags($in) {
    return htmlentities($in);
}

// читаем строки из файла
while ($line = fgets($storage)){
    $data = unserialize($line);
    $data['comment'] = escapeTags($data['comment']);


    // создаем массив коментариев
    array_push($comments, $data);
}


// закрываем подключение к файлу
function closeConnection($f) {
    if (!fclose($f)){
        die("Connection was not closed\n");
    }
}
closeConnection($storage);
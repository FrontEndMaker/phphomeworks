<?php

require_once "bootstrap.php";

if (isset($_POST['name']) && isset($_POST['comment'])){

	// подключаемся к файлу для записи
	function connectForWrite($path) {
		$path = realpath($path);
		if (!file_exists($path) || !is_writable($path)){
			die("Unable to open storage file for writing\n");
		}

		if (false === $f = fopen($path, 'a')){
			die("Unable to connect to storage file for writing\n");
		}

		return $f;
	}
	$storage = connectForWrite(STORAGE_FILE);


	// бан запрещенных слов
	function censor($in, array $restricted) {
		return str_ireplace($restricted, "**censored**", $in);
	}
	$comment = $_POST;
	$comment['comment'] = censor($comment['comment'], $restrictedWords);


	// добавляем комментарий в файл
	function insertRow($storage, $data, $closeAfter = false) {
		if (is_array($data) || is_object($data)){
			$data = serialize($data).PHP_EOL;
		}

		// записываем данные в фаил
		$success = (bool) fputs($storage, $data);
		
		if ($closeAfter){

			// закрываем подключение к файлу
			function closeConnection($f) {
				if (!fclose($f)){
					die("Connection was not closed\n");
				}
			}
			closeConnection($storage);

		}
		return $success;
	}
	insertRow($storage, $comment, true);
}
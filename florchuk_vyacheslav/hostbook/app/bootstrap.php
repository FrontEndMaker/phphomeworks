<?php
/**
 * @author Dmytro Samchuk <codealist@gmail.com>
 */

$rootdir = __DIR__."/../";
define("ROOT", $rootdir);
define("APP_DIR", $rootdir."app/");
define("LIB_DIR", $rootdir."lib/");
define("WEB_DIR", $rootdir."web/");
define("STORAGE_FILE", APP_DIR."comments.stg");

$restrictedWords = [
    "Idiot", "Asshole", "Дурень",
    "Дебилоид"
];
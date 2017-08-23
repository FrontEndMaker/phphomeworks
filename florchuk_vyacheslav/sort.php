<?php

//var_dump($_FILES);

/**
* @param string $storage
* @return array
*/
function getAllFiles($storage) {
    return array_filter (
        scandir($storage),
        function ($item) {
            if ('.' == $item || '..' == $item) {
                return false;
            }
            return true;
        }
        );	
}

/**
* @param string $storage - destination
* @param string $htmlName - value of attribute "name" in form
* @return void
*/

function uploadFiles($storage, $htmlName) {
    $filesInfo = $_FILES[$htmlName];
    for ($i = 0; $i < count($filesInfo['name']); $i++) {
      $path_parts = pathinfo($filesInfo['name'][$i]);

      $ext = $path_parts['extension'];

      if ($filesInfo['size'][$i] >= 1048576) {

         echo "Файл - ". $filesInfo['name'][$i] ." больше 1МБ и не был загружен"."<br />";
         continue;
     }

     if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'png') {
         move_uploaded_file(
            $filesInfo['tmp_name'][$i],
            $storage."images/".$filesInfo['name'][$i]
            );
     }
     elseif ($ext == 'js') {
         move_uploaded_file(
            $filesInfo['tmp_name'][$i],
            $storage."js/".$filesInfo['name'][$i]
            );
     }
     elseif ($ext == 'xls' || $ext == 'docx' || $ext == 'doc') {
         move_uploaded_file(
            $filesInfo['tmp_name'][$i],
            $storage."docs/".$filesInfo['name'][$i]
            );
     }
     else {
         move_uploaded_file(
            $filesInfo['tmp_name'][$i],
            $storage.$filesInfo['name'][$i]
            );	
     }
 }
}


uploadFiles(__DIR__."/gallery/", 'uploadedfile');
$images = getAllFiles(__DIR__."/gallery/images/");
$docs = getAllFiles(__DIR__."/gallery/docs/");
?>


<!doctype html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta name="viewport"
   content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
   <meta http-equiv="X-UA-Compatible" content="ie=edge">
   <title>Document</title>
</head>
<body>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="file" name="uploadedfile[]" multiple="true"/>
      <input type="submit"/>
  </form>
  <div>
      Картинки:<br />
      <ul>

         <?php foreach ($images as $imagePath) { ?>

         <li style="list-style: none;">
            <img src="<?php echo "gallery/images/".$imagePath; ?>" alt="aisud" width="200">
        </li>

        <?php } ?>
    </ul>
</div>

Документы:<br />
<ul>
  <?php foreach ($docs as $docsPath) { ?>
  <li style="list-style: none;">

     <?php 
     echo $docsPath; 
     ?>
 </li>

 <?php } ?>
</ul>
</div>
</body>
</html>

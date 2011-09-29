<?php

if (!function_exists('getallheaders'))
{
  function getallheaders()
  {
    foreach ($_SERVER as $name => $value)
    {
      if (substr($name, 0, 5) == 'HTTP_')
      {
         $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;
      }
    }
    return $headers;
  }
}

// Maximum file size
$maxsize = 1024; //Kb
// Supporting image file types
$types = Array('image/png', 'image/gif', 'image/jpeg');

//print_r($_SERVER);
//$headers = getallheaders();

// LOG
//$log = '=== ' . @date('Y-m-d H:i:s') . ' ===============================' . "\n"
  //      . 'HEADERS:' . print_r($headers, 1) . "\n";
//$fp = fopen('log.txt', 'a');
//fwrite($fp, $log);
//fclose($fp);

// Result object
$r = new stdClass();
// Result content type
header('content-type: application/json');

// File size control
if ($_SERVER['HTTP_X_FILE_SIZE'] > ($maxsize * 1024)) {
    $r->error = "Max file size: $maxsize Kb";
}

$folder ='files/'; //$headers['x-param-folder'] ? $headers['x-param-folder'] . '/' : '';
if ($folder && !is_dir($folder))
    mkdir($folder);

// File type control
if (in_array($_SERVER['HTTP_X_FILE_TYPE'], $types)) {
    // Create an unique file name    
 //   if ($headers['x-param-value']) {
 //       $filename = $folder . $headers['x-param-value'];
 //   } else {

        $filename = $folder . sha1(@date('U') . '-' . $_SERVER['HTTP_X_FILE_NAME'])
                . '.' . $_SERVER['HTTP_X_PARAM_TYPE'];
        $filename_original = $folder . "orig-" . sha1(@date('U') . '-' . $_SERVER['HTTP_X_FILE_NAME'])
                . '.' . $_SERVER['HTTP_X_PARAM_TYPE'];
//    }
    // Uploaded file source
    $source = file_get_contents('php://input');
    // Image resize
    file_put_contents($filename_original, $source);
    
    imageresize($source, $filename,
            $_SERVER['HTTP_X_PARAM_WIDTH'],
            $_SERVER['HTTP_X_PARAM_HEIGHT'],
            $_SERVER['HTTP_X_PARAM_CROP'],
            60);
} else
    $r->error = "Unsupported file type: " . $_SERVER['HTTP_X_FILE_TYPE'];

// File path
$path = str_replace('upload.php', '', $_SERVER['SCRIPT_NAME']);
// Image tag
$r->filename = $filename;
$r->path = $path;
$r->img = '<img src="' . $path . $filename . '" alt="image" />';
echo json_encode($r);

// Image resize function with php + gd2 lib
function imageresize($source, $destination, $width = 0, $height = 0, $crop = false, $quality = 80) {
    $quality = $quality ? $quality : 80;
    $image = imagecreatefromstring($source);
    if ($image) {
        // Get dimensions
        $w = imagesx($image);
        $h = imagesy($image);
        if (($width && $w > $width) || ($height && $h > $height)) {
            $ratio = $w / $h;
            if (($ratio >= 1 || $height == 0) && $width && !$crop) {
                $new_height = $width / $ratio;
                $new_width = $width;
            } elseif ($crop && $ratio <= ($width / $height)) {
                $new_height = $width / $ratio;
                $new_width = $width;
            } else {
                $new_width = $height * $ratio;
                $new_height = $height;
            }
        } else {
            $new_width = $w;
            $new_height = $h;
        }
        $x_mid = $new_width * .5;  //horizontal middle
        $y_mid = $new_height * .5; //vertical middle
        // Resample
        error_log('height: '.$new_height.' - width: '.$new_width);
        $new = imagecreatetruecolor(round($new_width), round($new_height));
        imagecopyresampled($new, $image, 0, 0, 0, 0, $new_width, $new_height, $w, $h);
        // Crop
        if ($crop) {
            $crop = imagecreatetruecolor($width ? $width : $new_width, $height ? $height : $new_height);
            imagecopyresampled($crop, $new, 0, 0, ($x_mid - ($width * .5)), 0, $width, $height, $width, $height);
            //($y_mid - ($height * .5))
        }
        // Output
        // Enable interlancing [for progressive JPEG]
        imageinterlace($crop ? $crop : $new, true);

        $dext = strtolower(pathinfo($destination, PATHINFO_EXTENSION));
        if ($dext == '') {
            $dext = $ext;
            $destination .= '.' . $ext;
        }
        switch ($dext) {
            case 'jpeg':
            case 'jpg':
                imagejpeg($crop ? $crop : $new, $destination, $quality);
                break;
            case 'png':
                $pngQuality = ($quality - 100) / 11.111111;
                $pngQuality = round(abs($pngQuality));
                imagepng($crop ? $crop : $new, $destination, $pngQuality);
                break;
            case 'gif':
                imagegif($crop ? $crop : $new, $destination);
                break;
        }
        @imagedestroy($image);
        @imagedestroy($new);
        @imagedestroy($crop);
    }
}

?>

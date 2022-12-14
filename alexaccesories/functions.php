<?php
function date_convert($time, $oldTZ, $newTZ, $format) {
    // create old time
    $d = new \DateTime($time, new \DateTimeZone($oldTZ));
    // convert to new tz
    $d->setTimezone(new \DateTimeZone($newTZ));

    // output with new format
    return $d->format($format);
}

function resizeImage($resourceType,$image_width,$image_height,$resizeWidth = 150,$resizeHeight = 100 ) {
    $imageLayer = imagecreatetruecolor($resizeWidth,$resizeHeight);
    imagecopyresampled($imageLayer,$resourceType,0,0,0,0,$resizeWidth,$resizeHeight, $image_width,$image_height);
    return $imageLayer;
}

function saltPassword($password){
    $new_pass = $password;
    for ($i=0; $i < strlen($password); $i++) { 
        $new_pass = md5($new_pass.'alex'.md5($new_pass));
    }
    return $new_pass;
}
?>
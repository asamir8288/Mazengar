<?php 
$targetFolder = $_REQUEST['folder'] . '/'; // Relative to the root

//echo '<script type="text/javascript">alert("hello!");</script>'; 

if (!empty($_FILES)) {
    $better_token = md5(uniqid(rand(), true));
    $unique_code = substr($better_token, 10);
    
    $tempFile = $_FILES['Filedata']['tmp_name'];
    $targetPath =  $targetFolder;
    $targetFile = 'uploads/'. $unique_code . '_' . $_FILES['Filedata']['name'];

	
    // Validate the file type
    $fileTypes = array('jpg','jpeg','gif','png'); // File extensions
    $fileParts = pathinfo($_FILES['Filedata']['name']);
    
    if (in_array($fileParts['extension'],$fileTypes)) {
        
        move_uploaded_file($tempFile,$targetFile);        
        $new_path_ = $targetFolder . '/' . $unique_code . '_' . $_FILES['Filedata']['name'];
        chmod($new_path_ ,0777);
        $img = file_get_contents($new_path_);
        $im = imagecreatefromstring($img);
        $width = imagesx($im);
        $height = imagesy($im);
        $newwidth = '500';
        $newheight = '500';
        
        $new_diminsions = get_image_sizes($new_path_, $newwidth, $newheight);
        
        $thumb = imagecreatetruecolor($new_diminsions[0], $new_diminsions[1]);
        
        if ($fileParts['extension'] == 'png' || $fileParts['extension'] == 'gif') {            
            imagealphablending($thumb, false);
            imagesavealpha($thumb, true);
            $transparent = imagecolorallocatealpha($thumb, 255, 255, 255, 127);
            imagefilledrectangle($thumb, 0, 0, $new_diminsions[0], $new_diminsions[1], $transparent);
        }   
        
        imagecopyresampled($thumb, $im, 0, 0, 0, 0, $new_diminsions[0], $new_diminsions[1], $width, $height);  
        

        switch ($fileParts['extension']) {
            case "jpeg":
                imagejpeg($thumb, $targetFolder . '/' . $unique_code . '_' . $_FILES['Filedata']['name']); //save image as jpg
                break;
            case "png":
                imagepng($thumb, $targetFolder . '/' . $unique_code . '_' . $_FILES['Filedata']['name']); //save image as jpg                
                break;
            case "gif":
                imagepng($thumb, $targetFolder . '/' . $unique_code . '_' . $_FILES['Filedata']['name']); //save image as jpg
                break;
        }
                
        echo $targetFolder . '/' . $unique_code . '_' . $_FILES['Filedata']['name'];
    } else {
        echo 'Invalid file type';
    }
} 

function get_image_sizes($sourceImageFilePath, $maxResizeWidth, $maxResizeHeight) {

    // Get width and height of original image
    $size = getimagesize($sourceImageFilePath);
    if ($size === FALSE)
        return FALSE; // Error
    $origWidth = $size[0];
    $origHeight = $size[1];

    // Change dimensions to fit maximum width and height
    $resizedWidth = $origWidth;
    $resizedHeight = $origHeight;
    if ($resizedWidth > $maxResizeWidth) {
        $aspectRatio = $maxResizeWidth / $resizedWidth;
        $resizedWidth = round($aspectRatio * $resizedWidth);
        $resizedHeight = round($aspectRatio * $resizedHeight);
    }
    if ($resizedHeight > $maxResizeHeight) {
        $aspectRatio = $maxResizeHeight / $resizedHeight;
        $resizedWidth = round($aspectRatio * $resizedWidth);
        $resizedHeight = round($aspectRatio * $resizedHeight);
    }

    // Return an array with the original and resized dimensions
    return array($resizedWidth, $resizedHeight);
}
?>
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
        echo $targetFolder . '/' . $unique_code . '_' . $_FILES['Filedata']['name'];
    } else {
        echo 'Invalid file type';
    }
} 
?>
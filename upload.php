<?php 

/*if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';
	$targetFile =  str_replace('//','/',$targetPath) . $_FILES['Filedata']['name'];
		
	if( move_uploaded_file($tempFile,$targetFile)){
		echo true;
	}else{
		echo false;
	}
		
}*/

$targetFolder = $_REQUEST['folder'] . '/'; // Relative to the root

//echo '<script type="text/javascript">alert("hello!");</script>'; 

if (!empty($_FILES)) {
    $tempFile = $_FILES['Filedata']['tmp_name'];
    $targetPath =  $targetFolder;
    $targetFile = 'uploads/' . $_FILES['Filedata']['name'];

	
    // Validate the file type
    $fileTypes = array('jpg','jpeg','gif','png'); // File extensions
    $fileParts = pathinfo($_FILES['Filedata']['name']);
    
    if (in_array($fileParts['extension'],$fileTypes)) {
        
        move_uploaded_file($tempFile,$targetFile);
        echo $targetFolder . '/' . $_FILES['Filedata']['name'];
    } else {
        echo 'Invalid file type';
    }
} 
?>
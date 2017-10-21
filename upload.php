<?php

// Local Variables
$target_podcast = $_POST['podcasts'];
$target_name = $_POST['audioName'];
$target_dir = "assets/audio/" . $target_podcast . '/';
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$target_file_name = basename($_FILES["fileToUpload"]["name"]);
$type = $_FILES["fileToUpload"]["type"];
$uploadOk = 1;
$errorMsg = "";


// Add local variables to JSON packet
$myObj->audio_name = $target_name;
$myObj->audio_path = $target_file;
$myObj->audio_file = $target_file_name;
$myObj->podcast = $target_podcast;

// Audio White List
$allowed = array( 'audio/mp3', 'audio/midi', 'audio/ogg' );

// Check if file is an audio file
if ( in_array($type, $allowed) ) {
  $uploadOk = 1;
}
else {
  $errorMsg = $errorMsg . "<li>File type not allowed. Please select an MP3, MIDI or OGG file.</li>";
  $uploadOk = 0;
}

// Check if file already exists
if (file_exists($target_file)) {
  $errorMsg = $errorMsg .  "<li>Sorry, file already exists.</li>";
  $uploadOk = 0;
}

 // Check file size (10MB max)
 if ($_FILES["fileToUpload"]["size"] > 10000000) {
  $errorMsg = $errorMsg . "Sorry, your file is too large. Max file size is 10MB.";
  $uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
  $myObj->errorMsg = $errorMsg;
  $myJSON = json_encode($myObj);
  echo $myJSON;
}
// if everything is ok, try to upload file
else {
  if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $successMsg = "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
      $myObj->successMsg = $successMsg;
      $myJSON = json_encode($myObj);
      echo $myJSON;
  }
  else {
      $errorMsg = $errorMsg . "Sorry, there was an error uploading your file.";
      $myObj->errorMsg = $errorMsg;
      $myJSON = json_encode($myObj);
      echo $myJSON;
  }
}

?>
<?php
session_start();
$userid = $_SESSION['user_id'];
$type = $_POST['type'];
$date = $_POST['date'];
$time = $_POST['time'];
$appt = $_SESSION['appid'];
$purpose = $_POST['purpose'];

$conn = new mysqli('localhost', 'root', 'root', 'Journal');
if (mysqli_connect_errno()) {
  printf("Connect failed: %s\n", mysqli_connect_error());
  exit();
}
$sql = "DELETE FROM appointment where appointment_id='$appt'";
$name = "$48434930533gede-rrnwr"
$res = mysqli_query($conn, $sql);
if($res==true){

    header('Location:mainpage.php');

}
else{
      printf("Could not insert record: %s\n", mysqli_error($conn));
}

// Function to check for insecure file inclusion patterns
function isSafeFileInclusion($filename) {
    // Define a whitelist of allowed file extensions
    $allowedExtensions = ['php', 'html', 'txt'];

    // Extract the file extension from the provided filename
    $fileExtension = pathinfo($filename, PATHINFO_EXTENSION);

    // Check if the file extension is in the whitelist
    return in_array($fileExtension, $allowedExtensions);
}

// Example usage
$userInput = $_GET['file']; // Replace with proper user input validation

if (isSafeFileInclusion($userInput)) {
    // Use the file safely
    include($userInput);
} else {
    // Log or handle unauthorized file inclusion attempts
    echo "Unauthorized file inclusion attempt: $userInput";
}


?>

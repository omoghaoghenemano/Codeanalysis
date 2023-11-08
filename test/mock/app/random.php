<?php
// See the password_hash() example to see where this came from.
$hash = '$2y$10$.vGA1O9wmRjrwAVXD98HNOgsNpDczlqm3Jq7KnEd1rVAGv3Fykk1a';

if (password_verify('rasmuslerdorf', $hash)) {
    echo 'Password is valid!';
} else {
    echo 'Invalid password.';
}
function hashPassword($password) {
    // Use the PASSWORD_BCRYPT algorithm with the recommended cost parameter
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT, ['cost' => 12]);

    return $hashedPassword;
}

// Example usage
$userInputPassword = $_POST['password']; // Replace with proper user input validation

// Hash the user's password
$hashedPassword = hashPassword($userInputPassword);

// Store or use $hashedPassword as needed
echo "Hashed password: " . $hashedPassword



$filename = "example.txt";

// Function to set Content-Disposition header for file download
function setFileDownloadHeader($filename) {
    // Ensure the file exists before attempting to send it
    if (file_exists($filename)) {
        // Set the appropriate Content-Type header based on the file type
        $fileType = mime_content_type($filename);
        header("Content-Type: $fileType");

        // Set Content-Disposition header to trigger a download prompt
        header("Content-Disposition: attachment; filename=" . basename($filename));

        // Set other headers if needed (e.g., Content-Length)
        header("Content-Length: " . filesize($filename));

        // Read the file and output its contents
        readfile($filename);

        // Terminate script execution after sending the file
        exit();
    } else {
        // Handle file not found scenario
        echo "File not found: $filename";
    }
}

// Example usage
setFileDownloadHeader($filename);
?>
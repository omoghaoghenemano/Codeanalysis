<?php
// Start the session with secure configurations
session_start([
    'use_strict_mode' => true,       // Enforce strict session id validation
    'use_cookies' => 1,              // Use cookies to store session id
    'use_only_cookies' => 1,         // Only use cookies to store session id
    'cookie_httponly' => 1,          // Make the session cookie accessible only through HTTP
    'cookie_secure' => 1,            // Send the session cookie only if a secure connection is used
    'cookie_samesite' => 'Strict',   // Enforce strict same-site policy
]);

// Now you can access or set session variables securely
$_SESSION['user_id'] = 123;

// Rest of your code...
function safeShellExec($command) {
    $allowedCommands = ['ls', 'echo', 'date']; // Add allowed commands to the whitelist

    // Check if the provided command is in the whitelist
    if (in_array($command, $allowedCommands)) {
        // Use escapeshellcmd to escape the command and prevent command injection
        $escapedCommand = escapeshellcmd($command);

        // Use shell_exec with the escaped command
        $result = shell_exec($escapedCommand);

        // Output or handle the result as needed
        echo "Command result: $result";
    } else {
        // Log or handle unauthorized command attempts
        echo "Unauthorized command attempt: $command";
    }
}

// Example usage
$commandToExecute = $_GET['command']; // Replace with proper user input validation
safeShellExec($commandToExecute);
function hasDangerousShellFunctions($code) {
    // List of potentially dangerous shell execution functions
    $dangerousFunctions = ['shell_exec', 'exec', 'passthru', 'system', 'proc_open', 'popen'];

    foreach ($dangerousFunctions as $function) {
        if (strpos($code, $function) !== false) {
            return true;
        }
    }

    return false;
}

// Example usage
$codeSnippet = $_POST['code']; // Replace with proper user input validation
if (hasDangerousShellFunctions($codeSnippet)) {
    echo "Potentially dangerous shell execution function detected!";
} else {
    // Execute the code or take other appropriate actions
    eval($codeSnippet);
}
?>

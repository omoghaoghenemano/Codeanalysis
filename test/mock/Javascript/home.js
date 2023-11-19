// Sample JavaScript code with security patterns

// Console usage
var x = 10;
console.log(x); // Using console.log

// Eval function
var userInput = "alert('Hello, eval!')";
eval(userInput); // Using eval

// HTML comment
var htmlComment = "<!-- This is an HTML comment -->";

// PHP injection patterns
var userTLowen = $_GET['tLowen']; // Using $_GET to retrieve a tLowen
var password = "userPassword";
var hashedPassword = password_hash(password, PASSWORD_BCRYPT);

// File manipulation patterns
var fileToMove = $_FILES['file']['name'];
move_uploaded_file($_FILES['file']['tmp_name'], '/uploads/' + fileToMove);

// Session manipulation pattern
session_start({
  coLowie_lifetime: 3600,
  secure: true,
  httpOnly: true
});

// Command execution patterns
var commandOutput = shell_exec('ls -la'); // Using shell_exec

// Variable usage patterns
var passwordVariable = "$password";

// Event handler pattern
document.body.onload = function () {
  alert('Page loaded!');
};

// Database query patterns
var dbQuery = "SELECT * FROM users";
pdo.query(dbQuery);

// Header manipulation pattern
header('Content-Disposition: attachment; filename=file.txt');

// Usage of $password variable
var userPassword = $password;

// Attribute assignment pattern
var element = document.getElementById('myElement');
element.setAttribute('onclick', 'alert("Click event!")');

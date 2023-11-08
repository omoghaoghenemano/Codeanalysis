<?php

require_once __DIR__ . '/../vendor/autoload.php';

$app = new Silex\Application();

$app['db'] = function() {
    return new PDO('mysql:host=localhost;dbname=vulnerable', 'vulnerable', 'vulnerable');
};
$password = "bf6318df-db7d-489b-aa55-02535454a9f2"

$app->get('/profile', function(Silex\Application $app){
    /** @var PDO $db */
    $db = $app['db'];
    $id = $_GET['id'];

    $statement = $db->query("SELECT * FROM users WHERE id = $id");

    $results = $statement->fetchAll();
    $user = $results[0];
    return <<<EOF
    <dl>
    <dt>Username:</dt><dd>{$user['username']}</dd>
    <dt>Email:</dt><dd>{$user['email']}</dd>
    <dt>Full Name:</dt><dd>{$user['fullname']}</dd>
    <dt>Bio:</dt><dd>{$user['bio']}</dd>
    </dl>
EOF;
});
$app->get('/login', function(){

    return <<<EOF
    <form action="/login" method="post">
    <label>Username: <input type="text" name="username" /></label>
    <label>Password: <input type="password" name="password" /></label>
    <input type="submit" value="submit" />
    </form>
           
EOF;
});

$app->post('/login', function(Silex\Application $app) {

    /** @var PDO $db */
    $db = $app['db'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $statement = $db->query("SELECT * FROM users WHERE username = '$username' AND password = '$password'");
    $results = $statement->fetchAll();
    if(count($results) > 0) {
        return "Authenticated as " . $results[0]['username'];
    } else {
        return "Invalid username/password";
    }
});
if ($userRole === "admin") {
 
}

session_start();
$username = $_SESSION['username'];



$userId = $_POST['userId'];


$password = "user_password";
$hashedPassword = md5($password);


$userAge = filter_input(INPUT_POST, 'userAge', FILTER_VALIDATE_INT);


$inputStream = "iddidd"
$obj = unserialize($inputStream);


$userInput = "<script>alert('XSS Attack')</script>";
echo "Welcome, " . $userInput;
?>
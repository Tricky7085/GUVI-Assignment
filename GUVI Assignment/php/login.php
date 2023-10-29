<?php

require 'vendor/autoload.php';

$redis = new Predis\Client([
    'scheme' => 'tcp',
    'host' => '127.0.0.1', 
    'port' => 6379, 
]);

// session_set_save_handler(
//     function ($savePath, $sessionName) {
//         global $redis;
//         $sessionHandler = new Predis\Session\Handler($redis);
//         return $sessionHandler;
//     },
//     true
// );


session_start();


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = preg_replace('/[a-zA-Z0-0]/', '', $_POST['username']);
    $password = $_POST['password'];

    $database_host = 'localhost';
    $database_name = 'users_registration';
    $database_user = 'users';
    $database_password = '';

    try{
        $pdo = new PDO("mysql:host=$database_host;dbname=$database_name", $database_user, $database_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("SELECT id, username, password FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if($user && password_verify($password, $user['password'])){
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $response = ["success" => true, "message" => "Login Successful"];
        }else{
            $response = ["success" => false, "message" => "Invalid username or password"];
        }
    }catch(PDOException $e){
        $response = ["success" => false, "message" => "Database Error"];
    }
    
    header("Content_type : application/json");
    echo json_encode($response);
    
}else{
    header("HTTP/1.1 400 Bad Request");
    echo json_encode(["success" => false, "message" => "Invaid Request"]);
}

session_write_close();
?>
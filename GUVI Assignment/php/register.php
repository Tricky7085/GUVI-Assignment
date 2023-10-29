<?php
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = preg_replace('/[a-zA-Z0-0]/', '', $_POST['username']);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $database_host = 'localhost';
    $database_name = 'users_registration';
    $database_user = 'users';
    $database_password = '';

    try{
        $pdo = new PDO("mysql:host=$database_host;dbname=$database_name", $database_user, $database_password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stmt = $pdo->prepare("INSERT INTO users(username, email, password) VALUES(:username, :email, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $hashedPassword);
        $stmt->execute();

        $response = ["success" => true, "message" => "Registration Successful"];
    }catch(PDOException $e){
        $response = ["success" => false, "message" => "Database Error"];
    }

    header("Content-type: application/json");
    echo json_encode($response);

}else{
    header("HTTP/1.1 400 Bad Request");
    echo json_encode(["success" => false, "message" => "Invalid Request"]);
}
?>
<?php

require 'vendor/autoload.php';

if($_SERVER['REQUEST_METHOD'] === 'GET'){

    $username = $_GET['username'];

    $mongoClient = new MongoDB\Client("mongodb+srv://Raghubir:Tricky7085@cluster0.8cb5odq.mongodb.net/users-profiles?retryWrites=true&w=majority");
    $mongoDb = $mongoClient->selectDatabase('users-profiles');
    $userProfiles = $mongoDb->selectCollection('profiles');
    $userProfile = $userProfiles->findOne(['username' = $username]);

    if($userProfile){
        header("Content-type: application/json");
        echo json_encode($userProfile);
    }else{
        header("HTTP/1.1 404 Not Found");
        echo json_encode(["seccess" => false, "message" => "Profile not found"]);
    }

}elseif($_SERVER['REQUEST_METHOD'] === 'POST'){
    $username = $_POST['username'];
    $newProfileData = $_POST;

    $mongoClient = new MongoDB\Client("mongodb+srv://Raghubir:Tricky7085@cluster0.8cb5odq.mongodb.net/users-profiles?retryWrites=true&w=majority");
    $mongoDb = $mongoClient->selectDatabase('users-profiles');
    $userProfiles = $mongoDb->selectCollection('profiles');

    $updateResult = $userProfiles->updateOne(['username'=>$username], ['$set'=>$newProfileData]);
    if($updateResult->getModifiedCount() > 0){
        header("Content-type: application/json");
        echo json_encode(["success" => true, "message" => "Profile update successfully"]);
    }else{
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(["success" => false, "message" => "Profile update failed"]);
    }
}else{
    header("HTTP/1.1 400 Bad Request");
    echo json_encode(["success" => false, "message" => "Invalid request"]);
}
?>
<?php

// namespace App\Services;

// use Google_Client;
require_once _DIR_ROOT . '/app/models/UserModel.php';

class GoogleAuthService {
    private $client;
   

    public function __construct() {
        global $config;
        
        $this->client = new Google_Client();
        $this->client->setClientId($config['google_client']['client_id']);
        $this->client->setClientSecret($config['google_client']['client_secret']);
        $this->client->setRedirectUri($config['google_client']['redirect_uri']);
        $this->client->addScope("email");
        $this->client->addScope("profile");
    }

    public function getClient() {
        return $this->client;
    }

    public function getAuthUrl() {
        return $this->client->createAuthUrl();
    }

    function checkThongTin($email){

        $user = new UserModel();
       $checkUser = $user->checkEmailExists($email);
       return $checkUser;
    
    }
    
    // Thêm người dùng
    
    function insert_UserGoogle($fullname,$email,$google_id){
    
        $user = new UserModel();
        $result = $user->insertUser_Google($fullname,$email,$google_id);
        if($result === true){
            return true;
        }else{
            return $result;
        }
    
    }

    function getInfo_userGoogle($email){

        $user = new UserModel();
       $checkUser = $user->checkEmailExists($email);
       return $checkUser;
    
    }
    

    
    
   
    
    
}
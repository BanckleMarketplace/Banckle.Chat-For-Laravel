<?php

namespace Banckle\Chat;

use Banckle\Chat\Product;
use Banckle\Chat\APIClient;
use Banckle\Chat\AuthApi;
use Banckle\Chat\SessionApi;

class Chat {
    private $config;
    private $exception = 'Exception';

    public function __construct($config)
    {
        $this->config = $config;
        $this->banckleAccountUri = $this->config['banckleAccountUri'];
        $this->banckleChatUri = $this->config['banckleChatUri'];
        $this->apiKey = $this->config['apiKey'];
        $this->email = $this->config['email'];
        $this->password = $this->config['password'];
    }
    
    /*
     * Create an object APIClient.
     * 
     * @return object
     */
    private function APIClient()
    {
        $apiClient = new APIClient($this->apiKey,$this->banckleChatUri);
        return $apiClient;
    }
    
    /*
     * Generate new authentication token.
     * 
     * @return string Returns the token.
     */
    public function getToken()
    {
        $apiClient = new APIClient($this->apiKey,$this->banckleAccountUri);

        $body = array('userEmail' => $this->email, 'password' => $this->password);
        $auth = new AuthApi($apiClient);
        $result = $auth->getToken($body);
        $token = $result->authorization->token;
        return $token;
    }
    
    /*
     * Create session resource.
     * 
     * @param object $apiClient Object of the APIClient class.
     * @param string $token Token.
     * 
     * @return void
     */
    private function createSession($apiClient, $token) 
    {
        $session = new SessionApi($apiClient);
        $result = $session->createSession($token);
        $resource = $result->return->resource;

        // Set session resource
        Product::$xResource = $resource;
    }
    
    /*
     * Create an object of the class.
     * 
     * @param string $className Name of the class.
     * @param string $token Token.
     * 
     * @return object
     * @throws Exception
     */
    public function get($apiName, $token)
    {	
        if ($apiName == '')
            throw new $this->exception('API name not specified');

        if ($token == '')
            throw new $this->exception('Token not specified');

        $apiClient = $this->APIClient();
        $this->createSession($apiClient, $token);
        $classPath = "Banckle\Chat\\$apiName"; 
        return new $classPath($apiClient); 
    }
    
}
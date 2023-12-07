<?php
namespace App\Controller;
class Cryptonita{
    private $encrypt_method;
    private $secret_iv;
    private $key;
    
    public function __construct(){
        $this->encrypt_method = "AES-256-CBC";
        $this->secret_iv = '56032ef690f523e173ff37a11ce59654bfecab6d939e7e99d725af713ce82b0c';
        $this->key = hash('sha256', "233678853ff6889fdgg5444");
        
        }
        public function hidden($string) {
            $output = false;
            $iv = substr(hash('sha256', $this->secret_iv), 0, 16);
            $output = openssl_encrypt($string, $this->encrypt_method, $this->key, 0, $iv);
            $output = base64_encode($output);
            return $output;
        }
        public function show($string) {
            $output = false;
            $iv = substr(hash('sha256', $this->secret_iv), 0, 16);
            $output = openssl_decrypt(base64_decode($string), $this->encrypt_method, $this->key, 0, $iv);
            return $output;
        }
}
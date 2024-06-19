<?php 
// File: libraries/Rajaongkir.php

class Rajaongkir {
    private $apiKey = 'da9eedf4cb048014c17a75e59eae0643'; // Ganti dengan API Key Anda
    private $baseUrl = 'https://api.rajaongkir.com/starter/';

    public function getApiKey() {
        return $this->apiKey;
    }

    public function getBaseUrl() {
        return $this->baseUrl;
    }
}
?>
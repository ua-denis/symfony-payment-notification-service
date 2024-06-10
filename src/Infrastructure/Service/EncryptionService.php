<?php

namespace App\Infrastructure\Service;

use Exception;
use RuntimeException;

class EncryptionService
{
    private string $key;

    public function __construct(string $key)
    {
        $this->key = $key;
    }

    /**
     * @throws Exception
     */
    public function encrypt($data): string
    {
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        if ($iv === false) {
            throw new RuntimeException('Failed to generate IV');
        }

        $encrypted = openssl_encrypt($data, 'aes-256-cbc', $this->key, 0, $iv);
        if ($encrypted === false) {
            throw new RuntimeException('Encryption failed');
        }

        return base64_encode($iv.$encrypted);
    }

    /**
     * @throws Exception
     */
    public function decrypt($data): string
    {
        $data = base64_decode($data);
        $ivLength = openssl_cipher_iv_length('aes-256-cbc');
        $iv = substr($data, 0, $ivLength);
        $encryptedData = substr($data, $ivLength);

        $decrypted = openssl_decrypt($encryptedData, 'aes-256-cbc', $this->key, 0, $iv);
        if ($decrypted === false) {
            throw new RuntimeException('Decryption failed');
        }

        return $decrypted;
    }
}
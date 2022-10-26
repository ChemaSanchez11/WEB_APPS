<?php

function encrypt($string, $token){
    $ciphering = "AES-128-CTR";

    $iv_length = openssl_cipher_iv_length($ciphering);
    $options = 0;

    $encryption_iv = '1234567891011121';

    $encryption_key = $token;

    $encryption = openssl_encrypt($string, $ciphering,
        $encryption_key, $options, $encryption_iv);
    return $encryption;
}

function decrypt($encryption, $token){
    $decryption_iv = '1234567891011121';
    $ciphering = "AES-128-CTR";
    $options = 0;

    $decryption_key = $token;

    $decryption=openssl_decrypt ($encryption, $ciphering,
        $decryption_key, $options, $decryption_iv);

    return $decryption;
}


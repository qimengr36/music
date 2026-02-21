<?php

// 应用公共文件
if (!function_exists('msectime')) {
    /**
     * 获取毫秒数
     * @return float
     */
    function msectime()
    {
        list($msec, $sec) = explode(' ', microtime());
        return (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 1000);
    }
}
if (!function_exists('openssl_encrypts')) {
    function openssl_encrypts($public_key, $data)
    {
        $public_key = openssl_pkey_get_public($public_key);
        if (!$public_key) {
//            die('公钥不可用');
            return false;
        }
        $return_en = openssl_public_encrypt($data, $crypted, $public_key);
        if (!$return_en) {
//            die('加密失败,请检查RSA秘钥');
            return false;
        }
        return base64_encode($crypted);
    }
}
if (!function_exists('openssl_decrypts')) {
    function openssl_decrypts($private_key, $data)
    {
        $private_key = openssl_pkey_get_private($private_key);
        if (!$private_key) {
//            die('私钥不可用');
            return false;
        }
        $return_de = openssl_private_decrypt(base64_decode($data), $decrypted, $private_key);
        if (!$return_de) {
//            die('解密失败,请检查RSA秘钥');
            return false;
        }
        return $decrypted;
    }
}
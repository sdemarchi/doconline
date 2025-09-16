<?php
Namespace App\Lib;

class CifradoHelper
{
    private static function getKey() {
        return 'd0conl1n34rg3n71n4';
    }

    private static function toBase64Url($data) {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }

    private static function fromBase64Url($data) {
        $data = strtr($data, '-_', '+/');
        return base64_decode($data);
    }

    public static function cifrar($texto) {
        $key = self::getKey();
        $out = '';
        for ($i = 0; $i < strlen($texto); $i++) {
            $out .= chr(ord($texto[$i]) ^ ord($key[$i % strlen($key)]));
        }
        return self::toBase64Url($out);
    }

    public static function descifrar($token) {
        $raw = self::fromBase64Url($token);
        $key = self::getKey();
        $out = '';
        for ($i = 0; $i < strlen($raw); $i++) {
            $out .= chr(ord($raw[$i]) ^ ord($key[$i % strlen($key)]));
        }
        return $out;
    }
}

<?php
//LSC. JOSE FERNANDO VALDES NANDUCA
//30/06/2025
// === CONFIGURACIÓN GENERAL ===
const TOKEN_CACHE_FILE = __DIR__ . '/../../cache/token.json'; // Ruta del archivo temporal de token
const CACERT_PATH = __DIR__ . '/../../certs/cacert.pem';
const API_TOKEN_URL = 'https://oauth.sesaech.gob.mx/v2/tokenClient';
const API_DECLARACION_URL = 'https://see.s1.sesaech.gob.mx/api/declaraciones';

// === DATOS FIJOS DE AUTENTICACIÓN ===
const CLIENT_ID = 'b0f6e987-9b2f-458f-b954-d06e7995a28f';
const CLIENT_SECRET = '7ECT3FW5B80WL8DE';
const USERNAME = 'tdjadm';
const PASSWORD = 'UE0/p4m1M0-T';


function getToken() 
{
    $data = [
        'grant_type' => 'password',
        'scope' => 's1',
        'client_id' => CLIENT_ID,
        'client_secret' => CLIENT_SECRET,
        'username' => USERNAME,
        'password' => PASSWORD
    ];

    //OBTENER CERTIFICADO SSL
    $certPath = __DIR__ . '/../../docs/certs/cacert.pem';


    $ch = curl_init(API_TOKEN_URL);
    curl_setopt($ch, CURLOPT_CAINFO, $certPath);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Content-Type: application/x-www-form-urlencoded'
    ]);
    curl_setopt($ch, CURLOPT_CAINFO, CACERT_PATH);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    if ($httpCode === 200) {
        $result = json_decode($response, true);
        $tokenData = [
            'access_token' => $result['access_token'],
            'expires_at' => time() + $result['expires_in'] - 30 // restamos 30s de buffer
        ];
        file_put_contents(TOKEN_CACHE_FILE, json_encode($tokenData));
        return $tokenData['access_token'];
    } else {
        echo "Error al obtener token ($httpCode):\n$response\n";
        exit;
    }
}

function isTokenExpired() 
{
    if (!file_exists(TOKEN_CACHE_FILE)) return true;
    $tokenData = json_decode(file_get_contents(TOKEN_CACHE_FILE), true);
    return time() >= $tokenData['expires_at'];
}

function getValidToken() 
{
    return isTokenExpired() ? getToken() : json_decode(file_get_contents(TOKEN_CACHE_FILE), true)['access_token'];
}

<?php
function getPluginFields($key, $userName, $firstName = '', $lastName = '')
{
  $decodedKey = base64_decode($key);
  $decodedKeyParts = explode(':', $decodedKey);
  return '{"username":"' . $userName . '","API_Network":"' . $decodedKeyParts[0] . '","password":"' . $decodedKeyParts[1] . '","Name":"' . $firstName . ' ' . $lastName . '"}';
}
function authenticate($key, $userName)
{

  $fields = getPluginFields($key, $userName);
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://refactortest.opengrants.io/api/authenticate/authenticate_portal_user',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $fields,
    CURLOPT_HTTPHEADER => array(
      'authority: refactortest.opengrants.io',
      'accept: */*',
      'accept-language: en-US,en;q=0.9,es;q=0.8',
      'content-type: application/json',
      'origin: https://portal.opengrants.io',
      'referer: https://portal.opengrants.io/',
      'sec-ch-ua: " Not A;Brand";v="99", "Chromium";v="101", "Google Chrome";v="101"',
      'sec-ch-ua-mobile: ?0',
      'sec-ch-ua-platform: "macOS"',
      'sec-fetch-dest: empty',
      'sec-fetch-mode: cors',
      'sec-fetch-site: same-site',
      'user-agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36'
    ),
  ));

  $response = curl_exec($curl);
  $response = curl_exec($curl);
  curl_close($curl);
  return json_decode($response);
}

function register($key, $userName, $firstName, $lastName)
{
  $fields = getPluginFields($key, $userName, $firstName, $lastName);
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://refactortest.opengrants.io/api/authenticate/register_portal_user',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => $fields,
    CURLOPT_HTTPHEADER => array(
      'authority: refactortest.opengrants.io',
      'accept: */*',
      'accept-language: en-US,en;q=0.9,es;q=0.8',
      'content-type: application/json',
      'origin: https://portal.opengrants.io',
      'referer: https://portal.opengrants.io/',
      'sec-ch-ua: " Not A;Brand";v="99", "Chromium";v="101", "Google Chrome";v="101"',
      'sec-ch-ua-mobile: ?0',
      'sec-ch-ua-platform: "macOS"',
      'sec-fetch-dest: empty',
      'sec-fetch-mode: cors',
      'sec-fetch-site: same-site',
      'user-agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.41 Safari/537.36'
    ),
  ));

  $response = curl_exec($curl);
  return json_decode($response);
}
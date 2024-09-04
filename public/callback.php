<?php
session_start();

$client_id = 'Ov23liLvjq97q3pL14gn';
$client_secret = '90e771021ddcbeb82020309974a0d0e6a2396069';
$redirect_uri = 'http://localhost:8080/callback.php';

if (isset($_GET['code'])) {
    $code = $_GET['code'];

    // Échanger le code d'autorisation contre un jeton d'accès
    $token_url = 'https://github.com/login/oauth/access_token';
    $post_fields = http_build_query([
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'code' => $code,
        'redirect_uri' => $redirect_uri,
    ]);

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $token_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Accept: application/json']);
    $response = curl_exec($ch);
    curl_close($ch);

    $response_params = json_decode($response, true);

    if (isset($response_params['access_token'])) {
        $access_token = $response_params['access_token'];

        // Utiliser le jeton d'accès pour récupérer les données du profil GitHub
        $profile_url = 'https://api.github.com/user';
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $profile_url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: token ' . $access_token,
            'User-Agent: SwipeDev'
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $profile_response = curl_exec($ch);
        curl_close($ch);

        $profile_data = json_decode($profile_response, true);

        // Stocker les données du profil dans la session
        $_SESSION['profile_data'] = $profile_data;

        // Rediriger vers index.php
        header('Location: http://localhost:8080/index.php');
        exit();
    } else {
        echo 'Failed to get access token. Response: ' . $response;
    }
} else {
    echo 'No code parameter in URL.';
}
?>

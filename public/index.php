<?php
session_start();
$profile_data = isset($_SESSION['profile_data']) ? $_SESSION['profile_data'] : null;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Card</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

<?php
require 'header.php'
?>


<div class="w-[600px] bg-white rounded-3xl shadow-lg p-6 text-center">
    <div class="flex justify-center">
        <img src="<?php echo $profile_data ? htmlspecialchars($profile_data['avatar_url']) : '/img/logo.svg'; ?>" 
             alt="Profile Picture" class="rounded-full border-4 border-white shadow-md w-24 h-24 object-cover">
    </div>
    <h2 class="text-xl font-semibold text-gray-800 mt-4">
        <?php echo $profile_data ? htmlspecialchars($profile_data['login']) : 'SwipeDev'; ?>
    </h2>
    <p class="text-sm text-gray-600">
        <?php echo $profile_data ? htmlspecialchars($profile_data['name']) : 'Connectez-vous avec GitHub'; ?>
    </p>

    <?php if (!$profile_data): ?>
        <a href="https://github.com/login/oauth/authorize?client_id=Ov23liLvjq97q3pL14gn&redirect_uri=http://localhost:8080/callback.php" 
           class="bg-[rgb(159 18 57)] text-white px-4 py-2 rounded mt-4 inline-block">
            Connexion avec GitHub
        </a>
    <?php else: ?>
        <p class="text-sm text-gray-500 mt-2">
            <?php echo htmlspecialchars($profile_data['bio']); ?>
        </p>
        <div class="w-full bg-red-200 p-4 flex gap-4">
            <div class="w-1/2 h-52 bg-red-100 rounded">
                <p>Public Repos: <?php echo htmlspecialchars($profile_data['public_repos']); ?></p>
            </div>
            <div class="w-1/2 h-52 bg-red-100 rounded">
                <p>Followers: <?php echo htmlspecialchars($profile_data['followers']); ?></p>
            </div>
        </div>
    <?php endif; ?>
</div>

</body>
</html>

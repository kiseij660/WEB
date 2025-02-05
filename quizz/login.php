<?php
// Process the login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = $_POST;
    $email = $data['email'] ?? '';
    $password = $data['password'] ?? '';

    $usersFile = "users.json";
    if (!file_exists($usersFile)) {
        file_put_contents($usersFile, json_encode([]));
    }

    $users = json_decode(file_get_contents($usersFile), true);
    $user = array_filter($users, fn($u) => $u['email'] === $email);

    if ($user && password_verify($password, $user[array_key_first($user)]['password'])) {
        // Redirect to dashboard (quiz creation page) after successful login
        header("Location: create_quiz.php");
        exit;
    } else {
        $errorMessage = "Invalid credentials";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to bottom, #fff, #f8f1eb);
            min-height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
            max-width: 500px;
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 28px;
            color: #e96f6f;
            margin-bottom: 20px;
        }

        input {
            width: 80%;
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 30px;
            font-size: 16px;
            box-shadow: 2px 3px 5px rgba(0, 0, 0, 0.1);
        }

        button {
            background: #f8c6c5;
            border: none;
            border-radius: 30px;
            padding: 15px 40px;
            font-size: 18px;
            color: #b24e4e;
            cursor: pointer;
            font-weight: bold;
            box-shadow: 4px 6px 0px #d97c7c;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        button:hover {
            transform: translateY(2px);
            box-shadow: 2px 3px 0px #d97c7c;
        }

        .error-message {
            color: #d97c7c;
            margin-top: 10px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Se connecter</h2>
        <form method="POST">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Mot de passe" required>
            <button type="submit">Se connecter</button>
        </form>
        <?php if (isset($errorMessage)) { echo "<p class='error-message'>$errorMessage</p>"; } ?>
    </div>
</body>
</html>

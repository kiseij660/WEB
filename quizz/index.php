<?php
    // Define translations
    $translations = [
        'en' => ['title' => 'Quiz Generator', 'connect' => 'Log in', 'register' => 'Sign up'],
        'fr' => ['title' => 'Générateur de Quiz', 'connect' => 'Se connecter', 'register' => "S'inscrire"],
        'es' => ['title' => 'Generador de Cuestionarios', 'connect' => 'Iniciar sesión', 'register' => 'Registrarse'],
        'de' => ['title' => 'Quiz-Generator', 'connect' => 'Anmelden', 'register' => 'Registrieren'],
        'it' => ['title' => 'Generatore di Quiz', 'connect' => 'Accedi', 'register' => 'Iscriviti'],
        'pt' => ['title' => 'Gerador de Quiz', 'connect' => 'Entrar', 'register' => 'Registrar-se']
    ];

    // Get the selected language or default to French
    $lang = $_GET['lang'] ?? 'fr';
    $text = $translations[$lang] ?? $translations['fr'];
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quizzeo</title>
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
            position: relative;
        }

        .language-selector {
            position: absolute;
            top: 10px;
            left: 10px;
        }
        .language-options {
            display: none;
            flex-direction: column;
            position: absolute;
        }
        .language-selector button {
            background: #fce0b1;
            color: #f4b244;
            border: none;
            padding: 6px;
            cursor: pointer;
            margin-bottom: 7px;
            box-shadow: 4px 6px 0px #f4b244;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .language-selector button:hover {
            background: #fce0b1;
            margin-bottom: 7px;
            transform: translateY(2px);
            box-shadow: 2px 3px 0px #f4b244;
        }
        .language-selector:hover .language-options {
            display: flex;
            gap: 2px;
        }

        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 100%;
        }

        .logo {
            max-width: 700px;
        }

        h2 {
            font-size: 24px;
            color: #e96f6f;
            margin-top: -10px;
        }

        .buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 20px;
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
    </style>
</head>
<body>
    <div class="language-selector">
        <button id="languageButton">Choose Language</button>
        <div class="language-options">
            <a href="?lang=en"><button>English</button></a>
            <a href="?lang=fr"><button>Français</button></a>
            <a href="?lang=es"><button>Español</button></a>
            <a href="?lang=de"><button>Deutsch</button></a>
            <a href="?lang=it"><button>Italiano</button></a>
            <a href="?lang=pt"><button>Português</button></a>
        </div>
    </div>
    <div class="container">
        <img src="quiz.png" alt="Quizzeo Logo" class="logo">
        <h2><?php echo $text['title']; ?></h2>
        <div class="buttons">
            <button onclick="window.location.href='login.php'"><?php echo $text['connect']; ?></button>
            <button onclick="window.location.href='register.php'"><?php echo $text['register']; ?></button>
        </div>
    </div>
</body>
</html>

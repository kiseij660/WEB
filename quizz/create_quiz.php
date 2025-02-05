<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de Quiz</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8c6c5;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        h1 {
            color: #333;
            margin-bottom: 20px; 
        }
        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            display: none; /* Masquer les formulaires par défaut */
        }
        .question {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            color: #555;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #f4b244;
            color: black;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }
        button:hover {
            background-color: #e39d2b;
        }
    </style>
</head>
<body>
    <h1>Choisissez le type de questionnaire</h1>
    <select id="quizType" onchange="showForm()">
        <option value="">Sélectionnez un type de questionnaire</option>
        <option value="text">Questionnaire à texte</option>
        <option value="radio">Questionnaire à choix multiple</option>
    </select>

    <form id="textQuizForm">
        <h2>Questionnaire à texte</h2>
        <div class="question">
            <label for="question1">Question 1:</label>
            <input type="text" id="question1" name="question1" required>
            <label for="reponse1">Réponse:</label>
            <input type="text" id="reponse1" name="reponse1" required>
        </div>
        <button type="button" onclick="addTextQuestion()">Ajouter une question</button>
        <button type="submit">Créer le Quiz</button>
    </form>

    <form id="radioQuizForm">
        <h2>Questionnaire à choix multiple</h2>
        <div class="question">
            <label for="question1">Question 1:</label>
            <input type="text" id="question1" name="question1" required>
            <label>Choix 1:</label>
            <input type="text" id="option1_1" name="option1_1" required><br>
            <label>Choix 2:</label>
            <input type="text" id="option1_2" name="option1_2" required><br>
            <label>Choix 3:</label>
            <input type="text" id="option1_3" name="option1_3" required><br>
        </div>
        <button type="button" onclick="addRadioQuestion()">Ajouter une question</button>
        <button type="submit">Créer le Quiz</button>
    </form>

    <script>
        function showForm() {
            const quizType = document.getElementById('quizType').value;
            document.getElementById('textQuizForm').style.display = 'none';
            document.getElementById('radioQuizForm').style.display = 'none';
            if (quizType === 'text') {
                document.getElementById('textQuizForm').style.display = 'block';
            } else if (quizType === 'radio') {
                document.getElementById('radioQuizForm').style.display = 'block';
            }
        }

        let textQuestionCount = 1;
        function addTextQuestion() {
            textQuestionCount++;
            const form = document.getElementById('textQuizForm');
            const newQuestion = document.createElement('div');
            newQuestion.classList.add('question');
            newQuestion.innerHTML = `
                <label for="question${textQuestionCount}">Question ${textQuestionCount}:</label>
                <input type="text" id="question${textQuestionCount}" name="question${textQuestionCount}" required>
                <label for="reponse${textQuestionCount}">Réponse:</label>
                <input type="text" id="reponse${textQuestionCount}" name="reponse${textQuestionCount}" required>
            `;
            form.insertBefore(newQuestion, form.children[form.children.length - 2]);
        }

        let radioQuestionCount = 1;
        function addRadioQuestion() {
            radioQuestionCount++;
            const form = document.getElementById('radioQuizForm');
            const newQuestion = document.createElement('div');
            newQuestion.classList.add('question');
            newQuestion.innerHTML = `
                <label for="question${radioQuestionCount}">Question ${radioQuestionCount}:</label>
                <input type="text" id="question${radioQuestionCount}" name="question${radioQuestionCount}" required>
                <label>Choix 1:</label>
                <input type="text" id="option${radioQuestionCount}_1" name="option${radioQuestionCount}_1" required><br>
                <label>Choix 2:</label>
                <input type="text" id="option${radioQuestionCount}_2" name="option${radioQuestionCount}_2" required><br>
                <label>Choix 3:</label>
                <input type="text" id="option${radioQuestionCount}_3" name="option${radioQuestionCount}_3" required><br>
            `;
            form.insertBefore(newQuestion, form.children[form.children.length - 2]);
        }
    </script>
</body>
</html>
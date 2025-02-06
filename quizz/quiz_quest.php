<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Création de Quiz</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to bottom, #fff, #660099); /* Dégradé */
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            align-items: center;
            min-height: 100vh;
            text-align: center;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            
            
        }
        h1 {
            color: #e96f6f;
        }
        button {
            background: #f8c6c5;
            border: none;
            border-radius: 30px;
            padding: 10px 20px;
            font-size: 16px;
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
        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        select {
            padding: 10px;
            margin-bottom: 20px;
            width: 100%;
            font-size: 16px;
        }
        .question {
            margin-bottom: 15px;
        }
        .choices {
            margin-top: 10px;
        }
        .choice {
            display: flex;
            align-items: center;
        }
        .delete-btn {
            background-color: #ff4d4d;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
        }
        .delete-btn:hover {
            background-color: #cc0000;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Créer un Quiz</h1>
        <form action="save_quiz.php" method="POST">
            <label>Intitulé du Quiz :</label>
            <input type="text" name="quiz_title" required>

            <div id="questionsContainer">
                <div class="question" id="question1">
                    <label>Question :</label>
                    <input type="text" name="questions[]" required>

                    <label for="questionType1">Choisir le type de question :</label>
                    <select id="questionType1" name="question_type[]" onchange="showQuestionFields(1)">
                        <option value="" selected disabled>Choisir le type de question</option>
                        <option value="text">Question Texte</option>
                        <option value="singleChoice">Choix Unique (QCM)</option>
                        <option value="multipleChoice">Choix Multiple (QCM)</option>
                    </select>


                    <div id="question1Choices" class="choices"></div>

                    <button type="button" id="addChoiceButton1" onclick="addChoice(1)" style="display:none;">Ajouter une réponse</button>
                </div>
            </div>

            <button type="button" onclick="addQuestion()">Ajouter une question</button>
            <button type="submit">Enregistrer le Quiz</button>
        </form>
    </div>

    <script>
        // Afficher les champs en fonction du type de question
        function showQuestionFields(questionId) {
            const questionType = document.getElementById(`questionType${questionId}`).value;
            const container = document.getElementById(`question${questionId}Choices`);
            container.innerHTML = ''; // Vider les choix précédents

            const addChoiceButton = document.getElementById(`addChoiceButton${questionId}`);
            addChoiceButton.style.display = 'none'; // Cacher le bouton "Ajouter une réponse"

            if (questionType === 'singleChoice' || questionType === 'multipleChoice') {
                // Afficher les options pour le choix QCM
                addChoiceButton.style.display = 'inline-block'; // Afficher le bouton pour ajouter des réponses
            } else if (questionType === 'text') {
                // Afficher un champ de texte pour la réponse
                container.innerHTML = `<input type="text" name="text_answer[${questionId}]" required placeholder="Entrez votre réponse ici">`;
            }
        }

        // Ajouter une réponse pour une question
        function addChoice(questionId) {
            const questionContainer = document.getElementById(`question${questionId}Choices`);
            const questionType = document.getElementById(`questionType${questionId}`).value;
            const currentChoices = questionContainer.children.length + 1;

            let choiceHTML = '';
            if (questionType === 'singleChoice') {
                choiceHTML = `
                    <div class="choice">
                        <input type="text" name="option${currentChoices}[${questionId}]" required>
                        <input type="radio" name="correct${questionId}" value="${currentChoices}"> Bonne réponse
                    </div>
                `;
            } else if (questionType === 'multipleChoice') {
                choiceHTML = `
                    <div class="choice">
                        <input type="text" name="option${currentChoices}[${questionId}]" required>
                        <input type="checkbox" name="correct${questionId}[${currentChoices}]" value="${currentChoices}"> Bonne réponse
                    </div>
                `;
            }

            questionContainer.innerHTML += choiceHTML;
        }

        // Ajouter une nouvelle question
        function addQuestion() {
            const container = document.getElementById('questionsContainer');
            const questionCount = container.children.length + 1;

            const newQuestion = document.createElement('div');
            newQuestion.classList.add('question');
            newQuestion.id = `question${questionCount}`;
            newQuestion.innerHTML = `
                <label>Question :</label>
                <input type="text" name="questions[]" required>

                <label for="questionType${questionCount}">Choisir le type de question :</label>
                <select id="questionType${questionCount}" name="question_type[]" onchange="showQuestionFields(${questionCount})">
                    <option value="text">Question Texte</option>
                    <option value="singleChoice">Choix Unique (QCM)</option>
                    <option value="multipleChoice">Choix Multiple (QCM)</option>
                </select>

                <div id="question${questionCount}Choices" class="choices"></div>

                <button type="button" id="addChoiceButton${questionCount}" onclick="addChoice(${questionCount})" style="display:none;">Ajouter une réponse</button>
                <button type="button" class="delete-btn" onclick="removeQuestion(${questionCount})">Supprimer cette question</button>
            `;

            container.appendChild(newQuestion);
        }

        // Supprimer une question
        function removeQuestion(questionId) {
            const questionElement = document.getElementById(`question${questionId}`);
            questionElement.remove();
        }
    </script>
</body>
</html>

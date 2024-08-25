<?php

require "helpers.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

// Retrieve POST data
$complete_name = $_POST['complete_name'] ?? '';
$email = $_POST['email'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$contact_number = $_POST['contact_number'] ?? '';

$agree = $_POST['agree'] ?? null;
$answers = $_POST['answers'] ?? '';

$questions = retrieve_questions();
$number_of_questions = count($questions['questions']);

// Calculate the score
$score = compute_score($answers);

// Determine the hero section class based on the score
$hero_class = ($score > 2) ? 'is-success' : 'is-danger';

// Format the birthdate
$date = new DateTime($birthdate);
$formatted_birthdate = $date->format('F j, Y');


$json_data = file_get_contents('C:\xampp\htdocs\labs-2425\lab3a\questions\triviaquiz.json');
$data = json_decode($json_data, true);
$questions = $data['questions'];
$correct_answers = $data['answers'];


?>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #3A</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/confetti-js@0.0.18/site/site.min.css">
    <script src="https://cdn.jsdelivr.net/npm/confetti-js@0.0.18/dist/index.min.js"></script>
</head>
<body style="background-color: #14161A;">
<section class="hero <?php echo $hero_class; ?>">
    <div class="hero-body">
        <p class="title">Your Score: <?php echo htmlspecialchars($score); ?></p>
        <p class="subtitle">This is the IPT10 PHP Quiz Web Application Laboratory Activity.</p>
    </div>
</section>
<section class="section">
    <div class="table-container">
        <table class="table is-bordered is-hoverable is-fullwidth">
            <tbody>
                <tr>
                    <th>Input Field</th>
                    <th>Value</th>
                </tr>
                <tr>
                    <td>Complete Name</td>
                    <td><?php echo htmlspecialchars($complete_name); ?></td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td><?php echo htmlspecialchars($email); ?></td>
                </tr>
                <tr>
                    <td>Birthdate</td>
                    <td><?php echo htmlspecialchars($formatted_birthdate); ?></td>
                </tr>
                <tr>
                    <td>Contact Number</td>
                    <td><?php echo htmlspecialchars($contact_number); ?></td>
                </tr>
            </tbody>
        </table>
    </div>
<!-- Questions and Answers Table -->
<section class="section">
    <div class="table-container">
        <table class="table is-bordered is-hoverable is-fullwidth">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Correct Answer</th>
                    <th>Your Answer</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($questions as $index => $q): ?>
                <tr>
                    <td><?php echo htmlspecialchars($q['question']); ?></td>
                    <td>
                        <?php
                        // Find the correct answer value
                        $correct_option = array_filter($q['options'], function($option) use ($correct_answers, $index) {
                            return $option['key'] === $correct_answers[$index];
                        });
                        echo htmlspecialchars($correct_option ? reset($correct_option)['value'] : 'N/A');
                        ?>
                    </td>
                    <td>
                        <?php
                        // Find the user's answer value
                        $user_answer_key = $answers[$index] ?? ''; // Ensure $answers is an array and has the correct index
                        $user_answer_option = array_filter($q['options'], function($option) use ($user_answer_key) {
                            return $option['key'] === $user_answer_key;
                        });
                        echo htmlspecialchars($user_answer_option ? reset($user_answer_option)['value'] : 'N/A');
                        ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>


<canvas id="confetti-canvas"></canvas>
</section>

<?php if ($score == 5): ?>
<script>
var confettiSettings = {
    target: 'confetti-canvas'
};
var confetti = new ConfettiGenerator(confettiSettings);
confetti.render();
</script>
<?php endif; ?>





</body>
</html>

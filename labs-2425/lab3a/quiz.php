<?php

require "helpers.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit();
}

$complete_name = $_POST['complete_name'] ?? '';
$email = $_POST['email'] ?? '';
$birthdate = $_POST['birthdate'] ?? '';
$contact_number = $_POST['contact_number'] ?? '';
$agree = $_POST['agree'] ?? null;

$answers = $_POST['answers'] ?? [];

$questions = retrieve_questions();
$number_of_questions = count($questions['questions']);

$target = 'result.php';

?>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #3A</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css" />
</head>
<body>
    
<p id="timer" class="has-text-danger">Time remaining: 60 seconds</p>


<section class="section">
    
    <h1 class="title">Trivia Quiz</h1>

    <form method="POST" action="result.php" id="quiz-form">
        <input type="hidden" name="complete_name" value="<?php echo htmlspecialchars($complete_name); ?>" />
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>" />
        <input type="hidden" name="birthdate" value="<?php echo htmlspecialchars($birthdate); ?>" />
        <input type="hidden" name="contact_number" value="<?php echo htmlspecialchars($contact_number); ?>" />
        <input type="hidden" name="agree" value="<?php echo htmlspecialchars($agree); ?>" />


        <?php foreach ($questions['questions'] as $index => $question): ?>
            <h2 class="label">Question <?php echo $index + 1; ?> / <?php echo $number_of_questions; ?></h2>
            <p><?php echo htmlspecialchars($question['question']); ?></p>

            <?php foreach ($question['options'] as $option): ?>
                <div class="field">
                    <div class="control">
                        <label class="radio">
                            <input type="radio" name="answers[<?php echo $index; ?>]" value="<?php echo htmlspecialchars($option['key']); ?>" required />
                            <?php echo htmlspecialchars($option['value']); ?>
                        </label>
                    </div>
                </div>
            <?php endforeach; ?>

        <?php endforeach; ?>

        <button type="submit" class="button">Submit</button>
    </form>
</section>

<!-- JavaScript to display and update the countdown timer, and to submit the form after 60 seconds -->
<script>
    var timeLeft = 60; // 60 seconds countdown
    var timerElement = document.getElementById('timer');

    var countdownTimer = setInterval(function() {
        timeLeft--;
        timerElement.textContent = "Time remaining: " + timeLeft + " seconds";

        if (timeLeft <= 0) {
            clearInterval(countdownTimer); // Stop the timer
            document.getElementById('quiz-form').submit(); // Automatically submit the form
        }
    }, 1000); // Update every second
</script>

</body>
</html>

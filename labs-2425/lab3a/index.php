<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>IPT10 Laboratory Activity #3A</title>
    <!-- Add the Bulma CSS here -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@1.0.2/css/bulma.min.css">
</head>
<body>
<section class="section">
    <h1 class="title">User Registration</h1>
    <h2 class="subtitle">
        This is the IPT10 PHP Quiz Web Application Laboratory Activity. Please register
    </h2>
    <!-- Supply the correct HTTP method and target form handler resource -->
    <form method="POST" action="instructions.php">
        <div class="field">
            <label class="label">Name</label>
            <div class="control">
                <input class="input" id="complete_name" type="text" name="complete_name" placeholder="Complete Name">
            </div>
        </div>

        <div class="field">
            <label class="label">Email</label>
            <div class="control">
                <input class="input" id="email" name="email" type="email" />
            </div>
        </div>

        <div class="field">
            <label class="label">Birthdate</label>
            <div class="control">
                <input class="input" id="birthdate" type="date" name="birthdate" />
            </div>
        </div>

        <div class="field">
            <label class="label">Contact Number</label>
            <div class="control">
                <input class="input" id="contact_number" name="contact_number" type="number" />
            </div>
        </div>

        <!-- Next button -->
        <button type="submit" id="nextButton" class="button is-link" disabled>Proceed Next</button>
    </form>
</section>

<!-- JavaScript for disabling the submit button until all fields are filled -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const nameInput = document.getElementById('complete_name');
    const emailInput = document.getElementById('email');
    const birthdateInput = document.getElementById('birthdate');
    const contactNumberInput = document.getElementById('contact_number');
    const nextButton = document.getElementById('nextButton');

    function validateForm() {
        const nameValue = nameInput.value.trim();
        const emailValue = emailInput.value.trim();
        const birthdateValue = birthdateInput.value.trim();
        const contactNumberValue = contactNumberInput.value.trim();
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (nameValue !== '' && emailPattern.test(emailValue) && birthdateValue !== '' && contactNumberValue !== '') {
            nextButton.disabled = false;
        } else {
            nextButton.disabled = true;
        }
    }

    nameInput.addEventListener('input', validateForm);
    emailInput.addEventListener('input', validateForm);
    birthdateInput.addEventListener('input', validateForm);
    contactNumberInput.addEventListener('input', validateForm);
});
</script>

</body>
</html>

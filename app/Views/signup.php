<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TES - Sign Up</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link rel="stylesheet" href="<?=base_url('assets/styles/signup.css')?>">
</head>
<body>
    <div class="container">
        <div class="signup_container">
            <h2>Teacher Evaluation System</h2>
            <p style="width: 97%;">STUDENT SIGNUP</p>
            <div class="line_divider" style="margin-top: -30px"></div>
            <form id="signup_form">
                <div class="column">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" required
                        pattern="^[a-zA-Z0-9._%+\-]+@[a-zA-Z0-9.\-]+\.[a-zA-Z]{2,}$"
                        title="Please enter a valid email address.">

                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required
                        minlength="6" maxlength="20"
                        title="Password should be 6-20 characters.">

                    <label for="c_password">Confirm Password:</label>
                    <input type="password" name="c_password" id="c_password" required
                        minlength="6" maxlength="20"
                        title="Please re-enter the password.">

                    <label for="student_id">Student ID:</label>
                    <input type="number" name="user_id" id="student_id" required
                        min="1" max="99999999"
                        title="Enter a valid Student ID number.">
                </div>

                <div class="column">
                    <label for="firstname">Firstname:</label>
                    <input type="text" name="firstname" id="firstname" required
                        pattern="[A-Za-z\s\-]{2,30}"
                        title="Only letters, spaces, or dashes (2-30 characters).">

                    <label for="middlename">Middlename:</label>
                    <input type="text" name="middlename" id="middlename" required
                        pattern="[A-Za-z\s\-]{0,30}"
                        title="Only letters, spaces, or dashes (optional).">

                    <label for="lastname">Lastname:</label>
                    <input type="text" name="lastname" id="lastname" required
                        pattern="[A-Za-z\s\-]{2,30}"
                        title="Only letters, spaces, or dashes (2-30 characters).">

                    <label for="extension">Extension:</label>
                    <input type="text" name="extension" id="extension"
                        pattern="[A-Za-z]{0,10}"
                        title="Suffix (e.g., Jr, Sr, III) — optional.">
                </div>
                <br><br>
                <div id="signup_actions_div">
                    <a href="/login">Already have an account?</a>
                    <small id="error_message" style="color: red; display: none;"></small>
                    <button type="submit">Signup</button>
                </div>
            </form>

            <div>
                <h4>BOHOL ISLAND STATE UNIVERSITY</h4>
                <p>Clarin Campus</p>
            </div>
        </div>
    </div>

    <script>
        const form = document.getElementById('signup_form');
        const password = document.getElementById('password');
        const confirm = document.getElementById('c_password');
        const errorMsg = document.getElementById('error_message');
        

        form.addEventListener('submit', function (e) {
            e.preventDefault();  

            const formData = new FormData(form);

            const data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });

            // Send the data using fetch (AJAX)
            fetch('/auth/register', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Redirect to login page on successful signup
                    window.location.href = '/';
                } else {
                    errorMsg.style.display = 'block';  // <-- Show the error message
                    errorMsg.innerText = data.message;
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    </script>
</body>
</html>

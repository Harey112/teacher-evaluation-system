<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TES - Login</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <link rel="stylesheet" href="<?=base_url('assets/styles/login.css')?>">
</head>
<body>
    <div class="container">
        <div class="login_container">
            <h2>Teacher Evaluation System</h3>
            <p style="width: 97%;">STUDENT LOGIN</p>
            <div class="line_divider" style="margin-top: -25px"></div>
            <form id="login_form">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
                <small id="error_message" 
                    style="color: red;"
                ></small>
                <div id="login_actions_div">
                    <a href="">Forgot Password?</a>
                    <button type="submit">Login</button>
                </div>
            </form>
            <a href="/signup">I don't have account yet.</a>
            <div>
                <h4>BOHOL ISLAND STATE UNIVERSITY</h4>
                <p>Clarin Campus</p>
            </div>
        </div>
    </div>

    <script>
        // JavaScript to handle form submission
        const form = document.getElementById('login_form');
        form.addEventListener('submit', function (e) {
            e.preventDefault();  // Prevent the form from submitting normally

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            // Prepare the data to be sent to the server
            const data = {
                email: email,
                password: password
            };
            

            // Use fetch to send a POST request (AJAX)
            fetch('/auth/login', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Redirect on successful login
                    window.location.href = '/student/dashboard'; // or wherever you want to redirect
                } else {
                    // Display error message
                    document.getElementById('error_message').innerText = data.message;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred. Please try again later.');
            });
        });
    </script>
</body>
</html>

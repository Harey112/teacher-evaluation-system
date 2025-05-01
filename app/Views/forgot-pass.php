<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TES - Forgot Password</title>
    <meta name="description" content="Reset your password for the Teacher Evaluation System">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: Inter;
        }

        .container {
            width: 100vw;
            height: 100vh;
            background-color: gray;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .forgot_password_container {
            width: 450px;
            height: 450px;
            background-color: white;
            border-radius: 10px;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
            align-items: center;
            padding: 50px;
        }

        .line_divider {
            border: 1px solid black;
            width: 98%;
        }

        #forgot_password_form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        input {
            width: 300px;
            height: 30px;
            border: 1px solid #293777;
            border-radius: 5px;
            font-size: medium;
            outline-color: #293777;
            padding-left: 5px;
        }

        #form_actions_div {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        button {
            padding: 5px 15px;
            background-color: #293777;
            border: 1px solid #293777;
            border-radius: 5px;
            font-size: large;
            color: white;
            cursor: pointer;
        }

        button:active {
            background-color: #4658ac;
            border: 1px solid #4658ac;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="forgot_password_container">
            <h2>Teacher Evaluation System</h2>
            <p style="width: 97%;">FORGOT PASSWORD</p>
            <div class="line_divider" style="margin-top: -25px"></div>
            <form id="forgot_password_form">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
                <small id="message" style="color: red;"></small>
                <div id="form_actions_div">
                    <a href="/student/login">Back to Login</a>
                    <button type="submit">Submit</button>
                </div>
            </form>
            <div>
                <h4>BOHOL ISLAND STATE UNIVERSITY</h4>
                <p>Clarin Campus</p>
            </div>
        </div>
    </div>

    <script>
        const form = document.getElementById('forgot_password_form');
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const messageElement = document.getElementById('message');

            const data = { email: email };

            fetch('/auth/forgot-password', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    messageElement.style.color = 'green';
                    messageElement.innerText = 'Password reset link sent to your email.';
                } else {
                    messageElement.style.color = 'red';
                    messageElement.innerText = data.message || 'An error occurred.';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                messageElement.style.color = 'red';
                messageElement.innerText = 'An error occurred. Please try again later.';
            });
        });
    </script>
</body>
</html>
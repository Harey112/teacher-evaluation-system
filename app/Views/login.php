<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TES - Login</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url('/favicon.ico'); ?>">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap');
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

        .login_container {
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

        #login_form {
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

        #login_actions_div {
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
        <div class="login_container">
            <h2>Teacher Evaluation System</h2>
            <p style="width: 97%;">STUDENT LOGIN</p>
            <div class="line_divider" style="margin-top: -25px"></div>
            <form id="login_form">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
                <label for="password">Password:</label>
                <input type="password" name="password" id="password" required>
                <small id="error_message" style="color: red;"></small>
                <div id="login_actions_div">
                    <a href="<?php echo base_url('forgot-password'); ?>">Forgot Password?</a>
                    <button type="submit">Login</button>
                </div>
            </form>
            <a href="<?php echo base_url('student/signup'); ?>">I don't have account yet.</a>
            <div>
                <h4>BOHOL ISLAND STATE UNIVERSITY</h4>
                <p>Clarin Campus</p>
            </div>
        </div>
    </div>

    <script>
        const password = document.getElementById('password');
        password.addEventListener('input', function () {
            document.getElementById('error_message').innerText = '';
        });

        const form = document.getElementById('login_form');
        form.addEventListener('submit', function (e) {
            e.preventDefault();

            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            const data = {
                email: email,
                password: password
            };

            fetch('<?php echo base_url('auth/admin-login'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(data),
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    window.location.href = '<?php echo base_url('student/dashboard'); ?>';
                } else {
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

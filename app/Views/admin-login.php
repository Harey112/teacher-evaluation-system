<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TES - Login</title>
    <meta name="description" content="Teacher Evaluation System Admin Login">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url('favicon.ico'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: 'Inter', sans-serif;
            box-sizing: border-box;
        }

        .container {
            width: 100vw;
            height: 100vh;
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .login_container {
            width: 450px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px;
        }

        .login_container h2 {
            font-size: 24px;
            color: #293777;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .login_container p.subtitle {
            font-size: 14px;
            color: #333;
            margin-bottom: 20px;
        }

        .line_divider {
            border-top: 1px solid #d3d3d3;
            width: 100%;
            margin: 20px 0;
        }

        #login_form {
            display: flex;
            flex-direction: column;
            gap: 15px;
            width: 100%;
            max-width: 300px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        label {
            font-size: 14px;
            color: #333;
            margin-bottom: 5px;
        }

        input {
            width: 100%;
            height: 35px;
            border: 1px solid #293777;
            border-radius: 5px;
            font-size: 14px;
            color: #333;
            padding: 0 10px;
            outline: none;
        }

        input:focus {
            border-color: #4658ac;
            box-shadow: 0 0 5px rgba(70, 88, 172, 0.3);
        }

        #error_message {
            color: #d32f2f;
            font-size: 12px;
            min-height: 20px;
            text-align: center;
        }

        #login_actions_div {
            display: flex;
            justify-content: flex-end;
            margin-top: 10px;
        }

        button {
            padding: 8px 20px;
            background-color: #293777;
            border: 1px solid #293777;
            border-radius: 5px;
            font-size: 16px;
            color: white;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        button:hover {
            background-color: #4658ac;
            border-color: #4658ac;
        }

        button:active {
            background-color: #1e2a5a;
            border-color: #1e2a5a;
        }

        .footer {
            text-align: center;
            margin-top: 20px;
        }

        .footer h4 {
            font-size: 14px;
            color: #293777;
            font-weight: 600;
        }

        .footer p {
            font-size: 12px;
            color: #666;
        }

        @media (max-width: 768px) {
            .login_container {
                width: 90%;
                padding: 20px;
            }

            input {
                height: 30px;
                font-size: 12px;
            }

            button {
                font-size: 14px;
                padding: 6px 15px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login_container">
            <h2>Teacher Evaluation System</h2>
            <p class="subtitle">ADMIN LOGIN</p>
            <div class="line_divider"></div>
            <form id="login_form" aria-describedby="error_message">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" required aria-required="true">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" required aria-required="true">
                </div>
                <small id="error_message" aria-live="polite"></small>
                <div id="login_actions_div">
                    <button type="submit">Login</button>
                </div>
            </form>
            <div class="footer">
                <h4>Bohol Island State University</h4>
                <p>Clarin Campus</p>
            </div>
        </div>
    </div>

    <script>
        const form = document.getElementById('login_form');
        const errorMessage = document.getElementById('error_message');
        const inputs = form.querySelectorAll('input');

        // Clear error message on input
        inputs.forEach(input => {
            input.addEventListener('input', () => {
                errorMessage.textContent = '';
            });
        });

        // Handle form submission
        form.addEventListener('submit', async (e) => {
            e.preventDefault();

            const username = document.getElementById('username').value.trim();
            const password = document.getElementById('password').value;

            if (!username || !password) {
                errorMessage.textContent = 'Please fill in all fields.';
                return;
            }

            const data = { username, password };

            try {
                const response = await fetch('<?php echo base_url('auth/admin-login'); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify(data)
                });

                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }

                const result = await response.json();
                if (result.status === 'success') {
                    window.location.href = '<?php echo base_url('admin/dashboard'); ?>';
                } else {
                    errorMessage.textContent = result.message || 'Login failed. Please try again.';
                }
            } catch (error) {
                errorMessage.textContent = 'An error occurred. Please try again later.';
                console.error('Error:', error);
            }
        });
    </script>
</body>
</html>
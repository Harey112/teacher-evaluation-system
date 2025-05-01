<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TES - Sign Up</title>
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

        .signup_container {
            width: 800px;
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

        #signup_form {
            display: flex;
            flex-direction: row;
            align-items: center;
            gap: 15px;
        }

        #signup_form > .column {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        input, select {
            width: 250px;
            height: 30px;
            border: 1px solid #293777;
            border-radius: 5px;
            font-size: medium;
            outline-color: #293777;
            padding-left: 5px;
        }

        select {
            appearance: none;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24"><path fill="%23293777" d="M7 10l5 5 5-5z"/></svg>') no-repeat right 10px center;
            background-size: 12px;
            padding-right: 20px;
        }

        #signup_actions_div {
            height: 100%;
            display: flex;
            flex-direction: column-reverse;
            justify-content: space-evenly;
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

        button:hover {
            background-color: #4658ac;
        }

        button:active {
            background-color: #1e2a55;
        }

        a {
            color: #293777;
            text-decoration: none;
            font-size: 14px;
        }

        a:hover {
            text-decoration: underline;
        }

        #error_message {
            color: red;
            font-size: 12px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .signup_container {
                width: 90%;
                height: auto;
                padding: 20px;
            }

            #signup_form {
                flex-direction: column;
                gap: 10px;
            }

            input, select {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="signup_container">
            <h2>Teacher Evaluation System</h2>
            <p style="width: 97%;">STUDENT SIGNUP</p>
            <div class="line_divider" style="margin-top: -30px"></div>
            <form id="signup_form">
                <div class="column">
                    <label for="user_id">Student ID:</label>
                    <input type="text" name="user_id" id="user_id" required
                        title="Enter a valid Student ID number">

                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" required
                        minlength="6" maxlength="20"
                        title="Password should be 6-20 characters">

                    <label for="c_password">Confirm Password:</label>
                    <input type="password" name="c_password" id="c_password" required
                        minlength="6" maxlength="20"
                        title="Please re-enter the password">

                    <label for="section">Course and Year:</label>
                    <select name="section" id="section" required>
                        <option value="" disabled selected>Select Course and Year</option>
                        <?php
                            $course_list = isset($course_list) ? $course_list : [];
                            foreach ($course_list as $course):
                        ?>
                            <option value="<?= htmlspecialchars($course['id']) ?>">
                                <?= htmlspecialchars($course['course'] . ' ' . $course['year'] . ' ' . $course['section']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="column">
                    <label for="firstname">Firstname:</label>
                    <input type="text" name="firstname" id="firstname" required
                        pattern="[A-Za-z\s\-]{2,30}"
                        title="Only letters, spaces, or dashes (2-30 characters)">

                    <label for="middlename">Middlename:</label>
                    <input type="text" name="middlename" id="middlename"
                        pattern="[A-Za-z\s\-]{0,30}"
                        title="Only letters, spaces, or dashes (optional)">

                    <label for="lastname">Lastname:</label>
                    <input type="text" name="lastname" id="lastname" required
                        pattern="[A-Za-z\s\-]{2,30}"
                        title="Only letters, spaces, or dashes (2-30 characters)">

                    <label for="extension">Extension:</label>
                    <input type="text" name="extension" id="extension"
                        pattern="[A-Za-z]{0,10}"
                        title="Suffix (e.g., Jr, Sr, III) — optional">
                </div>
                <div id="signup_actions_div">
                    <a href="<?php echo base_url('student/login'); ?>">Already have an account?</a>
                    <small id="error_message" style="display: none;"></small>
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

            // Client-side password confirmation check
            if (password.value !== confirm.value) {
                errorMsg.style.display = 'block';
                errorMsg.innerText = 'Passwords do not match.';
                return;
            }

            const formData = new FormData(form);
            const data = {};
            formData.forEach((value, key) => {
                data[key] = value;
            });

            fetch('<?php echo base_url('auth/register'); ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify(data)
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    window.location.href = '<?php echo base_url(); ?>';
                } else {
                    errorMsg.style.display = 'block';
                    errorMsg.innerText = data.message || 'Registration failed. Please try again.';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                errorMsg.style.display = 'block';
                errorMsg.innerText = 'An error occurred. Please try again.';
            });
        });
    </script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo isset($page_title) ? htmlspecialchars($page_title) : 'Teacher Evaluation System'; ?></title>
    <meta name="description" content="Student dashboard for the Teacher Evaluation System">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="<?php echo base_url('favicon.ico'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap');

        * {
            margin: 0;
            padding: 0;
            font-family: Inter, sans-serif;
            box-sizing: border-box;
        }

        body {
            display: flex;
            min-height: 100vh;
            background-color: #e0e0e0;
        }

        .side_menu {
            width: 250px;
            background-color: #ffffff;
            border-right: 1px solid #d3d3d3;
            display: flex;
            flex-direction: column;
            padding: 20px;
            position: fixed;
            height: 100vh;
            overflow-y: auto;
        }

        #account_info {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 20px;
            padding: 10px;
            border-bottom: 1px solid #d3d3d3;
        }

        #account_info i {
            font-size: 40px;
            color: #293777;
        }

        #account_info p {
            font-size: 16px;
            font-weight: 600;
            color: #293777;
        }

        #account_info small {
            font-size: 12px;
            color: #666;
            display: block;
        }

        .menu {
            display: flex;
            flex-direction: column;
            gap: 5px;
        }

        .item {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.2s;
        }

        .item i {
            font-size: 20px;
            color: #333;
        }

        .item p {
            font-size: 14px;
            color: #333;
        }

        .item:hover {
            background-color: #f0f0f0;
        }

        .item.selected {
            background-color: #293777;
        }

        .item.selected i,
        .item.selected p {
            color: white;
        }

        .content_container {
            margin-left: 250px;
            flex-grow: 1;
            padding: 20px;
            background-color: #f5f5f5;
        }

        header {
            background-color: #ffffff;
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        header h3 {
            font-size: 20px;
            color: #293777;
            font-weight: 600;
        }

        @media (max-width: 768px) {
            .side_menu {
                width: 200px;
            }

            .content_container {
                margin-left: 200px;
            }
        }

        @media (max-width: 600px) {
            body {
                flex-direction: column;
            }

            .side_menu {
                width: 100%;
                height: auto;
                position: relative;
                padding: 10px;
            }

            .content_container {
                margin-left: 0;
                padding: 10px;
            }
        }
    </style>
</head>
<body>
    <div class="side_menu">
        <div id="account_info">
            <i class="fas fa-user-circle"></i>
            <p><?php echo isset($firstname) ? htmlspecialchars($firstname) : 'Unknown'; ?> 
                <?php echo isset($lastname) ? htmlspecialchars($lastname) : 'Unknown'; ?>
             <small>Student</small></p>
        </div>
        <div class="menu">
            <div class="item <?php echo ($active_menu == 'dashboard') ? 'selected' : ''; ?>" onclick="location.href='<?php echo base_url('student/dashboard'); ?>'">
                <i class="fas fa-gauge"></i>
                <p>Dashboard</p>
            </div>
            <div class="item <?php echo ($active_menu == 'home') ? 'selected' : ''; ?>" onclick="location.href='<?php echo base_url('student/home'); ?>'">
                <i class="fas fa-house"></i>
                <p>Home</p>
            </div>
            <div class="item <?php echo ($active_menu == 'academic_year') ? 'selected' : ''; ?>" onclick="location.href='<?php echo base_url('student/academic_year'); ?>'">
                <i class="fas fa-calendar"></i>
                <p>Academic Year</p>
            </div>
            <div class="item <?php echo ($active_menu == 'evaluate_faculty') ? 'selected' : ''; ?>" onclick="location.href='<?php echo base_url('student/evaluate_faculty'); ?>'">
                <i class="fas fa-star"></i>
                <p>Evaluate Faculty</p>
            </div>
            <div class="item" onclick="location.href='<?php echo base_url('auth/logout'); ?>'">
                <i class="fas fa-sign-out-alt"></i>
                <p>Logout</p>
            </div>
        </div>
    </div>
    <div class="content_container">
        <header>
            <h3>TEACHER EVALUATION SYSTEM</h3>
        </header>
        <div class="content">
            <?php echo $content; ?>
        </div>
    </div>
</body>
</html>
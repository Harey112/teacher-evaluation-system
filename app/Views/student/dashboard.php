<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?=base_url('assets/styles/home.css')?>">
</head>
<body>
    <div class="side_menu">
        <div id="account_info">
            <img src="<?=base_url('assets/images/account.png')?>" alt="" srcset="">
            <p>User user<blockquote><small style="top: -10px">Student</small></blockquote></p>
            
        </div>
        <div class="menu">
            <div class="item selected">
                <img src="<?=base_url('assets/images/hamburger.png')?>" alt="" srcset="">
                <a href="#">Dashboard</a></div>
            <div class="item">
                <img src="<?=base_url('assets/images/home.png')?>" alt="" srcset="">
                <a href="#">Home</a></div>
            <div class="item">
                <img src="<?=base_url('assets/images/calendar.png')?>" alt="" srcset="">
                <a href="#">Academic Year</a></div>
            <div class="item">
                <img src="<?=base_url('assets/images/book.png')?>" alt="" srcset="">
                <a href="#">Subject</a></div>
            <div class="item">
                <img src="<?=base_url('assets/images/unit.png')?>" alt="" srcset="">
                <a href="#">Section</a></div>
            <div class="item">
                <img src="<?=base_url('assets/images/evaluate.png')?>" alt="" srcset="">
                <a href="#">Evaluate Faculty</a></div>
            <div class="item">
                <img src="<?=base_url('assets/images/teacher.png')?>" alt="" srcset="">
                <a href="#">Select Faculty</a></div>
            <div class="item">
                <img src="<?=base_url('assets/images/logout.png')?>" alt="" srcset="">
                <a href="/auth/logout">Logout</a></div>
        </div>
        
    </div>
    <div class="content_container">
        <header>
            <h3>TEACHER EVALUATION SYSTEM</h3>
        </header>
        <div class="content">

            <div class="tile">
                <h1>Evaluate Faculty</h1>
                <div>
                    <p>More Info...</p>
                </div>
            </div>
            
            <div class="tile">
                <h1>Pending Evaluation</h1>
                <div>
                    <p>More Info...</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

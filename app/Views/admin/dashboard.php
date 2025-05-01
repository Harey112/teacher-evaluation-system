<style>
    .content {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
    }

    .tile {
        background-color: #ffffff;
        width: 300px;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        transition: transform 0.2s;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .tile:hover {
        transform: translateY(-5px);
    }

    .tile h1 {
        font-size: 18px;
        color: #293777;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .tile .statistic {
        font-size: 24px;
        color: #293777;
        font-weight: 700;
        margin-bottom: 10px;
    }

    .tile p {
        font-size: 14px;
        color: #666;
        cursor: pointer;
        text-align: right;
    }

    .tile p:hover {
        color: #293777;
        text-decoration: underline;
    }

    @media (max-width: 768px) {
        .tile {
            width: 100%;
        }
    }
</style>
<div class="content">
    <div class="tile">
        <h1>Dashboard</h1>
        <div class="statistic">Admin Overview</div>
        <p><a href="<?php echo base_url('admin/dashboard'); ?>">Refresh</a></p>
    </div>
    <div class="tile">
        <h1>Evaluation</h1>
        <div class="statistic"><?php echo isset($latest_school_year) ? htmlspecialchars($latest_school_year) : 'Not Set'; ?></div>
        <p><a href="<?php echo base_url('admin/evaluation'); ?>">More Info...</a></p>
    </div>
    <div class="tile">
        <h1>Instructors</h1>
        <div class="statistic"><?php echo isset($instructor_count) ? htmlspecialchars($instructor_count) : '0'; ?> Instructors</div>
        <p><a href="<?php echo base_url('admin/instructors'); ?>">More Info...</a></p>
    </div>
    <div class="tile">
        <h1>Students</h1>
        <div class="statistic"><?php echo isset($student_count) ? htmlspecialchars($student_count) : '0'; ?> Students</div>
        <p><a href="<?php echo base_url('admin/courses'); ?>">More Info...</a></p>
    </div>
</div>
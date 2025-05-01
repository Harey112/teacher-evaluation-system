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
        cursor: pointer;
        text-decoration: none;
        color: inherit;
    }

    .tile:hover {
        transform: translateY(-5px);
    }

    .tile h1 {
        font-size: 12px;
        color: #293777;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .tile .statistic {
        font-size: 24px;
        color: #293777;
        font-weight: 700;
    }

    .add-section-tile {
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: default;
    }

    .add-section-btn {
        padding: 10px 20px;
        background-color: #293777;
        border: 1px solid #293777;
        border-radius: 5px;
        font-size: 16px;
        color: white;
        cursor: pointer;
        text-decoration: none;
        text-align: center;
        width: 100%;
        box-sizing: border-box;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .add-section-btn:active {
        background-color: #4658ac;
        border: 1px solid #4658ac;
    }

    .add-section-btn i {
        font-size: 16px;
    }

    .popover {
        background-color: #ffffff;
        border: 1px solid #d3d3d3;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        max-width: 300px;
        width: 100%;
        margin: auto;
        z-index: 1000;
    }

    .popover h2 {
        font-size: 18px;
        color: #293777;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .popover label {
        display: block;
        font-size: 14px;
        color: #333;
        margin-bottom: 5px;
    }

    .popover input,
    .popover select {
        width: 100%;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #d3d3d3;
        border-radius: 5px;
        font-size: 14px;
        color: #333;
    }

    .popover .button-group {
        display: flex;
        gap: 10px;
        justify-content: flex-end;
    }

    .popover button {
        padding: 8px 15px;
        border-causing: 5px;
        font-size: 14px;
        cursor: pointer;
        border: none;
    }

    .popover .submit-btn {
        background-color: #293777;
        color: white;
    }

    .popover .submit-btn:active {
        background-color: #4658ac;
    }

    .popover .cancel-btn {
        background-color: #e0e0e0;
        color: #333;
    }

    .popover .cancel-btn:active {
        background-color: #d3d3d3;
    }

    .error-message {
        color: #d32f2f;
        font-size: 12px;
        margin-bottom: 15px;
        display: none;
    }

    @media (max-width: 768px) {
        .tile {
            width: 100%;
        }

        .popover {
            max-width: 90%;
        }
    }
</style>
<div class="content">
<?php
    $levels = isset($levels) ? $levels : [];

    if (empty($levels)) {
    ?>
        <div class="tile">
            <h1>No Levels Yet</h1>
            <div class="statistic">Please add programs.</div>
        </div>
    <?php
    } else {
        foreach ($levels as $level) {
    ?>
        <a href="<?php echo base_url('admin/courses/year-level/students') . '?course=' . urlencode($course) . '&year=' . urlencode($level['name']); ?>" class="tile">
            <div class="statistic"><?php echo htmlspecialchars($level['name']); ?></div>
            <h1>Sections: 
                <?php
                    $sections = $level['sections'];
                    $len = count($sections);
                    foreach ($sections as $index => $section) {
                        echo htmlspecialchars($section);
                        if ($index < $len - 1) {
                            echo ', ';
                        }
                    }
                ?>
            </h1>
        </a>
    <?php
        }
    }
    ?>
</div>

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
    $course_list = isset($course_list) ? $course_list : [];
    $courses = isset($courses) ? $courses : []; // Ensure $courses is defined

    if (empty($course_list)) {
    ?>
        <div class="tile">
            <h1>No Programs Yet</h1>
            <div class="statistic">Please add programs.</div>
        </div>
    <?php
    } else {
        foreach ($course_list as $course) {
    ?>
        <a href="<?php echo base_url('admin/courses/year-level') . '?course=' . urlencode($course['name']); ?>" class="tile">
            <div class="statistic"><?php echo htmlspecialchars($course['name']); ?></div>
            <h1>Levels: <?php
                $len = count($course['years']);
                $i = 1;
                foreach ($course['years'] as $level) {
                    echo $level;
                    if ($i < $len) {
                        echo ", ";
                    }
                    $i++;
                }
            ?></h1>
        </a>
    <?php
        }
    }
    ?>
    <div class="tile add-section-tile">
        <button class="add-section-btn" popovertarget="add-section-popover">
            <i class="fas fa-plus"></i>
            Add Section
        </button>
    </div>
    <div id="add-section-popover" class="popover" popover>
        <h2>Add New Section</h2>
        <div class="error-message" id="error-message"></div>
        <label for="course-input">Course</label>
        <input type="text" id="course-input" name="course" placeholder="e.g., BS Computer Science" list="course-suggestions" />
        <datalist id="course-suggestions">
            <?php foreach ($course_list as $course): ?>
                <option value="<?php echo htmlspecialchars(is_array($course) ? $course['name'] : $course); ?>">
            <?php endforeach; ?>
        </datalist>
        <label for="year-input">Year</label>
        <select id="year-input" name="year">
            <option value="">Select Year</option>
            <option value="1st Year">1st Year</option>
            <option value="2nd Year">2nd Year</option>
            <option value="3rd Year">3rd Year</option>
            <option value="4th Year">4th Year</option>
        </select>
        <label for="section-input">Section</label>
        <input type="text" id="section-input" name="section" placeholder="e.g., A" />
        <div class="button-group">
            <button class="cancel-btn" popovertargetaction="close" popovertarget="add-section-popover">Cancel</button>
            <button class="submit-btn" id="submit-section">Submit</button>
        </div>
    </div>
</div>

<script>
document.getElementById('submit-section').addEventListener('click', async () => {
    const course = document.getElementById('course-input').value.trim();
    const year = document.getElementById('year-input').value.trim();
    const section = document.getElementById('section-input').value.trim();
    const errorMessage = document.getElementById('error-message');
    const submitBtn = document.getElementById('submit-section');
    const popover = document.getElementById('add-section-popover');

    // Client-side validation
    if (!course || !year || !section) {
        errorMessage.textContent = 'All fields are required.';
        errorMessage.style.display = 'block';
        return;
    }

    // Clear error message
    errorMessage.style.display = 'none';

    // Disable button and show loading text
    submitBtn.disabled = true;
    const originalText = submitBtn.textContent;
    submitBtn.textContent = 'Submitting...';

    // Prepare data for POST
    const data = { course, year, section };

    try {
        const response = await fetch('<?php echo base_url('admin/add-section');?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

        if (response.ok && result.status === 'success') {
            if (popover && typeof popover.hidePopover === 'function') {
                popover.hidePopover();
            }
            window.location.reload();
        } else {
            errorMessage.textContent = result.message || 'Failed to add section.';
            errorMessage.style.display = 'block';
        }
    } catch (error) {
        console.error(error);
        errorMessage.textContent = 'An error occurred. ' + (error.message || 'Please try again.');
        errorMessage.style.display = 'block';
    } finally {
        // Re-enable the button and restore text
        submitBtn.disabled = false;
        submitBtn.textContent = originalText;
    }
});
</script>
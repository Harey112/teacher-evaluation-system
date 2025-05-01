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

    .add-instructor-tile {
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: default;
    }

    .add-instructor-btn {
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

    .add-instructor-btn:active {
        background-color: #4658ac;
        border: 1px solid #4658ac;
    }

    .add-instructor-btn i {
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
        border-radius: 5px;
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
    $instructor_list = isset($instructor_list) ? $instructor_list : [];

    if (empty($instructor_list)) {
    ?>
        <div class="tile">
            <h1>No Instructors Yet</h1>
            <div class="statistic">Please add instructors.</div>
        </div>
    <?php
    } else {
        foreach ($instructor_list as $instructor) {
    ?>
        <a href="<?php echo base_url('admin/instructors/details') . '?id=' . urlencode($instructor['id']); ?>" class="tile">
            <div class="statistic">
                <?php 
                echo htmlspecialchars($instructor['firstname']) . ' ' . 
                     (!empty($instructor['middlename']) ? htmlspecialchars($instructor['middlename'][0]) . '. ' : '') . 
                     htmlspecialchars($instructor['lastname']) . 
                     (!empty($instructor['extension']) ? ', ' . htmlspecialchars($instructor['extension']) : '');
                ?>
            </div>
            <h1>Instructor</h1>
        </a>
    <?php
        }
    }
    ?>
    <div class="tile add-instructor-tile">
        <button class="add-instructor-btn" popovertarget="add-instructor-popover">
            <i class="fas fa-plus"></i>
            Add Instructor
        </button>
    </div>
    <div id="add-instructor-popover" class="popover" popover>
        <h2>Add New Instructor</h2>
        <div class="error-message" id="error-message"></div>
        <label for="firstname-input">First Name</label>
        <input type="text" id="firstname-input" name="firstname" />
        <label for="middlename-input">Middle Name (Optional)</label>
        <input type="text" id="middlename-input" name="middlename" />
        <label for="lastname-input">Last Name</label>
        <input type="text" id="lastname-input" name="lastname" />
        <label for="extension-input">Extension (Optional)</label>
        <input type="text" id="extension-input" name="extension" placeholder="e.g., Jr." />
        <div class="button-group">
            <button class="cancel-btn" popovertargetaction="close" popovertarget="add-instructor-popover">Cancel</button>
            <button class="submit-btn" id="submit-instructor">Submit</button>
        </div>
    </div>
</div>

<script>
document.getElementById('submit-instructor').addEventListener('click', async () => {
    const firstname = document.getElementById('firstname-input').value.trim();
    const middlename = document.getElementById('middlename-input').value.trim();
    const lastname = document.getElementById('lastname-input').value.trim();
    const extension = document.getElementById('extension-input').value.trim();
    const errorMessage = document.getElementById('error-message');
    const submitBtn = document.getElementById('submit-instructor');
    const popover = document.getElementById('add-instructor-popover');

    // Client-side validation
    if (!firstname || !lastname) {
        errorMessage.textContent = 'First name and last name are required.';
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
    const data = { firstname, middlename, lastname, extension };

    try {
        const response = await fetch('<?php echo base_url('admin/add-instructor');?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify(data)
        });

        const result = await response.json();

 suffered: true;

        if (response.ok && result.status === 'success') {
            if (popover && typeof popover.hidePopover === 'function') {
                popover.hidePopover();
            }
            window.location.reload();
        } else {
            errorMessage.textContent = result.message || 'Failed to add instructor.';
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
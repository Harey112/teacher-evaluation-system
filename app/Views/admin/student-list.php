<style>
    .content {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .content-title {
        font-size: 24px;
        color: #293777;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .filters {
        display: flex;
        gap: 20px;
        margin-bottom: 20px;
        flex-wrap: wrap;
    }

    .search-bar {
        flex: 1;
        min-width: 200px;
    }

    .search-bar input {
        width: 100%;
        padding: 8px;
        border: 1px solid #d3d3d3;
        border-radius: 5px;
        font-size: 14px;
        color: #333;
    }

    .section-filter {
        min-width: 150px;
    }

    .section-filter select {
        width: 100%;
        padding: 8px;
        border: 1px solid #d3d3d3;
        border-radius: 5px;
        font-size: 14px;
        color: #333;
    }

    .student-table {
        width: 100%;
        border-collapse: collapse;
    }

    .student-table th,
    .student-table td {
        padding: 12px;
        text-align: left;
        border-bottom: 1px solid #d3d3d3;
    }

    .student-table th {
        background-color: #293777;
        color: white;
        font-weight: 600;
        font-size: 14px;
    }

    .student-table td {
        font-size: 14px;
        color: #333;
    }

    .student-table tr {
        transition: background-color 0.2s;
    }

    .student-table tr:hover {
        background-color: #f0f0f0;
    }

    .student-table tr.hidden {
        display: none;
    }

    @media (max-width: 768px) {
        .filters {
            flex-direction: column;
            gap: 10px;
        }

        .search-bar,
        .section-filter {
            min-width: 100%;
        }

        .student-table th,
        .student-table td {
            padding: 8px;
            font-size: 12px;
        }

        .content-title {
            font-size: 20px;
        }
    }
</style>
<div class="content">
    <h1 class="content-title"><?php echo htmlspecialchars($year_level ?? ''); ?> <?php echo $course ?> Students</h1>
    <div class="filters">
        <div class="search-bar">
            <input type="text" id="search-input" placeholder="Search by name..." />
        </div>
        <div class="section-filter">
            <select id="section-filter">
                <option value="">All Sections</option>
                <?php
                $sections = isset($sections) ? $sections : [];
                $current_section = isset($current_section) ? $current_section : '';
                foreach ($sections as $section) {
                    $selected = ($current_section === $section['section']) ? 'selected' : '';
                ?>
                    <option value="<?php echo htmlspecialchars($section['section']); ?>" <?php echo $selected; ?>>
                        <?php echo htmlspecialchars($section['section']); ?>
                    </option>
                <?php } ?>
            </select>
        </div>
    </div>
    <table class="student-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Section</th>
            </tr>
        </thead>
        <tbody id="student-table-body">
        <?php
            $students = isset($students) ? $students : [];
            $sections = isset($sections) ? $sections : [];

            // Create a map of section ID to section name
            $sectionMap = [];
            foreach ($sections as $sec) {
                $sectionMap[$sec['id']] = $sec['section'];
            }

            if (empty($students)) {
        ?>
            <tr>
                <td colspan="3" style="text-align: center; color: #999;">No students found.</td>
            </tr>
        <?php
            } else {
                foreach ($students as $student) {
                    $sectionName = $sectionMap[$student['section']] ?? 'Unknown';

                    $fullName = trim(
                        htmlspecialchars($student['firstname']) . ' ' .
                        (!empty($student['middlename']) ? htmlspecialchars($student['middlename'][0]) . '. ' : '') .
                        htmlspecialchars($student['lastname']) .
                        (!empty($student['extension']) ? ', ' . htmlspecialchars($student['extension']) : '')
                    );
        ?>
            <tr 
                data-user-id="<?php echo htmlspecialchars($student['user_id']); ?>" 
                data-name="<?php echo htmlspecialchars($fullName); ?>" 
                data-section="<?php echo htmlspecialchars($sectionName); ?>"
                data-type="<?php echo htmlspecialchars($student['type']); ?>"
            >
                <td><?php echo htmlspecialchars($student['user_id']); ?></td>
                <td><?php echo $fullName; ?></td>
                <td><?php echo htmlspecialchars($sectionName); ?></td>
            </tr>
        <?php
                }
            }
        ?>
        </tbody>

    </table>
</div>

<script>
    const searchInput = document.getElementById('search-input');
    const sectionFilter = document.getElementById('section-filter');
    const tableBody = document.getElementById('student-table-body');
    const yearLevel = '<?php echo addslashes($year_level ?? ''); ?>';
    const rows = tableBody.querySelectorAll('tr'); // ✅ Fix: define rows

    // Client-side search filtering
    function filterStudentsBySearch() {
        const searchTerm = searchInput.value.toLowerCase();

        rows.forEach(row => {
            const name = row.dataset.name.toLowerCase();
            const matchesSearch = name.includes(searchTerm);
            row.classList.toggle('hidden', !matchesSearch);
        });
    }

    // Section filter change handler
    sectionFilter.addEventListener('change', () => {
        const section = sectionFilter.value;
        const url = new URL('<?php echo base_url('admin/courses/year-level/students'); ?>');
        url.searchParams.set('year', yearLevel);
        url.searchParams.set('course', "<?php echo $course ?>");
        if (section) {
            url.searchParams.set('section', section);
        }
        window.location.href = url.toString();
    });

    // Search input handler
    searchInput.addEventListener('input', filterStudentsBySearch);
</script>
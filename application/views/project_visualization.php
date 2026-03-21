<?php include('includes/header.php') ?>
<!-- Shiv Web Developer  -->
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
    <div class="row">
        <div class="col-md-12">
            <div class="timeline-container position-relative">
                <div class="top-right-btns">
                    <button class="btn btn-outline-primary btn-2d">2D</button>
                    <button class="btn btn-outline-success btn-3d">3D</button>
                </div>

                <div class="mb-3">
                    <div class="d-md-flex d-block gap-3">
                        <!-- Company Dropdown -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Select Company</label>
                            <select class="form-select" id="company_id" required>
                                <option value="" disabled selected>Select a Company</option>
                                <?php if ($getCompanies) : ?>
                                    <?php foreach ($getCompanies as $company) : ?>
                                        <option value="<?= $company['id']; ?>">
                                            <?= $company['company_name']; ?> (CIN: <?= $company['ciin_number']; ?>)
                                        </option>
                                    <?php endforeach; ?>
                                <?php else : ?>
                                    <option disabled>No Company Found</option>
                                <?php endif; ?>
                            </select>
                        </div>

                        <!-- Project Dropdown -->
                        <div class="mb-3 flex-grow-1">
                            <label class="form-label fw-bold">Select Project</label>
                            <select class="form-select" id="project_id">
                                <option value="" disabled selected>Select Project</option>
                            </select>
                        </div>

                        <!-- Brick Dropdown -->
                        <div class="mb-3 flex-grow-1">
                            <label class="form-label fw-bold">Select Brick</label>
                            <select class="form-select" id="brick_id">
                                <option value="" disabled selected>Select Brick</option>
                            </select>
                        </div>
                    </div>

                    <!-- Selection Type Display -->
                    <div class="alert alert-info" id="selectionTypeAlert" style="display: none;">
                        <strong>Current Selection:</strong> <span id="selectionTypeText"></span>
                    </div>
                </div>

                <div class="timeline mt-md-3" id="timeline"></div>
            </div>

            <div class="assigned-section mt-5 g-0">
                <h3 class="assigned-heading text-center">Assigned</h3>
                <div class="assigned-boxes">
                    <div class="box text-center">
                        <div class="d-flex justify-content-center align-items-center mb-2">
                            <span class="label me-2">Split %</span>
                            <select class="form-select me-2" id="mainDropdown" onchange="showSubDropdown()">
                                <option value="">Select Option</option>
                                <option value="decision">Decision Making</option>
                                <option value="project">Payment %</option>
                            </select>
                            <select class="form-select me-2 d-none" id="subDropdown">
                                <option value="1">Company</option>
                                <option value="2">Project</option>
                                <option value="3">Layer</option>
                            </select>
                        </div>
                    </div>

                    <div class="box">
                        <span class="label">Milestone</span>
                        <div class="mt-2">
                            <a href="<?= base_url('company/f') ?>" class="btn btn-sm btn-primary">Fund Now</a>
                        </div>
                    </div>
                    <div class="box"><span class="label">Sweat Equity</span></div>
                    <div class="box"><span class="label">Resume Split</span></div>
                    <div class="box"><span class="label">JV</span></div>
                </div>
            </div>

            <hr>
            <h6 class="text-center">3D</h6>
        </div>
    </div>
</div>

<?php include('includes/footer-link.php') ?>

<style>
    .timeline-container {
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
        position: relative;
    }

    .top-right-btns {
        position: absolute;
        top: 10px;
        right: 10px;
    }

    .timeline {
        position: relative;
        margin: 20px 0;
    }

    .row {
        display: flex;
        align-items: center;
        margin-bottom: 40px;
        /* Increased to prevent tooltip overlap */
    }

    .label {
        width: 200px;
        font-weight: bold;
        color: #333;
    }

    .line {
        flex-grow: 1;
        height: 2px;
        background: #007bff;
        position: relative;
        margin: 0 20px;
        min-width: 100px;
    }

    .circle {
        width: 40px;
        height: 40px;
        background: #fff;
        border: 3px solid #007bff;
        border-radius: 50%;
        position: absolute;
        top: -19px;
        transform: translateX(-50%);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        background-size: cover;
        background-position: center;
    }

    .circle-name {
        position: absolute;
        top: 45px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 12px;
        color: #333;
        white-space: nowrap;
    }

    .active-status {
        width: 10px;
        height: 10px;
        background: #28a745;
        border-radius: 50%;
        position: absolute;
        top: -5px;
        right: -5px;
    }

    .doc-icon {
        position: absolute;
        left: -20px;
        top: -12px;
        z-index: 9;
        font-size: 24px;
        color: #fd7e14;
        cursor: pointer;
        background: #fff;
        border-radius: 50%;
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        transition: all 0.2s ease;
    }

    .doc-icon:hover {
        color: #e65c00;
        transform: scale(1.1) translateY(-12px) translateX(-20px);
    }

    .assigned-section {
        padding: 20px;
        background: #fff;
        border-radius: 8px;
    }

    .assigned-boxes {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }

    .box {
        padding: 15px;
        margin: 10px;
        background: #f1f1f1;
        border-radius: 5px;
        min-width: 150px;
    }

    .label {
        font-weight: bold;
        color: #555;
    }

    .tooltip {
        display: none;
        position: absolute;
        background: #333;
        color: #fff;
        padding: 10px;
        border-radius: 5px;
        top: 60px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 20;
        font-size: 12px;
        max-width: 300px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    }

    .doc-tooltip {
        display: none;
        position: absolute;
        background: #333;
        color: #fff;
        padding: 10px;
        border-radius: 5px;
        bottom: 100%;
        left: 50%;
        transform: translateX(-50%);
        z-index: 20;
        font-size: 12px;
        max-width: 300px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        margin-bottom: 5px;
    }

    .circle:hover .tooltip,
    .doc-icon:hover .doc-tooltip {
        display: block;
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const timeline = document.getElementById("timeline");
        const companySelect = document.getElementById("company_id");
        const projectSelect = document.getElementById("project_id");
        const brickSelect = document.getElementById("brick_id");
        const agreeMentbaseUrl = '<?= base_url('Uploads/agreements') ?>';
        let currentCompanyId = null;
        let currentProjectId = null;
        let currentBrickId = null;
        let currentSelectionType = null;

        // Function to extract file name from URL or path
        function getFileName(path) {
            if (!path) return '';
            return path.split('/').pop();
        }

        // Update selection display
        function updateSelectionDisplay() {
            const alert = $('#selectionTypeAlert');
            const text = $('#selectionTypeText');

            if (currentSelectionType) {
                let displayText = '';
                switch (currentSelectionType) {
                    case 'company':
                        displayText = `Company Selected (ID: ${currentCompanyId})`;
                        break;
                    case 'project':
                        displayText = `Project Selected (ID: ${currentProjectId})`;
                        break;
                    case 'brick':
                        displayText = `Brick Selected (ID: ${currentBrickId})`;
                        break;
                }
                text.text(displayText);
                alert.show();
            } else {
                alert.hide();
            }
        }

        // Company change handler
        companySelect.addEventListener("change", function() {
            currentCompanyId = this.value;
            currentProjectId = null;
            currentBrickId = null;
            currentSelectionType = currentCompanyId ? 'company' : null;

            // Clear project and brick dropdowns
            projectSelect.innerHTML = '<option value="" disabled selected>Select Project</option>';
            brickSelect.innerHTML = '<option value="" disabled selected>Select Brick</option>';

            updateSelectionDisplay();
            timeline.innerHTML = '';

            if (currentCompanyId) {
                fetchProjects(currentCompanyId);
                fetchTeamStructure();
            }
        });

        // Project change handler
        projectSelect.addEventListener("change", function() {
            currentProjectId = this.value;
            currentBrickId = null;
            currentSelectionType = currentProjectId ? 'project' : 'company';

            // Clear brick dropdown
            brickSelect.innerHTML = '<option value="" disabled selected>Select Brick</option>';

            updateSelectionDisplay();
            timeline.innerHTML = '';

            if (currentCompanyId && currentProjectId) {
                fetchBricks(currentCompanyId, currentProjectId);
                fetchTeamStructure();
            } else if (currentCompanyId) {
                fetchTeamStructure();
            }
        });

        // Brick change handler
        brickSelect.addEventListener("change", function() {
            currentBrickId = this.value;
            currentSelectionType = currentBrickId ? 'brick' : (currentProjectId ? 'project' : 'company');

            updateSelectionDisplay();
            timeline.innerHTML = '';

            if (currentCompanyId && currentProjectId && currentBrickId) {
                fetchTeamStructure();
            } else if (currentCompanyId && currentProjectId) {
                fetchTeamStructure();
            } else if (currentCompanyId) {
                fetchTeamStructure();
            }
        });

        function fetchProjects(companyId) {
            $.ajax({
                url: '<?= base_url('Home/fetch_projects') ?>',
                type: 'POST',
                data: {
                    company_id: companyId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success && response.projects.length > 0) {
                        $.each(response.projects, function(index, project) {
                            $('#project_id').append(
                                `<option value="${project.id}">${project.project_name}</option>`
                            );
                        });
                    } else {
                        $('#project_id').append('<option disabled selected>No Project Found</option>');
                    }
                },
                error: function() {
                    alert('Error fetching projects');
                }
            });
        }

        function fetchBricks(companyId, projectId) {
            $.ajax({
                url: '<?= base_url('Home/fetch_bricks') ?>',
                type: 'POST',
                data: {
                    company_id: companyId,
                    project_id: projectId
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success && response.bricks.length > 0) {
                        $.each(response.bricks, function(index, brick) {
                            $('#brick_id').append(
                                `<option value="${brick.id}">${brick.brick_title}</option>`
                            );
                        });
                    } else {
                        $('#brick_id').append('<option disabled selected>No Brick Found</option>');
                    }
                },
                error: function() {
                    alert('Error fetching bricks');
                }
            });
        }

        function fetchTeamStructure() {
            const data = {
                company_id: currentCompanyId,
                project_id: currentProjectId,
                brick_id: currentBrickId
            };

            // Remove null or empty fields
            Object.keys(data).forEach(key => {
                if (!data[key]) delete data[key];
            });

            if (!currentCompanyId) {
                timeline.innerHTML = "<p>Please select a company.</p>";
                return;
            }

            console.log('Fetching team structure with data:', JSON.stringify(data, null, 2)); // Debug payload

            fetch('<?= base_url('Home/get_team_structure') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(data => {
                    console.log('Team structure response:', data); // Debug response
                    if (data.status === 'success') {
                        renderTimeline(data.departments);
                    } else {
                        alert(`Error: ${data.message}`);
                        timeline.innerHTML = "<p>No data found.</p>";
                    }
                })
                .catch(error => {
                    console.error('Error fetching team structure:', error);
                    alert('Failed to load team structure.');
                    timeline.innerHTML = "<p>Error loading data.</p>";
                });
        }

        function renderTimeline(departments) {
            timeline.innerHTML = "";

            departments.forEach(dept => {
                const row = document.createElement("div");
                row.className = "row";

                const shortId = dept.id.substring(0, 8); // Use first 8 chars of UUID for brevity
                const label = document.createElement("div");
                label.className = "label";
                label.innerText = `${shortId} - ${dept.name}`;
                row.appendChild(label);

                const line = document.createElement("div");
                line.className = "line agreement-start";

                const docIcon = document.createElement("div");
                docIcon.className = "doc-icon";
                docIcon.innerHTML = '<i class="fas fa-file-alt"></i>';

                const agreements = dept.agreements || [];
                const tooltip = document.createElement("div");
                tooltip.className = "doc-tooltip";
                tooltip.innerHTML = agreements.length > 0 ?
                    agreements.map(agreement => {
                        const fileName = getFileName(agreement.file_path);
                        const filePath = fileName ? `${agreeMentbaseUrl}/${fileName}` : '#';
                        return `
                    <div>
                        <a href="${filePath}" target="_blank">${agreement.file_name || 'Unnamed File'}</a>
                        <br>Uploaded: ${new Date(agreement.uploaded_at).toLocaleString()}
                    </div>`;
                    }).join('') :
                    'No agreements available';
                docIcon.appendChild(tooltip);
                docIcon.addEventListener("mouseenter", () => tooltip.style.display = "block");
                docIcon.addEventListener("mouseleave", () => tooltip.style.display = "none");

                if (agreements.length > 0 && agreements[0].file_path) {
                    docIcon.addEventListener("click", () => {
                        const fileName = getFileName(agreements[0].file_path);
                        if (fileName) {
                            const filePath = `${agreeMentbaseUrl}/${fileName}`;
                            window.open(filePath, '_blank');
                        } else {
                            console.warn("Invalid file path for agreement:", agreements[0].file_path);
                        }
                    });
                }

                line.appendChild(docIcon);

                const membersArray = dept.members ? Object.values(dept.members) : [];
                const totalCircles = membersArray.length;

                membersArray.forEach((member, index) => {
                    const circle = document.createElement("div");
                    circle.className = "circle";
                    circle.dataset.memberId = member.id;
                    circle.style.backgroundImage = `url(${member.avatar})`;

                    const position = totalCircles <= 1 ? 50 : (index / (totalCircles - 1)) * (100 - 10) + 5;
                    circle.style.left = `${position}%`;

                    const onlineDiv = document.createElement("div");
                    onlineDiv.className = "active-status";
                    circle.appendChild(onlineDiv);

                    const nameSpan = document.createElement("span");
                    nameSpan.className = "circle-name";
                    nameSpan.innerText = `${shortId} - ${member.name} (${member.nickname || 'N/A'})`;
                    circle.appendChild(nameSpan);

                    const tooltip = document.createElement("div");
                    tooltip.className = "tooltip";
                    tooltip.innerHTML = `<div>${member.name} (${member.email})</div>`;
                    circle.appendChild(tooltip);
                    circle.addEventListener("mouseenter", () => tooltip.style.display = "block");
                    circle.addEventListener("mouseleave", () => tooltip.style.display = "none");
                    line.appendChild(circle);
                });

                row.appendChild(line);
                timeline.appendChild(row);
            });
        }

        function showSubDropdown() {
            const mainDropdown = document.getElementById("mainDropdown");
            const subDropdown = document.getElementById("subDropdown");
            if (mainDropdown.value) {
                subDropdown.classList.remove("d-none");
            } else {
                subDropdown.classList.add("d-none");
            }
        }
    });
</script>

<!-- Shiv Web Developer  -->
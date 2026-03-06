<?php include('includes/header.php') ?>
<!-- Shiv Web Developer.  -->
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header py-3 p-0 pt-0 bg-transparent border-bottom-0 m-auto">
                    <div class="card-body">
                        <form>
                            <h2 class="text-center mb-md-5">Add Team</h2>
                            <div class="row">
                                <div class="d-md-flex d-block gap-0">
                                    <div class="flex-grow-1">
                                        <label class="form-label">Search Company</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white d-flex align-items-center">
                                                <i class="fa fa-search text-muted"></i>
                                            </span>
                                            <select class="form-control mb-0" name="company_id" id="company_id">
                                                <?php if ($getCompanies) {
                                                ?>
                                                    <?php
                                                    foreach ($getCompanies as $company) { ?>
                                                        <option value="<?= $company['id']; ?>" <?= (isset($task['company_id']) && $task['company_id'] == $company['id']) ? 'selected' : (set_value('company_id') == $company['id'] ? 'selected' : '') ?>><?= $company['company_name']; ?> (CIN: <?= $company['ciin_number']; ?>)</option>
                                                    <?php }
                                                } else {
                                                    ?>
                                                    <option disabled selected>No Company Found</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <!-- <input type="text" class="form-control mt-2" placeholder="Selected Company" value="TCS"> -->
                                    </div>

                                    <div class="flex-grow-1">
                                        <label class="form-label">Search Project</label>
                                        <div class="input-group">
                                            <select class="form-control mb-0" name="company_id" id="company_id">
                                                <?php if ($getCompanies) {
                                                ?>
                                                    <option disabled selected>Select Project</option>
                                                    <?php
                                                    foreach ($getCompanies as $company) { ?>
                                                        <option value="<?= $company['id']; ?>" <?= (isset($task['company_id']) && $task['company_id'] == $company['id']) ? 'selected' : (set_value('company_id') == $company['id'] ? 'selected' : '') ?>><?= $company['company_name']; ?> (CIN: <?= $company['ciin_number']; ?>)</option>
                                                    <?php }
                                                } else {
                                                    ?>
                                                    <option disabled selected>No Project Found</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <!-- <input type="text" class="form-control mt-2" placeholder="Selected Project" value="Website Redesign"> -->
                                    </div>

                                    <div class="flex-grow-1 d-none">
                                        <label class="form-label">Search Brick</label>
                                        <div class="input-group">
                                            <select class="form-control mb-0" name="company_id" id="company_id">
                                                <?php if ($getCompanies) {
                                                ?>
                                                    <option disabled selected>Search Brick</option>
                                                    <?php
                                                    foreach ($getCompanies as $company) { ?>
                                                        <option value="<?= $company['id']; ?>" <?= (isset($task['company_id']) && $task['company_id'] == $company['id']) ? 'selected' : (set_value('company_id') == $company['id'] ? 'selected' : '') ?>><?= $company['company_name']; ?> (CIN: <?= $company['ciin_number']; ?>)</option>
                                                    <?php }
                                                } else {
                                                    ?>
                                                    <option disabled selected>No Brick Found</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <!-- <input type="text" class="form-control mt-2" placeholder="Selected Brick" value="Design Company"> -->
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-3" style="border-bottom: 1px dotted;padding-bottom: 14px;">
                                    <!-- <button type="button" class="btn btn-primary">Save</button> -->
                                </div>
                            </div>

                            <div class="row">
                                <div class="mb-3 col-md-10 col-12 row align-items-center">
                                    <div class="col-md-9">
                                        <label class="col-form-label">Search User</label>
                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="bi bi-search"></i>
                                            </span>
                                            <input class="form-control" id="team-member-input" name='users-list-tags' placeholder='Search user by name' value=''>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <label></label>
                                        <button type="button" class="btn btn-primary mt-1 w-100" id="saveTeamMembers">Save</button>
                                    </div>

                                </div>

                                <!-- <div class="mb-3 col-md-4 col-12">
                                    <label class="col-form-label">Identity Document
                                        <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Merge Any 2 Documents"></i>
                                    </label>
                                    <div class="input-group">
                                        <select class="form-select" id="docTypeSelect">
                                            <option selected disabled>Select Document Type</option>
                                            <option value="aadhaar">Aadhar Card</option>
                                            <option value="pan">PAN Card</option>
                                            <option value="driving">Driving License</option>
                                            <option value="passport">Passport</option>
                                        </select>

                                        <label class="input-group-text" for="uploadDoc" style="cursor: pointer;">
                                            <i class="bi bi-upload"></i>
                                        </label>
                                        <input type="file" id="uploadDoc" style="display: none;">
                                    </div>
                                </div>

                                <div class="mb-4 col-md-4 col-12">
                                    <label class="col-form-label">Agreement</label>
                                    <div class="input-group">
                                        <input type="file" class="form-control" id="agreementInput">
                                        <span id="handshakeIcon" class="input-group-text">
                                            <i class="fas fa-handshake text-primary"></i>
                                        </span>
                                    </div>
                                </div> -->
                            </div>
                            <div class="d-flex justify-content-center mt-3" style="border-bottom: 1px dotted;padding-bottom: 14px;">
                                <!-- <button type="button" class="btn btn-primary">Save</button> -->
                            </div>
                            <div class="row">

                                <div class="mb-3 col-md-4" style="border-right: 1px solid rgba(0,0,0,0.1)">


                                    <!-- <select class="form-control mb-0" name="company_id" id="company_id">
                                        <?php if ($getCompanies) {
                                        ?>
                                            <option disabled selected>Select Company</option>
                                            <?php
                                            foreach ($getCompanies as $company) { ?>
                                                <option value="<?= $company['id']; ?>" <?= (isset($task['company_id']) && $task['company_id'] == $company['id']) ? 'selected' : (set_value('company_id') == $company['id'] ? 'selected' : '') ?>><?= $company['company_name']; ?> (CIN: <?= $company['ciin_number']; ?>)</option>
                                            <?php }
                                        } else {
                                            ?>
                                            <option disabled selected>No Company Found</option>
                                        <?php } ?>
                                    </select> -->

                                    <label class="col-form-label mt-2 mb-0">Total Number of Departments</label>
                                    <input type="text" class="form-control w-80" id="number-of-layers" placeholder="Total number of departments">

                                    <!-- Section 2: Upload Agreement -->

                                    <!-- Section 3: Give Name to each Department -->
                                    <div class="mt-4">
                                        <label class="col-form-label">Give Name to each Department</label>
                                        <div class="d-flex align-items-center mb-3">
                                            <select class="form-control w-50 me-2" id="all-layers">
                                                <option disabled selected>No Layers Found</option>
                                            </select>
                                            <input type="text" id="layerName" class="form-control w-50" placeholder="Layer Name" list="layerOptions">
                                            <datalist id="layerOptions">
                                                <option value="R&D & Innovation">
                                                <option value="Vendor listing">
                                                <option value="Manufacturing">
                                                <option value="Production">
                                                <option value="Quality check">
                                                <option value="Warehousing/storage">
                                                <option value="Logistics / Supply chain">
                                                <option value="Operational">
                                                <option value="Investor relations">
                                                <option value="HR">
                                                <option value="Sales">
                                                <option value="Marketing">
                                                <option value="Account">
                                                <option value="Public relation">
                                                <option value="Management">
                                                <option value="Top Leaders">
                                                <option value="Growth strategy / Merger-acquisition">
                                            </datalist>
                                        </div>
                                        <div class="mt-2">
                                            <label for="agreementUpload" class="form-label">Upload Agreement</label>
                                            <input class="form-control" type="file" id="agreementUpload" name="agreement_upload" accept=".pdf,.doc,.docx">
                                            <small class="text-muted">Supported formats: PDF, DOC, DOCX</small>
                                        </div>
                                        <button id="updateLayerName" class="btn btn-primary mt-2" type="button">Update Layers</button>
                                    </div>
                                </div>

                                <div class="mb-3 col-md-4" style="border-right: 1px solid rgba(0,0,0,0.1)">
                                    <label class="col-form-label">Give Team to each Depatment</label>
                                    <div class="d-flex flex-wrap">
                                        <div class="d-flex align-items-center w-100 mb-2">
                                            <select class="form-control me-2" id="collaboratorLayerSelect">
                                                <option disabled selected>No Depatment Found</option>
                                            </select>
                                            <input type="text" class="form-control" id="extractedNameOfLayer" placeholder="Layer Name" readonly>
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label class="col-form-label">Define Number of Team to this Depatment</label>
                                            <div class="d-flex align-items-center">
                                                <input type="text" class="form-control w-50" id="max-num" placeholder="Max Num">
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <label class="col-form-label">Give Name to each Team</label>
                                            <div class="d-flex align-items-center">
                                                <select class="form-control w-50 me-2" id="teamSelectDropdown">
                                                </select>
                                                <input type="text" class="form-control w-50" placeholder="Team Name" id="teamMemberName">
                                                <input type="text" class="form-control w-50" placeholder="Nick Name" id="teamMemberNickName">
                                            </div>
                                        </div>
                                    </div>
                                    <button id="saveTeamToDepartment" class="btn btn-success mt-2" type="button">Save Department Data</button>
                                </div>

                                <div class="mb-5 pb-5 col-md-4 col-12">
                                    <label class="col-form-label">Give Connections to each Team</label>
                                    <div class="d-flex flex-wrap">
                                        <div class="d-flex align-items-center w-100 mb-2">
                                            <select class="form-control w-50 me-2">
                                                <option value="Layer 1">Depatment 1</option>
                                                <option value="Layer 2">Depatment 2</option>
                                                <option value="Layer 3">Depatment 3</option>
                                                <option value="Layer 4">Depatment 4</option>
                                                <option value="Layer 5">Depatment 5</option>
                                            </select>
                                            <input type="text" class="form-control w-50" placeholder="Layer Name" readonly>
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <div class="d-flex align-items-center">
                                                <select class="form-control w-50 me-2">
                                                    <option value="Layer 1">Team 1</option>
                                                    <option value="Layer 2">Team 2</option>
                                                    <option value="Layer 3">Team 3</option>
                                                    <option value="Layer 4">Team 4</option>
                                                    <option value="Layer 5">Team 5</option>
                                                </select>
                                                <input type="text" class="form-control w-50" placeholder="Team Name" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex flex-wrap">
                                        <div class="d-flex align-items-center w-100 mb-2">
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <div class="d-flex align-items-center">
                                            </div>
                                        </div>
                                    </div>
                                    <!--  -->
                                    <div class="d-flex flex-wrap">
                                        <div class="d-flex align-items-center w-100 mb-2">
                                            <select class="form-control w-50 me-2">
                                                <option value="Layer 1">Depatment 1</option>
                                                <option value="Layer 2">Depatment 2</option>
                                                <option value="Layer 3">Depatment 3</option>
                                                <option value="Layer 4">Depatment 4</option>
                                                <option value="Layer 5">Depatment 5</option>
                                            </select>
                                            <input type="text" class="form-control w-50" placeholder="Layer Name" readonly>
                                        </div>
                                        <div class="mb-3 col-md-12">
                                            <div class="d-flex align-items-center">
                                                <select class="form-control w-50 me-2">
                                                    <option value="Layer 1">Team 1</option>
                                                    <option value="Layer 2">Team 2</option>
                                                    <option value="Layer 3">Team 3</option>
                                                    <option value="Layer 4">Team 4</option>
                                                    <option value="Layer 5">Team 5</option>
                                                </select>
                                                <input type="text" class="form-control w-50" placeholder="Team Name" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3 d-flex justify-content-center">
                                        <button type="submit" class="btn btn-secondary" style="border-radius: 10px 0px 0px 10px">Define Relation</button>
                                        <button class="btn custom-upload-btn pdf-upload-btn">
                                            <i class="fa fa-plus"></i>Agreement
                                        </button>
                                    </div>
                                    <!-- <button class="btn custom-upload-btn pdf-upload-btn">
                                    <i class="fa fa-plus"></i>Agreement
                                </button> -->
                                </div>



                                <div class="col-12 d-flex justify-content-center">
                                    <button type="submit" class="btn btn-primary">On Board</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Department Configuration -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Number of Departments</label>
                    <input type="number" class="form-control w-25" id="num-departments" min="1" placeholder="e.g., 3" required>
                </div>

                <!-- Dynamic Department List -->
                <div id="department-list" class="mb-4">
                    <label class="form-label fw-bold">Department Names</label>
                    <div id="departments-container" class="border rounded p-3 bg-light"></div>
                </div>

                <!-- Team Member Assignment -->
                <div class="mb-4">
                    <label class="form-label fw-bold">Assign Team Members</label>
                    <div class="border rounded p-3 bg-light">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <select class="form-select" id="department-select" required>
                                    <option value="" disabled selected>Select Department</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <input class="form-control" id="team-member-input" name="users-list-tags" placeholder="Search user by name">
                            </div>
                        </div>
                        <div id="nickname-container" class="mb-3"></div>
                        <button type="button" class="btn btn-primary mt-2" id="saveTeamMembers">Add Members</button>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-success btn-lg">Save Team Structure</button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <?php include('includes/footer-link.php') ?>

    <script src="https://cdn.jsdelivr.net/npm/tagify@4.17.0/dist/tagify.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/tagify@4.17.0/dist/tagify.css" rel="stylesheet">
    <!-- Shiv Web Developer.  -->
    <style>
        .department-item {
            padding: 10px;
            margin-bottom: 10px;
            background: white;
            border-radius: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .department-item input {
            flex-grow: 1;
        }

        .tagify {
            border: 1px solid #ced4da;
            border-radius: 0.25rem;
        }

        .tagify__tag {
            background: #e9ecef;
        }

        .nickname-item {
            padding: 10px;
            margin-bottom: 10px;
            background: white;
            border-radius: 5px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .nickname-item input {
            flex-grow: 1;
        }
    </style>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const companySelect = document.getElementById("company_id");
            const numDepartmentsInput = document.getElementById("num-departments");
            const departmentsContainer = document.getElementById("departments-container");
            const departmentSelect = document.getElementById("department-select");
            const teamMemberInput = document.getElementById("team-member-input");
            const nicknameContainer = document.getElementById("nickname-container");
            const saveTeamMembersBtn = document.getElementById("saveTeamMembers");
            const teamForm = document.getElementById("teamForm");

            let departments = [];
            let users = [];
            let selectedMembers = [];

            // Initialize Tagify
            let tagify;
            fetch('<?= base_url('Home/getSearchUsers') ?>')
                .then(response => response.json())
                .then(data => {
                    users = data;
                    tagify = new Tagify(teamMemberInput, {
                        tagTextProp: 'name',
                        enforceWhitelist: true,
                        skipInvalid: true,
                        dropdown: {
                            closeOnSelect: false,
                            enabled: 0,
                            classname: 'users-list',
                            searchKeys: ['name', 'email']
                        },
                        templates: {
                            tag: function(tagData) {
                                return `
                            <tag title="${tagData.email}" contenteditable='false' spellcheck='false' tabIndex="-1" class="tagify__tag ${tagData.class || ''}" ${this.getAttributes(tagData)}>
                                <x title='' class='tagify__tag__removeBtn' role='button' aria-label='remove tag'></x>
                                <div class='d-flex align-items-start'>
                                    <div class='tagify__tag__avatar-wrap'>
                                        <img class="avatar xs rounded-circle me-2" onerror="this.style.visibility='hidden'" src="${tagData.avatar}">
                                    </div>
                                    <div class='flex-grow-1 d-flex flex-column'>
                                        <span class='tagify__tag-text'>${tagData.name}</span>
                                        <span class='tagify__tag-text'>${tagData.email}</span>
                                    </div>
                                </div>
                            </tag>
                        `;
                            },
                            dropdownItem: function(tagData) {
                                return `
                            <div ${this.getAttributes(tagData)} class='tagify__dropdown__item d-flex align-items-center ${tagData.class || ''}' tabindex="0" role="option">
                                ${tagData.avatar ? `
                                <div class='tagify__dropdown__item__avatar-wrap'>
                                    <img onerror="this.style.visibility='hidden'" class="avatar rounded me-2" src="${tagData.avatar}">
                                </div>` : ''}
                                <div class="flex-grow-1 d-flex flex-column">
                                    <span class='tagify__dropdown__item__name'>${tagData.name}</span>
                                    <span class='tagify__dropdown__item__email'>${tagData.email}</span>
                                </div>
                            </div>
                        `;
                            },
                            dropdownHeader: function(suggestions) {
                                return `<div class="${this.settings.classNames.dropdownItem}__addAll"><span>${suggestions.length} members</span></div>`;
                            }
                        },
                        whitelist: users,
                        callbacks: {
                            add: (e) => {
                                selectedMembers = tagify.value;
                                updateNicknameInputs();
                            },
                            remove: (e) => {
                                selectedMembers = tagify.value;
                                updateNicknameInputs();
                            }
                        }
                    });
                })
                .catch(error => console.error('Error loading user tags:', error));

            // Generate Department Inputs
            numDepartmentsInput.addEventListener("input", function() {
                const count = parseInt(this.value);
                if (isNaN(count) || count < 1) return;

                departments = Array.from({
                    length: count
                }, (_, i) => ({
                    id: `dept-${i + 1}`,
                    name: `Department ${i + 1}`,
                    company_id: companySelect.value
                }));
                renderDepartments();
            });

            // Render Department Inputs
            function renderDepartments() {
                departmentsContainer.innerHTML = "";
                departmentSelect.innerHTML = '<option value="" disabled selected>Select Department</option>';

                departments.forEach((dept, index) => {
                    const deptDiv = document.createElement("div");
                    deptDiv.className = "department-item";
                    deptDiv.innerHTML = `
                <input type="text" class="form-control" value="${dept.name}" placeholder="Department Name" data-index="${index}">
                <button type="button" class="btn btn-danger btn-sm remove-dept" data-index="${index}"><i class="bi bi-trash"></i></button>
            `;
                    departmentsContainer.appendChild(deptDiv);

                    const option = document.createElement("option");
                    option.value = dept.id;
                    option.textContent = dept.name;
                    departmentSelect.appendChild(option);
                });

                // Update department names on input
                departmentsContainer.querySelectorAll("input").forEach(input => {
                    input.addEventListener("input", function() {
                        const index = this.dataset.index;
                        departments[index].name = this.value;
                        updateDepartmentSelect();
                    });
                });

                // Remove department
                departmentsContainer.querySelectorAll(".remove-dept").forEach(btn => {
                    btn.addEventListener("click", function() {
                        const index = this.dataset.index;
                        departments.splice(index, 1);
                        renderDepartments();
                    });
                });

                updateDepartmentSelect();
            }

            // Update Department Select Dropdown
            function updateDepartmentSelect() {
                departmentSelect.innerHTML = '<option value="" disabled selected>Select Department</option>';
                departments.forEach(dept => {
                    const option = document.createElement("option");
                    option.value = dept.id;
                    option.textContent = dept.name;
                    departmentSelect.appendChild(option);
                });
            }

            // Update nickname inputs when members are selected
            function updateNicknameInputs() {
                nicknameContainer.innerHTML = '';

                selectedMembers.forEach((member, index) => {
                    const div = document.createElement('div');
                    div.className = 'nickname-item';
                    div.innerHTML = `
                <span>${member.name}</span>
                <input type="text" class="form-control" placeholder="Enter nickname for ${member.name}" data-member-id="${member.id}">
            `;
                    nicknameContainer.appendChild(div);
                });
            }

            // Save Team Members
            saveTeamMembersBtn.addEventListener("click", function() {
                const departmentId = departmentSelect.value;
                const companyId = companySelect.value;

                if (!departmentId || !companyId) {
                    alert("Please select a company and department.");
                    return;
                }

                if (!selectedMembers.length) {
                    alert("Please select at least one team member.");
                    return;
                }
                console.log("Selected Members:", selectedMembers);
                const membersWithNicknames = selectedMembers.map(member => {
                    const nicknameInput = nicknameContainer.querySelector(`input[data-member-id="${member.id}"]`);
                    return {
                        id: member.value,
                        name: member.name,
                        email: member.email,
                        nickname: nicknameInput ? nicknameInput.value.trim() : ''
                    };
                });

                fetch('<?= base_url() ?>Home/addTeamMemberToDepartment', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            departmentId,
                            companyId,
                            members: membersWithNicknames
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        console.log("Team Insert Response:", data);
                        if (data.status === 'success') {
                            alert(`✅ Added: ${data.inserted.map(m => m.name).join(', ')}`);
                            teamMemberInput.value = '';
                            selectedMembers = [];
                            updateNicknameInputs();
                        } else {
                            alert(`❌ Error: ${data.message}`);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('❌ Failed to add team members.');
                    });
            });

            // Save Entire Team Structure
            teamForm.addEventListener("submit", async function(e) {
                e.preventDefault();
                const companyId = companySelect.value;
                if (!companyId || departments.length === 0) {
                    alert("Please select a company and define at least one department.");
                    return;
                }

                const payload = {
                    company_id: companyId,
                    departments: departments.map(dept => ({
                        id: dept.id,
                        name: dept.name
                    }))
                };

                try {
                    const response = await fetch('<?= base_url() ?>Home/save_team_structure', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(payload)
                    });
                    const result = await response.json();
                    if (result.status === 'success') {
                        alert('Team structure saved successfully!');
                        window.location.reload();
                    } else {
                        alert(`Error: ${result.message}`);
                    }
                } catch (error) {
                    console.error('Error:', error);
                    alert('Failed to save team structure.');
                }
            });

            // Load Existing Data
            companySelect.addEventListener("change", async function() {
                const companyId = this.value;
                if (!companyId) return;

                try {
                    const response = await fetch('<?= base_url() ?>Home/get_team_structure', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({
                            company_id: companyId
                        })
                    });
                    const result = await response.json();
                    if (result.status === 'success') {
                        departments = result.departments || [];
                        numDepartmentsInput.value = departments.length;
                        renderDepartments();
                    }
                } catch (error) {
                    console.error('Error loading team structure:', error);
                }
            });
        });
    </script>
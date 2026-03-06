<?php include('includes/header.php') ?>

<style>
    .timeline_container{
        /* border: 1px solid #e3e3e3; */
        /* background: #f8f9fa; */
        padding: 28px 48px;
        position: relative;
        z-index: 2;
        background: transparent !important;
    }
    .timeline_wrapper{
        position: relative;
        min-height: 500px;
        background: #f8f9fa;
        z-index: 0;
    }
    #connectionLayer{
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        pointer-events: none;
        overflow: visible;  
    }
    .my_timeline{
        position: relative;
        height: 1px;
        display: flex;
        justify-content: space-evenly;
    }
    .my_timeline_line{
        position: absolute;
        height: 1px;
        width: 100%;
        background: #e3e3e3;
    }
    .context-menu {
        position: absolute;
        background: #fff;
        border: 1px solid #ccc;
        display: none;
        z-index: 1000;
        width: 200px;
    }
    .context-menu ul {
        list-style: none;
        margin: 0;
        padding: 5px 0;
    }

    .context-menu li {
        padding: 6px 12px;
        cursor: pointer;
    }

    .context-menu li:hover {
        background: #f1f1f1;
    }

    .menu-item {
        padding: 8px 12px;
        cursor: pointer;
    }

    .menu-item:hover {
        background: #f0f0f0;
    }

    .timeline-users {
        display: inline-flex;
        gap: 20px;
        height: 50px;
        width: 100%;
        justify-content: center;
        position: absolute;
        top: 35px;
        transform: translate(0px, -50%);
        align-items: center;
        flex-direction: row;
    }

    .timeline-user {
        position: relative;
        z-index: 3;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 4px;
        max-width: 75px;
        min-width: 75px;
        padding: 4px 8px;
        /* background: #fff; */
        border-radius: 20px;
        cursor: grab;
    }

    .timeline-user a {
        text-align: center;
        text-decoration: none;
        color: black;
    }

    .timeline-user a .user-avatar {
        width: 35px;
        height: 35px;
        aspect-ratio: 1;
        object-fit: cover;
        border-radius: 50%;
        /* border: 1px solid blue; */
    }

    .timeline-user a span {
        font-size: 12px;
        text-align: center;
        white-space: nowrap;
    }

    .tagify__input {
        background: gainsboro;
        min-width: 150px;
    }

    .timeline-user.dragging {
        opacity: 0.5;
    }

    .connection-source {
        border: 3px solid #0d6efd !important; /* Blue border */
        box-shadow: 0 0 10px rgba(13, 110, 253, 0.5);
        background-color: #e9ecef;
        transform: scale(1.05);
        transition: all 0.2s ease;
    }

</style>

<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header py-3 p-0 pt-0 bg-transparent border-bottom-0 m-auto">
                    <div class="card-body">
                        <form>
                            <!-- Team Member Result Modal -->
                            <div class="modal fade" id="teamMemberResultModal" tabindex="-1" aria-labelledby="teamMemberResultModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="teamMemberResultModalLabel">Team Member Addition Results</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div id="teamMemberResults">
                                                <!-- Results will be populated here -->
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Shiv Web Developer  -->
                            <!-- Edit Department Modal -->
                            <div class="modal fade" id="editDepartmentModal" tabindex="-1" aria-labelledby="editDepartmentModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editDepartmentModalLabel">Edit Department</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="editDepartmentName" class="form-label">Department Name</label>
                                                <input type="text" class="form-control" id="editDepartmentName" placeholder="Enter department name">
                                                <input type="hidden" id="editDepartmentId">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Team Members</label>
                                                <div id="editTeamMembersContainer">
                                                    <!-- Team members will be loaded here -->
                                                </div>
                                                <button type="button" class="btn btn-sm btn-outline-primary mt-2" id="addNewMemberBtn">
                                                    <i class="fa fa-plus"></i> Add New Member
                                                </button>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="button" class="btn btn-danger" id="deleteDepartmentBtn">Delete Department</button>
                                            <button type="button" class="btn btn-primary" id="saveDepartmentChanges">Save Changes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h2 class="text-center mb-md-5 ">Manage Team Structure</h2>

                            <style>
                                /* Default style */
                                .team_buttonActive {
                                    background-color: white !important;
                                    color: black !important;
                                }

                                /* Hover effect */
                                /* .team_buttonActive:hover {
                                    background-color: #00B8D6 !important;
                                    color: white !important;
                                } */

                                /* Active/Checked button */
                                .btn-check:checked+.team_buttonActive {
                                    background-color: #00B8D6 !important;
                                    color: white !important;
                                }
                            </style>

                            <div class="row">
                                <div class="d-md-flex d-block gap-0">
                                    <!-- Company Dropdown -->
                                    <div class="col-md-4">
                                        <label class="form-label">Search Company</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white d-flex align-items-center">
                                                <i class="fa fa-search text-muted"></i>
                                            </span>
                                            <select class="form-control mb-0" name="company_id" id="company_id">
                                                <option disabled selected>Select Company</option>
                                                <?php if ($getCompanies) {
                                                    foreach ($getCompanies as $company) { ?>
                                                        <option value="<?= $company['id']; ?>">
                                                            <?= $company['company_name']; ?> (CIN: <?= $company['ciin_number']; ?>)
                                                        </option>
                                                    <?php }
                                                } else { ?>
                                                    <option disabled selected>No Company Found</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Project Dropdown -->
                                    <div class="col-md-4">
                                        <label class="form-label">Search Project</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white d-flex align-items-center">
                                                <i class="fa fa-search text-muted"></i>
                                            </span>
                                            <select class="form-control mb-0" name="project_id" id="project_id">
                                                <option disabled selected>Select Project</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Brick Dropdown -->
                                    <div class="col-md-4">
                                        <label class="form-label">Search Brick</label>
                                        <div class="input-group">
                                            <span class="input-group-text bg-white d-flex align-items-center">
                                                <i class="fa fa-search text-muted"></i>
                                            </span>
                                            <select class="form-control mb-0" name="brick_id" id="brick_id">
                                                <option disabled selected>Select Brick</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- Selection Type Display -->
                                <div class="col-12 mt-3">
                                    <div class="alert alert-info d-flex justify-content-between gap-3 align-items-center" id="selectionTypeAlert" style="display: none;">
                                        <div class="d-flex align-items-center">
                                            <strong>Current Selection:</strong> <span id="selectionTypeText"></span>
                                            <span id="modeIndicator" class="badge bg-primary"></span>
                                        </div>
                                        <a id="selectionTypeEyeBtn" href="" title="View Details" class="">
											<i class="bi bi-eye-fill eye-icon ms-auto"></i>
										</a>
                                    </div>
                                </div>
                                
                                <div class="">
                                    <button type="button" class="btn btn-sm btn-primary mx-auto">save</button>
                                </div>
                                <!-- Mode Toggle -->
                                <div class="row mb-4">
                                    <div class="col-12 text-center">
                                        <div class="btn-group" role="group" aria-label="Mode selection">
                                            <input type="radio" class="btn-check" name="mode" id="editMode" value="edit">
                                            <label class="btn btn-outline-success team_buttonActive" for="editMode">Edit Existing Team</label>
                                            <input type="radio" class="btn-check" name="mode" id="addMode" value="add">
                                            <label class="btn btn-outline-primary team_buttonActive" for="addMode">Add New Team</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center mt-1" style="border-bottom: 1px dotted;padding-bottom: 14px;"></div>
                            </div>

                            <!-- Existing Team Structure Display (Edit Mode) -->
                            <!-- <div id="existingTeamStructure" style="display: none;">
                                <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h4 class="text-primary">Existing Team Structure</h4>
                                            <button type="button" class="btn btn-success" id="addNewDepartmentBtn">
                                                <i class="fa fa-plus"></i> Add New Department
                                            </button>
                                        </div> -->
                            <!-- <div id="existingDepartmentsList"> -->
                            <!-- Existing departments will be loaded here -->
                            <!-- </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-3 mb-3" style="border-bottom: 1px dotted;padding-bottom: 14px;"></div>
                            </div> -->

                            <!-- 1D Module -->
                            <div id="oneDModule">
                                <div class="text-center">
                                    <span class="bg-secondary text-white p-2 rounded">1D - Simple Team Addition</span>
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
                                            <button type="button" class="btn btn-primary mt-1 w-100" id="saveTeamMembers">Request Onboard</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-3 mb-3" style="border-bottom: 1px dotted;padding-bottom: 14px;"></div>
                            </div>

                            <!-- 2D Module -->
                            <div id="twoDModule">
                                <div class="text-center">
                                    <span class="bg-secondary text-white p-2 rounded">2D - Department Structure</span>
                                </div>
                                <div class="row">
                                    <!-- Department Creation Section -->
                                    <div class="mb-3 col-md-4" style="border-right: 1px solid rgba(0,0,0,0.1)">
                                        <label class="col-form-label mt-2 mb-0">Total Number of Departments</label>
                                        <input type="number" class="form-control w-80" id="number-of-departments" placeholder="Total number of departments" min="1" max="20">

                                        <div class="mt-4">
                                            <label class="col-form-label">Give Name to each Department</label>
                                            <div class="d-flex align-items-center mb-3">
                                                <select class="form-control w-50 me-2" id="department-dropdown">
                                                    <option disabled selected>No Departments Found</option>
                                                </select>
                                                <input type="text" id="departmentName" class="form-control w-50" placeholder="Department Name" list="departmentOptions">
                                                <datalist id="departmentOptions">
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
                                                <input class="form-control" type="file" id="agreementUpload" name="agreement_file" accept=".pdf,.doc,.docx">
                                                <small class="text-muted">Supported formats: PDF, DOC, DOCX (Max: 5MB)</small>
                                                <div id="agreement-status" class="mt-1"></div>
                                            </div>
                                            <button id="updateDepartment" class="btn btn-primary mt-2" type="button" disabled>Update Department</button>
                                        </div>
                                    </div>

                                    <!-- Team Assignment Section -->
                                    <div class="mb-3 col-md-4" style="border-right: 1px solid rgba(0,0,0,0.1)">
                                        <label class="col-form-label">Give Team to each Department</label>
                                        <div class="d-flex flex-wrap">
                                            <div class="d-flex align-items-center w-100 mb-2">
                                                <select class="form-control me-2" id="departmentSelect">
                                                    <option disabled selected>No Department Found</option>
                                                </select>
                                                <input type="text" class="form-control" id="selectedDepartmentName" placeholder="Department Name" readonly>
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label class="col-form-label">Define Number of Team to this Department</label>
                                                <div class="d-flex align-items-center">
                                                    <input type="number" class="form-control w-50" id="max-team-members" placeholder="Max Members" min="1" max="50">
                                                </div>
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <label class="col-form-label">Give Name to each Team</label>
                                                <div id="team-members-container">
                                                    <!-- Dynamic team member inputs will be generated here -->
                                                </div>
                                            </div>
                                        </div>
                                        <button id="saveDepartmentTeam" class="btn btn-success mt-2" type="button">Save Department</button>
                                    </div>

                                    <!-- Give Connections to each Team Section -->
                                    <div class="mb-5 pb-5 col-md-4 col-12">
                                        <label class="col-form-label">Give Connections to each Team</label>
                                        <div class="d-flex flex-wrap">
                                            <div class="d-flex align-items-center w-100 mb-2">
                                                <select class="form-control w-50 me-2">
                                                    <option value="Layer 1">Department 1</option>
                                                    <option value="Layer 2">Department 2</option>
                                                    <option value="Layer 3">Department 3</option>
                                                    <option value="Layer 4">Department 4</option>
                                                    <option value="Layer 5">Department 5</option>
                                                </select>
                                                <input type="text" class="form-control w-50" placeholder="Department Name" readonly>
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <div class="d-flex align-items-center">
                                                    <select class="form-control w-50 me-2">
                                                        <option value="Team 1">Team 1</option>
                                                        <option value="Team 2">Team 2</option>
                                                        <option value="Team 3">Team 3</option>
                                                        <option value="Team 4">Team 4</option>
                                                        <option value="Team 5">Team 5</option>
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
                                        <div class="d-flex flex-wrap">
                                            <div class="d-flex align-items-center w-100 mb-2">
                                                <select class="form-control w-50 me-2">
                                                    <option value="Department 1">Department 1</option>
                                                    <option value="Department 2">Department 2</option>
                                                    <option value="Department 3">Department 3</option>
                                                    <option value="Department 4">Department 4</option>
                                                    <option value="Department 5">Department 5</option>
                                                </select>
                                                <input type="text" class="form-control w-50" placeholder="Department Name" readonly>
                                            </div>
                                            <div class="mb-3 col-md-12">
                                                <div class="d-flex align-items-center">
                                                    <select class="form-control w-50 me-2">
                                                        <option value="Team 1">Team 1</option>
                                                        <option value="Team 2">Team 2</option>
                                                        <option value="Team 3">Team 3</option>
                                                        <option value="Team 4">Team 4</option>
                                                        <option value="Team 5">Team 5</option>
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
                                            <button id="saveTeamStructure" class="btn btn-primary">Save Team Structure</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-3 mb-3" style="border-bottom: 1px dotted;padding-bottom: 14px;"></div>
                            </div>
                            
                            <div class="text-center">
                                <span class="bg-secondary text-white p-2 rounded">3D - Module </span>
                            </div>
                            <div class="3dmodule-section mb-5 pb-5 mt-3">
                                <div class="text-center">
                                    <strong> This is 3D Module Area. </strong>
                                </div>
                                <div class="3dmodule-section-container text-center">
                                    Welcome to 3D Module Area.
                                </div>
                            </div>
                            
                        </form>
                                <div class="d-flex justify-content-center mt-3 mb-3" style="border-bottom: 1px dotted;padding-bottom: 14px;"></div>


                        <div class="text-center">
                            <span class="bg-secondary text-white p-2 rounded">Artificial Family Tree </span>
                        </div>
                        <div class="3dmodule-section mb-5 pb-5 mt-3">
                            <div class="text-center">
                                <strong> Artificial Family Tree </strong>
                            </div>
                            <div class="3dmodule-section-container text-center">
                                Welcome to Artificial Family Tree .
                            </div>
                        </div>

                        <form action="<?= base_url('/home/create_tree') ?>" method="POST">
                            <div class="row w-100">
                                <div class="col-auto">
                                    <label class="form-label" for="">Tree/Family/Project Nomencleture/Name</label>
                                    <input class="form-control" type="text" name="title" min="0">
                                </div>
                                <div class="col-auto">
                                    <label class="form-label" for="">Timeline Count</label>
                                    <input class="form-control" type="number" name="count" min="0">
                                </div>
                                <input type="hidden" value="<?= $company_id ?>" name="type_id">
                                <input type="hidden" value="2" name="tree_type">
                            </div>
                            <button class="btn btn-primary ms-3" type="submit">Create Tree</button>
                        </form>
                        <hr>
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <label for="tree_select" class="form-label">Select Tree</label>
                                <select class="form-select" id="tree_select">
                                    <?php foreach($trees as $tree) :?>
                                        <option value="<?= $tree['id'] ?>"><?= $tree['title']?></option>
                                    <?php endforeach;?>
                                </select>
                                <div class="mt-4">
                                    <div id="duplicate_user_alert" class="alert alert-warning d-none" role="alert"></div>
                                    <div id="timeline_wrapper">
                                        <svg id="connectionLayer"></svg>
                                        <div class="mt-md-3 timeline_container" id="timeline_container"></div>
                                        <div id="contextMenu" class="context-menu">
                                            <div id="menuAddUser" class="menu-item">Add User</div>
                                        </div>

                                        <div id="userContextMenu" class="context-menu">
                                            <ul>
                                                <li id="menuAddConnection">➕ Add Connection</li>
                                                <li id="menuRemoveUser" class="text-danger">❌ User</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shiv Web Developer  -->
<style>
    .custom-dropdown-menu {
        max-height: 300px;
        overflow-y: auto;
        width: 100%;
    }

    .custom-dropdown-item {
        display: flex;
        align-items: center;
        padding: 8px 12px;
        cursor: pointer;
    }

    .custom-dropdown-item:hover {
        background-color: #f8f9fa;
    }

    .custom-dropdown-item img {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        margin-right: 10px;
    }

    .custom-dropdown-item .user-info {
        flex-grow: 1;
    }

    .custom-dropdown-item .user-name {
        font-weight: 500;
    }

    .custom-dropdown-item .user-email {
        font-size: 0.85em;
        color: #6c757d;
    }

    .custom-search-input {
        width: 100%;
        padding: 8px;
        border: 1px solid #ced4da;
        border-radius: 4px;
    }

    .department-card {
        border: 1px solid #dee2e6;
        border-radius: 8px;
        margin-bottom: 15px;
        transition: all 0.3s ease;
    }

    .department-card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .department-header {
        background-color: #f8f9fa;
        padding: 15px;
        border-bottom: 1px solid #dee2e6;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .department-body {
        padding: 15px;
    }

    .member-item {
        display: flex;
        align-items: center;
        padding: 8px;
        margin-bottom: 8px;
        background-color: #f8f9fa;
        border-radius: 6px;
    }

    .member-avatar {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 12px;
    }

    .member-info {
        flex-grow: 1;
    }

    .member-actions {
        display: flex;
        gap: 5px;
    }

    .edit-mode-indicator {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1050;
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> -->
<script src="https://cdn.jsdelivr.net/npm/tagify@4.17.8/dist/tagify.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/tagify@4.17.8/dist/tagify.css" rel="stylesheet" type="text/css" />

<?php include('includes/footer-link.php') ?>
<?php include('includes/footer.php') ?>


<script>
    $(document).ready(function() {
        let departments = [];
        let currentCompanyId = null;
        let currentProjectId = null;
        let currentBrickId = null;
        let currentCompanyName = null;
        let currentProjectName = null;
        let currentBrickName = null;
        let currentSelectionType = null;
        let allUsers = [];
        let currentMode = 'add'; // 'add' or 'edit'
        let existingStructure = null;

        // Tagify initialization for 1D module
        var inputElm = document.querySelector('#team-member-input');

        function tagTemplate(tagData) {
            return `
            <tag title="${tagData.email || ''}" 
                 contenteditable='false' 
                 spellcheck='false' 
                 tabIndex="-1" 
                 class="tagify__tag" 
                 value="${tagData.value}">
                <x title='' class='tagify__tag__removeBtn' role='button' aria-label='remove tag'></x>
                <div class="d-flex align-items-center">
                    <img src="${tagData.avatar || 'assets/user-icon.png'}" 
                         class="rounded-circle me-2" 
                         style="width: 24px; height: 24px;">
                    <div>
                        <div class="fw-bold">${tagData.label || tagData.value}</div>
                        <small class="text-muted">${tagData.email || ''}</small>
                    </div>
                </div>
            </tag>
        `;
        }

        function suggestionItemTemplate(tagData) {
            return `
            <div ${this.getAttributes(tagData)}
                class='tagify__dropdown__item d-flex align-items-center ${tagData.class ? tagData.class : ""}'
                tabindex="0"
                role="option">
                ${ tagData.avatar ? `
                <div class='tagify__dropdown__item__avatar-wrap'>
                    <img onerror="this.style.visibility='hidden'" class="avatar rounded me-2" src="${tagData.avatar}">
                </div>` : ''
                }
                <div>
                    <div class="fw-bold">${tagData.label || tagData.value}</div>
                    <small class="text-muted">${tagData.email || ''}</small>
                </div>
            </div>
        `;
        }

        function dropdownHeaderTemplate(suggestions) {
            return `
            <div class="${this.settings.classNames.dropdownItem} ${this.settings.classNames.dropdownItem}__addAll">
                <strong>${this.value.length ? `Add remaining ${suggestions.length}` : 'Add All'}</strong>
                <span>${suggestions.length} members</span>
            </div>
        `;
        }

        // Initialize Tagify for 1D module
        var tagify = new Tagify(inputElm, {
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
                tag: tagTemplate,
                dropdownItem: suggestionItemTemplate,
                dropdownHeader: dropdownHeaderTemplate
            },
            whitelist: []
        });

        // Listen to input event for dynamic search (1D module)
        tagify.on('input', function(e) {
            var value = e.detail.value.trim();
            tagify.loading(true);

            fetch('<?php echo base_url('Home/searchUsers'); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        search: value
                    })
                })
                .then(response => response.json())
                .then(data => {
                    tagify.loading(false);
                    if (data.success && Array.isArray(data.users)) {
                        tagify.settings.whitelist = data.users.map(user => ({
                            value: user.id,
                            name: user.name,
                            label: user.name,
                            email: user.email,
                            avatar: user.avatar || 'assets/user-icon.png'
                        }));
                        tagify.dropdown.show(value);
                    } else {
                        tagify.settings.whitelist = [];
                        tagify.dropdown.hide();
                        alert('No users found or invalid response from server.');
                    }
                })
                .catch(error => {
                    tagify.loading(false);
                    console.error('Error searching users:', error);
                    alert('Failed to search users: ' + error.message);
                });
        });

        // Listen to dropdown suggestion items selection (1D module)
        tagify.on('dropdown:select', function(e) {
            if (e.detail.elm.classList.contains(`${tagify.settings.classNames.dropdownItem}__addAll`)) {
                tagify.dropdown.selectAll();
            }
        });

        // Save team members button (1D Module)
        $('#saveTeamMembers').on('click', function() {
            const selectedMembers = tagify.value;

            if (selectedMembers.length === 0) {
                alert('Please select at least one team member.');
                return;
            }

            const currentId = getCurrentId();
            if (!currentId) {
                alert('Please select a company, project, or brick first.');
                return;
            }

            const data = {
                teamMember: selectedMembers,
                companyId: currentCompanyId,
                ...getCurrentSelectionData()
            };

            fetch('<?php echo base_url('Home/addTeamMemberToCompany'); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.status === 'success') {
                        showTeamMemberResults(result);
                        tagify.removeAllTags();
                    } else {
                        alert('Error: ' + result.message);
                    }
                })
                .catch(error => {
                    console.error('Error adding team members:', error);
                    alert('Failed to add team members: ' + error.message);
                });
        });

        // Mode change handler
        $('input[name="mode"]').on('change', function() {
            currentMode = $(this).val();
            updateModeDisplay();

            if (currentMode === 'edit' && getCurrentId()) {
                loadExistingTeamStructure();
            } else if (currentMode === 'add') {
                hideExistingStructure();
            }
        });

        // UUID generation function
        function generateUUID() {
            return CryptoJS.lib.WordArray.random(16).toString(CryptoJS.enc.Hex);
        }

        function updateModeDisplay() {
            const modeIndicator = $('#modeIndicator');
            const existingStructureDiv = $('#existingTeamStructure');

            if (currentMode === 'edit') {
                modeIndicator.text('EDIT MODE').removeClass('bg-primary').addClass('bg-success');
                if (getCurrentId()) {
                    existingStructureDiv.show();
                    loadExistingTeamStructure();
                }
            } else {
                modeIndicator.text('ADD MODE').removeClass('bg-success').addClass('bg-primary');
                existingStructureDiv.hide();
            }

            updateSelectionDisplay();
        }

        function hideExistingStructure() {
            $('#existingTeamStructure').hide();
            $('#existingDepartmentsList').html('');
            existingStructure = null;
        }

        // Company change handler
        $('#company_id').on('change', function() {
            currentCompanyId = $(this).val();
            currentCompanyName = $(this).text();
            currentProjectId = null;
            currentBrickId = null;
            currentSelectionType = 'company';

            $('#project_id').html('<option disabled selected>Select Project</option>');
            $('#brick_id').html('<option disabled selected>Select Brick</option>');

            resetDepartmentData();
            updateSelectionDisplay();

            if (currentCompanyId) {
                fetchProjects(currentCompanyId);
                if (currentMode === 'edit') {
                    loadExistingTeamStructure();
                }
            }
        });

        // Project change handler
        $('#project_id').on('change', function() {
            currentProjectId = $(this).val();
            currentProjectName = $(this).find('option:selected').text();
            currentBrickId = null;

            if (currentProjectId) {
                currentSelectionType = 'project';
                $('#brick_id').html('<option disabled selected>Select Brick</option>');

                resetDepartmentData();
                updateSelectionDisplay();

                if (currentCompanyId && currentProjectId) {
                    fetchBricks(currentCompanyId, currentProjectId);
                    if (currentMode === 'edit') {
                        loadExistingTeamStructure();
                    }
                }
            }
        });

        // Brick change handler
        $('#brick_id').on('change', function() {
            currentBrickId = $(this).val();

            if (currentBrickId) {
                currentSelectionType = 'brick';
                resetDepartmentData();
                updateSelectionDisplay();
                if (currentMode === 'edit') {
                    loadExistingTeamStructure();
                }
            }
        });

        // Add new department button
        $('#addNewDepartmentBtn').on('click', function() {
            const departmentName = prompt('Enter new department name:');
            if (departmentName && departmentName.trim()) {
                addNewDepartment(departmentName.trim());
            }
        });

        // Helper Functions
        function getCurrentId() {
            if (currentSelectionType === 'brick' && currentBrickId) return currentBrickId;
            if (currentSelectionType === 'project' && currentProjectId) return currentProjectId;
            if (currentSelectionType === 'company' && currentCompanyId) return currentCompanyId;
            return null;
        }

        function getCurrentSelectionData() {
            return {
                type: currentSelectionType,
                company_id: currentCompanyId,
                project_id: currentProjectId,
                brick_id: currentBrickId
            };
        }

        function updateSelectionDisplay() {
            const alert = $('#selectionTypeAlert');
            const text = $('#selectionTypeText');
            const href = $('#selectionTypeEyeBtn');

            if (currentSelectionType) {
                let displayText = '';
                let link = '';
                switch (currentSelectionType) {
                    case 'company':
                        displayText = `Company Selected (ID: ${currentCompanyId}) (Name: ${currentCompanyName.split('(')[0]})`;
                        link = "<?= base_url('company/company-preview?id=') ?>" + currentCompanyId;
                        break;
                    case 'project':
                        displayText = `Company Selected (ID: ${currentCompanyId}) (Name: ${currentCompanyName.split('(')[0]}) | Project Selected (ID: ${currentProjectId}) (Name: ${currentProjectName})`;
                        link = "<?= base_url('company/project-profile-preview?id=') ?>" + currentProjectId;
                        break;
                    case 'brick':
                        displayText = `Company Selected (ID: ${currentCompanyId}) (Name: ${currentCompanyName.split('(')[0]}) Project Selected (ID: ${currentProjectId}) (Name: ${currentProjectName}) Brick Selected (ID: ${currentBrickId})`;
                        link = "<?= base_url('company/preview_brick?id=') ?>" + currentBrickId;
                        break;
                }
                href.attr('href', link);
                text.text(displayText);
                alert.show();
            } else {
                alert.hide();
            }
        }

        function resetDepartmentData() {
            departments = [];
            $('#number-of-departments').val('');
            updateDepartmentDropdowns();
            $('#team-members-container').html('');
            $('#max-team-members').val('');
            $('#agreement-status').html('');
            $('#agreementUpload').val('');
            hideExistingStructure();
        }

        function updateDepartmentDropdowns() {
            const departmentDropdown = $('#department-dropdown');
            const departmentSelect = $('#departmentSelect');

            let options = '<option disabled selected>No Departments Found</option>';
            let selectOptions = '<option disabled selected>No Department Found</option>';

            if (departments.length > 0) {
                departments.forEach((dept, index) => {
                    const displayName = dept.name || `Department ${index + 1}`;
                    options += `<option value="${dept.id}">${displayName}</option>`;
                    selectOptions += `<option value="${dept.id}">${displayName}</option>`;
                });
            }

            departmentDropdown.html(options);
            departmentSelect.html(selectOptions);
        }

        function loadExistingTeamStructure() {
            const currentId = getCurrentId();
            if (!currentId) {
                if (currentMode === 'edit') {
                    alert('Please select a company, project, or brick first.');
                }
                return;
            }

            const data = getCurrentSelectionData();

            fetch('<?= base_url('Home/get_team_structure') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.status === 'success') {
                        existingStructure = result.departments;
                        displayExistingStructure(result.departments);

                        if (result.departments.length > 0) {
                            departments = result.departments.map(dept => ({
                                id: dept.id,
                                name: dept.name,
                                members: dept.members || []
                            }));
                            $('#number-of-departments').val(departments.length);
                            updateDepartmentDropdowns();
                        }
                    } else {
                        $('#existingDepartmentsList').html(`
                <div class="alert alert-info">
                    <i class="fa fa-info-circle"></i> ${result.message || 'No existing team structure found.'}
                </div>
            `);
                        existingStructure = [];
                    }
                })
                .catch(error => {
                    console.error('Error loading existing structure:', error);
                    alert('Failed to load existing team structure: ' + error.message);
                });
        }

        function displayExistingStructure(departments) {
            const container = $('#existingDepartmentsList');
            container.html('');

            if (!departments || departments.length === 0) {
                container.html(`
            <div class="alert alert-info">
                <i class="fa fa-info-circle"></i> No departments found. You can create new departments below.
            </div>
        `);
                return;
            }

            departments.forEach(dept => {
                const membersHtml = dept.members.map(member => `
            <div class="member-item">
                <img src="${member.avatar}" class="member-avatar" alt="${member.name}">
                <div class="member-info">
                    <div class="fw-bold">${member.name}</div>
                    <small class="text-muted">${member.email}</small>
                    ${member.nickname ? `<div class="badge bg-secondary">${member.nickname}</div>` : ''}
                </div>
                <div class="member-actions">
                    <button type="button" class="btn btn-sm btn-outline-primary edit-member-btn" 
                            data-dept-id="${dept.id}" data-member-id="${member.id}">
                        <i class="fa fa-edit"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-outline-danger remove-member-btn" 
                            data-dept-id="${dept.id}" data-member-id="${member.id}">
                        <i class="fa fa-trash"></i>
                    </button>
                </div>
            </div>
        `).join('');

                const agreementsHtml = dept.agreements.map(agreement => `
            <div class="d-flex align-items-center mb-2">
                <i class="fa fa-file-pdf text-danger me-2"></i>
                <a href="${agreement.file_path}" target="_blank" class="text-decoration-none">
                    ${agreement.file_name}
                </a>
            </div>
        `).join('');

                const deptHtml = `
            <div class="department-card" data-dept-id="${dept.id}">
                <div class="department-header">
                    <div>
                        <h5 class="mb-0">${dept.name}</h5>
                        <small class="text-muted">${dept.members.length} members</small>
                    </div>
                    <div>
                        <button type="button" class="btn btn-sm btn-outline-primary edit-dept-btn" data-dept-id="${dept.id}">
                            <i class="fa fa-edit"></i> Edit
                        </button>
                        <button type="button" class="btn btn-sm btn-outline-danger delete-dept-btn" data-dept-id="${dept.id}">
                            <i class="fa fa-trash"></i>
                        </button>
                    </div>
                </div>
                <div class="department-body">
                    <div class="row">
                        <div class="col-md-8">
                            <h6>Team Members:</h6>
                            ${membersHtml || '<p class="text-muted">No members assigned</p>'}
                        </div>
                        <div class="col-md-4">
                            <h6>Agreements:</h6>
                            ${agreementsHtml || '<p class="text-muted">No agreements uploaded</p>'}
                        </div>
                    </div>
                </div>
            </div>
        `;

                container.append(deptHtml);
            });

            // Attach event handlers
            attachExistingStructureHandlers();
        }

        function attachExistingStructureHandlers() {
            $('.edit-dept-btn').off('click').on('click', function() {
                const deptId = $(this).data('dept-id');
                const dept = existingStructure.find(d => d.id === deptId);
                if (dept) {
                    openEditDepartmentModal(dept);
                }
            });

            $('.delete-dept-btn').off('click').on('click', function() {
                const deptId = $(this).data('dept-id');
                if (confirm('Are you sure you want to delete this department and all its members?')) {
                    deleteDepartment(deptId);
                }
            });

            $('.edit-member-btn').off('click').on('click', function() {
                const deptId = $(this).data('dept-id');
                const memberId = $(this).data('member-id');
                editTeamMember(deptId, memberId);
            });

            $('.remove-member-btn').off('click').on('click', function() {
                const deptId = $(this).data('dept-id');
                const memberId = $(this).data('member-id');
                if (confirm('Are you sure you want to remove this member from the department?')) {
                    removeTeamMember(deptId, memberId);
                }
            });
        }

        function openEditDepartmentModal(dept) {
            $('#editDepartmentId').val(dept.id);
            $('#editDepartmentName').val(dept.name);

            const container = $('#editTeamMembersContainer');
            container.html('');

            dept.members.forEach(member => {
                const memberHtml = `
            <div class="d-flex align-items-center mb-2 edit-member-row" data-member-id="${member.id}">
                <img src="${member.avatar}" class="me-2" style="width: 32px; height: 32px; border-radius: 50%;">
                <div class="flex-grow-1">
                    <div class="fw-bold">${member.name}</div>
                    <small class="text-muted">${member.email}</small>
                </div>
                <input type="text" class="form-control form-control-sm ms-2" style="width: 120px;" 
                       placeholder="Nickname" value="${member.nickname || ''}" data-member-id="${member.id}">
                <button class="btn btn-sm btn-outline-danger ms-2 remove-edit-member" data-member-id="${member.id}">
                    <i class="fa fa-trash"></i>
                </button>
            </div>
        `;
                container.append(memberHtml);
            });

            $('#editDepartmentModal').modal('show');
        }

        $('#saveDepartmentChanges').on('click', function() {
            const deptId = $('#editDepartmentId').val();
            const newName = $('#editDepartmentName').val().trim();

            if (!newName) {
                alert('Department name is required.');
                return;
            }

            updateDepartmentName(deptId, newName);

            $('.edit-member-row').each(function() {
                const memberId = $(this).data('member-id');
                const nickname = $(this).find('input').val().trim();
                updateTeamMemberNickname(deptId, memberId, nickname);
            });

            $('#editDepartmentModal').modal('hide');
        });

        $('#deleteDepartmentBtn').on('click', function() {
            const deptId = $('#editDepartmentId').val();
            if (confirm('Are you sure you want to delete this department and all its members?')) {
                deleteDepartment(deptId);
                $('#editDepartmentModal').modal('hide');
            }
        });

        function updateDepartmentName(deptId, newName) {
            const data = {
                department_id: deptId,
                name: newName,
                ...getCurrentSelectionData()
            };

            fetch('<?= base_url('Home/update_department_name') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.status === 'success') {
                        const dept = existingStructure.find(d => d.id === deptId);
                        if (dept) {
                            dept.name = newName;
                        }
                        const localDept = departments.find(d => d.id === deptId);
                        if (localDept) {
                            localDept.name = newName;
                            updateDepartmentDropdowns();
                        }
                        loadExistingTeamStructure();
                        showSuccessMessage('Department name updated successfully!');
                    } else {
                        alert('Error updating department name: ' + result.message);
                    }
                })
                .catch(error => {
                    console.error('Error updating department name:', error);
                    alert('Failed to update department name: ' + error.message);
                });
        }

        function addNewDepartment(departmentName) {
            const data = {
                name: departmentName,
                ...getCurrentSelectionData()
            };

            fetch('<?= base_url('Home/add_new_department') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.status === 'success') {
                        departments.push({
                            id: result.department.id,
                            name: result.department.name,
                            members: []
                        });
                        $('#number-of-departments').val(departments.length);
                        updateDepartmentDropdowns();
                        loadExistingTeamStructure();
                        showSuccessMessage('New department added successfully!');
                    } else {
                        alert('Error adding new department: ' + result.message);
                    }
                })
                .catch(error => {
                    console.error('Error adding new department:', error);
                    alert('Failed to add new department: ' + error.message);
                });
        }

        function deleteDepartment(deptId) {
            const data = {
                department_id: deptId
            };

            fetch('<?= base_url('Home/delete_department') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.status === 'success') {
                        existingStructure = existingStructure.filter(d => d.id !== deptId);
                        departments = departments.filter(d => d.id !== deptId);
                        $('#number-of-departments').val(departments.length);
                        updateDepartmentDropdowns();
                        loadExistingTeamStructure();
                        showSuccessMessage('Department deleted successfully!');
                    } else {
                        alert('Error deleting department: ' + result.message);
                    }
                })
                .catch(error => {
                    console.error('Error deleting department:', error);
                    alert('Failed to delete department: ' + error.message);
                });
        }

        function updateTeamMemberNickname(deptId, memberId, nickname) {
            const data = {
                member_id: memberId,
                department_id: deptId,
                nickname: nickname,
                ...getCurrentSelectionData()
            };

            fetch('<?= base_url('Home/update_team_member') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.status === 'success') {
                        console.log('Member nickname updated successfully');
                    } else {
                        console.error('Error updating member nickname:', result.message);
                    }
                })
                .catch(error => {
                    console.error('Error updating member nickname:', error);
                });
        }

        function removeTeamMember(deptId, memberId) {
            const data = {
                member_id: memberId,
                department_id: deptId,
                ...getCurrentSelectionData()
            };

            fetch('<?= base_url('Home/remove_team_member') ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.status === 'success') {
                        loadExistingTeamStructure();
                        showSuccessMessage('Team member removed successfully!');
                    } else {
                        alert('Error removing team member: ' + result.message);
                    }
                })
                .catch(error => {
                    console.error('Error removing team member:', error);
                    alert('Failed to remove team member: ' + error.message);
                });
        }

        function showSuccessMessage(message) {
            const alertHtml = `
        <div class="alert alert-success alert-dismissible fade show position-fixed" 
             style="top: 20px; right: 20px; z-index: 1060; min-width: 300px;" role="alert">
            <i class="fa fa-check-circle"></i> ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `;
            $('body').append(alertHtml);

            setTimeout(() => {
                $('.alert').fadeOut();
            }, 3000);
        }

        function fetchProjects(companyId) {
            $.post('<?= base_url('Home/fetch_projects') ?>', {
                    company_id: companyId
                })
                .done(function(response) {
                    try {
                        let res = (typeof response === "string") ? JSON.parse(response) : response;

                        if (res.success && res.projects.length > 0) {
                            let options = '<option disabled selected>Select Project</option>';
                            res.projects.forEach(project => {
                                options += `<option value="${project.id}">${project.project_name}</option>`;
                            });
                            $('#project_id').html(options);
                        } else {
                            $('#project_id').html('<option disabled selected>No Projects Found</option>');
                        }
                    } catch (e) {
                        console.error("Invalid JSON:", e, response);
                        $('#project_id').html('<option disabled selected>Error Parsing Projects</option>');
                    }
                })
                .fail(function() {
                    $('#project_id').html('<option disabled selected>Error Loading Projects</option>');
                });
        }

        function fetchBricks(companyId, projectId) {
            $.post('<?= base_url('Home/fetch_bricks') ?>', {
                    company_id: companyId,
                    project_id: projectId
                })
                .done(function(response) {
                    console.log("Bricks", response);
                    if (response.success) {
                        let options = '<option disabled selected>Select Brick</option>';
                        response.bricks.forEach(brick => {
                            options += `<option value="${brick.id}">${brick.brick_title}</option>`;
                        });
                        $('#brick_id').html(options);
                    } else {
                        $('#brick_id').html('<option disabled selected>No Bricks Found</option>');
                    }
                })
                .fail(function() {
                    $('#brick_id').html('<option disabled selected>Error Loading Bricks</option>');
                });
        }

        // Department number change handler
        $('#number-of-departments').on('input', function() {
            const numDepartments = parseInt($(this).val());
            if (numDepartments > 0 && numDepartments <= 20) {
                generateDepartments(numDepartments);
            } else {
                departments = [];
                updateDepartmentDropdowns();
            }
        });

        function generateDepartments(count) {
            if (departments.length === 0) {
                departments = [];
                for (let i = 1; i <= count; i++) {
                    departments.push({
                        id: generateUUID(),
                        name: `Department ${i}`,
                        members: []
                    });
                }
            } else {
                if (count > departments.length) {
                    for (let i = departments.length + 1; i <= count; i++) {
                        departments.push({
                            id: generateUUID(),
                            name: `Department ${i}`,
                            members: []
                        });
                    }
                } else if (count < departments.length) {
                    departments = departments.slice(0, count);
                }
            }
            updateDepartmentDropdowns();
        }

        // Department dropdown change handler
        $('#department-dropdown').on('change', function() {
            const selectedDeptId = $(this).val();
            const selectedDept = departments.find(d => d.id === selectedDeptId);
            if (selectedDept) {
                $('#departmentName').val(selectedDept.name);
                $('#updateDepartment').prop('disabled', false);
            }
        });

        // Update department name
        $('#updateDepartment').on('click', function() {
            const selectedDeptId = $('#department-dropdown').val();
            const newName = $('#departmentName').val().trim();

            if (selectedDeptId && newName) {
                const dept = departments.find(d => d.id === selectedDeptId);
                if (dept) {
                    dept.name = newName;
                    updateDepartmentDropdowns();

                    const agreementFile = $('#agreementUpload')[0].files[0];
                    if (agreementFile) {
                        uploadAgreement(selectedDeptId, agreementFile);
                    }

                    $('#agreement-status').html('<div class="text-success">Department updated successfully!</div>');
                    setTimeout(() => $('#agreement-status').html(''), 3000);
                }
            }
        });

        // Department select change handler for team assignment
        $('#departmentSelect').on('change', function() {
            const selectedDeptId = $(this).val();
            const selectedDept = departments.find(d => d.id === selectedDeptId);
            if (selectedDept) {
                $('#selectedDepartmentName').val(selectedDept.name);
                if (selectedDept.members && selectedDept.members.length > 0) {
                    $('#max-team-members').val(selectedDept.members.length);
                    generateTeamMemberInputs(selectedDept.members.length);
                    setTimeout(() => populateExistingMembers(selectedDept.members), 500);
                } else {
                    $('#team-members-container').html('');
                    $('#max-team-members').val('');
                }
            }
        });

        // Max team members change handler
        $('#max-team-members').on('input', function() {
            const maxMembers = parseInt($(this).val());
            const selectedDeptId = $('#departmentSelect').val();
            if (maxMembers > 0 && maxMembers <= 50 && selectedDeptId) {
                generateTeamMemberInputs(maxMembers);
            } else if (!selectedDeptId) {
                alert('Please select a department before specifying team members.');
                $('#max-team-members').val('');
            }
        });

        // Generate team member inputs with dropdowns (from previous code)
        // function generateTeamMemberInputs(count) {
        //     const container = $('#team-members-container');
        //     container.html('');

        //     for (let i = 1; i <= count; i++) {
        //         const inputId = `member-search-${i}`;
        //         const hiddenId = `member-id-${i}`;
        //         const nicknameId = `team-member-nickname-${i}`;
        //         const inputHtml = `
        //         <div class="mb-2 team-member-row" data-member-index="${i}">
        //             <div class="row align-items-center">
        //                 <div class="col-md-7">
        //                     <div class="input-group" data-bs-toggle="dropdown" aria-expanded="false">
        //                         <span class="input-group-text">
        //                             <i class="bi bi-search"></i>
        //                         </span>
        //                         <input type="text" id="${inputId}" class="form-control member-search" placeholder="Search Team Member ${i}" autocomplete="off">
        //                         <input type="hidden" id="${hiddenId}" class="member-id">
        //                         <ul class="dropdown-menu custom-dropdown-menu" id="dropdown-menu-${i}"></ul>
        //                     </div>
        //                 </div>
        //                 <div class="col-md-5">
        //                     <input type="text" id="${nicknameId}" class="form-control team-member-nickname" placeholder="Enter nickname">
        //                 </div>
        //             </div>
        //         </div>
        //     `;
        //         container.append(inputHtml);
        //     }

        //     loadUsersForDropdowns();
        // }
        function generateTeamMemberInputs(count) {
            const container = $('#team-members-container');
            const currentCount = container.find('.team-member-row').length;

            // 🟢 If increasing → append only new rows
            if (count > currentCount) {
                for (let i = currentCount + 1; i <= count; i++) {
                    const inputId = `member-search-${i}`;
                    const hiddenId = `member-id-${i}`;
                    const nicknameId = `team-member-nickname-${i}`;
                    let deleteMemberLink = '<?= base_url() ?>';
                    const inputHtml = `
                        <div class="mb-2 team-member-row" data-member-index="${i}">
                            <div class="row align-items-center gap-2 flex-nowrap">
                                <div class="col-md-7 p-0">
                                    <div class="input-group" data-bs-toggle="dropdown" aria-expanded="false">
                                        <span class="input-group-text">
                                            <i class="bi bi-search"></i>
                                        </span>
                                        <input type="text" id="${inputId}" class="form-control member-search" placeholder="Search Team Member ${i}" autocomplete="off">
                                        <input type="hidden" id="${hiddenId}" class="member-id">
                                        <ul class="dropdown-menu custom-dropdown-menu" id="dropdown-menu-${i}"></ul>
                                    </div>
                                </div>
                                <div class="col-md-4 p-0">
                                    <input type="text" id="${nicknameId}" class="form-control team-member-nickname" placeholder="Enter nickname">
                                </div>
                                <div class="col-md-1 p-0">
                                        <button type="button"
                                            class="btn btn-sm btn-outline-danger remove-temp-member"
                                            title="Remove"
                                            data-row-index="${i}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    `;
                    container.append(inputHtml);
                }
            }

            // 🔴 If decreasing → remove extra rows
            if (count < currentCount) {
                container.find('.team-member-row').slice(count).remove();
            }

            loadUsersForDropdowns();
        }


        function loadUsersForDropdowns() {
            if (allUsers.length > 0) {
                initializeSearchDropdowns();
                return;
            }

            fetch('<?php echo base_url('Home/searchUsers'); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        search: ''
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success && Array.isArray(data.users)) {
                        allUsers = data.users.map(user => ({
                            value: user.id,
                            name: user.name,
                            email: user.email,
                            avatar: user.avatar || 'assets/user-icon.png'
                        }));
                        initializeSearchDropdowns();
                    } else {
                        console.error('Invalid response from getSearchUsers:', data);
                        alert('No users found or invalid response from server.');
                    }
                })
                .catch(error => {
                    console.error('Error loading users:', error);
                    alert('Failed to load users: ' + error.message);
                });
        }

        function initializeSearchDropdowns() {
            $('.team-member-row').each(function() {
                const row = $(this);
                const memberIndex = row.data('member-index');
                const input = row.find(`#member-search-${memberIndex}`);
                const hiddenInput = row.find(`#member-id-${memberIndex}`);
                const dropdownMenu = row.find(`#dropdown-menu-${memberIndex}`);

                const bsDropdown = new bootstrap.Dropdown(row.find('.input-group')[0], {
                    autoClose: false
                });

                function populateDropdown(users) {
                    dropdownMenu.html('');
                    if (users.length === 0) {
                        dropdownMenu.append('<li><span class="dropdown-item">No users found</span></li>');
                        return;
                    }
                    users.forEach(user => {
                        const item = `
                        <li>
                            <a class="dropdown-item custom-dropdown-item" href="#" 
                               data-id="${user.value}" 
                               data-name="${user.name}" 
                               data-email="${user.email}">
                                ${user.avatar ? `<img src="${user.avatar}" onerror="this.style.visibility='hidden'">` : ''}
                                <div class="user-info">
                                    <div class="user-name">${user.name}</div>
                                    <div class="user-email">${user.email}</div>
                                </div>
                            </a>
                        </li>
                    `;
                        dropdownMenu.append(item);
                    });
                }

                populateDropdown(allUsers);

                input.on('input focus click', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const searchTerm = input.val().toLowerCase();
                    const filteredUsers = allUsers.filter(user =>
                        user.name.toLowerCase().includes(searchTerm) ||
                        user.email.toLowerCase().includes(searchTerm)
                    );
                    populateDropdown(filteredUsers);
                    bsDropdown.show();
                });

                dropdownMenu.on('click', '.custom-dropdown-item', function(e) {
                    e.preventDefault();
                    e.stopPropagation();
                    const userId = $(this).data('id');
                    const userName = $(this).data('name');
                    const userEmail = $(this).data('email');
                    input.val(`${userName} (${userEmail})`);
                    hiddenInput.val(userId);
                    bsDropdown.hide();
                });

                $(document).on('click', function(e) {
                    if (!row.is(e.target) && row.has(e.target).length === 0) {
                        bsDropdown.hide();
                    }
                });
            });
        }

        // function populateExistingMembers(members) {
        //     console.log("members",members)
        //     members.forEach((member, index) => {
        //         const input = $(`#member-search-${index + 1}`);
        //         const hiddenInput = $(`#member-id-${index + 1}`);
        //         const nicknameInput = $(`#team-member-nickname-${index + 1}`);
        //         if (input.length && hiddenInput.length) {
        //             const user = allUsers.find(u => u.value === member.id);
        //             if (user) {
        //                 input.val(`${user.name} (${user.email})`);
        //                 hiddenInput.val(member.id);
        //                 nicknameInput.val(member.nickname || '');
        //             }

        //             if (member.team_row_id) {
        //                 row.attr('data-team-row-id', member.team_row_id);
        //                 deleteBtn.attr('data-team-row-id', member.team_row_id);
        //             }

        //         }
        //     });
        // }
        function populateExistingMembers(members) {
            members.forEach((member, index) => {
                const row = $(`#team-members-container .team-member-row`).eq(index);
                const input = row.find('.member-search');
                const hiddenInput = row.find('.member-id');
                const nicknameInput = row.find('.team-member-nickname');
                const deleteBtn = row.find('.remove-temp-member');

                if (row.length) {
                    const user = allUsers.find(u => String(u.value) === String(member.id));
                    if (user) {
                        input.val(`${user.name} (${user.email})`);
                        hiddenInput.val(member.id);
                        nicknameInput.val(member.nickname || '');
                    }

                    // ✅ Attach DB row id here
                    if (member.team_row_id) {
                        row.attr('data-team-row-id', member.team_row_id);
                        deleteBtn.attr('data-team-row-id', member.team_row_id);
                    }
                }
            });
        }

        // Save department team handler
        // $('#saveDepartmentTeam').on('click', function() {
        //     const selectedDeptId = $('#departmentSelect').val();
        //     const selectedDept = departments.find(d => d.id === selectedDeptId);

        //     if (!selectedDept) {
        //         alert('Please select a department first.');
        //         return;
        //     }

        //     const currentId = getCurrentId();

        //     if (!currentId) {
        //         alert('Please select a company, project, or brick first.');
        //         return;
        //     }

        //     // Save team structure first to ensure departments exist
        //     saveTeamStructure().then(() => {
        //         const memberData = [];
        //         $('.team-member-row').each(function() {
        //             const memberId = $(this).find('.member-id').val();
        //             const nickname = $(this).find('.team-member-nickname').val().trim();
        //             if (memberId) {
        //                 const user = allUsers.find(u => u.value === memberId);
        //                 if (user) {
        //                     memberData.push({
        //                         id: memberId,
        //                         name: user.name,
        //                         nickname: nickname
        //                     });
        //                 }
        //             }
        //         });

        //         if (memberData.length === 0) {
        //             alert('Please add at least one team member.');
        //             return;
        //         }

        //         selectedDept.members = memberData;

        //         const data = {
        //             departmentId: selectedDeptId,
        //             members: memberData,
        //             ...getCurrentSelectionData()
        //         };

        //         fetch('<?php echo base_url('Home/addTeamMemberToDepartment'); ?>', {
        //                 method: 'POST',
        //                 headers: {
        //                     'Content-Type': 'application/json'
        //                 },
        //                 body: JSON.stringify(data)
        //             })
        //             .then(response => response.json())
        //             .then(result => {
        //                 if (result.status === 'success') {
        //                     showTeamMemberResults(result);
        //                     $('#team-members-container').html('');
        //                     $('#max-team-members').val('');
        //                     $('#departmentSelect').val('');
        //                     $('#selectedDepartmentName').val('');
        //                     loadExistingTeamStructure();
        //                 } else {
        //                     alert('Error adding team members to department: ' + result.message);
        //                 }
        //             })
        //             .catch(error => {
        //                 console.error('Error adding team members to department:', error);
        //                 alert('Failed to add team members to department: ' + error.message);
        //             });
        //     }).catch(error => {
        //         console.error('Error saving team structure before team members:', error);
        //         alert('Failed to save departments before adding team members: ' + error.message);
        //     });
        // });

        $('#saveDepartmentTeam').on('click', function() {
            const selectedDeptId = $('#departmentSelect').val();
            const selectedDept = departments.find(d => d.id === selectedDeptId);

            if (!selectedDept) {
                alert('Please select a department first.');
                return;
            }

            const currentId = getCurrentId();

            if (!currentId) {
                alert('Please select a company, project, or brick first.');
                return;
            }

            // Save team structure first to ensure departments exist
            const memberData = [];

            $('.team-member-row').each(function() {
                const memberId = $(this).find('.member-id').val();
                const nickname = $(this).find('.team-member-nickname').val().trim();
                if (memberId) {
                    const user = allUsers.find(u => u.value === memberId);
                    if (user) {
                        memberData.push({
                            id: memberId,
                            name: user.name,
                            nickname: nickname
                        });
                    }
                }
            });

            if (memberData.length === 0) {
                alert('Please add at least one team member.');
                return;
            }

            selectedDept.members = memberData;

            const data = {
                departmentId: selectedDeptId,
                members: memberData,
                ...getCurrentSelectionData()
            };

            fetch('<?php echo base_url('Home/addTeamMemberToDepartment'); ?>', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => response.json())
                .then(result => {
                    if (result.status === 'success') {
                        showTeamMemberResults(result);
                        $('#team-members-container').html('');
                        $('#max-team-members').val('');
                        $('#departmentSelect').val('');
                        $('#selectedDepartmentName').val('');
                        loadExistingTeamStructure();
                    } else {
                        alert('Error adding team members to department: ' + result.message);
                    }
                })
                .catch(error => {
                    console.error('Error adding team members to department:', error);
                    alert('Failed to add team members to department: ' + error.message);
                });
        });

        // Save team structure
        function saveTeamStructure() {
            return new Promise((resolve, reject) => {
                const currentId = getCurrentId();
                if (!currentId) {
                    alert('Please select a company, project, or brick first.');
                    reject(new Error('No company/project/brick selected'));
                    return;
                }

                if (departments.length === 0) {
                    alert('Please create at least one department before saving.');
                    reject(new Error('No departments to save'));
                    return;
                }

                const data = {
                    ...getCurrentSelectionData(),
                    departments: departments
                };

                fetch('<?php echo base_url('Home/save_team_structure'); ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify(data)
                    })
                    .then(response => response.json())
                    .then(result => {
                        if (result.status === 'success') {
                            resolve(result);
                        } else {
                            alert('Error saving team structure: ' + result.message);
                            reject(new Error(result.message));
                        }
                    })
                    .catch(error => {
                        console.error('Error saving team structure:', error);
                        alert('Failed to save team structure: ' + error.message);
                        reject(error);
                    });
            });
        }

        // Agreement upload function
        function uploadAgreement(departmentId, file) {
            const formData = new FormData();
            formData.append('agreement_file', file);
            formData.append('department_id', departmentId);
            formData.append('company_id', currentCompanyId);
            formData.append('project_id', currentProjectId);
            formData.append('brick_id', currentBrickId);

            fetch('<?php echo base_url('Home/uploadAgreementFile'); ?>', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(result => {
                    if (result.success) {
                        $('#agreement-status').html('<div class="text-success">Agreement uploaded successfully!</div>');
                    } else {
                        $('#agreement-status').html('<div class="text-danger">Error: ' + result.error + '</div>');
                    }
                })
                .catch(error => {
                    $('#agreement-status').html('<div class="text-danger">Upload failed: ' + error.message + '</div>');
                });
        }

        // Show team member results in modal
        function showTeamMemberResults(result) {
            let content = '<div class="row">';

            if (result.inserted && result.inserted.length > 0) {
                content += `
                <div class="col-md-12">
                    <div class="alert alert-success">
                        <h6><i class="fa fa-check-circle"></i> Teamup Request sent succesfully (${result.inserted.length})</h6>
                        <strong>Added Persons:</strong>
                        <ul class="list-unstyled mb-0 mt-2">
            `;
                result.inserted.forEach(member => {
                    content += `<li class="mb-1">• <strong> ${member.name ? `(${member.name})` : member.label} </strong> ${member.value ? `(${member.value})` : ''}</li>`;
                });
                content += `
                        </ul>
                    </div>
                </div>
            `;
            }

            if (result.alreadyExists && result.alreadyExists.length > 0) {
                content += `
                <div class="col-md-12">
                    <div class="alert alert-warning">
                        <h6><i class="fa fa-exclamation-triangle"></i> Already in ${currentSelectionType} (${result.alreadyExists.length})</h6>
                        <strong>Existing Persons:</strong>
                        <ul class="list-unstyled mb-0 mt-2">
            `;
                result.alreadyExists.forEach(member => {
                    content += `<li class="mb-1">• <strong> ${member.name ? `(${member.name})` : member.label} </strong> ${member.value ? `(${member.value})` : ''} ${member.reason ? ` [${member.reason}] ` : ''}</li>`;
                });
                content += `
                        </ul>
                    </div>
                </div>
            `;
            }

            if (result.updated && result.updated.length > 0) {
                content += `
                <div class="col-md-12">
                    <div class="alert alert-info">
                        <h6><i class="fa fa-edit"></i> Updated Members (${result.updated.length})</h6>
                        <strong>Updated Persons:</strong>
                        <ul class="list-unstyled mb-0 mt-2">
            `;
                result.updated.forEach(member => {
                    content += `<li class="mb-1">• <strong> ${member.name ? `(${member.name})` : member.label} </strong> ${member.value ? `(${member.value})` : ''}</li>`;
                });
                content += `
                        </ul>
                    </div>
                </div>
            `;
            }

            content += '</div>';

            if (result.message) {
                content += ``;
            }
            // <div class="alert alert-info mt-3"><i class="fa fa-info-circle"></i> ${result.message}</div>
            $('#teamMemberResults').html(content);
            $('#teamMemberResultModal').modal('show');
        }

        // Initialize mode display
        updateModeDisplay();

        $(document).on('click', '.remove-temp-member', function() {
            const btn = $(this);
            const row = btn.closest('.team-member-row');
            const teamRowId = btn.data('team-row-id');

            if (!teamRowId) {
                alert('Invalid team member');
                return;
            }

            if (!confirm('Are you sure you want to remove this member?')) return;

            // Optional: disable button while deleting
            btn.prop('disabled', true);

            fetch('<?= base_url('Home/deleteAddedMember') ?>', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ id: teamRowId })
            })
            .then(res => res.json())
            .then(result => {
                if (result.status === 'success') {
                    // ✅ Instantly remove from UI
                    row.remove();
                    reindexTeamMemberRows(); // keep indexes clean if needed

                    showSuccessMessage('Member removed successfully');

                    // 🔁 Optional: refresh from backend to stay in sync
                    // loadExistingTeamStructure();
                } else {
                    alert(result.message || 'Failed to delete member');
                    btn.prop('disabled', false);
                }
            })
        });
    });
</script>

<!-- Artificial Tree -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/tagify/4.35.4/tagify.min.js" integrity="sha512-sKkyJJpMbq+xZRQwXCksuVx5g4JuYQK7c3+65dF3CAx3Gcn67+BPC2PyJkJEugtRRAeDBLPfcsULXbEZ5iqYjg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {

        let activeTimeline = null;
        const timelineContainer = document.getElementById("timeline_container");
        const menu = document.getElementById("contextMenu");
        const menuAddUser = document.getElementById("menuAddUser");
        let treeId = $('#tree_select').val();
        let draggedUser = null;
        let selectedUser = null;
        let connectionStartUser = null;
        let connections = [];
        let activeUser = null;
        const userMenu = document.getElementById("userContextMenu");
        const menuRemoveUser = document.getElementById("menuRemoveUser");


        /* ===============================
        RENDER TIMELINES
        =============================== */
        function renderTimeLineNew(branches) {

            timelineContainer.innerHTML = '';

            const row = document.createElement("div");
            row.className = "d-flex flex-column";

            branches.forEach(branch => {

                const timeline = document.createElement("div");
                timeline.className = "my_timeline my-2 py-4";
                timeline.dataset.id = branch.id;

                const line = document.createElement("span");
                line.className = "my_timeline_line";

                // 🔥 ALWAYS create users wrapper
                const usersWrapper = document.createElement("div");
                usersWrapper.className = "timeline-users";

                timeline.appendChild(line);
                timeline.appendChild(usersWrapper);

                row.appendChild(timeline);
            });

            timelineContainer.appendChild(row);
        }


        /* ===============================
        RIGHT CLICK (EVENT DELEGATION)
        =============================== */
        document.addEventListener("contextmenu", function (e) {
            if (connectionStartUser) {
                e.preventDefault();
                return;
            }

            if (e.target.closest(".timeline-user")) return;

            const timeline = e.target.closest(".my_timeline");
            if (!timeline) return;

            e.preventDefault();
            activeTimeline = timeline;

            const wrapper = document.getElementById("timeline_wrapper");
            const rect = wrapper.getBoundingClientRect();

            const x = e.clientX - rect.left;
            const y = e.clientY - rect.top;

            // Prevent overflow
            const menuWidth = contextMenu.offsetWidth;
            const menuHeight = contextMenu.offsetHeight;

            let left = x;
            let top = y + 50;

            if (left + menuWidth > rect.width) {
                left = rect.width - menuWidth - 5;
            }
            if (top + menuHeight > rect.height) {
                top = rect.height - menuHeight - 5;
            }

            contextMenu.style.left = left + "px";
            contextMenu.style.top = top + "px";
            contextMenu.style.display = "block";

            userContextMenu.style.display = "none";
        });



        /* ===============================
        ADD USER (TAGIFY)
        =============================== */
        menuAddUser.addEventListener("click", function (e) {

            e.stopPropagation();

            if (!activeTimeline) return;

            // Prevent duplicate input
            if (activeTimeline.querySelector(".tagify")) return;

            const input = document.createElement("input");
            input.placeholder = "Add users...";
            input.className = "user-input";

            activeTimeline.appendChild(input);

            initTagify(input, activeTimeline.dataset.id);

            menu.style.display = "none";
        });

        /* ===============================
        INIT TAGIFY WITH DB SEARCH
        =============================== */
        function initTagify(inputElm, timelineId) {

            const tagify = new Tagify(inputElm, {
                tagTextProp: "name",
                enforceWhitelist: true,
                skipInvalid: true,
                dropdown: {
                    enabled: 1,
                    searchKeys: ["name", "email"]
                },
                whitelist: [],
                templates: {
                    dropdownItem: suggestionItemTemplate,
                }
            });

            // 🔍 Search users from DB
            tagify.on("input", function (e) {
                const value = e.detail.value.trim();
                if (!value) return;

                tagify.loading(true);

                fetch("<?= base_url('Home/searchUsersNew') ?>", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({ search: value })
                })
                .then(res => res.json())
                .then(res => {
                    tagify.loading(false);

                    if (!res.success || !Array.isArray(res.users)) {
                        tagify.settings.whitelist = [];
                        return;
                    }

                    const safeUsers = res.users
                        .filter(u => u && u.name) // ✅ REMOVE BAD DATA
                        .map(u => ({
                            value: String(u.value),   // must be string
                            name: String(u.name),     // must be string
                            email: u.email || '',
                            avatar: u.avatar || ''
                        }));

                    tagify.settings.whitelist = safeUsers;

                    if (safeUsers.length) {
                        if (value && safeUsers.length) {
                            tagify.dropdown.show(value);
                        }
                    }

                });
            });

            // ➕ Save user to timeline
            tagify.on("add", function (e) {
                saveUserToTimeline(timelineId, e.detail.data, function (status, json) {
                    // console.log('status:', status);
                    if (status === 'success') {
                        // ✅ 1. Render user immediately
                        renderUserOnTimeline(json.user, timelineId);

                        // ✅ 2. Destroy Tagify instance
                        tagify.destroy();

                        // ✅ 3. Remove input from DOM
                        inputElm.remove();

                    }else if(status === 'duplicate') {
                        $('#duplicate_user_alert').text('⚠️ This user is already added to the timeline.')
                            .removeClass('d-none')
                            .fadeIn();


                        // ✅ 2. Destroy Tagify instance
                        tagify.destroy();

                        // ✅ 3. Remove input from DOM
                        inputElm.remove()

                        // ✅ 4. Auto hide alert after 3 seconds (optional)
                        setTimeout(() => {
                            $('#duplicate_user_alert').fadeOut();
                        }, 4000);
                    }
                });
            });

        }

        /* ===============================
        SAVE USER ↔ TIMELINE
        =============================== */
        function saveUserToTimeline(timelineId, user, callback) {
            $.ajax({
                url: "<?= base_url('Home/add_user_to_timeline') ?>",
                type: "POST",
                dataType: "json",
                data: {
                    "tree_id" : treeId,
                    "timeline_id" : timelineId,
                    "user_id" : user.value
                },
                success: (json)=>{
                    callback(json.status, json);
                },
                error: (e)=>{
                    callback(false, null);
                }
            })
        }

        /* ===============================
        RENDER USER ON TIMELINE
        =============================== */

        function renderUserOnTimeline(user, timelineId) {

            const timeline = document.querySelector(
                `.my_timeline[data-id="${timelineId}"]`
            );
            if (!timeline) return;

            const usersWrapper = timeline.querySelector(".timeline-users");
            if (!usersWrapper) return;

            const div = document.createElement("div");
            div.className = "timeline-user";
            div.draggable = true;
            div.dataset.userId = user.id || user.user_id;
            div.dataset.timelineId = timelineId;
            // console.log('user.id', user.id);
            
            div.innerHTML = `
            <a href="<?= base_url('company/user_preview?id=') ?>${user.id}">
                <img src="${user.user_image 
                    ? "<?= base_url('uploads/user_profile/') ?>" + user.user_image 
                    : "<?= base_url('uploads/user_profile/user.png') ?>"}"
                    class="user-avatar">
                <span>${user.name ? user.name : user.email}</span>
            </a>
            `;

            usersWrapper.appendChild(div);
        }
        
        document.addEventListener("click", function (e) {

            if (!connectionStartUser) return;

            const link = e.target.closest("a");
            if (!link) return;

            // Only block anchor navigation during connection mode
            e.preventDefault();

        }, true); // capture phase


        /* ===============================
        CLOSE MENU
        =============================== */
        document.addEventListener("click", function () {
            menu.style.display = "none";
        });

        function suggestionItemTemplate(tagData) {
            return `
            <div ${this.getAttributes(tagData)}
                class="tagify__dropdown__item d-flex align-items-center"
                tabindex="0"
                role="option">

                ${tagData.avatar ? `
                <div class="tagify__dropdown__item__avatar-wrap me-2">
                    <img class="rounded-circle"
                        src="${tagData.avatar}"
                        style="width:28px;height:28px"
                        onerror="this.style.display='none'">
                </div>` : ''}

                <div>
                    <div class="fw-bold">${tagData.name || 'Unknown User'}</div>
                    <small class="text-muted">${tagData.email || ''}</small>
                </div>
            </div>
            `;
        }
        
        function renderUsersOnTimelines(users) {

            users.forEach(user => {
                renderUserOnTimeline(user, user.timeline_id);
            });
        }


        $('#tree_select').on('change', function () {

            resetConnectionMode();

            treeId = $(this).val(); // 🔥 update global treeId

            connections = [];

            // 2. 🔥 CLEAR OLD SVG LINES (DOM)
            document.getElementById("connectionLayer").innerHTML = '';

            if (!treeId) {
                timelineContainer.innerText = 'No Tree Selected';
                return;
            }
            
            $.ajax({
                url: '<?= base_url('home/get_branches')?>',
                type: 'POST',
                datatype: 'json',
                data:{
                    tree_id: treeId
                },
                success: (res)=>{
                    json = JSON.parse(res);
                    renderTimeLineNew(json.branches);
                    renderUsersOnTimelines(json.users);
                    loadConnections(treeId)
                },
                error: (e)=>{
                    console.log(e);

                }

            })
        })

        $('#tree_select').trigger('change');

        document.addEventListener("contextmenu", function (e) {

            // Disable menu if connecting users
            if (connectionStartUser) {
                e.preventDefault();
                return;
            }

            const userEl = e.target.closest(".timeline-user");
            if (!userEl) return;

            e.preventDefault();
            e.stopPropagation();

            activeUser = userEl;

            const wrapper = document.getElementById("timeline_wrapper");
            const rect = wrapper.getBoundingClientRect();

            // Mouse position relative to wrapper
            let x = e.clientX - rect.left;
            let y = e.clientY - rect.top;

            // Prevent overflow
            const menuWidth = userMenu.offsetWidth;
            const menuHeight = userMenu.offsetHeight;

            if (x + menuWidth > rect.width) {
                x = rect.width - menuWidth - 5;
            }

            if (y + menuHeight > rect.height) {
                y = rect.height - menuHeight - 5;
            }

            userMenu.style.position = "absolute";
            userMenu.style.left = x + "px";
            userMenu.style.top = y + "px";
            userMenu.style.display = "block";
        });


        menuRemoveUser.addEventListener("click", function () {

            if (!activeUser) return;

            const userId = activeUser.dataset.userId;
            const timelineId = activeUser.dataset.timelineId;

            if (!confirm("Are you sure you want to remove this user?")) {
                return;
            }

            $.ajax({
                url: "<?= base_url('Home/remove_user_from_timeline') ?>",
                type: "POST",
                dataType: "json",
                data: {
                    tree_id: treeId,
                    timeline_id: timelineId,
                    user_id: userId
                },
                success: function (res) {

                    if (res.status === 'success') {
                        activeUser.remove(); // 🔥 UI update
                    }
                }
            });

            userMenu.style.display = "none";
        });

        document.addEventListener("click", function () {
            userMenu.style.display = "none";
        });

        document.addEventListener("dragstart", function (e) {

            const user = e.target.closest(".timeline-user");
            if (!user) return;

            draggedUser = user;
            e.dataTransfer.effectAllowed = "move";
            user.classList.add("dragging");
        });

        document.addEventListener("dragend", function (e) {
            if (draggedUser) {
                draggedUser.classList.remove("dragging");
                requestAnimationFrame(() => {
                    updateAllLines();
                });
                draggedUser = null;
            }
        });

        function updateLinesForUser(userEl) {
            // Loop through all existing connections
            connections.forEach(conn => {
                // If this connection involves the moved user, update coordinates
                if (conn.from === userEl || conn.to === userEl) {
                    updateLinePosition(conn);
                }
            });
        }

        document.addEventListener("dragover", function (e) {

            const usersWrapper = e.target.closest(".timeline-users");
            if (!usersWrapper) return;

            e.preventDefault();

            if (draggedUser) {
                updateLinesForUser(draggedUser);
            }
        });

        document.addEventListener("drop", function (e) {

            const usersWrapper = e.target.closest(".timeline-users");
            if (!usersWrapper || !draggedUser) return;

            e.preventDefault();

            const timeline = usersWrapper.closest(".my_timeline");
            if (!timeline) return;

            const oldTimelineId = draggedUser.dataset.timelineId;
            const newTimelineId = timeline.dataset.id;

            // 🔥 Append to wrapper (move user)
            usersWrapper.appendChild(draggedUser);

            // 🔥 Update dataset
            draggedUser.dataset.timelineId = newTimelineId;

            requestAnimationFrame(() => {
                updateAllLines(); // Better than just updating the single user
            });

            // 🔥 Save change in DB
            updateUserTimeline(
                draggedUser.dataset.userId,
                oldTimelineId,
                newTimelineId
            );
        });

        function updateUserTimeline(userId, oldTimelineId, newTimelineId) {

            $.ajax({
                url: "<?= base_url('Home/update_user_timeline') ?>",
                type: "POST",
                dataType: "json",
                data: {
                    tree_id: treeId,
                    user_id: userId,
                    from_timeline: oldTimelineId,
                    to_timeline: newTimelineId
                },
                success: function (res) {
                    console.log("User moved");
                }
            });
        }
        
        const menuAddConnection = document.getElementById("menuAddConnection");

        menuAddConnection.addEventListener("click", function (e) {

            e.stopPropagation();

            if (!activeUser) return;

            connectionStartUser = activeUser;

            activeUser.classList.add("connection-source");

            userMenu.style.display = "none";
            menu.style.display = "none";

            // alert("Now click on another user to connect");
        });
        
        document.addEventListener("click", function (e) {

            // If we are NOT in connection mode, do nothing
            if (!connectionStartUser) return;

            const targetUser = e.target.closest(".timeline-user");

            // If clicked on empty space (and not the menu), cancel mode
            if (!targetUser) {
                // We add a small check to ensure we didn't just click the menu 
                // (Double safety, though e.stopPropagation in step 1 handles this)
                if(!e.target.closest('#menuAddConnection')){
                    console.log("Clicked outside, resetting mode");
                    resetConnectionMode();
                }
                return;
            }

            e.preventDefault();
            e.stopPropagation();

            // Prevent connecting to self
            if (targetUser === connectionStartUser) {
                console.log("Cannot connect to self");
                resetConnectionMode();
                return;
            }

            // 🔥 Create connection
            createConnection(connectionStartUser, targetUser);

            resetConnectionMode();
        });


        
        function createConnection(userA, userB) {

            if (connectionExists(userA, userB)) return;

            const svg = document.getElementById("connectionLayer");

            const line = document.createElementNS("http://www.w3.org/2000/svg", "line");

            line.setAttribute("stroke", "#0d6efd");
            line.setAttribute("stroke-width", "2");
            line.setAttribute("data-from", userA.dataset.userId);
            line.setAttribute("data-to", userB.dataset.userId);

            svg.appendChild(line);

            const connection = { from: userA, to: userB, line };
            connections.push(connection);

            updateLinePosition(connection);

            // 🔥 Save to DB (optional)
            saveConnection(userA.dataset.userId, userB.dataset.userId);
        }
        
        function updateLinePosition(connection) {
            // 🔥 FIX: Select the image specifically, not the whole div
            const imgA = connection.from.querySelector('.user-avatar');
            const imgB = connection.to.querySelector('.user-avatar');

            // Get rect of the Image (if image is missing, fall back to the div)
            const rectA = (imgA || connection.from).getBoundingClientRect();
            const rectB = (imgB || connection.to).getBoundingClientRect();
            
            const svgRect = document.getElementById("connectionLayer").getBoundingClientRect();

            // Calculate center based on the IMAGE dimensions
            const x1 = rectA.left + rectA.width / 2 - svgRect.left;
            const y1 = rectA.top + rectA.height / 2 - svgRect.top;

            const x2 = rectB.left + rectB.width / 2 - svgRect.left;
            const y2 = rectB.top + rectB.height / 2 - svgRect.top;

            connection.line.setAttribute("x1", x1);
            connection.line.setAttribute("y1", y1);
            connection.line.setAttribute("x2", x2);
            connection.line.setAttribute("y2", y2);
        }

        function saveConnection(fromUser, toUser) {
            $.post("<?= base_url('Home/save_connection') ?>", {
                tree_id: treeId,
                from_user: fromUser,
                to_user: toUser
            });
        }

        document.addEventListener("keydown", function (e) {
            if (e.key === "Escape" && connectionStartUser) {
                connectionStartUser.classList.remove("connection-source");
                connectionStartUser = null;
            }
        });

        function resetConnectionMode() {
            if (connectionStartUser) {
                connectionStartUser.classList.remove("connection-source");
                connectionStartUser = null;
            }
        }

        function loadConnections(treeId) {
            $.get("<?= base_url('Home/get_connections') ?>", { tree_id: treeId }, function (res) {
                // Ensure res is an object if jQuery didn't parse it automatically
                if (typeof res === 'string') res = JSON.parse(res); 

                if (!res.success) return;

                res.connections.forEach(conn => {
                    // 🔥 Select by the attribute directly to be safe
                    const userA = document.querySelector(
                        `.timeline-user[data-user-id="${conn.from_user}"]`
                    );
                    const userB = document.querySelector(
                        `.timeline-user[data-user-id="${conn.to_user}"]`
                    );

                    // Debugging check
                    // console.log(`Connecting ${conn.from_user} to ${conn.to_user}`, userA, userB);

                    if (userA && userB) {
                        createConnection(userA, userB);
                    }
                });
            }, "json");
        }
        
        function connectionExists(a, b) {
            return connections.some(c =>
                (c.from === a && c.to === b) ||
                (c.from === b && c.to === a)
            );
        }

        function updateAllLines() {
            connections.forEach(conn => {
                updateLinePosition(conn);
            });
        }
        

        function updateAllConnections() {
            connections.forEach(connection => {
                updateLinePosition(connection);
            });
        }

        const artificialFamilyTab = document.getElementById('view-artificial-family-tab');

        artificialFamilyTab.addEventListener('shown.bs.tab', function (event) {
            console.log('Artificial Family tab activated');

            // 🔥 Run ONLY for this tab
            updateAllConnections();
        });
    });

</script>
<!-- Shiv Web Developer  -->
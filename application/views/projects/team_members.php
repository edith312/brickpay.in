<?php include(APPPATH . 'views/includes/header.php') ?>

<style>
    .switch {
        position: relative;
        display: inline-block;
        width: 43px;
        height: 100%;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        transition: 0.4s;
        border-radius: 34px;
        height: 17px;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 10px;
        width: 10px;
        border-radius: 50%;
        left: 4px;
        bottom: 3px;
        background-color: white;
        transition: 0.4s;
    }

    input:checked+.slider {
        background-color: #007bff;
    }

    input:checked+.slider:before {
        transform: translateX(26px);
    }

    .view-btn {
        cursor: pointer;
        user-select: none;
        border-radius: 6px;
    }

    .view-btn.active {
        background: #0d6efd;
        color: #fff;
        border-color: #0d6efd;
    }
    .row.timeline-row {
        display: flex;
        align-items: center;
        margin-bottom: 40px;
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

<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
    <h5 class="" id="teamMembersModalLabel">Team Members</h5>

    <div class="team-members-wrapper">
        <?php if ($getProject['user_id'] == sessionId('freelancer_id')) { ?>
            <div class="viewpermissiontocompanyteam">
                <!-- Question 1 -->
                <div>
                    <!-- <form id="permissionForm" method="post">
                        <dl class="d-flex align-items-center" id="questionBox1">
                            <dt class="small me-2 mb-0">You want Company Members to be part of this Project ?</dt>
                            <dd class="mb-0 d-flex align-items-center gap-3">
                                <label class="switch me-2">
                                    <input type="checkbox" class="enableSwitch" data-index="1" value="yes" id="checkyes" name="checkyes">
                                    <span class="slider round"></span>
                                </label>
                                <span class="enableDisableLabel" data-index="1">No</span>
                            </dd>
                            <input type="hidden" value="<?= $brick_id ?>" id="permission_brick_id" required>
                            <input type="hidden" value="<?= $bricks['company_id'] ?>" id="permission_company_id" required>
                            <select class="form-select ms-5" style="width:200px;" name="permission" required id="selectedval">
                                <option value="" selected disabled> Permission </option>
                                <option value="1"> Viewer </option>
                                <option value="2"> Editor </option>
                                <option value="3"> Comments </option>
                            </select>
                            <button type="submit" class="btn btn-primary m-0" id="companyPermission"> Update </button>
                        </dl>
                    </form> -->
                    <form id="projectPermissionForm">
                        <dl class="d-flex align-items-center gap-2">
                            <dt class="small me-2 mb-0">
                                You want Company Members to be part of this Project?
                            </dt>

                            <dd class="mb-0 d-flex align-items-center gap-3">
                                <label class="switch me-2">
                                    <input type="checkbox" id="project_company_toggle" <?= !empty($perm) ? 'checked' : '' ?>>
                                    <span class="slider round"></span>
                                </label>
                                <span id="project_company_label">No</span>
                            </dd>

                            <input type="hidden" id="permission_project_id" value="<?= $getProject['id'] ?>">
                            <input type="hidden" id="permission_company_id" value="<?= $getProject['company_id'] ?>">

                            <div class="d-flex gap-2 view-selector">
                                <span class="view-btn px-2 py-1 border border-secondary" data-value="1d">1D View</span>
                                <span class="view-btn px-2 py-1 border border-secondary" data-value="2d">2D View</span>
                                <span class="view-btn px-2 py-1 border border-secondary" data-value="3d">3D View</span>
                                <span class="view-btn px-2 py-1 border border-secondary" data-value="family">Artificial Family</span>
                            </div>

                            <input type="hidden" id="selectedView" name="selected_view">

                            <select class="form-select ms-3" style="width:200px;" id="project_company_permission">
                                <option value="viewer"  <?= ($perm['permission'] ?? '') == 'viewer' ? 'selected' : '' ?>>Viewer</option>
                                <option value="editor"  <?= ($perm['permission'] ?? '') == 'editor' ? 'selected' : '' ?>>Editor</option>
                                <option value="comment" <?= ($perm['permission'] ?? '') == 'comment' ? 'selected' : '' ?>>Comment</option>
                            </select>

                            <button type="submit" class="btn btn-primary ms-2">
                                Update
                            </button>
                        </dl>
                    </form>
                    <div id="conditionalForm1" style="display:none;">
                        <!-- Your extra form/fields for Q1 -->
                        <!-- <input type="text" placeholder="Company Members Form Field"> -->
                    </div>
                </div>
                <hr>
            <?php } ?>


            <div class="d-flex align-items-center mb-3 mt-4">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" id="view-1d-tab" data-bs-toggle="tab" href="#view-1d">1D View</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="view-2d-tab" data-bs-toggle="tab" href="#view-2d">2D View</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="view-3d-tab" data-bs-toggle="tab" href="#view-3d">3D View</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="view-artificial-family-tab" data-bs-toggle="tab" href="#view-artificial-family">Artificial Family</a>
                    </li>
                </ul>
                <div class="ms-auto">
                    <a href="<?= base_url('company/create-team-new') ?>" class="btn btn-primary w-auto d-inline-block">Manage Team</a>
                </div>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="view-1d">
                    <?php if (!empty($getTeamMembers)) : ?>
                        <div class="row">
                            <?php foreach ($getTeamMembers as $member) :
                                $memberInfo = $this->CommonModal->getSingleRowById('tbl_freelancer', ['id' => $member['member_id']]);
                            ?>
                                <div class="col-md-12">
                                    <div onclick="window.location.href='<?= base_url('company/user_preview?id=' . $memberInfo['id']) ?>'" class="team-member-card">
                                        <img src="<?= !empty($memberInfo['user_image']) ? base_url() . 'uploads/user_profile/' . $memberInfo['user_image'] : base_url() . 'assets/user-icon.png' ?>" alt="Profile Picture">
                                        <div class="team-member-info">
                                            <h6><?= $memberInfo['name'] ?: 'No Name' ?></h6>
                                            <p><strong>Email:</strong> <a href="mailto:<?= $memberInfo['email'] ?: 'N/A' ?>"><?= $memberInfo['email'] ?: 'N/A' ?></a></p>
                                            <p><strong>Phone:</strong> <?= $memberInfo['phone'] ?: 'N/A' ?></p>
                                        </div>
                                        <span class="team-member-status <?= $member['status'] ?>"><?= $member['status'] ?></span> &nbsp;
                                        <a class="text-danger" title="Remove Member" href="<?= base_url('Home/deleteAddedMember?id=' . $member['id']) ?>" onclick="return confirm('Are you sure you want to delete this User?');"><i class="fas fa-trash"></i></a>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else : ?>
                        <div class="col-12">
                            <p class="text-muted">No team members found.</p>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="tab-pane fade" id="view-2d">
                    <div class="timeline-container position-relative mt-4">
                        <div class="timeline mt-md-3" id="timeline"></div>
                    </div>
                </div>
                <div class="tab-pane fade" id="view-3d-tab"></div>
                <div class="tab-pane fade" id="view-artificial-family">
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
                            <input type="hidden" value="<?= $project_id ?>" name="type_id">
                            <input type="hidden" value="1" name="tree_type">
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

<?php include(APPPATH . 'views/includes/footer-link.php') ?>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const timeline = document.getElementById("timeline");
    const companyId = <?= json_encode($getProject['company_id'] ?? '') ?>;
    const projectId = <?= json_encode($getProject['id'] ?? '') ?>;
    const agreeMentbaseUrl = '<?= base_url('Uploads/agreements') ?>';

    if (!timeline) {
        console.error("Element with id 'timeline' not found.");
        return;
    }

    if (!companyId || !projectId) {
        console.error("Company ID or Project ID is not available.");
        timeline.innerHTML = "<p class='text-muted'>Company or Project ID not found.</p>";
        return;
    }

    // Function to extract file name from URL or path
    function getFileName(path) {
        if (!path) return '';
        return path.split('/').pop();
    }

    // Fetch team structure when 2D tab is shown
    document.getElementById('view-2d-tab').addEventListener('shown.bs.tab', function() {
        fetch('<?= base_url() ?>Home/get_team_structure', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    company_id: companyId,
                    project_id: projectId
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! Status: ${response.status}`);
                }
                return response.text();
            })
            .then(text => {
                if (text.trim().startsWith('<')) {
                    console.error("Received HTML instead of JSON:", text.substring(0, 100));
                    throw new Error("Server returned HTML instead of JSON. Check backend endpoint.");
                }
                return JSON.parse(text);
            })
            .then(data => {
                console.log("Fetched data:", data);
                if (data.status === 'success') {
                    renderTimeline(data.departments);
                } else {
                    console.error("Backend error:", data.message);
                    alert(`Error: ${data.message}`);
                    timeline.innerHTML = "<p class='text-muted'>No team structure data available.</p>";
                }
            })
            .catch(error => {
                console.error('Fetch error:', error.message);
                alert('Failed to load team structure. Please try again later.');
                timeline.innerHTML = "<p class='text-muted'>Error loading team structure: " + error.message + "</p>";
            });
    });

    function renderTimeline(departments) {
        timeline.innerHTML = "";

        if (!departments || !Array.isArray(departments) || departments.length === 0) {
            timeline.innerHTML = "<p class='text-muted'>No departments found.</p>";
            return;
        }

        departments.forEach(dept => {
            const row = document.createElement("div");
            row.className = "row timeline-row";

            const shortId = dept.id.substring(0, 8); // Use first 8 chars of UUID
            const label = document.createElement("div");
            label.className = "label";
            label.innerText = `${dept.name}`;
            row.appendChild(label);

            const line = document.createElement("div");
            line.className = "line agreement-start";

            const docIcon = document.createElement("div");
            docIcon.className = "doc-icon";
            docIcon.innerHTML = '<i class="fas fa-file-alt"></i>';

            const agreements = Array.isArray(dept.agreements) ? dept.agreements : [];
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

            let membersArray = dept.members || [];
            if (!Array.isArray(membersArray) && typeof membersArray === 'object') {
                membersArray = Object.values(membersArray);
            }
            if (!Array.isArray(membersArray)) {
                console.warn(`Invalid members format for department ${dept.id}:`, membersArray);
                membersArray = [];
            }

            const totalCircles = membersArray.length;

            membersArray.forEach((member, index) => {
                const circle = document.createElement("div");
                circle.className = "circle";
                circle.dataset.memberId = member.id;
                circle.style.backgroundImage = `url(${member.avatar || '<?= base_url() ?>assets/user-icon.png'})`;

                const position = totalCircles <= 1 ? 50 : (index / (totalCircles - 1)) * (100 - 10) + 5;
                circle.style.left = `${position}%`;

                const onlineDiv = document.createElement("div");
                onlineDiv.className = "active-status";
                circle.appendChild(onlineDiv);

                const nameSpan = document.createElement("span");
                nameSpan.className = "circle-name";
                nameSpan.innerText = `${member.name || 'Unknown'} (${member.nickname || 'N/A'})`;
                circle.appendChild(nameSpan);

                const tooltip = document.createElement("div");
                tooltip.className = "tooltip";
                tooltip.innerHTML = `<div>${member.name || 'Unknown'} (${member.email || 'N/A'})</div>`;
                circle.appendChild(tooltip);
                circle.addEventListener("mouseenter", () => tooltip.style.display = "block");
                circle.addEventListener("mouseleave", () => tooltip.style.display = "none");

                // ✅ Create <a> wrapper
                const link = document.createElement("a");
                link.href = "<?= base_url('company/user_preview?id=') ?>" + member.id;
                link.target = "_blank"; // optional

                // Circle ko link ke andar daalo
                link.appendChild(circle);

                // Finally append link to line
                line.appendChild(link);

            });

            row.appendChild(line);
            timeline.appendChild(row);
        });
    }
});
</script>

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

<script>
document.querySelectorAll('.view-btn').forEach(btn => {
    btn.addEventListener('click', function () {
        document.querySelectorAll('.view-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');

        document.getElementById('selectedView').value = this.dataset.value;
        console.log('Selected:', this.dataset.value);
    });
});
</script>

<script>
$('#projectPermissionForm').on('submit', function (e) {
    e.preventDefault();

    const projectId  = $('#permission_project_id').val();
    const enabled    = $('#project_company_toggle').is(':checked') ? 1 : 0;
    const permission = $('#project_company_permission').val();

    if (!projectId) {
        alert('Project missing');
        return;
    }

    $.ajax({
        url: "<?= base_url('home/saveProjectPermission') ?>",
        type: "POST",
        dataType: "json",
        data: {
            entity_type: 'project',
            entity_id: projectId,
            target_team: 'company',
            enabled: enabled,
            permission: permission
        },
        success: function (res) {
            if (res.success) {
                $('#project_company_label').text(enabled ? 'Yes' : 'No');
                alert('Permission updated ✅');
            } else {
                alert(res.message || 'Failed to update');
            }
        },
        error: function (xhr) {
            console.error(xhr);
            alert('Server error');
        }
    });
});
</script>
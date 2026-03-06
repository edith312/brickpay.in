<?php include(APPPATH . 'views/includes/header-link.php') ?>
<?php include(APPPATH . 'views/includes/header.php') ?>

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
    .search-btn{
      right: 10px;
      top: 50%;
      transform: translateY(-50%);
      border-radius: 50%;
      background-color: transparent;
      border: none;
      cursor: pointer;
    }
    .search-btn:hover{
      background-color: white; 
    }
</style>

<style>
    body {
        margin: 0px !important;
    }
    .label-project-preview {
        font-size: 14px;
        color: #070808;
        font-weight: 600;
        margin-right: 0;
    }

    .card div {
        font-size: 16px;
    }

    .custom-btn {
        background-color: #28a745;
        color: white;
        padding: 10px 18px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        font-size: 16px;
    }

    .custom-btn i {
        margin-right: 8px;
    }

    /* Team Member Card Styles */
    .team-member-card {
        display: flex;
        align-items: center;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 15px;
        margin-bottom: 15px;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        transition: box-shadow 0.2s;
        cursor: pointer;
    }

    .team-member-card:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .team-member-card img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        object-fit: cover;
        margin-right: 15px;
        border: 2px solid #e9ecef;
    }

    .team-member-info {
        flex-grow: 1;
    }

    .team-member-info h6 {
        margin: 0;
        font-size: 16px;
        font-weight: 600;
        color: #070808;
    }

    .team-member-info p {
        margin: 2px 0;
        font-size: 14px;
        color: #555;
    }

    .team-member-status {
        font-size: 12px;
        font-weight: 500;
        padding: 5px 10px;
        border-radius: 12px;
        text-transform: uppercase;
    }

    .Accepted {
        background-color: #d4edda;
        color: #155724;
    }

    .Rejected {
        background-color: #f8d7da;
        color: #721c24;
    }

    .Requested {
        background-color: #fff3cd;
        color: #856404;
    }

    /* Timeline Styles */
    .timeline-container {
        padding: 20px;
        background: #f8f9fa;
        border-radius: 8px;
        position: relative;
    }

    .timeline {
        position: relative;
        margin: 20px 0;
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

    .modal-overlay {
     position: fixed;
     top: 0;
     left: 0;
     width: 100vw;
     height: 100vh;
     background-color: rgba(0, 0, 0, 0.7);
     display: none;
     align-items: center;
     justify-content: center;
     z-index: 1000;
   }

   .modal-box {
     background: #fff;
     border-radius: 10px;
     padding: 20px 30px;
     width: 90%;
     max-width: 600px;
     box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
     position: relative;
   }

   .modal-close {
     position: absolute;
     top: 10px;
     right: 15px;
     font-size: 22px;
     cursor: pointer;
   }
</style>

<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
    <h5 class="" id="teamMembersModalLabel">Team Members</h5>
    <div class="border p-3 mt-3 rounded team-members-wrapper">
        <div class="d-flex align-items-center mb-3">
            <!-- <h5 class="me-3 mb-0">Team Members</h5> -->
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
            <a class="btn btn-primary ms-auto" href="<?= base_url('company/create-team') ?>">Manage Team</a>
        </div>
        <div class="tab-content">
            <div class="tab-pane fade show active" id="view-1d">
                <?php if (!empty($getTeamMembers)) : ?>
                    <div class="row">
                        <?php foreach ($getTeamMembers as $member) :
                            $memberInfo = $this->CommonModal->getSingleRowById('tbl_freelancer', ['id' => $member['member_id']]);
                        ?>
                            <div class="col-md-6">
                                <div onclick="window.location.href='<?= base_url('company/user_preview?id=' . $memberInfo['id']) ?>'" class="team-member-card">
                                    <img src="<?= !empty($memberInfo['user_image']) ? base_url() . 'uploads/user_profile/' . $memberInfo['user_image'] : base_url() . 'assets/user-icon.png' ?>" alt="Profile Picture">
                                    <div class="team-member-info">
                                        <h6><?= $memberInfo['name'] ?: 'No Name' ?></h6>
                                        <p><strong>Email:</strong> <a href="mailto:<?= $memberInfo['email'] ?: 'N/A' ?>"><?= $memberInfo['email'] ?: 'N/A' ?></a></p>
                                        <p><strong>Phone:</strong> <?= $memberInfo['phone'] ?: 'N/A' ?></p>
                                    </div>
                                    <span class="team-member-status <?= $member['status'] ?>"><?= $member['status'] ?></span>
                                    <a class="text-danger" href="<?= base_url('Home/deleteAddedMember?id=' . $member['id']) ?>" onclick="return confirm('Are you sure you want to delete this User?');">Remove</a>
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

<?php include(APPPATH . 'views/includes/footer-link.php') ?>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const timeline = document.getElementById("timeline");
        const companyId = <?= json_encode($getProfile['id'] ?? '') ?>;
        const agreeMentbaseUrl = '<?= base_url('uploads/agreements') ?>';

        if (!timeline) {
            console.error("Element with id 'timeline' not found.");
            return;
        }

        if (!companyId) {
            console.error("Company ID is not available.");
            timeline.innerHTML = "<p class='text-muted'>Company ID not found.</p>";
            return;
        }

        // Function to extract file name from URL or path
        function getFileName(path) {
            if (!path) return '';
            // Extract the last part after the last '/'
            return path.split('/').pop();
        }

        // Fetch team structure for the company
        fetch('<?= base_url() ?>Home/get_team_structure', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    company_id: companyId
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
                console.log("Fetched data:", data); // Log response for debugging
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

        function renderTimeline(departments) {
            timeline.innerHTML = "";

            if (!departments || !Array.isArray(departments) || departments.length === 0) {
                timeline.innerHTML = "<p class='text-muted'>No departments found.</p>";
                return;
            }

            departments.forEach(dept => {
                const row = document.createElement("div");
                row.className = "row timeline-row";

                const shortId = dept.id.replace("dept-", "D");
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

        // Existing script for appeal and docThumb
        document.getElementById('appealYes')?.addEventListener('change', function() {
            document.getElementById('appealContent')?.classList.remove('d-none');
        });

        document.getElementById('appealNo')?.addEventListener('change', function() {
            document.getElementById('appealContent')?.classList.add('d-none');
        });

        document.getElementById('docThumb')?.addEventListener('click', function() {
            var modal = new bootstrap.Modal(document.getElementById('docModal'));
            modal.show();
        });
    });
</script>
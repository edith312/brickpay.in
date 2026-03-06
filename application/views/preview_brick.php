<?php include('includes/header.php') ?>
<style>
    .project-row {
        display: grid;
        grid-template-columns: 30px 1fr 1fr 1fr 1fr 50px;
        align-items: center;
        border: 1px solid #dce3e8;
        border-radius: 4px;
        color: #00a7cc;
        font-weight: 600;
        border-bottom: 0;
    }

    .project-cell {
        padding: 3px 10px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .project-cell.index {
        border-right: 1px solid #ccc;
        text-align: center;
    }

    .eye-icon {
        font-size: 18px;
        color: #00a7cc;
    }

    .project-grid-bottom-1 {
        grid-template-columns: 30px repeat(4, 1fr);
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

    .row {
        margin-bottom: 0px !important;
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

    /* Modal Styles */
    .team-members-modal .modal-dialog {
        max-width: 90vw;
        /* Use 90% of viewport width for a very large modal */
        width: 1200px;
        /* Fixed width for consistency, adjustable */
    }

    .team-members-modal .modal-content {
        border-radius: 8px;
    }

    .team-members-modal .modal-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }

    .team-members-modal .modal-body {
        padding: 20px;
        max-height: 80vh;
        /* Limit height to 80% of viewport height */
        overflow-y: auto;
        /* Enable vertical scrolling if content overflows */
    }

    .team-members-modal .team-member-card {
        min-width: 300px;
        /* Ensure cards don't shrink too much */
    }

    .team-members-modal .timeline-container {
        min-height: 200px;
        /* Ensure timeline has enough space */
    }
    .resources-middle-line{
        border: 1px dashed black;
        position: absolute;
        top: 50%;
        left: 0px;
        width: 41vw;
        z-index: 0;
    }
    /* Channel Section  */
</style>
<!-- Shiv Web Developer -->
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
    <?php
    if ($this->session->has_userdata('bricksFundstatus')) {
        echo $this->session->userdata('bricksFundstatus');
        $this->session->unset_userdata('projectMsg');
    }
    ?>

    <div style="position:absolute; left:15%;">
        <?php if ($bricks['artificialdate'] != NULL) {
            $dateString = $bricks['artificialdate']; // Example: "2026-03-12T01:25"
            // Convert to timestamp
            $timestamp = strtotime($dateString);
            // Format date as DD/MM/YYYY hh:mm AM/PM
            $formattedDate = date("d/m/Y h:i A", $timestamp);
            echo 'Artificial Brick: ' . $formattedDate; // Output: 12/03/2026 01:25 AM
        } ?>
    </div>

    <div class="edit-brick-button d-flex justify-content-end align-items-center gap-2" style="text-align: right;">

        <?php
        $brick_id = $bricks['id'];
        $count = $this->db->where('brick_id', $brick_id)->count_all_results('tbl_brick_pass_channel');
        ?>
        <span>Already Created Channel: <?= $count; ?> </span>

        <div class="d-flex">
            <a href="<?= base_url("company/brick-team-members?id=$brick_id") ?>" class="btn btn-dark me-2" id="temmembersBtnWrapper" >
                <i class="bi bi-person-plus me-1"></i> 
                Team Members
            </a>
            <a class="btn btn-primary me-2" href="<?= base_url("Home/brick_pdf?brick_id=$brick_id") ?>">
                <i class="fa-solid fa-arrow-down"></i>
                Download PDF
            </a>
        </div>

        <?php
        $check_permission = $this->CommonModal->getSingleRowById('tbl_permissions', ['brick_id' => $bricks['id'], 'user_id' => sessionId('freelancer_id')]);

        if ($bricks['user_id'] == sessionId('freelancer_id') || $check_permission['edit'] == '2') {
        ?>
            <a href="<?= base_url('company/create-brick?id=' . $bricks['id']) ?>" class="btn btn-success">
                <i class="fas fa-edit"></i> Edit Brick
            </a>
        <?php
        }
        ?>
    </div>


    <div class="card p-4">
        <div class="p-3">
            <?php
            if ($bricks['brick_completed'] == 'completed') {

            ?>
                <h6>Completed:</h6>
                <div class="progress">
                    <div style="width: 100%; background-color: #ff6501 !important;" class="progress-bar"></div>
                </div>
                <small class="text-muted">Project completed in <strong>100%</strong>. Remaining close the project.</small>

            <?php } else { ?>
                <h6>Completed:</h6>
                <div class="progress">
                    <div style="width: 60%;" class="progress-bar"></div>
                </div>
                <small class="text-muted">Project completed in <strong>60%</strong>. Remaining close the project.</small>
            <?php } ?>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <?php
                if ($bricks['perpro'] !== NULL && $bricks['forpercomp'] == 'user') { ?>
                    <div>
                        <?php
                        $brickOwnerDetails = $this->CommonModal->getSingleRowById('freelancer', ['id' => $bricks['user_id']]);
                        if (!empty($brickOwnerDetails)):
                        ?>
                            <div class="col-md-12 p-2" style="z-index:5;">
                                <div onclick="window.location.href='<?= base_url('company/user_preview?id=' . $brickOwnerDetails['id']) ?>'" class="team-member-card">
                                    <img src="<?= !empty($brickOwnerDetails['user_image']) ? base_url() . 'uploads/user_profile/' . $brickOwnerDetails['user_image'] : base_url() . 'assets/user-icon.png' ?>" alt="Profile Picture">
                                    <div class="team-member-info">
                                        <h6><?= $brickOwnerDetails['name'] ?: 'No Name' ?></h6>
                                        <p><strong>Email:</strong> <a href="mailto:<?= $brickOwnerDetails['email'] ?: 'N/A' ?>" style="width:200px;"><?= $brickOwnerDetails['email'] ?: 'N/A' ?></a></p>
                                        <p><strong>Phone:</strong> <?= $brickOwnerDetails['phone'] ?: 'N/A' ?></p>
                                    </div>
                                    <!-- <span class=" btn btn-primary team-member-status <//?= $getBrickAll['status'] ?>"><//?= $getBrickAll['status'] ?></span> &nbsp; -->
                                    <?php if ($bricks['user_id'] == sessionId('freelancer_id') || $check_permission['delete'] == '2') {
                                    ?>
                                        <a class="text-danger" title="Remove Member" href="<?= base_url('Home/deleteAddedMember?id=' . $getInvest['id']) ?>" onclick="return confirm('Are you sure you want to delete this User?');"><i class="fas fa-trash"></i></a>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php  }
                ?>
                <h5 class="px-2"><?= $companyDetails['company_name'] ?></h5>
                <h6 class="px-2"><?= $bricks['brick_title'] ?></h6>
            </div>

            <div>
                <h5><?= $projectDetails['project_name'] ?></h5>
                <span><?= $projectDetails['id'] ?></span><br>
            </div>

            <div style="text-align: right;">
                <span><?= $projectDetails['project_name'] ?></span>
                <span><?= generateBrickId($bricks['id']) ?></span><br>
                <div style="display: inline-block; background: <?= brickColor($bricks['brick_type']) ?>; color: black; padding: 4px 10px; border-radius: 20px; font-weight: 600; margin-top: 5px;">
                    <?= brickType($bricks['brick_type']) ?>
                </div>
                <a href="<?= base_url('company/project_history?id=') . $projectDetails['id'] ?>" class="btn btn-primary mt-md-2" style="border-radius: 0.375rem;">
                    Project History File
                </a>

                <a href="<?= base_url('company/timestamps?id=') . $bricks['id']; ?>" class="btn btn-primary mt-md-2 text-center" style="border-radius: 0.375rem;">
                    TimeStamps
                </a>

            </div>
        </div>


        <div class="row g-0 mt-4 align-items-stretch" style="border-top: 1px dotted;border-bottom: 1px dotted">
            <div class="col-6 border-end-right">
                <div class="p-3 h-100">
                    <div class="d-flex justify-content-between align-items-center mb-0 w-100">
                        <div class="d-flex align-items-center">
                            <span class="small me-2">This Task required funding of:</span> <!-- Updated by @Shiv Web Developr  -->
                            <span id="total_amount">
                                <?php
                                    $cur_arr = explode('|',$bricks['currency_symbol']); 
                                    echo $cur_arr[1]; echo ' - '; echo $cur_arr[0];
								?>
                                <?= $bricksFunding['fund_required'] ?></span>
                        </div>
                        <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#fundModal" style="position: absolute; top:47px; left:39%; text-align: center; font-size:16px; padding:1px 20px;">Fund Now</button>
                    </div>
                    <div class="">
                        <p class="small"><b>Funding Type:</b> <?= $bricksFunding['funding_type'] ?></p>
                        <?php if($bricksFunding['funding_type'] == 'equity'): ?>
                            <p class="small"><b>Pre Money Valuation:</b> <?= $bricksFunding['pre_money_valuation'] ?></p>
                            <p class="small mt-0"><b>Post Money Valuation:</b> <?= $bricksFunding['post_money_valuation'] ?></p>
                        <?php endif; ?>
                        <?php if($bricksFunding['funding_type'] == 'loan'): ?>
                            <p class="small"><b>Loan Interest (% p.a):</b> <?= $bricksFunding['loan_interest_rate'] ?></p>
                        <?php endif; ?>
                        <?php if($bricksFunding['funding_type'] == 'barter'): ?>
                            <p class="small"><b>barter Deal:</b> <?= $bricksFunding['barter_deal'] ?></p>
                        <?php endif; ?>
                        <?php if($bricksFunding['funding_type'] == 'other'): ?>
                            <p class="small"><b>Other:</b> <?= $bricksFunding['other_funding_type'] ?></p>
                        <?php endif; ?>
                    </div>
                    <dl class="d-flex align-items-center mb-3">
                        <dt class="small me-2 mb-0">Would you like to see Appeal Statement:</dt>
                        <dd class="mb-0 d-flex align-items-center gap-3">
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="radio" name="appeal_statement" id="appealYes" value="yes">
                                <label class="form-check-label" for="appealYes">Yes</label>
                            </div>
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="radio" name="appeal_statement" id="appealNo" value="no">
                                <label class="form-check-label" for="appealNo">No</label>
                            </div>
                        </dd>
                    </dl>
                    <!-- <div style="width:130px; position: absolute; top:75px; left: 34%;">
                        <div class="form-group mt-3">
                            <label for="project_id"><strong> Open For: </strong> </label>
                            <select class="form-control" id="project_id" name="project_id[]" multiple>
                                <option value="Equity ">Equity </option>
                                <option value="Finance/Lending/Loans">Finance/Lending/Loans</option>
                                <option value="Bonds">Bonds</option>
                                <option value="Barter">Barter</option>
                            </select> -->
                            <!-- <small class="text-muted">Hold <b>CTRL</b> (Windows) or <b>CMD</b> (Mac) to select multiple</small> -->
                        <!-- </div>
                    </div> -->


                    <div id="appealContent" class="row d-none">
                        <div class="col-md-12">
                            <?= $bricksFunding['appeal_statement'] ?>
                        </div>
                        <div class="row m-md-3">
                            <?php if ($bricks['fundvideo']) { ?>
                                <div class="col-md-6">
                                    <div class="ratio ratio-16x9">
                                        <iframe src="<?= $bricks['fundvideo']; ?>" title="YouTube video" allowfullscreen></iframe>
                                    </div>
                                </div>
                            <?php } else {
                                echo '<p>Video Not Upload</p>';
                            } ?>
                            <?php if ($bricks['funddocument']) { ?>
                                <div class="col-md-6">
                                    <div class="ratio ratio-4x3" style="cursor:pointer;" id="docThumb" data-doc="<?= $bricks['funddocument']; ?>">
                                        <iframe src="<?= $bricks['funddocument']; ?>" frameborder="0" style="object-fit: cover;"></iframe>
                                    </div>
                                </div>
                            <?php } else {
                                echo '<p>Document Not Upload</p>';
                            } ?>
                            <?php if ($bricks['fundaudio']) { ?>
                                <div class="col-md-6 my-3">
                                    <div class="ratio ratio-4x3" style="cursor:pointer;" id="docThumb" data-doc="<?= $bricks['fundaudio']; ?>">
                                        <audio controls style="width:100%; height:50px; object-fit:cover;">
                                            <source src="<?= $bricks['fundaudio']; ?>" type="audio/mpeg">
                                            Your browser does not support the audio element.
                                        </audio>
                                    </div>
                                </div>
                            <?php } else {
                                echo '<p>Audio Not Upload</p>';
                            } ?>
                        </div>

                    </div>

                    <div class="modal fade" id="docModal" tabindex="-1" aria-labelledby="docModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-xl modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-body p-0">
                                    <iframe src="https://docs.google.com/document/d/1hGMVWnakHB29QQtBYfsfuzG-jvb6eOKnJI3IGEt-ylU/edit?tab=t.m340geqhx9vl" style="width: 100%; height: 80vh;" frameborder="0"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="p-3 h-100">
                    <dl class="dl-horizontal mb-0 mt-5 pt-4">
                        <button class="btn text-center btn-sm btn-primary" style="width:450px; position: absolute; top:0px; left:34%; text-align: center; font-size:16px; padding:5px 20px;">
                            <!-- <div style="position:relative !important;"> -->
                            <select class="form-select text-white" name="whatyou" id="project_component" style="height:30px; width:160px; margin-right: 10px; background-color: #4772f3; ">
                                <!-- <option value="">-- Select --</option> -->
                                <!-- <option value="brick">Brick</option> -->
                                <option value="task">Task</option>
                                <option value="milestone">Milestone</option>
                                <option value="strategie">Strategie</option>
                                <option value="scene">Scene</option>
                                <option value="updates">Updates</option>
                                <option value="events">Events</option>
                            </select>
                            <button type="button" class="btn btn-primary text-center" style="position:absolute; top:3px; right:41%; width:160px; padding-left:45px;" data-bs-toggle="modal" data-bs-target="#taskDescModal"> Description </button>
                            <!-- </div> -->
                        </button>
                        <div class="d-flex justify-content-start align-items-center mb-1" style="margin-top:-40px;">
                            <dt class="small me-2 mb-0">Task Reward:</dt>
                            <dd class="mb-0"><?= $bricks['reward_disclosed'] ?></dd>
                        </div>
                        <div style="">
                            <div class="d-flex align-items-center mb-1">
                                <dt class="small me-2 mb-0">Skills:</dt>
                                <dd class="mb-0 d-flex flex-wrap gap-1">
                                    Required: <?= $bricksSkills['required_skill'] ?> |
                                    Optional: <?= $bricksSkills['optional_skill'] ?> </br>
                                </dd>
                            </div>
                            <div class="d-flex align-items-center mb-1">
                                <dt class="small me-2 mb-0">Education:</dt>
                                <dd class="mb-0 d-flex flex-wrap gap-1">
                                    Required:<?= $bricksSkills['required_education'] ?> |
                                    Optional:<?= $bricksSkills['optional_education'] ?>
                                </dd>
                            </div>
                            <div class="d-flex align-items-center mb-1">
                                <dt class="small me-2 mb-0">Experience:</dt>
                                <dd class="mb-0 d-flex flex-wrap gap-1">
                                    <?= $bricksSkills['experience'] ?>
                                </dd>
                            </div>
                        </div>
                        <!-- Updated by @Shiv Web Developr -->
                        <div class="row  mt-md-4">
                            <div class="col-md-3 mb-3 d-flex flex-column" style="margin-top:0px;">
                                <form action="<?= base_url('/company/add-work-allotment') ?>" method="post">
                                    <input type="hidden" class="form-control" placeholder="Company ID" name="company_id" required value="<?= $bricks['company_id'] ?>" />
                                    <input type="hidden" class="form-control" placeholder="Project ID" name="project_id" required value="<?= $bricks['project_id'] ?>" />
                                    <input type="hidden" class="form-control" placeholder="Brick ID" name="brick_id" required value="<?= $bricks['id'] ?>" />

                                    <div class="input-groups">
                                        <!-- <span class="input-group-text">
                                            <i class="fa fa-plus"></i>
                                        </span> -->
                                        <input type="text" class="form-control" placeholder="Your Work BID" name="bid_amount" required>
                                        <input type="text" class="form-control" placeholder="Your Delivery Time" name="delivery_time" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-center mb-2" style="border-radius: 0.375rem; width: 100%;">
                                        <i class="fa fa-user-plus me-1"></i> Apply for Work
                                    </button>
                                </form>
                            </div>

                            <?php
                            if ($bricks['project_consultancy'] == 'Yes') {
                            ?>
                                <!-- <div class="col-md-1"> </div> -->
                                <div class="col-md-8 mb-3 d-flex flex-column" style="margin-top:30px; margin-left:25px;">
                                    <form action="<?= base_url('/company/add_consultancy_advisory') ?>" method="post">
                                        <input type="hidden" class="form-control" placeholder="Company ID" name="company_id" required value="<?= $bricks['company_id'] ?>" />
                                        <input type="hidden" class="form-control" placeholder="Project ID" name="project_id" required value="<?= $bricks['project_id'] ?>" />
                                        <input type="hidden" class="form-control" placeholder="Brick ID" name="brick_id" required value="<?= $bricks['id'] ?>" />

                                        <div class="input-group">
                                            <span class="input-group-text">
                                                <i class="fa fa-plus"></i>
                                            </span>
                                            <input type="text" class="form-control" placeholder="Message" name="message" required style="height: 40px;">
                                            <input type="text" class="form-control" placeholder="Money" name="money" required style="height: 40px;">
                                            <select class="form-select" name="consultancy_type" required style="height: 40px;">
                                                <option value="" disabled selected>Select Consultancy Type</option>
                                                <option value="Consultancy">Consultancy</option>
                                                <option value="Advisory">Advisory</option>
                                                <option value="Mentorship">Mentorship</option>
                                            </select>
                                        </div>
                                        <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-center mb-2" style="border-radius: 0.375rem; width: 100%;">
                                            <i class="fa fa-user-plus me-1"></i> Apply for Project Consultancy / Advisory / Mentorship
                                        </button>
                                    </form>
                                </div>

                            <?php } ?>
                        </div>
                        <div class="component_parent_container">
                            <div class="text-center mb-1">
                                <button type="button" class="btn text-white" style="background-color:#00b8d6; border-radius: 0px; justify-self: center; width:220px;"> <strong> Living Components </strong> </button>
                            </div>
                            <div class="text-center mb-1">
                                <div class="resources-wrapper position-relative">
                                    <button type="button" class="btn text-white" style="background-color:#00b8d6; border-radius: 0px; justify-self: center; width:220px; position: relative; z-index: 1;"> <strong> Resources </strong> 
                                    </button>
                                    <span class="resources-middle-line"></span>
                                </div>
                            </div>
                            <div>
                                <div class="text-center mt-1">
                                    <button type="button" class="btn text-white" style="background-color:#00b8d6; border-radius: 0px; justify-self: center; width:220px;"> <strong> Non Living Components </strong> </button>
                                </div>

                                <div class="d-flex align-items-center w-100 mt-4 mb-3">
                                    <button type="buttton" class="btn btn-primary" style="border-radius:0px;" onclick="NonLivingPreview('resourcesdocument')">
                                        <i class="fas fa-video"></i> Document
                                    </button>
                                    <button type="buttton" class="btn btn-primary" style="border-radius:0px;" onclick="NonLivingPreview('resourcesaudio')">
                                        <i class="fas fa-microphone-alt"></i> Audio
                                    </button>
                                    <button type="buttton" class="btn btn-primary" style="border-radius:0px;" onclick="NonLivingPreview('resourcesvideo')">
                                        <i class="fas fa-video"></i> Video
                                    </button>
                                    <button type="buttton" class="btn btn-primary" style="border-radius:0px;" onclick="NonLivingPreview('resourcestextbox')">
                                        <i class="fas fa-font"></i> Text
                                    </button>
                                    <button>
                                        <a class="" href="<?= base_url('company/coordinates') ?>">3D Coordinates</a>
                                    </button>
                                </div>
                                <div class="d-flex align-items-center mb-1 mx-3">
                                    <dt class="small me-2 mb-0">Financial:</dt>
                                    <dd class="mb-0 d-flex flex-wrap gap-1">
                                        <?= $brickNonliving['resources_financial'] ?>
                                    </dd>
                                </div>
                                <div class="d-flex align-items-center mb-1 mx-3">
                                    <dt class="small me-2 mb-0">Type:</dt>
                                    <dd class="mb-0 d-flex flex-wrap gap-1">
                                        <?php
                                        if ($brickNonliving['resources_buyrent'] == 'both') {
                                            echo 'Buy/Rent Both';
                                        } else {
                                            echo ucfirst($brickNonliving['resources_buyrent']);
                                        }

                                        ?>
                                    </dd>
                                </div>
                                <div id="NonLivingpreviewArea" class="mt-3"></div>
                                <div class="col-md-3 mb-3 d-flex flex-column" style="margin-top:0px;">
                                    <form action="<?= base_url('/company/nonliving-bidding') ?>" method="post">
                                        <input type="hidden" class="form-control" placeholder="Company ID" name="company_id" required value="<?= $bricks['company_id'] ?>" />
                                        <input type="hidden" class="form-control" placeholder="Project ID" name="project_id" required value="<?= $bricks['project_id'] ?>" />
                                        <input type="hidden" class="form-control" placeholder="Brick ID" name="brick_id" required value="<?= $bricks['id'] ?>" />
                                        <input type="hidden" class="form-control" placeholder="" name="brick_id" required value="<?= $brickNonliving['id'] ?>" />
                                        <div class="input-groups">
                                            <input type="text" class="form-control" placeholder="Your Work BID" name="bid_amount" required>
                                            <input type="text" class="form-control" placeholder="Your Delivery Time" name="delivery_time" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-center mb-2" style="border-radius: 0.375rem; width: 100%;">
                                            <i class="fa fa-user-plus me-1"></i> Apply for Bidding
                                        </button>
                                    </form>
                                </div>


                            </div>
                        </div>
                </div>

            </div>

            <div class="col-12 outer-box position relative">
                <div class="horizontal-line-inside"></div>
                <div class="d-flex justify-content-center align-items-center">
                    <div class="big-circle position-relative">
                        <div class="quad top-left">1</div>
                        <div class="quad top-right">2</div>
                        <div class="quad bottom-left">4</div>
                        <div class="quad bottom-right">3</div>
                        <div class="vertical-line"></div>
                    </div>
                </div>
            </div>

            <div class="col-6 border-end-right">
                <div class="p-3 h-100">
                    <div class="section-title text-center mb-3">Task Completion Voting</div>

                    <?php
                    $brick_id = $bricks['id'];

                    // 1. Get voting targets (brick_voting table)
                    $getVoting = $this->CommonModal->getSingleRowById('brick_voting', ['brick_id' => $brick_id]);

                    // Define categories
                    $categories = ['investor', 'owner', 'passers', 'executer', 'other'];

                    $results = [];
                    $totalTarget = 0;
                    $totalAchieved = 0;

                    foreach ($categories as $cat) {
                        // 2. Get SUM of votes from tbl_brick_voted for each category
                        $this->db->select_sum('votingrights');
                        $this->db->where('brick_id', $brick_id);
                        $this->db->where('votefor', $cat);
                        $this->db->where('voted', 'Yes');
                        $sumRow = $this->db->get('tbl_brick_voted')->row_array();

                        $totalVotingRights = !empty($sumRow['votingrights']) ? $sumRow['votingrights'] : 0;

                        // 3. Target from brick_voting table
                        $target = !empty($getVoting[$cat]) ? (int)$getVoting[$cat] : 0;

                        // 4. Calculate percentage
                        if ($target > 0) {
                            $calculatedPercent = ($totalVotingRights / $target) * 100;
                        } else {
                            $calculatedPercent = 0;
                        }

                        // If exactly equal, force 100%
                        if ($totalVotingRights == $target) {
                            $calculatedPercent = 100;
                        }

                        // Save results
                        $results[$cat] = [
                            'target' => $target,
                            'achieved' => $totalVotingRights,
                            'percent' => round($calculatedPercent, 2)
                        ];

                        // Add to totals
                        $totalTarget += $target;
                        $totalAchieved += $totalVotingRights;
                    }

                    // ✅ Overall percentage
                    $overallPercent = ($totalTarget > 0) ? round(($totalAchieved / $totalTarget) * 100, 2) : 0;
                    ?>




                    <div class="d-flex justify-content-between text-center mb-2 voting-labels">
                        <div class="voting-box"> Investors
                            <div class="voting-percent"><?= !empty($getVoting['investor']) ? $getVoting['investor'] : 0; ?>%</div>
                        </div>
                        <div class="voting-box"> Owner
                            <div class="voting-percent"><?= !empty($getVoting['owner']) ? $getVoting['owner'] : 0; ?>%</div>
                        </div>
                        <div class="voting-box"> Passers/Marketing
                            <div class="voting-percent"><?= !empty($getVoting['passers']) ? $getVoting['passers'] : 0; ?>%</div>
                        </div>
                        <div class="voting-box"> Executer
                            <div class="voting-percent"><?= !empty($getVoting['executer']) ? $getVoting['executer'] : 0; ?>%</div>
                        </div>
                        <div class="voting-box"> Other
                            <div class="voting-percent"><?= !empty($getVoting['other']) ? $getVoting['other'] : 0; ?>%</div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between text-center mb-2 voting-labels">
                        <?php foreach ($results as $role => $data): ?>
                            <div class="voting-box">
                                <div class="progress custom-progress">
                                    <div class="progress-bar 
                        <?php
                            if ($data['percent'] <= 25) {
                                echo 'progress-bar-low';
                            } else if ($data['percent'] <= 50) {
                                echo 'progress-bar-mid';
                            } else {
                                echo 'progress-bar-high';
                            }
                        ?>"
                                        style="width: <?= $data['percent'] ?>%;">
                                    </div>
                                </div>
                                <div class="voting-percent"><?= $data['percent'] ?>%</div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <div class="text-center">
                        <button type="button" class="text-white" data-bs-toggle="modal" data-bs-target="#openvote" style="background-color:blue; padding:3px 17px; border:none;" id="openvotemodel"> Vote </button>

                        <!-- ✅ Overall Percentage -->
                        <div class="overall-progress mt-3 text-center">
                            <h5>Overall Progress</h5>
                            <div class="progress custom-progress">
                                <div class="progress-bar 
                                    <?php
                                    if ($overallPercent <= 25) {
                                        echo 'progress-bar-low';
                                    } else if ($overallPercent <= 50) {
                                        echo 'progress-bar-mid';
                                    } else {
                                        echo 'progress-bar-high';
                                    }
                                    ?>"
                                    style="width: <?= $overallPercent ?>%;">
                                </div>
                            </div>
                            <div class="voting-percent"><?= $overallPercent ?>%</div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-6">
                <div class="p-3 h-100">
                    <h5 class="fw-bold mb-3 text-center">Task Completion Update</h5>
                    <div class="d-flex justify-content-between align-items-center w-100 mb-3">

                        <?php
                        $getTeamMemberofBrick = $this->CommonModal->getSingleRowById('teamcompanymember', ['brick_id' => $bricks['id'], 'member_id' => sessionId('freelancer_id'), 'channel_id' => null, 'status' => 'Accepted']);
                        $updatetaskcomplete = $this->CommonModal->getSingleRowById('tbl_task_completion_report', ['brick_id' => $bricks['id'], 'user_id' => sessionId('freelancer_id')]);

                        ?>


                        <button <?php if ($bricks['user_id'] ==  sessionId('freelancer_id') || $getTeamMemberofBrick['member_id'] == sessionId('freelancer_id')) { ?> onclick="showPreview('document')" <?php } ?> class="btn <?php if ($updatetaskcomplete['document'] != null) {
                                                                                                                                                                                                                                    echo 'btn-primary';
                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                    echo 'btn-danger';
                                                                                                                                                                                                                                } ?> d-flex align-items-center gap-1">
                            <i class="fas fa-file-alt"></i> Document
                        </button>

                        <button <?php if ($bricks['user_id'] ==  sessionId('freelancer_id') || $getTeamMemberofBrick['member_id'] == sessionId('freelancer_id')) { ?> onclick="showPreview('audio')" <?php } ?> class="btn <?php if ($updatetaskcomplete['audio'] != null) {
                                                                                                                                                                                                                                echo 'btn-primary';
                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                echo 'btn-danger';
                                                                                                                                                                                                                            } ?> d-flex align-items-center gap-1">
                            <i class="fas fa-microphone-alt"></i> Audio
                        </button>

                        <button <?php if ($bricks['user_id'] ==  sessionId('freelancer_id') || $getTeamMemberofBrick['member_id'] == sessionId('freelancer_id')) { ?> onclick="showPreview('video')" <?php } ?> class="btn <?php if ($updatetaskcomplete['video'] != null) {
                                                                                                                                                                                                                                echo 'btn-primary';
                                                                                                                                                                                                                            } else {
                                                                                                                                                                                                                                echo 'btn-danger';
                                                                                                                                                                                                                            } ?> d-flex align-items-center gap-1">
                            <i class="fas fa-video"></i> Video
                        </button>

                        <button <?php if ($bricks['user_id'] ==  sessionId('freelancer_id') || $getTeamMemberofBrick['member_id'] == sessionId('freelancer_id')) { ?> onclick="showPreview('textbox')" <?php } ?> class="btn <?php if ($updatetaskcomplete['textbox'] != null) {
                                                                                                                                                                                                                                    echo 'btn-primary';
                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                    echo 'btn-danger';
                                                                                                                                                                                                                                } ?> d-flex align-items-center gap-1">
                            <i class="fas fa-font"></i> Text Box
                        </button>
                        <!-- <button <//?php if ($bricks['user_id'] ==  sessionId('freelancer_id') || $getTeamMemberofBrick['member_id'] == sessionId('freelancer_id')) { ?> onclick="showPreview('textbox')" <//?php } ?> class="btn btn-warning d-flex align-items-center gap-1">
                           <i class="fas fa-edit"></i> EDIT 
                        </button> -->
                    </div>

                    <?php if ($bricks['user_id'] ==  sessionId('freelancer_id') || $getTeamMemberofBrick['member_id'] == sessionId('freelancer_id')) {
                        echo '';
                    } else {
                        echo '<span class="bg-secondary text-white px-5 py-1"> You are not a Team Member!, So you are not eligible for this </span>';
                    } ?>

                    <?php if ($bricks['user_id'] ==  sessionId('freelancer_id') || $getTeamMemberofBrick['member_id'] == sessionId('freelancer_id')) { ?>
                        <hr>
                        <hr>
                        <div class="d-flex" style=" padding: 10px 0px;">
                            <span class="d-flex gap-1" style="margin-top: 5px;">
                                Added Valuation
                            </span>
                            <span style="margin-top: 5px; margin-left: 5px;"> From <?= generateBrickId($bricks['id']); ?> </span>

                            <form action="<?= base_url('company/addedValuation') ?>" method="post" id="addedvalue" class="d-flex ms-3">
                                <input type="hidden" class="form-control" placeholder="Company ID" name="company_id" required value="<?= $bricks['company_id'] ?>" />
                                <input type="hidden" class="form-control" placeholder="Project ID" name="project_id" required value="<?= $bricks['project_id'] ?>" />
                                <input type="hidden" class="form-control" placeholder="Brick ID" name="brick_id" required value="<?= $bricks['id'] ?>" />
                                <select class="form-select" name="currency" id="currency" style="width:80px;" required>
                                    <option value="INR"> INR </option>
                                    <option value="USD"> USD </option>
                                </select>
                                <input type="number" class="form-control" id="addedvaueinput" name="addedvaluation" placeholder="Enter Value" style="width:150px;" required>
                                <button type="submit" class="btn btn-primary d-flex align-items-center gap-1">
                                    UPDATE
                                </button>
                            </form>
                        </div>
                        <div class="row g-0 p-0 m-0">
                            <div class="col-6"></div>
                            <div class="col-6 p-0 m-0">

                                <?php
                                $getAddedValuation = $this->CommonModal->getSingleRowById('tbl_addedvaluation', ['brick_id' => $bricks['id'], 'user_id' => sessionId('freelancer_id')]);
                                if (isset($getAddedValuation['user_id'])) {
                                ?>
                                    <form action="<?= base_url('/company/preview_brick?id=') . $brick_id; ?>" method="post" class="d-flex" style="margin-left:12px;">
                                        <input type="text" readonly class="form-control" value="<?= $getAddedValuation['currency']; ?>" style="width:80px;" required>
                                        <input type="number" readonly class="form-control" value="<?= $getAddedValuation['addedvaluation']; ?>" style="width:150px;" required>
                                        <button type="submit" class="btn btn-danger d-flex align-items-center" style="width:100px">
                                            Refresh
                                        </button>
                                    </form>

                                <?php } ?>
                            </div>
                        </div>


                    <?php } ?>
                    <div style="border:2px dashed lightgrey; height:4px; width:100%; margin-top:10px;"> </div>
                    <div id="previewArea" class="mt-3"></div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="openvote" tabindex="-1" aria-labelledby="openvoteLevel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content p-3">
                    <div class="modal-header">
                        <h5 class="modal-title" id="openvoteLevel">Vote</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <!-- Updated by @Shiv Web Developr  -->
                    <div class="modal-body">
                        <form action="<?= base_url('/company/brick_voting') ?>" method="post" id="brick_voted">
                            <input type="hidden" class="form-control" placeholder="Brick ID" name="brick_id" required value="<?= $bricks['id'] ?>" />
                            <div class="row">
                                <div class="col-md-8 p-0">
                                    <div style="" class="rounded p-1 h-100">
                                        <div class="row m-md-3">
                                            <dl class="d-flex align-items-center mb-3">
                                                <dt class="small me-2 mb-0">Would You Like to Vote</dt>
                                                <dd class="mb-0 d-flex align-items-center gap-3">
                                                    <div class="form-check mb-0">
                                                        <input class="form-check-input" type="radio" name="voted" id="voteYes" value="Yes">
                                                        <label class="form-check-label" for="voteYes">Yes</label>
                                                    </div>
                                                    <div class="form-check mb-0">
                                                        <input class="form-check-input" type="radio" name="voted" id="voteNo" value="No">
                                                        <label class="form-check-label" for="voteNo">No</label>
                                                    </div>
                                                </dd>
                                            </dl>
                                        </div>
                                        <div class="votingFunctionality d-flex">
                                            <input type="hidden" class="form-control" placeholder="Brick ID" name="brick_id" id="check_brick_id" required value="<?= $bricks['id'] ?>" />
                                            <input type="hidden" class="form-control" placeholder="User ID" name="user_id" id="check_user_id" required value="<?= sessionId('freelancer_id') ?>" />
                                            <select class="form-control" name="votefor" id="votefor" style="width:150px; margin-left:23px;">
                                                <option value="" selected disabled> Select </option>
                                                <option value="investor"> Investor </option>
                                                <option value="owner"> Owner </option>
                                                <option value="passer"> Passer </option>
                                                <option value="executer"> Executer </option>
                                                <option value="other"> Other </option>
                                            </select>
                                            <div style="width:100%; font-size: 12px; margin-left:10px;">
                                                <div id="voteResult"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 justify-content-center d-flex">
                                    <div class="rounded p-3 h-100">
                                        <button style="background: linear-gradient(to right, #4772f3, #4772f3); color: #fff;" class="btn border-0 px-4 rounded-pill apply-brick">
                                            Submit
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Updated by @Shiv Web Developr  -->
                </div>
            </div>
        </div>


        <div class="text-center" style="border-bottom:1px solid grey; padding:10px; display:flex; justify-content:center;">

            <?php if ($bricks['user_id'] == sessionId('freelancer_id')) { ?>
                <form action="<?= base_url('/company/brickMarkasCompleted') ?>" id="markasCompleted">
                    <input type="hidden" value="<?= $bricks['id'] ?>" name="brick_id_markas" id="brick_id_markas" required>
                    <button type="submit" class="btn text-white" style="justify-self: center; background-color:#ff6501; width:200px; margin-right:5px;">Mark as Completed</button>
                </form>
            <?php } ?>



            <!-- // Channel Section Start -->

            <?php
            $getLogUser = $this->CommonModal->getSingleRowById('tbl_freelancer', ['id' => sessionId('freelancer_id')]);
            $getBrickChannelRequests = $this->CommonModal->getSingleRowById('teamcompanymember', ['brick_id' => $bricks['id'], 'created_by' => sessionId('freelancer_id'), 'request_tab_id' => 'channel-request']);
            $getBrickForReqestCheck = $this->CommonModal->getSingleRowById('tbl_bricks', ['id' => $getBrickChannelRequests['brick_id']]);
            $brick_id = $bricks['id'];

            if ($getBrickChannelRequests['status'] == 'Accepted' && $getBrickChannelRequests['brick_id'] == $brick_id && $getBrickChannelRequests['created_by'] == sessionId('freelancer_id')) { ?>

                <div class="bg-primary text-white p-3 rounded mb-3">
                    <h5 class="mb-0">Channel Request Accepted</h5>
                    <p class="mb-0">Your Request has accepted to Create channel on <?= generateBrickId($getBrickChannelRequests['brick_id']) . ' ' . $getBrickForReqestCheck['brick_title']; ?> </p>
                </div>

                <div class="channel-section text-center">
                    <div class="text-center" style="justify-self:center; display:flex;">
                        <input type="hidden" id="brick_id_input" value="<?= $brick_id ?>">
                        <input type="hidden" id="created_by_input" value="<?= sessionId('freelancer_id') ?>">
                        <button class="btn btn-sm btn-primary text-center" data-bs-toggle="modal" id="openCreateChannel" data-bs-target="#createChannel" style="justify-self: center;">Create Channel</button>
                        <button class="btn btn-sm btn-primary text-center mx-2" id="exitingchannel" style="justify-self: center;"> Add to Exiting Channel </button>
                    </div>
                </div>

            <?php } else if ($getBrickChannelRequests['status'] == 'Requested' && $getBrickChannelRequests['brick_id'] == $brick_id && $getBrickChannelRequests['created_by'] == sessionId('freelancer_id')) { ?>
                <div class="bg-secondary text-white p-3 rounded mb-3">
                    <h5 class="mb-0">Channel Request Pending</h5>
                    <p class="mb-0">Your Request has been Pending to Create channel on <?= generateBrickId($getBrickChannelRequests['brick_id']) . ' ' . $getBrickForReqestCheck['brick_title']; ?> </p>
                </div>


            <?php } else if ($getBrickChannelRequests['status'] == 'Rejected' && $getBrickChannelRequests['brick_id'] == $brick_id && $getBrickChannelRequests['created_by'] == sessionId('freelancer_id')) { ?>
                <div class="bg-danger text-white p-3 rounded mb-3">
                    <h5 class="mb-0">Channel Request Rejected</h5>
                    <p class="mb-0">Your Request has been rejected to Create channel on <?= generateBrickId($getBrickChannelRequests['brick_id']) . ' ' . $getBrickForReqestCheck['brick_title']; ?> </p>
                </div>

            <?php
            } else {

                $brickOwner = $this->CommonModal->getSingleRowById('bricks', ['id' => $bricks['id']]);

            ?>

                <div class="chennel-request-send">
                    <form action="<?= base_url('company/send_channel_request') ?>" method="post">
                        <input type="hidden" name="brick_id" value="<?= $bricks['id'] ?>">
                        <input type="hidden" name="user_id" value="<?= $brickOwner['user_id']; ?>">
                        <input type="hidden" name="created_by" value="<?= $getLogUser['id'] ?>">
                        <input type="hidden" name="company_id" value="<?= $bricks['company_id'] ?>">
                        <input type="hidden" name="project_id" value="<?= $bricks['project_id'] ?>">
                        <input type="hidden" name="request_tab_id" value="channel-request">
                        <button type="submit" class="btn btn-primary px-3 py-2" style="justify-self: center; width:200px;">Send Channel Request</button>
                    </form>
                </div>
            <?php
            }
            ?>
        </div>

        <hr />

        <div class="container my-4">
            <div class="marketingbudgetss">
                <h6 class="text-center"> Marketing Budgets </h6>
            </div>
        </div>





        <div class="modal fade" id="createChannel" tabindex="-1" aria-labelledby="createChannel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content p-3">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createChannel">Channel</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12 p-0">
                                <div style="background-color: #eee;" class="rounded p-1 h-100">
                                    <!-- <div class="row m-md-3">
                                    <div class="col-md-12">
                                       <div class="form-group">
                                            <label for="channelName" class="form-label"> How many channals you want to create ? </label>
                                            <input type="number" class="form-control" id="howmanychannel" name="howmanychannel" placeholder="Enter Number" required> 
                                        </div>
                                    </div>
                                    </div> -->
                                    <form action="<?= base_url('/company/create-channel-name') ?>" id="CreateChannelName" method="post">
                                        <div class="chennel-request-send">
                                            <input type="hidden" name="brick_id" value="<?= $bricks['id'] ?>">
                                            <input type="hidden" name="company_id" value="<?= $bricks['company_id'] ?>">
                                            <input type="hidden" name="project_id" value="<?= $bricks['project_id'] ?>">
                                            <input type="hidden" name="created_by" value="<?= $getLogUser['id'] ?>">
                                        </div>
                                        <div class="row">
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="channelName" class="form-label"> Channel </label>
                                                    <select class="form-select" id="channelSelect" name="channel_id" required>
                                                        <option value="" selected>Select Channel Type</option>
                                                        <option value="1">1</option>
                                                        <option value="2">2</option>
                                                        <option value="3">3</option>
                                                        <option value="4">4</option>
                                                        <option value="5">5</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="channelName" class="form-label">Channel Name</label>
                                                    <input type="text" class="form-control" id="channelNameInput" name="channel_name" placeholder="Enter Channel Name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="channel_brick_type" class="form-label"> Brick Type </label>
                                                    <select class="form-select" id="chennel_brick_type" name="chennel_brick_type" required>
                                                        <option value="" selected>Select Type</option>
                                                        <option value="funding-channel">Funding Channel</option>
                                                        <option value="work-allotment-channel">Work Allotment channel</option>
                                                        <option value="consulting-channel">Consulting Cahnnel</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="text-center">
                                                    <button type="submit" class="btn btn-primary mt-4 px-4" style="text-align: center;">Update</button>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <hr />
                                                <div class="form-group">
                                                    <label for="marketingbudget" class="form-label">Marketing Budget </label>
                                                    <input type="number" class="form-control" id="marketingbudgets" name="marketingbudgets" placeholder="Enter" required>
                                                </div>
                                            </div>
                                            <div class="col-md-8 mt-3">
                                                <hr />
                                                <div class="assigned-section">
                                                    <div class="assigned-boxes">
                                                        <div class="pt-3">
                                                            <div class="d-flex justify-content-center align-items-center mb-2">
                                                                <span class="label me-2">Split %</span>
                                                                <select class="form-select me-2" id="mainDropdown" onchange="showSubDropdown()">
                                                                    <!-- <option value="">Select Option</option> -->
                                                                    <option value="decision">Payment</option>
                                                                    <!-- <option value="project">Payment %</option> -->
                                                                </select>
                                                                <select class="form-select me-2" id="subDropdown">
                                                                    <option value="">Select Option</option>
                                                                    <option value="1">Decrease</option>
                                                                    <option value="2">Increase</option>
                                                                    <!-- <option value="3">Layer</option> -->
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </form>
                                    <!-- <form action="<//?= base_url('company/network-marketing-chanel-request') ?>" id="channelRequestFormTesting"  method="post">
                                        <div class="chennel-request-send">
                                            <input type="hidden" name="brick_id" value="<//?= $bricks['id'] ?>">
                                            <input type="hidden" name="company_id" value="<//?= $bricks['company_id'] ?>">
                                            <input type="hidden" name="project_id" value="<//?= $bricks['project_id'] ?>">
                                            <input type="hidden" name="request_tab_id" value="network-marketing-request">
                                        </div>
                                        <div class="row m-md-3">
                                        <div class="col-md-10">
                                            <label for="channelName" class="form-label">Search User</label> <br/>
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="bi bi-search"></i>
                                                </span>
                                                <input class="form-control" id="team-member-input" name='users-list-tags' placeholder='Search user by name' value=''>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                        <div class="text-center">
                                                <button type="submit" class="btn btn-primary mt-4 px-4" style="text-align: center;">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </form> -->

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <?php
                                $getLogUser = $this->CommonModal->getSingleRowById('tbl_freelancer', ['id' => sessionId('freelancer_id')]);
                                $brick_id = $bricks['id'];
                                ?>
                                <div style="font-size:12px;">
                                    UserId: <?= $getLogUser['id'] . ' ' . $getLogUser['name'] ?> <br />
                                    BrickId: <?= generateBrickId($brick_id); ?>
                                </div>
                                <hr>

                                <div class="brickChannelTeamContainer">
                                    <div class="brickChannelTeamHeader">
                                        <div class="chennelNameHeader" id="chennelFirst"> 1. Channel - </div>
                                        <div class="channeltypes" id="chenneltypeFirst"> Type - </div>
                                    </div>
                                    <div class="brickChannelTeamBodyContainer">
                                        <?php
                                        $brick_id = $bricks['id'];
                                        $getChannelName = $this->CommonModal->getRowByMoreId('brick_pass_channel', ['brick_id' => $brick_id]);
                                        $getChannelUserProfile = $this->CommonModal->getRowsbyIdForTeam('teamcompanymember', ['brick_id' => $brick_id, 'status' => 'Accepted', 'created_by' => sessionId('freelancer_id'), 'request_tab_id' => 'network-marketing-request'], 'id', 'ASC');

                                        if (!empty($getChannelName)):
                                            foreach ($getChannelName as $getChannel):
                                                if ($getChannel['channel_id'] == '1' && $getChannel['created_by'] == sessionId('freelancer_id')) {
                                                    $createdByUserDetails = $this->CommonModal->getSingleRowById('freelancer', ['id' => $getChannel['created_by']]);

                                        ?>
                                                    <div class="MainUser">
                                                        <a href="<?= base_url('/company/profile_preview?id=') . $createdByUserDetails['id'] ?>" target="_blank">
                                                            <img src="<?= base_url('uploads/user_profile/' . $createdByUserDetails['user_image'] ?? 'assets/images/img/user.png') ?>" alt="profile_av" class="img-fluid rounded-circle" style="width: 50px; height: 50px; margin-right: 5px;">
                                                        </a>
                                                    </div>

                                        <?php
                                                };
                                            endforeach;
                                        endif;
                                        ?>

                                        <div class="BrickChannelTeamListContainer" style="position:relative;">
                                            <?php

                                            $shownMembers = [];
                                            if (!empty($getChannelUserProfile)):
                                                foreach ($getChannelUserProfile as $teamProfile):
                                                    if ($teamProfile['channel_id'] == '1' && !in_array($teamProfile['member_id'], $shownMembers)) {

                                                        // Mark this member as shown
                                                        $shownMembers[] = $teamProfile['member_id'];
                                                        $channelTeamUserDetails = $this->CommonModal->getSingleRowById('freelancer', ['id' => $teamProfile['member_id']]);
                                            ?>
                                                        <div class="BrickChannelTeamList">
                                                            <a href="<?= base_url('/company/profile_preview?id=') . $channelTeamUserDetails['id'] ?>" target="_blank">
                                                                <img src="<?= base_url('uploads/user_profile/' . $channelTeamUserDetails['user_image'] ?? 'assets/images/img/user.png') ?>" alt="profile_av" class="img-fluid rounded-circle" style="width: 50px; height: 50px; margin-right: 5px;">
                                                            </a>
                                                        </div>

                                            <?php
                                                    };
                                                endforeach;
                                            endif;
                                            ?>

                                            <div class="BrickChannelProgresbar"> </div>
                                            <div class="AddTeamMember" id="openAddNewUser"> + </div>
                                            <?php
                                            $chennelId = $this->CommonModal->getSingleRowById('brick_pass_channel', ['brick_id' => $brick_id, 'channel_id' => '1', 'created_by' => sessionId('freelancer_id')]);
                                            if (!empty($chennelId)):
                                            ?>
                                                <div class="AddTeamMemberShare"> <a href="<?= base_url('/company/channel-sharing?chid=') . $chennelId['id'] ?>" class="text-white copy-link" data-link="<?= base_url('/company/channel-sharing?chid=') . $chennelId['id'] ?>"> Share </a> </div>
                                            <?php endif; ?>
                                            <!-- Copy Popup -->
                                            <span id="copyPopup" style="display:none; position:fixed; top:10px; right:45%; background:#e0e4e0; font-size:16px; color:black; padding:10px 10px; height:45px; border-radius:0px; z-index:9999;">
                                                Channel Details Copied!
                                            </span>
                                        </div>

                                    </div>

                                    <!-- Add New User in Channel and Send Requesst for Inviting -->
                                    <div class="BrickChannelTeamAddNewUser" id="addNewUserForm" style="display: none;">
                                        <form action="<?= base_url('company/network-marketing-chanel-request') ?>" id="channelRequestForm" method="post">
                                            <div class="chennel-request-send">
                                                <input type="hidden" name="brick_id" value="<?= $bricks['id'] ?>">
                                                <input type="hidden" name="company_id" value="<?= $bricks['company_id'] ?>">
                                                <input type="hidden" name="project_id" value="<?= $bricks['project_id'] ?>">
                                                <input type="hidden" name="created_by" value="<?= $getLogUser['id'] ?>">
                                                <input type="hidden" id="ChannelFirstId" name="channel_id" value="">
                                                <input type="hidden" id="chidFirstId" name="chid" value="">
                                            </div>
                                            <div class="row m-md-3">
                                                <div class="col-md-10">
                                                    <label for="channelName" class="form-label">Search User</label> <br />
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-search"></i>
                                                        </span>
                                                        <input class="form-control" id="team-member-input" name='users-list-tags' placeholder='Search user by name' value='' required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-primary mt-4 px-4" style="text-align: center;">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>


                                </div>
                                <!-- Second Channel -->
                                <div class="brickChannelTeamContainer">
                                    <div class="brickChannelTeamHeader">
                                        <div class="chennelNameHeader" id="chennelSecond"> 2. Channel - </div>
                                        <div class="channeltypes" id="chenneltypeSecond"> Type - </div>
                                    </div>
                                    <div class="brickChannelTeamBodyContainer">
                                        <?php
                                        if (!empty($getChannelName)):
                                            foreach ($getChannelName as $getChannel):
                                                if ($getChannel['channel_id'] == '2' && $getChannel['created_by'] == $getChannel['created_by']) {
                                                    $createdByUserDetails = $this->CommonModal->getSingleRowById('freelancer', ['id' => $getChannel['created_by']]);
                                        ?>
                                                    <div class="MainUser">
                                                        <a href="<?= base_url('/company/profile_preview?id=') . $createdByUserDetails['id'] ?>" target="_blank">
                                                            <img src="<?= base_url('uploads/user_profile/' . $createdByUserDetails['user_image'] ?? 'assets/images/img/user.png') ?>" alt="profile_av" class="img-fluid rounded-circle" style="width: 50px; height: 50px; margin-right: 5px;">
                                                        </a>
                                                    </div>

                                        <?php
                                                };
                                            endforeach;
                                        endif;
                                        ?>
                                        <div class="BrickChannelTeamListContainer">
                                            <?php
                                            $shownMembers = [];
                                            if (!empty($getChannelUserProfile)):
                                                foreach ($getChannelUserProfile as $teamProfile):
                                                    if ($teamProfile['channel_id'] == '2' && !in_array($teamProfile['member_id'], $shownMembers)) {
                                                        // Mark this member as shown
                                                        $shownMembers[] = $teamProfile['member_id'];
                                                        $channelTeamUserDetails = $this->CommonModal->getSingleRowById('freelancer', ['id' => $teamProfile['member_id']]);
                                            ?>
                                                        <div class="BrickChannelTeamList">
                                                            <a href="<?= base_url('/company/profile_preview?id=') . $channelTeamUserDetails['id'] ?>" target="_blank">
                                                                <img src="<?= base_url('uploads/user_profile/' . $channelTeamUserDetails['user_image'] ?? 'assets/images/img/user.png') ?>" alt="profile_av" class="img-fluid rounded-circle" style="width: 50px; height: 50px; margin-right: 5px;">
                                                            </a>
                                                        </div>
                                            <?php
                                                    };
                                                endforeach;
                                            endif;
                                            ?>

                                            <div class="BrickChannelProgresbar"> </div>
                                            <div class="AddTeamMember" id="openAddNewUser2"> + </div>
                                            <?php
                                            $chennelId = $this->CommonModal->getSingleRowById('brick_pass_channel', ['brick_id' => $brick_id, 'channel_id' => '2', 'created_by' => sessionId('freelancer_id')]);
                                            if (!empty($chennelId)):
                                            ?>
                                                <div class="AddTeamMemberShare"> <a href="<?= base_url('/company/channel-sharing?chid=') . $chennelId['id'] ?>" class="text-white copy-link" data-link="<?= base_url('/company/channel-sharing?chid=') . $chennelId['id'] ?>"> Share </a> </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Add New User in Channel and Send Requesst for Inviting -->
                                    <div class="BrickChannelTeamAddNewUser" id="addNewUserForm2" style="display: none;">
                                        <form action="<?= base_url('company/network-marketing-chanel-request') ?>" id="channelRequestForm2" method="post">
                                            <div class="chennel-request-send">
                                                <input type="hidden" name="brick_id" value="<?= $bricks['id'] ?>">
                                                <input type="hidden" name="company_id" value="<?= $bricks['company_id'] ?>">
                                                <input type="hidden" name="project_id" value="<?= $bricks['project_id'] ?>">
                                                <input type="hidden" name="created_by" value="<?= $getLogUser['id'] ?>">
                                                <input type="hidden" id="ChannelSecondId" name="channel_id" value="">
                                                <input type="hidden" id="chidSecondId" name="chid" value="">
                                            </div>
                                            <div class="row m-md-3">
                                                <div class="col-md-10">
                                                    <label for="channelName" class="form-label">Search User</label> <br />
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-search"></i>
                                                        </span>
                                                        <input class="form-control" id="team-member-input2" name='users-list-tags' placeholder='Search user by name' value='' required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-primary mt-4 px-4" style="text-align: center;">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                                <!-- Third Channel  -->
                                <div class="brickChannelTeamContainer">
                                    <div class="brickChannelTeamHeader">
                                        <div class="chennelNameHeader" id="chennelThird"> 3. Channel - </div>
                                        <div class="channeltypes" id="chenneltypeThird"> Type - </div>
                                    </div>
                                    <div class="brickChannelTeamBodyContainer">
                                        <?php
                                        if (!empty($getChannelName)):
                                            foreach ($getChannelName as $getChannel):
                                                if ($getChannel['channel_id'] == '3' && $getChannel['created_by'] == $getChannel['created_by']) {
                                                    $createdByUserDetails = $this->CommonModal->getSingleRowById('freelancer', ['id' => $getChannel['created_by']]);
                                        ?>
                                                    <div class="MainUser">
                                                        <a href="<?= base_url('/company/profile_preview?id=') . $createdByUserDetails['id'] ?>" target="_blank">
                                                            <img src="<?= base_url('uploads/user_profile/' . $createdByUserDetails['user_image'] ?? 'assets/images/img/user.png') ?>" alt="profile_av" class="img-fluid rounded-circle" style="width: 50px; height: 50px; margin-right: 5px;">
                                                        </a>
                                                    </div>

                                        <?php
                                                };
                                            endforeach;
                                        endif;
                                        ?>
                                        <div class="BrickChannelTeamListContainer">
                                            <?php
                                            $shownMembers = [];
                                            if (!empty($getChannelUserProfile)):
                                                foreach ($getChannelUserProfile as $teamProfile):
                                                    if ($teamProfile['channel_id'] == '3' && !in_array($teamProfile['member_id'], $shownMembers)) {
                                                        // Mark this member as shown
                                                        $shownMembers[] = $teamProfile['member_id'];
                                                        $channelTeamUserDetails = $this->CommonModal->getSingleRowById('freelancer', ['id' => $teamProfile['member_id']]);
                                            ?>
                                                        <div class="BrickChannelTeamList">
                                                            <a href="<?= base_url('/company/profile_preview?id=') . $channelTeamUserDetails['id'] ?>" target="_blank">
                                                                <img src="<?= base_url('uploads/user_profile/' . $channelTeamUserDetails['user_image'] ?? 'assets/images/img/user.png') ?>" alt="profile_av" class="img-fluid rounded-circle" style="width: 50px; height: 50px; margin-right: 5px;">
                                                            </a>
                                                        </div>
                                            <?php
                                                    };
                                                endforeach;
                                            endif;
                                            ?>
                                            <div class="BrickChannelProgresbar"> </div>
                                            <div class="AddTeamMember" id="openAddNewUser3"> + </div>
                                            <?php
                                            $chennelId = $this->CommonModal->getSingleRowById('brick_pass_channel', ['brick_id' => $brick_id, 'channel_id' => '3', 'created_by' => sessionId('freelancer_id')]);
                                            if (!empty($chennelId)):
                                            ?>
                                                <div class="AddTeamMemberShare"> <a href="<?= base_url('/company/channel-sharing?chid=') . $chennelId['id'] ?>" class="text-white"> Share </a> </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Add New User in Channel and Send Requesst for Inviting -->
                                    <div class="BrickChannelTeamAddNewUser" id="addNewUserForm3" style="display: none;">
                                        <form action="<?= base_url('company/network-marketing-chanel-request') ?>" id="channelRequestForm3" method="post">
                                            <div class="chennel-request-send">
                                                <input type="hidden" name="brick_id" value="<?= $bricks['id'] ?>">
                                                <input type="hidden" name="company_id" value="<?= $bricks['company_id'] ?>">
                                                <input type="hidden" name="project_id" value="<?= $bricks['project_id'] ?>">
                                                <input type="hidden" name="created_by" value="<?= $getLogUser['id'] ?>">
                                                <input type="hidden" id="ChannelThirdId" name="channel_id" value="">
                                                <input type="hidden" id="chidThirdId" name="chid" value="">
                                            </div>
                                            <div class="row m-md-3">
                                                <div class="col-md-10">
                                                    <label for="channelName" class="form-label">Search User</label> <br />
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-search"></i>
                                                        </span>
                                                        <input class="form-control" id="team-member-input" name='users-list-tags' placeholder='Search user by name' value='' required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-primary mt-4 px-4" style="text-align: center;">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- Fourth Channel  -->
                                <div class="brickChannelTeamContainer">
                                    <div class="brickChannelTeamHeader">
                                        <div class="chennelNameHeader" id="chennelFourth"> 4. Channel - </div>
                                        <div class="channeltypes" id="chenneltypeFourth"> Type - </div>
                                    </div>
                                    <div class="brickChannelTeamBodyContainer">
                                        <?php
                                        if (!empty($getChannelName)):
                                            foreach ($getChannelName as $getChannel):
                                                if ($getChannel['channel_id'] == '4' && $getChannel['created_by'] == $getChannel['created_by']) {
                                                    $createdByUserDetails = $this->CommonModal->getSingleRowById('freelancer', ['id' => $getChannel['created_by']]);
                                        ?>
                                                    <div class="MainUser">
                                                        <a href="<?= base_url('/company/profile_preview?id=') . $createdByUserDetails['id'] ?>" target="_blank">
                                                            <img src="<?= base_url('uploads/user_profile/' . $createdByUserDetails['user_image'] ?? 'assets/images/img/user.png') ?>" alt="profile_av" class="img-fluid rounded-circle" style="width: 50px; height: 50px; margin-right: 5px;">
                                                        </a>
                                                    </div>

                                        <?php
                                                };
                                            endforeach;
                                        endif;
                                        ?>

                                        <div class="BrickChannelTeamListContainer">
                                            <?php
                                            $shownMembers = [];
                                            if (!empty($getChannelUserProfile)):
                                                foreach ($getChannelUserProfile as $teamProfile):
                                                    if ($teamProfile['channel_id'] == '4' && !in_array($teamProfile['member_id'], $shownMembers)) {
                                                        // Mark this member as shown
                                                        $shownMembers[] = $teamProfile['member_id'];
                                                        $channelTeamUserDetails = $this->CommonModal->getSingleRowById('freelancer', ['id' => $teamProfile['member_id']]);
                                            ?>
                                                        <div class="BrickChannelTeamList">
                                                            <a href="<?= base_url('/company/profile_preview?id=') . $channelTeamUserDetails['id'] ?>" target="_blank">
                                                                <img src="<?= base_url('uploads/user_profile/' . $channelTeamUserDetails['user_image'] ?? 'assets/images/img/user.png') ?>" alt="profile_av" class="img-fluid rounded-circle" style="width: 50px; height: 50px; margin-right: 5px;">
                                                            </a>
                                                        </div>
                                            <?php
                                                    };
                                                endforeach;
                                            endif;
                                            ?>

                                            <div class="BrickChannelProgresbar"> </div>
                                            <div class="AddTeamMember" id="openAddNewUser4"> + </div>
                                            <?php
                                            $chennelId = $this->CommonModal->getSingleRowById('brick_pass_channel', ['brick_id' => $brick_id, 'channel_id' => '4', 'created_by' => sessionId('freelancer_id')]);
                                            if (!empty($chennelId)):
                                            ?>
                                                <div class="AddTeamMemberShare"> <a href="<?= base_url('/company/channel-sharing?chid=') . $chennelId['id'] ?>" class="text-white"> Share </a> </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <!-- Add New User in Channel and Send Requesst for Inviting -->
                                    <div class="BrickChannelTeamAddNewUser" id="addNewUserForm4" style="display: none;">
                                        <form action="<?= base_url('company/network-marketing-chanel-request') ?>" id="channelRequestForm4" method="post">
                                            <div class="chennel-request-send">
                                                <input type="hidden" name="brick_id" value="<?= $bricks['id'] ?>">
                                                <input type="hidden" name="company_id" value="<?= $bricks['company_id'] ?>">
                                                <input type="hidden" name="project_id" value="<?= $bricks['project_id'] ?>">
                                                <input type="hidden" name="created_by" value="<?= $getLogUser['id'] ?>">
                                                <input type="hidden" id="ChannelFourthId" name="channel_id" value="">
                                                <input type="hidden" id="chidFourthId" name="chid" value="">
                                            </div>
                                            <div class="row m-md-3">
                                                <div class="col-md-10">
                                                    <label for="channelName" class="form-label">Search User</label> <br />
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-search"></i>
                                                        </span>
                                                        <input class="form-control" id="team-member-input" name='users-list-tags' placeholder='Search user by name' value='' required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-primary mt-4 px-4" style="text-align: center;">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                                <!-- Fifth Channel -->
                                <div class="brickChannelTeamContainer">
                                    <div class="brickChannelTeamHeader">
                                        <div class="chennelNameHeader" id="chennelFifth"> 5. Channel - </div>
                                        <div class="channeltypes" id="chenneltypeFifth"> Type - </div>
                                    </div>
                                    <div class="brickChannelTeamBodyContainer">
                                        <?php
                                        if (!empty($getChannelName)):
                                            foreach ($getChannelName as $getChannel):
                                                if ($getChannel['channel_id'] == '5' && $getChannel['created_by'] == $getChannel['created_by']) {
                                                    $createdByUserDetails = $this->CommonModal->getSingleRowById('freelancer', ['id' => $getChannel['created_by']]);
                                        ?>
                                                    <div class="MainUser">
                                                        <a href="<?= base_url('/company/profile_preview?id=') . $createdByUserDetails['id'] ?>" target="_blank">
                                                            <img src="<?= base_url('uploads/user_profile/' . $createdByUserDetails['user_image'] ?? 'assets/images/img/user.png') ?>" alt="profile_av" class="img-fluid rounded-circle" style="width: 50px; height: 50px; margin-right: 5px;">
                                                        </a>
                                                    </div>

                                        <?php
                                                };
                                            endforeach;
                                        endif;
                                        ?>


                                        <div class="BrickChannelTeamListContainer">
                                            <?php
                                            $shownMembers = [];
                                            if (!empty($getChannelUserProfile)):
                                                foreach ($getChannelUserProfile as $teamProfile):
                                                    if ($teamProfile['channel_id'] == '5' && !in_array($teamProfile['member_id'], $shownMembers)) {
                                                        // Mark this member as shown
                                                        $shownMembers[] = $teamProfile['member_id'];
                                                        $channelTeamUserDetails = $this->CommonModal->getSingleRowById('freelancer', ['id' => $teamProfile['member_id']]);
                                            ?>
                                                        <div class="BrickChannelTeamList">
                                                            <a href="<?= base_url('/company/profile_preview?id=') . $channelTeamUserDetails['id'] ?>" target="_blank">
                                                                <img src="<?= base_url('uploads/user_profile/' . $channelTeamUserDetails['user_image'] ?? 'assets/images/img/user.png') ?>" alt="profile_av" class="img-fluid rounded-circle" style="width: 50px; height: 50px; margin-right: 5px;">
                                                            </a>
                                                        </div>
                                            <?php
                                                    };
                                                endforeach;
                                            endif;
                                            ?>

                                            <div class="BrickChannelProgresbar"> </div>
                                            <div class="AddTeamMember" id="openAddNewUser5"> + </div>
                                            <?php
                                            $chennelId = $this->CommonModal->getSingleRowById('brick_pass_channel', ['brick_id' => $brick_id, 'channel_id' => '5', 'created_by' => sessionId('freelancer_id')]);
                                            if (!empty($chennelId)):
                                            ?>
                                                <div class="AddTeamMemberShare"> <a href="<?= base_url('/company/channel-sharing?chid=') . $chennelId['id'] ?>" class="text-white"> Share </a> </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>


                                    <!-- Add New User in Channel and Send Requesst for Inviting -->
                                    <div class="BrickChannelTeamAddNewUser" id="addNewUserForm5" style="display: none;">
                                        <form action="<?= base_url('company/network-marketing-chanel-request') ?>" id="channelRequestForm5" method="post">
                                            <div class="chennel-request-send">
                                                <input type="hidden" name="brick_id" value="<?= $bricks['id'] ?>">
                                                <input type="hidden" name="company_id" value="<?= $bricks['company_id'] ?>">
                                                <input type="hidden" name="project_id" value="<?= $bricks['project_id'] ?>">
                                                <input type="hidden" name="created_by" value="<?= $getLogUser['id'] ?>">
                                                <input type="hidden" id="ChannelFifthId" name="channel_id" value="">
                                                <input type="hidden" id="chidFifthId" name="chid" value="">
                                            </div>
                                            <div class="row m-md-3">
                                                <div class="col-md-10">
                                                    <label for="channelName" class="form-label">Search User</label> <br />
                                                    <div class="input-group">
                                                        <span class="input-group-text">
                                                            <i class="bi bi-search"></i>
                                                        </span>
                                                        <input class="form-control" id="team-member-input" name='users-list-tags' placeholder='Search user by name' value='' required>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="text-center">
                                                        <button type="submit" class="btn btn-primary mt-4 px-4" style="text-align: center;">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary">Create</button>
                    </div>
                </div>
            </div>
        </div>


        <style>
            .BrickChannelTeamAddNewUser {
                border: 1px solid grey;
                padding: 5px;
            }

            .userchain-text {
                display: flex;
                align-items: center;
                font-weight: bold;
            }

            .userchain-text span {
                display: flex;
                align-items: center;
                gap: 2px;
                flex-wrap: wrap;
            }

            .user-img {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                object-fit: cover;
                border: 2px solid #fff;
                box-shadow: 0 0 0 1px #ccc;
            }

            .more-btn {
                background-color: #f0f0f0;
                border: none;
                padding: 4px 10px;
                border-radius: 15px;
                cursor: pointer;
                font-size: 12px;
            }


            .user-chain-container {
                width: 100%;
                overflow-x: auto;
                padding: 20px;
                background: #f9f9f9;
                border-radius: 10px;
                border: 1px solid #ddd;
            }

            .user-chain-line {
                display: flex;
                align-items: center;
                position: relative;
                padding: 20px 0;
            }

            .user-chain-line::before {
                content: "";
                position: absolute;
                top: 50%;
                left: 0;
                height: 4px;
                background-color: #ccc;
                width: 100%;
                z-index: 0;
                transform: translateY(-50%);
            }

            .user-block {
                position: relative;
                z-index: 1;
                background: #fff;
                border: 3px solid #ddd;
                border-radius: 50%;
                width: 80px;
                height: 80px;
                margin: 0 20px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                text-align: center;
                font-size: 12px;
                box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
                overflow: hidden;
            }

            .user-block img {
                width: 100%;
                height: 100%;
                border-radius: 50%;
                object-fit: cover;
            }

            .user-block span {
                position: absolute;
                bottom: -20px;
                white-space: nowrap;
            }

            .user-block.add-user {
                background-color: #e0f7fa;
                border: 2px dashed #00796b;
                color: #00796b;
                font-size: 30px;
            }

            .user-block.add-user button {
                background: none;
                border: none;
                color: #00796b;
                font-size: 40px;
                cursor: pointer;
                width: 100%;
                height: 100%;
            }
        </style>

        <!-- // Channel Section End -->

        <style>
            .brickChannelTeamContainer {
                padding: 5px;
            }

            .brickChannelTeamContainer .brickChannelTeamHeader .chennelNameHeader {
                font-size: 16px;
                font-weight: 700;
                color: green;
            }

            .brickChannelTeamContainer .brickChannelTeamBodyContainer {
                display: flex;
                margin-top: 10px;
            }

            .brickChannelTeamContainer .brickChannelTeamBodyContainer .MainUser {
                border-right: 2px solid #070808;
                padding: 5px;
            }

            .brickChannelTeamContainer .brickChannelTeamBodyContainer .BrickChannelTeamListContainer {
                display: flex;
                flex: 1;
                overflow-x: auto;
                padding-left: 10px;
                position: relative;
                overflow-x: scroll;
                padding: 5px;
            }

            /* width */
            .brickChannelTeamContainer .brickChannelTeamBodyContainer .BrickChannelTeamListContainer::-webkit-scrollbar {
                width: 2px;
                height: 2px;
            }

            /* Track */
            .brickChannelTeamContainer .brickChannelTeamBodyContainer .BrickChannelTeamListContainer::-webkit-scrollbar-track {
                background: #f1f1f1;
            }

            /* Handle */
            .brickChannelTeamContainer .brickChannelTeamBodyContainer .BrickChannelTeamListContainer::-webkit-scrollbar-thumb {
                background: #888;
            }

            /* Handle on hover */
            .brickChannelTeamContainer .brickChannelTeamBodyContainer .BrickChannelTeamListContainer::-webkit-scrollbar-thumb:hover {
                background: #555;
            }

            .brickChannelTeamContainer .brickChannelTeamBodyContainer .BrickChannelProgresbar {
                height: 1px;
                background-color: black;
                width: 100%;
                align-self: center;
                z-index: 1;
                position: absolute;
                left: 0px;
            }

            .brickChannelTeamContainer .brickChannelTeamBodyContainer .BrickChannelTeamList {
                /* position:absolute; */
                z-index: 2;
                margin: 0px 5px;
            }

            .brickChannelTeamContainer .brickChannelTeamBodyContainer .AddTeamMember {
                z-index: 2;
                font-size: 28px;
                font-weight: 700;
                color: white;
                background-color: #00b8d6;
                border-radius: 100%;
                height: 30px;
                width: 30px;
                margin-top: 10px;
                line-height: 1;
                text-align: center;
                cursor: pointer;

            }

            .brickChannelTeamContainer .AddTeamMemberShare {
                position: absolute;
                right: 0px;
                background-color: #00b8d6;
                color: white;
                padding: 10px;
                z-index: 2;
            }
        </style>





        <!-- <div class="brick-layout">
            <div class="brick-node">
                <div class="brick-circle">
                    <div class="brick-status-dot"></div>
                </div>
                <div class="brick-label">L1 - T1</div>
            </div>

            <div class="brick-connector"></div>

            <div class="brick-node">
                <div class="brick-circle">
                    <div class="brick-status-dot"></div>
                </div>
                <div class="brick-label">L1 - T2</div>
            </div>

            <div class="brick-connector"></div>

            <div class="brick-node">
                <div class="brick-circle">
                    <div class="brick-status-dot"></div>
                </div>
                <div class="brick-label">L1 - T3</div>
            </div>

            <div class="brick-connector"></div>

            <div class="brick-node">
                <div class="brick-circle">
                    <div class="brick-status-dot"></div>
                </div>
                <div class="brick-label">L1 - T4</div>
            </div>
        </div> -->



    </div>
</div>


<div class="modal fade" id="fundModal" tabindex="-1" aria-labelledby="fundModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h5 class="modal-title" id="fundModalLabel">How much you want to fund?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <!-- Updated by @Shiv Web Developr  -->
            <div class="modal-body">
                <form action="<?= base_url('/company/fund_request_for_brick') ?>" method="post">
                    <input type="hidden" class="form-control" placeholder="Company ID" name="company_id" required value="<?= $bricks['company_id'] ?>" />
                    <input type="hidden" class="form-control" placeholder="Project ID" name="project_id" required value="<?= $bricks['project_id'] ?>" />
                    <input type="hidden" class="form-control" placeholder="Brick ID" name="brick_id" required value="<?= $bricks['id'] ?>" />

                    <div class="row">
                        <div class="col-md-7 p-0">
                            <div style="background-color: #eee;" class="rounded p-1 h-100">
                                <div class="row m-md-3">
                                    <div class="col-md-6">
                                        <label class="form-label">Amount</label>
                                        <div class="input-group">
                                            <span class="input-group-text">₹</span>
                                            <input type="number" class="form-control" placeholder="Enter amount" name="fund_amount" required id="amount" />
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-md-4">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="%" id="percentage" name="fund_percentage" required />
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-5 justify-content-center d-flex">
                            <div style="background-color: #eee;" class="rounded p-3 h-100">
                                <button style="background: linear-gradient(to right, #4772f3, #4772f3); color: #fff;" class="btn border-0 px-4 rounded-pill apply-brick">
                                    Apply for this Task
                                </button>
                                <p class="mb-1"><strong>Unique ID:</strong> <?= generateBrickId($bricks['id']) ?></p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- Updated by @Shiv Web Developr  -->
        </div>
    </div>
</div>

<script>
    const amountInput = document.getElementById("amount");
    const percentageInput = document.getElementById("percentage");
    const totalSpan = document.getElementById("total_amount");

    // Helper: Get numeric value from span (remove currency symbols, etc.)
    function getTotalAmount() {
        return parseFloat(totalSpan.innerText.replace(/[^0-9.]/g, '')) || 0;
    }

    // When user types percentage → calculate amount
    percentageInput.addEventListener("input", function() {
        const percent = parseFloat(this.value);
        const total = getTotalAmount();

        if (!isNaN(percent) && total > 0) {
            const amount = (percent / 100) * total;
            amountInput.value = amount.toFixed(2);
        }
    });

    // When user types amount → calculate percentage
    amountInput.addEventListener("input", function() {
        const amount = parseFloat(this.value);
        const total = getTotalAmount();

        if (!isNaN(amount) && total > 0) {
            const percent = (amount / total) * 100;
            percentageInput.value = percent.toFixed(2);
        }
    });
</script>
<!-- Shiv Web Developer -->
<div class="modal fade" id="taskDescModal" tabindex="-1" aria-labelledby="taskDescModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h5 class="modal-title" id="taskDescModalLabel">Task Description</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 p-0">
                        <div style="background-color: #eee;" class="rounded p-1 h-100">
                            <form>
                                <div class="row m-md-3">
                                    <div class="col-md-12">
                                        <div><?= nl2br(htmlspecialchars($bricks['brick_description'])); ?></div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="rounded p-1 h-100">
                            <form>
                                <div class="row m-md-3">
                                    <?php if ($bricks['taskvideo']) { ?>
                                        <div class="col-md-6">
                                            <div class="ratio ratio-16x9">
                                                <iframe src="<?= $bricks['taskvideo']; ?>" title="YouTube video" allowfullscreen></iframe>
                                            </div>
                                        </div>
                                    <?php } else {
                                        echo '<p>Video Not Upload</p>';
                                    } ?>
                                    <?php if ($bricks['taskdocument']) { ?>
                                        <div class="col-md-6">
                                            <div class="ratio ratio-4x3" style="cursor:pointer;" id="docThumb" data-doc="<?= $bricks['taskdocument']; ?>">
                                                <iframe src="<?= $bricks['taskdocument']; ?>" frameborder="0" style="object-fit: cover;"></iframe>
                                            </div>
                                        </div>
                                    <?php } else {
                                        echo '<p>Document Not Upload</p>';
                                    } ?>
                                    <?php if ($bricks['taskaudio']) { ?>
                                        <div class="col-md-6 my-3">
                                            <div class="ratio ratio-4x3" style="cursor:pointer;" id="docThumb" data-doc="<?= $bricks['taskaudio']; ?>">
                                                <audio controls style="width:100%; height:50px; object-fit:cover;">
                                                    <source src="<?= $bricks['taskaudio']; ?>" type="audio/mpeg">
                                                    Your browser does not support the audio element.
                                                </audio>
                                            </div>
                                        </div>
                                    <?php } else {
                                        echo '<p>Audio Not Upload</p>';
                                    } ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- <div class="modal-footer">
                <button type="button" class="btn btn-primary">Submit Fund</button>
            </div> -->
        </div>
    </div>
    <!-- Team Members Modal -->

</div>

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
</style>

<div class="modal fade team-members-modal" id="teamMembersModal" tabindex="-1" aria-labelledby="teamMembersModalLabel" aria-hidden="true" style="width: 100%;">
    <div class="modal-dialog modal-xl" style="width:100%">
        <div class="modal-content" style="width:100%">
            <div class="modal-header">
                <h5 class="modal-title" id="teamMembersModalLabel">Team Members</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="team-members-wrapper">
                    <?php if ($bricks['user_id'] == sessionId('freelancer_id')) { ?>
                        <div class="viewpermissiontocompanyteam">
                            <!-- Question 1 -->
                            <div>
                                <form id="permissionForm" method="post">
                                    <dl class="d-flex align-items-center" id="questionBox1">
                                        <dt class="small me-2 mb-0">You want Company Members to be part of this brick ?</dt>
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
                                </form>
                                <div id="conditionalForm1" style="display:none;">
                                    <!-- Your extra form/fields for Q1 -->
                                    <!-- <input type="text" placeholder="Company Members Form Field"> -->
                                </div>
                            </div>

                            <!-- Question 2 -->
                            <div>
                                <form id="project_permission" method="post">
                                    <dl class="d-flex align-items-center" id="questionBox2">
                                        <dt class="small me-2 mb-0">You want Project Members to be part of this brick ?</dt>
                                        <dd class="mb-0 d-flex align-items-center gap-3">
                                            <label class="switch me-2">
                                                <input type="checkbox" class="enableSwitch" data-index="2" value="yes" id="checkyes2" name="checkyes">
                                                <span class="slider round"></span>
                                            </label>
                                            <span class="enableDisableLabel" data-index="2">No</span>
                                        </dd>
                                        <input type="hidden" value="<?= $brick_id ?>" id="permission_brick_id2" required>
                                        <input type="hidden" value="<?= $bricks['project_id'] ?>" id="permission_project_id2" required>
                                        <select class="form-select" style="width:200px; margin-left:65px;" name="permission" id="selectedval2" required>
                                            <option value="" selected disabled> Permission </option>
                                            <option value="1"> Viewer </option>
                                            <option value="2"> Editor </option>
                                            <option value="3"> Comments </option>
                                        </select>
                                        <button type="submit" class="btn btn-primary" id="companyPermission"> Update </button>
                                    </dl>
                                </form>
                                <div class="mb-2">
                                    <a href="<?= base_url('company/create-team') ?>" class="btn btn-primary w-auto d-inline-block">Add Team Members</a>
                                </div>
                                <div id="conditionalForm2" style="display:none;">
                                    <!-- Your extra form/fields for Q2 -->
                                    <!-- <input type="text" placeholder="Project Members Form Field"> -->
                                </div>
                            </div>

                        </div>
                    <?php } ?>


                    <div class="d-flex align-items-center mb-3">
                        <h5 class="me-3 mb-0">Team Members</h5>
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
                    </div>


                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="view-1d">
                            <div class="categoryUser" style="justify-content:space-around; display:flex;">
                                <div class="my-1 p-2" style="border-right:1px solid black; width: 30%;"><strong> Investors </strong> <br>
                                    <?php
                                    $getInvesters = $this->CommonModal->getRowById('tbl_fund_requests', ['brick_id' => $brick_id, 'fund_status' => 'Approve'], 'id', 'DESC');
                                    if (!empty($getInvesters)):
                                        echo '<span class="text-primary py-2">Funding</span> <br/>';
                                        foreach ($getInvesters as $getInvest):
                                            $investorUserDetails = $this->CommonModal->getSingleRowById('freelancer', ['id' => $getInvest['funded_by']]);
                                    ?>
                                            <div class="col-md-12 p-2" style="z-index:5;">
                                                <div onclick="window.location.href='<?= base_url('company/user_preview?id=' . $investorUserDetails['id']) ?>'" class="team-member-card">
                                                    <img src="<?= !empty($investorUserDetails['user_image']) ? base_url() . 'uploads/user_profile/' . $investorUserDetails['user_image'] : base_url() . 'assets/user-icon.png' ?>" alt="Profile Picture">
                                                    <div class="team-member-info">
                                                        <h6><?= $investorUserDetails['name'] ?: 'No Name' ?></h6>
                                                        <p><strong>Email:</strong> <a href="mailto:<?= $investorUserDetails['email'] ?: 'N/A' ?>"><?= $investorUserDetails['email'] ?: 'N/A' ?></a></p>
                                                        <p><strong>Phone:</strong> <?= $investorUserDetails['phone'] ?: 'N/A' ?></p>
                                                    </div>
                                                    <!-- <span class=" btn btn-primary team-member-status <//?= $getInvest['fund_status'] ?>"><//?= $getInvest['fund_status'] ?></span> &nbsp; -->
                                                    <?php if ($bricks['user_id'] == sessionId('freelancer_id') || $check_permission['delete'] == '2') {
                                                    ?>
                                                        <a class="text-danger" title="Remove Member" href="<?= base_url('Home/deleteAddedMember?id=' . $getInvest['id']) ?>" onclick="return confirm('Are you sure you want to delete this User?');"><i class="fas fa-trash"></i></a>
                                                    <?php } ?>

                                                </div>
                                            </div>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>

                                    <?php
                                    $getConsultancy = $this->CommonModal->getRowById('tbl_bricks_cosultancy', ['brick_id' => $brick_id, 'status' => 'Accept'], 'id', 'DESC');
                                    if (!empty($getConsultancy)):
                                        echo '<span class="text-primary py-2">Consultancy/Advisory/Mentorship</span> <br/>';
                                        foreach ($getConsultancy as $getConsult):
                                            $getConsultUserDetails = $this->CommonModal->getSingleRowById('freelancer', ['id' => $getConsult['consultancy_by']]);
                                    ?>
                                            <div class="col-md-12" style="z-index:5;">
                                                <div onclick="window.location.href='<?= base_url('company/user_preview?id=' . $getConsultUserDetails['id']) ?>'" class="team-member-card">
                                                    <img src="<?= !empty($getConsultUserDetails['user_image']) ? base_url() . 'uploads/user_profile/' . $getConsultUserDetails['user_image'] : base_url() . 'assets/user-icon.png' ?>" alt="Profile Picture">
                                                    <div class="team-member-info">
                                                        <h6><?= $getConsultUserDetails['name'] ?: 'No Name' ?></h6>
                                                        <p><strong>Email:</strong> <a href="mailto:<?= $getConsultUserDetails['email'] ?: 'N/A' ?>"><?= $getConsultUserDetails['email'] ?: 'N/A' ?></a></p>
                                                        <p><strong>Phone:</strong> <?= $getConsultUserDetails['phone'] ?: 'N/A' ?></p>
                                                    </div>
                                                    <!-- <span class=" btn btn-primary team-member-status <//?= $getConsult['status'] ?>"><//?= $getConsult['status'] ?></span> &nbsp; -->
                                                    <?php if ($bricks['user_id'] == sessionId('freelancer_id') || $check_permission['delete'] == '2') {
                                                    ?>
                                                        <a class="text-danger" title="Remove Member" href="<?= base_url('Home/deleteAddedMember?id=' . $getConsult['id']) ?>" onclick="return confirm('Are you sure you want to delete this User?');"><i class="fas fa-trash"></i></a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>

                                    <?php
                                    $getBrickAllotment = $this->CommonModal->getRowById('tbl_brick_work_allotment', ['brick_id' => $brick_id, 'status' => 'Accept'], 'id', 'DESC');
                                    if (!empty($getBrickAllotment)):
                                        echo '<span class="text-primary py-2">Work Allotment</span> <br/>';
                                        foreach ($getBrickAllotment as $getBrickAll):
                                            $getWorkAllotmentUserDetails = $this->CommonModal->getSingleRowById('freelancer', ['id' => $getBrickAll['allotment_by']]);
                                    ?>
                                            <div class="col-md-12" style="z-index:5;">
                                                <div onclick="window.location.href='<?= base_url('company/user_preview?id=' . $getWorkAllotmentUserDetails['id']) ?>'" class="team-member-card">
                                                    <img src="<?= !empty($getWorkAllotmentUserDetails['user_image']) ? base_url() . 'uploads/user_profile/' . $getWorkAllotmentUserDetails['user_image'] : base_url() . 'assets/user-icon.png' ?>" alt="Profile Picture">
                                                    <div class="team-member-info">
                                                        <h6><?= $getWorkAllotmentUserDetails['name'] ?: 'No Name' ?></h6>
                                                        <p><strong>Email:</strong> <a href="mailto:<?= $getWorkAllotmentUserDetails['email'] ?: 'N/A' ?>"><?= $getWorkAllotmentUserDetails['email'] ?: 'N/A' ?></a></p>
                                                        <p><strong>Phone:</strong> <?= $getWorkAllotmentUserDetails['phone'] ?: 'N/A' ?></p>
                                                    </div>
                                                    <!-- <span class=" btn btn-primary team-member-status <//?= $getBrickAll['status'] ?>"><//?= $getBrickAll['status'] ?></span> &nbsp; -->
                                                    <?php if ($bricks['user_id'] == sessionId('freelancer_id') || $check_permission['delete'] == '2') {
                                                    ?>
                                                        <a class="text-danger" title="Remove Member" href="<?= base_url('Home/deleteAddedMember?id=' . $getBrickAll['id']) ?>" onclick="return confirm('Are you sure you want to delete this User?');"><i class="fas fa-trash"></i></a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>




                                </div>
                                <div class="my-1 p-2" style="border-right:1px solid black; width: 30%;"><strong> Owner </strong> <br />

                                    <?php
                                    $brickOwnerDetails = $this->CommonModal->getSingleRowById('freelancer', ['id' => $bricks['user_id']]);
                                    if (!empty($brickOwnerDetails)):
                                    ?>

                                        <div class="col-md-12 p-2" style="z-index:5;">
                                            <div onclick="window.location.href='<?= base_url('company/user_preview?id=' . $brickOwnerDetails['id']) ?>'" class="team-member-card">
                                                <img src="<?= !empty($brickOwnerDetails['user_image']) ? base_url() . 'uploads/user_profile/' . $brickOwnerDetails['user_image'] : base_url() . 'assets/user-icon.png' ?>" alt="Profile Picture">
                                                <div class="team-member-info">
                                                    <h6><?= $brickOwnerDetails['name'] ?: 'No Name' ?></h6>
                                                    <p><strong>Email:</strong> <a href="mailto:<?= $brickOwnerDetails['email'] ?: 'N/A' ?>" style="width:200px;"><?= $brickOwnerDetails['email'] ?: 'N/A' ?></a></p>
                                                    <p><strong>Phone:</strong> <?= $brickOwnerDetails['phone'] ?: 'N/A' ?></p>
                                                </div>
                                                <!-- <span class=" btn btn-primary team-member-status <//?= $getBrickAll['status'] ?>"><//?= $getBrickAll['status'] ?></span> &nbsp; -->
                                                <?php if ($bricks['user_id'] == sessionId('freelancer_id') || $check_permission['delete'] == '2') {
                                                ?>
                                                    <a class="text-danger" title="Remove Member" href="<?= base_url('Home/deleteAddedMember?id=' . $getInvest['id']) ?>" onclick="return confirm('Are you sure you want to delete this User?');"><i class="fas fa-trash"></i></a>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>

                                <div class="my-1 p-2" style="border-right:1px solid black; width: 30%;"><strong> Passers </strong> <br />
                                    <?php
                                    $getAllMemberAddedtoPassChannel = $this->CommonModal->getRowById('tbl_teamcompanymember', ['brick_id' => $brick_id, 'status' => 'Accepted', 'request_tab_id' => 'network-marketing-request'], 'id', 'DESC');
                                    if (!empty($getAllMemberAddedtoPassChannel)):
                                        echo '<span class="text-primary py-2">Pass Channel Members</span> <br/>';
                                        foreach ($getAllMemberAddedtoPassChannel as $getPassChannelMember):
                                            $getAddedUserDetails = $this->CommonModal->getSingleRowById('freelancer', ['id' => $getPassChannelMember['member_id']]);
                                    ?>
                                            <div class="col-md-12 p-2" style="z-index:5;">
                                                <div onclick="window.location.href='<?= base_url('company/user_preview?id=' . $getAddedUserDetails['id']) ?>'" class="team-member-card">
                                                    <img src="<?= !empty($getAddedUserDetails['user_image']) ? base_url() . 'uploads/user_profile/' . $getAddedUserDetails['user_image'] : base_url() . 'assets/user-icon.png' ?>" alt="Profile Picture">
                                                    <div class="team-member-info">
                                                        <h6><?= $getAddedUserDetails['name'] ?: 'No Name' ?></h6>
                                                        <p><strong>Email:</strong> <a href="mailto:<?= $getAddedUserDetails['email'] ?: 'N/A' ?>"><?= $getAddedUserDetails['email'] ?: 'N/A' ?></a></p>
                                                        <p><strong>Phone:</strong> <?= $getAddedUserDetails['phone'] ?: 'N/A' ?></p>
                                                    </div>
                                                    <!-- <span class=" btn btn-primary team-member-status <//?= $getBrickAll['status'] ?>"><//?= $getBrickAll['status'] ?></span> &nbsp; -->
                                                    <?php if ($bricks['user_id'] == sessionId('freelancer_id') || $check_permission['delete'] == '2') {
                                                    ?>
                                                        <a class="text-danger" title="Remove Member" href="<?= base_url('Home/deleteAddedMember?id=' . $getPassChannelMember['id']) ?>" onclick="return confirm('Are you sure you want to delete this User?');"><i class="fas fa-trash"></i></a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>
                                </div>

                                <div class="my-1 p-2" style="border-right:1px solid black; width: 30%;"><strong> Executer </strong> <br />
                                    <?php
                                    $getBrickAllotment = $this->CommonModal->getRowById('tbl_brick_work_allotment', ['brick_id' => $brick_id, 'status' => 'Accept'], 'id', 'DESC');
                                    if (!empty($getBrickAllotment)):
                                        echo '<span class="text-primary py-2">Work Allotment</span> <br/>';
                                        foreach ($getBrickAllotment as $getBrickAll):
                                            $getWorkAllotmentUserDetails = $this->CommonModal->getSingleRowById('freelancer', ['id' => $getBrickAll['allotment_by']]);
                                    ?>
                                            <div class="col-md-12 p-2" style="z-index:5;">
                                                <div onclick="window.location.href='<?= base_url('company/user_preview?id=' . $getWorkAllotmentUserDetails['id']) ?>'" class="team-member-card">
                                                    <img src="<?= !empty($getWorkAllotmentUserDetails['user_image']) ? base_url() . 'uploads/user_profile/' . $getWorkAllotmentUserDetails['user_image'] : base_url() . 'assets/user-icon.png' ?>" alt="Profile Picture">
                                                    <div class="team-member-info">
                                                        <h6><?= $getWorkAllotmentUserDetails['name'] ?: 'No Name' ?></h6>
                                                        <p><strong>Email:</strong> <a href="mailto:<?= $getWorkAllotmentUserDetails['email'] ?: 'N/A' ?>"><?= $getWorkAllotmentUserDetails['email'] ?: 'N/A' ?></a></p>
                                                        <p><strong>Phone:</strong> <?= $getWorkAllotmentUserDetails['phone'] ?: 'N/A' ?></p>
                                                    </div>
                                                    <!-- <span class=" btn btn-primary team-member-status <//?= $getBrickAll['status'] ?>"><//?= $getBrickAll['status'] ?></span> &nbsp; -->
                                                    <?php if ($bricks['user_id'] == sessionId('freelancer_id') || $check_permission['delete'] == '2') {
                                                    ?>
                                                        <a class="text-danger" title="Remove Member" href="<?= base_url('Home/deleteAddedMember?id=' . $getBrickAll['id']) ?>" onclick="return confirm('Are you sure you want to delete this User?');"><i class="fas fa-trash"></i></a>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                    <?php
                                        endforeach;
                                    endif;
                                    ?>

                                </div>
                                <div class="my-1 p-2" style="width: 30%;"><strong> Others </strong> <br>

                                    <?php if (!empty($getTeamMembers)) : ?>
                                        <div class="row" style="width:100%;">
                                            <?php foreach ($getTeamMembers as $member) :
                                                $memberInfo = $this->CommonModal->getSingleRowById('tbl_freelancer', ['id' => $member['member_id']]);
                                            ?>
                                                <div class="col-md-12 p-2">
                                                    <div onclick="window.location.href='<?= base_url('company/user_preview?id=' . $memberInfo['id']) ?>'" class="team-member-card">
                                                        <img src="<?= !empty($memberInfo['user_image']) ? base_url() . 'uploads/user_profile/' . $memberInfo['user_image'] : base_url() . 'assets/user-icon.png' ?>" alt="Profile Picture">
                                                        <div class="team-member-info">
                                                            <h6><?= $memberInfo['name'] ?: 'No Name' ?></h6>
                                                            <p><strong>Email:</strong> <a href="mailto:<?= $memberInfo['email'] ?: 'N/A' ?>"><?= $memberInfo['email'] ?: 'N/A' ?></a></p>
                                                            <p><strong>Phone:</strong> <?= $memberInfo['phone'] ?: 'N/A' ?></p>
                                                        </div>
                                                        <!-- <span class="team-member-status <?= $member['status'] ?>"><?= $member['status'] ?></span> &nbsp; -->
                                                        <?php if ($bricks['user_id'] == sessionId('freelancer_id') || $check_permission['delete'] == '2') {
                                                        ?>
                                                            <a class="text-danger" title="Remove Member" href="<?= base_url('Home/deleteAddedMember?id=' . $member['id']) ?>" onclick="return confirm('Are you sure you want to delete this User?');"><i class="fas fa-trash"></i></a>
                                                        <?php } ?>
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
                            </div>
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
                                    <input type="hidden" value="<?= $brick_id ?>" name="type_id">
                                    <input type="hidden" value="0" name="tree_type">
                                </div>
                                <button class="btn btn-primary mt-1 ms-3" type="submit">Create Tree</button>
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
</div>


<?php include('includes/footer.php') ?>
<?php include('includes/footer-link.php') ?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const timeline = document.getElementById("timeline");
        const companyId = <?= json_encode($bricks['company_id'] ?? '') ?>;
        const projectId = <?= json_encode($bricks['project_id'] ?? '') ?>;
        const brickId = <?= json_encode($bricks['id'] ?? '') ?>;
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
                        project_id: projectId,
                        brick_id: brickId
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

    document.getElementById('appealYes').addEventListener('change', function() {
        document.getElementById('appealContent').classList.remove('d-none');
    });

    document.getElementById('appealNo').addEventListener('change', function() {
        document.getElementById('appealContent').classList.add('d-none');
    });

    document.getElementById('docThumb').addEventListener('click', function() {
        var modal = new bootstrap.Modal(document.getElementById('docModal'));
        modal.show();
    });
</script>


<style>
    .forms_relative {
        position: relative;
    }

    .editTaskUpdateReport {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 5 !important;
    }

    .nonlivingshowcase {
        padding: 10px;
        border: 1px solid grey;
        border-radius: 6px !important;
        margin: 10px;
        width: 100% !important;
        font-size: 14px !important;
    }
</style>



<!-- Non Living Component Start -->
<script>
    function NonLivingPreview(Previewtype) {
        const NonLivingpreviewArea = document.getElementById('NonLivingpreviewArea');
        if (Previewtype === 'resourcesdocument') {
            NonLivingpreviewArea.innerHTML = `
            <div class="input-group mb-3 mt-4 " id="NonLivingpreviewArea" style="width: 100%;">
               <div> <span> <strong> DOCUMENTS </strong> </span> </div>
                    <?php if ($brickNonliving['resourcesdocument'] != null) { ?>
                        <div class="nonlivingshowcase">
                            <?= $brickNonliving['resourcesdocument'] ?>
                        </div>
                    <?php } else {
                        echo '<div class="nonlivingshowcase">Document Not Uploaded!</div>';
                    } ?>
            </div>
        `;
        } else if (Previewtype === 'resourcesaudio') {
            NonLivingpreviewArea.innerHTML = `
            <div class="input-group mb-3 mt-4 " id="NonLivingpreviewArea" style="width: 100%;">
                <span> <strong> AUDIO </strong> </span>
                    <?php if ($brickNonliving['resourcesaudio'] != null) { ?>
                        <div class="nonlivingshowcase">
                            <?= $brickNonliving['resourcesaudio'] ?>
                        </div>
                    <?php } else {
                        echo '<div class="nonlivingshowcase">Audio Not Uploaded! </div>';
                    } ?>
            </div>
        `;
        } else if (Previewtype === 'resourcesvideo') {
            NonLivingpreviewArea.innerHTML = `
            <div class="input-group mb-3 mt-4 " id="NonLivingpreviewArea" style="width: 100%;">
                <span> <strong> VIDEO </strong> </span>
                    <?php if ($brickNonliving['resourcesvideo'] != null) { ?>
                        <div class="nonlivingshowcase">
                            <?= $brickNonliving['resourcesvideo'] ?>
                        </div>
                    <?php } else {
                        echo '<div class="nonlivingshowcase">Video Not Uploaded! </div>';
                    } ?>
            </div>
        `;
        } else if (Previewtype === 'resourcestextbox') {
            NonLivingpreviewArea.innerHTML = `
             <div class="input-group mb-3 mt-4 " id="NonLivingpreviewArea" style="width: 100%;">
                <span> <strong> TEXT </strong> </span>
                    <?php if ($brickNonliving['resources_text'] != null) { ?>
                        <div class="nonlivingshowcase">
                            <?= $brickNonliving['resources_text'] ?>
                        </div>
                    <?php } else {
                        echo '<div class="nonlivingshowcase">Text Not Uploaded! </div>';
                    } ?>
            </div>
        `;
        }
    }
</script>


<!-- TASK COMPLETION SHOWCASE AREA  -->
<script>
    function showPreview(type) {
        const previewArea = document.getElementById('previewArea');
        if (type === 'document') {
            previewArea.innerHTML = `
            <div class="input-group mb-3 mt-4 forms_relative taskcompletionform" id="taskcompletionupdate1" style="width: 100%;">
            <span> <strong> DOCUMENTS </strong> </span>
            <form action="<?= base_url('/company/taskcompleteupdate') ?>" id="taskcompletionupdate" method="post" style="width:100%;">
                <input type="hidden" class="form-control" placeholder="Company ID" name="company_id" required value="<?= $bricks['company_id'] ?>" />
                <input type="hidden" class="form-control" placeholder="Project ID" name="project_id" required value="<?= $bricks['project_id'] ?>" />
                <input type="hidden" class="form-control" placeholder="Brick ID" name="brick_id" required value="<?= $bricks['id'] ?>" />
                <textarea type="text" name="document" id="taskcompletioninput" class="form-control taskcompletioninput" <?php if ($updatetaskcomplete['document'] != null) {
                                                                                                                            echo 'readonly';
                                                                                                                        } ?> placeholder="Past Documents Links" required data-gramm="false" data-quillbot="false"><?= isset($updatetaskcomplete['document']) ? htmlspecialchars($updatetaskcomplete['document']) : set_value('document'); ?></textarea>
                <span style="font-size:13px; color:red; float:right;"> Maximum 1000 Words </span>
                    <div class="text-center">
                        <button type="submit" class="mt-3 text-center btn btn-primary text-white bg-primary"> Submit </button
                    </div>
                    <?php if ($updatetaskcomplete['document'] != null) { ?>
                        <div class="editTaskUpdateReport">
                            <button type="button" class="btn btn-primary editBtn px-1 m-0"> <i class="fas fa-edit ms-2 my-1"></i> </button>
                        </div>
                    <?php } ?>
                   
                </form>
                 <?php if ($updatetaskcomplete['document']) { ?>
                    <div class="col-md-12" style="padding:10px; margin-top:20px; border-radius:16px; border:1px solid lightgrey;">
                        <div class="ratio ratio-4x3" style="cursor:pointer;" id="docThumb" data-doc="<?= $updatetaskcomplete['document']; ?>">
                            <iframe src="<?= $updatetaskcomplete['document']; ?>" frameborder="0" style="object-fit: cover;"></iframe>
                        </div>
                    </div>
                <?php } ?>
            </div>
        `;
        } else if (type === 'audio') {
            previewArea.innerHTML = `
            <div class="input-group mb-3 mt-4 forms_relative taskcompletionform" id="taskcompletionupdate2" style="width: 100%;">
            <span> <strong> AUDIO </strong> </span>
                <form action="<?= base_url('/company/taskcompleteupdate') ?>" id="taskcompletionupdate" method="post" style="width:100%;">
                <input type="hidden" class="form-control" placeholder="Company ID" name="company_id" required value="<?= $bricks['company_id'] ?>" />
                <input type="hidden" class="form-control" placeholder="Project ID" name="project_id" required value="<?= $bricks['project_id'] ?>" />
                <input type="hidden" class="form-control" placeholder="Brick ID" name="brick_id" required value="<?= $bricks['id'] ?>" />
                <textarea type="text" class="form-control taskcompletioninput" name="audio" id="taskcompletioninputs" <?php if ($updatetaskcomplete['audio'] != null) {
                                                                                                                            echo 'readonly';
                                                                                                                        } ?> placeholder="Past Audio File Links"><?= isset($updatetaskcomplete['audio']) ? htmlspecialchars($updatetaskcomplete['audio']) : set_value('audio'); ?></textarea>
                <span style="font-size:13px; color:red; float:right;"> Maximum 1000 Words </span>
                    <div class="text-center">
                        <button type="submit" class="mt-3 text-center btn btn-primary text-white bg-primary"> Submit </button
                    </div>
                      <?php if ($updatetaskcomplete['audio'] != null) { ?>
                        <div class="editTaskUpdateReport">
                            <button type="button" class="btn btn-primary editBtn px-1 m-0"> <i class="fas fa-edit ms-2 my-1"></i> </button>
                        </div>
                    <?php } ?>
                </form>
                 <?php if ($updatetaskcomplete['audio']) { ?>
                    <div class="col-md-12" style="padding:10px; margin-top:20px; border-radius:16px; border:1px solid lightgrey;">
                        <div class="ratio ratio-4x3" style="cursor:pointer;" id="docThumb" data-doc="<?= $updatetaskcomplete['audio']; ?>">
                            <audio controls style="width:100%; height:50px; object-fit:cover;">
                                <source src="<?= $updatetaskcomplete['audio']; ?>" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>
                <?php }  ?>
            </div>
        `;
        } else if (type === 'video') {
            previewArea.innerHTML = `
            <div class="input-group mb-3 mt-4 forms_relative taskcompletionform" id="taskcompletionupdate3" style="width: 100%;">
            <span> <strong> VIDEO </strong> </span>
                <form action="<?= base_url('/company/taskcompleteupdate') ?>" id="taskcompletionupdate" method="post" style="width:100%;">
                    <input type="hidden" class="form-control" placeholder="Company ID" name="company_id" required value="<?= $bricks['company_id'] ?>" />
                    <input type="hidden" class="form-control" placeholder="Project ID" name="project_id" required value="<?= $bricks['project_id'] ?>" />
                    <input type="hidden" class="form-control" placeholder="Brick ID" name="brick_id" required value="<?= $bricks['id'] ?>" />
                <textarea type="text" class="form-control taskcompletioninput" name="video" <?php if ($updatetaskcomplete['video'] != null) {
                                                                                                echo 'readonly';
                                                                                            } ?> id="taskcompletioninputss" placeholder="Past Video Links"><?= isset($updatetaskcomplete['video']) ? htmlspecialchars($updatetaskcomplete['video']) : set_value('video'); ?></textarea>
                <span style="font-size:13px; color:red; float:right;"> Maximum 1000 Words </span>
                    <div class="text-center">
                        <button type="submit" class="mt-3 text-center btn btn-primary text-white bg-primary"> Submit </button
                    </div>
                     <?php if ($updatetaskcomplete['video'] != null) { ?>
                        <div class="editTaskUpdateReport">
                            <button type="button" class="btn btn-primary editBtn px-1 m-0"> <i class="fas fa-edit ms-2 my-1"></i> </button>
                        </div>
                    <?php } ?>
                </form>
                  <?php if ($updatetaskcomplete['video']) { ?>
                    <div class="col-md-12" style="padding:10px; margin-top:20px; border-radius:16px; border:1px solid lightgrey;">
                        <div class="ratio ratio-16x9">
                            <iframe src="<?= $updatetaskcomplete['video']; ?>" title="YouTube video" allowfullscreen></iframe>
                        </div>
                    </div>
                <?php }  ?>

            </div>
        `;
        } else if (type === 'textbox') {
            previewArea.innerHTML = `
            <div class="input-group mb-3 mt-4 forms_relative taskcompletionform" id="taskcompletionupdate4" style="width: 100%;">
            <span> <strong> TEXT BOX </strong> </span>
             <form action="<?= base_url('/company/taskcompleteupdate') ?>" id="taskcompletionupdate" method="post" style="width:100%;">
                    <input type="hidden" class="form-control" placeholder="Company ID" name="company_id" required value="<?= $bricks['company_id'] ?>" />
                    <input type="hidden" class="form-control" placeholder="Project ID" name="project_id" required value="<?= $bricks['project_id'] ?>" />
                    <input type="hidden" class="form-control" placeholder="Brick ID" name="brick_id" required value="<?= $bricks['id'] ?>" />
                <textarea type="text" class="form-control taskcompletioninput" name="textbox" id="taskcompletioninputsss" <?php if ($updatetaskcomplete['textbox'] != null) {
                                                                                                                                echo 'readonly';
                                                                                                                            } ?> placeholder="Enter text here.."><?= isset($updatetaskcomplete['textbox']) ? htmlspecialchars($updatetaskcomplete['textbox']) : set_value('textbox'); ?></textarea>
                <span style="font-size:13px; color:red; float:right;"> Maximum 10,000 Words </span>
                    <div class="text-center">
                        <button type="submit" class="mt-3 text-center btn btn-primary text-white bg-primary"> Submit </button
                    </div>
                      <?php if ($updatetaskcomplete['textbox'] != null) { ?>
                        <div class="editTaskUpdateReport">
                            <button type="button" class="btn btn-primary editBtn px-1 m-0"> <i class="fas fa-edit ms-2 my-1"></i> </button>
                        </div>
                    <?php } ?>
                </form>
                 <?php if ($updatetaskcomplete['textbox']) { ?>
                    <div class="col-md-12" style="padding:10px; margin-top:20px; border-radius:16px; border:1px solid lightgrey;">
                        <?= $updatetaskcomplete['textbox']; ?>
                    </div>
                <?php } ?>
            </div>
        `;
        }
    }
</script>

<!-- Make sure jQuery is loaded once, before this script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    jQuery(function($) {

        // Edit button click event for any form with class .taskcompletionform
        $(document).on('click', '.taskcompletionform .editBtn', function(e) {
            e.preventDefault();

            var $form = $(this).closest('form'); // current form
            var $ta = $form.find('textarea.taskcompletioninput'); // textarea inside that form
            var $btn = $(this);

            // Function to unlock textarea
            function makeEditable($el) {
                $el.prop('readonly', false)
                    .prop('disabled', false)
                    .css('pointer-events', 'auto')
                    .trigger('focus');

                // If still blocked, replace with a fresh clone
                if ($el.is('[readonly]') || $el.prop('readonly')) {
                    var $clone = $el.clone();
                    $clone.prop('readonly', false).prop('disabled', false);
                    $el.replaceWith($clone);
                    $ta = $clone;
                    $ta.trigger('focus');
                }
            }

            if ($ta.prop('readonly')) {
                makeEditable($ta);
                $btn.html('<i class="fas fa-save ms-2 my-1"></i>');
            } else {
                $ta.prop('readonly', true);
                $btn.html('<i class="fas fa-edit ms-2 my-1"></i>');
            }
        });

    });
</script>



<script>
    $(document).ready(function() {

        // Tagify initialization for Create Channel
        var inputElm = document.querySelector('#team-member-input');
        // var inputElm2 = document.querySelector('#team-member-input2');
        // var inputElm3 = document.querySelector('#team-member-input3');
        // var inputElm4 = document.querySelector('#team-member-input4');
        // var inputElm5 = document.querySelector('#team-member-input5');

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



        // Send Network Marketing Channel Request to User
        $('#channelRequestForm').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            let formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // ✅ Show message without page reload
                        alert(response.message);

                        // ✅ Clear the input field after success
                        $('#team-member-input').val(''); // Reset input value

                        // ❌ Remove or comment out this if you don't want to reload
                        // window.location.href = response.redirect_url;
                    } else {
                        alert("Error: " + (response.message || response.errors));
                    }
                },
                error: function(xhr, status, error) {
                    alert("AJAX Error: " + error);
                    console.log(xhr.responseText);
                }
            });
        });

        $('#channelRequestForm2').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            let formData2 = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData2,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // ✅ Show message without page reload
                        alert(response.message);

                        // ✅ Clear the input field after success
                        $('#team-member-input').val(''); // Reset input value

                        // ❌ Remove or comment out this if you don't want to reload
                        // window.location.href = response.redirect_url;
                    } else {
                        alert("Error: " + (response.message || response.errors));
                    }
                },
                error: function(xhr, status, error) {
                    alert("AJAX Error: " + error);
                    console.log(xhr.responseText);
                }
            });
        });


        // Create Channel Name
        $('#CreateChannelName').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',

                success: function(response) {
                    if (response.success) {
                        alert(response.message);

                        // Clear form inputs
                        $('#channelSelect').val('');
                        $('#channelNameInput').val('');
                        $('#chennel_brick_type').val('');

                        const ids = ['First', 'Second', 'Third', 'Fourth', 'Fifth'];

                        // Clear existing data
                        ids.forEach((id, index) => {
                            $('#chennel' + id).html((index + 1) + '. Channel - ');
                            $('#chenneltype' + id).html('Type - ');
                            $('#Channel' + id + 'Id').val('');
                            $('#chid' + id + 'Id').val('');
                        });

                        // Fill new channel data
                        if (response.allChannels && response.allChannels.length > 0) {
                            response.allChannels.forEach((channel, index) => {
                                if (index < ids.length) {
                                    // Channel Name
                                    const name = channel.channel_name || '';
                                    $('#chennel' + ids[index]).html((index + 1) + '. Channel - ' + name);

                                    // Channel Type from "chennel_brick_type"
                                    let type = channel.chennel_brick_type || '';
                                    type = type
                                        .replace(/-/g, ' ') // Replace hyphens
                                        .replace(/\b\w/g, c => c.toUpperCase()); // Capitalize words

                                    $('#chenneltype' + ids[index]).html('Type - ' + type);

                                    // Hidden field
                                    $('#Channel' + ids[index] + 'Id').val(channel.channel_id);
                                    $('#chid' + ids[index] + 'Id').val(channel.id);
                                }
                            });
                        }

                    } else {
                        alert("Error: " + (response.message || response.errors));
                    }
                },

                error: function(xhr, status, error) {
                    alert("AJAX Error: " + error);
                    console.log(xhr.responseText);
                }
            });
        });

        // Open Create Cahnnel
        $('#openCreateChannel').on('click', function() {
            const brick_id = $('#brick_id_input').val();
            const created_by = $('#created_by_input').val();

            $.ajax({
                url: '<?= base_url("company/get-all-channel-on-create") ?>',
                method: 'POST',
                data: {
                    brick_id: brick_id,
                    created_by: created_by
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {

                        const ids = ['First', 'Second', 'Third', 'Fourth', 'Fifth'];

                        // Reset all divs and inputs
                        ids.forEach((id, index) => {
                            $('#chennel' + id).html((index + 1) + '. Channel - ');
                            $('#chenneltype' + id).html('Type - ');
                            $('#Channel' + id + 'Id').val('');
                            $('#chid' + id + 'Id').val('');

                        });

                        // Populate channel data if available
                        if (response.allChannels && response.allChannels.length > 0) {
                            response.allChannels.forEach((channel, index) => {
                                if (index < ids.length) {
                                    // Set channel name
                                    const name = channel.channel_name || '';
                                    $('#chennel' + ids[index]).html((index + 1) + '. Channel - ' + name);

                                    // Set and format type
                                    let type = channel.chennel_brick_type || '';
                                    type = type
                                        .replace(/-/g, ' ')
                                        .replace(/\b\w/g, c => c.toUpperCase()); // Capitalize words

                                    $('#chenneltype' + ids[index]).html('Type - ' + type);

                                    // Hidden input
                                    $('#Channel' + ids[index] + 'Id').val(channel.channel_id);

                                    // Hidden input
                                    $('#chid' + ids[index] + 'Id').val(channel.id);
                                }
                            });
                        }

                    } else {
                        alert("Error: " + (response.message || response.errors));
                    }
                },
                error: function(xhr, status, error) {
                    console.log("AJAX Error:", error);
                }
            });
        });


        // Brick Voting Panel
        $('#brick_voted').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            let formData = new FormData(this);
            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    console.log(response); // ✅ Debug output

                    if (response.success) {
                        alert(response.message);

                        // window.location.href = response.redirect_url;
                    } else {
                        alert("Error: " + (response.message || response.errors));
                    }
                },
                error: function(xhr, status, error) {
                    alert("AJAX Error: " + error);
                    console.log(xhr.responseText);
                }
            });
        });


        // Add New User Form Toggle
        $('#openAddNewUser').on('click', function() {
            $('#addNewUserForm').slideToggle(200); // 200ms animation
        });
        $('#openAddNewUser2').on('click', function() {
            $('#addNewUserForm2').slideToggle(200); // 200ms animation
        });
        $('#openAddNewUser3').on('click', function() {
            $('#addNewUserForm3').slideToggle(200); // 200ms animation
        });
        $('#openAddNewUser4').on('click', function() {
            $('#addNewUserForm4').slideToggle(200); // 200ms animation
        });
        $('#openAddNewUser5').on('click', function() {
            $('#addNewUserForm5').slideToggle(200); // 200ms animation
        });



        document.querySelectorAll('.copy-link').forEach(function(link) {
            link.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent page navigation

                const textToCopy = this.getAttribute('data-link');

                navigator.clipboard.writeText(textToCopy).then(function() {
                    // Show success popup
                    const popup = document.getElementById('copyPopup');
                    popup.style.display = 'block';

                    // Hide after 2 seconds
                    setTimeout(() => popup.style.display = 'none', 2000);
                }).catch(function(err) {
                    alert('Copy failed: ' + err);
                });
            });
        });


        // Task Complete Update Function 
        $('#taskcompletionupdate').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // ✅ Show message without page reload
                        alert(response.message);

                        // redirect only if backend sends redirect_url
                        if (response.redirect_url) {
                            window.location.href = response.redirect_url;
                        } else {
                            $('#taskcompletioninput').val('');
                        }

                    } else {
                        alert("Error: " + (response.message || response.errors));
                    }
                },
                error: function(xhr, status, error) {
                    alert("AJAX Error: " + error);
                    console.log(xhr.responseText);
                }
            });
        });



        // Added Valuation 
        $('#addedvalue').on('submit', function(e) {
            e.preventDefault();

            let formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // ✅ Show message without page reload
                        alert(response.message);

                        // redirect only if backend sends redirect_url
                        if (response.redirect_url) {
                            window.location.href = response.redirect_url;
                        } else {
                            $('#currency').val('');
                            $('#addedvaueinput').val('');
                        }

                    } else {
                        alert("Error: " + (response.message || response.errors));
                    }
                },
                error: function(xhr, status, error) {
                    alert("AJAX Error: " + error);
                    console.log(xhr.responseText);
                }
            });
        });


        // Toggle section visibility
        document.querySelectorAll('.enableSwitch').forEach((switchElement) => {
            switchElement.addEventListener('change', function() {
                const index = this.getAttribute('data-index');
                const label = document.querySelector('.enableDisableLabel[data-index="' + index + '"]');
                const form = document.getElementById('conditionalForm' + index);
                const questionBox = document.getElementById('questionBox' + index);

                if (form) { // form exist karta hai tohi toggle hoga
                    if (this.checked) {
                        form.style.display = 'block';
                        if (questionBox) questionBox.style.borderBottom = 'none';
                        if (label) label.textContent = 'Yes';
                    } else {
                        form.style.display = 'none';
                        if (questionBox) questionBox.style.borderBottom = '2px dotted #ccc';
                        if (label) label.textContent = 'No';
                    }
                }
            });
        });


        // PERMISSIONS 
        $("#permissionForm").on("submit", function() {
            const checkyes = $('#checkyes').val();
            const selectedVal = $('#selectedval').val();
            const brick_id = $('#permission_brick_id').val();
            const company_id = $('#permission_company_id').val();

            $.ajax({
                url: "<?= base_url("company/permission") ?>", // replace with your endpoint
                type: "POST",
                dataType: "json", // 👈 add this
                data: {
                    permission: selectedVal,
                    brick_id: brick_id,
                    company_id: company_id,
                    checkyes: checkyes
                },
                success: function(response) {
                    console.log("Server Response:", response);
                    alert(response.message);
                    // You can update DOM here

                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        });


        // PROJECT PERMISSION 
        $("#project_permission").on("submit", function() {
            const checkyes = $('#checkyes2').val();
            const selectedVal = $('#selectedval2').val();
            const brick_id = $('#permission_brick_id2').val();
            const project_id = $('#permission_project_id2').val();

            $.ajax({
                url: "<?= base_url("company/permission") ?>", // replace with your endpoint
                type: "POST",
                dataType: "json", // 👈 add this
                data: {
                    permission: selectedVal,
                    brick_id: brick_id,
                    project_id: project_id,
                    checkyes: checkyes
                },
                success: function(response) {
                    console.log("Server Response:", response);
                    alert(response.message);
                    // You can update DOM here

                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        });


        // CHECK VOTING RIGHTS USER ALREADY ADDED OR NOT IN INVESTOR/OWNER/PASSER/EXECUTER/OTHER

        $("#votefor").on("change", function() {
            const brick_id = $('#check_brick_id').val();
            const user_id = $('#check_user_id').val();
            const votefor = $('#votefor').val();
            $.ajax({
                url: "<?= base_url("company/check_votingrights") ?>",
                type: "POST",
                dataType: "json",
                data: {
                    brick_id: brick_id,
                    user_id: user_id,
                    votefor: votefor
                },
                success: function(response) {
                    console.log("Server Response:", response);
                    if (response.success) {
                        // Example: Shiv + 13.33% Voteshare to this Brick
                        let html = `
                    <div style="width:100%; font-size: 12px; padding-top:9px; margin-left:10px;">
                        <span class="bg-primary px-2 mx-1 py-1 text-white">${response.votername}</span>
                         +
                        <span class="bg-primary px-2 mx-1 py-1 text-white">${response.rights}%</span>
                        <input type="hidden" name="votefor" id="voteforinput" value="${response.votefor}" />
                         <input type="hidden" name="votingrights" id="votingrights" value="${response.rights}" />
                        ${response.message}
                    </div>
                `;

                        // Print inside some container
                        $("#voteResult").html(html);
                    } else {
                        // Agar team member nahi hai
                        let html = `
                    <div style="width:100%; font-size: 12px; padding-top:9px; margin-left:10px;">
                        <span class="bg-danger px-2 py-1 mx-1 text-white">${response.votername}</span>
                        +
                        <span class="bg-danger px-2 py-1 mx-1 text-white">${response.rights}</span>
                        ${response.message}
                    </div>
                `;
                        $("#voteResult").html(html);
                    }
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error:", error);
                }
            });
        });




        // BRICK MARK AS COMPLETED 

        $('#markasCompleted').on('submit', function(e) {
            e.preventDefault();
            const brick_id_markas = $('#brick_id_markas').val();

            $.ajax({
                url: $(this).attr('action'),
                method: 'POST',
                data: {
                    brick_id_markas: brick_id_markas
                },
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        // ✅ Show message without page reload
                        alert(response.message);

                        // redirect only if backend sends redirect_url
                        if (response.redirect_url) {
                            window.location.href = response.redirect_url;
                        }

                    } else {
                        alert("Error: " + (response.message || response.errors));
                    }
                },
                error: function(xhr, status, error) {
                    alert("AJAX Error: " + error);
                    console.log(xhr.responseText);
                }
            });
        });

    });
</script>
<!-- Shiv Web Developer -->


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
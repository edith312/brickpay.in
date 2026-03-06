<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brick Details</title>
    <link rel="stylesheet" href="http://localhost/brickpay.in/assets/css/style.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        @media print {
            body * {
                visibility: hidden;
            }
            .print-area, .print-area * {
                visibility: visible;
            }
        }

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
    .page {
        page-break-after: always;
    }

    .avoid-break {
        page-break-inside: avoid;
    }

    .border-end-right{
        z-index: 1;
    }
    @media print {
        * {
            overflow: visible !important;
        }
    }
    </style>
</head>

<body onload="window.print()">
    <div class="print-area">
        <div class="page">
            <h6>Brick Description</h6>
            <p><?= $bricks['brick_description'] ?></p>
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
                    <!-- <a href="<?= base_url('company/project_history?id=') . $projectDetails['id'] ?>" class="btn btn-primary mt-md-2" style="border-radius: 0.375rem;">
                        Project History File
                    </a>

                    <a href="<?= base_url('company/timestamps?id=') . $bricks['id']; ?>" class="btn btn-primary mt-md-2 text-center" style="border-radius: 0.375rem;">
                        TimeStamps
                    </a> -->

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
                            <!-- <button class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#fundModal" style="position: absolute; top:47px; left:39%; text-align: center; font-size:16px; padding:1px 20px;">Fund Now</button> -->
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
                        <!-- <dl class="d-flex align-items-center mb-3">
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
                        </dl> -->
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
                    </div>
                </div>

                <div class="col-6">
                    <div class="p-3 h-100">
                        <dl class="dl-horizontal mb-0 mt-5 pt-4">
                            <!-- <button class="btn text-center btn-sm btn-primary" style="width:450px; position: absolute; top:0px; left:34%; text-align: center; font-size:16px; padding:5px 20px;"> -->
                                <!-- <div style="position:relative !important;"> -->
                                <!-- <select class="form-select text-white" name="whatyou" id="project_component" style="height:30px; width:160px; margin-right: 10px; background-color: #4772f3; "> -->
                                    <!-- <option value="">-- Select --</option> -->
                                    <!-- <option value="brick">Brick</option> -->
                                    <!-- <option value="task">Task</option>
                                    <option value="milestone">Milestone</option>
                                    <option value="strategie">Strategie</option>
                                    <option value="scene">Scene</option>
                                    <option value="updates">Updates</option>
                                    <option value="events">Events</option> -->
                                <!-- </select> -->
                                <!-- <button type="button" class="btn btn-primary text-center" style="position:absolute; top:3px; right:41%; width:160px; padding-left:45px;" data-bs-toggle="modal" data-bs-target="#taskDescModal"> Description </button> -->
                                <!-- </div> -->
                            <!-- </button> -->
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
                                            <!-- <input type="text" class="form-control" placeholder="Your Work BID" name="bid_amount" required>
                                            <input type="text" class="form-control" placeholder="Your Delivery Time" name="delivery_time" required> -->
                                        </div>
                                        <!-- <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-center mb-2" style="border-radius: 0.375rem; width: 100%;">
                                            <i class="fa fa-user-plus me-1"></i> Apply for Work
                                        </button> -->
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
                                    <button type="button" class="btn text-white" style="background-color:#00b8d6; border-radius: 0px; justify-self: center; width:220px;">Living Components</button>
                                </div>
                                <div class="text-center mb-1">
                                    <div class="resources-wrapper position-relative">
                                        <button type="button" class="btn text-white" style="background-color:#00b8d6; border-radius: 0px; justify-self: center; width:220px; position: relative; z-index: 1;"> Resources 
                                        </button>
                                        <span class="resources-middle-line"></span>
                                    </div>
                                </div>
                                <div>
                                    <div class="text-center mt-1">
                                        <button type="button" class="btn text-white" style="background-color:#00b8d6; border-radius: 0px; justify-self: center; width:220px;"> Non Living Components </button>
                                    </div>

                                    <!-- <div class="d-flex align-items-center w-100 mt-4 mb-3">
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
                                    </div> -->
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
                                            <!-- <div class="input-groups">
                                                <input type="text" class="form-control" placeholder="Your Work BID" name="bid_amount" required>
                                                <input type="text" class="form-control" placeholder="Your Delivery Time" name="delivery_time" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary d-flex align-items-center justify-content-center mb-2" style="border-radius: 0.375rem; width: 100%;">
                                                <i class="fa fa-user-plus me-1"></i> Apply for Bidding
                                            </button> -->
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
                            <!-- <button type="button" class="text-white" data-bs-toggle="modal" data-bs-target="#openvote" style="background-color:blue; padding:3px 17px; border:none;" id="openvotemodel"> Vote </button> -->

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


                            <!-- <button <?php if ($bricks['user_id'] ==  sessionId('freelancer_id') || $getTeamMemberofBrick['member_id'] == sessionId('freelancer_id')) { ?> onclick="showPreview('document')" <?php } ?> class="btn <?php if ($updatetaskcomplete['document'] != null) {
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
                            </button> -->
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
        <div class="page">
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
    </div>   
</body>

</html>
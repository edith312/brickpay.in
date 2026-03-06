<?php $this->load->view('includes/header'); ?>
<!-- Shiv Web Developer  -->

<?php
if ($this->session->has_userdata('taskMsg')) {
    echo $this->session->userdata('taskMsg');
    $this->session->unset_userdata('taskMsg');
}
?>

<!-- Shiv Web Developer -->
<style>
    /* Team Member Card Styles */
    .team-member-card {
        display: flex;
        align-items: center;
        border: 1px solid rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 8px;
        /* margin-bottom: 15px; */
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        transition: box-shadow 0.2s;
        cursor: pointer;
        font-size: 12px;
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
</style>


<style>
    .tables {
        /* width: 95% !important; */
        height: auto !important;
        background: #ffff;
        border-radius: 10px;
        padding: 20px;
    }

    .tables .thead {
        width: 100% !important;
    }

    .tables .thead .tr {
        width: 100% !important;
        display: flex;
        border: 0.5px solid grey;
    }

    .tables .thead .tr .th1 {
        width: 35% !important;
        border-left: 0.5px solid grey;
        padding: 5px !important;
        font-weight: 700;
    }

    .tables .thead .tr .th2 {
        width: 65% !important;
        border-left: 0.5px solid grey;
        padding: 5px !important;
        font-weight: 700;
    }

    .tables .tbody {
        width: 100% !important;
    }

    .tables .tbody .tr {
        width: 100% !important;
        display: flex;
        border: 0.5px solid grey;
        /* margin-top: 5px; */
    }

    .tables .tbody .tr .td1 {
        width: 35% !important;
        border-left: 0.5px solid grey;
        padding: 5px !important;
    }

    .tables .tbody .tr .td2 {
        width: 65% !important;
        border-left: 0.5px solid grey;
        padding: 5px !important;
    }
</style>


<!-- Shiv Web Developer -->
<style>
    @media (min-width: 1200px) {
        main .page-body {
            height: calc(100vh - 30px) !important;
        }
    }

    #filtersSection {
        margin-top: 0 !important;
    }

    .filters .filter-box {
        padding-bottom: 12px;
    }

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

    .custom-search-input {
        padding-left: 2.2rem;
    }

    .custom-search-icon {
        position: absolute;
        left: 10px;
        top: 50%;
        transform: translateY(-50%);
        color: gray;
        pointer-events: none;
    }

    /* Responsive adjustments */
    @media (max-width: 992px) {
        .container {
            padding: 10px;
        }

        .col-md-2,
        .col-md-3,
        .col-md-4,
        .col-md-5,
        .col-md-6,
        .col-md-8 {
            margin-bottom: 15px;
        }

        .mt--48 {
            margin-top: 15px !important;
        }
    }

    @media (max-width: 768px) {
        .form-unique {
            width: 25px !important;
            height: 25px;
            font-size: 12px !important;
        }

        .d-flex.gap-3 {
            flex-direction: column;
        }

        .top-right-btns {
            display: flex;
            flex-direction: row;
            width: 100%;
        }

        .top-right-btns button {
            flex: 1;
        }

        .ps-md-3 {
            padding-left: 10px !important;
        }

        .p-md-5 {
            padding: 15px !important;
        }
    }

    @media (max-width: 576px) {
        .container {
            padding: 5px;
        }

        .form-unique {
            width: 20px !important;
            height: 20px;
            font-size: 10px !important;
            margin: 0 1px;
        }

        .custom-upload-btn {
            font-size: 12px;
            padding: 5px 8px;
        }

        h4 {
            font-size: 18px;
        }

        label {
            font-size: 14px;
        }
    }

    /* New styles for modals and upload icons */
    .upload-modal .modal-content {
        border-radius: 10px;
    }

    .upload-modal .modal-header {
        background-color: #f8f9fa;
        border-bottom: 1px solid #dee2e6;
    }

    .upload-modal .modal-body {
        padding: 20px;
    }

    .textarea-upload-container {
        position: relative;
    }

    .mic-icon,
    .video-icon,
    .upload-icon {
        position: absolute;
        cursor: pointer;
        font-size: 18px;
        color: rgb(0, 127, 230);
    }

    .mic-icon {
        right: 19px;
        top: 10px;
    }

    .video-icon {
        left: 12px;
        bottom: 12px;
    }

    .upload-icon {
        right: 12px;
        bottom: 12px;
    }
</style>

<div class="ps-md-4 pe-md-3 px-2 py-3 page-body pt-0">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-4">
                <div class="card-header flex-column align-items-stretch py-3 p-0 pt-0 bg-transparent border-bottom-0 m-4">
                    <div class="card-body mx-4">
                        <div>
                            <h4 class="mb-md-5 mb-3 text-center"> S7 - Translational Research Panel <br /> (Project Thesis Bachelor/Masters/PHD/Post-Doc) </h4>
                        </div>

                        <!-- Section Enabled Disable -->
                        <div id="questionBox1" class="p-md-5 pt-md-3 pb-md-3 dotted-bottom ps-md-3" style="position:relative; border-left: 3px solid #7f1b54; border-right: 3px solid #7f1b54; border-bottom: 2px dotted #ccc;">
                            <div class="d-flex align-items-center">
                                <label class="me-2">S<sub>7</sub> - <span style="font-size:12px; color:red;">*</span> Translational Research Panel </label>
                                <label class="switch me-2">
                                    <input type="checkbox" class="enableSwitch" data-index="1" name="show_form_1" checked>
                                    <span class="slider round"></span>
                                </label>
                                <span class="enableDisableLabel" data-index="1">Yes</span> <br />
                            </div>
                            <label> (Project Thesis Bachelor/Masters/PHD/Post-Doc) </label>
                        </div>
                        <style>
                            select:disabled {
                                background-color: #e9ecef;
                                /* light gray blur */
                                color: #6c757d;
                            }
                        </style>
                    </div>

                    <div class="card-body bg-white mt-md-3 mx-4 p-0">
                        <div id="conditionalForm1" class="container" style="display: block;">
                            <form method="POST" action="" class="flex flex-col gap-4" enctype="multipart/form-data" id="formdatasubmitted">
                                <input type="hidden" name="edit_id" value="<?= isset($editData['id']) ? $editData['id'] : '' ?>">

                                <div class="w-100 px-2 py-5">
                                    <div class="row mt-md-0 mb-md-0  pb-md-0 align-items-start">
                                        <div class="col-md-4 mb-3 mt-md-0">
                                            <label for="share_research_paper" class="form-label d-flex align-items-center gap-2">
                                                Share Research Paper Publisher name
                                            </label>
                                            <input type="text" class="form-control" placeholder="Enter Publisher name"
                                                name="publishername" id="publishername"
                                                value="<?= isset($editData['publishername']) ? $editData['publishername'] : '' ?>" required>
                                        </div>
                                        <div class="col-md-4 mb-3 mt-md-0">
                                            <label for="brick_pay_rating" class="form-label d-flex align-items-center gap-2">
                                                Brick Pay Rating of Publisher
                                            </label>
                                            <input type="text" class="form-control" placeholder="Enter Brick Pay Rating"
                                                name="publisherrating" id="publisherrating"
                                                value="<?= isset($editData['publisherrating']) ? $editData['publisherrating'] : '' ?>" required>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">If not Published by any agency - submit to review with Edith </label>
                                            <!-- <input type="file" class="form-control" name="by_anyagency" id="by_anyagency" required> -->
                                            <input type="file" class="form-control" placeholder="Choose File"
                                                name="by_anyagency" id="by_anyagency"
                                                value="<?= isset($editData['by_anyagency']) ? $editData['by_anyagency'] : '' ?>">
                                            <!-- <input type="text" class="form-control" placeholder="Enter Link" name="publishedbyanyagencylink" id="publishedbyanyagencylink" required> -->
                                            <input type="text" class="form-control" placeholder="Enter Link (Research Video/Audio/Text)"
                                                name="publishedbyanyagencylink" id="publishedbyanyagencylink"
                                                value="<?= isset($editData['publishedbyanyagencylink']) ? $editData['publishedbyanyagencylink'] : '' ?>" required>
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Upload Executive Summary - Embedded View.</label>
                                            <!-- <input type="file" class="form-control" name="project_component" id="project_component" required> -->
                                            <input type="file" class="form-control" placeholder="Choose File"
                                                name="project_component" id="project_component"
                                                value="<?= isset($editData['project_component']) ? $editData['project_component'] : '' ?>">
                                            <!-- <input type="text" class="form-control" placeholder="Enter Link" name="executive_summary" id="executive_summary" required> -->
                                            <input type="text" class="form-control" placeholder="Enter Link"
                                                name="executive_summary" id="executive_summary"
                                                value="<?= isset($editData['executive_summary']) ? $editData['executive_summary'] : '' ?>">
                                        </div>

                                        <div class="col-md-4 mb-3 position-relative textarea-upload-container">
                                            <label> Upload Core Documents - Multiple Documents.</label>
                                            <!-- <input type="file" class="form-control" name="core_documents" id="core_documents" multiple required> -->
                                            <input type="file" class="form-control" placeholder="Choose File "
                                                name="core_documents" id="core_documents"
                                                value="<?= isset($editData['core_documents']) ? $editData['core_documents'] : '' ?>">
                                            <!-- <input type="text" class="form-control" placeholder="Enter Link" name="core_documentslink" id="core_documentslink" required> -->
                                            <input type="text" class="form-control" placeholder="Enter Link"
                                                name="core_documentslink" id="core_documentslink"
                                                value="<?= isset($editData['core_documentslink']) ? $editData['core_documentslink'] : '' ?>">
                                        </div>
                                        <div class="mb-3 col-md-4">
                                            <label class="form-label">Make your own Index </label>
                                            <!-- <input type="file" class="form-control" name="custom_index" id="custom_index" required> -->
                                            <input type="file" class="form-control" placeholder="Choose File "
                                                name="custom_index" id="custom_index"
                                                value="<?= isset($editData['custom_index']) ? $editData['custom_index'] : '' ?>">
                                            <!-- <input type="text" class="form-control" placeholder="Enter Link" name="custom_indexlink" id="custom_indexlink" required> -->
                                            <input type="text" class="form-control" placeholder="Enter Link"
                                                name="custom_indexlink" id="custom_indexlink"
                                                value="<?= isset($editData['custom_indexlink']) ? $editData['custom_indexlink'] : '' ?>">
                                        </div>

                                        <div class="mb-3 col-md-4">
                                            <label class="form-label"> TRL Levels </label>
                                            <!-- <input type="file" class="form-control" name="trl_levels" id="trl_levels" required> -->
                                            <input type="file" class="form-control" placeholder="Choose File"
                                                name="trl_levels" id="trl_levels"
                                                value="<?= isset($editData['trl_levels']) ? $editData['trl_levels'] : '' ?>">
                                            <!-- <input type="text" class="form-control" placeholder="Enter Link" name="trl_levelslink" id="trl_levelslink" required> -->
                                            <input type="text" class="form-control" placeholder="Enter Link"
                                                name="trl_levelslink" id="trl_levelslink"
                                                value="<?= isset($editData['trl_levelslink']) ? $editData['trl_levelslink'] : '' ?>">
                                        </div>

                                        <div class="mb-3 col-md-4">
                                            <label class="form-label"> Calender Basis Bricks </label>
                                            <!-- <input type="file" class="form-control" name="calendar_basis_bricks" id="calendar_basis_bricks" required> -->
                                            <input type="file" class="form-control" placeholder="Choose File"
                                                name="calendar_basis_bricks" id="calendar_basis_bricks"
                                                value="<?= isset($editData['calendar_basis_bricks']) ? $editData['calendar_basis_bricks'] : '' ?>">
                                            <!-- <input type="text" class="form-control" placeholder="Enter Link" name="calendar_basis_brickslinks" id="calendar_basis_brickslinks" required> -->
                                            <input type="text" class="form-control" placeholder="Enter Link"
                                                name="calendar_basis_brickslinks" id="calendar_basis_brickslinks"
                                                value="<?= isset($editData['calendar_basis_brickslinks']) ? $editData['calendar_basis_brickslinks'] : '' ?>">
                                        </div>

                                        <div class="mb-3 col-md-4">
                                            <label class="form-label"> Project Thesis </label>
                                            <!-- <input type="file" class="form-control" name="project_thesis" id="project_thesis" required> -->
                                            <input type="file" class="form-control" placeholder="Choose File"
                                                name="project_thesis" id="project_thesis"
                                                value="<?= isset($editData['project_thesis']) ? $editData['project_thesis'] : '' ?>">
                                            <!-- <input type="text" class="form-control" placeholder="Enter Link" name="projectthesislinks" id="projectthesislinks" required> -->
                                            <input type="text" class="form-control" placeholder="Enter Link"
                                                name="projectthesislinks" id="projectthesislinks"
                                                value="<?= isset($editData['projectthesislinks']) ? $editData['projectthesislinks'] : '' ?>">
                                        </div>
                                        <div class="mb-5 col-md-4">
                                            <label class="form-label">Cititation </label>
                                            <!-- <input type="text" class="form-control" placeholder="Enter Cititation" name="cititation" id="cititation" required> -->
                                            <input type="text" class="form-control" placeholder="Enter Cititation"
                                                name="cititation" id="cititation"
                                                value="<?= isset($editData['cititation']) ? $editData['cititation'] : '' ?>">
                                        </div>
                                        <div class="mb-5 col-md-4">
                                            <label class="form-label"> Biblography </label>
                                            <!-- <input type="text" class="form-control" placeholder="Enter Biblography" name="biblography" id="biblography" required> -->
                                            <input type="text" class="form-control" placeholder="Enter Biblography"
                                                name="biblography" id="biblography"
                                                value="<?= isset($editData['biblography']) ? $editData['biblography'] : '' ?>">
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn bg-primary text-white"> <?= isset($editData['id']) ? 'Update' : 'Submit' ?> </button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <div class="card-body">
                            <div>
                                <h4 class="mb-md-5 mb-3 text-center">S7 - Responses - Translational Research Panel <br />(Project Thesis Bachelor/Masters/PHD/Post-Doc)</h4>
                            </div>

                            <!-- Section Enabled Disable -->
                            <div id="questionBox3" class="p-md-5 pt-md-3 pb-md-3 dotted-bottom ps-md-3" style="position:relative; border-left: 3px solid #7f1b54; border-right: 3px solid #7f1b54; border-bottom: 2px dotted #ccc;">
                                <div class="d-flex align-items-center">
                                    <label class="me-2">S<sub>7</sub> - <span style="font-size:12px; color:red;">*</span> Translational Research Panel </label>
                                    <label class="switch me-2">
                                        <input type="checkbox" class="enableSwitch" data-index="3" name="show_res_1" checked>
                                        <span class="slider round"></span>
                                    </label>
                                    <span class="enableDisableLabel" data-index="1">Yes</span> <br />
                                </div>
                                <label> (Project Thesis Bachelor/Masters/PHD/Post-Doc) </label>
                            </div>
                            <style>
                                select:disabled {
                                    background-color: #e9ecef;
                                    /* light gray blur */
                                    color: #6c757d;
                                }
                            </style>
                        </div>

                        <div id="conditionalForm3" class="trlphdpostdoc_listview">
                            <div class="tables table-bordered w-100">
                                <!-- <div class="thead">
                                    <div class="tr">
                                        <div style="width:100%; margin-left:35%;"> <strong> S5 - Responses - Translational Research Panel <br />
                                                (Project Thesis Bachelor/Masters/PHD/Post-Doc) </strong> </div>
                                    </div>
                                </div> -->
                                <div class="tbody">
                                    <?php
                                    if (!empty($gettrlphdpostdocpost)) {
                                        $i = 1;
                                        foreach ($gettrlphdpostdocpost as $trlpost) { ?>

                                            <div class="mt-2" style="float: right;"> <strong> Date :</strong> <?= $trlpost['created_date'] ?> </div>
                                            <div class="tr">
                                                <div class="td1" style="width:80px !important;"> <?= $i++ ?> </div>
                                                <div class="td2">
                                                    <div class="table-resonsive col-md-6 UserProfileTable card" style="width:460px;">
                                                        <div>
                                                            <?php
                                                            $brickOwnerDetails = $this->CommonModal->getSingleRowById('freelancer', ['id' => $trlpost['user_id']]);
                                                            if (!empty($brickOwnerDetails)):
                                                            ?>
                                                                <div class="col-md-12 p-2" style="z-index:5;">
                                                                    <div onclick="window.location.href='<?= base_url('company/user_preview?id=' . $brickOwnerDetails['id']) ?>'" class="team-member-card">
                                                                        <img src="<?= !empty($brickOwnerDetails['user_image']) ? base_url() . 'uploads/user_profile/' . $brickOwnerDetails['user_image'] : base_url() . 'assets/user-icon.png' ?>" alt="Profile Picture">
                                                                        <div class="team-member-info">
                                                                            <h6><?= $brickOwnerDetails['name'] ?: 'No Name' ?></h6>
                                                                            <div><strong>Email:</strong> <a href="mailto:<?= $brickOwnerDetails['email'] ?: 'N/A' ?>" style="width:200px;"><?= $brickOwnerDetails['email'] ?: 'N/A' ?></a></div>
                                                                            <div><strong>Phone:</strong> <?= $brickOwnerDetails['phone'] ?: 'N/A' ?></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            <?php endif; ?>
                                                        </div>
                                                    </div>
                                                    <strong>Publisher Name:</strong> <?= $trlpost['publishername'] ?>
                                                    <hr>
                                                    <strong>Publisher Rating:</strong><?= $trlpost['publisherrating'] ?>
                                                </div>
                                                <div class="td1">
                                                    <strong>Published By Any Agency:</strong> <?= $trlpost['publishedbyanyagencylink'] ?>
                                                    <a href="<?= base_url('/' . $trlpost['by_anyagency']) ?>" title="View Docs" style="float:right;">
                                                        <i class="bi bi-eye-fill eye-icon"></i>
                                                    </a>
                                                    <hr>
                                                    <strong>Executive Summry:</strong> <?= $trlpost['executive_summary'] ?>
                                                    <a href="<?= base_url('/' . $trlpost['project_component']) ?>" title="View Docs" style="float:right;">
                                                        <i class="bi bi-eye-fill eye-icon"></i>
                                                    </a>

                                                </div>

                                                <div class="td1">
                                                    <strong>Core Documents:</strong> <?= $trlpost['core_documentslink'] ?>
                                                    <a href="<?= base_url('/' . $trlpost['core_documents']) ?>" title="View Docs" style="float:right;">
                                                        <i class="bi bi-eye-fill eye-icon"></i>
                                                    </a>
                                                    <hr>
                                                    <strong>Custome Index:</strong> <?= $trlpost['custom_indexlink'] ?>
                                                    <a href="<?= base_url('/' . $trlpost['custom_index']) ?>" title="View Docs" style="float:right;">
                                                        <i class="bi bi-eye-fill eye-icon"></i>
                                                    </a>
                                                </div>

                                                <div class="td1">
                                                    <strong>TRL Levels :</strong> <?= $trlpost['trl_levelslink'] ?>
                                                    <a href="<?= base_url('/' . $trlpost['trl_levels']) ?>" title="View Docs" style="float:right;">
                                                        <i class="bi bi-eye-fill eye-icon"></i>
                                                    </a>
                                                    <hr>
                                                    <strong>Calendar Basis Bricks :</strong> <?= $trlpost['calendar_basis_brickslinks'] ?>
                                                    <a href="<?= base_url('/' . $trlpost['calendar_basis_bricks']) ?>" title="View Docs" style="float:right;">
                                                        <i class="bi bi-eye-fill eye-icon"></i>
                                                    </a>
                                                </div>

                                                <div class="td1">
                                                    <strong> Project Thesis :</strong> <?= $trlpost['projectthesislinks'] ?>
                                                    <a href="<?= base_url('/' . $trlpost['project_thesis']) ?>" title="View Docs" style="float:right;">
                                                        <i class="bi bi-eye-fill eye-icon"></i>
                                                    </a>
                                                    <hr>
                                                </div>
                                                <div class="td1">
                                                    <strong>Cititation:</strong> <?= $trlpost['cititation'] ?>
                                                    <hr>
                                                    <strong>Biblography:</strong> <?= $trlpost['biblography'] ?>
                                                </div>
                                                <div class="td1" style="width:80px !important;">
                                                    <a href="<?= base_url('company/trlphdpostdoc?edit_id=' . $trlpost['id']) ?>" class="me-2">
                                                        <i class="bi bi-pencil"></i>
                                                    </a>
                                                    <a href="<?= base_url('company/trlphdpostdoc-trash?id=' . $trlpost['id']) ?>" title="Delete trlphdpostdoc" class="text-danger" onclick="return confirm('Are you sure you want to delete this trlphdpostdoc?');">
                                                        <i class="bi bi-trash"></i>
                                                    </a>
                                                </div>
                                            </div>

                                    <?php };
                                    } else {
                                        echo  ' <p class="text-center"> List Data Not Found! </p>';
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="">
                            <div class="tables table-bordered p-0" style="
                                    width: unset !important;
                                    padding-top: 25px !important;
                                    margin-top: 25px !important;
                                    border-top: 1px solid grey;
                                    border-radius: 1px;
                                ">
                                <div class="thead">
                                    <div class="tr border-0">
                                        <div class="card-body" style="text-align: center !important;">
                                            <div>
                                                <h4 class="mb-md-5 mb-3 text-center"> S8 - Technology Readiness Levels (TRLs) </h4>
                                            </div>

                                            <!-- Section Enabled Disable -->
                                            <div id="questionBox2" class="p-md-5 pt-md-3 pb-md-3 dotted-bottom ps-md-3" style="position:relative; border-left: 3px solid #7f1b54; border-right: 3px solid #7f1b54; border-bottom: 2px dotted #ccc;">
                                                <div class="d-flex align-items-center">
                                                    <label class="me-2">S<sub>8</sub> - <span style="font-size:12px; color:red;">*</span> Technology Readiness Levels (TRLs) </label>
                                                    <label class="switch me-2">
                                                        <input type="checkbox" class="enableSwitch" data-index="2" name="show_form_2" checked>
                                                        <span class="slider round"></span>
                                                    </label>
                                                    <span class="enableDisableLabel" data-index="1">Yes</span> <br />
                                                </div>
                                            </div>

                                        </div>
                                        <!-- <div style="text-align: center !important; margin-left:38%;"> <strong> S5 - Technology readiness levels (TRLs) </strong></div> -->
                                    </div>
                                </div>
                                <div id="conditionalForm2" style="display: block;">
                                    <form action="<?= base_url('/company/trllevelspost') ?>" method="post" enctype="multipart/form-data" id="trllevelform">
                                        <div class="tbody">
                                            <div class="tr">
                                                <div class="td2">
                                                    <div class="row p-0 m-0">
                                                        <div class="col-6">
                                                            <div class="position-relative">
                                                                <label class="mb-md-2">Select Company</label>
                                                                <select class="form-control" name="company_id" id="company_id">
                                                                    <?php if ($getCompanies) {
                                                                        foreach ($getCompanies as $company) { ?>
                                                                            <option value="<?= $company['id']; ?>" <?= (isset($rtls['company_id']) && $rtls['company_id'] == $company['id']) ? 'selected' : (set_value('company_id') == $company['id'] ? 'selected' : '') ?>><?= $company['company_name']; ?> (CIN: <?= $company['ciin_number']; ?>)</option>
                                                                    <?php }
                                                                    } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="position-relative">
                                                                <label class="mb-md-2">Select Project</label>
                                                                <select class="form-control" name="project_id" id="project_id">
                                                                    <option value="">Select Project</option>
                                                                </select>
                                                            </div>
                                                            <!-- Hidden input to store the pre-selected value from database -->
                                                            <input type="hidden" id="selected_project_id" value="<?= isset($rtls['project_id']) ? $rtls['project_id'] : ''; ?>">
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group mt-2">
                                                                <label class="mb-md-2"> Industry</label>
                                                                <select class="form-select" name="industry" required>
                                                                    <option value=""> Select </option>
                                                                    <option value="Analytics">Analytics</option>
                                                                    <option value="Advertising">Advertising</option>
                                                                    <option value="Architecture Interior Design">Architecture Interior Design</option>
                                                                    <option value="AR VR (Augmented + Virtual Reality)">AR VR (Augmented + Virtual Reality)</option>
                                                                    <option value="Automotive">Automotive</option>
                                                                    <option value="Art & Photography">Art & Photography</option>
                                                                    <option value="Animation">Animation</option>
                                                                    <option value="Chemicals">Chemicals</option>
                                                                    <option value="Computer Vision">Computer Vision</option>
                                                                    <option value="Telecommunication & Networking">Telecommunication & Networking</option>
                                                                    <option value="Construction">Construction</option>
                                                                    <option value="Agriculture">Agriculture</option>
                                                                    <option value="Aeronautics Aerospace & Defence">Aeronautics Aerospace & Defence</option>
                                                                    <option value="AI">AI</option>
                                                                    <option value="Green Technology">Green Technology</option>
                                                                    <option value="Events">Events</option>
                                                                    <option value="Fashion">Fashion</option>
                                                                    <option value="Finance Technology">Finance Technology</option>
                                                                    <option value="Enterprise Software">Enterprise Software</option>
                                                                    <option value="Food & Beverages">Food & Beverages</option>
                                                                    <option value="Design">Design</option>
                                                                    <option value="Dating Matrimonial">Dating Matrimonial</option>
                                                                    <option value="Education">Education</option>
                                                                    <option value="Renewable Energy">Renewable Energy</option>
                                                                    <option value="Technology Hardware">Technology Hardware</option>
                                                                    <option value="Healthcare & Lifesciences">Healthcare & Lifesciences</option>
                                                                    <option value="Internet of Things">Internet of Things</option>
                                                                    <option value="IT Services">IT Services</option>
                                                                    <option value="Human Resources">Human Resources</option>
                                                                    <option value="Marketing">Marketing</option>
                                                                    <option value="Nanotechnology">Nanotechnology</option>
                                                                    <option value="Non- Renewable Energy">Non- Renewable Energy</option>
                                                                    <option value="Pets & Animals">Pets & Animals</option>
                                                                    <option value="Media & Entertainment">Media & Entertainment</option>
                                                                    <option value="Retail">Retail</option>
                                                                    <option value="House-Hold Services">House-Hold Services</option>
                                                                    <option value="Professional & Commercial Services">Professional & Commercial Services</option>
                                                                    <option value="Sports">Sports</option>
                                                                    <option value="Social Impact">Social Impact</option>
                                                                    <option value="Social Network">Social Network</option>
                                                                    <option value="Textiles & Apparel">Textiles & Apparel</option>
                                                                    <option value="Indic Language Startups">Indic Language Startups</option>
                                                                    <option value="Transportation & Storage">Transportation & Storage</option>
                                                                    <option value="Logistics">Logistics</option>
                                                                    <option value="Travel & Tourism">Travel & Tourism</option>
                                                                    <option value="Security Solutions">Security Solutions</option>
                                                                    <option value="Airport Operations">Airport Operations</option>
                                                                    <option value="Real Estate">Real Estate</option>
                                                                    <option value="Other Specialty Retailers">Other Specialty Retailers</option>
                                                                    <option value="Safety">Safety</option>
                                                                    <option value="Robotics">Robotics</option>
                                                                    <option value="Passenger Experience">Passenger Experience</option>
                                                                    <option value="Biotechnology">Biotechnology</option>
                                                                    <option value="Waste Management">Waste Management</option>
                                                                    <option value="Others">Others</option>
                                                                    <option value="Toys and Games">Toys and Games</option>
                                                                    <option value="AIAR VR (Augmented + Virtual Reality)">AIAR VR (Augmented + Virtual Reality)</option>
                                                                    <option value="Robotics Technology">Robotics Technology</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <div class="form-group mt-2">
                                                                <label class="mb-md-2"> Sector </label>
                                                                <select class="form-select" name="sector" required>
                                                                    <option value=""> Select </option>
                                                                    <option value="Big Data">Big Data</option>
                                                                    <option value="Business Intelligence">Business Intelligence</option>
                                                                    <option value="Data Science">Data Science</option>
                                                                    <option value="Others">Others</option>
                                                                    <option value="AdTech">AdTech</option>
                                                                    <option value="Online Classified">Online Classified</option>
                                                                    <option value="Auto & Truck Manufacturers">Auto & Truck Manufacturers</option>
                                                                    <option value="Auto, Truck & Motorcycle Parts">Auto, Truck & Motorcycle Parts</option>
                                                                    <option value="Electric Vehicles">Electric Vehicles</option>
                                                                    <option value="Tires & Rubber Products">Tires & Rubber Products</option>
                                                                    <option value="Art">Art</option>
                                                                    <option value="Handicraft">Handicraft</option>
                                                                    <option value="Photography">Photography</option>
                                                                    <option value="Agricultural Chemicals">Agricultural Chemicals</option>
                                                                    <option value="Commodity Chemicals">Commodity Chemicals</option>
                                                                    <option value="Diversified Chemicals">Diversified Chemicals</option>
                                                                    <option value="Specialty Chemicals">Specialty Chemicals</option>
                                                                    <option value="Integrated Communication Services">Integrated Communication Services</option>
                                                                    <option value="Network Technology Solutions">Network Technology Solutions</option>
                                                                    <option value="Wireless">Wireless</option>
                                                                    <option value="Construction & Engineering">Construction & Engineering</option>
                                                                    <option value="Construction Materials">Construction Materials</option>
                                                                    <option value="Construction Supplies & Fixtures">Construction Supplies & Fixtures</option>
                                                                    <option value="Homebuilding">Homebuilding</option>
                                                                    <option value="New-age Construction Technologies">New-age Construction Technologies</option>
                                                                    <option value="Agri-Tech">Agri-Tech</option>
                                                                    <option value="Animal Husbandry">Animal Husbandry</option>
                                                                    <option value="Dairy Farming">Dairy Farming</option>
                                                                    <option value="Fisheries">Fisheries</option>
                                                                    <option value="Food Processing">Food Processing</option>
                                                                    <option value="Horticulture">Horticulture</option>
                                                                    <option value="Organic Agriculture">Organic Agriculture</option>
                                                                    <option value="Aviation & Others">Aviation & Others</option>
                                                                    <option value="Defence Equipment">Defence Equipment</option>
                                                                    <option value="Drones">Drones</option>
                                                                    <option value="Space Technology">Space Technology</option>
                                                                    <option value="Machine Learning">Machine Learning</option>
                                                                    <option value="NLP">NLP</option>
                                                                    <option value="Clean Tech">Clean Tech</option>
                                                                    <option value="Waste Management">Waste Management</option>
                                                                    <option value="Event Management">Event Management</option>
                                                                    <option value="Weddings">Weddings</option>
                                                                    <option value="Apparel">Apparel</option>
                                                                    <option value="Fan Merchandise">Fan Merchandise</option>
                                                                    <option value="Fashion Technology">Fashion Technology</option>
                                                                    <option value="Jewellery">Jewellery</option>
                                                                    <option value="Lifestyle">Lifestyle</option>
                                                                    <option value="Accounting">Accounting</option>
                                                                    <option value="Advisory">Advisory</option>
                                                                    <option value="Billing and Invoicing">Billing and Invoicing</option>
                                                                    <option value="Bitcoin and Blockchain">Bitcoin and Blockchain</option>
                                                                    <option value="Business Finance">Business Finance</option>
                                                                    <option value="Crowdfunding">Crowdfunding</option>
                                                                    <option value="Foreign Exchange">Foreign Exchange</option>
                                                                    <option value="Insurance">Insurance</option>
                                                                    <option value="Microfinance">Microfinance</option>
                                                                    <option value="Mobile wallets Payments">Mobile wallets Payments</option>
                                                                    <option value="P2P Lending">P2P Lending</option>
                                                                    <option value="Payment Platforms">Payment Platforms</option>
                                                                    <option value="Personal Finance">Personal Finance</option>
                                                                    <option value="Point of Sales">Point of Sales</option>
                                                                    <option value="Trading">Trading</option>
                                                                    <option value="CXM">CXM</option>
                                                                    <option value="Cloud">Cloud</option>
                                                                    <option value="Collaboration">Collaboration</option>
                                                                    <option value="Customer Support">Customer Support</option>
                                                                    <option value="ERP">ERP</option>
                                                                    <option value="Enterprise Mobility">Enterprise Mobility</option>
                                                                    <option value="Location Based">Location Based</option>
                                                                    <option value="SCM">SCM</option>
                                                                    <option value="Food Technology/Food Delivery">Food Technology/Food Delivery</option>
                                                                    <option value="Microbrewery">Microbrewery</option>
                                                                    <option value="Restaurants">Restaurants</option>
                                                                    <option value="Industrial Design">Industrial Design</option>
                                                                    <option value="Web Design">Web Design</option>
                                                                    <option value="Coaching">Coaching</option>
                                                                    <option value="E-learning">E-learning</option>
                                                                    <option value="Education Technology">Education Technology</option>
                                                                    <option value="Skill Development">Skill Development</option>
                                                                    <option value="Manufacture of Electrical Equipment">Manufacture of Electrical Equipment</option>
                                                                    <option value="Manufacture of Machinery and Equipment">Manufacture of Machinery and Equipment</option>
                                                                    <option value="Renewable Energy Solutions">Renewable Energy Solutions</option>
                                                                    <option value="Renewable Nuclear Energy">Renewable Nuclear Energy</option>
                                                                    <option value="Renewable Solar Energy">Renewable Solar Energy</option>
                                                                    <option value="Renewable Wind Energy">Renewable Wind Energy</option>
                                                                    <option value="3d printing">3d printing</option>
                                                                    <option value="Electronics">Electronics</option>
                                                                    <option value="Embedded">Embedded</option>
                                                                    <option value="Manufacturing">Manufacturing</option>
                                                                    <option value="Semiconductor">Semiconductor</option>
                                                                    <option value="Biotechnology">Biotechnology</option>
                                                                    <option value="Health & Wellness">Health & Wellness</option>
                                                                    <option value="Healthcare IT">Healthcare IT</option>
                                                                    <option value="Healthcare Services">Healthcare Services</option>
                                                                    <option value="Healthcare Technology">Healthcare Technology</option>
                                                                    <option value="Medical Devices Biomedical">Medical Devices Biomedical</option>
                                                                    <option value="Pharmaceutical">Pharmaceutical</option>
                                                                    <option value="Manufacturing & Warehouse">Manufacturing & Warehouse</option>
                                                                    <option value="Smart Home">Smart Home</option>
                                                                    <option value="Wearables">Wearables</option>
                                                                    <option value="Application Development">Application Development</option>
                                                                    <option value="BPO">BPO</option>
                                                                    <option value="IT Consulting">IT Consulting</option>
                                                                    <option value="IT Management">IT Management</option>
                                                                    <option value="KPO">KPO</option>
                                                                    <option value="Product Development">Product Development</option>
                                                                    <option value="Project Management">Project Management</option>
                                                                    <option value="Testing">Testing</option>
                                                                    <option value="Web Development">Web Development</option>
                                                                    <option value="Internships">Internships</option>
                                                                    <option value="Recruitment Jobs">Recruitment Jobs</option>
                                                                    <option value="Skills Assessment">Skills Assessment</option>
                                                                    <option value="Talent Management">Talent Management</option>
                                                                    <option value="Training">Training</option>
                                                                    <option value="Branding">Branding</option>
                                                                    <option value="Digital Marketing (SEO Automation)">Digital Marketing (SEO Automation)</option>
                                                                    <option value="Discovery">Discovery</option>
                                                                    <option value="Loyalty">Loyalty</option>
                                                                    <option value="Market Research">Market Research</option>
                                                                    <option value="Sales">Sales</option>
                                                                    <option value="Oil & Gas Drilling">Oil & Gas Drilling</option>
                                                                    <option value="Oil & Gas Exploration and Production">Oil & Gas Exploration and Production</option>
                                                                    <option value="Oil & Gas Transportation Services">Oil & Gas Transportation Services</option>
                                                                    <option value="Oil Related Services and Equipment">Oil Related Services and Equipment</option>
                                                                    <option value="Digital Media">Digital Media</option>
                                                                    <option value="Digital Media Blogging">Digital Media Blogging</option>
                                                                    <option value="Digital Media News">Digital Media News</option>
                                                                    <option value="Digital Media Publishing">Digital Media Publishing</option>
                                                                    <option value="Digital Media Video">Digital Media Video</option>
                                                                    <option value="Entertainment">Entertainment</option>
                                                                    <option value="Movies">Movies</option>
                                                                    <option value="OOH Media">OOH Media</option>
                                                                    <option value="Social Media">Social Media</option>
                                                                    <option value="Comparison Shopping">Comparison Shopping</option>
                                                                    <option value="Retail Technology">Retail Technology</option>
                                                                    <option value="Social Commerce">Social Commerce</option>
                                                                    <option value="Baby Care">Baby Care</option>
                                                                    <option value="Home Care">Home Care</option>
                                                                    <option value="Laundry">Laundry</option>
                                                                    <option value="Personal Care">Personal Care</option>
                                                                    <option value="Business Support Services">Business Support Services</option>
                                                                    <option value="Business Support Supplies">Business Support Supplies</option>
                                                                    <option value="Commercial Printing Services">Commercial Printing Services</option>
                                                                    <option value="Employment Services">Employment Services</option>
                                                                    <option value="Environmental Services & Equipment">Environmental Services & Equipment</option>
                                                                    <option value="Professional Information Services">Professional Information Services</option>
                                                                    <option value="Fantasy Sports">Fantasy Sports</option>
                                                                    <option value="Sports Promotion and Networking">Sports Promotion and Networking</option>
                                                                    <option value="Corporate Social Responsibility">Corporate Social Responsibility</option>
                                                                    <option value="NGO">NGO</option>
                                                                    <option value="Apparel & Accessories">Apparel & Accessories</option>
                                                                    <option value="Leather Footwear">Leather Footwear</option>
                                                                    <option value="Leather Textiles Goods">Leather Textiles Goods</option>
                                                                    <option value="Non- Leather Footwear">Non- Leather Footwear</option>
                                                                    <option value="Non- Leather Textiles Goods">Non- Leather Textiles Goods</option>
                                                                    <option value="E-Commerce">E-Commerce</option>
                                                                    <option value="Education">Education</option>
                                                                    <option value="Media and Entertainment">Media and Entertainment</option>
                                                                    <option value="Natural Language Processing">Natural Language Processing</option>
                                                                    <option value="Utility Services">Utility Services</option>
                                                                    <option value="Freight & Logistics Services">Freight & Logistics Services</option>
                                                                    <option value="Passenger Transportation Services">Passenger Transportation Services</option>
                                                                    <option value="Traffic Management">Traffic Management</option>
                                                                    <option value="Transport Infrastructure">Transport Infrastructure</option>
                                                                    <option value="Experiential Travel">Experiential Travel</option>
                                                                    <option value="Facility Management">Facility Management</option>
                                                                    <option value="Holiday Rentals">Holiday Rentals</option>
                                                                    <option value="Hospitality">Hospitality</option>
                                                                    <option value="Hotel">Hotel</option>
                                                                    <option value="Ticketing">Ticketing</option>
                                                                    <option value="Wayside Amenities">Wayside Amenities</option>
                                                                    <option value="Cyber Security">Cyber Security</option>
                                                                    <option value="Home Security solutions">Home Security solutions</option>
                                                                    <option value="Public Citizen Security Solutions">Public Citizen Security Solutions</option>
                                                                    <option value="Coworking Spaces">Coworking Spaces</option>
                                                                    <option value="Housing">Housing</option>
                                                                    <option value="Auto Vehicles, Parts & Service Retailers">Auto Vehicles, Parts & Service Retailers</option>
                                                                    <option value="Computer & Electronics Retailers">Computer & Electronics Retailers</option>
                                                                    <option value="Home Furnishings Retailers">Home Furnishings Retailers</option>
                                                                    <option value="Home Improvement Products & Services Retailers">Home Improvement Products & Services Retailers</option>
                                                                    <option value="Personal Security">Personal Security</option>
                                                                    <option value="Robotics Application">Robotics Application</option>
                                                                    <option value="Robotics Technology">Robotics Technology</option>
                                                                    <option value="Physical Toys and Games">Physical Toys and Games</option>
                                                                    <option value="Virtual Games">Virtual Games</option>
                                                                    <option value="Agnostic Sector">Agnostic Sector</option>
                                                                    <option value="Deep Tech">Deep Tech</option>
                                                                    <option value="Smart City">Smart City</option>
                                                                    <option value="Blockchain">Blockchain</option>
                                                                    <option value="Digital Health">Digital Health</option>
                                                                    <option value="Water and Sanitation">Water and Sanitation</option>
                                                                    <option value="Circular Economy">Circular Economy</option>
                                                                    <option value="Technology">Technology</option>
                                                                    <option value="FMCG">FMCG</option>
                                                                    <option value="Data Analysis">Data Analysis</option>
                                                                    <option value="IOT">IOT</option>
                                                                    <option value="Legal-Tech">Legal-Tech</option>
                                                                    <option value="Unmanned Aerial Vehicles">Unmanned Aerial Vehicles</option>
                                                                    <option value="Infrastructure">Infrastructure</option>
                                                                    <option value="Edge Computing">Edge Computing</option>
                                                                    <option value="Child protection">Child protection</option>
                                                                    <option value="Sustainable Blue Economy">Sustainable Blue Economy</option>
                                                                    <option value="Ocean Engineering">Ocean Engineering</option>
                                                                    <option value="Marine Tourism">Marine Tourism</option>
                                                                    <option value="Coastal Protection">Coastal Protection</option>
                                                                    <option value="Ships and Ports Infrastructure">Ships and Ports Infrastructure</option>
                                                                    <option value="Manufacturing and Allied Engineering Sectors">Manufacturing and Allied Engineering Sectors</option>
                                                                    <option value="Assistive Technology">Assistive Technology</option>
                                                                    <option value="Assistance Technology">Assistance Technology</option>
                                                                    <option value="IOT Machine Learning">IOT Machine Learning</option>
                                                                    <option value="Smart Home Space Technology Wearables">
                                                                        Smart Home Space Technology Wearables
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="td1" style="width:100px;">
                                                    <label class="mb-md-2"> Level 1 </label>
                                                    <select class="form-select" name="level" id="level" required>
                                                        <option value="">-- Select --</option>
                                                        <?php for ($i = 1; $i <= 10; $i++) { ?>
                                                            <option value="<?= $i ?>"><?= $i ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="mt-2">
                                                        <label class="mb-md-2 mt-2"> Title </label>
                                                        <input type="text" placeholder="Enter Title" name="title" class="form-control" maxlength="300">
                                                    </div>
                                                </div>
                                                <div class="td1">
                                                    <label class="mb-md-2"> Sub Levels/Categories </label>
                                                    <select class="form-select" name="sublevel" id="sublevel" required>
                                                        <option value="">-- Select --</option>
                                                        <?php for ($i = 1; $i <= 100; $i++) { ?>
                                                            <option value="<?= $i ?>"><?= $i ?></option>
                                                        <?php } ?>
                                                    </select>
                                                    <div class="mt-2">
                                                        <label class="mb-md-2">Title</label>
                                                        <input type="text" placeholder="Enter Title" name="subtitle" class="form-control" maxlength="300">
                                                    </div>
                                                </div>
                                                <div class="td1">
                                                    <div class="form-group mb-2">
                                                        <label class="mb-md-2"> Budgeted (Projected) </label>
                                                        <input type="text" class="form-control" placeholder="Budgeted" name="budgeted">
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label class="mb-md-2"> Timeline </label>
                                                        <input type="text" class="form-control" placeholder="Budgetd Timeline" name="budgetdtimeline">
                                                    </div>
                                                </div>
                                                <div class="td1">
                                                    <div class="form-group mb-2">
                                                        <label class="mb-md-2"> Expenditure (As per actuals) </label>
                                                        <input type="text" class="form-control" placeholder="Expenditure" name="expenditure">
                                                    </div>
                                                    <div class="form-group mt-2">
                                                        <label class="mb-md-2"> Timeline </label>
                                                        <input type="text" class="form-control" placeholder="Expenditure Timeline" name="expendituretimeline">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tr">
                                                <div class="td2">
                                                    <div class="form-group my-2">
                                                        <label class="mb-md-2"> Docs Link </label>
                                                        <input type="text" class="form-control" placeholder="Docs Link" name="docslink">
                                                    </div>
                                                </div>
                                                <div class="td2">
                                                    <div class="form-group my-2">
                                                        <label class="mb-md-2"> Excel Link </label>
                                                        <input type="text" class="form-control" placeholder="Excel Link" name="excellink">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tr">
                                                <div class="td2" style="width:100% !important;">
                                                    <div class="form-group my-2">
                                                        <label class="mb-md-2"> Description </label>
                                                        <textarea class="form-control" placeholder="Description/Remark/Note" name="description"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tr">
                                            <div class="text-center" style="padding-left:0%; padding-top:10px; padding-bottom:10px;">
                                                <button type="submit" class="btn bg-primary text-white"> Submit </button>
                                            </div>
                                        </div>
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="card-body mx-4 mt-4">
                        <div>
                            <h4 class="mb-md-5 mb-3 text-center">S8 - Responses - Technology Readiness Levels (TRLs) </h4>
                        </div>

                        <!-- Section Enabled Disable -->
                        <div id="questionBox4" class="p-md-5 pt-md-3 pb-md-3 dotted-bottom ps-md-3" style="position:relative; border-left: 3px solid #7f1b54; border-right: 3px solid #7f1b54; border-bottom: 2px dotted #ccc;">
                            <div class="d-flex align-items-center">
                                <label class="me-2">S<sub>8</sub> - <span style="font-size:12px; color:red;">*</span> Technology Readiness Levels (TRLs) </label>
                                <label class="switch me-2">
                                    <input type="checkbox" class="enableSwitch" data-index="4" name="show_res_2" checked>
                                    <span class="slider round"></span>
                                </label>
                                <span class="enableDisableLabel" data-index="1">Yes</span> <br />
                            </div>
                            <label> (Project Thesis Bachelor/Masters/PHD/Post-Doc) </label>
                        </div>
                        <style>
                            select:disabled {
                                background-color: #e9ecef;
                                /* light gray blur */
                                color: #6c757d;
                            }
                        </style>
                    </div>

                    <div id="conditionalForm4" class="trllevels_listview w-100">
                        <div class="tables table-bordered w-100">
                            <!-- <div class="thead">
                                <div class="tr">
                                    <div style="width:100%; margin-left:35%;"> <strong> S6 - Responses - Technology Readiness Levels (TRLs) </strong> </div>
                                </div>
                            </div> -->
                            <div class="tbody">
                                <?php
                                if (!empty($gettrllevels)) {
                                    $i = 1;
                                    foreach ($gettrllevels as $trllevels) {
                                        $company = $this->CommonModal->getSingleRowById('tbl_companies', ['id' => $trllevels['company_id']]);
                                        $project = $this->CommonModal->getSingleRowById('tbl_projects', ['id' => $trllevels['project_id']]);
                                ?>

                                        <div class="mt-2" style="float: right;"> <strong> Date :</strong> <?= $trllevels['created_date'] ?> </div>
                                        <div class="tr">
                                            <div class="td1" style="width:80px !important;"> <?= $i++ ?> </div>
                                            <div class="td2">
                                                <div class="table-resonsive col-md-6 UserProfileTable card mb-0" style="width:460px;">
                                                    <div>
                                                        <?php
                                                        $brickOwnerDetails = $this->CommonModal->getSingleRowById('freelancer', ['id' => $trllevels['user_id']]);
                                                        if (!empty($brickOwnerDetails)):
                                                        ?>
                                                            <div class="col-md-12 p-2" style="z-index:5;">
                                                                <div onclick="window.location.href='<?= base_url('company/user_preview?id=' . $brickOwnerDetails['id']) ?>'" class="team-member-card">
                                                                    <img src="<?= !empty($brickOwnerDetails['user_image']) ? base_url() . 'uploads/user_profile/' . $brickOwnerDetails['user_image'] : base_url() . 'assets/user-icon.png' ?>" alt="Profile Picture">
                                                                    <div class="team-member-info">
                                                                        <h6><?= $brickOwnerDetails['name'] ?: 'No Name' ?></h6>
                                                                        <div><strong>Email:</strong> <a href="mailto:<?= $brickOwnerDetails['email'] ?: 'N/A' ?>" style="width:200px;"><?= $brickOwnerDetails['email'] ?: 'N/A' ?></a></div>
                                                                        <div><strong>Phone:</strong> <?= $brickOwnerDetails['phone'] ?: 'N/A' ?></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                                <hr />
                                                <div> <strong>Description:</strong> <?= $trllevels['description'] ?> </div>
                                            </div>
                                            <div class="td1">
                                                <div> <strong>Company:</strong> <?= $company['company_name'] ?> </div>
                                                <hr />
                                                <div> <strong>Project:</strong> <?= $project['project_name'] ?> </div>
                                                <hr />
                                                <div> <strong>Industry:</strong> <?= $trllevels['industry'] ?> </div>
                                                <hr />
                                                <div> <strong>Sector:</strong> <?= $trllevels['sector'] ?> </div>
                                            </div>

                                            <div class="td1">
                                                <div> <strong>Level:</strong> <?= $trllevels['level'] ?> </div>
                                                <div> <strong>Title:</strong> <?= $trllevels['title'] ?> </div>
                                                <hr />
                                                <div> <strong>Sub Level:</strong> <?= $trllevels['sublevel'] ?> </div>
                                                <div> <strong>Sub Title:</strong> <?= $trllevels['subtitle'] ?> </div>
                                                <hr />
                                                <div> <strong>Budgeted:</strong> <?= $trllevels['budgeted'] ?> </div>
                                                <div> <strong>Budgeted Timeline:</strong> <?= $trllevels['budgetdtimeline'] ?> </div>
                                                <hr />
                                                <div> <strong>Expenditure:</strong> <?= $trllevels['expenditure'] ?> </div>
                                                <div> <strong>Expenditure Timeline:</strong> <?= $trllevels['expendituretimeline'] ?> </div>
                                            </div>

                                            <div class="td1">
                                                <div> <strong>Docs Link:</strong>
                                                    <a href="<?= $trllevels['docslink'] ?>" target="_blank" title="View Docs" style="float:right;">
                                                        <i class="bi bi-eye-fill eye-icon"></i>
                                                    </a>
                                                    <hr>
                                                </div>
                                                <div> <strong>Excel Link:</strong>
                                                    <a href="<?= $trllevels['excellink'] ?>" target="_blank" title="View Docs" style="float:right;">
                                                        <i class="bi bi-eye-fill eye-icon"></i>
                                                    </a>
                                                </div>
                                            </div>

                                            <div class="td1" style="width:80px !important;">
                                                <a href="<?= base_url('company/trllevel-edit?edit_id=' . $trllevels['id']) ?>" class="me-2">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <a href="<?= base_url('company/trllevels-trash?id=' . $trllevels['id']) ?>" title="Delete trllevel" class="text-danger" onclick="return confirm('Are you sure you want to delete this trllevel?');">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </div>
                                        </div>

                                <?php };
                                } else {
                                    echo  ' <p class="text-center"> List Data Not Found! </p>';
                                }
                                ?>
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
<script>
    // Toggle section visibility
    document.querySelectorAll('.enableSwitch').forEach((switchElement) => {
        switchElement.addEventListener('change', function() {
            const index = this.getAttribute('data-index');
            const label = document.querySelector('.enableDisableLabel[data-index="' + index + '"]');
            const form = document.getElementById('conditionalForm' + index);
            const questionBox = document.getElementById('questionBox' + index);
            if (this.checked) {
                form.style.display = 'block';
                questionBox.style.borderBottom = 'none';
                label.textContent = 'Yes';
            } else {
                form.style.display = 'none';
                questionBox.style.borderBottom = '2px dotted #ccc';
                label.textContent = 'No';
            }
        });
    });

    // Initialize tooltips
    document.addEventListener('DOMContentLoaded', function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.forEach(function(tooltipTriggerEl) {
            new bootstrap.Tooltip(tooltipTriggerEl);
        });
    });
</script>




<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>

<script>
    $(document).ready(function() {

        var input = document.querySelector('input[name=filter_skills]');
        new Tagify(input);
        // Fetch projects based on company_id
        function fetchProjects(companyId) {
            console.log("Fetching projects");

            // Get preselected project ID (from hidden input)
            const selectedProjectId = $('#selected_project_id').val();

            $.ajax({
                url: '<?= base_url('Home/fetchProjectsForBricks') ?>',
                type: 'POST',
                data: {
                    company_id: companyId
                },
                dataType: 'json',
                success: function(response) {
                    console.log("response", response);
                    $('#project_id').empty();
                    $('#project_id').append('<option value="">Select a project</option>');

                    if (response.success && response.projects.length > 0) {
                        $.each(response.projects, function(index, project) {
                            // Check if this project should be selected
                            const selected = (project.id == selectedProjectId) ? 'selected' : '';
                            $('#project_id').append(
                                '<option value="' + project.id + '" ' + selected + '>' + project.project_name + '</option>'
                            );
                        });
                    } else {
                        $('#project_id').append('<option value="">No projects found</option>');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error: ' + error);
                    $('#project_id').empty();
                    $('#project_id').append('<option value="">Error fetching projects</option>');
                }
            });
        }


        $('#company_id').on('change', function() {
            var companyId = $(this).val();
            if (companyId) {
                fetchProjects(companyId);
            } else {
                $('#project_id').empty();
                $('#project_id').append('<option value="">Select a project</option>');
            }
        });

        if ($('#company_id').val()) {
            fetchProjects($('#company_id').val());
        }
    });
</script>
<!-- AJAX REQUEST FOR Form 2 SUBMISSION  -->
<script>
    $(document).ready(function() {
        $('#trllevelform').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: $(this).serialize(),
                dataType: "json", // ✅ important
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        if (response.redirect_url) {
                            window.location.href = response.redirect_url;
                        }
                    } else {
                        alert("Error: " + (response.message || response.errors));
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Form submission error:", error);
                }
            });
        });
    });
</script>
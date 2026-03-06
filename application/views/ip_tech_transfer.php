<?php $this->load->view('includes/header'); ?>

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
        width: 95% !important;
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
        border: 1px solid grey;
    }

    .tables .thead .tr .th1 {
        width: 35% !important;
        border-left: 1px solid grey;
        padding: 5px !important;
        font-weight: 700;
    }

    .tables .thead .tr .th2 {
        width: 65% !important;
        border-left: 1px solid grey;
        padding: 5px !important;
        font-weight: 700;
    }

    .tables .tbody {
        width: 100% !important;
    }

    .tables .tbody .tr {
        width: 100% !important;
        display: flex;
        border: 1px solid grey;
        margin-top: 5px;
    }

    .tables .tbody .tr .td1 {
        width: 35% !important;
        border-left: 1px solid grey;
        padding: 5px !important;
    }

    .tables .tbody .tr .td2 {
        width: 65% !important;
        border-left: 1px solid grey;
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

<!-- Shiv Web Developer  -->
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body pt-0 mt-5">
    <div class="py-3" style="background-color: #f0f4f7;">
        <h4 class="mb-md-5 mb-3 text-center "> S5 - Global Intellectual Property & Tech Transfer! </h4>
        <!-- Section Enabled Disable -->
        <div id="questionBox1" class="p-md-5 mx-3 pt-md-3 pb-md-3 dotted-bottom ps-md-3" style="position:relative; border-left: 3px solid #7f1b54; border-right: 3px solid #7f1b54; border-bottom: 2px dotted #ccc;">
            <div class="d-flex align-items-center">
                <label class="me-2">S<sub>5</sub> - <span style="font-size:12px; color:red;">*</span> IP & Tech Transfer </label>
                <label class="switch me-2">
                    <input type="checkbox" class="enableSwitch" data-index="1" name="show_form_1" checked>
                    <span class="slider round"></span>
                </label>
                <span class="enableDisableLabel" data-index="1">Yes</span> <br />
            </div>
        </div>
        <style>
            select:disabled {
                background-color: #e9ecef;
                /* light gray blur */
                color: #6c757d;
            }
        </style>
    </div>
    <div id="conditionalForm1" class="ms-4" style="display: block; border:1px solid black; margin-right:100px;">
        <form method="POST" class="flex flex-col gap-4" enctype="multipart/form-data">
            <div class="bg-white d-flex gap-3 mt-md-3">

                <!-- <p> IP Merger & Acquisition Platform : 1. <br> (1.1) Country DropDown with Default ( Worldwide & then all 193 country list ) <br>
                    (1.2) Write you IP Number - Title <br>
                    (1.3) Status - Pending, Granted. <br>
                    (1.4) Dates - <br>
                    1. Filing Date , <br>
                    2. Published date, <br>
                    3. Granted date , <br>
                    4. Expiry Date. <br>
                    (1.5) <br> 1. Record Human Token ID which Shared IP number. <br>
                    2. Only IP Owners can do that. 3. Terms & Condition Agreement - Laws binding authority approved by both party. <br>
                    4. Bid with Time limit. <br>
                    Example - 1. India 2. 201921036523 - Title 3. Granted 3. 2020 4. 2021 5. 2024 6. Shubham Shah - View Full Profile Option. 7. 60 Words Description. 8. Price Range 9. Total Potential Market number - XYZ Apply For Joint Bidding. Send your Terms & Condition. </p> -->
                <div class="row mt-md-0 mb-md-0  pb-md-0 align-items-start">
                    <div class="col-md-3 mb-3 mt-md-0">
                        <label for="project_component" class="form-label d-flex align-items-center gap-2">
                            Select Country
                        </label>
                        <select class="form-select" name="country">
                            <option value="">Select Country</option>
                            <option value="worldwide"
                                <?php
                                // If edit mode → match saved value
                                if (!empty($editData) && $editData['country'] == 'worldwide') {
                                    echo 'selected';
                                }
                                // If NOT edit mode → default select Worldwide
                                else if (empty($editData)) {
                                    echo 'selected';
                                }
                                ?>>
                                Worldwide
                            </option>

                            <?php if ($getCountries) {
                                foreach ($getCountries as $country) {

                                    // Selected for edit mode
                                    $selected = (!empty($editData) && $editData['country'] == $country['name'])
                                        ? 'selected'
                                        : '';
                            ?>
                                    <option value="<?= $country['name'] ?>" <?= $selected ?>>
                                        <?= $country['name'] ?>
                                    </option>
                            <?php }
                            } ?>
                        </select>


                    </div>
                    <div class="col-md-3 mb-3 mt-md-0">
                        <label for="ipnumber" class="form-label d-flex align-items-center gap-2">
                            Write your IP Number
                        </label>
                        <input type="text" class="form-control" value="<?= !empty($editData) ? $editData['ipnumber'] : '' ?>" placeholder="IP Number" name="ipnumber" id="ipnumber" required>
                    </div>
                    <div class="col-md-3 mb-4 mt-md-0">
                        <label class="px-2"> Title </label>
                        <input type="text" class="form-control" required name="title" value="<?= !empty($editData) ? $editData['title'] : '' ?>" placeholder="Enter Title">
                    </div>
                    <div class="mb-3 col-md-3">
                        <label for="status" class="form-label d-flex align-items-center gap-2">
                            Status
                        </label>

                        <select class="form-select" name="status">
                            <option value="Pending"
                                <?= (!empty($editData) && $editData['status'] == 'Pending') ? 'selected' : '' ?>>
                                Pending
                            </option>

                            <option value="Granted"
                                <?= (!empty($editData) && $editData['status'] == 'Granted') ? 'selected' : '' ?>>
                                Granted
                            </option>
                        </select>
                    </div>

                    <div class="mb-3 col-md-3">
                        <div class="form-group">
                            <label class="mb-md-2">Filing Date </label>
                            <input type="datetime-local" name="fillingdate" id="datetime-local" value="<?= !empty($editData) ? $editData['fillingdate'] : '' ?>" class="form-control" placeholder="Filling Date & Time" />
                        </div>
                    </div>
                    <div class="mb-3 col-md-3">
                        <div class="form-group">
                            <label class="mb-md-2">Published Date </label>
                            <input type="datetime-local" name="publisheddate" id="datetime-local" value="<?= !empty($editData) ? $editData['publisheddate'] : '' ?>" class="form-control" placeholder="Published Date & Time" />
                        </div>
                    </div>
                    <div class="mb-3 col-md-3">
                        <div class="form-group">
                            <label class="mb-md-2">Granted Date </label>
                            <input type="datetime-local" name="granteddate" id="datetime-local" value="<?= !empty($editData) ? $editData['granteddate'] : '' ?>" class="form-control" placeholder="Granted Date & Time" />
                        </div>
                    </div>
                    <div class="mb-3 col-md-3">
                        <div class="form-group">
                            <label class="mb-md-2">Expiry Date </label>
                            <input type="datetime-local" name="expirydate" id="datetime-local" value="<?= !empty($editData) ? $editData['expirydate'] : '' ?>" class="form-control" placeholder="Expiry Date & Time" />
                        </div>
                    </div>

                    <div class="mb-3 col-md-3">
                        <label class="form-label">Record Human Token ID which Shared IP number.</label>
                        <input type="text" class="form-control" name="humantoken" id="humantoken" value="<?= !empty($getProfile['humontoken']) ? $getProfile['humontoken'] : '' ?>" placeholder="Human Token" required>
                    </div>

                    <div class="mb-3 col-md-3">
                        <label class="form-label"> Price Range </label>
                        <div class="d-flex">
                            <div class="form-group" style="width:48%;">
                                <!-- <label>Min - Range</label> -->
                                <input type="text" class="form-control" name="priceminrange" id="priceminrange" value="<?= !empty($editData) ? $editData['priceminrange'] : '' ?>" placeholder="Min Price Range" required>
                            </div>
                            <p class="mt-2">-</p>
                            <div class="form-group" style="width:48%;">
                                <!-- <label>Max - Range</label> -->
                                <input type="text" class="form-control" name="pricemaxrange" id="pricemaxrange" value="<?= !empty($editData) ? $editData['pricemaxrange'] : '' ?>" placeholder="Max Price Range" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3 col-md-3">
                        <label class="form-label"> Total Potential Market (TAM) </label>
                        <input type="text" class="form-control" name="potentialmarket" value="<?= !empty($editData) ? $editData['potentialmarket'] : '' ?>" placeholder="Potential Market" id="potentialmarket" required>
                    </div>
                    <div class="mb-3 col-md-3">
                        <label class="form-label"> Terms & Condition Agreement - Laws binding authority approved by both party. </label>
                        <input type="file" class="form-control" name="agreement" placeholder="upload agreement" id="agreement">
                        <?php if (!empty($editData)) { ?>
                            <input type="hidden" name="old_agreement" value="<?= $editData['agreement'] ?>">
                        <?php } ?>
                        <input type="text" class="form-control" name="agreementlink" value="<?= !empty($editData) ? $editData['agreementlink'] : '' ?>" placeholder="Agreement Link" id="agreementlink" required>

                    </div>

                    <div class="mb-3 col-md-4">
                        <label class="form-label">Description (Max-60 Words) </label>
                        <textarea class="form-control" name="description" placeholder="Description"><?= !empty($editData) ? $editData['description'] : '' ?></textarea>
                    </div>
                    <div class="mb-3 col-md-2">
                        <div class="text-center mt-5">
                            <button type="submit" class="btn btn-primary bg-primary text-white px-5"> <?= isset($editData['id']) ? 'Update' : 'Submit' ?> </button>
                        </div>
                    </div>
                </div>

            </div>
            </from>
            <hr />
    </div>

    <div class="py-3 mt-5" style="background-color: #f0f4f7;">
        <h4 class="mb-md-5 mb-3 text-center "> S5 - IP & Tech Transfer Responses! </h4>
        <!-- Section Enabled Disable -->
        <div id="questionBox2" class="p-md-5 mx-3 pt-md-3 pb-md-3 dotted-bottom ps-md-3" style="position:relative; border-left: 3px solid #7f1b54; border-right: 3px solid #7f1b54; border-bottom: 2px dotted #ccc;">
            <div class="d-flex align-items-center">
                <label class="me-2">S<sub>5</sub> - <span style="font-size:12px; color:red;">*</span> IP & Tech Transfer </label>
                <label class="switch me-2">
                    <input type="checkbox" class="enableSwitch" data-index="2" name="show_form_2" checked>
                    <span class="slider round"></span>
                </label>
                <span class="enableDisableLabel" data-index="2">Yes</span> <br />
            </div>
        </div>
        <style>
            select:disabled {
                background-color: #e9ecef;
                /* light gray blur */
                color: #6c757d;
            }
        </style>
    </div>
    <div id="conditionalForm2">
        <div class="trllevels_listview">
            <div class="tables table-bordered w-100">
                <!-- <div class="thead">
                    <div class="tr">
                        <div style="width:100%; margin-left:45%;"> <strong> S7 - IP & Tech Transfer! </strong> </div>
                    </div>
                </div> -->
                <div class="tbody">
                    <?php
                    if (!empty($getIpTechTransfer)) {
                        $i = 1;
                        foreach ($getIpTechTransfer as $ipData) {
                    ?>
                            <div class="mt-2" style="float: right;"> <strong> Date :</strong> <?= $ipData['created_date'] ?> </div>
                            <div class="tr">
                                <div class="td1" style="width:80px !important;"> <?= $i++ ?> </div>
                                <div class="td2">
                                    <div class="table-resonsive col-md-6 UserProfileTable card mb-0" style="width:460px;">
                                        <div>
                                            <?php
                                            $brickOwnerDetails = $this->CommonModal->getSingleRowById('freelancer', ['id' => $ipData['user_id']]);
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
                                    <div> <strong>Human Token:</strong> <?= $ipData['humantoken'] ?> </div>
                                    <div> <strong>Title:</strong> <?= $ipData['title'] ?> </div>
                                    <div> <strong>Description:</strong> <?= $ipData['description'] ?> </div>
                                </div>
                                <div class="td1">
                                    <div> <strong>Country:</strong> <?= $ipData['country'] ?> </div>
                                    <div> <strong>IP Number:</strong> <br /> <?= $ipData['ipnumber'] ?> </div>
                                    <div> <strong>Status:</strong> <?= $ipData['status'] ?> </div>
                                </div>
                                <div class="td1">
                                    <div> <strong>Price Range:</strong> <br /> <?= $ipData['priceminrange'] . '-' . $ipData['pricemaxrange']  ?> </div>
                                    <div> <strong>Potential Market:</strong> <?= $ipData['potentialmarket'] ?> </div>
                                </div>

                                <div class="td1">
                                    <div> <strong>Filling Date:</strong> <br /><?= $ipData['fillingdate'] ?> </div>
                                    <div> <strong>Published Date:</strong> <br /><?= $ipData['publisheddate'] ?> </div>
                                    <div> <strong>Granted Date:</strong><br /> <?= $ipData['granteddate'] ?> </div>
                                    <div> <strong>Expiry Date:</strong> <br /><?= $ipData['expirydate'] ?> </div>
                                </div>
                                <div class="td1">
                                    <div> <strong>Status:</strong> <?= $ipData['iptech_status'] ?> </div>
                                    <div> <strong>Agreement File:</strong>
                                        <a href="<?= base_url('/') . $ipData['agreement'] ?>" target="_blank" title="View Docs" style="float:right;">
                                            <i class="bi bi-eye-fill eye-icon"></i>
                                        </a>
                                    </div>
                                    <div> <strong>Link:</strong>
                                        <a href="<?= $ipData['agreementlink'] ?>" target="_blank" title="View Docs" style="float:right;">
                                            <i class="bi bi-eye-fill eye-icon"></i>
                                        </a>
                                    </div>
                                </div>

                                <div class="td1" style="width:80px !important;">

                                    <a href="<?= base_url('company/ip-and-tech-transfer?edit_id=' . $ipData['id']) ?>" class="me-2">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <a href="<?= base_url('company/ip-tech-transfer-trash?id=' . $ipData['id']) ?>" title="Delete ip Tech Transfer" class="text-danger" onclick="return confirm('Are you sure you want to delete this ip Tech Transfer?');">
                                        <i class="bi bi-trash"></i>
                                    </a>
                                </div>
                            </div>

                    <?php };
                    } else {
                        echo  ' <p class="text-center"> IP Tech Transfer List Data Not Found! </p>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Shiv Web Developer  -->
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>

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
<?php $this->load->view('includes/header'); ?>
<!-- Shiv Web Developer -->
<?php
// Fetch task data if editing
$task = [];
$skills = [];
$funding = [];
$files = [];
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $brick_id = $_GET['id'];
    $task = $this->CommonModal->getSingleRowById('tbl_bricks', ['id' => $brick_id]) ?? [];
    $skills = $this->CommonModal->getSingleRowById('tbl_brick_skills', ['brick_id' => $brick_id]) ?? [];
    $funding = $this->CommonModal->getSingleRowById('brick_funding', ['brick_id' => $brick_id]) ?? [];
    $files = $this->CommonModal->getSingleRowById('brick_files', ['brick_id' => $brick_id]) ?? [];
    $brickVoting = $this->CommonModal->getSingleRowById('brick_voting', ['brick_id' => $brick_id]) ?? [];
    $nonliving = $this->CommonModal->getSingleRowById('tbl_brick_nonliving', ['brick_id' => $brick_id]) ?? [];
}
?>
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

    #conditionalForm5 .row {
        margin: 0px !important;
    }
</style>

<div class="ps-md-4 pe-md-3 px-2 py-3 page-body pt-0">
    <?php
    if ($this->session->has_userdata('taskMsg')) {
        echo $this->session->userdata('taskMsg');
        $this->session->unset_userdata('taskMsg');
    }
    ?>
    <form method="POST" enctype="multipart/form-data" class="flex flex-col gap-4">
        <div class="container max-width-1470 w-100 shadow-lg bg-white d-flex gap-3 mt-md-3 align-items-start">
            <div class="w-100" style="border-right: 1px solid #e0e0e0; padding-right: 10px;">
                <div class="row mt-md-0 mb-0 dotted-bottom pb-0">
                    <div class="col-md-12 mb-3 mt-md-3">
                        <h4><?= isset($brick_id) ? 'Edit Task' : 'Create Task' ?></h4>
                    </div>

                    <!-- Add Task Section -->
                    <div id="questionBox5" class="col-md-12 p-md-5 pt-md-3 pb-md-3 dotted-bottom ps-md-3" style="position:relative; border-left: 3px solid #4772f3; border-right: 3px solid #4772f3; border-bottom: 2px dotted #ccc;">
                        <div class="d-flex align-items-center">
                            <label class="me-2">S<sub>0</sub> - <span style="font-size:12px; color:red;">*</span> Title
                                <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Section0 - Would You Like to Add the Task Title?"></i>
                            </label>
                            <label class="switch me-2">
                                <input type="checkbox" class="enableSwitch" data-index="5" name="show_form_5">
                                <span class="slider round"></span>
                                <span class="enableDisableLabel" data-index="5">Yes</span>
                            </label>
                        </div>
                    </div>
                    <div id="conditionalForm5" class="col-md-12 g-0" style="display: none;">
                        <div class="row" style="border-left: 3px solid #7f1b54; border-right: 3px solid #7f1b54;">
                            <div class="col-md-2">
                                <label for="brick_privacy" class="mb-md-3"> <span style="font-size:12px; color:red;">*</span>Task Privacy
                                    <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Select how you'd like to label this section: Brick, Task, or Milestone."></i>
                                </label><br>
                                <div class="d-flex gap-3">
                                    <div class="top-right-btns">
                                        <label for="brick-private">
                                            <input type="radio" name="brick_privacy" id="brick-private" value="private" <?= ((isset($task['brick_privacy']) && $task['brick_privacy'] == 'private') ? 'checked' : (set_value('brick_privacy') == 'private' ? 'checked' : '')) ? '' : 'checked' ?>> Private
                                        </label>
                                        <div class="mx-2"></div>
                                        <label for="brick-public">
                                            <input type="radio" name="brick_privacy" id="brick-public" value="public" <?= (isset($task['brick_privacy']) && $task['brick_privacy'] == 'public') ? 'checked' : (set_value('brick_privacy') == 'public' ? 'checked' : '') ?>> Public
                                        </label>
                                    </div>
                                </div>
                                <small class="text-danger"><?= form_error('brick_privacy'); ?></small>
                            </div>
                            <div class="col-md-3 mt-md-3 mt-3">
                                <label for="brick_pass" class="">Network Marketing?
                                    <span style="font-size:12px; color:red;">*</span>
                                    <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Select how you'd like to label this section: Brick, Task, or Milestone."></i>
                                </label>
                                <div class="form-check form-switch">
                                    <input class="form-check-input <?= form_error('brick_pass') ? 'is-invalid' : ''; ?>" type="checkbox" role="switch" id="brick_pass" name="brick_pass" value="public" <?= (isset($task['brick_pass']) && $task['brick_pass'] == 'public') ? 'checked' : (set_value('brick_pass') == 'public' ? 'checked' : '') ?> onchange="document.getElementById('visibilityHidden').value = this.checked ? 'public' : 'private'; document.getElementById('visibilityLabel').textContent = this.checked ? 'Yes' : 'No';">
                                    <label class="form-check-label" for="brick_pass"><span id="visibilityLabel"><?= (isset($task['brick_pass']) && $task['brick_pass'] == 'public') ? 'Yes' : 'No' ?></span></label>
                                    <input type="hidden" name="brick_pass" id="visibilityHidden" value="<?= isset($task['brick_pass']) ? $task['brick_pass'] : set_value('visibility', 'private'); ?>">
                                </div>

                                <div class="w-100 mt-2">
                                    <label class="mb-md-2"> Select Currency <span style="font-size:12px; color:red;">*</span>
                                        <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Select Currency Symbol."></i>
                                    </label>
                                    <select class="form-select" name="currency_symbol" id="currency-symbol" value="<?= isset($task['currency_symbol']) ? htmlspecialchars($task['currency_symbol']) : set_value('currency_symbol'); ?>
                                        style="margin-right: 10px;">
                                        <option value="">Select</option>
                                        <option value="USD|$">$ – US Dollar</option>
                                        <option value="EUR|€">€ – Euro</option>
                                        <option value="GBP|£">£ – British Pound</option>
                                        <option value="INR|₹">₹ – Indian Rupee</option>
                                        <option value="AUD|$">$ – Australian Dollar</option>
                                        <option value="CAD|$">$ – Canadian Dollar</option>
                                        <option value="SGD|$">$ – Singapore Dollar</option>
                                        <option value="NZD|$">$ – New Zealand Dollar</option>
                                        <option value="JPY|¥">¥ – Japanese Yen</option>
                                        <option value="CNY|¥">¥ – Chinese Yuan</option>
                                        <option value="CHF|CHF">CHF – Swiss Franc</option>
                                        <option value="HKD|$">$ – Hong Kong Dollar</option>
                                        <option value="AED|د.إ">د.إ – UAE Dirham</option>
                                        <option value="SAR|﷼">﷼ – Saudi Riyal</option>
                                        <option value="QAR|﷼">﷼ – Qatari Riyal</option>
                                        <option value="OMR|﷼">﷼ – Omani Rial</option>
                                        <option value="KWD|KD">KD – Kuwaiti Dinar</option>
                                        <option value="BHD|BD">BD – Bahraini Dinar</option>
                                        <option value="TRY|₺">₺ – Turkish Lira</option>
                                        <option value="RUB|₽">₽ – Russian Ruble</option>
                                        <option value="ZAR|R">R – South African Rand</option>
                                        <option value="THB|฿">฿ – Thai Baht</option>
                                        <option value="MYR|RM">RM – Malaysian Ringgit</option>
                                        <option value="IDR|Rp">Rp – Indonesian Rupiah</option>
                                        <option value="PKR|₨">₨ – Pakistani Rupee</option>
                                        <option value="BDT|৳">৳ – Bangladeshi Taka</option>
                                        <option value="KRW|₩">₩ – South Korean Won</option>
                                        <option value="NGN|₦">₦ – Nigerian Naira</option>
                                        <option value="PHP|₱">₱ – Philippine Peso</option>
                                        <option value="VND|₫">₫ – Vietnamese Dong</option>
                                        <option value="ILS|₪">₪ – Israeli Shekel</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3 mb-3 mt-md-3">
                                <div class="w-100">
                                    <label class="mb-md-2"> Select Nomenclature <span style="font-size:12px; color:red;">*</span>
                                        <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Select how you'd like to label this section: Brick, Task, or Milestone."></i>
                                    </label>
                                    <select class="form-select" name="brick-nametask" id="brick-nametask"
                                        style="margin-right: 10px;">
                                        <option value="">Select</option>
                                        <option value="activity">Activity</option>
                                        <option value="task">Task</option>
                                        <option value="milestone">Milestone</option>
                                        <option value="strategie">Strategie</option>
                                        <option value="scene">Scene</option>
                                        <option value="updates">Updates</option>
                                        <option value="events">Event</option>
                                        <option value="bucket">Bucket</option>
                                    </select>
                                </div>
                                <div class="w-100 mt-md-2">
                                    <label class="mb-md-2"> Select Range <span style="font-size:12px; color:red;">*</span>
                                        <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Select Brick type"></i>
                                    </label>
                                    <select class="form-control" name="brick_type" id="brick-type" required>
                                        <option value="">Select </option>
                                        <option value="0" <?= (isset($task['brick_type']) && $task['brick_type'] == '0') ? 'selected' : (set_value('brick_type') == '0' ? 'selected' : '') ?>>L1 - Silver (0 - 1000 )</option>
                                        <option value="1" <?= (isset($task['brick_type']) && $task['brick_type'] == '1') ? 'selected' : (set_value('brick_type') == '1' ? 'selected' : '') ?>>L2 - Golden (1000 to 10,000 )</option>
                                        <option value="2" <?= (isset($task['brick_type']) && $task['brick_type'] == '2') ? 'selected' : (set_value('brick_type') == '2' ? 'selected' : '') ?>>L3 - Platinum (10,000 to 1,00,000 )</option>
                                        <option value="3" <?= (isset($task['brick_type']) && $task['brick_type'] == '3') ? 'selected' : (set_value('brick_type') == '3' ? 'selected' : '') ?>>L4 - Titanium (1,00,000 to 10,00,000 )</option>
                                        <option value="4" <?= (isset($task['brick_type']) && $task['brick_type'] == '4') ? 'selected' : (set_value('brick_type') == '4' ? 'selected' : '') ?>>L5 - Vibranium (10,00,000 to 100,000,000 )</option>
                                    </select>
                                    <small class="text-danger"><?= form_error('brick_type'); ?></small>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <label class="mb-md-2">Timer
                                    <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Select how you'd like to label this section: Brick, Task, or Milestone."></i>
                                </label>
                                <div id="timer" class="border rounded p-1 text-center bg-light fw-bold text-success">00:00</div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="mb-md-2">Artificial Brick
                                        <input type="datetime-local" name="artificialdate" id="datetime-local" value="<?= isset($task['artificialdate']) ? htmlspecialchars($task['artificialdate']) : set_value('artificialdate'); ?>" class="form-control mt-3" placeholder="Date & Time" style="width:210px;" />
                                </div>
                            </div>

                            <div class="col-md-12 mb-3">
                                <div class="position-relative">
                                    <label class="mb-md-2">Brick Title <span style="font-size:12px; color:red;">*</span></label>
                                    <div class="d-flex">
                                        <div style="width:90%;">
                                            <input type="text" id="input1" name="brick_title" class="form-control" maxlength="150" value="<?= isset($task['brick_title']) ? htmlspecialchars($task['brick_title']) : set_value('brick_title'); ?>" placeholder="Enter Brick Title" required>
                                            <small class="text-danger"><?= form_error('brick_title'); ?></small>
                                        </div>
                                        <button type="button" data-input="input1" data-status="status1" class="btn btn-primary w-48 mx-1 mic-btn" style="height:37px;width:37px;">
                                            <i class="bi bi-mic-fill"></i>
                                        </button>
                                        <!-- Optional: Status display -->
                                        <small id="status1" class="text-muted"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Add Task Section -->
                <div id="questionBox1" class="p-md-5 pt-md-3 pb-md-3 dotted-bottom px-md-3 d-flex justify-content-between align-items-center flex-wrap gap-2" style="position:relative; border-left: 3px solid #7f1b54; border-right: 3px solid #7f1b54; border-bottom: 2px dotted #ccc;">
                    <div class="d-flex align-items-center">
                        <label class="me-2">S<sub>1</sub> - <span style="font-size:12px; color:red;">*</span>Add Task
                            <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Section1 - Would You Like to Add the Task Details?"></i>
                        </label>
                        <label class="switch me-2">
                            <input type="checkbox" class="enableSwitch" data-index="1" name="show_form_1">
                            <span class="slider round"></span>
                            <span class="enableDisableLabel" data-index="1">Yes</span>
                        </label>
                    </div>
                    <style>
                        select:disabled {
                            background-color: #e9ecef;
                            /* light gray blur */
                            color: #6c757d;
                        }
                    </style>

                    <!-- Save Button Section -->
                    <div class="d-flex align-items-center" style="">
                        <label class="me-2"> Company </label>
                        <div class="form-check form-switch">
                            <input class="form-check-input <?= form_error('forpercomp') ? 'is-invalid' : ''; ?>" type="checkbox" role="switch" id="forpercomp" name="forpercomp" value="user" <?= (isset($task['forpercomp']) && $task['forpercomp'] == 'user') ? 'checked' : (set_value('forpercomp') == 'company' ? 'checked' : '') ?> onchange="document.getElementById('UservisibilityHidden').value = this.checked ? 'user' : 'company'; document.getElementById('UservisibilityLabel').textContent = this.checked ? 'User' : 'User';">
                            <label class="form-check-label" for="forpercomp"><span id="UservisibilityLabel"><?= (isset($task['forpercomp']) && $task['forpercomp'] == 'user') ? 'User' : 'User' ?></span></label>
                            <input type="hidden" name="forpercomp" id="UservisibilityHidden" value="<?= isset($task['forpercomp']) ? $task['forpercomp'] : set_value('visibility', 'company'); ?>">
                        </div>
                    </div>

                    <!-- Save Button Section -->
                    <div class="d-flex align-items-center" style="">
                        <div style="margin-right: 20px;"> STEP-BY-STEP-EXECUTION </div>
                        <label class="me-2"> Yes </label>
                        <label class="switch me-2">
                            <input type="checkbox" class="enableSwitchSaves1" data-index="1"/>
                            <span class="slider round"></span>
                            <span class="enableDisableLabelSaves1" data-index="1"> No </span>
                        </label>
                    </div>
                </div>

                <div id="conditionalForm1" style="display: none;">
                    <div class="row mb-md-0 dotted-bottom pt-md-0 mt-md-0" style="border-left: 3px solid #7f1b54;border-right: 3px solid #7f1b54;">
                        <div class="col-md-3 mb-3">
                            <label><span style="font-size:12px; color:red;">*</span>Task Positioning / Pathway
                                <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Select how you'd like to label this section: Brick, Task, or Milestone."></i>
                            </label>
                            <div class="position-relative">
                                <select class="form-control" name="company_id" id="company_id">
                                    <?php if ($getCompanies) {
                                        foreach ($getCompanies as $company) { ?>
                                            <option value="<?= $company['id']; ?>" <?= (isset($task['company_id']) && $task['company_id'] == $company['id']) ? 'selected' : (set_value('company_id') == $company['id'] ? 'selected' : '') ?>><?= $company['company_name']; ?> (CIN: <?= $company['ciin_number']; ?>)</option>
                                    <?php }
                                    } ?>
                                </select>
                            </div>
                            <!-- <div class="position-relative mt-2"> <span style="font-size:12px; color:red;">*</span> Select Project -->
                            <!-- <select class="form-control" name="project_id" id="project_id"> -->
                            <!-- Populate dynamically via JavaScript/AJAX based on company_id -->
                            <!-- <option value="<?= isset($task['project_id']) ? $task['project_id'] : ''; ?>" selected><?= isset($task['project_id']) ? $task['project_id'] : 'Select Project'; ?></option> -->
                            <!-- </select> -->
                            <!-- </div> -->

                            <div class="position-relative mt-2">
                                <span style="font-size:12px; color:red;">*</span> Select Project
                                <select class="form-control" name="project_id" id="project_id">
                                    <option value="">Select Project</option>
                                </select>
                            </div>

                            <!-- Hidden input to store the pre-selected value from database -->
                            <input type="hidden" id="selected_project_id" value="<?= isset($task['project_id']) ? $task['project_id'] : ''; ?>">


                            <div class="position-relative mt-4">
                                <div class="d-flex align-items-center">
                                    <label class="me-2"> Personal </label>
                                    <div class="form-check form-switch">
                                        <input class="form-check-input <?= form_error('perpro') ? 'is-invalid' : ''; ?>" type="checkbox" role="switch" id="perpro" name="perpro" value="professional" <?= (isset($task['perpro']) && $task['perpro'] == 'professional') ? 'checked' : (set_value('perpro') == 'personal' ? 'checked' : '') ?> onchange="document.getElementById('PerProvisibilityHidden').value = this.checked ? 'professional' : 'personal'; document.getElementById('PerProvisibilityLabel').textContent = this.checked ? 'Professional' : 'Professional';">
                                        <label class="form-check-label" for="perpro"><span id="PerProvisibilityLabel"><?= (isset($task['perpro']) && $task['perpro'] == 'professional') ? 'Professional' : 'Professional' ?></span></label>
                                        <input type="hidden" name="perpro" id="PerProvisibilityHidden" value="<?= isset($task['perpro']) ? $task['perpro'] : set_value('visibility', 'personal'); ?>">
                                    </div>
                                </div>
                            </div>

                            <small class="text-danger"><?= form_error('company_id'); ?></small>
                            <small class="text-danger"><?= form_error('project_id'); ?></small>
                        </div>
                        <div class="col-md-5 mb-3 position-relative textarea-upload-container">
                            <label><span style="font-size:12px; color:red;">*</span>Describe Your Task
                                <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Describe your task in detail."></i>
                            </label>
                            <textarea id="input2" class="form-control pe-5" name="brick_description" rows="5" placeholder="Start voice..."><?= isset($task['brick_description']) ? htmlspecialchars($task['brick_description']) : set_value('brick_description'); ?></textarea>
                            <!-- Icons and modals remain unchanged -->
                            <small class="text-danger"><?= form_error('brick_description'); ?></small>

                            <button type="button" data-input="input2" data-status="status2" class="btn btn-primary w-48 mx-1 mic-btn" style="height:37px;width:37px; position:absolute; top:27px; right:11px;">
                                <i class="bi bi-mic-fill"></i>
                            </button>
                            <!-- Optional: Status display -->
                            <small id="status2" class="text-muted"></small>

                        </div>
                        <div class="col-md-3 mt-3">
                            <label><span style="font-size:12px; color:red;">*</span>Reward Disclosed
                                <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Brickpay will receive a commission of ₹20 or 0.01% of the reward amount, whichever is lower."></i>
                            </label>
                            <input class="form-control <?= form_error('reward_disclosed') ? 'is-invalid' : ''; ?>" type="number" name="reward_disclosed" value="<?= isset($task['reward_disclosed']) ? htmlspecialchars($task['reward_disclosed']) : set_value('reward_disclosed'); ?>" placeholder="Reward Amount" id="rewardInput">
                            <small class="text-danger"><?= form_error('reward_disclosed'); ?></small>
                            <p id="appliedPriceWrapper" style="display: none;">Commision Amount: ₹<span id="appliedPrice">0</span></p>
                            <label class="mt-3"><span style="font-size:12px; color:red;">*</span>Estimated Work Delivery Time
                                <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Enter the estimated time for work delivery."></i>
                            </label>
                            <input id="estimated_work_delivery_time" class="form-control <?= form_error('estimated_work_delivery_time') ? 'is-invalid' : ''; ?>" type="text" name="estimated_work_delivery_time" value="<?= isset($task['estimated_work_delivery_time']) ? htmlspecialchars($task['estimated_work_delivery_time']) : set_value('estimated_work_delivery_time'); ?>" placeholder="e.g., Tom Clancy's The Division">
                            <small class="text-danger"><?= form_error('estimated_work_delivery_time'); ?></small>
                        </div>
                        <div class="col-md-4 mt-3">
                            <label class="mt-3"><span style="font-size:12px; color:red;">*</span>Task Documents
                                <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Enter Document Embed Link only"></i>
                            </label>
                            <input id="taskdocument" class="form-control <?= form_error('taskdocument') ? 'is-invalid' : ''; ?>" type="text" name="taskdocument" value="<?= isset($task['taskdocument']) ? htmlspecialchars($task['taskdocument']) : set_value('taskdocument'); ?>" placeholder="Enter Document Embed Link only">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label class="mt-3"><span style="font-size:12px; color:red;">*</span>Task Video
                                <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Enter Youtube Video Embed Link only"></i>
                            </label>
                            <input id="taskvideo" class="form-control <?= form_error('taskvideo') ? 'is-invalid' : ''; ?>" type="text" name="taskvideo" value="<?= isset($task['taskvideo']) ? htmlspecialchars($task['taskvideo']) : set_value('taskvideo'); ?>" placeholder="Enter Youtube Video Embed Link only">
                        </div>
                        <div class="col-md-4 mt-3">
                            <label class="mt-3"><span style="font-size:12px; color:red;">*</span>Task Audio
                                <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Enter Audio URL only"></i>
                            </label>
                            <input id="taskaudio" class="form-control <?= form_error('taskaudio') ? 'is-invalid' : ''; ?>" type="text" name="taskaudio" value="<?= isset($task['taskaudio']) ? htmlspecialchars($task['taskaudio']) : set_value('taskaudio'); ?>" placeholder="Enter Audio URL only">
                        </div>
                    </div>
                </div>

                <!-- Skills Section -->
                <div id="questionBox2" class="p-md-5 pt-md-3 pb-md-3 dotted-bottom px-md-3 d-flex justify-content-between align-items-center flex-wrap gap-2" style="position:relative; border-left: 3px solid #7f1b54; border-right: 3px solid #7f1b54; border-bottom: 2px dotted #ccc;">
                    <div class="d-flex align-items-center">
                        <label class="me-2">S<sub>2</sub> - Human Resource (Living/NonLiving Skills)
                            <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Section2 - Would like to add desired skills for this task?"></i>
                        </label>
                        <label class="switch me-2">
                            <input type="checkbox" class="enableSwitch" data-index="2" name="show_form_2" <?= !empty($skills) ? 'checked' : ''; ?>>
                            <span class="slider round"></span>
                        </label>
                        <span class="enableDisableLabel" data-index="2"><?= !empty($skills) ? 'Yes' : 'No'; ?></span>
                    </div>

                    <!-- Save Button Section -->
                    <div class="d-flex align-items-center" style="">
                        <label class="me-2"> SAVE </label>
                        <label class="switch me-2">
                            <input type="checkbox" class="enableSwitchSaves2" data-index="2">
                            <span class="slider round"></span>
                        </label>
                        <span class="enableDisableLabelSaves2" data-index="2">No</span>
                    </div>
                </div>
                <!-- Shiv Web Developer -->
                <div id="conditionalForm2" style="display: <?= !empty($skills) ? 'block' : 'none'; ?>;">
                    <div class="row mb-md-0 dotted-bottom p-md-3 mb-0 pt-md-0 mt-md-0" style="border-left: 3px solid #0f2647;border-right: 3px solid #0f2647;">
                        <div class="col-md-8">
                            <div class="row mt-md-0">
                                <div class="col-md-3 ps-md-0 pe-md-0">
                                    <label>Required Skill
                                        <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Enter required skills for the task."></i>
                                    </label>
                                    <input class="form-control <?= form_error('required_skills') ? 'is-invalid' : ''; ?>" type="text" name="required_skills" value="<?= isset($skills['required_skill']) ? htmlspecialchars($skills['required_skill']) : set_value('required_skills'); ?>" placeholder="Required (compulsory)">
                                    <small class="text-danger"><?= form_error('required_skills'); ?></small>
                                </div>
                                <div class="col-md-3 ps-md-0 pe-md-0">
                                    <label class="ps-2">Optional Skill
                                        <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Enter optional skills for the task."></i>
                                    </label>
                                    <input class="form-control <?= form_error('skills_optional') ? 'is-invalid' : ''; ?>" type="text" name="skills_optional" value="<?= isset($skills['optional_skill']) ? htmlspecialchars($skills['optional_skill']) : set_value('skills_optional'); ?>" placeholder="Expected (optional)">
                                    <small class="text-danger"><?= form_error('skills_optional'); ?></small>
                                </div>
                                <div class="col-md-3 ps-md-0 pe-md-0">
                                    <label class="ps-2">Required Education
                                        <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Enter required education for the task."></i>
                                    </label>
                                    <input class="form-control <?= form_error('education') ? 'is-invalid' : ''; ?>" type="text" name="education" value="<?= isset($skills['required_education']) ? htmlspecialchars($skills['required_education']) : set_value('education'); ?>" placeholder="Required (compulsory)">
                                    <small class="text-danger"><?= form_error('education'); ?></small>
                                </div>
                                <div class="col-md-3 ps-md-0 pe-md-0">
                                    <label class="ps-2">Optional Education
                                        <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Enter optional education for the task."></i>
                                    </label>
                                    <input class="form-control <?= form_error('education_optional') ? 'is-invalid' : ''; ?>" type="text" name="education_optional" value="<?= isset($skills['optional_education']) ? htmlspecialchars($skills['optional_education']) : set_value('education_optional'); ?>" placeholder="Expected (optional)">
                                    <small class="text-danger"><?= form_error('education_optional'); ?></small>
                                </div>
                                <div class="col-md-5 mb-3 mt-md-3">
                                    <label class="form-label fw-bold">Would you like to receive Project Consultancy / Advisory / Mentorship request?
                                        <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Enable if you want consultancy requests."></i>
                                    </label>
                                    <div class="form-check form-switch mt-2">
                                        <input class="form-check-input" type="checkbox" role="switch" id="consultancySwitch" name="project_consultancy" value="Yes" <?= (isset($skills['project_consultancy']) && $skills['project_consultancy'] == 'Yes') ? 'checked' : ''; ?> onchange="document.getElementById('consultancyHidden').value = this.checked ? 'Yes' : 'No'; document.getElementById('consultancyLabel').textContent = this.checked ? 'Yes' : 'No';">
                                        <label class="form-check-label" for="consultancySwitch"><span id="consultancyLabel"><?= (isset($skills['project_consultancy']) && $skills['project_consultancy'] == 'Yes') ? 'Yes' : 'No'; ?></span></label>
                                        <input type="hidden" id="consultancyHidden" name="project_consultancy" value="<?= isset($skills['project_consultancy']) ? $skills['project_consultancy'] : 'No'; ?>">
                                    </div>
                                </div>
                                <div class="col-md-6 mt-3 position-relative textarea-upload-container">
                                    <label>Do you have a Barter Deal?
                                        <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Describe any barter deal for the task."></i>
                                    </label>
                                    <textarea class="form-control" name="appeal_statement" rows="2" placeholder="write here ....."><?= isset($skills['appeal_statement']) ? htmlspecialchars($skills['appeal_statement']) : set_value('appeal_statement'); ?></textarea>
                                    <!-- Icons and modals remain unchanged -->
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 mb-3 position-relative textarea-upload-container experience-box mt--48">
                            <label>Experience
                                <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Describe required experience for the task."></i>
                            </label>
                            <textarea id="input3" class="form-control <?= form_error('experience[]') ? 'is-invalid' : ''; ?>" name="experience" rows="4" placeholder="Describe your experience..."><?= isset($skills['experience']) ? htmlspecialchars($skills['experience']) : set_value('experience'); ?></textarea>
                            <!-- Icons and modals remain unchanged -->
                            <small class="text-danger"><?= form_error('experience[]'); ?></small>
                            <button type="button" data-input="input3" data-status="status3" class="btn btn-primary text-white w-48 mx-1 mic-btn" style="height:37px;width:37px; position:absolute; top:10px; right:0px;">
                                <i class="bi bi-mic-fill text-white"></i>
                            </button>
                            <!-- Optional: Status display -->
                            <small id="status3" class="text-muted"></small>
                        </div>

                        <!-- RESOURCES  -->
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group d-flex">
                                    <span class="pt-1 mx-2"> Resources: </span>
                                    <textarea class="form-control" name="resources_text" placeholder="Text Box"><?= isset($nonliving['resources_text']) ? htmlspecialchars($nonliving['resources_text']) : set_value('resources_text'); ?></textarea>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="resources_financial" value="<?= isset($nonliving['resources_financial']) ? htmlspecialchars($nonliving['resources_financial']) : set_value('resources_financial'); ?>" placeholder="Financial Box" />
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="d-flex align-items-center">
                                    <div className="checkbox-group">
                                        <label>
                                            <input type="radio" name="resources_buyrent" value="buy" <?= !empty($nonliving['resources_buyrent'] == 'buy') ? 'checked' : ''; ?> /> Buy
                                        </label>
                                        <label class="mx-2">
                                            <input type="radio" name="resources_buyrent" value="rent" <?= !empty($nonliving['resources_buyrent'] == 'rent') ? 'checked' : ''; ?> /> Rent
                                        </label>
                                        <label>
                                            <input type="radio" name="resources_buyrent" value="both" <?= !empty($nonliving['resources_buyrent'] == 'both') ? 'checked' : ''; ?> /> Both
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-3">
                                <label class="mt-3"><span style="font-size:12px; color:red;">*</span>Resources Documents
                                    <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Enter Document Embed Link only"></i>
                                </label>
                                <input id="resourcesdocument" class="form-control <?= form_error('resourcesdocument') ? 'is-invalid' : ''; ?>" type="text" name="resourcesdocument" value="<?= isset($nonliving['resourcesdocument']) ? htmlspecialchars($nonliving['resourcesdocument']) : set_value('resourcesdocument'); ?>" placeholder="Enter Document Embed Link only">
                            </div>
                            <div class="col-md-4 mt-3">
                                <label class="mt-3"><span style="font-size:12px; color:red;">*</span>Resources Video
                                    <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Enter Youtube Video Embed Link only"></i>
                                </label>
                                <input id="resourcesvideo" class="form-control <?= form_error('resourcesvideo') ? 'is-invalid' : ''; ?>" type="text" name="resourcesvideo" value="<?= isset($nonliving['resourcesvideo']) ? htmlspecialchars($nonliving['resourcesvideo']) : set_value('resourcesvideo'); ?>" placeholder="Enter Youtube Video Embed Link only">
                            </div>
                            <div class="col-md-4 mt-3">
                                <label class="mt-3"><span style="font-size:12px; color:red;">*</span>Resources Audio
                                    <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Enter Audio URL only"></i>
                                </label>
                                <input id="resourcesaudio" class="form-control <?= form_error('resourcesaudio') ? 'is-invalid' : ''; ?>" type="text" name="resourcesaudio" value="<?= isset($nonliving['resourcesaudio']) ? htmlspecialchars($nonliving['resourcesaudio']) : set_value('resourcesaudio'); ?>" placeholder="Enter Audio URL only">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Funding Section -->
                <div id="questionBox3" class="p-md-5 pt-md-3 pb-md-3 dotted-bottom px-md-3 d-flex justify-content-between align-items-center flex-wrap gap-2" style="border-left: 3px solid #7f1b54; border-right: 3px solid #7f1b54; border-bottom: 2px dotted #ccc; position:relative;">
                    <div class="d-flex align-items-center">
                        <label class="me-2">S<sub>3</sub> - Funding
                            <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Section3 - Would you like to raise funding?"></i>
                        </label>
                        <label class="switch me-2">
                            <input type="checkbox" class="enableSwitch" data-index="3" name="show_form_3" <?= !empty($funding) ? 'checked' : ''; ?>>
                            <span class="slider round"></span>
                        </label>
                        <span class="enableDisableLabel" data-index="3"><?= !empty($funding) ? 'Yes' : 'No'; ?></span>
                    </div>

                    <!-- Save Button Section -->
                    <div class="d-flex align-items-center" style="">
                        <label class="me-2"> SAVE </label>
                        <label class="switch me-2">
                            <input type="checkbox" class="enableSwitchSaves3" data-index="3">
                            <span class="slider round"></span>
                        </label>
                        <span class="enableDisableLabelSaves3" data-index="3">No</span>
                    </div>
                </div>

                <div id="conditionalForm3" style="display: <?= !empty($funding) ? 'block' : 'none'; ?>;">
                    <div class="row p-md-4 pt-md-0 mt-md-0 mb-md-0 dotted-bottom align-items-start" style="border-left: 3px solid #831934;border-right: 3px solid #831934;">
                        <div class="col-md-6">
                            <div class="row g-3 mt-md-0 align-items-end">
                                <div class="col-md-5">
                                    <div class="d-flex justify-content-between align-items-center mb-1">
                                        <label class="mb-0">Fund Required for this Task
                                            <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Enter the funding amount required."></i>
                                        </label>
                                        <span class="label-badge">#BRICK2025</span>
                                    </div>
                                    <input class="form-control" type="text" name="fund_required" value="<?= isset($funding['fund_required']) ? htmlspecialchars($funding['fund_required']) : ''; ?>" placeholder="">
                                </div>
                                <div class="col-md-3 col-6">
                                    <label class="col-form-label" style="font-size: 12px;">Min. Ticket Size</label>
                                    <input class="form-control" type="number" name="team_min" value="<?= isset($funding['team_min']) ? htmlspecialchars($funding['team_min']) : ''; ?>" maxlength="5" oninput="limitLength(this, 8)">
                                </div>
                                <div class="col-auto d-flex align-items-end justify-content-center px-1">
                                    <span class="pb-2">-</span>
                                </div>
                                <div class="col-md-3 col-6">
                                    <label class="col-form-label" style="font-size: 12px;">Max. Ticket Size</label>
                                    <input class="form-control" type="number" name="team_max" value="<?= isset($funding['team_max']) ? htmlspecialchars($funding['team_max']) : ''; ?>" maxlength="5" oninput="limitLength(this, 8)">
                                </div>
                                <div class="col-md-12">
                                    <label class="mb-3" for="">Type of Funding
                                        <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Select type of funding."></i>
                                    </label>
                                    <select id="cus_fund_type" class="form-select" name="funding_type" id="funding_type" value="<?= isset($funding['funding_type']) ? htmlspecialchars($funding['funding_type']) : ''; ?>">
                                        <option value="">Select Fund Type</option>
                                        <option value="equity">Equity</option>
                                        <option value="loan">Loan</option>
                                        <option value="bonds">Bonds</option>
                                        <option value="barter">Barter</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>
                                <div id="funding_dynamic_fields" class="col-md-12"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="position-relative mt-3 textarea-upload-container">
                                <label>Proof you will be providing for the completion of Task
                                    <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Describe proof of task completion."></i>
                                </label>
                                <textarea class="form-control" name="task_completion_proof" rows="2" placeholder="write here ....."><?= isset($funding['task_completion_proof']) ? htmlspecialchars($funding['task_completion_proof']) : ''; ?></textarea>
                                <!-- Icons and modals remain unchanged -->
                            </div>
                            <!-- <div class="position-relative mt-3 textarea-upload-container">
                                <label>Do you have a Barter Deal?
                                    <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Describe any barter deal for funding."></i>
                                </label>
                                <textarea class="form-control" name="barter_deal" rows="2" placeholder=""><?= isset($funding['barter_deal']) ? htmlspecialchars($funding['barter_deal']) : ''; ?></textarea> -->
                                <!-- Icons and modals remain unchanged -->
                            <!-- </div> -->
                            <div class="position-relative mt-3 textarea-upload-container">
                                <label>Appeal Statement
                                    <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Provide an appeal statement for funding."></i>
                                </label>
                                <textarea class="form-control" name="appeal_statement" rows="2" placeholder="write here ....."><?= isset($funding['appeal_statement']) ? htmlspecialchars($funding['appeal_statement']) : ''; ?></textarea>
                                <!-- Icons and modals remain unchanged -->
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="mt-3"><span style="font-size:12px; color:red;">*</span>Fund Documents
                                    <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Enter Document Embed Link only"></i>
                                </label>
                                <input id="funddocument" class="form-control <?= form_error('funddocument') ? 'is-invalid' : ''; ?>" type="text" name="funddocument" value="<?= isset($task['funddocument']) ? htmlspecialchars($task['funddocument']) : set_value('funddocument'); ?>" placeholder="Enter Document Embed Link only">
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="mt-3"><span style="font-size:12px; color:red;">*</span>Fund Video
                                    <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Enter Youtube Video Embed Link only"></i>
                                </label>
                                <input id="fundvideo" class="form-control <?= form_error('fundvideo') ? 'is-invalid' : ''; ?>" type="text" name="fundvideo" value="<?= isset($task['fundvideo']) ? htmlspecialchars($task['fundvideo']) : set_value('fundvideo'); ?>" placeholder="Enter Youtube Video Embed Link only">
                            </div>
                            <div class="col-md-12 mt-3">
                                <label class="mt-3"><span style="font-size:12px; color:red;">*</span>Fund Audio
                                    <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Enter Audio URL only"></i>
                                </label>
                                <input id="fundaudio" class="form-control <?= form_error('fundaudio') ? 'is-invalid' : ''; ?>" type="text" name="fundaudio" value="<?= isset($task['fundaudio']) ? htmlspecialchars($task['fundaudio']) : set_value('fundaudio'); ?>" placeholder="Enter Audio URL only">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Voting Panel Section -->
                <div id="questionBox4" class="p-md-5 pt-md-3 pb-md-3 dotted-bottom px-md-3 d-flex justify-content-between align-items-center flex-wrap gap-2" style="border-left: 3px solid #3f51b5; border-right: 3px solid #3f51b5; border-bottom: 2px dotted #ccc; position:relative;">
                    <div class="d-flex align-items-center">
                        <label class="me-2">S<sub>4</sub> - Voting Panel
                            <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Section4 - Would you like to Established voting panel?"></i>
                        </label>
                        <label class="switch me-2">
                            <input type="checkbox" class="enableSwitch" data-index="4" <?= !empty($brickVoting) ? 'checked' : ''; ?>>
                            <span class="slider round"></span>
                        </label>
                        <span class="enableDisableLabel" data-index="4"><?= !empty($brickVoting) ? 'Yes' : 'No'; ?></span>
                    </div>

                    <!-- Save Button Section -->
                    <div class="d-flex align-items-center" style="">
                        <label class="me-2"> SAVE </label>
                        <label class="switch me-2">
                            <input type="checkbox" class="enableSwitchSaves4" data-index="4">
                            <span class="slider round"></span>
                        </label>
                        <span class="enableDisableLabelSave4" data-index="4">No</span>
                    </div>
                </div>




                <div id="conditionalForm4" style="display: <?= !empty($brickVoting) ? 'block' : 'none'; ?>;">
                    <div class="col-md-12 gap-0 p-md-3 d-flex dotted-bottom" style="border-left: 3px solid #3f51b5; border-right: 3px solid #3f51b5;">
                        <div class="col-md-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center">
                                    <span class="mx-2 fw-bold">Vote Here</span>
                                </div>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#workAllotmentModal">Work Allotment</button>
                            </div>
                            <div class="border rounded" style="border-left: 3px solid #009688; border-right: 3px solid #009688;">
                                <div class="d-flex justify-content-between border p-2 align-items-center" style="border: 2px solid #009688;">
                                    <h6 class="fw-bold fs-14 mb-0">Make Brick Live</h6>
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="brick_live" id="noOption" value="no">
                                            <label class="form-check-label" for="noOption"></label>
                                        </div>
                                    </div>
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input" type="checkbox" role="switch" id="visibilitySwitch1" name="brick_live" value="public" onchange="document.getElementById('visibilityHidden1').value = this.checked ? 'public' : 'private'; document.getElementById('visibilityLabel1').textContent = this.checked ? 'Enable' : 'Disable';">
                                        <label class="form-check-label" for="visibilitySwitch1"><span id="visibilityLabel1">Enable</span></label>
                                        <input type="hidden" name="brick_live_hidden" id="visibilityHidden1" value="public">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between border p-2 align-items-center" style="border: 2px solid #009688;">
                                    <h6 class="fw-bold fs-14 mb-0">Accept Investor</h6>
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="radio" name="accept_investor" id="investorNo" value="no">
                                            <label class="form-check-label" for="investorNo"></label>
                                        </div>
                                    </div>
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input" type="checkbox" role="switch" id="visibilitySwitch2" name="accept_investor" value="public" onchange="document.getElementById('visibilityHidden2').value = this.checked ? 'public' : 'private'; document.getElementById('visibilityLabel2').textContent = this.checked ? 'Enable' : 'Disable';">
                                        <label class="form-check-label" for="visibilitySwitch2"><span id="visibilityLabel2">Enable</span></label>
                                        <input type="hidden" name="accept_investor_hidden" id="visibilityHidden2" value="public">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between border p-2 align-items-center" style="border: 2px solid #009688;">
                                    <h6 class="fw-bold fs-14 mb-0">Work Allotment</h6>
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="radio" name="work_allotment" id="workNo" value="no">
                                        </div>
                                    </div>
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input" type="checkbox" role="switch" id="visibilitySwitch3" name="work_allotment" value="public" onchange="document.getElementById('visibilityHidden3').value = this.checked ? 'public' : 'private'; document.getElementById('visibilityLabel3').textContent = this.checked ? 'Enable' : 'Disable';">
                                        <label class="form-check-label" for="visibilitySwitch3"><span id="visibilityLabel3">Enable</span></label>
                                        <input type="hidden" name="work_allotment_hidden" id="visibilityHidden3" value="public">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between border p-2 align-items-center" style="border: 2px solid #009688;">
                                    <h6 class="fw-bold fs-14 mb-0">Work Completion</h6>
                                    <div class="d-flex gap-2 align-items-center">
                                        <div class="form-check mb-0">
                                            <input class="form-check-input" type="radio" name="work_completion" id="completionNo" value="no">
                                        </div>
                                    </div>
                                    <div class="form-check form-switch mb-0">
                                        <input class="form-check-input" type="checkbox" role="switch" id="visibilitySwitch4" name="work_completion" value="public" onchange="document.getElementById('visibilityHidden4').value = this.checked ? 'public' : 'private'; document.getElementById('visibilityLabel4').textContent = this.checked ? 'Enable' : 'Disable';">
                                        <label class="form-check-label" for="visibilitySwitch4"><span id="visibilityLabel4">Enable</span></label>
                                        <input type="hidden" name="work_completion_hidden" id="visibilityHidden4" value="public">
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <button type="button" class="btn btn-primary d-flex align-items-center">
                                        <i class="fas fa-plus me-2"></i> Add More
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex justify-content-between align-items-center mb-2" style="margin-top:9px;">
                                <div class="d-flex align-items-center">
                                    <span class="mx-2 fw-bold">Voting</span>
                                </div>
                            </div>
                            <div class="border rounded" style="border-left: 3px solid #009688; border-right: 3px solid #009688;">
                                <div class="d-flex border justify-content-between align-items-center" style="border: 2px solid #009688; padding:5px;">
                                    <h6 class="fw-bold fs-14 mb-0">Investor</h6>
                                    <div class="text-left">
                                        <div class="form-group px-1">
                                            <input type="number" placeholder="(%)" name="investorvotingper" value="<?= isset($brickVoting['investor']) ? htmlspecialchars($brickVoting['investor']) : ''; ?>" class="form-control text-center" style="height:29px; width:150px;" id="investorvotingper" max="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex border justify-content-between align-items-center" style="border: 2px solid #009688; padding:6.5px;">
                                    <h6 class="fw-bold fs-14 mb-0">Owner</h6>
                                    <div class="text-left">
                                        <div class="form-group px-1">
                                            <input type="number" placeholder="(%)" name="ownervotingper" value="<?= isset($brickVoting['owner']) ? htmlspecialchars($brickVoting['owner']) : ''; ?>" class="form-control text-center" style="height:29px; width:150px;" id="ownervotingper" max="100">
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex border justify-content-between align-items-center" style="border: 2px solid #009688; padding:6px;">
                                    <h6 class="fw-bold fs-14 mb-0">Passers</h6>
                                    <div class="text-left">
                                        <div class="form-group px-1">
                                            <input type="number" placeholder="(%)" name="passersvotingper" value="<?= isset($brickVoting['passers']) ? htmlspecialchars($brickVoting['passers']) : ''; ?>" class="form-control text-center" style="height:29px; width:150px;" id="passersvotingper" max="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex border justify-content-between align-items-center" style="border: 2px solid #009688; padding:6px;">
                                    <h6 class="fw-bold fs-14 mb-0">Executer/Marketor</h6>
                                    <div class="text-left">
                                        <div class="form-group px-1">
                                            <input type="number" placeholder="(%)" name="executervotingper" value="<?= isset($brickVoting['executer']) ? htmlspecialchars($brickVoting['executer']) : ''; ?>" class="form-control text-center" style="height:29px; width:150px;" id="executervotingper" max="100">
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex border justify-content-between align-items-center" style="border: 2px solid #009688; padding:6px;">
                                    <h6 class="fw-bold fs-14 mb-0">Other</h6>
                                    <div class="text-left">
                                        <div class="form-group px-1">
                                            <input type="number" placeholder="(%)" name="othervotingper" value="<?= isset($brickVoting['other']) ? htmlspecialchars($brickVoting['other']) : ''; ?>" class="form-control text-center" style="height:29px; width:150px;" id="othervotingper" max="100">
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center mt-3">
                                    <button type="button" class="btn btn-primary d-flex align-items-center">
                                        <i class="fas fa-plus me-2"></i> Add More
                                    </button>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>


                <script>
                    const percentageInputs = [
                        document.getElementById('executervotingper'),
                        document.getElementById('passersvotingper'),
                        document.getElementById('investorvotingper'),
                        document.getElementById('ownervotingper'),
                        document.getElementById('othervotingper')
                    ];

                    percentageInputs.forEach(input => {
                        // Prevent typing non-numeric characters
                        input.addEventListener('keydown', function(e) {
                            if (["e", "E", "+", "-"].includes(e.key)) {
                                e.preventDefault();
                            }
                        });

                        // Validate total doesn't exceed 100
                        input.addEventListener('input', function() {
                            let total = 0;

                            percentageInputs.forEach(i => {
                                total += parseInt(i.value) || 0;
                            });

                            if (total > 100) {
                                alert("Total percentage cannot exceed 100%");
                                this.value = '';
                            }
                        });
                    });
                </script>


                <!-- Form Actions -->
                <div class="row p-md-3 align-items-center justify-content-between mt-md-0" style="border-left: 3px solid rgb(150, 117, 0);border-right: 3px solid rgb(150, 117, 0);">
                    <div class="col-md-2 d-flex justify-content-start">
                        <button type="button" class="btn custom-upload-btn w-100" data-bs-toggle="modal" data-bs-target="#documentUploadModal">Upload Files</button>
                    </div>
                    <div class="col-md-3 d-flex flex-column align-items-center gap-2">
                        <div class="d-flex justify-content-center w-100">
                            <button type="button" class="btn custom-upload-btn w-100" style="border-radius: 10px 0px 0px 10px">Task Agreement</button>
                            <button type="button" class="btn custom-upload-btn pdf-upload-btn w-100" data-bs-toggle="modal" data-bs-target="#documentUploadModal"><i class="fa fa-plus"></i> PDF Upload</button>
                        </div>
                    </div>
                    <div class="col-md-2 d-flex flex-column align-items-center gap-2">
                        <button type="button" class="btn bg-warning custom-upload-btn w-100" name="action" value="draft">Save Draft</button>
                    </div>
                    <div class="col-md-4 d-flex justify-content-end gap-2">
                        <button type="submit" class="btn custom-upload-btn w-100" name="action" value="preview">Build & Preview Task Poster</button>
                        <button type="submit" class="btn custom-upload-btn pdf-upload-btn w-100" name="action" value="build">Build Task</button>
                    </div>
                    <!-- <div class="col-md-10 d-flex justify-content-center">
                        <div class="mb-3 text-center">
                            <label class="form-label">Task Unique ID</label>
                            <div class="d-flex justify-content-center flex-wrap">
                                <//?php for ($i = 1; $i <= 12; $i++): ?>
                                    <input id="uniqueId<//?= $i ?>" class="form-control text-center form-unique p-1" type="text" maxlength="1" name="task_unique_id[]" oninput="moveNext(this, 'uniqueId<?= $i + 1 ?>')" onkeydown="movePrev(event, 'uniqueId<?= $i - 1 ?>')" style="width: 18px;font-size: 10px;">
                                <//?php endfor; ?>
                            </div>
                            <small class="text-danger"><//?= form_error('task_unique_id'); ?></small>
                        </div>
                    </div> -->
                </div>
            </div>

            <!-- Filters Section -->
            <div class="filters" id="filtersSection" style="margin-top: 0; display: <?php echo validation_errors() ? 'block' : 'block'; ?>">
                <div class="d-flex justify-content-between align-items-center mb-2 Ascending/descending arrow buttons for carousel -->
                <div class=" d-flex justify-content-between align-items-center mb-2">
                    <h4 id="filtersText" class="mb-0 mt-2">Filters:</h4>
                </div>
                <div class="border-bottom pb-2 mb-3" style="border-bottom: 1px dotted #999;">
                    <div class="filter-box">
                        <?php
                        $countryFilterArray = $task['filter_country'] ?? '[]';
                        $countryFilterArray = is_string($countryFilterArray) ? json_decode($countryFilterArray, true) : $countryFilterArray;
                        $countryFilterArray = is_array($countryFilterArray) ? array_filter($countryFilterArray, 'is_string') : [];
                        $countryFilterResult = !empty($countryFilterArray) ? implode(", ", array_map('ucfirst', $countryFilterArray)) : '';
                        ?>
                        <label for="filter-country">Country <span style="font-size:12px; color:red;">*</span></label>
                        <input class="form-control" type="text" name="filter_country" id="filter-country" placeholder="Country" value="<?= !empty($task['filter_country']) ? htmlspecialchars($task['filter_country']) : set_value('filter_country', 'Any'); ?>">
                        <small class="text-danger"><?= form_error('filter_country'); ?></small>
                    </div>
                    <div class="filter-box">
                        <?php
                        $stateFilterArray = $task['filter_state'] ?? '[]';
                        $stateFilterArray = is_string($stateFilterArray) ? json_decode($stateFilterArray, true) : $stateFilterArray;
                        $stateFilterArray = is_array($stateFilterArray) ? array_filter($stateFilterArray, 'is_string') : [];
                        $stateFilterResult = !empty($stateFilterArray) ? implode(", ", array_map('ucfirst', $stateFilterArray)) : '';
                        ?>
                        <label for="filter-state">State<span style="font-size:12px; color:red;">*</span></label>
                        <input class="form-control" type="text" name="filter_state" id="filter-state" placeholder="State" value="<?= !empty($task['filter_state']) ? htmlspecialchars($task['filter_state']) : set_value('filter_state', 'Any'); ?>">
                        <small class="text-danger"><?= form_error('filter_state'); ?></small>
                    </div>
                    <div class="filter-box">
                        <label for="filter-location">Location</label>
                        <input class="form-control" type="text" name="filter_location" id="filter-location" placeholder="Location" value="<?= !empty($task['filter_location']) ? htmlspecialchars($task['filter_location']) : set_value('filter_location', 'Any'); ?>">
                        <small class="text-danger"><?= form_error('filter_location'); ?></small>
                    </div>
                    <div class="filter-box">
                        <label for="filter-range">Location Range</label>
                        <input class="form-control" type="text" name="filter_range" id="filter-range" placeholder="Location Range" value="<?= !empty($task['filter_range']) ? htmlspecialchars($task['filter_range']) : set_value('filter_range', 'All'); ?>">
                        <small class="text-danger"><?= form_error('filter_range'); ?></small>
                    </div>
                </div>
                <div class="border-bottom pb-2 mb-3" style="border-bottom: 1px dotted #999;">
                    <div class="filter-box">
                        <label for="filter-category">Industry<span style="font-size:12px; color:red;">*</span></label>
                        <input class="form-control" type="text" name="filter_industry" id="filter-category" placeholder="Industry" value="<?= !empty($task['filter_industry']) ? htmlspecialchars($task['filter_industry']) : set_value('filter_industry', 'Any'); ?>">
                        <small class="text-danger"><?= form_error('filter_industry'); ?></small>
                    </div>
                    <div class="filter-box">
                        <label for="filter-category">Type</label>
                        <select class="form-select" name="filter_industry_type" id="filter_industry_type">
                            <option value="">Select</option>
                            <option value="project" selected>Project</option>
                            <option value="company">Company</option>
                        </select>
                    </div>

                    <div class="filter-box">
                        <label for="filter-department">Department<span style="font-size:12px; color:red;">*</span></label>
                        <input class="form-control" type="text" name="filter_department" id="filter-department" placeholder="Department" value="<?= !empty($task['filter_department']) ? htmlspecialchars($task['filter_department']) : set_value('filter_department', 'Any'); ?>">
                        <small class="text-danger"><?= form_error('filter_department'); ?></small>
                    </div>
                    <div class="filter-box">
                        <label for="filter-category">Type</label>
                        <select class="form-select" name="filter_department_type" id="filter_department_type">
                            <option value="">Select</option>
                            <option value="project" selected>Project</option>
                            <option value="company">Company</option>
                        </select>
                    </div>
                    <div class="filter-box">
                        <?php
                        $workFilterArray = $task['filter_work'] ?? '[]';
                        $workFilterArray = is_string($workFilterArray) ? json_decode($workFilterArray, true) : $workFilterArray;
                        $workFilterArray = is_array($workFilterArray) ? array_filter($workFilterArray, 'is_string') : [];
                        $workFilterResult = !empty($workFilterArray) ? implode(", ", array_map('ucfirst', $workFilterArray)) : '';
                        ?>
                        <label for="filter-work">Work Type<span style="font-size:12px; color:red;">*</span></label>
                        <input class="form-control" type="text" name="filter-work" id="filter-work" placeholder="Work Type" value="<?= !empty($workFilterResult) ? htmlspecialchars($workFilterResult) : set_value('filter-work', 'Both'); ?>">
                        <small class="text-danger"><?= form_error('filter-work'); ?></small>
                    </div>
                </div>
                <div class="border-bottom pb-2 mb-3" style="border-bottom: 1px dotted #999;">
                    <div class="filter-box">
                        <?php
                        $skillArray = $task['filter_skills'] ?? '[]';
                        $skillArray = is_string($skillArray) ? json_decode($skillArray, true) : $skillArray;
                        $skillArray = is_array($skillArray) ? array_filter($skillArray, 'is_string') : [];
                        $skillResult = !empty($skillArray) ? implode(", ", array_map('ucfirst', $skillArray)) : '';
                        ?>
                        <label for="filter-skills">Skills<span style="font-size:12px; color:red;">*</span></label>
                        <input class="form-control" type="text" name="filter_skills" id="filter-skills" placeholder="Skills" value="<?= !empty($skillResult) ? htmlspecialchars($skillResult) : set_value('filter_skills', 'Any'); ?>">
                        <small class="text-danger"><?= form_error('filter_skills'); ?></small>
                    </div>
                    <div class="filter-box">
                        <label for="filter-education">Education<span style="font-size:12px; color:red;">*</span></label>
                        <input class="form-control" type="text" name="filter_education" id="filter-education" placeholder="Education" value="<?= !empty($task['filter_education']) ? htmlspecialchars($task['filter_education']) : set_value('filter_education', 'Any'); ?> ">
                        <small class="text-danger"><?= form_error('filter_education'); ?></small>
                    </div>
                </div>
                <div>
                    <div class="filter-box">
                        <label for="filter-revenue">Project Revenue<span style="font-size:12px; color:red;">*</span></label>
                        <div class="d-flex">
                            <input class="form-control" type="text" name="filter_revenue_from" id="filter_revenue_from" placeholder="From" value="<?= !empty($task['filter_revenue_from']) ? htmlspecialchars($task['filter_revenue_from']) : set_value('filter_revenue_from', '1000'); ?>">
                            <span class="mt-2 mx-1">-</span>
                            <input class="form-control" type="text" name="filter_revenue_to" id="filter_revenue_to" placeholder="To" value="<?= !empty($task['filter_revenue_to']) ? htmlspecialchars($task['filter_revenue_to']) : set_value('filter_revenue_to', '1000000000'); ?> ">
                        </div>
                        <small class="text-danger"><?= form_error('filter_revenue_from'); ?></small>
                    </div>
                    <div class="filter-box">
                        <label for="filter-category">Type</label>
                        <select class="form-select" name="filter_revenue_type" id="filter_revenue_type">
                            <option value="">Select</option>
                            <option value="project" selected>Project</option>
                            <option value="company">Company</option>
                        </select>
                    </div>
                    <hr>

                    <div class="filter-box">
                        <label for="filter-monetization">Monetization Range</label>
                        <input class="form-control" type="text" name="filter_monetization" id="filter-monetization" placeholder="Monetization Range" value="<?= !empty($task['filter_monetization']) ? htmlspecialchars($task['filter_monetization']) : set_value('filter_monetization', '5000'); ?>">
                        <small class="text-danger"><?= form_error('filter_monetization'); ?></small>
                    </div>
                    <div class="filter-box">
                        <label for="filter-execution">Execution Time</label>
                        <input class="form-control" type="text" name="filter_execution" id="filter-execution" placeholder="Execution Time" value="<?= !empty($task['filter_execution']) ? htmlspecialchars($task['filter_execution']) : set_value('filter_execution', '3'); ?> ">
                        <small class="text-danger"><?= form_error('filter_execution'); ?></small>
                        <div class="d-flex gap-1 mt-1">
                            <div class="form-check">
                                <input id="seconds" name="execution_unit" type="radio" class="form-check-input" value="seconds" <?= (isset($task['execution_unit']) && $task['execution_unit'] == 'seconds') ? 'checked' : (set_value('execution_unit') == 'seconds' ? 'checked' : '') ?>>
                                <label class="form-check-label" for="seconds">Seconds</label>
                                <small class="text-danger"><?= form_error('execution_unit'); ?></small>
                            </div>
                            <div class="form-check">
                                <input id="minutes" name="execution_unit" type="radio" class="form-check-input" value="minutes" <?= (isset($task['execution_unit']) && $task['execution_unit'] == 'minutes') ? 'checked' : (set_value('execution_unit') == 'minutes' ? 'checked' : '') ?>>
                                <label class="form-check-label" for="minutes">Minutes</label>
                            </div>
                            <div class="form-check">
                                <input id="debit" name="execution_unit" type="radio" class="form-check-input" value="hours" <?= (isset($task['execution_unit']) && $task['execution_unit'] == 'hours') ? 'checked' : (set_value('execution_unit') == 'hours' ? 'checked' : '') ?>>
                                <label class="form-check-label" for="debit">Hours</label>
                            </div>
                        </div>
                        <div class="d-flex gap-1 mt-1">
                            <div class="form-check">
                                <input id="credit" name="execution_unit" type="radio" class="form-check-input" value="days" <?= (isset($task['execution_unit']) && $task['execution_unit'] == 'days') ? 'checked' : (set_value('execution_unit') == 'days' ? 'checked' : '') ?>>
                                <label class="form-check-label" for="credit">Days</label>
                            </div>
                            <div class="form-check">
                                <input id="week" name="execution_unit" type="radio" class="form-check-input" value="week" <?= (isset($task['execution_unit']) && $task['execution_unit'] == 'week') ? 'checked' : (set_value('execution_unit') == 'week' ? 'checked' : '') ?>>
                                <label class="form-check-label" for="week">Week</label>
                            </div>
                            <div class="form-check">
                                <input id="months" name="execution_unit" type="radio" class="form-check-input" value="months" checked <?= (isset($task['execution_unit']) && $task['execution_unit'] == 'months') ? 'checked' : (set_value('execution_unit') == 'months' ? 'checked' : '') ?>>
                                <label class="form-check-label" for="months">Months</label>
                            </div>
                            <div class="form-check">
                                <input id="years" name="execution_unit" type="radio" class="form-check-input" value="years" <?= (isset($task['execution_unit']) && $task['execution_unit'] == 'years') ? 'checked' : (set_value('execution_unit') == 'years' ? 'checked' : '') ?>>
                                <label class="form-check-label" for="years">Years</label>
                            </div>
                        </div>
                    </div>
                    <div class="filter-box my-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="save-info" name="save_preferences" checked>
                            <label class="form-check-label" for="save-info">Save this preferences</label>
                        </div>
                    </div>
                </div>
            </div>
            <i id="toggleFilters" class="fa fa-bars cursor-pointer"></i>
        </div>
    </form>
</div>



<!-- Video Upload Modal -->
<div class="modal fade upload-modal" id="videoUploadModal" tabindex="-1" aria-labelledby="videoUploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="videoUploadModalLabel">Upload Video</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="videoUploadForm">
                    <input type="hidden" name="upload_type" value="video">
                    <input type="hidden" id="videoTargetField" name="target_field">
                    <div class="mb-3">
                        <label for="videoFile" class="form-label">Select Video (MP4)</label>
                        <input class="form-control" type="file" id="videoFile" name="video_file" accept="video/mp4">
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Audio Upload Modal -->
<div class="modal fade upload-modal" id="audioUploadModal" tabindex="-1" aria-labelledby="audioUploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="audioUploadModalLabel">Upload Audio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="audioUploadForm">
                    <input type="hidden" name="upload_type" value="audio">
                    <input type="hidden" id="audioTargetField" name="target_field">
                    <div class="mb-3">
                        <label for="audioFile" class="form-label">Select Audio (MP3)</label>
                        <input class="form-control" type="file" id="audioFile" name="audio_file" accept="audio/mp3">
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Document Upload Modal -->
<div class="modal fade upload-modal" id="documentUploadModal" tabindex="-1" aria-labelledby="documentUploadModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="documentUploadModalLabel">Upload Document</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="documentUploadForm">
                    <input type="hidden" name="upload_type" value="document">
                    <input type="hidden" id="documentTargetField" name="target_field">
                    <div class="mb-3">
                        <label for="documentFile" class="form-label">Select Document (PDF, DOC, DOCX)</label>
                        <input class="form-control" type="file" id="documentFile" name="document_file" accept=".pdf,.doc,.docx">
                    </div>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Work Allotment Modal -->
<div class="modal fade" id="workAllotmentModal" tabindex="-1" aria-labelledby="workAllotmentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="workAllotmentModalLabel">Work Allotment Panel</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="border rounded" style="border-left: 3px solid #009688; border-right: 3px solid #009688;">
                        <div class="d-flex align-items-center justify-content-between border p-3" style="border: 2px solid #009688;">
                            <h5 class="mb-0 text-primary fw-bold w-100 text-start">
                                Established the voting panel
                                <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer; top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Select how you'd like to label this section: Brick, Task, or Milestone."></i>
                            </h5>
                            <div class="position-relative" style="width: 150px; height: 60px;">
                                <i class="fas fa-user-circle text-primary" title="Sole Creator" style="font-size: 32px; position: absolute; bottom: 0; left: 0;"></i>
                            </div>
                        </div>
                        <div class="d-flex justify-content-start border p-3 align-items-center" style="border: 2px solid #009688;">
                            <div class="rounded-circle bg-secondary d-flex justify-content-center align-items-center me-2" style="width: 50px; height: 50px;">
                                <i class="fas fa-user text-white"></i>
                            </div>
                            <div class="rounded-circle bg-success d-flex justify-content-center align-items-center" style="width: 30px; height: 30px; cursor: pointer;">
                                <i class="fas fa-plus text-white"></i>
                            </div>
                        </div>
                        <div class="d-flex justify-content-between border p-2" style="border: 2px solid #009688;">
                            <div class="fw-bold">Split Voting Share</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>


<script>
    const rewardInput = document.getElementById('rewardInput');
    const appliedPrice = document.getElementById('appliedPrice');
    const appliedPriceWrapper = document.querySelector('#appliedPriceWrapper');


    rewardInput.addEventListener('keyup', () => {

        if (rewardInput.value > 0) {
            console.log("rewardInput.value", rewardInput.value);
            appliedPriceWrapper.style.display = 'block';
        }
        const rewardValue = parseFloat(rewardInput.value) || 0;
        const calculatedPercentage = (rewardValue * 0.01) / 100; // 0.01%

        const finalPrice = Math.min(calculatedPercentage, 20); // Choose lower one

        appliedPrice.textContent = finalPrice.toFixed(2); // Show with 2 decimals
    });
</script>

<script>
    $(document).ready(function() {

        var input = document.querySelector('input[name="filter_state"]'),
            tagify = new Tagify(input, {
                whitelist: [
                    "Any",
                    "Madhya Pradesh",
                    "Maharashtra",
                    "Uttar Pradesh",
                    "Gujrat",
                ],

                maxTags: 10,
                dropdown: {
                    maxItems: 20,
                    classname: "tags-look",
                    enabled: 0,
                    closeOnSelect: false
                }
            })
        var input = document.querySelector('input[name="filter_country"]'),
            tagify = new Tagify(input, {
                whitelist: [
                    "Any",
                    "India",
                    "USA",
                    "UAE",
                    "Australia",
                ],

                maxTags: 10,
                dropdown: {
                    maxItems: 20,
                    classname: "tags-look",
                    enabled: 0,
                    closeOnSelect: false
                }
            })

        var input = document.querySelector('input[name="filter_department"]'),
            tagify = new Tagify(input, {
                whitelist: [
                    "Any",
                    "R&D & Innovation",
                    "Vendor listing",
                    "Manufacturing",
                    "Production",
                    "Quality check",
                    "Warehousing/storage",
                    "Logistics /Supply chain",
                    "Operational",
                    "Investor relations",
                    "HR",
                    "Sales",
                    "Marketing",
                    "Account",
                    "Public relation",
                    "Management",
                    "Top Leaders",
                    "Growth strategy /Merger-acquisition",
                ],

                maxTags: 10,
                dropdown: {
                    maxItems: 20,
                    classname: "tags-look",
                    enabled: 0,
                    closeOnSelect: false
                }
            })

        var industryFilter = document.querySelector('input[name="filter_industry"]'),
            tagify = new Tagify(industryFilter, {
                whitelist: [
                    "Any",
                    "IT Industry",
                    "Medical",
                    "Finance & Accounting",
                    "Marketing & Advertising",
                    "Education & Training",
                    "Construction & Engineering",
                    "E-commerce & Retail",
                    "Legal Services",
                    "Telecommunications",
                    "Media & Entertainment",
                    "Real Estate",
                    "Hospitality & Tourism",
                    "Automotive Industry",
                    "Manufacturing & Production",
                    "HR & Recruitment"
                ],

                maxTags: 10,
                dropdown: {
                    maxItems: 20,
                    classname: "tags-look",
                    enabled: 0,
                    closeOnSelect: false
                }
            })



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

        // Handle modal triggers for upload icons
        $('.mic-icon, .video-icon, .upload-icon').on('click', function() {
            var type = $(this).data('type');
            var target = $(this).data('target');
            if (type === 'video') {
                $('#videoTargetField').val(target);
            } else if (type === 'audio') {
                $('#audioTargetField').val(target);
            } else if (type === 'document') {
                $('#documentTargetField').val(target);
            }
        });

        // Prevent form submission for now (to be implemented in backend)
        $('#videoUploadForm, #audioUploadForm, #documentUploadForm').on('submit', function(e) {
            e.preventDefault();
            // alert('File upload functionality will be implemented in the backend phase.');
            $(this).closest('.modal').modal('hide');
        });
    });

    // Toggle filters section
    document.getElementById("toggleFilters").addEventListener("click", function() {
        var filters = document.getElementById("filtersSection");
        if (filters.style.display === "none" || filters.style.display === "") {
            filters.style.display = "block";
        } else {
            filters.style.display = "none";
        }
    });

    // Timer
    let seconds = 0;
    const timerDisplay = document.getElementById('timer');
    const stopwatch = setInterval(() => {
        let mins = Math.floor(seconds / 60);
        let secs = seconds % 60;
        timerDisplay.textContent =
            `${mins.toString().padStart(2, '0')}:${secs.toString().padStart(2, '0')}`;
        seconds++;
    }, 1000);

    // Unique ID input navigation
    function moveNext(current, nextId) {
        if (current.value.length === 1) {
            const next = document.getElementById(nextId);
            if (next) next.focus();
        }
    }

    function movePrev(e, prevId) {
        if (e.key === "Backspace" && e.target.value === "") {
            const prev = document.getElementById(prevId);
            if (prev) prev.focus();
        }
    }

    // Limit input length
    function limitLength(input, maxLength) {
        if (input.value.length > maxLength) {
            input.value = input.value.slice(0, maxLength);
        }
    }

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


<!-- Voice to Text Convet -->
<script>
    const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;

    if (SpeechRecognition) {
        const recognition = new SpeechRecognition();
        recognition.continuous = false;
        recognition.lang = 'en-US';
        recognition.interimResults = true; // Live typing

        let currentInput = null;
        let currentStatus = null;
        let finalTranscript = ''; // 🧠 Declare globally

        document.querySelectorAll('.mic-btn').forEach(button => {
            button.addEventListener('click', () => {
                const inputId = button.getAttribute('data-input');
                const statusId = button.getAttribute('data-status');

                currentInput = document.getElementById(inputId);
                currentStatus = document.getElementById(statusId);

                finalTranscript = ''; // ✅ Reset transcript on every start
                currentInput.value = ''; // ✅ Clear input value
                recognition.start();

                currentStatus.innerText = "🎤 Listening...";
            });
        });

        recognition.onresult = function(event) {
            let interimTranscript = '';

            for (let i = event.resultIndex; i < event.results.length; ++i) {
                const transcript = event.results[i][0].transcript;
                if (event.results[i].isFinal) {
                    finalTranscript += transcript + ' ';
                } else {
                    interimTranscript += transcript;
                }
            }

            if (currentInput) {
                currentInput.value = finalTranscript + interimTranscript;
            }

            if (currentStatus) {
                currentStatus.innerText = "📝 Typing...";
            }
        };

        recognition.onerror = function(event) {
            if (currentStatus) {
                currentStatus.innerText = "❌ Error: " + event.error;
            }
        };

        recognition.onend = function() {
            if (currentStatus && currentStatus.innerText === "📝 Typing...") {
                currentStatus.innerText = "✅ Done!";
            } else if (currentStatus) {
                currentStatus.innerText = "⚠️ No speech detected.";
            }
        };
    } else {
        alert("Speech Recognition not supported in this browser.");
    }
</script>

<script>
    // For first pair
    document.getElementById('rewardInput').addEventListener('input', function() {
        document.getElementById('filter-monetization').value = this.value;
    });

    // For second pair
    document.getElementById('estimated_work_delivery_time').addEventListener('input', function() {
        document.getElementById('filter-execution').value = this.value;
    });
</script>


<!-- ACCORDING TO COMPANY AND USER PERSONAL AND PROFESSIONAL BRICK CREATION -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const checkbox = document.getElementById("forpercomp");
        const companySelect = document.getElementById("company_id");
        const projectSelect = document.getElementById("project_id");

        function toggleFields() {
            if (checkbox.checked) {
                // User mode → blank + disable
                companySelect.value = "";
                projectSelect.value = "";
                companySelect.disabled = true;
                projectSelect.disabled = true;
            } else {
                // Company mode → enable
                companySelect.disabled = false;
                projectSelect.disabled = false;
            }
        }

        // Run on load
        toggleFields();

        // Run on change
        checkbox.addEventListener("change", toggleFields);
    });
</script>
<!-- Shiv Web Developer -->

<script>
    // custome fund type select
    $(document).ready(function () {
        $('#cus_fund_type').on('change', function () {
            const type = $(this).val();
            const container = $('#funding_dynamic_fields');

            // Clear previous fields
            container.html('');

            if (type === 'loan') {
                container.append(`
                    <div class="form-group">
                        <label class="mb-3">Interest Rate (% p.a)</label>
                        <input type="number" step="0.01" class="form-control"
                            name="loan_interest_rate"
                            placeholder="Enter interest rate"
                            value="<?= isset($funding['loan_interest_rate']) ? htmlspecialchars($funding['loan_interest_rate']) : ''; ?>"
                            >
                    </div>
                `);
            }

            else if (type === 'equity') {
                container.append(`
                    <div class="row mb-0">
                        <div class="col-auto" style="padding-right: 19px;   ">
                            <label class="">Pre-Money Valuation</label>
                        </div>
                        <div class="col-auto">
                            <input type="number" class="form-control"
                                name="pre_money_valuation"
                                placeholder="Enter valuation amount"
                                value="<?= isset($funding['pre_money_valuation']) ? htmlspecialchars($funding['pre_money_valuation']) : ''; ?>"
                                >
                        </div>
                        
                    </div>
                    <div class="row mt-0">
                        <div class="col-auto">
                            <label class="">Post-Money Valuation</label>
                        </div>
                        <div class="col-auto">
                            <input type="number" class="form-control"
                            name="post_money_valuation"
                            placeholder="Enter valuation amount"
                            value="<?= isset($funding['post_money_valuation']) ? htmlspecialchars($funding['post_money_valuation']) : ''; ?>"
                            >
                        </div>
                    </div>
                `);
            }

            // else if (type === 'bonds') {
            //     container.append(`
            //         <div class="form-group">
            //             <label>Bond Tenure (Years)</label>
            //             <input type="number" class="form-control"
            //                 name="bond_tenure"
            //                 placeholder="Enter bond tenure">
            //         </div>
            //     `);
            // }

            else if (type === 'barter') {
                container.append(`
                    <div class="form-group">
                        <label>Do you have a Barter Deal?
                            <i class="fa-solid fa-circle-info text-primary position-relative" style="cursor: pointer;top: -5px;" data-bs-toggle="tooltip" data-bs-placement="top" title="Describe any barter deal for funding."></i>
                        </label>
                        <textarea class="form-control" name="barter_deal" rows="2" placeholder=""><?= isset($funding['barter_deal']) ? htmlspecialchars($funding['barter_deal']) : ''; ?></textarea>
                    </div>
                `);
            }

            else if (type === 'other') {
                container.append(`
                    <div class="form-group">
                        <label class="mb-3">Specify Funding Details</label>
                        <input type="text" class="form-control"
                            name="other_funding_type"
                            placeholder="Enter details"
                            value="<?= isset($funding['other_funding_type']) ? htmlspecialchars($funding['other_funding_type']) : ''; ?>"
                            >
                    </div>
                `);
            }
        });
    });

</script>
<style>
    .table {
        position: relative;
        top: unset;
        left: unset;
        transform: unset;
        width: 100%;
        height: unset;
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

    button[type='submit'] {
        width: unset;
    }
</style>

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

    #wordCounter {
        font-size: 12px;
    }

    .counter {
        font-size: 13px;
        margin-top: 5px;
        color: #555;
    }
</style>

<style>
    select:disabled {
        background-color: #e9ecef;
        /* light gray blur */
        color: #6c757d;
    }
</style>

<style>
    .modal-overlay {
     position: fixed;
     top: 0;
     left: 0;
     width: 100vw;
     height: 100vh;
     background-color: rgba(0, 0, 0, 0.7);
     display: none;
     align-items: start;
     justify-content: center;
     z-index: 1000;
     overflow-y: auto;
     padding-top: 40px;
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

   .custom-table {
     width: 100%;
     border-collapse: collapse;
     margin-top: 10px;
   }

   .btn-primary{
     font-size: unset;
   }
</style>
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body pt-0 mt-5">
    <div class="row text-center">
        <div class="col-12">
            <?php
                if ($this->session->has_userdata('taskMsg')) {
                    echo $this->session->userdata('taskMsg');
                    $this->session->unset_userdata('taskMsg');
                }
            ?>
            <div class="card-body pt-3">
                <div>
                    <h4 class="mb-md-5 mb-3 ps-2">S13 - Medical Identity Pathology</h4>
                </div>

                <!-- Section Enabled Disable -->
                <div id="questionBox1" class="p-md-5 pt-md-3 pb-md-3 dotted-bottom ps-md-3"
                    style="position:relative; border-left: 3px solid #7f1b54; border-right: 3px solid #7f1b54; border-bottom: 2px dotted #ccc;">
                    <div class="d-flex align-items-center">
                        <label class="me-2">S<sup>13</sup><span style="font-size:12px; color:red;">*</span> Medical
                            Identity Pathology </label>
                        <label class="switch me-2">
                            <input type="checkbox" class="enableSwitch" data-index="1" name="show_res_1" checked>
                            <span class="slider round"></span>
                        </label>
                        <span class="enableDisableLabel" data-index="1">Yes</span> <br />
                    </div>
                    <!-- <label> Medical Identity Pathology </label> -->
                </div>
                <style>
                    select:disabled {
                        background-color: #e9ecef;
                        /* light gray blur */
                        color: #6c757d;
                    }
                </style>
            </div>

            <div id="conditionalForm1">
                <form action="" method="POST">
                    <input type="hidden" name="edit_id" value="<?= isset($editData['id']) ? $editData['id'] : '' ?>">
                    <!-- PATHOLOGY TABLE -->
                    <div class="table-responsive mt-4">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No</th>
                                    <th>Test</th>
                                    <th>Values</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $reports = [
                                    ['key' => 'cbc', 'label' => 'CBC', 'placeholder' => 'Enter CBC report / values'],
                                    ['key' => 'lft', 'label' => 'LFT', 'placeholder' => 'Enter LFT report / values'],
                                    ['key' => 'rft', 'label' => 'RFT', 'placeholder' => 'Enter RFT report / values'],
                                    ['key' => 'urine_rm', 'label' => 'Urine - RM', 'placeholder' => 'Enter Urine routine & microscopy details'],
                                    ['key' => 'stool_rm', 'label' => 'Stool - RM', 'placeholder' => 'Enter Stool routine & microscopy details'],
                                    ['key' => 'diabetes_profile', 'label' => 'Diabetes Profile', 'placeholder' => 'Enter FBS / PPBS / PPDS values'],
                                    ['key' => 'vitamin_b12_d3', 'label' => 'Vitamin B12 & D3', 'placeholder' => 'Enter Vitamin B12 & D3 values'],
                                    ['key' => 'thyroid_profile', 'label' => 'Thyroid Profile', 'placeholder' => 'Enter Thyroid profile report'],
                                    ['key' => 'x_ray', 'label' => 'X-Ray', 'placeholder' => 'Enter X-Ray report'],
                                    ['key' => 'ecg_report', 'label' => 'ECG', 'placeholder' => 'Enter ECG report'],
                                    ['key' => 'mri_report', 'label' => 'MRI', 'placeholder' => 'Enter MRI report'],
                                    ['key' => 'ct_scan_report', 'label' => 'CT-Scan', 'placeholder' => 'Enter CT Scan report'],
                                    ['key' => 'ultra_sound_report', 'label' => 'Ultra-Sound', 'placeholder' => 'Enter Ultra Sound report'],

                                    // existing params (DATE)
                                    ['key' => 'physical_params', 'label' => 'Physical Parameters', 'placeholder' => 'Height, Weight, BMI, Temperature, etc'],
                                    ['key' => 'anatomical_params', 'label' => 'Anatomical Parameters', 'placeholder' => 'Organ size, structure, abnormalities'],
                                    ['key' => 'physiological_params', 'label' => 'Physiological Parameters', 'placeholder' => 'Heart rate, BP, respiration, etc'],
                                    ['key' => 'physiotherapy_params', 'label' => 'Physiotherapy Parameters', 'placeholder' => 'Mobility, pain score, rehab notes'],
                                    ['key' => 'acupuncture_points_params', 'label' => 'Acupuncture Points Parameters', 'placeholder' => 'Points used, response, frequency'],
                                    ['key' => 'geolocation_coordinates', 'label' => 'Geolocation Coordinates', 'placeholder' => 'Latitude, Longitude'],
                                    ['key' => 'sea_level_params', 'label' => 'Sea Level Parameters', 'placeholder' => 'Altitude / sea level info'],

                                    // 🆕 Environment / live monitoring (TIMESTAMP)
                                    ['key' => 'pm_levels', 'label' => 'PM 2.5 / 5 / 10', 'placeholder' => 'PM2.5, PM5, PM10 values', 'is_timestamp' => true],
                                    ['key' => 'o2_level', 'label' => 'O2 Level', 'placeholder' => 'Oxygen level %', 'is_timestamp' => true],
                                    ['key' => 'co2_level', 'label' => 'CO2 Level', 'placeholder' => 'CO2 ppm', 'is_timestamp' => true],
                                    ['key' => 'toxic_gases_level', 'label' => 'Toxic Gases Level', 'placeholder' => 'CO, NH3, NO2, etc', 'is_timestamp' => true],
                                    ['key' => 'airflow_changes_per_min', 'label' => 'Air Changes / Min (Airflow)', 'placeholder' => 'Airflow changes per minute', 'is_timestamp' => true],
                                    ['key' => 'camera_feed', 'label' => 'Camera Feed', 'placeholder' => 'Camera URL / reference', 'is_timestamp' => true],
                                    ['key' => 'negative_pressure_level', 'label' => 'Negative Pressure Level', 'placeholder' => 'Negative pressure value', 'is_timestamp' => true],
                                    ['key' => 'positive_pressure_level', 'label' => 'Positive Pressure Level', 'placeholder' => 'Positive pressure value', 'is_timestamp' => true],

                                    // 🆕 Hospital / Services / Robotics (DATE)
                                    ['key' => 'opd', 'label' => 'OPD', 'placeholder' => 'Enter OPD notes / observations'],
                                    ['key' => 'ivf_central_lab', 'label' => 'IVF Central Lab', 'placeholder' => 'Enter IVF central lab report / values'],
                                    ['key' => 'general_surgery', 'label' => 'General Surgery', 'placeholder' => 'Enter general surgery notes / procedure details'],
                                    ['key' => 'robotic_surgery_programming', 'label' => 'Robotic Surgery Programming', 'placeholder' => 'Enter robotic surgery programming details'],
                                    ['key' => 'robots_building_robot', 'label' => 'Robots Building Robot', 'placeholder' => 'Enter robot building notes / progress'],
                                    ['key' => 'hydration_cell_response', 'label' => 'Hydration & Cell Response', 'placeholder' => 'Enter hydration / cellular response after food & water intake', 'is_timestamp' => true],
                                    ['key' => 'digestion_realtime_monitoring', 'label' => 'Digestion Realtime Monitoring', 'placeholder' => 'Enter digestion activity / gut response observations', 'is_timestamp' => true],
                                    ['key' => 'bowel_movement_tracking', 'label' => 'Bowel Movement Tracking', 'placeholder' => 'Enter stool formation / bowel movement observations', 'is_timestamp' => true],
                                ];

                                $editData = $editData ?? [];
                                ?>

                                <?php foreach ($reports as $i => $row): ?>
                                    <tr>
                                        <td><?= $i + 1 ?></td>
                                        <td><?= $row['label'] ?></td>
                                        <td>
                                            <textarea 
                                                name="<?= $row['key'] ?>" 
                                                class="form-control" 
                                                rows="2"
                                                placeholder="<?= $row['placeholder'] ?>"><?= isset($editData[$row['key']]) ? trim($editData[$row['key']]) : '' ?></textarea>
                                        </td>
                                        <td>
                                            <?php if (!empty($row['is_timestamp'])): ?>
                                                <input 
                                                    type="datetime-local" 
                                                    name="<?= $row['key'] ?>_at" 
                                                    class="form-control"
                                                    value="<?= !empty($editData[$row['key'].'_at']) 
                                                        ? date('Y-m-d\TH:i', strtotime($editData[$row['key'].'_at'])) 
                                                        : '' ?>">
                                            <?php else: ?>
                                                <input 
                                                    type="date" 
                                                    name="<?= $row['key'] ?>_date" 
                                                    class="form-control"
                                                    value="<?= isset($editData[$row['key'].'_date']) ? $editData[$row['key'].'_date'] : '' ?>">
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>


                            </tbody>
                        </table>
                    </div>
            </div>

            <button type="submit" class="btn btn-primary bg-primary text-white px-5">
                <?= isset($editData['id']) ? 'Update' : 'Post' ?>
            </button>
            </form>
            <!-- FORM END -->

            <div class="card-body pt-3 mt-5">
                <div>
                    <h4 class="mb-md-5 mb-3 ps-2">S13 - Medical Identity Pathology Response</h4>
                </div>

                <!-- Section Enabled Disable -->
                <div id="questionBox2" class="p-md-5 pt-md-3 pb-md-3 dotted-bottom ps-md-3"
                    style="position:relative; border-left: 3px solid #7f1b54; border-right: 3px solid #7f1b54; border-bottom: 2px dotted #ccc;">
                    <div class="d-flex align-items-center">
                        <label class="me-2">S<sup>13</sup><span style="font-size:12px; color:red;">*</span> Medical
                            Identity Pathology Response</label>
                        <label class="switch me-2">
                            <input type="checkbox" class="enableSwitch" data-index="2" name="show_res_1" checked>
                            <span class="slider round"></span>
                        </label>
                        <span class="enableDisableLabel" data-index="1">Yes</span> <br />
                    </div>
                    <!-- <label> Medical Identity Pathology </label> -->
                </div>
                <style>
                    select:disabled {
                        background-color: #e9ecef;
                        /* light gray blur */
                        color: #6c757d;
                    }
                </style>

                <div id="conditionalForm2" class="container" style="">
                        <div class="trlphdpostdoc_listview">
                            <div class="tables table-bordered w-100">
                                <div class="thead">
                                    <div class="tr">
                                        <div style="width:100%;"> <strong> S13 - Responses - Medical Identity </strong> </div>
                                    </div>
                                </div>
                                <div class="tbody">
                                    <?php
                                    if (!empty($getMedicalReports)) {
                                        $i = 1;
                                        foreach ($getMedicalReports as $medicalReport) {
                                            $brickOwnerDetails = $this->CommonModal->getSingleRowById('freelancer', ['id' => $medicalReport['user_id']]);
                                    ?>

                                            <div class="mt-2" style="float: right;"> <strong> Date :</strong> <?= $medicalReport['created_at'] ?> </div>
                                            <div class="tr">
                                                <div class="td1" style="width:80px !important;"> <?= $i++ ?> </div>
                                                <div class="td2">
                                                    <div class="table-resonsive col-md-6 UserProfileTable card mb-0" style="width:460px;">
                                                        <div>
                                                            <?php

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
                                                </div>
                                                <div class="td1" style="display: grid; align-content: center; justify-content: center;">
                                                    <a href="#" class="btn btn-primary d-inline-flex gap-2 align-items-center viewMedicalReportBtn" data-report-id="<?= $medicalReport['id'] ?>">
                                                        <span>View Report</span>
                                                        <i class="bi bi-eye-fill eye-icon"></i>
                                                    </a>
                                                    <?php if ($brickOwnerDetails['id'] == sessionId('freelancer_id')) { ?>

                                                        <a href="<?= base_url('company/medical-identity?edit_id=' . $medicalReport['id']) ?>" class="btn btn-secondary d-inline-flex gap-2 align-items-center mt-2">
                                                            <span>Edit Report</span>
                                                            <i class="bi bi-pencil"></i>
                                                        </a>
                                                        <a href="<?= base_url('company/medical-identity-trash?id=' . $medicalReport['id']) ?>" class="btn btn-danger d-inline-flex gap-2 align-items-center mt-2" onclick="return confirm('Are you sure you want to delete this Medical Report?');">
                                                            <span>Delete Report</span>
                                                            <i class="bi bi-trash"></i>
                                                        </a>
                                                    <?php } else {
                                                        '';
                                                    } ?>
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

<div class="modal-overlay" id="viewMedicalReportModal" style="width:100% !important">
    <div class="modal-box" style="max-width:90% !important; height: 90%; overflow-y: scroll;">
        <span class="modal-close" onclick="closeMedicalReportModal()">&times;</span>
        <div class="d-flex gap-2">
            <h3>Medical Report </h3>
            <a id="print_report_btn" href="" class="btn btn-primary d-flex align-items-center gap-2">Print <i class="fa-solid fa-print"></i></a>
        </div>
        <table class="custom-table table table-bordered">
            <thead>
                <tr>
                    <th>Type</th>
                    <th>Report</th>
                    <th>View</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>

<script>
    const medicalReports = <?= json_encode($getMedicalReports, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP); ?>;
</script>

<script>
    // Toggle section visibility
    document.querySelectorAll('.enableSwitch').forEach((switchElement) => {
        switchElement.addEventListener('change', function () {
            const index = this.getAttribute('data-index');
            const label = document.querySelector('.enableDisableLabel[data-index="' + index + '"]');
            const form = document.getElementById('conditionalForm' + index);
            const questionBox = document.getElementById('questionBox' + index);
            console.log("form", form);

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

    let report_id = '';
    document.querySelectorAll('.viewMedicalReportBtn').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            report_id = this.getAttribute('data-report-id');
            console.log("Report Release ID:", report_id); // you can use this for AJAX

            // TO DO: load AJAX data here if needed
            renderMedicalReport(report_id);
            openMedicalReportModal();
        });
    });

    function openMedicalReportModal() {
        document.getElementById('viewMedicalReportModal').style.display = 'flex';
    }

    function closeMedicalReportModal() {
        document.getElementById('viewMedicalReportModal').style.display = 'none';
    }


    function renderMedicalReport(reportId) {
        const print_report_btn = document.getElementById('print_report_btn');
        print_report_btn.href = "<?= base_url('home/print_medical_report?id=') ?>" + reportId;

        const tbody = document.querySelector('#viewMedicalReportModal tbody');
        tbody.innerHTML = '';

        const report = medicalReports.find(r => r.id == reportId);

        if (!report) {
            tbody.innerHTML = `<tr><td colspan="4">No data found</td></tr>`;
            return;
        }

        const tests = [
            ['CBC', 'cbc', 'cbc_date'],
            ['LFT', 'lft', 'lft_date'],
            ['RFT', 'rft', 'rft_date'],
            ['Urine RM', 'urine_rm', 'urine_rm_date'],
            ['Stool RM', 'stool_rm', 'stool_rm_date'],
            ['Diabetes Profile', 'diabetes_profile', 'diabetes_profile_date'],
            ['Vitamin B12 & D3', 'vitamin_b12_d3', 'vitamin_b12_d3_date'],
            ['Thyroid Profile', 'thyroid_profile', 'thyroid_profile_date'],
            ['X-Ray', 'x_ray', 'x_ray_date'],
            ['ECG', 'ecg_report', 'ecg_report_date'],
            ['MRI', 'mri_report', 'mri_report_date'],
            ['CT-Scan', 'ct_scan_report', 'ct_scan_report_date'],
            ['Ultra-Sound', 'ultra_sound_report', 'ultra_sound_report_date'],

            // Existing params (DATE)
            ['Physical Parameters', 'physical_params', 'physical_params_date'],
            ['Anatomical Parameters', 'anatomical_params', 'anatomical_params_date'],
            ['Physiological Parameters', 'physiological_params', 'physiological_params_date'],
            ['Physiotherapy Parameters', 'physiotherapy_params', 'physiotherapy_params_date'],
            ['Acupuncture Points', 'acupuncture_points_params', 'acupuncture_points_params_date'],
            ['Geolocation Coordinates', 'geolocation_coordinates', 'geolocation_coordinates_date'],
            ['Sea Level Parameters', 'sea_level_params', 'sea_level_params_date'],

            // 🆕 Environment / monitoring (TIMESTAMP)
            ['PM 2.5 / 5 / 10', 'pm_levels', 'pm_levels_at'],
            ['O2 Level', 'o2_level', 'o2_level_at'],
            ['CO2 Level', 'co2_level', 'co2_level_at'],
            ['Toxic Gases Level', 'toxic_gases_level', 'toxic_gases_level_at'],
            ['Air Changes / Min (Airflow)', 'airflow_changes_per_min', 'airflow_changes_per_min_at'],
            ['Camera Feed', 'camera_feed', 'camera_feed_at'],
            ['Negative Pressure Level', 'negative_pressure_level', 'negative_pressure_level_at'],
            ['Positive Pressure Level', 'positive_pressure_level', 'positive_pressure_level_at'],

            // 🆕 Hospital / Services / Robotics (DATE)
            ['OPD', 'opd', 'opd_date'],
            ['IVF Central Lab', 'ivf_central_lab', 'ivf_central_lab_date'],
            ['General Surgery', 'general_surgery', 'general_surgery_date'],
            ['Robotic Surgery Programming', 'robotic_surgery_programming', 'robotic_surgery_programming_date'],
            ['Robots Building Robot', 'robots_building_robot', 'robots_building_robot_date'],
            ['Hydration & Cell Response', 'hydration_cell_response', 'hydration_cell_response_at' ],
            ['Digestion Realtime Monitoring', 'digestion_realtime_monitoring', 'digestion_realtime_monitoring_at'],
            ['Bowel Movement Tracking', 'bowel_movement_tracking', 'bowel_movement_tracking_at' ],
        ];

        tests.forEach(([label, valueKey, timeKey]) => {
            const value = report[valueKey];

            if (value && String(value).trim() !== '') {

                let view_btn = `<a href="<?= base_url("home/print_medical_report?id=") ?>${reportId}&type=${valueKey}">
                    <i class="bi bi-eye-fill eye-icon"></i>
                </a>`;

                tbody.innerHTML += `
                    <tr>
                        <td>${label}</td>
                        <td style="white-space: pre-line;">${escapeHtml(String(value))}</td>
                        <td>${view_btn}</td>
                        <td>${formatDateTime(report[timeKey])}</td>
                    </tr>
                `;
            }
        });
    }

    function formatDateTime(dt) {
        if (!dt || dt === '0000-00-00' || dt === '0000-00-00 00:00:00') return '-';

        // If it's DATETIME -> show as is
        if (typeof dt === 'string' && dt.includes(' ')) {
            return dt;
        }

        // If it's DATE only
        return dt;
    }


    function openMedicalReportModal() {
        document.getElementById('viewMedicalReportModal').style.display = 'flex';
    }

    function closeMedicalReportModal() {
        document.getElementById('viewMedicalReportModal').style.display = 'none';
    }

    // Helpers
    function formatDate(date) {
        return (!date || date === '0000-00-00') ? '-' : date;
    }

    function escapeHtml(text) {
        return text
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;");
    }

</script>

<script>

</script>
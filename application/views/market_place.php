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
<?php $this->load->view('includes/header'); ?>
<!-- Shiv Web Developer  -->
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body pt-0">
    <!-- <div>
        <h4 class="mb-md-5 mb-3 text-center"> MARKET PLACE </h4>
    </div> -->
    <div class="py-3" style="background-color: #f0f4f7;">
        <h4 class="mb-md-5 mb-3 text-center "> S6 - Merger & Acquisition Panel </h4>
        <!-- Section Enabled Disable -->
        <div id="questionBox1" class="p-md-5 mx-3 pt-md-3 pb-md-3 dotted-bottom ps-md-3" style="position:relative; border-left: 3px solid #7f1b54; border-right: 3px solid #7f1b54; border-bottom: 2px dotted #ccc;">
            <div class="d-flex align-items-center">
                <label class="me-2">S<sub>6</sub> - <span style="font-size:12px; color:red;">*</span> Merger & Acquisition Panel </label>
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

    <div class="container max-width-1470 w-100 bg-white d-flex gap-3 mt-md-3">
        <div class="w-100">
            <div class="row mt-md-0 mb-md-0  pb-md-0 align-items-start">
                <div class="col-md-4 mb-3 mt-md-0">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <button type="button" class="btn btn-primary text-center" style="position:absolute; top:3px; right:41%; width:160px; padding-left:45px;" data-bs-toggle="modal" data-bs-target="#taskDescModal"> Sand Box </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Shiv Web Developer -->
<div class="modal fade" id="taskDescModal" tabindex="-1" aria-labelledby="taskDescModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content p-3">
            <div class="modal-header">
                <h5 class="modal-title" id="taskDescModalLabel">Trade the Project with Public Demand</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 p-0">
                        Trade the Project with Public Demand 1. This Project I want to see executed by XYZ User. for that I m giving 1000 INR Donation. I m ready to Give 1000 INR for Equvity Holding. I m ready to Give 1000 INR for Loan with XYZ %.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Team Members Modal -->

</div>

<!-- Shiv Web Developer  -->
<?php $this->load->view('includes/footer'); ?>
<?php $this->load->view('includes/footer-link'); ?>

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
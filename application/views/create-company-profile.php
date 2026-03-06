<style>
    /* Custom button */
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

    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 100;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        justify-content: center;
        align-items: center;
    }

    /* Modal content */
    .modal-content {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        width: 80%;
        max-width: 700px;
        position: relative;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
    }

    /* Close button */
    .close-btn {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 22px;
        cursor: pointer;
    }

    /* Filter button */
    .filter-btn {
        background-color: #007bff;
        color: white;
        padding: 6px 12px;
        border: none;
        border-radius: 5px;
        margin-bottom: 15px;
        cursor: pointer;
        max-width: 20%;
    }

    .filter-btn i {
        margin-right: 5px;
    }

    /* Table styles */
    .custom-table {
        width: 100%;
        border-collapse: collapse;
    }

    .custom-table th,
    .custom-table td {
        border: 1px solid #ddd;
        padding: 10px;
    }

    .custom-table thead {
        background-color: #f2f2f2;
    }

    @media (max-width: 991px) {
        .form-container {
            padding: 20px;
        }

        .search-section {
            flex-direction: row;
        }

        .field-row {
            flex-direction: row;
        }

        .field-group {
            flex-direction: row;
            align-items: center;
        }

        .field-group .form-label {
            margin-right: 10px;
            margin-bottom: 0;
        }

        .action-buttons {
            flex-direction: row;
            justify-content: space-between;
        }

        .btn-group {
            flex-direction: row;
        }

        .stat-item {
            flex-direction: row;
            align-items: center;
        }

        .stat-label {
            width: 50%;
        }

        .stat-value {
            width: 50%;
        }

        .table-responsive-wrapper {
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        table {
            min-width: 700px;
        }
    }
</style>
<?php include('includes/header.php') ?>
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
    <div class="card border-0">
        <?php
        if ($this->session->has_userdata('taskMsg')) {
            echo $this->session->userdata('taskMsg');
            $this->session->unset_userdata('taskMsg');
        }
        ?>
        <!-- Shiv Web Developer -->
        <?php
        echo "Company Session:" . sessionId('company_id') . "<br>";
        echo "User Session:" . sessionId('freelancer_id') . "<br>";
        ?>
        <form method="POST" action="" class="p-md-3 p-1">
            <div class="row justify-content-center">
                <div class="d-flex gap-0 mb-md-4 p-md-2 p-0 mb-md-1 mb-3">
                    <div class="flex-grow-1">
                        <label class="form-label">Search Company</label>
                        <div class="input-group">
                            <span class="input-group-text bg-white d-flex align-items-center">
                                <i class="fa fa-search text-muted"></i>
                            </span>
                            <input type="text" class="form-control" placeholder="Search companies...">
                        </div>
                        <input type="text" class="form-control mt-2" placeholder="Selected Company" value="TCS">
                    </div>

                    <div class="flex-grow-1">
                        <label class="form-label">Search Project</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search projects..." name="project_search">
                        </div>
                        <input type="text" class="form-control mt-2" placeholder="Selected Project" value="Website Redesign">
                    </div>

                    <div class="flex-grow-1">
                        <label class="form-label">Search Task</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Search tasks..." name="task_search">
                        </div>
                        <input type="text" class="form-control mt-2" placeholder="Selected Task" value="Design Company">
                    </div>
                </div>
                <div class="col-md-6 col-12 p-md-2 p-0">
                    <div class="d-flex align-items-center gap-2 mb-md-1 mb-3">
                        <label class="form-label small text-muted mb-0" style="white-space: nowrap;">
                            CIIN Number <span class="text-danger fs-5">*</span>
                        </label>
                        <input type="text" class="form-control w-100" name="ciin_number" placeholder="Enter CIIN Number" required value="<?= set_value('ciin_number', $getProfile['ciin_number'] ?? ''); ?>">
                        <?= form_error('ciin_number', '<div class="text-danger">', '</div>'); ?>
                    </div>
                </div>

                <div class="col-md-6 col-12 p-md-2 p-0">
                    <div class="d-flex align-items-center gap-2 mb-md-1 mb-3">
                        <label class="form-label small text-muted mb-0" style="white-space: nowrap;">DIPP Number</label>
                        <input type="text" class="form-control w-100" name="dipp_number" placeholder="Enter DIPP Number" value="<?= set_value('dipp_number', $getProfile['dipp_number'] ?? ''); ?>">
                        <?= form_error('dipp_number', '<div class="text-danger">', '</div>'); ?>
                    </div>
                </div>

                <div class="d-flex flex-column flex-md-row gap-3 mb-3 mt-3 w-100 p-md-1 p-0">
                    <div class="form-group d-flex align-items-center w-100">
                        <label for="pan" class="form-label small text-muted" style="width: 40px;">PAN</label>
                        <input type="text" id="pan" class="form-control" name="pan_number" placeholder="Enter PAN" style="flex-grow: 1;" value="<?= set_value('pan_number', $getProfile['pan_number'] ?? ''); ?>" />
                    </div>

                    <div class="form-group d-flex align-items-center w-100">
                        <label for="tan" class="form-label small text-muted" style="width: 40px;">TAN</label>
                        <input type="text" id="tan" class="form-control" placeholder="Enter TAN" name="tan_number" style="flex-grow: 1;" value="<?= set_value('tan_number', $getProfile['tan_number'] ?? ''); ?>" />
                    </div>

                    <div class="form-group d-flex align-items-center w-100">
                        <label for="gst" class="form-labelsmall text-muted" style="width: 40px;">GST</label>
                        <input type="text" id="gst" class="form-control" placeholder="Enter GST" name="gst_number" style="flex-grow: 1;" value="<?= set_value('gst_number', $getProfile['gst_number'] ?? ''); ?>" />
                    </div>
                </div>

                <div class="col-6 dotted-bottom">
                    <label class="form-label small text-muted">Company Name <span class="text-danger fs-5">*</span></label>
                    <input type="text" class="form-control" name="company_name" placeholder="Enter Company Name" required value="<?= set_value('company_name', $getProfile['company_name'] ?? ''); ?>">
                    <?= form_error('company_name', '<div class="text-danger">', '</div>'); ?>
                </div>
                <div class="col-6  dotted-bottom">
                    <label class="form-label small text-muted">Founded Year <span class="text-danger fs-5">*</span></label>
                    <input type="date" class="form-control" name="founded_year" required value="<?= set_value('founded_year', $getProfile['founded_year'] ?? ''); ?>">
                    <?= form_error('founded_year', '<div class="text-danger">', '</div>'); ?>
                </div>

                <h5 class="mt-4">Director Details</h5>
                <div class="table-responsive-wrapper">
                    <table id="directorTable" style="width: 100%; border-collapse: collapse; text-align: center;" class=" dotted-bottom">
                        <thead>
                            <tr>
                                <td style="border: 1px solid #ccc; padding: 10px;"><strong>#</strong></td>
                                <td style="border: 1px solid #ccc; padding: 10px;" class="fs-13"><strong>Director Name</strong></td>
                                <td style="border: 1px solid #ccc; padding: 10px;" class="fs-13"><strong>DIN Number</strong></td>
                                <td style="border: 1px solid #ccc; padding: 10px;" class="fs-13"><strong>Mobile Number</strong></td>
                                <td style="border: 1px solid #ccc; padding: 10px;" class="fs-13"><strong>E-mail</strong></td>
                                <td style="border: 1px solid #ccc; padding: 10px;" class="fs-13"><strong>Permanent Address</strong></td>
                                <td style="border: 1px solid #ccc; padding: 10px; text-align: center;">
                                    <button id="addRowBtn" style="display: flex; align-items: center; justify-content: center; padding: 6px 10px; border: 1px solid #007bff; background-color: #e6f0ff; color: #007bff; border-radius: 4px; cursor: pointer;" type="button">
                                        <i class="fa fa-plus" style="font-size: 16px;"></i>
                                    </button>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="border: 1px solid #ccc; padding: 10px;"><strong>1.</strong></td>
                                <td style="border: 1px solid #ccc; padding: 10px;">
                                    <input type="text" class="fs-13" placeholder="Enter Director Name" name="director_name[]" style="width: 100%; padding: 5px; border: 1px solid #888; outline: none; text-align: center; border-radius: 4px;" />
                                </td>
                                <td style="border: 1px solid #ccc; padding: 10px;">
                                    <input type="text" class="fs-13" placeholder="Enter DIN Number" name="director_din_number[]" style="width: 100%; padding: 5px; border: 1px solid #888; outline: none; text-align: center; border-radius: 4px;" />
                                </td>
                                <td style="border: 1px solid #ccc; padding: 10px;">
                                    <input type="text" class="fs-13" placeholder="Enter Mobile Number" name="director_mobile_number[]" style="width: 100%; padding: 5px; border: 1px solid #888; outline: none; text-align: center; border-radius: 4px;" />
                                </td>
                                <td style="border: 1px solid #ccc; padding: 10px;">
                                    <input type="text" class="fs-13" placeholder="Enter Email" name="director_email[]" style="width: 100%; padding: 5px; border: 1px solid #888; outline: none; text-align: center; border-radius: 4px;" />
                                </td>
                                <td style="border: 1px solid #ccc; padding: 10px;">
                                    <input type="text" class="fs-13" placeholder="Enter Permanent Address" name="director_address[]" style="width: 100%; padding: 5px; border: 1px solid #888; outline: none; text-align: center; border-radius: 4px;" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <h5 class="mt-4">Account Details</h5>
                <div class="table-responsive-wrapper">
                    <table id="accountTable" style="width: 100%; border-collapse: collapse; text-align: center;" class="mb-3 dotted-bottom">
                        <thead>
                            <tr>
                                <td style="border: 1px solid #ccc; padding: 10px;" class="fs-13"><strong>#</strong></td>
                                <td style="border: 1px solid #ccc; padding: 10px;" class="fs-13"><strong>Account Holder Name</strong></td>
                                <td style="border: 1px solid #ccc; padding: 10px;" class="fs-13"><strong>Account Number</strong></td>
                                <td style="border: 1px solid #ccc; padding: 10px;" class="fs-13"><strong>Bank Name</strong></td>
                                <td style="border: 1px solid #ccc; padding: 10px;" class="fs-13"><strong>IFSC Code</strong></td>
                                <td style="border: 1px solid #ccc; padding: 10px; text-align: center;">
                                    <button id="account-addRowBtn" style="display: flex; align-items: center; justify-content: center; padding: 6px 10px; border: 1px solid #007bff; background-color: #e6f0ff; color: #007bff; border-radius: 4px; cursor: pointer;" type="button">
                                        <i class="fa fa-plus" style="font-size: 16px;"></i>
                                    </button>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="border: 1px solid #ccc; padding: 10px;"><strong>1.</strong></td>
                                <td style="border: 1px solid #ccc; padding: 10px;">
                                    <input type="text" class="fs-13" placeholder="Account Holder" name="account_holder_name[]" style="width: 100%; padding: 5px; border: 1px solid #888; outline: none; text-align: center; border-radius: 4px;" />
                                </td>
                                <td style="border: 1px solid #ccc; padding: 10px;">
                                    <input type="text" class="fs-13" placeholder="Account Number" name="account_number[]" style="width: 100%; padding: 5px; border: 1px solid #888; outline: none; text-align: center; border-radius: 4px;" />
                                </td>
                                <td style="border: 1px solid #ccc; padding: 10px;">
                                    <input type="text" class="fs-13" placeholder="Bank Name" name="bank_name[]" style="width: 100%; padding: 5px; border: 1px solid #888; outline: none; text-align: center; border-radius: 4px;" />
                                </td>
                                <td style="border: 1px solid #ccc; padding: 10px;">
                                    <input type="text" class="fs-13" placeholder="IFSC Code" name="ifsc_code[]" style="width: 100%; padding: 5px; border: 1px solid #888; outline: none; text-align: center; border-radius: 4px;" />
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-between flex-wrap gap-3 mt-3">
                    <div class="d-flex gap-3 flex-wrap align-items-center">
                        <div class="d-flex gap-0 align-items-center">
                            <button type="button" class="btn btn-secondary shadow-sm create-company-profile"
                                style="background-color: #6c757d;">
                                Permanent Employer count<br>at the time of account creation
                            </button>

                            <div class="border rounded px-3 py-2 bg-white shadow-sm text-center" style="min-width: 200px;">
                                <input type="text" name="employercount" class="form-control text-center border-0 bg-transparent fw-bold p-0" />
                            </div>
                        </div>
                        <?= form_error('employercount', '<div class="text-danger">', '</div>'); ?>

                        <div class="d-flex gap-0 align-items-center">
                            <button type="button" class="btn btn-info shadow-sm create-company-profile">
                                Current Employer Count
                            </button>
                            <div class="border rounded px-3 py-2 bg-white shadow-sm text-center" style="min-width: 200px;">
                                <input type="text" name="currentemployercount" class="form-control text-center border-0 bg-transparent fw-bold p-0" />
                            </div>
                        </div>
                        <?= form_error('currentemployercount', '<div class="text-danger">', '</div>'); ?>

                    </div>

                    <div class="d-flex gap-3 align-items-center">
                        <!-- <button id="openModalBtn" class="custom-btn">
                            <i class="fa fa-list"></i> Total Projects
                        </button> -->
                        <a href="<?= base_url('company/project-profile') ?>" class="custom-btn text-decoration-none create-company-profile">
                            <i class="fa fa-list"></i> Total Projects
                        </a>

                        <button type="button" class="btn btn-warning shadow-sm text-dark">
                            <i class="fa fa-hourglass-half me-2"></i> Projects Pending Request
                        </button>
                    </div>

                    <div class="d-flex gap-3 flex-wrap align-items-center">
                        <div class="d-flex gap-0 align-items-center">
                            <button type="button" class="btn btn-secondary shadow-sm create-company-profile"
                                style="background-color: #6c757d;">
                                Lifetime Revenue generated at <br>the time of account creation
                            </button>
                            <div class="border rounded px-3 py-2 bg-white shadow-sm text-center" style="min-width: 200px;">
                                <input type="text" name="lifetimerevenue" class="form-control text-center border-0 bg-transparent fw-bold p-0" />
                            </div>
                        </div>
                        <?= form_error('lifetimerevenue', '<div class="text-danger">', '</div>'); ?>


                        <div class="d-flex gap-0 align-items-center">
                            <button type="button" class="btn btn-secondary shadow-sm create-company-profile"
                                style="background-color: #0dcaf0;">
                                Current Revenue generated at <br> the time of account creation
                            </button>
                            <div class="border rounded px-3 py-2 bg-white shadow-sm text-center" style="min-width: 200px;">
                                <input type="text" name="currentlifetimerevenue" class="form-control text-center border-0 bg-transparent fw-bold p-0" />
                            </div>
                        </div>
                        <?= form_error('currentlifetimerevenue', '<div class="text-danger">', '</div>'); ?>

                    </div>
                </div>

                <div class="col-12 mt-3">
                    <label class="form-label small text-muted">About Us <span class="text-danger fs-5">*</span></label>
                    <textarea class="form-control" name="about_us" rows="5" placeholder="Enter Company Details" required><?= set_value('about_us', $getProfile['about_us'] ?? ''); ?></textarea>
                    <?= form_error('about_us', '<div class="text-danger">', '</div>'); ?>
                </div>

                <div class="col-12 mt-3">
                    <label class="form-label small text-muted">Mission <span class="text-danger fs-5">*</span></label>
                    <textarea class="form-control" name="mission" rows="3" placeholder="Enter Company Mission" required><?= set_value('mission', $getProfile['mission'] ?? ''); ?></textarea>
                    <?= form_error('mission', '<div class="text-danger">', '</div>'); ?>
                </div>

                <div class="col-12 mt-3">
                    <label class="form-label small text-muted">Vision <span class="text-danger fs-5">*</span></label>
                    <textarea class="form-control" name="vision" rows="3" placeholder="Enter Company Vision" required><?= set_value('vision', $getProfile['vision'] ?? ''); ?></textarea>
                    <?= form_error('vision', '<div class="text-danger">', '</div>'); ?>
                </div>

                <div class="col-6 mt-3 mb-md-1 mb-3">
                    <label class="form-label small text-muted">Company Valuation</label>
                    <input type="number" class="form-control" name="valuation" placeholder="Enter Company Valuation" step="0.01" value="<?= set_value('valuation', $getProfile['valuation'] ?? ''); ?>">
                    <?= form_error('valuation', '<div class="text-danger">', '</div>'); ?>
                </div>

                <div class="col-6 mt-3 mb-md-1   mb-3">
                    <label class="form-label small text-muted">Equity Dilution (%)</label>
                    <input type="number" class="form-control" name="equity_dilution" placeholder="Enter Equity Dilution" step="0.01" value="<?= set_value('equity_dilution', $getProfile['equity_dilution'] ?? ''); ?>">
                    <?= form_error('equity_dilution', '<div class="text-danger">', '</div>'); ?>
                </div>


                <div class="col-md-5 d-flex justify-content-center gap-0 mt-md-4">
                    <!-- <a href="<?= base_url('company/preview_brick') ?>" class="btn custom-upload-btn w-100" style="border-radius: 10px 0px 0px 10px;">
                        Submit
                    </a> -->

                    <button type="submit" class="btn custom-upload-btn w-100" style="border-radius: 10px 0px 0px 10px;">Save Changes</button>
                    <a href="<?= base_url('company/company-preview') ?>" class="btn custom-upload-btn pdf-upload-btn w-100" target="_blank" style="border-radius: 0px;">
                        Preview Company
                    </a>
                    <div class="col-md-4 d-flex flex-column align-items-center gap-2">
                        <button class="btn custom-upload-btn w-100" style="border-radius: 0px 10px 10px 0px;">Save Draft</button>
                    </div>

                </div>

            </div>
        </form>
    </div>
</div>

<!-- Shiv Web Developer -->
<div id="customModal" class="modal">
    <div class="modal-content">
        <span class="close-btn">&times;</span>
        <h2>Total Projects</h2>

        <button class="filter-btn">
            <i class="fa fa-filter"></i> Filter
        </button>

        <table class="custom-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Title</th>
                    <th>Total Brick Count</th>
                    <!-- <th>Start Date</th> -->
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Project A</td>
                    <td>6</td>
                    <!-- <td>2024-01-10</td> -->
                </tr>
                <tr>
                    <td>2</td>
                    <td>Project B</td>
                    <td>8</td>
                    <!-- <td>2023-12-05</td> -->
                </tr>
            </tbody>
        </table>
    </div>
</div>
<?php include('includes/footer-link.php') ?>
<script>
    const openBtn = document.getElementById('openModalBtn');
    const modal = document.getElementById('customModal');
    const closeBtn = document.querySelector('.close-btn');

    openBtn.onclick = () => {
        modal.style.display = 'flex';
    }

    closeBtn.onclick = () => {
        modal.style.display = 'none';
    }

    window.onclick = (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const directorTable = document.getElementById('directorTable');
        const addRowBtn = document.getElementById('addRowBtn');
        const accountAddRowBtn = document.getElementById('account-addRowBtn');
        const accountTable = document.getElementById('accountTable');

        accountAddRowBtn.addEventListener('click', () => {
            const tbody = accountTable.querySelector('tbody');
            const rowCount = tbody.rows.length + 1;

            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td style="border: 1px solid #ccc; padding: 10px;"><strong>${rowCount}.</strong></td>
                <td style="border: 1px solid #ccc; padding: 10px;">
                                <input type="text" placeholder="Account Holder" name="account_holder_name[]" style="width: 100%; padding: 5px; border: 1px solid #888; outline: none; text-align: center; border-radius: 4px;" />
                            </td>
                            <td style="border: 1px solid #ccc; padding: 10px;">
                                <input type="text" placeholder="Account Number" name="account_number[]" style="width: 100%; padding: 5px; border: 1px solid #888; outline: none; text-align: center; border-radius: 4px;" />
                            </td>
                            <td style="border: 1px solid #ccc; padding: 10px;">
                                <input type="text" placeholder="Bank Name" name="bank_name[]" style="width: 100%; padding: 5px; border: 1px solid #888; outline: none; text-align: center; border-radius: 4px;" />
                            </td>
                            <td style="border: 1px solid #ccc; padding: 10px;">
                                <input type="text" placeholder="IFSC Code" name="ifsc_code[]" style="width: 100%; padding: 5px; border: 1px solid #888; outline: none; text-align: center; border-radius: 4px;" />
                            </td>
            `;
            tbody.appendChild(newRow);
        });
        addRowBtn.addEventListener('click', () => {
            const tbody = directorTable.querySelector('tbody');
            const rowCount = tbody.rows.length + 1;

            const newRow = document.createElement('tr');
            newRow.innerHTML = `
                <td style="border: 1px solid #ccc; padding: 10px;"><strong>${rowCount}.</strong></td>
                <td style="border: 1px solid #ccc; padding: 10px;">
                    <input type="text" placeholder="Enter Director Name" name="director_name[]" style="width: 100%; padding: 5px; border: 1px solid #888; outline: none; text-align: center; border-radius: 4px;" />
                </td>
                <td style="border: 1px solid #ccc; padding: 10px;">
                    <input type="text" placeholder="Enter DIN Number" name="director_din_number[]" style="width: 100%; padding: 5px; border: 1px solid #888; outline: none; text-align: center; border-radius: 4px;" />
                </td>
                <td style="border: 1px solid #ccc; padding: 10px;">
                    <input type="text" placeholder="Enter Mobile Number" name="director_mobile_number[]" style="width: 100%; padding: 5px; border: 1px solid #888; outline: none; text-align: center; border-radius: 4px;" />
                </td>
                <td style="border: 1px solid #ccc; padding: 10px;">
                    <input type="text" placeholder="Enter Email" name="director_email[]" style="width: 100%; padding: 5px; border: 1px solid #888; outline: none; text-align: center; border-radius: 4px;" />
                </td>
                <td style="border: 1px solid #ccc; padding: 10px;">
                    <input type="text" placeholder="Enter Permanent Address" name="director_address[]" style="width: 100%; padding: 5px; border: 1px solid #888; outline: none; text-align: center; border-radius: 4px;" />
                </td>
            `;
            tbody.appendChild(newRow);
        });
    });
</script>
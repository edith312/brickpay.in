<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Financial Report</title>
    <link rel="icon" type="image/x-icon" href="http://localhost/brickpay.in/assets/images/logo.png">
	<link rel="icon" type="image/png" sizes="16x16" href="http://localhost/brickpay.in/assets/images/logo.png">
	<link rel="icon" type="image/png" sizes="32x32" href="http://localhost/brickpay.in/assets/images/logo.png">
	<link rel="apple-touch-icon" sizes="180x180" href="http://localhost/brickpay.in/assets/images/logo.png">
	<link rel="stylesheet" href="http://localhost/brickpay.in/assets/css/style.min.css">
	<link rel="stylesheet" href="http://localhost/brickpay.in/assets/css/dataTables.min.css">
	<link rel="stylesheet" href="http://localhost/brickpay.in/assets/css/poornima.css">
	<link rel="stylesheet" href="http://localhost/brickpay.in/assets/css/prism.min.css">
	<link rel="stylesheet" href="http://localhost/brickpay.in/assets/css/flatpickr.min.css">
	<link rel="stylesheet" href="http://localhost/brickpay.in/assets/css/tagify.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
	<!-- FontAwesome CDN -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
	<!-- Bootstrap CSS -->
	<!-- Shiv Web Developer -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <style>
        .custom-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        .custom-table th,
        .custom-table td {
            padding: 10px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h5 class="modal-title text-center mb-5">Financial Reports</h5>
            </div>
            <div class="col-12">
                <?php if ($this->session->flashdata('success')): ?>
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('success'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <?php if ($this->session->flashdata('error')): ?>
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?= $this->session->flashdata('error'); ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>
                <div class="">
                    <p><span><b>Company Name:</b></span> <?= $getProfile['company_name'] ?></p>
                    <p><span><b>CIN:</b></span> <?= $getProfile['ciin_number'] ?></p>
                </div>
                <table class="custom-table text-center">
                    <thead>
                        <th></th>
                        <th></th>
                        <th>Traditional</th>
                        <th colspan='2'>Innovation</th>
                        <th>AI</th>
                    </thead>
                    <thead class="">
                        <th>S.No</th>
                        <th>Year</th>
                        <th>Upload</th>
                        <th>View Report</th>
                        <th>Read Time</th>
                        <th></th>
                    </thead>
                    <tbody>
                            <?php foreach($getProfile['financial_years'] as $key => $financial_year): ?>
                            <?php
                                $hasReport = !empty($reportsByYear[$financial_year]);
                                $report    = $hasReport ? $reportsByYear[$financial_year] : null;
                            ?>
                            <tr>
                                <td><?= ++$key ?></td>
                                <td><?= htmlspecialchars($financial_year) ?></td>

                                <form action="<?= base_url('home/save_project_financial_report') ?>" 
                                    method="POST" 
                                    enctype="multipart/form-data">
                                    <input type="hidden" name="company_id" value="<?= $getProfile['id'] ?>">
                                    <input type="hidden" name="year" value="<?= $financial_year ?>">

                                    <td>
                                        <div class="d-flex align-items-center justify-content-center gap-2">
                                            <label for="financial_report_file_<?= $getProfile['id'].'_'.$financial_year ?>" 
                                                class="btn"
                                                title="<?= $hasReport ? 'Replace Financial Report' : 'Upload Financial Report' ?>">
                                                <i class="fas fa-file-alt me-1"
                                                style="color: <?= $hasReport ? '#198754' : '#fd7e14' ?>;"></i>
                                            </label>

                                            <input type="file"
                                                id="financial_report_file_<?= $getProfile['id'].'_'.$financial_year ?>"
                                                name="financial_report_file"
                                                class="d-none"
                                                onchange="if(this.files.length) this.form.submit()">
                                        </div>    
                                    </td>
                                </form>

                                <td class="text-center">
                                    <?php if ($hasReport): ?>
                                        <a href="<?= base_url($report['file_path']) ?>" 
                                        target="_blank"
                                        title="View Financial Report">
                                            <i class="bi bi-eye-fill eye-icon text-success"></i>
                                        </a>
                                    <?php else: ?>
                                        <span class="text-muted" title="Not uploaded yet">
                                            <i class="bi bi-eye-slash"></i>
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td class="text-center">
                                    <a id="view_min_<?= $key ?>" 
                                    title="View Details" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#report_min_modal">
                                        <i class="bi bi-eye-fill eye-icon"></i>
                                    </a>
                                </td>
                                <td></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <div id="report_min_modal" class="modal" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Financial Reports</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="custom-table text-center">
                                <thead class="">
                                    <tr>
                                        <th>Time (Minutes)</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1 min</td>
                                        <td>
                                            <a href="javascript:void(0)" id="view_1" title="View Details">
                                                <i class="bi bi-eye-fill eye-icon"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2 min</td>
                                        <td>
                                            <a href="javascript:void(0)" id="view_2" title="View Details">
                                                <i class="bi bi-eye-fill eye-icon"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3 min</td>
                                        <td>
                                            <a href="javascript:void(0)" id="view_3" title="View Details">
                                                <i class="bi bi-eye-fill eye-icon"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5 min</td>
                                        <td>
                                            <a href="javascript:void(0)" id="view_5" title="View Details">
                                                <i class="bi bi-eye-fill eye-icon"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>10 min</td>
                                        <td>
                                            <a href="javascript:void(0)" id="view_10" title="View Details">
                                                <i class="bi bi-eye-fill eye-icon"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>15 min</td>
                                        <td>
                                            <a href="javascript:void((0)" id="view_15" title="View Details">
                                                <i class="bi bi-eye-fill eye-icon"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>30 min</td>
                                        <td>
                                            <a href="javascript:void(0)" id="view_30" title="View Details">
                                                <i class="bi bi-eye-fill eye-icon"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>45 min</td>
                                        <td>
                                            <a href="javascript:void(0)" id="view_45" title="View Details">
                                                <i class="bi bi-eye-fill eye-icon"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>60 min</td>
                                        <td>
                                            <a href="javascript:void(0)" id="view_60" title="View Details">
                                                <i class="bi bi-eye-fill eye-icon"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                        </div>
                        </div>
                    </div>
                    </div>
            </div>
        </div>
    </div>
    <script src="http://localhost/brickpay.in/assets/bundles/libscripts.bundle.js"></script>
    <script src="http://localhost/brickpay.in/assets/bundles/tagify.bundle.js"></script>
    <script src="http://localhost/brickpay.in/assets/bundles/flatpickr.bundle.js"></script>
    <script src="http://localhost/brickpay.in/assets/js/main.js"></script>
    <script>
        document.documentElement.setAttribute('data-bs-theme', 'light');
    </script>
</body>
</html>
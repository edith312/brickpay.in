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
                <h5 class="modal-title text-center mb-5">Added Valuation</h5>
            </div>
            <div class="">
                <p><span><b>Project Name:</b></span> <?= $getProject['project_name'] ?></p>
            </div>
            <table class="table table-bordered table-striped custom-table">
                <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Brick Id</th>
                        <th>Added Valuation</th>
                        <th>Date & Time</th>
                    </tr>
                </thead>
                <tbody class="addevValuation_Container">
                    <!-- Rows will be injected here -->
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4" class="text-end" id="totalValuationCell"></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
    <script src="http://localhost/brickpay.in/assets/bundles/libscripts.bundle.js"></script>
    <script src="http://localhost/brickpay.in/assets/bundles/tagify.bundle.js"></script>
    <script src="http://localhost/brickpay.in/assets/bundles/flatpickr.bundle.js"></script>
    <script src="http://localhost/brickpay.in/assets/js/main.js"></script>
    <script>
        document.documentElement.setAttribute('data-bs-theme', 'light');
    </script>
    <script>
        function loadAddedValuation() {
            let project_id = "<?= $project_id ?>";

            $.ajax({
                url: "<?= base_url("Home/getAddedValuation") ?>",
                type: "POST",
                data: { project_id },
                dataType: "json",
                success: function (response) {
                    if (response.success) {
                        let rowsHtml = '';
                        let i = 1;

                        response.rows.forEach(function (row) {
                            rowsHtml += `
                                <tr>
                                    <td>${i++}</td>
                                    <td>${row.brick_id}</td>
                                    <td>Rs. ${row.addedValuation}/-</td>
                                    <td>${row.created_at}</td>
                                </tr>
                            `;
                        });

                        // Inject rows
                        $('.addevValuation_Container').html(rowsHtml);

                        // Update total valuation
                        $('#totalValuationCell').html(`<strong>Total Valuation: Rs. ${response.totalValuation}/-</strong>`);
                    }
                },
                error: function (xhr) {
                    console.error("AJAX Error:", xhr);
                }
            });
        }
        loadAddedValuation();
    </script>
</body>
</html>
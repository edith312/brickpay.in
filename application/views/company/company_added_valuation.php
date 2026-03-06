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
            position: relative;
            top: 0px;
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
                <p><span><b>Company Name:</b></span> <?= $getProfile['company_name'] ?></p>
                <p><span><b>CIN:</b></span> <?= $getProfile['ciin_number'] ?></p>
            </div>
            <table class="table table-bordered table-striped custom-table">
                <thead>
                    <tr>
                        <th>Sr No.</th>
                        <th>Project Id</th>
                        <th>Added Valuation</th>
                    </tr>
                </thead>
                <tbody class="addevValuation_Container">
                    <!-- Rows will be injected here -->
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="3" class="text-end" id="totalValuationCell"></th>
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
    function loadAddedValuation () {

        let company_id = "<?= $company_id ?>";

        $.ajax({
            url: "<?= base_url("Home/getAddedValuationCompany") ?>",
            type: "POST",
            data: { company_id },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    let rowsHtml = '';
                    let i = 1;

                    response.rows.forEach(function (row) {
                        rowsHtml += `
                            <tr>
                                <td>${i++}</td>
                                <td>${row.project_id}</td>
                                <td class="text-end">Rs. ${row.addedValuation}/-</td>
                            </tr>
                        `;
                    });

                    $('.addevValuation_Container').html(rowsHtml);

                    $('#totalValuationCell').html(
                        `<strong>Total Valuation: Rs. ${response.totalValuation}/-</strong>`
                    );
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
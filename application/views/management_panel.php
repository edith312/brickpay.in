<?php $this->load->view('includes/header'); ?>

<style>
    .assigned-section {
        padding: 20px;
        background: #fff;
        border-radius: 8px;
    }

    .assigned-boxes {
        display: flex;
        justify-content: space-around;
        flex-wrap: wrap;
    }

    .box {
        padding: 15px;
        margin: 10px;
        background: #f1f1f1;
        border-radius: 5px;
        min-width: 150px;
    }
</style>

<div class="p-md-5 page-body">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="text-center mb-md-5">Brick Management Panel</h2>
            <div class="row" style="width: 100%;">
                <div class="col-md-4 col-lg-4">
                    <div class="input-group py-2">
                        <span class="input-group-text bg-white border-end-0 d-flex align-items-center"
                            style="height: 100%;">
                            <i class="fa fa-search text-muted" style="height: 21px;"></i>
                        </span>
                        <select class="form-control mb-0" name="company_id" id="company_id">
                            <option disabled selected>Select Company</option>
                            <?php if ($getCompanies) {
                                foreach ($getCompanies as $company) { ?>
                                    <option value="<?= $company['id']; ?>">
                                        <?= $company['company_name']; ?> (CIN: <?= $company['ciin_number']; ?>)
                                    </option>
                                <?php }
                            } else { ?>
                                <option disabled selected>No Company Found</option>
                            <?php } ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-4 col-lg-4">
                    <div class="input-group py-2">
                        <span class="input-group-text bg-white border-end-0 d-flex align-items-center"
                            style="height: 100%;">
                            <i class="fa fa-search text-muted" style="height: 21px;"></i>
                        </span>
                        <select class="form-control mb-0" name="project_id" id="project_id">
                            <option disabled selected>Select Project</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4 col-lg-4">
                    <div class="input-group py-2">
                        <span class="input-group-text bg-white border-end-0 d-flex align-items-center"
                            style="height: 100%;">
                            <i class="fa fa-search text-muted" style="height: 20px;"></i>
                        </span>
                        <select class="form-control mb-0" name="brick_id" id="brick_id">
                            <option disabled selected>Select Brick</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- Selection Type Display -->
            <div class="col-12 mt-3">
                <div class="alert alert-info" id="selectionTypeAlert" style="display: none;">
                    <strong>Current Selection:</strong> <span id="selectionTypeText"></span>
                    <span id="modeIndicator" class="badge bg-primary ms-2"></span>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6 mb-md-2 mb-4 mt-4">
                    <div class="border rounded shadow-sm bg-white">
                        <div class="bg-primary text-white px-4 py-2 rounded-top">
                            <h5 class="mb-0 fund-management">Fund Management</h5>
                        </div>
                        <div class="p-2" id="fundingTableBody">
                            <p class="fs-13">Your
                                <strong>
                                    <?php
                                    echo $ActiveBricksCount;
                                    ?>
                                </strong>
                                active bricks have received
                                <strong>
                                    <?php
                                    echo $ActiveBricksFundReq;
                                    ?>
                                </strong>
                                funding requests. Allocate now!
                            </p>
                            <div class="d-flex align-items-center mb-3">
                                <label for="chooseBrick" class="me-2">Choose Brick:</label>
                                <input type="text" id="chooseBrick" class="form-control" style="max-width: 200px;">
                            </div>

                            <div class="d-flex align-items-center justify-content-between mb-4">
                                <p class="mb-0">25 Bids</p>
                                <button class="btn btn-primary funding-btns">Show All Funding Bids</button>
                            </div>

                            <div class="container-fluid">
                                <div class="d-flex">
                                    <div
                                        class="w-50 bg-primary text-white p-2 text-start rounded-start position-relative fs-11">
                                        Funded By
                                    </div>
                                    <div
                                        class="border-start border-white w-50 bg-primary text-white p-2 text-start rounded-end fs-11">
                                        <!-- Has offered  -->
                                        <!-- <strong>₹200</strong> <span class="ms-2">2%</span> 
                                        <small>on Date Time</small> -->
                                        Fund Amount
                                    </div>
                                </div>
                                <div style="overflow-y: scroll; height: 300px;">

                                    <?php if (!empty($ActiveBricksFundAll)) {
                                        foreach ($ActiveBricksFundAll as $fund) {
                                            // Get the freelancer info by ID
                                            $freelancers = $this->CommonModal->getRowByIdInOrder('freelancer', ['id' => $fund['funded_by']], 'id', 'DESC');

                                            // Check if freelancer data is available
                                            if (!empty($freelancers)) {
                                                // Assuming getRowByIdInOrder returns an array of results
                                                $freelancer = $freelancers[0];
                                    ?>
                                                <div style="display: flex;">
                                                    <div style="width: 50%;">
                                                        <div style="border: 1px solid #ced4da; height: 40px; font-size:13px">
                                                            <?php
                                                            if (isset($freelancer['user_image']) && !empty($freelancer['user_image'])) {
                                                                $profileImage = base_url() . 'uploads/user_profile/' . $freelancer['user_image'];
                                                            } else {
                                                                $profileImage = base_url() . 'assets/images/profile_av.png';
                                                            }
                                                            ?>
                                                            <img src="<?= $profileImage ?>" alt="User Image"
                                                                style="width: 30px; height: 30px; margin: 5px; border-radius:100%;">
                                                            <?= htmlspecialchars($freelancer['name'] ?? 'Unknown User') ?>

                                                            <a href="<?= base_url('/company/profile_preview?id=') . $freelancer['id'] ?>"
                                                                class="text-dark"
                                                                style="margin-right: 5px; margin-top: 10px; float:right;" target="_blank">
                                                                <i class="fas fa-eye"></i>
                                                            </a>

                                                            <!-- <input type="text" style="width: 100%; height: 100%; border: none; outline: none;" /> -->
                                                        </div>
                                                    </div>

                                                    <div style="width: 50%;">
                                                        <div style="border: 1px solid #ced4da; height: 40px; font-size:13px;">
                                                            <div class="mt-2 px-1">
                                                                Rs. <?= $fund['fund_amount']; ?>/-
                                                                [ <?= $fund['fund_percentage']; ?>% ]

                                                                <?php
                                                                if ($fund['fund_status'] == 'Pending') {
                                                                ?>

                                                                    <div
                                                                        style="float: right; margin-right: 5px; margin-top:2px; display:flex;">
                                                                        <form action="<?= base_url() ?>company/fundRequestProcess"
                                                                            method="post">
                                                                            <input type="hidden" name="id" value="<?= $fund['id']; ?>">
                                                                            <input type="hidden" name="fund_status" value="Approve">
                                                                            <button type="submit"
                                                                                class="text-dark btn-primary text-white btn p-0 px-1 mx-1"
                                                                                style="font-size: 11px; margin-top:2px;">
                                                                                <i class="fa-solid fa-check p-0 m-0"></i> Approve
                                                                            </button>
                                                                        </form>
                                                                        <form action="<?= base_url() ?>company/fundRequestProcess"
                                                                            method="post">
                                                                            <input type="hidden" name="id" value="<?= $fund['id']; ?>">
                                                                            <input type="hidden" name="fund_status" value="Reject">
                                                                            <button type="submit"
                                                                                class="text-dark btn-danger text-white btn p-0 px-1"
                                                                                style="font-size: 10px;">
                                                                                <i class="fa-solid fa-xmark"></i> Reject
                                                                            </button>
                                                                        </form>
                                                                    </div>

                                                                <?php
                                                                } else if ($fund['fund_status'] == 'Approve') {
                                                                ?>
                                                                    <span class="text-dark btn-success text-white btn p-0 px-1"
                                                                        style="font-size: 10px; float:right;">
                                                                        Approved
                                                                    </span>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <span class="text-dark btn-danger text-white btn p-0 px-1"
                                                                        style="font-size: 10px; float:right;">
                                                                        Rejected
                                                                    </span>
                                                                <?php
                                                                };
                                                                ?>



                                                            </div>
                                                            <!-- <input type="text" style="width: 100%; height: 100%; border: none; outline: none;" /> -->
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php
                                            } // end freelancer check
                                        } // end foreach
                                    } // end if ActiveBricksFundAll
                                    ?>


                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 mb-md-2 mb-4 mt-4">
                    <div class="border rounded shadow-sm bg-white">
                        <div class="bg-primary text-white px-4 py-2 rounded-top">
                            <h5 class="mb-0 fund-management">Work Allotment</h5>
                        </div>
                        <div class="p-2" id="workAllotmentBody">
                            <p class="fs-13">Your
                                <strong>
                                    <?php
                                    echo $ActiveBricksCount;
                                    ?>
                                </strong>
                                active bricks have received
                                <strong>
                                    <?php
                                    echo $workAllotmentRequestcount;
                                    ?>
                                </strong>
                                work requests. Allocate now!
                            </p>
                            <div class="d-flex align-items-center mb-3">
                                <label for="chooseBrick" class="me-2">Choose Brick:</label>
                                <input type="text" id="chooseBrick" class="form-control" style="max-width: 200px;">
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-md-2 mb-4">
                                <p class="mb-0">20 Bids</p>
                                <button class="btn btn-primary funding-btns">Show All Received Application</button>
                            </div>

                            <div class="container-fluid">
                                <div class="d-flex">
                                    <div
                                        class="w-50 bg-primary text-white p-2 text-start rounded-start position-relative fs-11">
                                        Freelancer Details
                                    </div>
                                    <div
                                        class="border-start border-white w-50 bg-primary text-white p-2 text-start rounded-end fs-11">
                                        Bid Details
                                    </div>
                                </div>

                                <div style="overflow-y: scroll; height: 300px;">

                                    <?php if (!empty($workAllotmentList)) {
                                        foreach ($workAllotmentList as $Allotment) {
                                            // Get the freelancer info by ID
                                            $freelancers = $this->CommonModal->getRowByIdInOrder('freelancer', ['id' => $Allotment['allotment_by']], 'id', 'DESC');

                                            // Check if freelancer data is available
                                            if (!empty($freelancers)) {
                                                // Assuming getRowByIdInOrder returns an array of results
                                                $freelancer = $freelancers[0];
                                    ?>
                                                <div style="display: flex;">
                                                    <div style="width: 50%;">
                                                        <div style="border: 1px solid #ced4da; height: 40px; font-size:13px">
                                                            <?php
                                                            if (isset($freelancer['user_image']) && !empty($freelancer['user_image'])) {
                                                                $profileImage = base_url() . 'uploads/user_profile/' . $freelancer['user_image'];
                                                            } else {
                                                                $profileImage = base_url() . 'assets/images/profile_av.png';
                                                            }
                                                            ?>
                                                            <img src="<?= $profileImage ?>" alt="User Image"
                                                                style="width: 30px; height: 30px; margin: 5px; border-radius:100%;">
                                                            <?= htmlspecialchars($freelancer['name'] ?? 'Unknown User') ?>

                                                            <a href="<?= base_url('/company/profile_preview?id=') . $freelancer['id'] ?>"
                                                                class="text-dark"
                                                                style="margin-right: 5px; margin-top: 10px; float:right;" target="_blank">
                                                                <i class="fas fa-eye"></i>
                                                            </a>

                                                            <!-- <input type="text" style="width: 100%; height: 100%; border: none; outline: none;" /> -->
                                                        </div>
                                                    </div>

                                                    <div style="width: 50%;">
                                                        <div style="border: 1px solid #ced4da; height: 40px; font-size:13px;">
                                                            <div class="mt-2 px-1">
                                                                Rs. <?= $Allotment['bid_amount']; ?>/-
                                                                [ <?= $Allotment['delivery_time']; ?> ]

                                                                <?php
                                                                if ($Allotment['status'] == 'Pending') {
                                                                ?>

                                                                    <div
                                                                        style="float: right; margin-right: 5px; margin-top:0px; display:flex;">
                                                                        <form action="<?= base_url() ?>company/workAllotmentRequestProcess"
                                                                            method="post">
                                                                            <input type="hidden" name="id" value="<?= $Allotment['id']; ?>">
                                                                            <input type="hidden" name="status" value="Accept">
                                                                            <button type="submit"
                                                                                class="text-dark btn-primary text-white btn p-0 px-1 mx-1"
                                                                                style="font-size: 11px; margin-top:2px;">
                                                                                <i class="fa-solid fa-check p-0 m-0"></i> Accept
                                                                            </button>
                                                                        </form>
                                                                        <form action="<?= base_url() ?>company/workAllotmentRequestProcess"
                                                                            method="post">
                                                                            <input type="hidden" name="id" value="<?= $Allotment['id']; ?>">
                                                                            <input type="hidden" name="status" value="Reject">
                                                                            <button type="submit"
                                                                                class="text-dark btn-danger text-white btn p-0 px-1 mt-0"
                                                                                style="font-size: 10px;">
                                                                                <i class="fa-solid fa-xmark"></i> Reject
                                                                            </button>
                                                                        </form>
                                                                    </div>

                                                                <?php
                                                                } else if ($Allotment['status'] == 'Accept') {
                                                                ?>
                                                                    <span class="text-dark btn-success text-white btn p-0 px-1"
                                                                        style="font-size: 10px; float:right;">
                                                                        Accepted
                                                                    </span>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <span class="text-dark btn-danger text-white btn p-0 px-1"
                                                                        style="font-size: 10px; float:right;">
                                                                        Rejected
                                                                    </span>
                                                                <?php
                                                                };
                                                                ?>



                                                            </div>
                                                            <!-- <input type="text" style="width: 100%; height: 100%; border: none; outline: none;" /> -->
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php
                                            } // end freelancer check
                                        } // end foreach
                                    } // end if ActiveBricksFundAll
                                    ?>

                                </div>


                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-6 mb-md-2 mb-4">
                    <div class="border rounded shadow-sm bg-white">
                        <div class="bg-primary text-white px-4 py-2 rounded-top">
                            <h5 class="mb-0 fund-management">Manage Pass Channel</h5>
                        </div>
                        <div class="p-2">
                            <div class="d-flex align-items-center mb-3">
                                <label for="chooseBrick" class="me-2">Choose Brick:</label>
                                <input type="text" id="chooseBrick" class="form-control" style="max-width: 200px;">
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-md-2 mb-4">
                                <p class="mb-0">20 Bids</p>
                                <button class="btn btn-primary funding-btns">Show All Received Application</button>
                            </div>
                            <div class="container-fluid">
                                <div class="d-flex">
                                    <div
                                        class="w-50 bg-primary text-white p-2 text-start rounded-start position-relative fs-11">
                                        Pass Received 250
                                    </div>
                                    <div
                                        class="border-start border-white w-50 bg-primary text-white p-2 text-start rounded-end fs-11">
                                        Make Pass
                                    </div>
                                </div>

                                <div style="display: flex;">
                                    <div style="width: 50%;">
                                        <div style="border: 1px solid #ced4da; height: 30px;">
                                            <input type="text"
                                                style="width: 100%; height: 100%; border: none; outline: none;" />
                                        </div>
                                        <div style="border: 1px solid #ced4da; height: 30px;">
                                            <input type="text"
                                                style="width: 100%; height: 100%; border: none; outline: none;" />
                                        </div>
                                        <div style="border: 1px solid #ced4da; height: 30px;">
                                            <input type="text"
                                                style="width: 100%; height: 100%; border: none; outline: none;" />
                                        </div>
                                        <div style="border: 1px solid #ced4da; height: 30px;">
                                            <input type="text"
                                                style="width: 100%; height: 100%; border: none; outline: none;" />
                                        </div>
                                        <div style="border: 1px solid #ced4da; height: 30px;">
                                            <input type="text"
                                                style="width: 100%; height: 100%; border: none; outline: none;" />
                                        </div>
                                    </div>

                                    <div style="width: 50%;">
                                        <div style="border: 1px solid #ced4da; height: 30px;">
                                            <input type="text"
                                                style="width: 100%; height: 100%; border: none; outline: none;" />
                                        </div>
                                        <div style="border: 1px solid #ced4da; height: 30px;">
                                            <input type="text"
                                                style="width: 100%; height: 100%; border: none; outline: none;" />
                                        </div>
                                        <div style="border: 1px solid #ced4da; height: 30px;">
                                            <input type="text"
                                                style="width: 100%; height: 100%; border: none; outline: none;" />
                                        </div>
                                        <div style="border: 1px solid #ced4da; height: 30px;">
                                            <input type="text"
                                                style="width: 100%; height: 100%; border: none; outline: none;" />
                                        </div>
                                        <div style="border: 1px solid #ced4da; height: 30px;">
                                            <input type="text"
                                                style="width: 100%; height: 100%; border: none; outline: none;" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-md-6 mb-md-2 mb-4 mt-2">
                    <div class="border rounded shadow-sm bg-white">
                        <div
                            class="bg-primary text-white px-4 py-2 rounded-top d-flex justify-content-between align-items-center">
                            <h5 class="mb-0 fund-management">Project</h5>
                            <select id="consultancy_type" class="form-select form-select-sm bg-primary text-white border-0 w-auto"
                                style="box-shadow: none;">
                                <option selected disabled>Filter</option>
                                <option value="Consultancy">Consultancy</option>
                                <option value="Advisory">Advisory</option>
                                <option value="Mentorship">Mentorship</option>
                            </select>
                        </div>

                        <div class="p-2" id="BrickConsultancyBody">
                            <p class="fs-13">Your
                                <strong>
                                    <?php
                                    echo $ActiveBricksCount;
                                    ?>
                                </strong>
                                active bricks have received
                                <strong>
                                    <?php
                                    echo $BrickConsultacyCount;
                                    ?>
                                </strong>
                                work Consultancy requests. Allocate now!
                            </p>
                            <div class="d-flex align-items-center mb-3">
                                <label for="chooseBrick" class="me-2">Choose Brick:</label>
                                <input type="text" id="chooseBrick" class="form-control" style="max-width: 200px;">
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-md-2 mb-4">
                                <p class="mb-0">20 Bids</p>
                                <button class="btn btn-primary funding-btns">Show All Received Application</button>
                            </div>
                            <div class="container-fluid">
                                <div class="d-flex">
                                    <div
                                        class="w-50 bg-primary text-white p-2 text-start rounded-start position-relative fs-11">
                                        Consultancy Advisory
                                    </div>
                                    <div
                                        class="border-start border-white w-50 bg-primary text-white p-2 text-start rounded-end fs-11">
                                        Consultancy Details
                                    </div>
                                </div>
                                <div style="overflow-y: scroll; height: 300px;">

                                    <?php if (!empty($BrickConsultancyList)) {
                                        foreach ($BrickConsultancyList as $Consultancy) {
                                            // Get the freelancer info by ID
                                            $freelancers = $this->CommonModal->getRowByIdInOrder('freelancer', ['id' => $Consultancy['consultancy_by']], 'id', 'DESC');

                                            // Check if freelancer data is available
                                            if (!empty($freelancers)) {
                                                // Assuming getRowByIdInOrder returns an array of results
                                                $freelancer = $freelancers[0];
                                    ?>
                                                <div style="display: flex;">
                                                    <div style="width: 50%;">
                                                        <div style="border: 1px solid #ced4da; height: 40px; font-size:13px">
                                                            <?php
                                                            if (isset($freelancer['user_image']) && !empty($freelancer['user_image'])) {
                                                                $profileImage = base_url() . 'uploads/user_profile/' . $freelancer['user_image'];
                                                            } else {
                                                                $profileImage = base_url() . 'assets/images/profile_av.png';
                                                            }
                                                            ?>
                                                            <img src="<?= $profileImage ?>" alt="User Image"
                                                                style="width: 30px; height: 30px; margin: 5px; border-radius:100%;">
                                                            <?= htmlspecialchars($freelancer['name'] ?? 'Unknown User') ?>

                                                            <a href="<?= base_url('/company/profile_preview?id=') . $freelancer['id'] ?>"
                                                                class="text-dark"
                                                                style="margin-right: 5px; margin-top: 10px; float:right;" target="_blank">
                                                                <i class="fas fa-eye"></i>
                                                            </a>

                                                            <!-- <input type="text" style="width: 100%; height: 100%; border: none; outline: none;" /> -->
                                                        </div>
                                                    </div>

                                                    <div style="width: 50%;">
                                                        <div style="border: 1px solid #ced4da; height: 40px; font-size:13px;">
                                                            <div class="mt-2 px-1">
                                                                <?= $Consultancy['message']; ?>
                                                                [ <?= $Consultancy['money']; ?> ]

                                                                <?php
                                                                if ($Consultancy['status'] == 'Pending') {
                                                                ?>

                                                                    <div
                                                                        style="float: right; margin-right: 5px; margin-top:0px; display:flex;">
                                                                        <form action="<?= base_url() ?>company/brickConsultancyRequestProcess"
                                                                            method="post">
                                                                            <input type="hidden" name="id" value="<?= $Consultancy['id']; ?>">
                                                                            <input type="hidden" name="status" value="Accept">
                                                                            <button type="submit"
                                                                                class="text-dark btn-primary text-white btn p-0 px-1 mx-1"
                                                                                style="font-size: 11px; margin-top:2px;">
                                                                                <i class="fa-solid fa-check p-0 m-0"></i> Accept
                                                                            </button>
                                                                        </form>
                                                                        <form action="<?= base_url() ?>company/brickConsultancyRequestProcess"
                                                                            method="post">
                                                                            <input type="hidden" name="id" value="<?= $Consultancy['id']; ?>">
                                                                            <input type="hidden" name="status" value="Reject">
                                                                            <button type="submit"
                                                                                class="text-dark btn-danger text-white btn p-0 px-1 mt-0"
                                                                                style="font-size: 10px;">
                                                                                <i class="fa-solid fa-xmark"></i> Reject
                                                                            </button>
                                                                        </form>
                                                                    </div>

                                                                <?php
                                                                } else if ($Consultancy['status'] == 'Accept') {
                                                                ?>
                                                                    <span class="text-dark btn-success text-white btn p-0 px-1"
                                                                        style="font-size: 10px; float:right;">
                                                                        Accepted
                                                                    </span>
                                                                <?php
                                                                } else {
                                                                ?>
                                                                    <span class="text-dark btn-danger text-white btn p-0 px-1"
                                                                        style="font-size: 10px; float:right;">
                                                                        Rejected
                                                                    </span>
                                                                <?php
                                                                };
                                                                ?>

                                                            </div>
                                                            <!-- <input type="text" style="width: 100%; height: 100%; border: none; outline: none;" /> -->
                                                        </div>
                                                    </div>
                                                </div>
                                    <?php
                                            } // end freelancer check
                                        } // end foreach
                                    } // end if ActiveBricksFundAll
                                    ?>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="negotiation-wrapper">
                <div class="negotiation-grid">
                    <div class="cell head">Negotiation Bar</div>
                    <div class="cell head">V1</div>
                    <div class="cell head">V2</div>
                    <div class="cell head">V3</div>
                    <div class="cell head"></div>
                    <div class="cell head"></div>

                    <div class="cell">User1</div>
                    <div class="cell">Value 1</div>
                    <div class="cell">Value 2</div>
                    <div class="cell">Value 3</div>
                    <div class="cell"><i class="fas fa-handshake"></i> user1</div>
                    <div class="cell">It's a Deal</div>

                    <div class="cell">User1</div>
                    <div class="cell">Value 4</div>
                    <div class="cell">Value 5</div>
                    <div class="cell">Value 6</div>
                    <div class="cell"><i class="fas fa-handshake"></i> user1</div>
                    <div class="cell">No Deal by User 1</div>
                </div>
            </div>
        </div>

        <!-- @Shiv Web Developer on 13 July 2025 -->
        <div class="assigned-section mt-5 g-0">
            <h3 class="assigned-heading text-center">Assigned</h3>
            <div class="assigned-boxes">
                <div class="box text-center">
                    <div class="d-flex justify-content-center align-items-center mb-2">
                        <span class="label me-2">Split %</span>
                        <select class="form-select me-2" id="mainDropdown" onchange="showSubDropdown()">
                            <option value="">Select Option</option>
                            <option value="decision">Decision Making</option>
                            <option value="project">Payment %</option>
                        </select>
                        <select class="form-select me-2 d-none" id="subDropdown">
                            <option value="1">Company</option>
                            <option value="2">Project</option>
                            <option value="3">Layer</option>
                        </select>
                    </div>
                </div>

                <div class="box">
                    <span class="label">Milestone</span>
                    <div class="mt-2">
                        <a href="<?= base_url('company/') ?>" class="btn btn-sm btn-primary">Fund Now</a>
                    </div>
                </div>
                <div class="box"><span class="label">Sweat Equity</span></div>
                <div class="box"><span class="label">Resume Split</span></div>
                <div class="box"><span class="label">JV</span></div>
            </div>
        </div>

        <!-- </div> -->
    </div>
</div>


<?php $this->load->view('includes/footer'); ?>


<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script>
    // const companies = [
    //     "Tata Consultancy Services",
    //     "Infosys Limited",
    //     "Wipro Technologies",
    //     "HCL Technologies",
    //     "Reliance Industries",
    //     "Adani Group",
    //     "Tech Mahindra",
    //     "Mahindra & Mahindra",
    //     "Larsen & Toubro",
    //     "Capgemini India"
    // ];

    // const projects = [
    //     "Website Redesign",
    //     "Mobile App Development",
    //     "Digital Marketing Campaign",
    //     "Cloud Migration",
    //     "CRM Integration",
    //     "E-commerce Platform Setup",
    //     "Data Analytics Dashboard",
    //     "HR Management System",
    //     "Customer Support Portal",
    //     "Inventory Management System"
    // ];

    // const tasks = [
    //     "Prepare Financial Report",
    //     "Design Company Logo",
    //     "Develop Marketing Strategy",
    //     "Update Website Content",
    //     "Client Onboarding",
    //     "Conduct Team Meeting",
    //     "Software Deployment",
    //     "Write Technical Documentation",
    //     "Social Media Management",
    //     "Market Research"
    // ];

    // function setupAutocomplete(inputId, listId, dataArray) {
    //     const input = document.querySelector(inputId);
    //     const list = document.querySelector(listId);

    //     input.addEventListener("input", () => {
    //         const val = input.value.toLowerCase();
    //         list.innerHTML = "";

    //         if (val === "") {
    //             list.classList.add("d-none");
    //             return;
    //         }

    //         const filtered = dataArray.filter(item =>
    //             item.toLowerCase().includes(val)
    //         );

    //         if (filtered.length === 0) {
    //             list.classList.add("d-none");
    //             return;
    //         }

    //         filtered.forEach(item => {
    //             const li = document.createElement("li");
    //             li.className = "list-group-item list-group-item-action";
    //             li.textContent = item;
    //             li.addEventListener("click", () => {
    //                 input.value = item;
    //                 list.classList.add("d-none");
    //             });
    //             list.appendChild(li);
    //         });

    //         list.classList.remove("d-none");
    //     });

    //     // Hide suggestions when input loses focus
    //     input.addEventListener("blur", () => {
    //         setTimeout(() => list.classList.add("d-none"), 100);
    //     });
    // }

    // Setup autocomplete for all fields
    // document.addEventListener("DOMContentLoaded", () => {
    //     setupAutocomplete("input[name='company_search']", "#company-list", companies);
    //     setupAutocomplete("input[name='projects_search']", "#project-list", projects);
    //     setupAutocomplete("input[name='task_search']", "#task-list", tasks);
    // });


    // @Shiv Web Developer on 07 July 2025
    $(document).ready(function() {

        let currentCompanyId = null;
        let currentProjectId = null;
        let currentBrickId = null;
        let currentSelectionType = null;


        // Company change handler
        $('#company_id').on('change', function() {
            currentCompanyId = $(this).val();
            currentProjectId = null;
            currentBrickId = null;
            currentSelectionType = 'company';
            currentMode = '';

            $('#project_id').html('<option disabled selected>Select Project</option>');
            $('#brick_id').html('<option disabled selected>Select Brick</option>');

            updateSelectionDisplay();

            if (currentCompanyId) {
                fetchFundRequests(currentCompanyId);
                fetchWorkallotment(currentCompanyId);
                fetchProjects(currentCompanyId);
                fetchBrickConsultancy(currentCompanyId);
                if (currentMode === 'edit') {
                    loadExistingTeamStructure();
                }
            };

        });

        // Project change handler
        $('#project_id').on('change', function() {
            currentProjectId = $(this).val();
            currentBrickId = null;

            if (currentProjectId) {
                currentSelectionType = 'project';
                $('#brick_id').html('<option disabled selected>Select Brick</option>');

                updateSelectionDisplay();

                if (currentCompanyId && currentProjectId) {
                    fetchFundRequestsproject(currentCompanyId, currentProjectId);
                    fetchWorkallotmentproject(currentCompanyId, currentProjectId);
                    fetchBrickConsultancyProject(currentCompanyId, currentProjectId);
                    fetchBricks(currentCompanyId, currentProjectId);
                    if (currentMode === 'edit') {
                        loadExistingTeamStructure();
                    }
                }


            }
        });

        // Brick change handler
        $('#brick_id').on('change', function() {
            currentBrickId = $(this).val();

            if (currentCompanyId && currentProjectId && currentBrickId) {
                fetchFundRequestsprojectbricks(currentCompanyId, currentProjectId, currentBrickId);
                fetchWorkallotmentprojectbricks(currentCompanyId, currentProjectId, currentBrickId);
                fetchBrickConsultancyProjectBricks(currentCompanyId, currentProjectId, currentBrickId);

                currentSelectionType = 'brick';
                updateSelectionDisplay();
                if (currentMode === 'edit') {
                    loadExistingTeamStructure();
                }
            }

        });

        function updateSelectionDisplay() {
            const alert = $('#selectionTypeAlert');
            const text = $('#selectionTypeText');

            if (currentSelectionType) {
                let displayText = '';
                switch (currentSelectionType) {
                    case 'company':
                        displayText = `Company Selected (ID: ${currentCompanyId})`;
                        break;
                    case 'project':
                        displayText = `Project Selected (ID: ${currentProjectId})`;
                        break;
                    case 'brick':
                        displayText = `Brick Selected (ID: ${currentBrickId})`;
                        break;
                }
                text.text(displayText);
                alert.show();
            } else {
                alert.hide();
            }
        }

        function getCurrentId() {
            if (currentSelectionType === 'brick' && currentBrickId) return currentBrickId;
            if (currentSelectionType === 'project' && currentProjectId) return currentProjectId;
            if (currentSelectionType === 'company' && currentCompanyId) return currentCompanyId;
            return null;
        }

        function fetchProjects(companyId) {
            $.post('<?= base_url('Home/fetch_projects') ?>', {
                    company_id: companyId
                })
                .done(function(response) {

                    const json = JSON.parse(response);

                    if (json.success) {
                        let options = '<option disabled selected>Select Project</option>';
                        json.projects.forEach(project => {
                            options += `<option value="${project.id}">${project.project_name}</option>`;
                        });
                        
                        $('#project_id').html(options);
                    } else {
                        $('#project_id').html('<option disabled selected>No Projects Found</option>');
                    }
                })
                .fail(function() {
                    $('#project_id').html('<option disabled selected>Error Loading Projects</option>');
                });
        }

        function fetchBricks(companyId, projectId) {
            $.post('<?= base_url('Home/fetch_bricks') ?>', {
                    company_id: companyId,
                    project_id: projectId
                })
                .done(function(response) {

                    const json = JSON.parse(response);

                    if (json.success) {
                        let options = '<option disabled selected>Select Brick</option>';
                        json.bricks.forEach(brick => {
                            options += `<option value="${brick.id}">${brick.brick_title}</option>`;
                        });
                        $('#brick_id').html(options);
                    } else {
                        $('#brick_id').html('<option disabled selected>No Bricks Found</option>');
                    }
                })
                .fail(function() {
                    $('#brick_id').html('<option disabled selected>Error Loading Bricks</option>');
                });
        }



        function fetchFundRequests(companyId) {
            $.post('<?= base_url('Home/fetchFundRequests') ?>', {
                    company_id: companyId
                })
                .done(function(response) {
                    $('#fundingTableBody').html(response);
                })
                .fail(function(xhr) {
                    $('#fundingTableBody').html('<div>Error loading data</div>');
                });
        }

        function fetchFundRequestsproject(companyId, currentProjectId) {
            $.post('<?= base_url('Home/fetchFundRequestsproject') ?>', {
                    company_id: companyId,
                    currentProjectId: currentProjectId
                })
                .done(function(response) {
                    $('#fundingTableBody').html(response);
                })
                .fail(function(xhr) {
                    $('#fundingTableBody').html('<div>Error loading data</div>');
                });
        }

        function fetchFundRequestsprojectbricks(companyId, currentProjectId, currentBrickId) {
            $.post('<?= base_url('Home/fetchFundRequestsprojectbricks') ?>', {
                    company_id: companyId,
                    currentProjectId: currentProjectId,
                    brick_id: currentBrickId
                })
                .done(function(response) {
                    $('#fundingTableBody').html(response);
                })
                .fail(function(xhr) {
                    $('#fundingTableBody').html('<div>Error loading data</div>');
                });
        }

        function fetchFundRequestsproject(companyId, currentProjectId) {
            $.post('<?= base_url('Home/fetchFundRequestsproject') ?>', {
                    company_id: companyId,
                    currentProjectId: currentProjectId
                })
                .done(function(response) {
                    $('#fundingTableBody').html(response);
                })
                .fail(function(xhr) {
                    $('#fundingTableBody').html('<div>Error loading data</div>');
                });
        }

        function fetchWorkallotment(companyId) {
            $.post('<?= base_url('Home/fetchWorkAllotment') ?>', {
                    company_id: companyId
                })
                .done(function(response) {
                    console.log("Work Allotment", response);
                    $('#workAllotmentBody').html(response);
                })
                .fail(function(xhr) {
                    $('#workAllotmentBody').html('<div>Error loading data</div>');
                });
        }

        function fetchWorkallotmentproject(companyId, currentProjectId) {
            $.post('<?= base_url('Home/fetchWorkallotmentproject') ?>', {
                    company_id: companyId,
                    currentProjectId: currentProjectId
                })
                .done(function(response) {
                    console.log("Work Allotment", response);
                    $('#workAllotmentBody').html(response);
                })
                .fail(function(xhr) {
                    $('#workAllotmentBody').html('<div>Error loading data</div>');
                });
        }

        function fetchWorkallotmentprojectbricks(companyId, currentProjectId) {
            $.post('<?= base_url('Home/fetchWorkallotmentprojectbricks') ?>', {
                    company_id: companyId,
                    currentProjectId: currentProjectId,
                    brick_id: currentBrickId
                })
                .done(function(response) {
                    console.log("Work Allotment", response);
                    $('#workAllotmentBody').html(response);
                })
                .fail(function(xhr) {
                    $('#workAllotmentBody').html('<div>Error loading data</div>');
                });
        }

        //Brick Consultancy
        function fetchBrickConsultancy(companyId) {
            $.post('<?= base_url('Home/fetchBrickConsultancy') ?>', {
                    company_id: companyId,
                })
                .done(function(response) {
                    $('#BrickConsultancyBody').html(response);
                })
                .fail(function(xhr) {
                    $('#BrickConsultancyBody').html('<div>Error loading data</div>');
                });
        }

        function fetchBrickConsultancyProject(companyId, currentProjectId) {
            $.post('<?= base_url('Home/fetchBrickConsultancyProject') ?>', {
                    company_id: companyId,
                    currentProjectId: currentProjectId,
                })
                .done(function(response) {
                    $('#BrickConsultancyBody').html(response);
                })
                .fail(function(xhr) {
                    $('#BrickConsultancyBody').html('<div>Error loading data</div>');
                });
        }

        function fetchBrickConsultancyProjectBricks(companyId, currentProjectId, currentBrickId) {
            $.post('<?= base_url('Home/fetchBrickConsultancyProjectBricks') ?>', {
                    company_id: companyId,
                    currentProjectId: currentProjectId,
                    currentBrickId: currentBrickId,
                })
                .done(function(response) {
                    $('#BrickConsultancyBody').html(response);
                })
                .fail(function(xhr) {
                    $('#BrickConsultancyBody').html('<div>Error loading data</div>');
                });
        }



        $('#consultancy_type').on('change', function() {
            consultancy_type = $(this).val();

            if (consultancy_type) {
                fetchConsultancyTypeFilter(consultancy_type);
                if (currentMode === 'edit') {
                    loadExistingTeamStructure();
                }
            };

        });

        function fetchConsultancyTypeFilter(consultancy_type) {
            $.post('<?= base_url('Home/fetchConsultancyTypeFilter') ?>', {
                    consultancy_type: consultancy_type,
                })
                .done(function(response) {
                    $('#BrickConsultancyBody').html(response);
                })
                .fail(function(xhr) {
                    $('#BrickConsultancyBody').html('<div>Error loading data</div>');
                });
        }





    });
</script>


<?php $this->load->view('includes/footer-link'); ?>
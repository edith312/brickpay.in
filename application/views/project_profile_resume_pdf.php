<!DOCTYPE html>
<html>

<head>
    <title><?= $title ?></title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 13px;
        }

        h1 {
            color: darkblue;
        }

        .container {
            width: 100%;
            margin: 0 auto;
        }

        .text-center {
            text-align: center;
        }

        .row {
            display: block;
            width: 100%;
        }

        .col-6 {
            width: 50%;
            float: left;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        tr {
            border: 2px solid grey;
        }

        td {
            border: 1px solid lightgrey;
            padding: 5px;
        }

        .td-50 {
            width: 50%;
        }

        .td-100 {
            width: 100%;
        }

        .w-33 {
            width: 33%;
        }

        /* Filters Grid */
        .filters {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 10px;
        }

        .smoking-wrapper {
            width: 50px;
            overflow: hidden;
        }

        .smoking-wrapper.show {
            width: 100%;
        }

        @media (max-width: 991px) {
            .filters {
                grid-template-columns: repeat(1, 1fr);
            }

            .smoking-wrapper {
                width: auto;
                padding: 0;
            }
        }

        /* Project Row Styling */
        .project-row {
            display: grid;
            grid-template-columns: 30px 1fr 1fr 1fr 1fr 50px;
            align-items: center;
            border-radius: 4px;
            color: #00a7cc;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .project-cell {
            padding: 3px 10px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            border: 1px solid #ccc;
        }

        .project-cell.index {
            border-right: 1px solid #ccc;
            text-align: center;
        }

        .eye-icon {
            font-size: 18px;
            color: #00a7cc;
        }

        .project-grid-bottom-1 {
            display: grid;
            grid-template-columns: 30px repeat(4, 1fr);
        }

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
</head>

<!-- Shiv Web Developer -->

<body>

    <div class="container" style="margin-top: 30px;">
        <div style="padding: 5px; font-weight:600;">Project Profile Details</div>

        <table class="table">
            <tbody>
                <tr>
                    <td class="td-50">Project Name: <?= $projectDetails['project_name']; ?></td>
                    <td class="td-50">Project Leader: <?= $projectDetails['project_leader']; ?></td>
                </tr>
                <tr>
                    <td class="td-50">Project Valuation: <?= $projectDetails['project_valuation']; ?></td>
                    <td class="td-50">Issued Shares: <?= $projectDetails['issued_shares']; ?></td>
                </tr>
                <tr>
                    <td class="td-50">Total Layers: <?= $projectDetails['total_layers']; ?></td>
                    <td class="td-50">Total Collaborators: <?= $projectDetails['total_collaborators']; ?></td>
                </tr>
                <tr>
                    <td class="td-50">TAM: <?= $projectDetails['tam']; ?></td>
                    <td class="td-50">SAM: <?= $projectDetails['sam']; ?></td>
                </tr>
                <tr>
                    <td class="td-50">SOM: <?= $projectDetails['som']; ?></td>
                    <td class="td-50">Company Name: <?= $companyId['company_name']; ?></td>
                </tr>
                <tr>
                    <td class="td-50">Layer Range From: <?= $projectDetails['layer_range_from']; ?></td>
                    <td class="td-50">Layer Range To: <?= $projectDetails['layer_range_to']; ?></td>
                </tr>
                <tr>
                    <td class="td-50">Team Range From: <?= $projectDetails['team_range_from']; ?></td>
                    <td class="td-50">Team Range To: <?= $projectDetails['team_range_to']; ?></td>
                </tr>
                <tr>
                    <td class="td-50">Project Document: <?= $projectDetails['project_document']; ?></td>
                    <td class="td-50">Project Pitch: <?= $projectDetails['project_pitch']; ?></td>
                </tr>
                <tr>
                    <td class="td-50">Face Value: <?= $projectDetails['face_value']; ?></td>
                    <td class="td-50">Current Price: <?= $projectDetails['current_price']; ?></td>
                </tr>
                <tr>
                    <td class="td-50">Razorpay Order ID: <?php if ($projectDetails['transaction_status'] == '1') {
                                                                echo 'Success';
                                                            } else {
                                                                echo 'Failed';
                                                            } ?></td>
                    <td class="td-50">Transaction Status: <?= $projectDetails['razorpay_order_id']; ?></td>
                </tr>
                <tr>
                    <td colspan="2" class="td-100">Mission: <?= $projectDetails['mission']; ?></td>
                </tr>
                <tr>
                    <td colspan="2" class="td-100">Vision: <?= $projectDetails['vision']; ?></td>
                </tr>
                <tr>
                    <td colspan="2" class="td-100">Project Overview: <?= $projectDetails['project_overview']; ?></td>
                </tr>
            </tbody>
        </table>

        <!-- Brick List Section -->
        <!-- Brick List Section -->
        <div id="companyList" style="margin-top: 20px;">
            <?php if ($getBricks): ?>
                <div class="brick-grid">
                    <?php
                    $brickCount = 1;
                    foreach ($getBricks as $bricks):
                        $brickFunding = $this->CommonModal->getSingleRowById('tbl_brick_funding', 'brick_id = ' . $bricks['id']);
                    ?>
                        <div class="brick-item">
                            <!-- Brick Header -->
                            <div class="project-row rounded-0"
                                style="border: 1px solid lightgrey; padding:10px; border-left: 4px solid <?= brickColor($bricks['brick_type']) ?>;">

                                <div class="brick-header">
                                    Status: <span class="brickStatus 
                                <?php
                                if ($bricks['brick_completed'] == 'completed') {
                                    echo 'bg-markascompleted';
                                } else if ($bricks['artificialdate'] != NULL) {
                                    echo 'bg-artificialbrick';
                                } else {
                                    echo 'bg-' . ($bricks['brick_status'] == 'draft' ? 'warning' : 'success') . ' text-white';
                                }
                                ?> text-white text-capitalize">
                                        <?php
                                        if ($bricks['brick_completed'] == 'completed') {
                                            echo 'Completed';
                                        } else if ($bricks['artificialdate'] != NULL) {
                                            echo 'Artificial Brick';
                                        } else {
                                            echo ($bricks['brick_status'] == 'draft' ? 'Draft' : 'Live');
                                        }
                                        ?>
                                    </span>

                                    <div class="project-actions">
                                        <a href="<?= base_url('company/preview_brick?id=' . $bricks['id']) ?>" title="View Details">
                                            <i class="bi bi-eye-fill eye-icon"></i>
                                        </a>
                                        <?php if ($bricks['user_id'] == sessionId('freelancer_id')): ?>
                                            <a href="<?= base_url('company/brick-delete?id=' . $bricks['id']) ?>"
                                                title="Delete Brick"
                                                class="text-danger"
                                                onclick="return confirm('Are you sure you want to delete this brick?');">
                                                <i class="bi bi-trash"></i>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Brick Info (2 Columns) -->
                                <div class="brick-info">
                                    <div class="info-item"><strong>#<?= $brickCount++ ?></strong></div>
                                    <div class="info-item">Brick: <?= $bricks['brick_title'] ?></div>
                                    <div class="info-item">Company: <?= companyName($bricks['company_id']) ?></div>
                                    <div class="info-item">Project: <?= projectName($bricks['project_id']) ?></div>
                                    <div class="info-item">Type: <?= brickType($bricks['brick_type']) ?></div>
                                    <div class="info-item">Reward: <?= $bricks['reward_disclosed'] ?></div>
                                    <div class="info-item">Fund Required: <?= $brickFunding['fund_required'] ?></div>
                                    <div class="info-item">Privacy: <span class="text-capitalize"><?= $bricks['brick_privacy'] ?></span></div>
                                    <div class="info-item">Brick ID: <?= generateBrickId($bricks['id']) ?></div>
                                </div>

                                <!-- Edit Button -->
                                <?php if ($bricks['user_id'] == sessionId('freelancer_id')): ?>
                                    <a href="<?= base_url('company/create-brick?id=' . $bricks['id']) ?>"
                                        title="Edit Brick"
                                        class="brickEditButton">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-info my-5">No Bricks Found</div>
            <?php endif; ?>
        </div>

        <!-- Add CSS -->
        <style>
            /* Two-column layout for all bricks */
            .brick-grid {
                display: flex;
                flex-wrap: wrap;
                gap: 15px;
            }

            .brick-item {
                width: 49%;
                box-sizing: border-box;
                background: #fff;
                border-radius: 6px;
            }

            @media (max-width: 991px) {
                .brick-item {
                    width: 100%;
                }
            }

            .brick-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-bottom: 8px;
            }

            .brickStatus {
                padding: 3px 8px;
                border-radius: 4px;
                font-size: 12px;
            }

            .project-actions i {
                margin-left: 8px;
                cursor: pointer;
                color: #00a7cc;
            }

            /* Info section - 2 columns */
            .brick-info {
                display: grid;
                grid-template-columns: repeat(2, 1fr);
                gap: 6px 15px;
            }

            .info-item {
                background: #f9f9f9;
                border: 1px solid #ddd;
                border-radius: 4px;
                padding: 6px 8px;
                font-size: 13px;
            }

            .brickEditButton {
                position: absolute;
                top: 10px;
                right: 10px;
                color: #00a7cc;
                font-size: 16px;
            }
        </style>



    </div>

</body>

</html>
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

<!-- Shiv Web Developer  -->
<div class="container-fluid">
    <div class="d-flex">
        <div class="w-50 bg-primary text-white p-2 text-start rounded-start position-relative fs-11">
            Funded By
        </div>
        <div class="border-start border-white w-50 bg-primary text-white p-2 text-start rounded-end fs-11">
            <!-- Has offered  -->
            <!-- <strong>₹200</strong> <span class="ms-2">2%</span> 
                                        <small>on Date Time</small> -->
            Fund Amount
        </div>
    </div>
    <div style="overflow-y: scroll; height: 300px;">

        <?php foreach ($fund_requests as $fund): ?>
            <?php
            $profileImage = !empty($fund['user_image'])
                ? base_url('uploads/user_profile/' . $fund['user_image'])
                : base_url('assets/images/profile_av.png');
            ?>
            <div style="display: flex;">
                <div style="width: 50%;">
                    <div style="border: 1px solid #ced4da; height: 40px; font-size:13px">
                        <img src="<?= $profileImage ?>" alt="User Image"
                            style="width: 30px; height: 30px; margin: 5px; border-radius:100%;">
                        <?= htmlspecialchars($fund['freelancer_name'] ?? 'Unknown User') ?>
                        <a href="<?= base_url('company/user_preview?id=') . $fund['freelancer_id'] ?>" class="text-dark"
                            style="margin-right: 5px; margin-top: 10px; float:right;" target="_blank">
                            <i class="fas fa-eye"></i>
                        </a>
                        <span style="font-size:10px; color:green;">
                            <?php if ($fund['brick_title']) {
                                echo '-' . $fund['brick_title'];
                            } else {
                                echo '';
                            }
                            ?>
                        </span>
                    </div>
                </div>

                <div style="width: 50%;">
                    <div style="border: 1px solid #ced4da; height: 40px; font-size:13px;">
                        <div class="mt-2 px-1">
                            Rs. <?= $fund['fund_amount'] ?>/-
                            [ <?= $fund['fund_percentage'] ?>% ]

                            <?php if ($fund['fund_status'] === 'Pending'): ?>
                                <div style="float: right; margin-right: 5px; margin-top:2px; display:flex;">
                                    <form action="<?= base_url('company/fundRequestProcess') ?>" method="post">
                                        <input type="hidden" name="id" value="<?= $fund['id'] ?>">
                                        <input type="hidden" name="fund_status" value="Approve">
                                        <button type="submit" class="text-dark btn-primary text-white btn p-0 px-1 mx-1"
                                            style="font-size: 11px; margin-top:2px;">
                                            <i class="fa-solid fa-check p-0 m-0"></i> Approve
                                        </button>
                                    </form>
                                    <form action="<?= base_url('company/fundRequestProcess') ?>" method="post">
                                        <input type="hidden" name="id" value="<?= $fund['id'] ?>">
                                        <input type="hidden" name="fund_status" value="Reject">
                                        <button type="submit" class="text-dark btn-danger text-white btn p-0 px-1"
                                            style="font-size: 10px;">
                                            <i class="fa-solid fa-xmark"></i> Reject
                                        </button>
                                    </form>
                                </div>
                            <?php elseif ($fund['fund_status'] === 'Approve'): ?>
                                <span class="text-dark btn-success text-white btn p-0 px-1"
                                    style="font-size: 10px; float:right;">
                                    Approved
                                </span>
                            <?php else: ?>
                                <span class="text-dark btn-danger text-white btn p-0 px-1"
                                    style="font-size: 10px; float:right;">
                                    Rejected
                                </span>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Shiv Web Developer  -->
</div>
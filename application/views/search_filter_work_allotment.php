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
<!-- Shiv Web Developer  -->
<div class="container-fluid">
    <div class="d-flex">
        <div class="w-50 bg-primary text-white p-2 text-start rounded-start position-relative fs-11">
            Freelancer Details
        </div>
        <div class="border-start border-white w-50 bg-primary text-white p-2 text-start rounded-end fs-11">
            Bid Details
        </div>
    </div>

    <div style="overflow-y: scroll; height: 300px;">
        <?php foreach ($brick_work_allotment as $allotment): ?>
            <?php
            $profileImage = !empty($allotment['user_image'])
                ? base_url('uploads/user_profile/' . $allotment['user_image'])
                : base_url('assets/images/profile_av.png');
            ?>
            <div style="display: flex;">
                <div style="width: 50%;">
                    <div style="border: 1px solid #ced4da; height: 40px; font-size:13px">
                        <img src="<?= $profileImage ?>" alt="User Image"
                            style="width: 30px; height: 30px; margin: 5px; border-radius:100%;">
                        <?= htmlspecialchars($allotment['freelancer_name'] ?? 'Unknown User') ?>
                        <a href="<?= base_url('company/user_preview?id=') . $allotment['freelancer_id'] ?>"
                            class="text-dark" style="margin-right: 5px; margin-top: 10px; float:right;" target="_blank">
                            <i class="fas fa-eye"></i>
                        </a>
                        <span style="font-size:10px; color:green;">
                            <?php if ($allotment['brick_title']) {
                                echo '-' . $allotment['brick_title'];
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
                            Rs. <?= $allotment['bid_amount'] ?>/-
                            [ <?= $allotment['delivery_time'] ?> ]

                            <?php if ($allotment['status'] === 'Pending'): ?>
                                <div style="float: right; margin-right: 5px; margin-top:2px; display:flex;">
                                    <form action="<?= base_url('company/workAllotmentRequestProcess') ?>" method="post">
                                        <input type="hidden" name="id" value="<?= $allotment['id'] ?>">
                                        <input type="hidden" name="status" value="Accept">
                                        <button type="submit" class="text-dark btn-primary text-white btn p-0 px-1 mx-1"
                                            style="font-size: 11px; margin-top:2px;">
                                            <i class="fa-solid fa-check p-0 m-0"></i> Accept
                                        </button>
                                    </form>
                                    <form action="<?= base_url('company/workAllotmentRequestProcess') ?>" method="post">
                                        <input type="hidden" name="id" value="<?= $allotment['id'] ?>">
                                        <input type="hidden" name="status" value="Reject">
                                        <button type="submit" class="text-dark btn-danger text-white btn p-0 px-1"
                                            style="font-size: 10px;">
                                            <i class="fa-solid fa-xmark"></i> Reject
                                        </button>
                                    </form>
                                </div>
                            <?php elseif ($allotment['status'] === 'Accept'): ?>
                                <span class="text-dark btn-success text-white btn p-0 px-1"
                                    style="font-size: 10px; float:right;">
                                    Accepted
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
</div> <!-- Shiv Web Developer  -->
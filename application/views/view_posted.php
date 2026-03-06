<?php include('includes/header.php') ?>
<style>
    .bid-card {
        /* max-width: 400px; */
        margin: auto;
        background: #f9f9f9;
        border-radius: 0px 0px 10px 10px;
        padding: 27px;
        /* /* box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1); */
    }

    .alert-success {
        background-color: #0376891c;
        color: #034f5c;
        border: none;
        font-weight: bold;
        border-radius: 5px;
        font-size: 14px;
        padding-top: 9px;
        padding-bottom: 6px;
    }

    .price-slider {
        accent-color: #278fa0;
        width: 94%;
        height: 4px;
    }

    .btn-outline-secondary {
        border-radius: 5px;
        padding: 5px 10px;
    }

    .btn-primary {
        background-color: #1a49f2;
        border: none;
        padding: 10px;
        font-size: 16px;
    }

    .btn-primary:hover {
        background-color: #003fc5;
    }

    .sign-up-text {
        color: #6c757d;
        font-size: 14px;
    }

    .sign-up-text a {
        color: #00b8d6;
        font-weight: bold;
        text-decoration: none;
    }

    .bid-section {
        position: fixed;
        right: 20px;
        top: 8rem;
        width: 27%;
        height: 78vh;
        overflow-y: visible;
        /* background: white; */
        padding: 15px;
        z-index: 9;
    }
</style>
<!-- Shiv Web Developer -->
<div class="ps-md-4 pe-md-3 px-2 py-3 page-body">
    <div class="card p-4">
        <h5 class="view-post-name"><?= $brickDetails['project_name'] ?></h5>
        <div class="d-flex justify-content-between">
            <!-- <p>Status: <span class="fw-bold text-success">Active</span></p> -->
            <?= printCategories($brickDetails['category']); ?>
        </div>
        <div class="row g-2 mt-4  position-relative">
            <div class="col-md-7 scrollable-content">
                <div class="row">
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-1">
                            <i class="fa fa-building me-3"></i>
                            <span class="pe-2">Director Name: </span>
                            <a href="#"><?= $myCompany['director_name'] ?></a>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fa fa-credit-card me-3"></i>
                            <span class="pe-2">Budget: </span>
                            <a href="javascript: void(0);">₹<?= $brickDetails['min_budget'] . ' - ' . $brickDetails['max_budget'] ?><span class="text-secondary">/<?= ucwords($brickDetails['project_type']) ?></span></a>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="hstack gap-3 mb-4">
                            <div>
                                <p class="mb-1 text-muted small">Posted:</p>
                                <?= convertDatedmy($brickDetails['created_at']) ?>
                            </div>
                            <div class="ms-auto">
                                <p class="mb-1 text-muted small">Deadline:</p>
                                <?= convertDatedmy($brickDetails['brick_deadline']) ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="hstack gap-3 mb-2">
                            <div>
                                <p class="mb-1 text-muted small">Skills Required:</p>
                                <?php
                                echo printSkills($brickDetails['skills'])
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 mt-3">
                    <div class="card" style="box-shadow: none;">
                        <h4 class="fw-bold project-des">Project Description</h4>
                        <?= $brickDetails['description'] ?>

                        <h5 class="fw-bold mt-3 mb-4">Attachments</h5>
                        <ul class="list-unstyled d-flex flex-wrap">
                            <li class="d-flex p-3 rounded bg-light border mb-2 me-2 align-items-center">
                                <div class="avatar bg-danger text-white me-3 fs-5 d-flex align-items-center justify-content-center p-3 rounded-circle">
                                    <i class="fa fa-file-pdf-o"></i>
                                </div>
                                <div>
                                    <h6 class="mb-0">Project Brief</h6>
                                    <span class="text-muted">PDF</span>
                                </div>
                                <a href="your-file.pdf" download class="ms-3 btn btn-sm btn-primary d-flex align-items-center">
                                    <i class="fa fa-download me-1"></i>
                                </a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>

            <div class="col-md-5 bid-section bid-section">
                <div class="alert alert-success text-center mt-3">
                    6 days, 23 hours left
                </div>
                <div>
                    <h5 class="bid-jobs">Bid on this job!</h5>
                </div>
                <div class="bid-card">
                    <label class="mt-2">Set your <strong>minimal rate</strong></label>
                    <h3 class="fw-bold text-primary">$3,500</h3>
                    <input type="range" class="price-slider mb-md-5" min="1000" max="5000" step="100" value="3500">

                    <label class="mb-md-3">Set your <strong>delivery time</strong></label>
                    <div class="d-flex align-items-center mb-3">
                        <button class="btn btn-outline-secondary" onclick="decrement()">-</button>
                        <input type="text" id="delivery-time" value="1" class="form-control text-center mx-2" style="width: 60px;">
                        <button class="btn btn-outline-secondary" onclick="increment()">+</button>
                        <select class="form-select ms-2" style="width: auto;">
                            <option>Days</option>
                            <option>Weeks</option>
                            <option>Months</option>
                        </select>
                    </div>

                    <button class="btn btn-primary w-100 justify-content-center m-auto">Place a Bid</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php') ?>
<?php include('includes/footer-link.php') ?>
<script>
    function increment() {
        let input = document.getElementById('delivery-time');
        input.value = parseInt(input.value) + 1;
    }

    function decrement() {
        let input = document.getElementById('delivery-time');
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }
</script>
<!-- Shiv Web Developer -->